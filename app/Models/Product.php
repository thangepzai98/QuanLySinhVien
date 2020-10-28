<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Product.
 *
 * @package namespace App\Models;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
        'image',
        'sku_code',
        'details',
        'introduction',
        'status'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function product_details() {
        return $this->hasMany('App\Models\ProductDetail');
    }

    public function product_detail() {
        return $this->hasOne('App\Models\ProductDetail', 'product_id', 'id');
    }

    public function product_votes() {
        return $this->hasMany('App\Models\ProductVote')->latest()->limit(3);
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
}
