
@extends('front.layout.base')

@section('page_class', 'page-template belle')

@section('scripts')
    <script>
        // delete cart item
        $('.cart__remove').on('click', function () {
            if(!confirm('Bạn có muốn xóa sản phẩm này ?')) {
                return false;
            }
            var cartItem = $(this);
            var rowId = $(this).attr('rowId');

            $.ajax({
                type: "post",
                url: "/deleteCart/" + rowId,
                dataType: "json",
                success: function (response) {
                    if(response.status != 1) {
                        alert(response.message);
                    } else {
                        cartItem.closest('tr').remove();
                        $('#CartCount').text(response.cartCount);             
                        $('.money').text(response.subTotal);
                    }
                }
            });
        });
        // plus, minus item qty
        $(".qtyBtn").on("click", function() {
            var qtyField = $(this).parent(".qtyField"),
                oldValue = $(qtyField).find(".qty").val(),
                newVal = 1,
                max = $(qtyField).find(".qty").attr('max'),
                id = $(qtyField).attr('product_id'),
                rowId = $(qtyField).attr('rowId');
            if ($(this).is(".plus")) {
                if(parseInt(oldValue) < parseInt(max)) {
                    newVal = parseInt(oldValue) + 1;
                } else {
                    newVal = parseInt(max);
                }      
            } else if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            }
            
            $.ajax({
                type: "post",
                url: "/updateCart",
                data: {
                    id : id,
                    rowId : rowId,
                    quantity : newVal
                },
                dataType: "json",
                success: function (response) {
                    if(response.status != 1) {
                        alert(response.message);
                    } else {
                        $(qtyField).find(".qty").val(newVal);
                        $('#CartCount').text(response.cartCount);             
                        $('.money').text(response.subTotal);
                    }
                }
            });
        });
    </script>
@endsection

@section('content')
    <!--Page Title-->
<div class="page section-header text-center">
    <div class="page-title">
        <div class="wrapper"><h1 class="page-width">Giỏ hàng</h1></div>
      </div>
</div>
<!--End Page Title-->

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 main-col">
            <form action="#" method="post" class="cart style2">
                <table>
                    <thead class="cart__row cart__header">
                        <tr>
                            <th colspan="2" class="text-center">Sản phẩm</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-right">Tổng tiền</th>
                            <th class="action">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $key => $cartItem)
                            <tr class="cart__row border-bottom line1 cart-flex border-top">
                                <td class="cart__image-wrapper cart-flex-item">
                                    <a href="#"><img class="cart__image" src="{{$cartItem->options->image}}" alt="Elastic Waist Dress - Navy / Small"></a>
                                </td>
                                <td class="cart__meta small--text-left cart-flex-item">
                                    <div class="list-view-item__title">
                                        <a href="#">{{$cartItem->name}} </a>
                                    </div>
                                    
                                    <div class="cart__meta-text">
                                        Color: {{$cartItem->options->color}}
                                    </div>
                                </td>
                                <td class="cart__price-wrapper cart-flex-item">
                                    <span class="money">{{ number_format($cartItem->price,0,',','.') }}</span>
                                </td>
                                <td class="cart__update-wrapper cart-flex-item text-right">
                                    <div class="cart__qty text-center">
                                        <div class="qtyField" rowId={{$cartItem->rowId}} product_id="{{$cartItem->id}}">
                                            <a class="qtyBtn minus" href="javascript:void(0);"><i class="icon icon-minus"></i></a>
                                            <input class="cart__qty-input qty" type="text" name="updates[]" id="qty" value="{{$cartItem->qty}}" pattern="[0-9]*" disabled max="{{$cartItem->options->max}}">
                                            <a class="qtyBtn plus" href="javascript:void(0);"><i class="icon icon-plus"></i></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right small--hide cart-price">
                                    <div><span class="money">{{ number_format($cartItem->subtotal,0,',','.') }}</span></div>
                                </td>
                                <td class="text-center small--hide"><a href="#" class="btn btn--secondary cart__remove" title="Remove tem" rowId={{$cartItem->rowId}}><i class="icon icon anm anm-times-l"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-left"><a href="http://annimexweb.com/" class="btn--link cart-continue"><i class="icon icon-arrow-circle-left"></i> Tiếp tục mua hàng</a></td>
                        </tr>
                    </tfoot>
                </table>
            </form>                   
           </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 cart__footer">
            <div class="solid-border">
              <div class="row">
                  <span class="col-12 col-sm-6 cart__subtotal-title"><strong>Thành tiền</strong></span>
                <span class="col-12 col-sm-6 cart__subtotal-title cart__subtotal text-right"><span class="money">{{ Cart::subtotal() }}</span></span>
              </div>
              <div class="cart__shipping"></div>
              <form action="/checkout" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="buy_method" value="2">
                <input type="submit" name="checkout" id="cartCheckout" class="btn btn--small-wide checkout" value="Thanh toán">
              </form>
              <div class="paymnet-img"><img src="assets/images/payment-img.jpg" alt="Payment"></div>
            </div>
        </div>
    </div>
</div>
@endsection

