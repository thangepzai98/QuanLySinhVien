<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductRepository;

class CategoryController extends Controller
{

    protected $product;

    public function __construct(
        ProductRepository $product
    ) {
        $this->product = $product;
    }

    public function show(Request $request, $id)
    {
        $products = $this->product->getProductsByCategory($id, $request->order, $request->price);
        return view('front.category', compact('products')); 
    }

    public function loadMoreData(Request $request)
    {
        if($request->ajax()) {
            $skip = $request->skip;
            $take = 20;
            $products = $this->product->getProductsByCategory(3, $request->order, $request->price, $skip, $take);
            return response()->json($products);
        } else {
            return response()->json('Direct Access Not Allowed!!');
        }
    }
}
