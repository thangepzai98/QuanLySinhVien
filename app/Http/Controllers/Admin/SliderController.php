<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Helpers\CommonFunctions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Contracts\SliderRepository;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(SliderRepository $slider)
    {
        $this->slider = $slider;
    }

    public function index()
    {
        return view('admin.slider.index');
    }

    public function store(Request $request)
    {
        $jsonFormat = array();
        $jsonFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'order'  => 'required|numeric|min:1|max:100'
        ], [
            'required' => 'Các trường có dấu (*) là bắt buộc nhập',
            'order.numeric' => 'Thứ tự phải là kiểu số',
            'order.min' => 'Thứ tự nhỏ nhất là 1',
            'order.max' => 'Giá trị lớn nhất là 100'
        ]);

        if ($validator->fails()) {
            $jsonFormat['message'] = $validator->errors()->first();
            return response()->json($jsonFormat);
        }
        
        try {
            DB::beginTransaction();
            $this->slider->create([
                'image' => $request->image,
                'order' => $request->order,
                'link' => $request->link,
                'status'    => $request->status ? 1 : 0
            ]);    
            DB::commit();
            $jsonFormat['status']  = Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['message'] = 'Thêm thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $jsonFormat['message'] = $e->getMessage();
        }
        return response()->json($jsonFormat);
    }

    public function getDataSlider(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'image',
            2 => 'order',
            3 => 'link',
            4 => 'status',
            5 => 'created_at',
            6 => 'options'
        ];
        $searchWord = $request->input('search.value');
        $start = $request->input('start');
        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $sliders = $this->slider->findAllSlider($searchWord, $start, $limit, $order, $dir);
        $data = array();
        if(!empty($sliders['data'])) {
            foreach ($sliders['data'] as $index => $item) {
                $id = $item->id;
                $urlEdit = '/admin/getSliderById/' . $id;
                $urlDelete = '/admin/deleteSlider'; 
                $editMethod = 'GET';
                $deleteMethod = 'POST';
                $urlStatus = "/admin/updateStatusSlider";
                $tableName = "#table_model";
                $deleteTitle = isset($item->link) ? $item->link : '';
                $nestedData['index'] = ++$index + $start;
                $nestedData['image'] = !empty($item->image)  ? '<img src="'.$item->image.'" style="max-width: 100px; max-height: 100px">' : '---';
                $nestedData['order'] = !empty($item->order)  ? $item->order : '---';
                $nestedData['link'] = !empty($item->link)  ? $item->link : '---';
                $nestedData['status'] = $item->status == 1 ? '<span class="badge badge-success btnChangeStatus" data-status="'.$item->status.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Active</span>' : '<span class="badge badge-dark btnChangeStatus" data-status="'.$item->status.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Disabled</span>';
                $nestedData['created_at'] = !empty($item->created_at) ? Carbon::parse($item->created_at)->diffForHumans() : '---';
                $nestedData['options'] = CommonFunctions::getHtmlEditAndDelete($id, $urlEdit, $urlDelete, $editMethod, $deleteMethod, $deleteTitle, $tableName);   
                $data[] = $nestedData;
            }
        }
        $result = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($sliders['recordsTotal']),
            "recordsFiltered" => intval($sliders['recordsTotal']),
            "data"            => $data
        );
        return response()->json($result);
    }

    public function edit($id) {
        $jsonFormat = [];
        $jsonFormat['status'] = \Config::get('constants.STATUS.INACTIVE');
        if ($this->slider->count(['id' => $id]) > 0) {
            $jsonFormat['status'] = \Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['data']  = $this->slider->find($id);
        } else {
            $jsonFormat['message'] = 'Không tồn tại bản ghi';
        }
        return response()->json($jsonFormat);
    }

    public function update(Request $request) {
        $data = array();
        $id = $request->id;
        $jsonFormat = array();
        $jsonFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'order'  => 'required|numeric|min:1|max:100'
        ], [
            'required' => 'Các trường có dấu (*) là bắt buộc nhập',
            'order.numeric' => 'Thứ tự phải là kiểu số',
            'order.min' => 'Thứ tự nhỏ nhất là 1',
            'order.max' => 'Giá trị lớn nhất là 100'
        ]);

        if ($validator->fails()) {
            $jsonFormat['message'] = $validator->errors()->first();
            return response()->json($jsonFormat);
        }
       
        try {
            $data['image'] = $request->image;
            $data['order'] = $request->order;
            $data['link'] = $request->link;
            $data['status'] = $request->status ? 1 : 0;
            DB::beginTransaction();
            $this->slider->update($data, $id);
            DB::commit();
            $jsonFormat['status']  = Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['message'] = 'Cập nhật thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $jsonFormat['message'] = $e->getMessage();
        }
        return response()->json($jsonFormat);
    }

    public function delete($id) {
        $jsonFormat = array();
        $jsonFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        try {
            DB::beginTransaction();
            $this->slider->delete($id);
            DB::commit();
            $jsonFormat['status'] = Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['message'] = 'Xóa thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $jsonFormat['message'] = $e->getMessage();
        }
        return response()->json($jsonFormat);
    }
   
    public function updateStatus(Request $request) {
        $status = $request->status == 1 ? 0 : 1;
        $id = $request->id;
        $jsonFormat = array();
        $jsonFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        try {
            DB::beginTransaction();
            $result = $this->slider->update([
                "status" => $status
            ], $id);
            DB::commit();
            $jsonFormat['status'] = Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['message'] = 'Cập nhật thành công';
        } catch (\Exception $e) {
            DB::rollBack();
            $jsonFormat['message'] = 'Có lỗi xảy ra';
        }
        return response()->json($jsonFormat);
    }

}
