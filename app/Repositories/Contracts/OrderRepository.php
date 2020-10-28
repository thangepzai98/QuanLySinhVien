<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface OrderRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface OrderRepository extends RepositoryInterface
{
    public function findAllOrder($searchWord, $start, $limit, $order, $orderBy);
    public function getOrderDetail($id);
    public function getOrdersOfUser($id);
    public function countOrdersByMonthYear($month, $year);
}
