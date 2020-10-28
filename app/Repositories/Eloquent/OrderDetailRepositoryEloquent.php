<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\OrderDetailRepository;
use App\Models\OrderDetail;
use App\Validators\OrderDetailValidator;
use Lcobucci\JWT\Builder;
use Illuminate\Support\Facades\Config;

/**
 * Class OrderDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class OrderDetailRepositoryEloquent extends BaseRepository implements OrderDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderDetail::class;
    }

    public function getOrderDetailsByDate($date) {
        $orderDetails = $this->model->whereDate('created_at', $date)
                                    ->whereHas('order', function($query) {
                                        $query->where('status',  Config::get('constants.STATUS.ACTIVE'));
                                    })->with('order')->get();
        return $orderDetails;
    }

    public function getOrderDetailByMonthYear($month, $year) {
        $orderDetails = $this->model->whereMonth('created_at', $month)->whereYear('created_at', $year)
                                    ->whereHas('order', function($query) {
                                        $query->where('status',  Config::get('constants.STATUS.ACTIVE'));
                                    })->with('order')->get();
        return $orderDetails;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
