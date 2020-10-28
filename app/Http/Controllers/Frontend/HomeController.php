<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\SliderRepository;

class HomeController extends Controller
{
    protected $product;
    protected $category;
    protected $slider;

    public function __construct(
        ProductRepository $product,
        CategoryRepository $category,
        SliderRepository $slider
    ) {
        $this->product = $product;
        $this->category = $category;
        $this->slider = $slider;
    }

    public function index()
    {
        $products = $this->product->getProductByLimit();
        $favoriteProducts = $this->product->getFavoriteProducts();
        $sliders = $this->slider->getSlidersByLimit();
       // dd($sliders);
        return view('front.home', compact('products', 'favoriteProducts', 'sliders'));
    }
}
