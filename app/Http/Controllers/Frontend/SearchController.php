<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductRepository;

class SearchController extends Controller
{
    protected $product;

    public function __construct(
        ProductRepository $product
    ) {
        $this->product = $product;
    }

    public function show(Request $request)
    {
        $products = $this->product->searchProduct($request->keyword);
        return view('front.search', compact('products'));
    }
}
