@extends('layouts.frontend.head')

@section('content')
    <div class="container">
        <h4 class="text-center m-5"><strong>ڈیلی راستہ گیلری</strong></h4>
        <div dir="rtl" class="row mb-4">
            @foreach($galleries as $gallery)
                <div class="col-md-4">
                    <div class="card m-1">
                        <a href="{{ route('gallery.event', [$gallery->slug]) }}">
                        <img class="card-img-top" src="{{ asset('assets/gallaryFiles/'.$gallery->feature_image) }}" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <a href="{{ route('gallery.event', [$gallery->slug]) }}">
                            <h5 class="card-title">{{ $gallery->event_name }}</h5>
                        </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    </div>
@endsection
