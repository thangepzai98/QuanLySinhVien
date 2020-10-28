<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ProductDetailRepository;
use App\Models\ProductDetail;
use App\Validators\ProductDetailValidator;

/**
 * Class ProductDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class ProductDetailRepositoryEloquent extends BaseRepository implements ProductDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductDetail::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
