@extends('front.layout.base')

@section('page_class', 'template-collection belle')

@section('content')
<div class="container">
    <div class="row">
        <!--Main Content-->
        <div class="product-rows section main-col shop-grid-5">
            <div class="productList">
                <hr>
                <!--Toolbar-->
                <button type="button" class="btn btn-filter d-block d-md-none d-lg-none"> Product Filters</button>
                <div class="toolbar">
                    <div class="filters-toolbar-wrapper">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12 text-right">
                                <div class="filters-toolbar__item">
                                   <form action="" method="get">
                                        <select name="price"  class="filters-toolbar__input filters-toolbar__input--sort">
                                            <option value="" selected="selected">Mức giá</option>
                                            <option value="max2">Dưới 2 triệu</option>
                                            <option value="max3">Dưới 3 triệu</option>
                                            <option value="max4">Dưới 4 triệu</option>
                                            <option value="max5">Dưới 5 triệu</option>
                                            <option value="max10">Dưới 10 triệu</option>
                                            <option value="min10">Trên 10 triệu</option>
                                        </select>
                                        <select name="order"  class="filters-toolbar__input filters-toolbar__input--sort">
                                            <option value="" selected="selected">Sắp xếp</option>
                                            <option value="asc">Giá từ thấp đến cao</option>
                                            <option value="desc">Giá từ cao đến thấp</option>
                                        </select>
                                        <button class="btn btn-secondary btn--small">Lọc sản phẩm</button>
                                   </form>
                            </div>
                        </div>
                    </div>
                </div>
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
            <div class="infinitpaginOuter">
                <div class="infinitpagin">	
                    <div class="btn loadMore">Xem thêm điện thoại</div>
                </div>
            </div>
        </div>
        <!--End Main Content-->
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">

    function formatMoney(amount, decimalCount = 2, decimal = ",", thousands = ".") {
        try {
            decimalCount = Math.abs(decimalCount);
            decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

            const negativeSign = amount < 0 ? "-" : "";

            let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
            let j = (i.length > 3) ? i.length % 3 : 0;

            return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
        } catch (e) {
            console.log(e)
        }
    };

    function realPrice(price, promotionPrice, startDate, endDate) {
        var dateNow = new Date().toISOString().slice(0,10);
        var html = '';
        if(promotionPrice != null && startDate <= dateNow && promotionPrice >= dateNow) {
          html += '<span class="old-price">' + formatMoney(price,0,',','.') +'₫</span><span class="price">'+ formatMoney(promotionPrice,0,',','.') +'₫</span>';
        } else {
        html += '</span><span class="price">' + formatMoney(price,0,',','.') + '₫</span>';
      }
      return html;
    }

    function getPromotionPercent(price, promotionPrice, startDate, endDate)
    {
      var dateNow = new Date().toISOString().slice(0,10);
      var html = '';
      if(promotionPrice != null && startDate <= dateNow && endDate >= dateNow) {
        html += '<div class="product-labels"><span class="lbl on-sale">' + Math.round(100 * (price - promotionPrice) / price) + '%</span></div>';
      }
      return html;
    }

    function getStartVote(rate) {
        html = '';
        if(rate == 0) {
          html = '<i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } else if (rate > 0 && rate < 1) {
          html = '<i class="font-13 fa fa-star-half-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } else if (rate == 1) {
          html = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i>';
        } else if (rate > 1 && rate < 2) {
          html = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-half-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } else if (rate == 2) {
          html = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } else if (rate > 2 && rate < 3) {
          html = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-half-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } else if (rate == 3) {
          html = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i>';
        } else if (rate > 3 && rate < 4) {
          html = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-half-o"></i><i class="font-13 fa fa-star-o"></i>';
        } else if (rate == 4) {
          html = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-o"></i>';
        } else if (rate > 4 && rate < 5) {
          html = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-half-o"></i>';
        } else if (rate == 5) {
          html = '<i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="fas fa-star"></i>';
        }
        return html;
    }

    function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    $(document).ready(function() {
        $(".loadMore").on('click',function() {
            var _totalCurrentResult=$(".product-box").length;
            var price = getUrlParameter('price');
            var order = getUrlParameter('order');
            // Ajax Reuqest
            $.ajax({
                url: '/loadMoreDataCategory',
                type:'get',
                dataType:'json',
                data: {
                    skip:_totalCurrentResult,
                    order: order,
                    price: price
                },
                beforeSend:function() {
                    $(".loadMore").html('Đang tải...');
                },
                success:function(response) {
                    var _html='';
                    $.each(response,function(index, product) {                     
                        _html += '   <div class="col-6 col-sm-6 col-md-4 col-lg-2 item product-box">  '  + 
 '                                   <!-- start product image -->  '  + 
 '                                   <div class="product-image">  '  + 
 '                                       <!-- start product image -->  '  + 
 '                                       <a href="/product/'+ product.id +'">  '  + 
 '                                           <!-- image -->  '  + 
 '                                           <img class=" blur-up lazyload"  src="'+ product.image +'" alt="image" title="product" />  '  + 
 '                                           <!-- End image -->  '  + 
 '                                           <!-- product label -->  '  + getPromotionPercent(product.product_detail.sale_price, product.product_detail.promotion_price, product.product_detail.promotion_start_date, product.product_detail.promotion_end_date) +
 '                                             '  + 
 '                                           <!-- End product label -->  '  + 
 '                                       </a>  '  + 
 '                                       <!-- end product image -->  '  + 
 '                                   </div>  '  + 
 '                                   <!-- end product image -->  '  + 
 '                                   <!--start product details -->  '  + 
 '                                   <div class="product-details text-center">  '  + 
 '                                       <!-- product name -->  '  + 
 '                                       <div class="product-name">  '  + 
 '                                           <a href="/product/'+ product.id +'">'+ product.name +'</a>  '  + 
 '                                       </div>  '  + 
 '                                       <!-- End product name -->  '  + 
 '                                       <!-- product price -->  '  + 
 '                                       <div class="product-price"> ' + realPrice(product.product_detail.sale_price, product.product_detail.promotion_price, product.product_detail.promotion_start_date, product.product_detail.promotion_end_date) +
 '                                                 '  +
 '                                       </div>  '  + 
 '                                       <!-- End product price -->  '  + 
 '                                         '  + 
 '                                       <div class="product-review">  '  + getStartVote(product.rate) +
 '                                            '  + 
 '                                       </div>  '  + 
 '                                   </div>  '  + 
 '                                   <!-- End product details -->  '  + 
 '                              </div>  ' ; 
                    });
                    $(".product-list").append(_html);
                    // Change Load More When No Further result
                    var _totalCurrentResult = $(".product-box").length;
                    console.log(_totalCurrentResult);
                    $(".loadMore").html('Xem thêm điện thoại');
                }
            });
        });
    });
</script>
@endsection