@extends('layouts.frontend.head')

@push('frontCss')
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">


                <div class="mt-4 ml-4">
                    <form method="GET" action="{{ route('today.newspaper') }}" class="form-group">
                        <input type="date" class="form-control" name="search" placeholder="تلاش کریں...">
                        <button type="submit" class="date-search" >تلاش کریں</button>
                    </form>
                </div>

            </div>
            <div class="col-md-8 ">
                <!-- <h4 class="m-4"><strong>آج کا اخبار </strong></h4> -->
                <!-- <h3 class=" section-tittle widget_title p-3 rounded text-white mb-3"
                                style="background-color: #109cde; width:152px; ">آج کا اخبار</h3> -->
                                <div class="section-tittle float-left mt-3">
                            <h3 class=" section-tittle text-center widget_title p-3 rounded text-white mb-3"
                                style="background-color: #109cde; width:152px; ">آج کا اخبار</h3>
                            </div>
            </div>
        </div>

        <div dir="rtl" class="row m-2">
            @foreach ($today_news as $paper)
                <div class="col-md-12 mb-2">
                    <div class="card gallery_pics">
                        <img class="card-img-top" src="{{ asset('assets/newspaperFiles/' . $paper->image) }}"
                            alt="Card image cap">
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="col-md-12 mt-5 mb-5">
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2">{{ $today_news->links('pagination::bootstrap-4') }}</div>
            <div class="col-md-5"></div>
        </div>
    </div>
@endsection

@push('frontJs')
@endpush
