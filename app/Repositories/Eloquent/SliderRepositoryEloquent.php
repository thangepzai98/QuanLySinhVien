<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\SliderRepository;
use App\Models\Slider;
use App\Validators\SliderValidator;

/**
 * Class SliderRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class SliderRepositoryEloquent extends BaseRepository implements SliderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Slider::class;
    }

    public function findAllSlider($searchWord, $start, $limit, $order, $orderBy)
    {
        $query = $this->model;
        if ($searchWord !== null && $searchWord != '') {
            $query = $this->model->where('order', 'LIKE', '%' . $searchWord . '%')
                                    ->orWhere('link', 'LIKE', '%' . $searchWord . '%');
        }
        $count = $query->count();
        $query = $query->orderBy($order, $orderBy);
        $data = $query->skip($start)->take($limit)->get();
        return [
            'data' => $data,
            'recordsTotal' => $count
        ];
    }

    public function getSlidersByLimit($limit = 5)
    {
        $sliders = $this->model->where('status', \Config::get('constants.STATUS.ACTIVE'))
        ->orderBy('order', 'asc')->limit($limit)->get();
        return $sliders;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
