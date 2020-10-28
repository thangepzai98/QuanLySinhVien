@extends('front.layout.base')


@section('styles')
    <style>
        .error {
            color: red;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{ asset('front/assets/plugins/jquery-validate/jquery.validate.min.js') }}"></script> 
    <script>
        $(document).ready(function () {
            jQuery.validator.addMethod("phone", function (value, element) {
                if (/((09|03|07|08|05)+([0-9]{8})\b)/g.test(value)) {
                    return true;
                } else {
                    return false;
                };
            }, "Số điện thoại không hợp lệ");

            // $('#formCheckout').validate({
            //     highlight: function(element) {
            //         $(element).removeClass("error");
            //     },
            //     rules: { 
            //         name: {
            //             required: true,
            //             minlength: 8,
            //         },
            //         phone: {
            //             required: true,
            //             minlength: 10,
            //             phone: true
            //         },
            //         email: {
            //             required: true,
            //             email: true,
            //         },
            //         address: {
            //             required: true,
            //             minlength: 10
            //         }
            //     },
            //     messages: {
            //         name: {
            //             required: "Vui lòng nhập họ tên.",
            //             minlength: "Họ tên ít nhất 8 ký tự."
            //         },
            //         email: {
            //             required: "Vui lòng nhập email.",
            //             email: "Đinh dạng email không đúng, vd: name@domain.com.",
            //         },
            //         phone: {
            //             required: "Vui lòng nhập số điện thoại.",
            //             minlength: "Số điện thoại ít nhất 10 số."
            //         },
            //         address: {
            //             required: "Vui lòng nhập địa chỉ nhận hàng.",
            //             minlength: "Địa chỉ ít nhất 10 ký tự."
            //         }
            //     }
            // });

            $('#btnOrder').on('click', function () {
                var payment_method = $('#payment_method').val();
                $('#formCheckout').find('input[name="payment_method"]').val(payment_method);
                $('#formCheckout').submit();
            });
        });
    </script>
@endsection

@section('content')
<!--Page Title-->
<div class="page section-header text-center">
    <div class="page-title">
        <div class="wrapper"><h1 class="page-width">Thanh toán</h1></div>
      </div>
</div>
<!--End Page Title-->

<div class="container">
   
    <div class="row billing-fields">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 sm-margin-30px-bottom">
            <div class="create-ac-content bg-light-gray padding-20px-all">
                <form method="post" action="/payment" id="formCheckout">
                    {{ csrf_field() }}
                    <input type="hidden" name="buy_method" value="{{ $buy_method }}">
                    <input type="hidden" name="payment_method" value="">
                    @if ($buy_method == 1)
                        <input type="hidden" name="product_id" value="{{ $cart->id }}">
                        <input type="hidden" name="quantity" value="{{ $cart->qty }}">
                        <input type="hidden" name="price" value="{{ $cart->price }}">
                    @endif     
                    <fieldset>
                        <h2 class="login-title mb-3">Thông tin mua hàng</h2>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="input-firstname">Họ tên <span class="required-f">*</span></label>
                                <input name="name" value="" id="input-firstname" type="text" >
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="input-telephone">Số điện thoại <span class="required-f">*</span></label>
                                <input name="phone" value="" id="input-telephone" type="tel">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="input-email">E-Mail <span class="required-f">*</span></label>
                                <input name="email" value="" id="input-email" type="email">
                            </div>
                            <div class="form-group col-md-6 col-lg-6 col-xl-6 required">
                                <label for="input-address-1">Địa chỉ <span class="required-f">*</span></label>
                                <input name="address" value="" id="input-address-1" type="text">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="row">
                            <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                <label for="input-company">Ghi chú</label>
                                <textarea class="form-control resize-both" rows="3" name="note"></textarea>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
            <div class="your-order-payment">
                <div class="your-order">
                    <h2 class="order-title mb-4">Đơn hàng của bạn</h2>

                    <div class="table-responsive-sm order-table"> 
                        <table class="bg-white table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th class="text-left">Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Màu sắc</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($buy_method == 1)
                                    <tr>
                                        <td class="text-left">{{ $cart->name }}</td>
                                        <td>{{ number_format($cart->price,0,',','.') }}</td>
                                        <td>{{ $cart->options->color }}</td>
                                        <td>{{ $cart->qty }}</td>
                                        <td>{{ number_format($cart->subtotal,0,',','.') }}</td>
                                    </tr>
                                @else
                                    @foreach ($cart as $cartItem)
                                        <tr>
                                            <td class="text-left">{{ $cartItem->name }}</td>
                                            <td>{{ number_format($cartItem->price,0,',','.') }}</td>
                                            <td>{{ $cartItem->options->color }}</td>
                                            <td>{{ $cartItem->qty }}</td>
                                            <td>{{ number_format($cartItem->subtotal,0,',','.') }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot class="font-weight-600">
                                <tr>
                                    <td colspan="4" class="text-right">Thành tiền</td>
                                    <td>{{ $subTotal }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <hr />

                <div class="your-payment">
                    <h2 class="payment-title mb-3">Phương thức thanh toán</h2>
                    <div class="payment-method">
                        <div class="payment-accordion">
                            <select id="payment_method" class="form-control">
                                <option value="1">Thanh toán khi nhận hàng</option>
                                <option value="2">Thanh toán online (VNPAY)</option>
                            </select>
                        </div>

                        <div class="order-button-payment">
                            <button class="btn" value="Place order" type="submit" id="btnOrder">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection