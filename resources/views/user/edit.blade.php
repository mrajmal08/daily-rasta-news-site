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
                                <h1>User Edit</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">All
                                        Users</a></li>
                                    <li class="breadcrumb-item active">User Edit</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <form method="POST" action="{{ url('/user/update')."/".$user->id }}" enctype="multipart/form-data" id="quickForm">
                        @CSRF
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Update User</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">


                                        <div class="form-group">
                                            <label for="inputName">User Name</label>
                                            <input type="text" id="inputName" value="{{ $user->name }}" name="name" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label for="inputEmail">User Email</label>
                                            <input type="email" id="inputEmail" value="{{ $user->email }}" name="email" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword">User Password</label>
                                            <input type="password" id="inputPassword" name="password" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>User phone</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                    <input type="text" name="contact" value="{{ $user->contact }}" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputDescription">User Address</label>
                                            <input type="text" id="inputName" value="{{ $user->address }}" name="address" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputClientCompany">User image</label>
                                            <div class="custom-file">
                                                <input type="file" name="photo" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            <div class="">
                                                <a href="{{ asset('assets/userImages') . '/' . $user->photo }}?text=1"
                                                    data-toggle="lightbox"
                                                    data-title="{{ $user->name }}"
                                                    data-gallery="gallery">
                                                    <img src="{{ asset('assets/userImages') . '/' . $user->photo }}?text=1"
                                                        class="img-fluid" alt="{{ $user->name }}"
                                                        style="width:40px" />
                                                </a>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>User Role</label>
                                            <select class="form-control select2" name="role_id" style="width: 100%;">
                                              <option>--select role --</option>
                                              <option {{ $user->role_id? 'selected':'' }} value="{{ $user->role_id }}" > <?php if($user->role_id == 1){ echo 'Admin'; }else{ echo 'Author'; } ?> </option>
                                              <option value="1" >Admin</option>
                                              <option value="2" >Author</option>

                                            </select>
                                          </div>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>

                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <input type="submit" value="Update User" class="btn btn-success float-right">
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
