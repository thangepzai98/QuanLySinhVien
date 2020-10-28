@extends('front.layout.base')

@section('page_class', 'template-product belle')

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/plugins/lightSlider/src/css/lightslider.css') }}" /> 
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/plugins/lightGallery/src/css/lightgallery.css') }}" /> 
    <style>
        .product-form__item > .color.active > label {
            border: solid 2px black !important;
        }

        .spr-form {
            margin: 0;
            padding: 0;
            border-top: none;
        }

        .rating {
            font-size: 30px;
            color: #ff9500;
        }

        .productPageSlider .item {
            border: none;
        }

    </style>
@endsection

@section('scripts')
    <script src="{{ asset('front/assets/plugins/lightGallery/src/js/lightgallery.js') }}"></script> 
    <script src="{{ asset('front/assets/plugins/lightSlider/src/js/lightslider.js') }}"></script> 
    <script src="{{ asset('front/assets/plugins/rater-master/rater.js') }}"></script>
    <script>
        $(document).ready(function() {
            if ($('.product-form__item > .color.active').attr('can_buy') == 0) {
                $('#quantity').val(0);
                $('#add_to_cart').prop('disabled', true);
                $('#buy_now').prop('disabled', true);
                $('.outstock').removeClass('hide');
                $('.instock').addClass('hide');
            } else {
                $('.outstock').addClass('hide');
                $('.instock').removeClass('hide');
            }
            
            // select product color
            $('.product-form__item > .color').on('click', function () {
                var key = $(this).attr('key');
                var can_buy = $(this).attr('can_buy');
                var quantity = $(this).attr('quantity');
                $('#quantity').attr('max', quantity);
                $('#imageGallery > li').css('display', 'none');
                $('#image_gallery_' + key).css('display', 'block');

                if($(this).hasClass('active') == false) {
                    $('.product-form__item > .color').removeClass('active');
                    $(this).addClass('active');
                    $('.product-single__price').css('display', 'none');
                    $('#box_price_' + key).css('display', 'block');
                }
                if(can_buy == 0) {
                    $('#quantity').val(0);
                    $('#add_to_cart').prop('disabled', true);
                    $('#buy_now').prop('disabled', true);
                    $('.outstock').removeClass('hide');
                    $('.instock').addClass('hide');
                } else {
                    $('#quantity').val(1);
                    $('#add_to_cart').prop('disabled', false);
                    $('#buy_now').prop('disabled', false);
                    $('.outstock').addClass('hide');
                    $('.instock').removeClass('hide');
                }
            });

            // add to cart
            $('#add_to_cart').on('click', function () {
                var id = $('.product-form__item > .color.active').attr('product_detail_id');
                var quantity = $('#quantity').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "/addToCart",
                    data: {
                        id : id,
                        quantity : quantity
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 0) {
                            alert(response.message);
                        } else {
                            alert(response.message);
                            $('#quantity').val(1);
                            $('#CartCount').text(response.cartCount);
                        }
                    }
                });
            });

            //buy now
            $('#buy_now').on('click', function () {
                var id = $('.product-form__item > .color.active').attr('product_detail_id');
                var quantity = $('#quantity').val();
                var parent = $(this).parent();
                parent.find('input[name="id"]').val(id);
                parent.find('input[name="quantity"]').val(quantity);
            });


            // plus, minus item qty
            $(".qtyBtn").on("click", function() {
                var oldValue = $("#quantity").val(),
                    newVal = 1,
                    max = $(".product-form__item > .color.active").attr('quantity');
                if ($(this).is(".plus")) {
                    if(parseInt(oldValue) < parseInt(max)) {
                        newVal = parseInt(oldValue) + 1;
                    } else {
                        newVal = parseInt(max);
                    }      
                } else if (oldValue > 1) {
                    newVal = parseInt(oldValue) - 1;
                }
                $("#quantity").val(newVal);
            });

            //rate
            $(".rating").rate();

            //form vote
            $('#new-review-form').submit(function (e) { 
               $(this).find('input[name="rate"]').val($(".rating").rate('getValue'));
            });

            @if (session('message'))
                alert('{{session('message')}}');
            @endif
        });
    </script>
@endsection

