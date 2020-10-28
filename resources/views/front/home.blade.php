@extends('front.layout.base')
@section('page_class', 'template-index home2-default')

@section('content')
    <!--Home slider-->
    <div class="slideshow slideshow-wrapper pb-section">
        <div class="home-slideshow">
            @foreach ($sliders as $slider)
                <div class="slide">
                    <div class="blur-up lazyload">
                        <a class="link" href="{{ $slider->link }}" target="_blank"><img class="blur-up lazyload" data-src="{{$slider->image}}" src="{{$slider->image}}" /></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--End Home slider-->
    <!--Weekly Bestseller-->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Sản phẩm được ưu thích</h2>
                    </div>
                    <div class="productSlider grid-products">
                        
                        @foreach ($favoriteProducts as $product)
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
            </div>    
        </div>
    </div>
    <!--Weekly Bestseller-->
   
    <!--New Arrivals-->
    <div class="product-rows section main-col shop-grid-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="h2">Sản phẩm mới</h2>
                    </div>
                </div>
            </div>
            <div class="grid-products grid--view-items">
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-2 item">
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
    <!--End Featured Product-->
@endsection

@section('scripts')
    <script>
        @if (session('message'))
            alert('{{session('message')}}');
        @endif
    </script>
@endsection

