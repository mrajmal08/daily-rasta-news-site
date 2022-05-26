@extends('layouts.frontend.head')

@push('frontCss')
    <link rel="stylesheet" href="{{ asset('carosel/css/owl.carousel.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('carosel/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('carosel/css/style.css') }}">
@endpush

@section('content')
    <!-- Preloader Start -->

    <!-- Preloader Start -->
    <main>
        <!-- Trending Area Start -->
        <div class="trending-area fix">

            @include('layouts.frontend.inc.breakingnews')

            <div class="container">
                <div class="trending-main">
                    <div dir="rtl" class="row">
                        <div class="col-lg-8">
                            @if (!empty($latest_news->id))
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img">
                                        <img src=" {{ asset('assets/postImages/' . "$latest_news->top_image") }} "
                                            style="height: 487px;width: 730px;">
                                        <div class="trend-top-cap">
                                            <span>{{ App\Models\Category::where('id', $latest_news->cat_id)->pluck('title')->first() }}</span>
                                            <h2 class="overflo text-white" style="line-height:2.5;"><a href="{{ route('news.detail', [$latest_news->slug]) }}">{{ $latest_news->title }}<br>
                                                </a></h2>
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
                                                    <span class="color1"><a
                                                            href="{{ route('categories.detail', [$item->slug]) }}">{{ $item->title }}</a></span>
                                                    <h4>
                                                        <h4 class="overflo"><a
                                                                href="{{ route('categories.detail', [$item->slug]) }}">{{ $item->description }}</a>
                                                        </h4>
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
                            <h3 class="widget_title p-3 rounded text-white mb-3"
                                style="background-color: #109cde; width:152px; ">تازہ ترين خبریں</h3>

                            @foreach ($recent_news as $item)
                                <?php
                                $category_name = App\Models\Category::where('id', $item->cat_id)
                                    ->pluck('title')
                                    ->first();
                                ?>

                                <div class="media post_item">

                                    <img src="{{ asset('assets/postImages') . '/' . $item->feature_image }}"
                                        alt="{{ $item->title }}" style="height: 100px;width: 120px;">
                                    &nbsp;
                                    <div class="media-body">
                                        <a class="overflo pt-3" href="{{ route('news.detail', [$item->slug]) }}">
                                            {{ $item->title }}
                                        </a>

                                        <p>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</p>
                                    </div>
                                </div> <br>
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
                                @foreach ($trending_news as $item)
                                    <?php
                                    $cat_detail = App\Models\Category::where('id', $item->cat_id)->first();
                                    ?>

                                    <div class="single-recent mb-100">
                                        <div class="what-img">
                                            <img src="{{ asset('assets/postImages') . '/' . $item->feature_image }}"
                                                alt="{{ $item->title }}" style="height: 326px;width: 350px;">
                                        </div>
                                        <div class="what-cap">
                                            <span class="color1"><a
                                                    href="{{ route('categories.detail', [$cat_detail->slug]) }}">{{ $cat_detail->title }}</a></span>
                                            <h4 class="overflo" dir="rtl"><a
                                                    href="{{ route('news.detail', [$item->slug]) }}">{{ $item->title }}</a>
                                            </h4>
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
                                                <?php $i = 0; ?>
                                                @foreach ($recent_news as $item)
                                                    <?php
                                                $cat_detail = App\Models\Category::where('id', $item->cat_id)->first();
                                                if($i >= 4) {break;}else{
                                                ?>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="single-what-news mb-100">
                                                            <div class="what-img">
                                                                <img src="{{ asset('assets/postImages') . '/' . $item->feature_image }} "
                                                                    alt="" style="height: 300px;width: 360px;">
                                                            </div>
                                                            <div class="what-cap">
                                                                <span class="color1"><a
                                                                        href="{{ route('categories.detail', [$cat_detail->slug]) }}">{{ $cat_detail->title }}</a></span>
                                                                <h4><a class="overflo" dir="rtl"
                                                                        href="{{ route('news.detail', [$item->slug]) }}">{{ $item->title }}</a>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $i++; } ?>
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
                                        <a href="https://web.facebook.com/dailyrastalahore/" target="_blank"><img
                                                src="{{ asset('frontend/assets/img/news/icon-fb.png') }}" alt=""></a>
                                    </div>&nbsp;
                                    <div class="follow-count">
                                        <h5>فیس بک</h5>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#" target="_blank"><img
                                                src="{{ asset('frontend/assets/img/news/icon-tw.png') }}" alt=""></a>
                                    </div>&nbsp;
                                    <div class="follow-count">
                                        <h5>ٹویٹر</h5>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="#" target="_blank"><img
                                                src="{{ asset('frontend/assets/img/news/icon-ins.png') }}" alt=""></a>
                                    </div>&nbsp;
                                    <div class="follow-count">
                                        <h5>انسٹاگرام</h5>
                                    </div>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <div class="follow-social">
                                        <a href="https://www.youtube.com/channel/UCty_T-nB2sTu8lTHg6ZwztA"
                                            target="_blank"><img
                                                src="{{ asset('frontend/assets/img/news/icon-yo.png') }}" alt=""></a>
                                    </div>&nbsp;
                                    <div class="follow-count">
                                        <h5>یوٹیوب</h5>
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
                                @foreach ($popular_news as $item)
                                    <?php
                                    $cat_detail = App\Models\Category::where('id', $item->cat_id)->first();
                                    ?>
                                    <div class="single-recent mb-100">
                                        <div class="what-img">
                                            <img src="{{ asset('assets/postImages') . '/' . $item->feature_image }}"
                                                alt="{{ $item->title }}" style="height: 326px;width: 350px;">
                                        </div>
                                        <div class="what-cap">
                                            <span class="color1"><a
                                                    href="{{ route('categories.detail', [$cat_detail->slug]) }}">{{ $cat_detail->title }}</a></span>
                                            <h4><a class="overflo" dir="rtl"
                                                    href="{{ route('news.detail', [$item->slug]) }}">{{ $item->title }}</a>
                                            </h4>
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
                            @foreach ($videos as $item)
                                <div class="video-items text-center">

                                    {!! preg_replace('/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i', "<iframe class='embed-responsive-item' src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>", $item->video_link) !!}

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
                                <div class="bottom-caption mt-5">
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
                                @foreach ($videos as $item)
                                    <div class="single-video">
                                        {!! preg_replace('/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i', "<iframe class='embed-responsive-item' src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>", $item->video_link) !!}

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
                                @foreach ($blogs as $item)
                                    <div class="single-recent mb-100">
                                        <div class="what-img">
                                            <img src="{{ asset('assets/blogFiles') . '/' . $item->feature_image }}" alt=""
                                                style="height: 326px;width: 350px;">
                                        </div>
                                        <div class="what-cap">
                                            <span class="color1">{{ $item->type }}</span>
                                            <h4><a class="overflo" dir="rtl" href="{{ route('blog.detail', [$item->slug]) }}"
                                                    target="_blank">{{ $item->title }}</a></h4>
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
