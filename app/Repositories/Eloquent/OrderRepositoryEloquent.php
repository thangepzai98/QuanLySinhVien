<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\OrderRepository;
use App\Models\Order;
use Illuminate\Support\Facades\Config;

/**
 * Class OrderRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    public function findAllOrder($searchWord, $start, $limit, $order, $orderBy)
    {
        $query = $this->model->where('status',  Config::get('constants.STATUS.ACTIVE'));
        if ($searchWord !== null && $searchWord != '') {
            $query = $this->model->where('name', 'LIKE', '%' . $searchWord . '%')
                                ->orWhere('order_code', 'LIKE', '%' . $searchWord . '%')
                                ->orWhere('email', 'LIKE', '%' . $searchWord . '%')
                                ->orWhere('phone', 'LIKE', '%' . $searchWord . '%');
        }
        $count = $query->count();
        $query = $query->orderBy($order, $orderBy);
        $data = $query->skip($start)->take($limit)->get();
        return [
            'data' => $data,
            'recordsTotal' => $count
        ];
    }

    public function getOrderDetail($id)
    {
        $order = $this->model->where([['id', $id], ['status',  Config::get('constants.STATUS.ACTIVE')]])
        ->with(['order_details' => function($query) {
            $query->with([
              'product_detail' => function ($query) {
                $query->with('product');
              }
            ]);
          }, 'user'])->first();
        return $order;
    }

    public function getOrdersOfUser($id)
    {
        $order = $this->model->where([['user_id', $id], ['status',  Config::get('constants.STATUS.ACTIVE')]])
        ->with(['order_details' => function($query) {
            $query->with([
              'product_detail' => function ($query) {
                $query->with('product');
              }
            ]);
        }, 'user'])->get();
        return $order;
    }

    public function countOrdersByMonthYear($month, $year)
    {
        $orders =  $this->model->where('status',  Config::get('constants.STATUS.ACTIVE'))
                        ->whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)->count();
        return $orders;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
