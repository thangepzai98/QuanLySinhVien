<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\SubCategoryRepository;
use App\Models\SubCategory;
use App\Validators\SubCategoryValidator;

/**
 * Class SubCategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class SubCategoryRepositoryEloquent extends BaseRepository implements SubCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SubCategory::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
