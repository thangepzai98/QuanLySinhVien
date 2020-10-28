<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PostRepository;
use App\Models\Post;
use App\Validators\PostValidator;

/**
 * Class PostRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    public function findAllPost($searchWord, $start, $limit, $order, $orderBy)
    {
        $query = $this->model;
        if ($searchWord !== null && $searchWord != '') {
            $query = $this->model->where('title', 'LIKE', '%' . $searchWord . '%');
        }
        $count = $query->count();
        $query = $query->orderBy($order, $orderBy);
        $data = $query->skip($start)->take($limit)->get();
        return [
            'data' => $data,
            'recordsTotal' => $count
        ];
    }

    public function getPostByLimit($limit = 10)
    {
        $posts = $this->model->where('status', \Config::get('constants.STATUS.ACTIVE'))
                        ->latest()->limit($limit)->paginate(1);
        return $posts;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
