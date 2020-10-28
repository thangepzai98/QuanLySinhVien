<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ProductRepository;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Validators\ProductValidator;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    public function findAllProduct($searchWord, $start, $limit, $order, $orderBy)
    {
        $query = $this->model;
        if ($searchWord !== null && $searchWord != '') {
            $query = $this->model->where([['name', 'LIKE', '%' . $searchWord . '%']]);
        }
        $count = $query->count();
        $query = $query->orderBy($order, $orderBy);
        $data = $query->skip($start)->take($limit)->get();
        return [
            'data' => $data,
            'recordsTotal' => $count
        ];
    }

    public function findProductById($id)
    {
        $product = $this->model->where([['status', \Config::get('constants.STATUS.ACTIVE')], ['id', $id]])->with('product_details')->first();
        return $product;
    }

    public function getProductByLimit($limit = 10)
    {
        $products = $this->model->with(['product_detail' => function($query) {
            $query->orderBy('sale_price', 'asc');
        }])->where([['status', \Config::get('constants.STATUS.ACTIVE')]])
        ->latest()->limit($limit)->get();
        return $products;
    }

    public function getFavoriteProducts($limit = 10)
    {
        $favoriteProducts = $this->model->with(['product_detail' => function($query) {
                $query->orderBy('sale_price', 'asc');
        }])->where([['status', \Config::get('constants.STATUS.ACTIVE')]])
        ->latest()->orderBy('rate', 'desc')->limit($limit)->get();
        return $favoriteProducts;
    }

    public function getRelateProduct($id)
    {
        $product = $this->find($id);
        $relateProducts = $this->model->with(['product_detail' => function($query) {
            $query->orderBy('sale_price', 'asc');
        }])->where([['status', \Config::get('constants.STATUS.ACTIVE')], 
                    ['category_id', $product->category_id],
                    ['id', '<>', $product->id]])->latest()->limit(5)->get();
        return $relateProducts;
    }

    public function getProductsByCategory($categoryId, $order, $price, $skip = '', $take = 20)
    {
        $minPrices = ProductDetail::select('product_id', DB::raw('min(sale_price) as minPrice'))->groupBy('product_id');
        $query = $this->model->joinSub($minPrices, 'minPrices', function($join) {
            $join->on('products.id', '=', 'minPrices.product_id');
        })->with(['product_detail' => function($query) {
            $query->orderBy('sale_price', 'asc');
        }])->where([['status', \Config::get('constants.STATUS.ACTIVE')], ['category_id', $categoryId]]);


        if(isset($order) && $order != '') {
            $query = $query->orderBy('minPrice', $order);
        } else {
            $query = $query->latest();
        }

        if(isset($price) && $price != '') {
            if($price == 'max2') {
                $query = $query->where('minPrice', '<=', 2000000);
            }
            else if($price == 'max3') {
                $query = $query->where('minPrice', '<=', 3000000);
            }
            else if($price == 'max4') {
                $query = $query->where('minPrice', '<=', 4000000);
            }
            else if($price == 'max5') {
                $query = $query->where('minPrice', '<=', 5000000);
            }
            else if($price == 'max10') {
                $query = $query->where('minPrice', '<=', 10000000);
            }
            else if($price == 'min10') {
                $query = $query->where('minPrice', '>=', 10000000);
            }
        }

        if(isset($take) && $take != '' && isset($skip) && $skip != '') {
            $products = $query->skip($skip)->take($take)->get();
        } else {
            $products = $query->take($take)->get();
        }

        return $products;
    }

    public function searchProduct($searchWord)
    {
        $products = $this->model->with(['product_detail' => function($query) {
            $query->orderBy('sale_price', 'asc');
        }])->where([
                    ['status', \Config::get('constants.STATUS.ACTIVE')],
                    ['name', 'LIKE', '%' . $searchWord . '%']
                ])->limit(20)->get();
        return $products;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
