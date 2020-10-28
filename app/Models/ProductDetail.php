<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ProductDetail.
 *
 * @package namespace App\Models;
 */
class ProductDetail extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'color',
        'image',
        'import_quantity',
        'quantity',
        'import_price',
        'sale_price',
        'promotion_price',
        'promotion_start_date',
        'promotion_end_date',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
