<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Helpers\CommonFunctions;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\OrderRepository;

class UserController extends Controller
{
    protected $user;
    protected $order;

    public function __construct(
        UserRepository $user,
        OrderRepository $order
    )
    {
        $this->user = $user;
        $this->order = $order;
    }

    public function index()
    {
        return view('admin.user.index');
    }

    public function getDataUser(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'address',
            5 => 'type',
            6 => 'created_at',
            7 => 'options'
        ];
        $searchWord = $request->input('search.value');
        $start = $request->input('start');
        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $users = $this->user->findAllUser($searchWord, $start, $limit, $order, $dir);
        $data = array();
        if(!empty($users['data'])) {
            foreach ($users['data'] as $index => $item) {
                $id = $item->id;
                $urlStatus = "/admin/updateStatusUser";
                $tableName = "#table_model";
                $nestedData['index']            = ++$index + $start;
                $nestedData['name']             = !empty($item->name)  ? $item->name : '---';
                $nestedData['email']            = !empty($item->email) ? $item->email : '---';
                $nestedData['phone']            = !empty($item->phone) ? $item->phone : '---';
                $nestedData['address']          = !empty($item->address) ? $item->address : '---';
                $nestedData['type']             = $item->type == 1 ? '<button type="button" class="btn btn-outline-primary">Admin</button>' : '<button type="button" class="btn btn-outline-success">Khách hàng</button>';
                $nestedData['status']           = $item->status == 1 ? '<span class="badge badge-success btnChangeStatus" data-status="'.$item->status.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Active</span>' : '<span class="badge badge-dark btnChangeStatus" data-status="'.$item->status.'" data-id="'.$item->id.'" data-url="'.$urlStatus.'" data-template="'.$tableName.'">Disable</span>';
                $nestedData['created_at']       = !empty($item->created_at) ? Carbon::parse($item->created_at)->diffForHumans() : '---';
                $nestedData['options'] = '<a href="#" title="Xem chi tiết" class="btn btn-info viewRecordDetail" data-toggle="modal" data-target="#viewRecordDetail" data-id="'.$id.'"><i class="fa fa-eye icon-only"></i></a>';
                $data[] = $nestedData;
            }
        }
        $result = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($users['recordsTotal']),
            "recordsFiltered" => intval($users['recordsTotal']),
            "data"            => $data
        );
        return response()->json($result);
    }

    public function updateStatus(Request $request) {
        $status = $request->status == 1 ? 0 : 1;
        $id = $request->id;
        $apiFormat = array();
        $apiFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        try {
            DB::beginTransaction();
            $this->user->update([
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

    public function getOrdersOfUser($id) {
        $jsonFormat = [];
        $jsonFormat['status'] = \Config::get('constants.STATUS.INACTIVE');
        if ($this->user->count(['id' => $id]) > 0) {
            $jsonFormat['status'] = \Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['data']  = $this->order->getOrdersOfUser($id);
        } else {
            $jsonFormat['message'] = 'Không tồn tại bản ghi';
        }
        return response()->json($jsonFormat);
    }
}
