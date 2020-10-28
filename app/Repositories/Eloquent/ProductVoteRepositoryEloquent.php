<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ProductVoteRepository;
use App\Models\ProductVote;
use App\Validators\ProductVoteValidator;

/**
 * Class ProductVoteRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class ProductVoteRepositoryEloquent extends BaseRepository implements ProductVoteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductVote::class;
    }

    public function getRateAvg($productId)
    {
        $rateAvg = $this->model->where('product_id', $productId)->avg('rate');
        return $rateAvg;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
