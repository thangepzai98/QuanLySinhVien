<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SliderRepository.
 *
 * @package namespace App\Repositories\Contracts;
 */
interface SliderRepository extends RepositoryInterface
{
    public function findAllSlider($searchWord, $start, $limit, $order, $orderBy);
    public function getSlidersByLimit($limit = 5);
}
