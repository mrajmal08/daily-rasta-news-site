@extends('layouts.frontend.head')

@section('content')
 <!--================Blog Area =================-->
 <section dir="rtl" class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
                  <div class="feature-img">
                    {{-- <img class="img-fluid" src="{{ asset('frontend/assets/img/blog/single_blog_1.png') }}}" alt=""> --}}
                     <img class="img-fluid" src="{{ asset('assets/postImages')."/".$news->top_image }}" alt="{{ $news->title }}"  style="height: 487px;width: 730px;">
                  </div>
                  <div class="blog_details">
                     <h2>{{ $news->title }}</h2>
                     </h2>
                     <ul class="blog-info-link mt-3 mb-4">
                        <li><i class="fa fa-user"></i><a href="{{ route('categories.detail', [$category->slug]) }}" >{{ $category->title }}</a></li>
                     </ul>
                     <p class="excert">
                        {!! $news->description !!}
                     </p>

                  </div>
               </div>
               <div class="navigation-top">
                  <div class="d-sm-flex justify-content-between text-center">
                     <p class="like-info"><span class="align-middle"><i class="fa fa-heart"></i></span>&nbsp;{{ $news->clicks}} لوگوں نے اس پوسٹ کو دیکھا</p>
                     <div class="col-sm-4 text-center my-2 my-sm-0">
                        <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                     </div>
                     <ul class="social-icons">
                         <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                     </ul>
                  </div>
               </div>

               <div class="">

                  @foreach($reviews as $review)
                  <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="thumb">

                              <img src="{{ asset('frontend/assets/img/comment/comment_1.png') }}" alt="">
                           </div>
                           <div class="desc">
                              <p class="comment">
                                {{ $review->comment }}
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5>
                                       <a href="#"> {{ $review->name }}</a>
                                    </h5>&nbsp;
                                    <p class="date"> {{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y H:i:s')}}</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

            @endforeach


               </div>
               <div class="comment-form">
                  <h4>ایک جائزہ چھوڑیں۔</h4>

                @if ($errors->any())
                  @foreach ($errors->all() as $error)
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert"
                              aria-hidden="true">&times;</button>
                          <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                          {{ $error }}
                      </div>
                  @endforeach
                @endif

                  <form class="form-contact comment_form" method="POST" action="{{ route('post.review') }}" id="commentForm">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="news_id" value="{{ $news->id }}">
                            <input type="hidden" name="type" value="news">
                           <div class="form-group">
                              <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                 placeholder="Write Comment"></textarea>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="form-group">
                              <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                           </div>
                        </div>

                     </div>
                     <div class="form-group">
                        <button type="submit" class="button button-contactForm btn_1 boxed-btn">پیغام بھیجیں</button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">

                  <aside class="single_sidebar_widget post_category_widget">
                     <h4 class="widget_title">اقسام</h4>
                     <ul class="list cat-list">

                        @foreach ($categories as $category)
                        <?php
                         $count = App\Models\News::where('cat_id', $category->id)->count();
                        ?>
                        <li>
                           <a href="{{ route('categories.detail', [$category->slug]) }}" class="d-flex">
                              <p>{{ $category->title }}</p>
                              <p>({{ $count }})</p>
                           </a>
                        </li>
                       @endforeach

                     </ul>
                  </aside>
                  <aside class="single_sidebar_widget popular_post_widget">
                     <h3 class="widget_title">حالیہ پوسٹ</h3>

                     @foreach ($recent_news as $news)

                     <div class="media post_item">
                        <img src="{{ asset('assets/postImages')."/".$news->feature_image }}" alt="post" class="w-25 round">
                        &nbsp;
                        <div class="media-body">
                           <a href="{{ route('news.detail', [$news->slug]) }}">
                              <h3>{{ $news->title }}</h3>
                           </a>

                           <p>{{\Carbon\Carbon::parse($news->created_at)->format('d/m/Y')}}</p>
                        </div>
                     </div>
                     @endforeach

                  </aside>


               </div>
            </div>
         </div>
      </div>
   </section>
   <!--================ Blog Area end =================-->
@endsection
