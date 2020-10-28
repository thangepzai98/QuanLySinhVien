<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Order.
 *
 * @package namespace App\Models;
 */
class Order extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'payment_method',
        'order_code',
        'name',
        'email',
        'phone',
        'address',
        'status'
    ];

    public function order_details() {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
