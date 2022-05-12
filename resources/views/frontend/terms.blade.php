@extends('layouts.frontend.head')

@section('content')
<section id="Terms&conditions" dir="rtl">
        <div class="container">

            <div class="row mt-5">
                <div class="col-md-8 " style="margin-top:20px;">
                <h1 class="mb-5">
                شرائط و ضوابط

            </h1>
                    اہورسمیت پنجاب بھر کے سرکاری وپرائیویٹ سکولوں میں 14 سکولوں میں زیر تعلیم طلبا مزید پڑھیں مارچ کو ثقافتی ڈے منانےکا اعلان کردیا گیا۔ ذرائع کے مطابق لاہور سمیت پنجاب بھر کے سکولوں میں 14 مارچ کو ثقافتی ڈے منایا جائے گا،
                </div>
                <div class="col-md-4 mt-5" >
                    <h3 class="text-center">تازہ ترین خبریں</h3>
                    <!-- latest news -->

                    @foreach ($recent_news as $news)

                    <div class="media post_item">
                       <img src="{{ asset('assets/postImages')."/".$news->feature_image }}" alt="post" class="w-25 round">
                       &nbsp;
                       <div class="media-body">
                          <a href="{{ route('news.detail', [$news->slug]) }}">
                             {{ $news->title }}
                          </a>

                          <p>{{\Carbon\Carbon::parse($news->created_at)->format('d/m/Y')}}</p>
                       </div>
                    </div>
                    @endforeach

                    <!-- end latest newsS -->
                </div>
            </div>
        </div>

    </section>

@endsection
