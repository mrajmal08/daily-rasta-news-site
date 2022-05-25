@extends('layouts.frontend.head')

@push('frontCss')
    <style>
        .gallery_pics_holder {
            border: px solid green;
            width: 100%;
            text-align: center;
            height: 350px;
            display: table;
        }

        .gallery_pics {
            display: inline-block;
            width: 300px;
            height: 300px;
            margin: 10px;
            text-align: center;
            background-color: #3C0;
        }

        .gallery_pics img {
            width: 100%;
            height: 100%;
        }

        .gallery_pics:hover {
            cursor: pointer;
        }

        .gallery_pics.fullscreen img {
            width: 100%;
            height: 100%;
        }

        .gallery_pics.fullscreen {
            z-index: 9999;
            position: fixed;
            margin: 0 auto;

            height:100%;
            width:auto;
            top:0;
                
            background-color: #0FF;
        }

    </style>
@endpush

@section('content')
    <div class="container">
        <h4 class="text-center m-4"><strong>{{ $event_name }} گیلری </strong></h4>
        <div dir="rtl" class="row m-2">
            @if (!$gallary_event->isEmpty())
                @foreach ($gallary_event as $gallery)
                    <div class="col-md-4 mb-2">
                        <div class="card gallery_pics">
                            <img class="card-img-top" src="{{ asset('assets/gallaryFiles/' . $gallery->image) }}"
                                alt="Card image cap">
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="text-center m-5">
                        <h4 style="color: brown">کوئی تصویر نہیں ملی</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
    </div>
@endsection

@push('frontJs')
    <script>
        $(document).ready(function() {
            $('.gallery_pics').click(function(e) {
                // Change Selector Here
                $(this).toggleClass('fullscreen');
            });
        });
    </script>
@endpush
