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
                                <h1>User Add</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">All
                                            User</a></li>
                                    <li class="breadcrumb-item active">User Add</li>
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

                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" id="quickForm">
                        @CSRF
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Add New User</h3>

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
                                            <input type="text" id="inputName" name="name" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label for="inputEmail">User Email</label>
                                            <input type="email" id="inputEmail" name="email" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="inputPassword">User Password</label>
                                            <input type="password" id="inputPassword" name="password"
                                                class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <label>User phone</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" name="contact" class="form-control"
                                                    data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;"
                                                    data-mask="" inputmode="text">
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">User Address</label>
                                            <input type="text" id="inputName" name="address" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputClientCompany">User image</label>
                                            <div class="custom-file">
                                                <input type="file" name="photo" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose Image</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>User Role</label>
                                            <select class="form-control" name="role_id" style="width: 100%;">
                                                <option value="">--select role --</option>
                                                <option value="1">Admin</option>
                                                <option value="2">Author</option>

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

                                <input type="submit" value="Create new User" class="btn btn-success float-right">
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


        <script>
            $(function() {
                bsCustomFileInput.init();
            });
        </script>

        <script>
            $(function() {
                $('#quickForm').validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 4
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        password: {
                            required: true,
                            minlength: 6
                        },

                    },
                    messages: {

                        name: {
                            required: "Please provide a Name",
                            minlength: "Your name must be at least 4 characters long"
                        },

                        email: {
                            required: "Please enter a email address",
                            email: "Please enter a valid email address"
                        },
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 6 characters long"
                        },


                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });
            });
        </script>
    @endpush
