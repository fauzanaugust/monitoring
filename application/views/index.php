<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Monitoring | Dinas Ketahanan Pangan</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css');?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/adminlte/adminlte.min.css');?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <link href="<?php echo base_url()?>assets/vendor/leaflet/leaflet.css" rel="stylesheet">
    <script src="<?php echo base_url()?>assets/vendor/leaflet/leaflet.js"></script>

    <script type="text/javascript">
        var BASE_URL = '<?php echo base_url(); ?>';
        var CURRENT_PATH = window.location.href;
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                        <img src="<?php echo base_url('assets/img/avatar/')?><?php echo $this->session->userdata('sess_moka_avatar'); ?>" alt="Avatar" height="20px">
                        <i><strong><span></span><?php echo $this->session->userdata('sess_moka_aliasname'); ?></strong></i>
                        <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" onclick="return logout()" class="dropdown-item">
                            <i class="fas fa-power-off mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="<?php echo base_url('assets/img/logo.png');?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><strong>SIMOKA</strong></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                    </div>
                    <div class="info">
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?php echo site_url('backend'); ?>" class="nav-link <?php if($this->uri->segment(1)=='backend') echo 'active';?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        
<!--
                        <li class="nav-item">
                            <a href="<?php echo site_url('profile'); ?>" class="nav-link <?php if($this->uri->segment(1)=='profile') echo 'active';?>">
                                <i class="nav-icon fas fa-id-badge"></i>
                                <p>Profile</p>
                            </a>
                        </li>
-->
                        <?php if($this->session->userdata('sess_moka_role')=='Admin'):?>
                        
                        <li class="nav-item has-treeview <?= $this->uri->segment(1) == 'kwt' || $this->uri->segment(1) == 'kwt_anggota' ||  $this->uri->segment(1) == 'kwt_produksi' ? "menu-open" : '' ?>">
                            <a href="#" class="nav-link <?= $this->uri->segment(1) == 'kwt' || $this->uri->segment(1) == 'kwt_anggota' ||  $this->uri->segment(1) == 'kwt_produksi' ? "active" : '' ?>">
                                <i class="nav-icon far fa-lightbulb"></i>
                                <p>PJU Kampung Terang<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo site_url('kwt'); ?>" class="nav-link <?php if($this->uri->segment(1)=='kwt') echo 'active';?>">
                                        <i class="far fa-circle nav-icon"></i><p>Daftar KWT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('kwt_anggota'); ?>" class="nav-link <?php if($this->uri->segment(1)=='kwt_anggota') echo 'active';?>"><i class="far fa-circle nav-icon"></i>
                                        <p>Anggota KWT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('kwt_produksi'); ?>" class="nav-link <?php if($this->uri->segment(1)=='kwt_produksi') echo 'active';?>">
                                        <i class="far fa-circle nav-icon"></i><p>Produksi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('komoditas'); ?>" class="nav-link <?php if($this->uri->segment(1)=='komoditas') echo 'active';?>">
                                        <i class="far fa-circle nav-icon"></i><p>Komoditas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item has-treeview <?= $this->uri->segment(1) == 'umkm' || $this->uri->segment(1) == 'product' ? "menu-open" : '' ?>">
                            <a href="#" class="nav-link <?= $this->uri->segment(1) == 'umkm' || $this->uri->segment(1) == 'product' ? "active" : '' ?>">
                                <i class="nav-icon fas fa-clipboard"></i>
                                <p>Laporan Gangguan<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo site_url('umkm'); ?>" class="nav-link <?php if($this->uri->segment(1)=='umkm') echo 'active';?>">
                                        <i class="far fa-circle nav-icon"></i><p>Daftar UMKM Pangan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('product'); ?>" class="nav-link <?php if($this->uri->segment(1)=='product') echo 'active';?>"><i class="far fa-circle nav-icon"></i>
                                        <p>Produk</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?php echo site_url('user'); ?>" class="nav-link <?php if($this->uri->segment(1)=='user') echo 'active';?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>User Account</p>
                            </a>
                        </li>
                        
                        
                        <?php elseif($this->session->userdata('sess_moka_role')=='KWT'):?>
                        <li class="nav-item has-treeview <?= $this->uri->segment(1) == 'kwt' || $this->uri->segment(1) == 'kwt_anggota' ||  $this->uri->segment(1) == 'kwt_produksi' ? "menu-open" : '' ?>">
                            <a href="#" class="nav-link <?= $this->uri->segment(1) == 'kwt' || $this->uri->segment(1) == 'kwt_anggota' ||  $this->uri->segment(1) == 'kwt_produksi' ? "active" : '' ?>">
                                <i class="nav-icon fas fa-seedling"></i>
                                <p>Kelompok Wanita Tani<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo site_url('kwt'); ?>" class="nav-link <?php if($this->uri->segment(1)=='kwt') echo 'active';?>">
                                        <i class="far fa-circle nav-icon"></i><p>Daftar KWT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('kwt_anggota'); ?>" class="nav-link <?php if($this->uri->segment(1)=='kwt_anggota') echo 'active';?>"><i class="far fa-circle nav-icon"></i>
                                        <p>Anggota KWT</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('kwt_produksi'); ?>" class="nav-link <?php if($this->uri->segment(1)=='kwt_produksi') echo 'active';?>">
                                        <i class="far fa-circle nav-icon"></i><p>Produksi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('komoditas'); ?>" class="nav-link <?php if($this->uri->segment(1)=='komoditas') echo 'active';?>">
                                        <i class="far fa-circle nav-icon"></i><p>Komoditas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <?php else:?>
                        <li class="nav-item has-treeview <?= $this->uri->segment(1) == 'umkm' || $this->uri->segment(1) == 'product' ? "menu-open" : '' ?>">
                            <a href="#" class="nav-link <?= $this->uri->segment(1) == 'umkm' || $this->uri->segment(1) == 'product' ? "active" : '' ?>">
                                <i class="nav-icon fas fa-utensils"></i>
                                <p>UMKM Pangan<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo site_url('umkm'); ?>" class="nav-link <?php if($this->uri->segment(1)=='umkm') echo 'active';?>">
                                        <i class="far fa-circle nav-icon"></i><p>Daftar UMKM Pangan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('product'); ?>" class="nav-link <?php if($this->uri->segment(1)=='product') echo 'active';?>"><i class="far fa-circle nav-icon"></i>
                                        <p>Produk</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <?php endif;?>
                        <li class="nav-item">
                            <a href="<?php echo site_url('backend/doLogout'); ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php
                    $this->load->view($template);
            ?>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Monitoring KWT
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2020 <a href="https://dkp.tangerangkota.go.id">Dinas Ketahanan Pangan</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?php echo base_url()?>assets/vendor/sweetalert2/sweetalert2.all.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/jquery-validation/additional-methods.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>assets/js/adminlte/adminlte.min.js"></script>

    <?php
        if(isset($jsFile)) {
            echo "<script src=\"".base_url('assets/js/module/'.$jsFile)."\"></script>";
        }
    ?>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        })
    </script>
    <script>
        $(function() {
            $('#kwtTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
            $('#umkmTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });
    </script>
    <script>

        function logout() {
            Swal.fire({
                title: 'Konfirmasi Sign Out',
                text: "Apakah anda yakin ingin keluar dari aplikasi ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.value) {
                    window.location = BASE_URL + 'Backend/doLogout';
                }
            })
        }
    </script>
</body>

</html>