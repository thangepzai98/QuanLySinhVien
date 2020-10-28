<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\OrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class OrderController extends Controller
{
    
    protected $order;

    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }
    
    public function index()
    {
        return view('admin.order.index');
    }

    public function getDataOrder(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'order_code',
            2 => 'name',
            3 => 'email',
            4 => 'phone',
            5 => 'payment_method',
            6 => 'is_processed',
            7 => 'created_at',
            8 => 'options'
        ];
        $searchWord = $request->input('search.value');
        $start = $request->input('start');
        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $orders = $this->order->findAllOrder($searchWord, $start, $limit, $order, $dir);
        $data = array();
        if(!empty($orders['data'])) {
            foreach ($orders['data'] as $index => $item) {
                $id = $item->id;
                $urlStatus = "/admin/updateStatusOrder";
                $tableName = "#table_model";
                $nestedData['index']            = ++$index + $start;
                $nestedData['order_code']       = !empty($item->order_code)  ? $item->order_code : '---';
                $nestedData['name']             = !empty($item->name)  ? $item->name : '---';
                $nestedData['email']            = !empty($item->email) ? $item->email : '---';
                $nestedData['phone']            = !empty($item->phone) ? $item->phone : '---';
                $nestedData['payment_method']   = $item->payment_method == 1 ? '<button type="button" class="btn btn-outline-primary">Tiền mặt</button>' : '<button type="button" class="btn btn-outline-success">Online</button>';
                $nestedData['is_processed']     = $item->is_processed == 1 ? '<span class="badge badge-success btnChangeStatus" data-status="'.$item->is_processed.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Đã xử lý</span>' : '<span class="badge badge-dark btnChangeStatus" data-status="'.$item->is_processed.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Chưa xử lý</span>';
                $nestedData['created_at']       = !empty($item->created_at) ? Carbon::parse($item->created_at)->diffForHumans() : '---';
                $nestedData['options'] = '<a href="#" title="Xem chi tiết" class="btn btn-info viewRecordDetail" data-toggle="modal" data-target="#viewRecordModal" data-id="'.$id.'"><i class="fa fa-eye icon-only"></i></a>';
                $data[] = $nestedData;
            }
        }
        $result = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($orders['recordsTotal']),
            "recordsFiltered" => intval($orders['recordsTotal']),
            "data"            => $data
        );
        return response()->json($result);
    }

    public function getOrderDetail($id)
    {
        $jsonFormat = [];
        $jsonFormat['status'] = \Config::get('constants.STATUS.INACTIVE');
        if ($this->order->count(['id' => $id]) > 0) {
            $jsonFormat['status'] = \Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['data']  = $this->order->getOrderDetail($id);
        } else {
            $jsonFormat['message'] = 'Không tồn tại bản ghi';
        }
        return response()->json($jsonFormat);
    }
    

    public function updateStatus(Request $request) {
        $status = $request->status == 1 ? 0 : 1;
        $id = $request->id;
        $apiFormat = array();
        $apiFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        try {
            DB::beginTransaction();
            $order = $this->order->find($id);
            $order->is_processed = $status;
            $order->save();
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
