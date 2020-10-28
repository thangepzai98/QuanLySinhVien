<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Contracts\ProductDetailRepository;
use App\Repositories\Contracts\ProductVoteRepository;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $productRepository;
    protected $productDetailRepository;
    protected $productVoteRepositoty;

    public function __construct(
        ProductRepository $productRepository,
        ProductDetailRepository $productDetailRepository,
        ProductVoteRepository $productVoteRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->productDetailRepository = $productDetailRepository;
        $this->productVoteRepositoty = $productVoteRepository;
    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);
        $relateProducts = $this->productRepository->getRelateProduct($id);
        return view('front.product', compact('product', 'relateProducts'));
    }

    public function addVote(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->productVoteRepositoty->updateOrCreate([
                'product_id' => $request->product_id,
                'name' => $request->name,
                'email' => $request->email,
                'rate' => $request->rate,
                'content' => $request->content
            ]);
            $rateAvg = $this->productVoteRepositoty->getRateAvg($request->product_id);
            $product = $this->productRepository->find($request->product_id);
            $product->rate = $rateAvg;
            $product->save();
            DB::commit();
            return redirect()->back()->with('message', 'Cảm ơn bạn đã gửi đánh giá sản phẩm này');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('message', $e->getMessage());
        }
        
    }

}
