<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/template') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('/template') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/template') }}/dist/css/responsive_tbl.css">

    <script src="{{ asset('/template') }}/plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/template') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{ asset('/template') }}/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>
    .brand-link {
        display: block;
        font-size: 1.25rem;
        line-height: 1.5;
        transition: width .3s ease-in-out;
        white-space: nowrap;
        text-align: center;
        font-weight: bold;
        background: #fff;
    }
</style>

<script>
    $(function(){
        $('.alert-success').delay(100).fadeOut('slow');
    });
</script>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" style="overflow: auto">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <button id="keluar" class="btn btn-success">Log Out</button>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link">
                    <span class="brand-text font-weight-light" style="color: #000"><b>Administrator</b></span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                        </div>
                        <div class="info">
                            <a href="{{ Url('profile') }}" class="d-block">Admin Panel</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item active">
                            <a href="{{ Url("home") }}" class="nav-link active">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Url("konsumen") }}" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Konsumen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Url("transaksi") }}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Transaksi</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ Url("harga") }}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Master Harga</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"><i class="fas fa-th-large"></i> @yield('title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="https://ismarianto12.github.io/"
                target="_blank">Ismarianto</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 0.1
                </div>
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>

        <script>
            $(function(){
                $('#keluar').on('click',function(){
                    $('#keluar_app').modal('show');
                });
            });
        </script>
        {{-- modal aplikasi --}}

        <div class="modal fade" id="keluar_app" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-check"></i> Konfirmasi</h5>
                    <br />

                        <hr />
                     <tt>Anda akan keluar dari aplikasi ? </tt>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ Url('logout') }}" method="POST">
                        @csrf
                        <button type="submit" name="submit" class="btn btn-success"><i
                            class="fas fa-th-large"></i>&nbsp;&nbsp;<b>
                                Logout</b></button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- end modal aplikasi --}}

            <!-- jQuery -->
            <script src="{{ asset('/template') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="{{ asset('/template') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
            <script src="{{ asset('/template') }}/dist/js/adminlte.min.js"></script>
            <script src="{{ asset('/template') }}/dist/js/responsive.js"></script>
            {{-- add onds --}}
            <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
        </body>

        </html>
