<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OrderDetail.
 *
 * @package namespace App\Models;
 */
class OrderDetail extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_detail_id',
        'quantity',
        'price',
    ];
    
    public function product_detail()
    {
        return $this->belongsTo('App\Models\ProductDetail');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
