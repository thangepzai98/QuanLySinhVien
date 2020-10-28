<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProductRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface ProductRepository extends RepositoryInterface
{
    public function findAllProduct($searchWord, $start, $limit, $order, $orderBy);
    public function findProductById($id);
    public function getProductByLimit($limit = 10);
    public function getFavoriteProducts($limit = 10);
    public function getProductsByCategory($categoryId, $order, $price, $skip = '', $take = 20);
    public function getRelateProduct($id);
    public function searchProduct($searchWord);
}
