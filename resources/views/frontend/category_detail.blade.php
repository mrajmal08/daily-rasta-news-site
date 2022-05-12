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
    <div class="pagination-area pb-45 text-center mt-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                {{-- <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a></li> --}}
                                <li class="page-item"><a class="page-link"
                                        href="#">{{ $news->links('pagination::bootstrap-4') }}</a></li>
                                {{-- <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a></li> --}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End pagination  -->
@endsection
