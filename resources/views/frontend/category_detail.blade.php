@extends('layouts.frontend.head')

@section('content')
    <div class="container mt-5">
        <h4 class="text-center pt-2"><strong>{{ $category->title }} کی تمام خبریں</strong></h4>
        <div dir="rtl" class="row">

            @if($news->count() == 0)

                <div class="col-12 text-center mt-5">
                    <h5 style="color:brown">کوئی خبر نہیں ملی</h5>
                </div>

            @else

            @foreach ($news as $item)
                <div class="col-md-4">
                    <hr>
                    <div class="profile-card-4 text-center"><img
                            src="{{ asset('assets/postImages') . '/' . $item->feature_image }}"
                            style="height: 180px;width: 350px;" ; class="img img-responsive">
                        <h4 class="pt-3"><a
                                href="{{ route('news.detail', [$item->slug]) }}">{{ $item->title }}</a></h4>
                        {{-- <div class="profile-description" style="font-size:16px;">{!! $item->description !!}</div> --}}

                    </div>
                </div>
            @endforeach

            @endif
        </div>
    </div>

    <!--Start pagination -->
    <div class="col-md-12 mt-5 mb-5">
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2">{{$news->links('pagination::bootstrap-4')}}</div>
            <div class="col-md-5"></div>
        </div>
    </div>
    <!-- End pagination  -->
@endsection
