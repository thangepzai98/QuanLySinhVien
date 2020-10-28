<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProductVoteRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface ProductVoteRepository extends RepositoryInterface
{
    public function getRateAvg($productId);
}
