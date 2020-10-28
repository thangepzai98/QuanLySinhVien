@extends('front.layout.base')

@section('page_class', 'template-collection belle')

@section('content')
<div class="container">
    <div class="row">
        @if (count($products) < 1)
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">	
                <div class="empty-page-content text-center">
                    <h1>Không tìm thấy sản phẩm !!!</h1>
                </div>
            </div>
        @endif
        <!--Main Content-->
        <div class="product-rows section main-col shop-grid-5">
            <div class="productList">
                <!--End Toolbar-->
                <div class="grid-products grid--view-items">
                    <div class="row product-list">
                        @foreach ($products as $product)
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 item product-box">
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
            </div>
        </div>
        <!--End Main Content-->
    </div>
</div>
@endsection