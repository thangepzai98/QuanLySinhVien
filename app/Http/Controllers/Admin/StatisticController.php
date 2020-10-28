<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\OrderDetailRepository;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\CategoryRepository;
use Illuminate\Support\Carbon;

class StatisticController extends Controller
{

    protected $order;
    protected $orderDetail;
    protected $category;

    public function __construct(
        OrderDetailRepository $orderDetail,
        OrderRepository $order,
        CategoryRepository $category
    )
    {
        $this->orderDetail = $orderDetail;
        $this->order = $order;
        $this->category = $category;
    }

    public function index() {
        $carbon = new Carbon('first day of this month');
        $countProducts = 0;
        $totalRevenue = 0;
        $totalProfit = 0;

        for($i = 0; $i < $carbon->daysInMonth; $i++) {
            $revenue = 0;
            $profit = 0;
            $data['labels'][] = $carbon->copy()->addDay($i)->format('d/m/Y');
            $orderDetails = $this->orderDetail->getOrderDetailsByDate($carbon->copy()->addDay($i)->format('Y-m-d'));

            foreach($orderDetails as $orderDetail) {
                $revenue = $revenue + $orderDetail->price * $orderDetail->quantity;
                $profit = $profit + $orderDetail->quantity * ($orderDetail->price - $orderDetail->product_detail->import_price);
                $countProducts = $countProducts + $orderDetail->quantity;
            }

            $totalRevenue = $totalRevenue + $revenue;
            $totalProfit = $totalProfit + $profit;
            $data['revenues'][] = $revenue;
        }

        $data['countProducts'] = $countProducts;
        $data['totalRevenue'] = $totalRevenue;
        $data['totalProfit'] = $totalProfit;
        $data['countOrders'] = $this->order->countOrdersByMonthYear($carbon->month, $carbon->year);

        $categories = $this->category->all();

        foreach($categories as $category) {
            $data['category'][$category->name]['quantity'] = 0;
            $data['category'][$category->name]['revenue'] = 0;
            $data['category'][$category->name]['profit'] = 0;
        }

        $orderDetails = $this->orderDetail->getOrderDetailByMonthYear($carbon->month, $carbon->year);

        foreach($orderDetails as $orderDetail) {
            $data['category'][$orderDetail->product_detail->product->category->name]['quantity'] +=  $orderDetail->quantity;
            $data['category'][$orderDetail->product_detail->product->category->name]['revenue'] += $orderDetail->price * $orderDetail->quantity;
            $data['category'][$orderDetail->product_detail->product->category->name]['profit'] += $orderDetail->quantity * ($orderDetail->price - $orderDetail->product_detail->import_price);
        }

        return view('admin.statistic.index', compact('data'));
    }
}
