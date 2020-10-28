<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\StatisticRepository;
use App\Models\Statistic;
use App\Validators\StatisticValidator;

/**
 * Class StatisticRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class StatisticRepositoryEloquent extends BaseRepository implements StatisticRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Statistic::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