@section('content')
<!--MainContent-->
<div id="MainContent" class="main-content" role="main">
    <!--Breadcrumb-->
    <div class="bredcrumbWrap">
        <div class="container breadcrumbs">
            <a href="index.html" title="Back to the home page">Trang chủ</a><span aria-hidden="true">›</span><span>{{$product->name}}</span>
        </div>
    </div>
    <!--End Breadcrumb-->
    
    <div id="ProductSection-product-template" class="product-template__container prstyle1 container">
        <!--product-single-->
        <div class="product-single">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="product-details-img">
                            <ul id="imageGallery">
                                @foreach ($product->product_details as $key => $product_detail)
                                    <li data-thumb="{{$product_detail->image}}" data-src="{{$product_detail->image}}" id="image_gallery_{{$key}}" style="{{ $key == 0 ? 'display:block' : 'display:none' }}">
                                        <img src="{{$product_detail->image}}"  style="height: 540px;"/>
                                    </li>
                                @endforeach
                            </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="product-single__meta">
                            <h1 class="product-single__title">{{$product->name}}</h1>
                            <div class="product-nav clearfix">					
                                <a href="#" class="next" title="Next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                            <div class="prInfoRow">
                                <div class="product-stock"><span class="instock">Còn hàng</span> <span class="outstock">Hết hàng</span> 
                            </div>
                            <div class="product-sku">Mã sản phẩm: <span class="variant-sku">{{$product->sku_code}}</span></div>
                                <div class="product-review">
                                    <a class="reviewLink" href="#tab2">
                                        {!! CommonFunctions::getStartVote($product->rate) !!}
                                        <span class="spr-badge-caption">{{count($product->product_votes)}} đánh giá</span></a></div>
                            </div>
                            @foreach ($product->product_details as $key => $product_detail)
                                @if ($key == 0)
                                    <p id="box_price_{{$key}}" class="product-single__price product-single__price-product-template" style="display: block;">
                                @else
                                    <p id="box_price_{{$key}}" class="product-single__price product-single__price-product-template" style="display: none;">
                                @endif

                                @if ($product_detail->promotion_price != null && $product_detail->promotion_start_date <= date('Y-m-d') && $product_detail->promotion_end_date >= date('Y-m-d'))
                                    <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                        <span id="ProductPrice-product-template"><span class="money">{{ number_format($product_detail->promotion_price,0,',','.') }} đ</span></span> 
                                    </span>
                                    <s id="ComparePrice-product-template"><span class="money">{{ number_format($product_detail->sale_price,0,',','.') }}</span></s>
                                    <span class="discount-badge"> <span class="devider">|</span>&nbsp;
                                        <span>Giảm</span>
                                        <span id="SaveAmount-product-template" class="product-single__save-amount">
                                        <span class="money">{{ number_format($product_detail->sale_price - $product_detail->promotion_price, 0, ',', '.') }} đ</span>
                                        </span>
                                    </span>
                                @else
                                    <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                        <span id="ProductPrice-product-template"><span class="money">{{ number_format($product_detail->sale_price,0,',','.') }} đ</span></span> 
                                    </span>
                                @endif
                                </p>
                            @endforeach
                            
                        <div class="product-single__description rte">
                            {!!$product->introduction !!}
                        </div>
                        <form method="post" action="/checkout" id="" accept-charset="UTF-8" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                            <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                <div class="product-form__item">
                                  <label class="header">Màu sắc: </label>
                                  @foreach ($product->product_details as $key => $product_detail)
                                    <div data-value="{{$product_detail->color}}" class="{{ $key == 0 ? 'active' : '' }} swatch-element color {{$product_detail->color}} available" product_detail_id="{{ $product_detail->id }}" key="{{ $key }}" can_buy="{{ $product_detail->quantity > 0 ? '1' : '0'}}" quantity="{{ $product_detail->quantity }}">
                                        <input class="swatchInput" id="swatch-0-{{$product_detail->color}}" type="radio" name="option-{{$key}}" value="{{$product_detail->color}}">
                                        <label class="swatchLbl color medium rectangle" for="" style="background-image:url({{$product_detail->image}});" title="{{$product_detail->color}}"></label>
                                    </div>
                                  @endforeach
                                </div>
                            </div>
                            <!-- Product Action -->
                            <div class="product-action clearfix">
                                <div class="product-form__item--quantity">
                                    <div class="wrapQtyBtn">
                                        <div class="qtyField">
                                            <a class="qtyBtn minus" href="javascript:void(0);" id="minus"><i class="fa anm anm-minus-r" aria-hidden="true"></i></a>
                                            <input type="text" id="quantity" value="{{$product->product_details[0]->quantity <= 0 ? 0 : 1 }}" class="product-form__input qty" min="0" max="{{ $product->product_details[0]->quantity }}" disabled>
                                            <a class="qtyBtn plus" href="javascript:void(0);" id="plus"><i class="fa anm anm-plus-r" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>                                
                                <div class="product-form__item--submit">
                                    <button type="button" name="add" class="btn product-form__cart-submit" id="add_to_cart">
                                        <span>Thêm vào giỏ</span>
                                    </button>
                                </div>
                                <div class="shopify-payment-button" data-shopify="payment-button">
                                    <input type="hidden" name="id">
                                    <input type="hidden" name="quantity">
                                    <input type="hidden" name="buy_method" value="1">
                                    <button type="submit" class="shopify-payment-button__button shopify-payment-button__button--unbranded" id="buy_now">Mua ngay</button>
                                </div>
                            </div>
                            <!-- End Product Action -->
                        </form>
                        <div class="display-table shareRow">
                                <div class="display-table-cell medium-up--one-third">
                                </div>
                                <div class="display-table-cell text-right">
                                    <div class="fb-like" data-href="http://thangmobile.com/product/{{$product->id}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                                </div>
                            </div>
                            
                        <p id="freeShipMsg" class="freeShipMsg" data-price="199"><i class="fa fa-truck" aria-hidden="true"></i>Giao hàng tận nơi trong 30 phút</p>
                        <div class="userViewMsg" data-user="20" data-time="11000"><i class="fa fa-users" aria-hidden="true"></i> <strong class="uersView">14</strong> Người đã xem sản phẩm này</div>
                    </div>
            </div>
        </div>
        <!--End-product-single-->
        <!--Product Tabs-->
        <div class="tabs-listing">
            <ul class="product-tabs">
                <li rel="tab1"><a class="tablink">Chi tiết sản phẩm</a></li>
                <li rel="tab2"><a class="tablink">Đánh giá và nhận xét</a></li>
            </ul>
            <div class="tab-container">
                <div id="tab1" class="tab-content">
                    {!!$product->details!!}
                </div>          
                <div id="tab2" class="tab-content"> 
                    <div id="shopify-product-reviews">
                        <div class="spr-container">
                            <div class="spr-content">
                                <div class="spr-form clearfix">
                                    <form method="post" action="/addProductVote" id="new-review-form" class="new-review-form">
                                        <h3 class="spr-form-title">Đánh giá sản phẩm</h3>
                                        <fieldset class="spr-form-review">
                                        <div class="spr-form-contact-name">
                                            <label class="spr-form-label" for="review_author_10508262282">Họ và Tên</label>
                                            <input class="spr-form-input spr-form-input-text " id="review_author_10508262282" type="text" name="name" value="" >
                                        </div>
                                        <div class="spr-form-contact-email">
                                            <label class="spr-form-label" for="review_email_10508262282">Email</label>
                                            <input class="spr-form-input spr-form-input-email " id="review_email_10508262282" type="email" name="email" value="">
                                        </div>
                                        <div class="rating"></div>
                                        <input type="hidden" name="rate">
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                          <div class="spr-form-review-body">
                                            <div class="spr-form-input">
                                              <textarea class="spr-form-input spr-form-input-textarea " id="review_body_10508262282" data-product-id="10508262282" name="content" rows="10" placeholder="Mời bạn để lại bình luận"></textarea>
                                            </div>
                                          </div>
                                        </fieldset>
                                        <fieldset class="spr-form-actions">
                                            <input type="submit" class="spr-button spr-button-primary button button-primary btn btn-primary" value="Gửi đánh giá">
                                        </fieldset>
                                    </form>
                                </div>
                                <div class="spr-reviews">
                                   @foreach ($product->product_votes as $product_vote)
                                    <div class="spr-review">
                                        <div class="spr-review-header">
                                            <span class="product-review spr-starratings spr-review-header-starratings"><span class="reviewLink"><i class="fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i></span></span>
                                            <h4 class="spr-review-header-title">{{ $product_vote->name }}</h4>
                                            <span class="spr-review-header-byline"><strong>{{ date_format($product_vote->created_at, 'd/m/Y') }}</strong></span>
                                        </div>
                                        <div class="spr-review-content">
                                            <p class="spr-review-content-body">{{ $product_vote->content }}</p>
                                        </div>
                                    </div>
                                   @endforeach
                                </div>
                            </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!--End Product Tabs-->
        <!--Related Product Slider-->
        <div class="related-product grid-products">
            <header class="section-header">
                <h2 class="section-header__title text-center h2"><span>Sản phẩm liên quan</span></h2>
            </header>
            <div class="productPageSlider">
                @foreach ($relateProducts as $product)
                <div class="col-12 item">
                    <!-- start product image -->
                    <div class="product-image">
                        <!-- start product image -->
                        <a href="/product/{{$product->id}}">
                            <!-- image -->
                            <img class=" blur-up lazyload"  src="{{ $product->image }}" alt="image" title="product" />
                            <!-- End image -->
                            <!-- product label -->
                            {!! CommonFunctions::getPromotionPercent($product->product_detail->sale_price, $product->product_detail->promotion_price, $product->product_detail->promotion_start_date, $product->product_detail->promotion_end_date) !!}
                            <!-- End product label -->
                        </a>
                        <!-- end product image -->
                    </div>
                    <!-- end product image -->
                    <!--start product details -->
                    <div class="product-details text-center">
                        <!-- product name -->
                        <div class="product-name">
                            <a href="/product/{{$product->id}}">{{$product->name}}</a>
                        </div>
                        <!-- End product name -->
                        <!-- product price -->
                        <div class="product-price">
                                {!!CommonFunctions::getRealPrice($product->product_detail->sale_price, $product->product_detail->promotion_price, $product->product_detail->promotion_start_date, $product->product_detail->promotion_end_date)!!}
                        </div>
                        <!-- End product price -->
                        
                        <div class="product-review">
                            {!! CommonFunctions::getStartVote($product->rate) !!}
                        </div>
                    </div>
                    <!-- End product details -->
                </div>
                @endforeach
            </div>
            </div>
        <!--End Related Product Slider-->
    <!--#ProductSection-product-template-->
</div>
<!--MainContent-->
@endsection