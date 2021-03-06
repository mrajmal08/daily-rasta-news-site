@extends('layouts.frontend.head')
@section('content')
    <!-- Preloader Start -->
    <!-- Whats New Start -->

    <div class="container">
        <section class="whats-news-area  pb-20">
            @include('layouts.frontend.inc.breakingnews')

            <div dir="rtl" class="row">
                <div class="col-lg-8">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-3 col-md-3">
                            <div class="section-tittle float-left ">
                                <!-- <h3>تمام کیٹاگریز</h3> -->
                                <h3 class=" section-tittle text-center widget_title p-3 rounded text-white mb-3"
                                style="background-color: #109cde; width:152px; ">تمام کیٹاگریز</h3>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="properties__button">
                                <!--Nav Button  -->

                                <!--End Nav Button  -->
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

                                            @foreach ($categories as $category)
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="single-what-news mb-100">
                                                        <div class="what-img">
                                                            <img src="{{ asset('assets/categoryImages') . '/' . $category->image }}"
                                                                alt="" style="height: 300px;width: 360px;">
                                                        </div>
                                                        <div class="what-cap">
                                                            <span class="color1"><a
                                                                    href="{{ route('categories.detail', [$category->slug]) }}">{{ $category->title }}</a></span>
                                                            <h4><a
                                                                    href="{{ route('categories.detail', [$category->slug]) }}">{{ $category->description }}</a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Nav Card -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">اقسام</h4>

                            <ul class="list cat-list">
                                @foreach ($recent_categories as $category)
                                    <?php
                                    $count = App\Models\News::where('cat_id', $category->id)->count();
                                    ?>
                                    <li>
                                        <a href="{{ route('categories.detail', [$category->slug]) }}"
                                            class="d-flex">
                                            <p>{{ $category->title }}</p>
                                            <p>({{ $count }})</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>


                    <!-- Section Tittle -->
                    <div class="section-tittle mb-40">
                        <h3>ہمیں فالو کریں</h3>
                    </div>
                    <!-- Flow Socail -->
                    <div class="single-follow mb-45">
                        <div class="single-box">
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('frontend/assets/img/news/icon-fb.png') }}" alt=""> </a>
                                </div>
                                <div class="follow-count">
                                <h5 class="mr-2">فیس بک</h5>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('frontend/assets/img/news/icon-tw.png') }}" alt=""></a>
                                </div>
                                <div class="follow-count">
                                <h5 class="mr-2">ٹویٹر</h5>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('frontend/assets/img/news/icon-ins.png') }}"
                                            alt=""></a>
                                </div>
                                <div class="follow-count">
                                <h5 class="mr-2">انسٹاگرام</h5>
                                </div>
                            </div>
                            <div class="follow-us d-flex align-items-center">
                                <div class="follow-social">
                                    <a href="#"><img src="{{ asset('frontend/assets/img/news/icon-yo.png') }}"
                                            alt=""></a>
                                </div>
                                <div class="follow-count">
                                <h5 class="mr-2">یوٹیوب</h5>
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
        </section>
    </div>
    {{-- </section>
        </div> --}}
    <!-- Whats New End -->


    <!--Start pagination -->
    <div class="col-md-12 mt-5 mb-5">
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2">{{ $categories->links('pagination::bootstrap-4') }}</div>
            <div class="col-md-5"></div>
        </div>
    </div>


    <!-- End pagination  -->
@endsection
