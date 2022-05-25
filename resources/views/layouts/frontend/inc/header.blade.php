<header>
        <!-- Header Start -->

       <div dir="rtl" class="header-area">

            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block">
                   <div class="container">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li>
                                            @if(Auth::check())
                                                <a href="{{route('home')}}">
                                                   ڈیش بورڈ
                                                </a>&nbsp;&nbsp;
                                                <a href="{{route('logout')}}">
                                                    لاگ آوٹ
                                                 </a>
                                            @else
                                            <a style="color: white" href="{{ route('login') }}">
                                                لاگ ان کریں
                                            </a>

                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                       <li> <a href="https://web.facebook.com/dailyrastalahore/"><i class="fab fa-facebook-f"></i></a></li>
                                       <li> <a href="https://www.youtube.com/channel/UCty_T-nB2sTu8lTHg6ZwztA"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo">
                                    {{-- <a href="index.html"><img src="{{ asset('frontend/assets/img/logo/logo.png') }}" alt=""></a> --}}
                                    <a href="/"><img src="http://dailyrasta.com/wp-content/uploads/2021/08/logo-gif-1.gif" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right ">
                                    <img src="{{ asset('frontend/assets/img/hero/header_card.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
               <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- sticky -->
                                    <div class="sticky-logo">
                                        <a href="/"><img src="http://dailyrasta.com/wp-content/uploads/2021/08/logo-gif-1.gif" alt=""></a>

                                    </div>
                                <!-- Main-menu -->
                                <div  class="main-menu d-none d-md-block">
                                    <nav dir="rtl">
                                        <ul id="navigation">
                                            <li><a href="/"><b>صفحہ اوّل</b></a></li>
                                            <li><a href="{{ route('today.newspaper') }}"><b>آج کا اخبار</b></a></li>
                                            <li><a href="{{ route('categories.frontend') }}"><b>اہم خبریں</b></a></li>
                                            <li><a href="{{ route('blog') }}"><b>کالمز</b></a></li>

                                            <li><a href="/پاکستان/خبریں"><b>پاکستان</b></a></li>
                                            {{-- <li><a href="/کاروبار/خبریں"><b>کاروبار</b></a></li>
                                            <li><a href="/صحت/خبریں"><b>صحت</b></a></li> --}}
                                            <li><a href="/کھیل/خبریں"><b>کھیل</b></a></li>
                                            <li><a href="{{ route('gallery') }}"><b>گیلری</b></a></li>


                                            {{-- <li><a href="{{ route('about.us') }}"><b>ہمارے بارے میں</b></a></li>
                                            <li><a href="{{ route('contact.us') }}"><b>ہم سے رابطہ کریں</b></a></li> --}}
                                            <li><a href="{{ route('staff') }}"><b>سٹاف</b></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-4">
                                <div class="header-right-btn f-right d-none d-lg-block">

                                        <form class="form-group" style="width:150%">
                                            <input type="text" class="form-control" name="search" id="search" placeholder="تلاش کریں...">
                                        </form>
                                        <button class="main-search-button" id="searchBtn">تلاش کریں</button>

                                    <div class="">
                                        <ul class="list-group" id="sarach_data">
                                        </ul>
                                    </div>

                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>
