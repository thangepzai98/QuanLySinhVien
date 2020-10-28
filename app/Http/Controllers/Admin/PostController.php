<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Helpers\CommonFunctions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Contracts\PostRepository;

class PostController extends Controller
{
    protected $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        return view('admin.post.index');
    }

    public function store(Request $request)
    {
        $apiFormat = array();
        $apiFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title'  => 'required',
            'content' => 'required'
        ], [
            'required' => 'Các trường có dấu (*) là bắt buộc nhập',
        ]);

        if ($validator->fails()) {
            $jsonFormat['message'] = $validator->errors()->first();
            return response()->json($jsonFormat);
        }
        
        try {
            DB::beginTransaction();
            $this->post->create([
                'title' => $request->title,
                'image' => $request->image,
                'content' => $request->content,
                'status'    => $request->status ? 1 : 0
            ]);    
            DB::commit();
            $apiFormat['status']  = Config::get('constants.STATUS.ACTIVE');
            $apiFormat['message'] = 'Thêm thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $apiFormat['message'] = $e->getMessage();
        }
        return response()->json($apiFormat);
    }

    public function getDataPost(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'title',
            2 => 'image',
            3 => 'status',
            4 => 'created_at',
            5 => 'options'
        ];
        $searchWord = $request->input('search.value');
        $start = $request->input('start');
        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $posts = $this->post->findAllPost($searchWord, $start, $limit, $order, $dir);
        $data = array();
        if(!empty($posts['data'])) {
            foreach ($posts['data'] as $index => $item) {
                $id = $item->id;
                $urlEdit = '/admin/getPostById/' . $id;
                $urlDelete = '/admin/deletePost'; 
                $editMethod = 'GET';
                $deleteMethod = 'POST';
                $urlStatus = "/admin/updateStatusPost";
                $tableName = "#table_model";
                $deleteTitle = isset($item->title) ? $item->title : '';
                $nestedData['index'] = ++$index + $start;
                $nestedData['image'] = !empty($item->image)  ? '<img src="'.$item->image.'" style="max-width: 100px; max-height: 100px">' : '---';
                $nestedData['title'] = !empty($item->title)  ? $item->title : '---';
                $nestedData['status'] = $item->status == 1 ? '<span class="badge badge-success btnChangeStatus" data-status="'.$item->status.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Active</span>' : '<span class="badge badge-dark btnChangeStatus" data-status="'.$item->status.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Disabled</span>';
                $nestedData['created_at'] = !empty($item->created_at) ? Carbon::parse($item->created_at)->diffForHumans() : '---';
                $nestedData['options'] = CommonFunctions::getHtmlEditAndDelete($id, $urlEdit, $urlDelete, $editMethod, $deleteMethod, $deleteTitle, $tableName);   
                $data[] = $nestedData;
            }
        }
        $result = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($posts['recordsTotal']),
            "recordsFiltered" => intval($posts['recordsTotal']),
            "data"            => $data
        );
        return response()->json($result);
    }

    public function edit($id) {
        $jsonFormat = [];
        $jsonFormat['status'] = \Config::get('constants.STATUS.INACTIVE');
        if ($this->post->count(['id' => $id]) > 0) {
            $jsonFormat['status'] = \Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['data']  = $this->post->find($id);
        } else {
            $jsonFormat['message'] = 'Không tồn tại bản ghi';
        }
        return response()->json($jsonFormat);
    }

    public function update(Request $request) {
        $data = array();
        $id = $request->id;
        $apiFormat = array();
        $apiFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title'  => 'required',
            'content' => 'required'
        ], [
            'required' => 'Các trường có dấu (*) là bắt buộc nhập',
        ]);

        if ($validator->fails()) {
            $jsonFormat['message'] = $validator->errors()->first();
            return response()->json($jsonFormat);
        }
       
        try {
            $data['image'] = $request->image;
            $data['title'] = $request->title;
            $data['content'] = $request->content;
            $data['status'] = $request->status ? 1 : 0;
            DB::beginTransaction();
            $this->post->update($data, $id);
            DB::commit();
            $apiFormat['status']  = Config::get('constants.STATUS.ACTIVE');
            $apiFormat['message'] = 'Cập nhật thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $apiFormat['message'] = $e->getMessage();
        }
        return response()->json($apiFormat);
    }

    public function delete($id) {
        $apiFormat = array();
        $apiFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        try {
            DB::beginTransaction();
            $this->post->delete($id);
            DB::commit();
            $apiFormat['status'] = Config::get('constants.STATUS.ACTIVE');
            $apiFormat['message'] = 'Xóa thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $apiFormat['message'] = $e->getMessage();
        }
        return response()->json($apiFormat);
    }

    public function updateStatus(Request $request) {
        $status = $request->status == 1 ? 0 : 1;
        $id = $request->id;
        $apiFormat = array();
        $apiFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        try {
            DB::beginTransaction();
            $result = $this->post->update([
                "status" => $status
            ], $id);
            DB::commit();
            $apiFormat['status'] = Config::get('constants.STATUS.ACTIVE');
            $apiFormat['message'] = 'Cập nhật thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $apiFormat['message'] = 'Có lỗi xảy ra';
        }
        return response()->json($apiFormat);
    }
}
