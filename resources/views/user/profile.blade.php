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
                        <h1>Profile</h1>
                      </div>
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                          <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                      </div>
                    </div>
                  </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                          <div class="card-body box-profile">
                            <div class="text-center">
                              {{-- <img class="profile-user-img img-fluid img-circle"
                                   src="{{ asset('assets/userImages')."/".$user->photo }}"
                                   alt="User profile picture" style="height: 100px;"> --}}

                                   <a href="{{ asset('assets/userImages')."/".$user->photo  }}?text=1"
                                    data-toggle="lightbox"
                                    data-title="{{ $user->name }}"
                                    data-gallery="gallery">
                                    <img src="{{ asset('assets/userImages')."/".$user->photo  }}?text=1"
                                        class="img-fluid profile-user-img img-fluid img-circle" alt="{{ $user->name }}"
                                        style="height:100px" />
                                </a>


                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>

                            <p class="text-muted text-center">{{ $user->email }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                              <li class="list-group-item">
                                <b>Phone</b> <a class="float-right">{{ $user->contact }}</a>
                              </li>

                            </ul>

                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->

                        <!-- /.card -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-9">
                        <div class="card">
                          <div class="card-header p-2">
                            <ul class="nav nav-pills">
                              <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Profile</a></li>
                              <li class="nav-item"><a class="nav-link" href="#changePassword" data-toggle="tab">Change Password</a></li>
                            </ul>

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


                          </div><!-- /.card-header -->
                          <div class="card-body">
                            <div class="tab-content">
                              <div class="active tab-pane" id="settings">
                                <!-- Post -->

                                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="quickForm">
                                    @csrf
                                    <div class="form-group row">
                                      <label for="inputName" class="col-sm-2 col-form-label">User Name</label>
                                      <div class="col-sm-10">
                                        <input type="text" id="inputName" value="{{ $user->name }}" name="name" class="form-control">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputEmail" class="col-sm-2 col-form-label">User Email</label>
                                      <div class="col-sm-10">
                                        <input type="email" id="inputEmail" value="{{ $user->email }}" name="email" class="form-control">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputName2" class="col-sm-2 col-form-label">User phone</label>
                                      <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                                <input type="text" name="contact" value="{{ $user->contact }}" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputExperience" class="col-sm-2 col-form-label">Address</label>
                                      <div class="col-sm-10">
                                        <input type="text" id="inputName" value="{{ $user->address }}" name="address" class="form-control">
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="inputSkills" class="col-sm-2 col-form-label">User Image</label>
                                      <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" name="photo" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <div class="offset-sm-2 col-sm-10">
                                        <div class="checkbox">
                                          <label>
                                            {{-- <input type="checkbox"> I agree to the <a href="#">terms and conditions</a> --}}
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Update Profile</button>
                                      </div>
                                    </div>
                                  </form>

                                <!-- /.post -->

                              </div>

                              <div class="tab-pane" id="changePassword">
                                <form id="validatedForm" method="POST" action="{{ route('profile.password') }}" class="form-horizontal">
                                    @csrf
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Old Password</label>
                                    <div class="col-sm-9">
                                      <input type="password" name="old_password" class="form-control" id="old_password">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                      <input type="password" name="new_password" class="form-control" id="new_password">
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                      <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                      <button type="submit" class="btn btn-success">Update Password</button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                              <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                          </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div><!-- /.container-fluid -->
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

        <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
        <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>

        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
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

<script>


            $(function() {
                $('#validatedForm').validate({
                    rules: {
                        old_password: {
                            required: true,
                            minlength: 6
                        },
                        new_password : {
                            required: true,
                            minlength : 6
                        },
                        confirm_password : {
                            minlength : 6,
                            equalTo : "#new_password"
                        }

                    },
                    messages: {

                        old_password: {
                            required: "Please provide old Password",
                            minlength: "Your password must be at least 6 characters long"
                        },

                        new_password: {
                            required: "Please provide New Password",
                            minlength: "Your new password must be at least 6 characters long"

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
