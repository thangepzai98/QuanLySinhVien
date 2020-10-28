<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\UserRepository;
use App\Models\User;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function findAllUser($searchWord, $start, $limit, $order, $orderBy)
    {
        $query = $this->model;
        if ($searchWord !== null && $searchWord != '') {
            $query = $this->model->where('name', 'LIKE', '%' . $searchWord . '%')
                                ->orWhere('email', 'LIKE', '%' . $searchWord . '%')
                                ->orWhere('phone', 'LIKE', '%' . $searchWord . '%')
                                ->orWhere('address', 'LIKE', '%' . $searchWord . '%');
        }
        $count = $query->count();
        $query = $query->orderBy($order, $orderBy);
        $data = $query->skip($start)->take($limit)->get();
        return [
            'data' => $data,
            'recordsTotal' => $count
        ];
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
