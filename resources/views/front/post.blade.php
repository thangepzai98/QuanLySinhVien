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
            <a href="index.html" title="Back to the home page">Trang chủ</a><span aria-hidden="true">›</span><span>Bài viết</span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!--Main Content-->
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                <div class="blog--list-view blog--grid-load-more">
                    <div class="article" style="display: block;"> 
                        <!-- Article Image --> 
 
                        <h2 class="h3"><a href="blog-left-sidebar.html">{{$post->title}}</a></h2>
                        <ul class="publish-detail">                      
                            <li><i class="icon anm anm-clock-r"></i> <time datetime="2017-05-02">{{ Carbon::parse($post->created_at)->format('d/m/Y') }}</time></li>
                        </ul>
                        <div class="rte"> 
                            <p>{!! $post->content !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Main Content-->
        </div>
    </div>
@endsection