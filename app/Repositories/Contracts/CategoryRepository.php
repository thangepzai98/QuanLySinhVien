<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface CategoryRepository extends RepositoryInterface
{
    public function findAllCategory($searchWord, $start, $limit, $order, $orderBy);
}
