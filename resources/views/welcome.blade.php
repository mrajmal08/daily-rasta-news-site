@extends('layouts.frontend.head')

@push('frontCss')

    <link rel="stylesheet" href="{{ asset('carosel/css/owl.carousel.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('carosel/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('carosel/css/style.css') }}">

@endpush

@section('content')
    <!-- Preloader Start -->
    {{-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('frontend/assets/img/logo/logo.png') }}" alt="">
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Preloader Start -->
    <main>
        <!-- Trending Area Start -->
        <div class="trending-area fix">
            <div class="container">
                <div class="trending-main">
                    <!-- Trending Tittle -->
                    {{-- <div class="row">
                    <div class="col-lg-12">
                        <div dir="rtl" class="trending-tittle">
                            <strong>Trending now</strong>
                            <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                            <div class="trending-animated">
                                <ul id="js-news" class="js-hidden">
                                    <li class="news-item">Bangladesh dolor sit amet, consectetur adipisicing elit.</li>
                                    <li class="news-item">Spondon IT sit amet, consectetur.......</li>
                                    <li class="news-item">Rem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div> --}}


                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center breaking-news bg-white">
                                    <div
                                        class="d-flex flex-row m-3 flex-grow-1 flex-fill justify-content-center bg-danger py-2 text-white px-1 news rounded">
                                        <span class="d-flex align-items-center">&nbsp;اہم خبریں</span></div>
                                    <marquee class="news-scroll" behavior="scroll" loop="100" scrolldelay="1"
                                        scrollamount="12" direction="right" onmouseover="this.stop();"
                                        onmouseout="this.start();">
                                        @foreach ($breaking_news as $item)
                                            <a href="{{ route('news.detail', [$item->slug]) }}">{{ $item->title }}</a>
                                            <span class="dot"></span>
                                        @endforeach

                                    </marquee>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div dir="rtl" class="row">
                        <div class="col-lg-8">
                            <!-- Trending Top -->

                            @if(!empty($latest_news->id))
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img">
                                        <img src=" {{ asset("assets/postImages/"."$latest_news->top_image") }} " style="height: 487px;width: 730px;">
                                        <div class="trend-top-cap">
                                            <span>{{ App\Models\Category::where('id', $latest_news->cat_id)->pluck('title')->first(); }}</span>
                                            <h2><a href="{{ route('news.detail', [$latest_news->slug]) }}">{{ $latest_news->title }}<br> </a></h2>
                                        </div>
                                    </div>
                                </div>
                            @else

                            <div class="trending-top mb-30">
                                <div class="trend-top-img">
                                    <img src="{{ asset('frontend/assets/img/trending/trending_top.jpg') }}" alt="">
                                    <div class="trend-top-cap">
                                        <span>غیر زمرہ بندی</span>
                                        <h2><a href="#">ٹیسٹ کی خبریں<br> </a></h2>
                                    </div>
                                </div>
                            </div>

                            @endif

                            <!-- Trending Bottom -->
                            <div class="trending-bottom">
                                <div class="row">
                                    @foreach ($latest_categories as $item)
                                        <div class="col-lg-4">
                                            <div class="single-bottom mb-35">
                                                <div class="trend-bottom-img mb-30">
                                                    {{-- <img src="{{asset('frontend/assets/img/trending/trending_bottom2.jpg')}}" alt=""> --}}
                                                    <img src="{{ asset('assets/categoryImages') . '/' . $item->image }}"
                                                        alt="{{ $item->title }}" style="height: 186px;width: 223px;">


                                                </div>
                                                <div class="trend-bottom-cap">
                                                    <span class="color1"><a href="{{ route('categories.detail', [$item->slug]) }}">{{ $item->title }}</a></span>
                                                    <h4>
                                                        <h4><a href="{{ route('categories.detail', [$item->slug]) }}">{{ $item->description }}</a></h4>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Riht content -->
                        <div class="col-lg-4">
                            <h3 class="widget_title">تازہ ترين خبریں</h3>

                            @foreach ($recent_news as $item)
                                <?php
                                $category_name = App\Models\Category::where('id', $item->cat_id)
                                    ->pluck('title')
                                    ->first();
                                ?>

                                <div class="media post_item">

                                    <img src="{{ asset('assets/postImages')."/".$item->feature_image }}" alt="{{ $item->title }}" style="height: 100px;width: 120px;">
                                    &nbsp;
                                    <div class="media-body">
                                        <a href="{{ route('news.detail', [$item->slug]) }}">
                                            {{ $item->title }}
                                        </a>

                                        <p>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</p>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Trending Area End -->
        <div class="recent-articles">
            <div class="container">
                <div class="recent-wrapper">
                    <!-- section Tittle -->
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="section-tittle mb-30">
                                <h3>ٹرینڈ نگ خبریں</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="recent-active dot-style d-flex dot-style">
                                @foreach($trending_news as $item)
                                <?php
                               $cat_detail =  App\Models\Category::where('id', $item->cat_id)->first();
                                ?>

                                    <div class="single-recent mb-100">
                                        <div class="what-img">
                                            <img src="{{ asset('assets/postImages')."/".$item->feature_image }}" alt="{{ $item->title }}" style="height: 326px;width: 350px;">
                                        </div>
                                        <div class="what-cap">
                                            <span class="color1"><a href="{{ route('categories.detail', [$cat_detail->slug]) }}">{{ $cat_detail->title }}</a></span>
                                            <h4><a href="{{ route('news.detail', [$item->slug]) }}">{{ $item->title }}</a></h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Weekly-News -->
        <section class="whats-news-area pt-50 pb-20">
            <div class="container">
                <div dir="rtl" class="row">
                    <div class="col-lg-8">
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-3 col-md-3">
                                <div class="section-tittle mb-30">
                                    <h3>نیا کیا ہے</h3>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9">
                                <div class="properties__button">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <!-- Nav Card -->
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- card one -->
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="whats-news-caption">
                                            <div class="row">
                                                @foreach($recent_news as $item)
                                                <?php
                                                $cat_detail = App\Models\Category::where('id', $item->cat_id)->first();
                                                ?>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="single-what-news mb-100">
                                                        <div class="what-img">
                                                            <img src="{{ asset('assets/postImages')."/".$item->feature_image }} "
                                                                alt="" style="height: 300px;width: 360px;">
                                                        </div>
                                                        <div class="what-cap">
                                                            <span class="color1"><a href="{{ route('categories.detail', [$cat_detail->slug]) }}">{{ $cat_detail->title }}</a></span>
                                                            <h4><a href="{{ route('news.detail', [$item->slug]) }}">{{ $item->title }}</a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card two -->
                                </div>
                                <!-- End Nav Card -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-40">
                            <h3>ہمیں فالو کریں</h3>
                        </div>
                        <!-- Flow Socail -->
                        <div class="single-follow mb-45">
                            <div class="single-box">
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="https://web.facebook.com/dailyrastalahore/"><img src="{{ asset('frontend/assets/img/news/icon-fb.png') }}"
                                                alt=""></a>
                                    </div>
                                    <div class="follow-count">

                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="{{ asset('frontend/assets/img/news/icon-tw.png') }}"
                                                alt=""></a>
                                    </div>
                                    <div class="follow-count">

                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#"><img src="{{ asset('frontend/assets/img/news/icon-ins.png') }}"
                                                alt=""></a>
                                    </div>
                                    <div class="follow-count">

                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="https://www.youtube.com/channel/UCty_T-nB2sTu8lTHg6ZwztA"><img src="{{ asset('frontend/assets/img/news/icon-yo.png') }}"
                                                alt=""></a>
                                    </div>
                                    <div class="follow-count">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- New Poster -->
                        <div class="news-poster d-none d-lg-block">
                            <img src="{{ asset('frontend/assets/img/news/news_card.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
            <div class="recent-articles">
                <div class="container">
                    <div class="recent-wrapper">
                    <!-- section Tittle -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-tittle mb-30">
                                <h3>مقبول خبریں</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="recent-active dot-style d-flex dot-style">
                                @foreach($popular_news as $item)
                                <?php
                                    $cat_detail = App\Models\Category::where('id', $item->cat_id)->first();
                                ?>
                                    <div class="single-recent mb-100">
                                        <div class="what-img">
                                            <img src="{{ asset('assets/postImages')."/".$item->feature_image }}" alt="{{ $item->title }}" style="height: 326px;width: 350px;">
                                        </div>
                                        <div class="what-cap">
                                            <span class="color1"><a href="{{ route('categories.detail', [$cat_detail->slug]) }}">{{ $cat_detail->title }}</a></span>
                                            <h4><a href="{{ route('news.detail', [$item->slug]) }}">{{ $item->title }}</a></h4>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Weekly-News -->
        <div class="youtube-area video-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="video-items-active">
                            @foreach($videos as $item)
                            <div class="video-items text-center">

                                {!! preg_replace(
                                    "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
                                    "<iframe class='embed-responsive-item' src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
                                    $item->video_link
                                ); !!}

                                {{-- <iframe src="https://www.youtube.com/embed/iXzfJWAwcOg" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe> --}}
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="video-info">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="video-caption">
                                <div class="top-caption">
                                    {{-- <span class="color1">Politics</span> --}}
                                </div>
                                <div class="bottom-caption mt-2">
                                    <h2>پاکستان کی سب سے بڑی ڈیجیٹل نیوز ایجنسی میں خوش آمدید</h2>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ipsum dolor
                                        sit. Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod ipsum
                                        dolor sit. Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                                        ipsum dolor sit lorem ipsum dolor sit.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="testmonial-nav text-center">
                                @foreach($videos as $item)
                                <div class="single-video">
                                    {!! preg_replace(
                                        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
                                        "<iframe class='embed-responsive-item' src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
                                        $item->video_link
                                    ); !!}

                                    <div class="video-intro">
                                        {{-- <h4>Welcotme To The Best Model Winner Contest</h4> --}}
                                    </div>
                                </div>
                               @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="recent-articles">
            <div class="container">
                <div class="recent-wrapper">
                    <!-- section Tittle -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-tittle mb-30">
                                <h3>بلاگ</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="recent-active dot-style d-flex dot-style">
                            @foreach($blogs as $item)
                                <div class="single-recent mb-100">
                                    <div class="what-img">
                                        <img src="{{ asset('assets/blogFiles')."/".$item->feature_image }}" alt="" style="height: 326px;width: 350px;">
                                    </div>
                                    <div class="what-cap">
                                        <span class="color1">{{ $item->type }}</span>
                                        <h4><a href="{{ route('blog.detail', [$item->slug]) }}" target="_blank">{{ $item->title }}</a></h4>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Recent Articles End -->
        <!--Start pagination -->
        <!-- <div class="pagination-area pb-45 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                  <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a></li>
                                    <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                    <li class="page-item"><a class="page-link" href="#">02</a></li>
                                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                                  <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a></li>
                                </ul>
                              </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- End pagination  -->
    </main>



    <!-- JS here -->
@endsection

@push('frontJs')
<script src="{{ asset('carosel/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('carosel/js/popper.min.js') }}"></script>
<script src="{{ asset('carosel/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('carosel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('carosel/js/main.js') }}"></script>
@endpush
