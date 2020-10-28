<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PostRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface PostRepository extends RepositoryInterface
{
    public function findAllPost($searchWord, $start, $limit, $order, $orderBy);
    public function getPostByLimit($limit = 10);
}
