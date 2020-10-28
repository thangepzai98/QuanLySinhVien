@extends('front.layout.base')
@section('page_class', 'template-blog belle')

@section('content')
    <!--Page Title-->
    <div class="page section-header text-center mb-0">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-width">Bài viết</h1></div>
          </div>
    </div>
    <!--End Page Title-->
    <div class="bredcrumbWrap">
        <div class="container breadcrumbs">
            <a href="/" title="Back to the home page">Trang chủ</a><span aria-hidden="true">›</span><span>Bài viết</span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">

                <div class="blog--list-view blog--grid-load-more">
                    @foreach ($posts as $post)
                    <div class="article" style="display: block;"> 
                          <!-- Article Image --> 
                          <a class="article_featured-image" href="/post/{{$post->id}}"><img class="blur-up ls-is-cached lazyloaded" data-src="{{ $post->image }}" src="{{ $post->image }}" alt="It's all about how you wear"></a> 
                            <h2 class="h3"><a href="/post/{{$post->id}}">{{ $post->title }}</a></h2>
                            <ul class="publish-detail">                      
                              <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">{{ Carbon::parse($post->created_at)->format('d/m/Y') }}</time></li>
                          </ul>
                  </div>
                    @endforeach
                    <div class="pagination">
                      {{ $posts->links() }}
                  </div>
                </div>
            </div>
            <!--End Main Content-->
            <!--Sidebar-->
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar">
                <div class="sidebar_tags">
                    <div class="sidebar_widget">
                        <div class="widget-title"><h2>Sản phẩm xem nhiều</h2></div>
                        <div class="widget-content">
                            <div class="list list-sidebar-products">
                              <div class="grid">
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image">
                                        <a class="grid-view-item__link" href="#">
                                            <img class="grid-view-item__image blur-up ls-is-cached lazyloaded" data-src="assets/images/blog/blog-post-sml-1.jpg" src="assets/images/blog/blog-post-sml-1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">It's all about how you wear</a>
                                      <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:33:00Z">May 02, 2017</time></span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up ls-is-cached lazyloaded" data-src="assets/images/blog/blog-post-sml-2.jpg" src="assets/images/blog/blog-post-sml-2.jpg" alt=""></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">27 Days of Spring Fashion Recap</a>
                                      <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:33:00Z">May 02, 2017</time> </span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up ls-is-cached lazyloaded" data-src="assets/images/blog/blog-post-sml-3.jpg" src="assets/images/blog/blog-post-sml-3.jpg" alt=""></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">How to Wear The Folds Trend Four Ways</a>
                                      <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:14:00Z">May 02, 2017</time> </span></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="grid__item">
                                  <div class="mini-list-item">
                                    <div class="mini-view_image"> <a class="grid-view-item__link" href="#"><img class="grid-view-item__image blur-up ls-is-cached lazyloaded" data-src="assets/images/blog/blog-post-sml-4.jpg" src="assets/images/blog/blog-post-sml-4.jpg" alt=""></a> </div>
                                    <div class="details"> <a class="grid-view-item__title" href="#">Accusantium doloremque</a>
                                      <div class="grid-view-item__meta"><span class="article__date"> <time datetime="2017-05-02T14:12:00Z">May 02, 2017</time> </span></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
            <!--End Sidebar-->
        </div>
    </div>
@endsection