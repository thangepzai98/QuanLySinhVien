<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Helpers\CommonFunctions;
use App\Repositories\Contracts\CategoryRepository;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->all(['name', 'status', 'created_at']);
        return view('admin.category.index', compact('categories'));
    }

    public function getDataCategory(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'status',
            3 => 'created_at',
            4 => 'options'
        ];
        $searchWord = $request->input('search.value');
        $start = $request->input('start');
        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $categories = $this->category->findAllCategory($searchWord, $start, $limit, $order, $dir);
        $data = array();
        if(!empty($categories['data'])) {
            foreach ($categories['data'] as $index => $item) {
                $id = $item->id;
                $urlEdit = '/admin/getCategoryById/' . $id;
                $urlDelete = '/admin/deleteCategory'; 
                $editMethod = 'GET';
                $deleteMethod = 'POST';
                $urlStatus = "/admin/updateStatusCategory";
                $tableName = "#table_model";
                $deleteTitle = isset($item->name) ? $item->name : '';
                $nestedData['index']            = ++$index + $start;
                $nestedData['name']             = !empty($item->name)  ? $item->name : '---';
                $nestedData['status']           = $item->status == 1 ? '<span class="badge badge-success btnChangeStatus" data-status="'.$item->status.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Active</span>' : '<span class="badge badge-dark btnChangeStatus" data-status="'.$item->status.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Disabled</span>';
                $nestedData['created_at']       = !empty($item->created_at) ? Carbon::parse($item->created_at)->diffForHumans() : '---';
                $nestedData['options'] = CommonFunctions::getHtmlEditAndDelete($id, $urlEdit, $urlDelete, $editMethod, $deleteMethod, $deleteTitle, $tableName);   
                $data[] = $nestedData;
            }
        }
        $result = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($categories['recordsTotal']),
            "recordsFiltered" => intval($categories['recordsTotal']),
            "data"            => $data
        );
        return response()->json($result);
    }

    public function store(Request $request)
    {
        $apiFormat = array();
        $apiFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:categories,name'
        ], [
            'required' => 'Các trường có dấu (*) là bắt buộc nhập',
            'name.unique' => 'Tên chuyên mục đã tồn tại'
        ]);

        if ($validator->fails()) {
            $jsonFormat['message'] = $validator->errors()->first();
            return response()->json($jsonFormat);
        }
        
        try {
            DB::beginTransaction();
            $result = $this->category->create([
                'name'      => $request->name,
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

    public function edit($id) {
        $apiFormat = [];
        $apiFormat['status'] = \Config::get('constants.STATUS.INACTIVE');
        if ($this->category->count(['id' => $id]) > 0) {
            $apiFormat['status'] = \Config::get('constants.STATUS.ACTIVE');
            $apiFormat['data']  = $this->category->find($id);
        } else {
            $apiFormat['message'] = 'Không tồn tại bản ghi';
        }
        return response()->json($apiFormat);
    }

    public function update(Request $request) {
        $data = array();
        $id = $request->id;
        $apiFormat = array();
        $apiFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:categories,name,' . $id
        ], [
            'required' => 'Các trường có dấu (*) là bắt buộc nhập',
            'name.unique' => 'Tên chuyên mục đã tồn tại'
        ]);

        if ($validator->fails()) {
            $jsonFormat['message'] = $validator->errors()->first();
            return response()->json($jsonFormat);
        }
       
        try {
            $data['name'] = $request->name;
            $data['status'] = $request->status ? 1 : 0;
            DB::beginTransaction();
            $this->category->update($data, $id);
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
            $this->category->delete($id);
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
            $result = $this->category->update([
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
