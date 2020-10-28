<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Repositories\Contracts\ProductDetailRepository;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\OrderDetailRepository;
use Illuminate\Support\Facades\DB;
use App\Helpers\CommonFunctions;
use Cart;
use App\Models\User;

class CheckoutController extends Controller
{

    protected $productDetailRepository;
    protected $orderRepository;
    protected $orderDetailRepository;

    public function __construct(
        ProductDetailRepository $productDetailRepository,
        OrderRepository $orderRepository,
        OrderDetailRepository $orderDetailRepository
    )
    {
        $this->productDetailRepository = $productDetailRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function showCheckout(Request $request)
    {
        if(!Auth::check()) {
            return redirect('/login');
        } 

        $buy_method = $request->buy_method;
        
        if($request->has('buy_method') && $buy_method == Config::get('constants.BUY_METHOD.BUY_NOW')) {
            if($this->productDetailRepository->count(['id' => $request->id]) > 0) {
                $product_detail = $this->productDetailRepository->find($request->id);
            } else {
                return redirect()->back()->with('message', 'Sản phẩm không tồn tại');
            }
            if($product_detail->quantity <= 0) {
                return redirect()->back()->with('message', 'Sản phẩm này đã hết hàng');
            }
            if($request->quantity > $product_detail->quantity) {
                return redirect()->back()->with('message', 'Số lượng sản phẩm vượt quá số lượng trong kho');
            }
            
            $id = $product_detail->id;
            $name = $product_detail->product->name;
            $quantity =  $request->quantity;
            $price = $product_detail->sale_price;
            $color = $product_detail->color;
            $image = $product_detail->image;
            $cart = Cart::add($id, $name, $quantity, $price, ['color' => $color, 'image' => $image]);
            $subTotal = Cart::subtotal();
            Cart::remove($cart->rowId);
            return view('front.checkout', compact('cart', 'subTotal', 'buy_method'));
        } else if($request->has('buy_method') && $buy_method == Config::get('constants.BUY_METHOD.BUY_CART')) {
            $cart = Cart::content();
            $subTotal = Cart::subtotal();
            return view('front.checkout', compact('cart', 'subTotal', 'buy_method'));
        }
    }

    public function payment(Request $request)
    {
        if($request->payment_method == Config::get('constants.PAYMENT_METHOD.OFFLINE')) {
            if($request->buy_method == Config::get('constants.BUY_METHOD.BUY_NOW')) {
                try {
                    DB::beginTransaction();
                    $order = $this->orderRepository->create([
                        'user_id' => Auth::id(),
                        'payment_method' => $request->payment_method,
                        'order_code' => 'JAV'. str_pad(rand(0, pow(10, 5) - 1), 5, '0', STR_PAD_LEFT),
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'status' => Config::get('constants.STATUS.ACTIVE')
                    ]);
                    $this->orderDetailRepository->create([
                        'order_id' => $order->id,
                        'product_detail_id' => $request->product_id,
                        'quantity' => $request->quantity,
                        'price' => $request->price
                    ]);
                    $quantity = $this->productDetailRepository->find($request->product_id)->quantity - $request->quantity;
                    $this->productDetailRepository->update([
                        'quantity' => $quantity 
                    ], $request->product_id);
                    DB::commit();
                    // $invoice = $this->orderRepository->getOrderDetail($order->id);
                    // $user = User::find(Auth::id());
                    // $user->sendInvoiceNotification($invoice);
                    return redirect('/')->with('message', 'Mua hàng thành công!');
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect('/')->with('message', 'Có lỗi xảy ra, vui lòng thử lại!');
                } 
            } else if($request->buy_method == Config::get('constants.BUY_METHOD.BUY_CART')) {
                $cart = Cart::content();
                try {
                    DB::beginTransaction();
                    $order = $this->orderRepository->create([
                        'user_id' => Auth::id(),
                        'payment_method' => $request->payment_method,
                        'order_code' => 'JAV'. str_pad(rand(0, pow(10, 5) - 1), 5, '0', STR_PAD_LEFT),
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'status' => Config::get('constants.STATUS.ACTIVE')
                    ]);
                    foreach($cart as $cartItem) {
                        $this->orderDetailRepository->create([
                            'order_id' => $order->id,
                            'product_detail_id' => $cartItem->id,
                            'quantity' => $cartItem->qty,
                            'price' => $cartItem->price
                        ]);
                        $quantity = $this->productDetailRepository->find($cartItem->id)->quantity - $cartItem->qty;
                        $this->productDetailRepository->update([
                            'quantity' => $quantity 
                        ], $cartItem->id);
                    }
                    Cart::destroy();
                    DB::commit();
                    return redirect('/')->with('message', 'Mua hàng thành công!');
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect('/')->with('message', 'Có lỗi xảy ra, vui lòng thử lại!');
                }
            }
        } else if($request->payment_method == Config::get('constants.PAYMENT_METHOD.ONLINE')) {
            if($request->buy_method == Config::get('constants.BUY_METHOD.BUY_NOW')) {
                try {
                    DB::beginTransaction();
                    $order = $this->orderRepository->create([
                        'user_id' => Auth::id(),
                        'payment_method' => $request->payment_method,
                        'order_code' => 'JAV'. str_pad(rand(0, pow(10, 5) - 1), 5, '0', STR_PAD_LEFT),
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'status' => Config::get('constants.STATUS.INACTIVE')
                    ]);
                    $this->orderDetailRepository->create([
                        'order_id' => $order->id,
                        'product_detail_id' => $request->product_id,
                        'quantity' => $request->quantity,
                        'price' => $request->price
                    ]);
                    DB::commit();
                    $response = \VNPay::purchase([
                        'vnp_TxnRef' => $order->order_code,
                        'vnp_OrderType' => 	110000,
                        'vnp_OrderInfo' => "Thanh toán hóa đơn phí dich vụ",
                        'vnp_IpAddr' => request()->ip(),
                        'vnp_Amount' => $request->price * 100,
                        'vnp_ReturnUrl' => env('APP_URL') . '/responsePayment',
                    ])->send();           
                    if ($response->isRedirect()) {
                        $redirectUrl = $response->getRedirectUrl();
                        return redirect()->away($redirectUrl);
                    }
                } catch(\Exception $e) {
                    DB::rollBack();
                    return redirect('/')->with('message', $e->getMessage());
                }
            }
            else if($request->buy_method == Config::get('constants.BUY_METHOD.BUY_CART')) {
                $cart = Cart::content();
                try {
                    DB::beginTransaction();
                    $order = $this->orderRepository->create([
                        'user_id' => Auth::id(),
                        'payment_method' => $request->payment_method,
                        'order_code' => 'JAV'. str_pad(rand(0, pow(10, 5) - 1), 5, '0', STR_PAD_LEFT),
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'status' => Config::get('constants.STATUS.INACTIVE')
                    ]);
                    foreach($cart as $cartItem) {
                        $this->orderDetailRepository->create([
                            'order_id' => $order->id,
                            'product_detail_id' => $cartItem->id,
                            'quantity' => $cartItem->qty,
                            'price' => $cartItem->price
                        ]);
                    }
                    DB::commit();
                    $total = str_replace('.', '', Cart::subtotal());
                    $response = \VNPay::purchase([
                        'vnp_TxnRef' => $order->order_code,
                        'vnp_OrderType' => 	110000,
                        'vnp_OrderInfo' => "Thanh toán hóa đơn phí dich vụ",
                        'vnp_IpAddr' => request()->ip(),
                        'vnp_Amount' =>  $total * 100, 
                        'vnp_ReturnUrl' => env('APP_URL') . '/responsePayment',
                    ])->send();           
                    if ($response->isRedirect()) {
                        Cart::destroy();
                        $redirectUrl = $response->getRedirectUrl();
                        return redirect()->away($redirectUrl);
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect('/')->with('message', $e->getMessage());
                }
            }
        }
    }

    public function responsePayment() 
    {
        $message = 'Có lỗi xảy ra, vui lòng thử lại!';
        $response = \VNPay::completePurchase()->send();
        if ($response->isSuccessful()) {
            if(CommonFunctions::verifyPayment($response->getData())) {
                try {
                    $order_code = $response->getData()['vnp_TxnRef'];
                    $order = $this->orderRepository->firstWhere(['order_code' => $order_code]);
                    DB::beginTransaction();
                    $this->orderRepository->update([
                        'status' => Config::get('constants.STATUS.ACTIVE')
                    ], $order->id);
                    foreach($order->order_details as $order_detail) {
                        $quantity = $this->productDetailRepository->find($order_detail->product_detail_id)->quantity - $order_detail->quantity;
                        $this->productDetailRepository->update([
                            'quantity' => $quantity 
                        ], $order_detail->product_detail_id);
                    }
                    DB::commit();
                    $message = 'Thanh toán thành công!';
                } catch(\Exception $e) {
                    DB::rollBack();
                }
            }
        }
        return redirect('/')->with('message', $message);
    }
}
