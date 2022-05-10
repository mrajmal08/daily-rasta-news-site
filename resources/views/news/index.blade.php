@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @endpush

@section('content')

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">


            @include('layouts.navbar');
            @include('layouts.sidebar');

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                @if (Session::has('success'))
                    {{ Session::get('success') }}
                @elseif(Session::has('warning'))
                    {{ Session::get('warning') }}
                @endif

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>News</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">News</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">


                                <div class="card">
                                    <div class="card-header">
                                        <a href="{{ route('news.create') }}" class="btn btn-success">Add New
                                            News</a>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    {{-- <th>Description</th> --}}
                                                    <th>Feature Image</th>
                                                    <th>Type</th>
                                                    <th>Breaking News</th>
                                                    {{-- <th>Total views</th> --}}
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($news as $item)
                                                    <tr>
                                                        <td>{{ $item->title }}</td>
                                                        {{-- <td>{!! $item->description !!}</td> --}}
                                                        <td>
                                                            <div class="">
                                                                <a href="{{ asset('assets/postImages') . '/' . $item->feature_image }}?text=1"
                                                                    data-toggle="lightbox"
                                                                    data-title="{{ $item->title }}"
                                                                    data-gallery="gallery">
                                                                    <img src="{{ asset('assets/postImages') . '/' . $item->feature_image }}?text=1"
                                                                        class="img-fluid" alt="{{ $item->title }}"
                                                                        style="width:40px" />
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if($item->type == 'trending'){
                                                                echo '<span class="badge badge-info">Trending</span>';
                                                            }else{
                                                                echo '<span class="badge badge-secondary">Popular</span>';

                                                            }
                                                            ?>
                                                        </td>

                                                        <td>
                                                            <?php
                                                            if($item->breaking_news == '1'){
                                                                echo '<span class="badge badge-success">Breaking News</span>';
                                                            }else{
                                                                echo '<span class="badge badge-warning">Normal News</span>';
                                                            }
                                                            ?>

                                                        </td>
                                                        {{-- <td>{{ $item->views }}</td> --}}

                                                        <td>
                                                            <a href="{{ route('news.edit', [$item->id]) }}"
                                                                class="btn btn-warning btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{ route('news.delete', [$item->id]) }}"
                                                                class="btn btn-danger btn-sm delete-btn">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Title</th>
                                                    {{-- <th>Description</th> --}}
                                                    <th>Feature Image</th>
                                                    <th>Type</th>
                                                    <th>Breaking News</th>
                                                    {{-- <th>Total views</th> --}}
                                                    <th>Action</th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
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
        <!-- DataTables  & Plugins -->
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

        <script src="{{ asset('assets/plugins/filterizr/jquery.filterizr.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

        {{-- Seet Alert --}}


        <!-- AdminLTE App -->

        <!-- Page specific script -->
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
            $('.delete-btn').on('click', function(event) {
                event.preventDefault();

                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            });

                            var url = $(this).attr('href');
                            $.ajax({
                                url: url,
                                type: 'GET',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(result) {
                                    swal("Poof! Your imaginary file has been deleted!", {
                                        icon: "success",
                                    });
                                    window.location.reload();
                                }
                            });


                        } else {

                            swal("Your imaginary file is safe!");
                        }
                    });


            });

            </script>
    @endpush
