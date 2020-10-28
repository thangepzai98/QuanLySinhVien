<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OrderDetailRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface OrderDetailRepository extends RepositoryInterface
{
    public function getOrderDetailByMonthYear($month, $year);
}
