@extends('layouts.frontend.head')

@section('content')

    <!--================Blog Area =================-->
    <section class="blog_area pb-5">
        @include('layouts.frontend.inc.breakingnews')
        <div class="container">
            <div dir="rtl" class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">

                        @foreach($blog as $item)
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{ asset('assets/blogFiles')."/".$item->feature_image }}" alt="{{ $item->title }}" style="height: 375px;width: 750px;">
                                <a dir="rtl" href="#" class="blog_item_date">
                                    <h3>{{ $item->created_at->format('d') }}</h3>
                                    <p>{{ $item->created_at->format('M') }}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{ route('blog.detail', [$item->slug]) }}">
                                    <h2>{{ $item->title }}</h2>
                                </a>

                                <ul class="blog-info-link">
                                    <li><i class="fa fa-user"></i>{{ $item->type }}</li>
                                    {{-- <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li> --}}
                                </ul>
                            </div>
                        </article>
                        @endforeach
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
                                  <a href="{{ route('categories.detail', [$category->slug]) }}" class="d-flex">
                                     <p>{{ $category->title }}</p>
                                     <p>({{ $count }})</p>
                                  </a>
                               </li>
                              @endforeach

                            </ul>
                         </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">حالیہ کالمز</h3>
                            @foreach ($recent_blog as $item)
                            <div class="media post_item">
                                <img src="{{ asset('assets/blogFiles')."/".$item->feature_image }}" alt="{{ $item->title }}" style="width:75px; height:60px">
                                <div class="media-body mr-2">
                                    <a class="overflo" href="{{ route('blog.detail', [$item->slug]) }}">
                                        <h3>{{ $item->title }}</h3>
                                    </a>
                                    <p>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            @endforeach

                        </aside>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">{{$blog->links('pagination::bootstrap-4')}}</div>
                    <div class="col-md-5"></div>
                </div>
            </div>

        </div>
    </section>
    <!--================Blog Area =================-->


@endsection
