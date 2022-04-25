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
                                <h1>News Ad</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('ads.index') }}">All
                                            Ads</a></li>
                                    <li class="breadcrumb-item active">News Ad</li>
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

                    <form method="POST" action="{{ route('ads.update', [$ads->id]) }}" enctype="multipart/form-data" id="fileUploadForm">
                        @CSRF
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Ads</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="inputTitle">Ads Title</label>
                                            <input type="text" id="inputTitle" name="title" value={{ $ads->title }} class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputDescription">Ads Description</label>
                                            <textarea name="description" class="form-control" rows="4" placeholder="Write ...">value={{ $ads->description }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputClientCompany">Ads image</label>
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose Image</label>
                                            </div>

                                            <div class="">
                                                <a href="{{ asset('assets/adsFiles') . '/' . $ads->image }}?text=1"
                                                    data-toggle="lightbox"
                                                    data-title="{{ $ads->title }}"
                                                    data-gallery="gallery">
                                                    <img src="{{ asset('assets/adsFiles') . '/' . $ads->image }}?text=1"
                                                        class="img-fluid" alt="{{ $ads->title }}"
                                                        style="width:40px" />
                                                </a>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="inputClientCompany">Ads Video</label>
                                            <div class="custom-file">
                                                <input type="file" name="video" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose File</label>
                                            </div>
                                            <iframe style="height: 90px;width: 150px;" class="embed-responsive-item " src="{{ asset('assets/adsFiles') . '/' .$ads->video }}"></iframe>

                                        </div>


                                        <div class="form-group">
                                            <label for="inputUrl">Ads Url</label>
                                            <input type="text" id="inputUrl" value="{{ $ads->url }}" name="url" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputDate">Ads Date Upto</label>
                                            <input type="date" id="inputDate" value="{{ \Carbon\Carbon::parse($ads->date_upto)->format('Y-m-d')}}" name="date_upto" class="form-control">
                                        </div>


                                        <div class="form-group clearfix my-4">
                                            <div class="icheck-success d-inline">
                                                <input type="radio" name="status" {{ $ads->status == "active"? 'selected': '' }} value="active" id="radioSuccess1">
                                                <label for="radioSuccess1">Active</label>
                                                </label>
                                            </div>
                                            <div class="icheck-danger d-inline">
                                                <input type="radio" name="status" {{ $ads->status == "inactive"? 'selected': '' }} value="inactive" checked
                                                    id="radioSuccess2">
                                                <label for="radioSuccess2">In Active</label>
                                                </label>
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

                                <input type="submit" value="Publish Ad" class="btn btn-success float-right">
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

        <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
        <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>


        <script>
            $(function() {
                bsCustomFileInput.init();
            });
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
