<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Contracts\ProductDetailRepository;
use Cart;

class CartController extends Controller
{
    protected $productDetailRepository;

    public function __construct(
        ProductDetailRepository $productDetailRepository
    )
    {
        $this->productDetailRepository = $productDetailRepository;
    }

    public function index()
    {
        $cart = Cart::content();
        return view('front.cart', compact('cart'));
    }

    public function addCart(Request $request)
    {
        $jsonFormat = array();
        $jsonFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'quantity'  => 'required|numeric'
        ]);

        if ($validator->fails()) {
            $jsonFormat['message'] = $validator->errors()->first();
            return response()->json($jsonFormat);
        }
        
        if($this->productDetailRepository->count(['id' => $request->id]) > 0) {
            $product_detail = $this->productDetailRepository->find($request->id);
        } else {
            $jsonFormat['message'] = 'Sản phẩm không tồn tại';
            return response()->json($jsonFormat);
        }
        if($product_detail->quantity <= 0) {
            $jsonFormat['message'] = 'Sản phẩm này đã hết hàng';
            return response()->json($jsonFormat);
        }
        if($request->quantity > $product_detail->quantity) {
            $jsonFormat['message'] = 'Số lượng sản phẩm vượt quá số lượng trong kho';
            return response()->json($jsonFormat);
        }

        try {
            $id = $product_detail->id;
            $name = $product_detail->product->name;
            $quantity =  $request->quantity;
            $max = $product_detail->quantity;
            $price = $product_detail->sale_price;
            $color = $product_detail->color;
            $image = $product_detail->image;
            if($product_detail->promotion_start_date <= date('Y-m-d') && $product_detail->promotion_end_date >= date('Y-m-d')) {
                $price = $product_detail->promotion_price;
            }
            $cart = Cart::add($id, $name, $quantity, $price, ['color' => $color, 'image' => $image, 'max' => $max]);
            $jsonFormat['status']  = Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['message'] = 'Thêm giỏ hàng thành công';
            $jsonFormat['data'] = $cart;
            $jsonFormat['cartCount'] = Cart::count();
        } catch (\Exception $e) {
            $jsonFormat['message'] = 'Có lỗi xảy ra';
        }
        return response()->json($jsonFormat);
    }

    public function deleteCart($rowId)
    {
        $jsonFormat = array();
        $jsonFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        try {
            Cart::remove($rowId);
            $jsonFormat['cartCount'] = Cart::count();
            $jsonFormat['subTotal'] = Cart::subtotal();
            $jsonFormat['status']  = Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['message'] = 'Thêm giỏ hàng thành công';
        } catch (\Exception $e) {
            $jsonFormat['message'] = 'Có lỗi xảy ra';
        }
        return response()->json($jsonFormat);
    }

    public function updateCart(Request $request)
    {
        $jsonFormat = array();
        $jsonFormat['status'] = Config::get('constants.STATUS.INACTIVE');
        $rowId = $request->rowId;
        $quantity = $request->quantity;
        $id = $request->id;

        if($this->productDetailRepository->count(['id' => $id]) > 0) {
            $product_detail = $this->productDetailRepository->find($id);
        } else {
            $jsonFormat['message'] = 'Sản phẩm không tồn tại';
            return response()->json($jsonFormat);
        }
        if($product_detail->quantity <= 0) {
            $jsonFormat['message'] = 'Sản phẩm này đã hết hàng';
            return response()->json($jsonFormat);
        }
        if($quantity > $product_detail->quantity) {
            $jsonFormat['message'] = 'Số lượng sản phẩm vượt quá số lượng trong kho';
            return response()->json($jsonFormat);
        }
        if($quantity >  $product_detail->quantity) {
            $jsonFormat['message'] = 'Số lượng sản phẩm vượt quá số lượng trong kho';
            return response()->json($jsonFormat);
        }

        try {
            Cart::update($rowId, $quantity);
            $jsonFormat['cartCount'] = Cart::count();
            $jsonFormat['subTotal'] = Cart::subtotal();
            $jsonFormat['status']  = Config::get('constants.STATUS.ACTIVE');
            $jsonFormat['message'] = 'Cập nhật số lượng thành công';
        } catch (\Exception $e) {
            $jsonFormat['message'] = 'Có lỗi xảy ra';
        }
        return response()->json($jsonFormat);
    }
}
