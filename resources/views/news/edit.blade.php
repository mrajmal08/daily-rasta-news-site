@extends('layouts.app')
@push('css')
@endpush

@section('content')

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            @include('layouts.navbar');
            @include('layouts.sidebar');

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Edit Post</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">All
                                            News</a></li>
                                    <li class="breadcrumb-item active">Edit Post</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">

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

                    <?php

                            $cat_name = \App\Models\Category::where('id', $news->cat_id)->pluck('title')->first();

                    ?>

                    <form method="POST" action="{{ route('news.update', [$news->id]) }}" enctype="multipart/form-data" id="quickForm">
                        @CSRF
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">

                                    <div class="card-header">
                                        <h3 class="card-title">News</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>

                                    </div>

                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>News Category</label>
                                            <select class="form-control" name="cat_id" style="width: 100%;">
                                                <option {{ $news->cat_id? 'selected': '' }} value="{{ $news->cat_id }}">{{ $cat_name }}</option>
                                                @foreach ($categories as $category)

                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>

                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputTitle">News Title</label>
                                            <input type="text" id="inputTitle" value="{{ $news->title }}" name="title" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputName">News Description</label>
                                            <div class="card-body">
                                                <textarea id="summernote" name="description">
                                                    {!! $news->description !!}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label>News Type</label>
                                            <select class="form-control" name="type" style="width: 100%;">
                                                <option {{ $news->type? 'selected' : '' }} value="{{ $news->type }}">{{ $news->type }}</option>
                                                <option value="trending">Trending</option>
                                                <option value="popular">Popular</option>
                                            </select>
                                        </div>

                                        <div class="form-group clearfix my-4">
                                            <div class="icheck-success d-inline">
                                                <input type="radio" name="breaking_news" {{ $news->breaking_news == '1'? 'selected': '' }} value="1" id="radioSuccess1">
                                                <label for="radioSuccess1"> Breaking News</label>
                                                </label>
                                            </div>
                                            <div class="icheck-success d-inline">
                                                <input type="radio" name="breaking_news" {{ $news->breaking_news == '0'? 'selected': '' }} value="0" checked id="radioSuccess2">
                                                <label for="radioSuccess2"> Normal News</label>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputClientCompany">Top image</label>
                                            <div class="custom-file">
                                                <input type="file" name="top_image" class="custom-file-input"
                                                    id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose Image</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputClientCompany">Feature image</label>
                                            <div class="custom-file">
                                                <input type="file" name="feature_image" class="custom-file-input"
                                                    id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose Image</label>
                                            </div>

                                            <div class="">
                                                <a href="{{ asset('assets/postImages') . '/' . $news->feature_image }}?text=1"
                                                    data-toggle="lightbox"
                                                    data-title="{{ $news->title }}"
                                                    data-gallery="gallery">
                                                    <img src="{{ asset('assets/postImages') . '/' . $news->feature_image }}?text=1"
                                                        class="img-fluid" alt="{{ $news->title }}"
                                                        style="width:40px" />
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>

                        </div>
                        <div class="row mb-4">
                            <div class="col-12">

                                <input type="submit" value="Update News" class="btn btn-success float-right">
                            </div>
                        </div>
                    </form>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            @include('layouts.footer');

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
    @endsection

    @push('js')
        <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <!-- CodeMirror -->
        <script src="{{ asset('assets/plugins/codemirror/codemirror.js') }}"></script>
        <script src="{{ asset('assets/plugins/codemirror/mode/css/css.js') }}"></script>
        <script src="{{ asset('assets/plugins/codemirror/mode/xml/xml.js') }}"></script>
        <script src="{{ asset('assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>


        <script src="{{ asset('assets/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>


        <script>
            $(function() {
                bsCustomFileInput.init();
            });
        </script>

        <script>
            $(function() {
                // Summernote
                $('#summernote').summernote()

                // CodeMirror
                CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                    mode: "htmlmixed",
                    theme: "monokai"
                });
            })
        </script>

    <script>
        $(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({
                gutterPixels: 3
            });
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>

    @endpush
