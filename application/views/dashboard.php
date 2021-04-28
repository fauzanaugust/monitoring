    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">DASHBOARD</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="callout callout-success">
                <h5>Selamat Datang</h5>
                <p>anda berhasil login sebagai <strong><?php echo $this->session->userdata('sess_moka_aliasname'); ?> </strong> | login terakhir : <strong><?php echo $this->session->userdata('sess_moka_lastlogin'); ?> </strong></p>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="far fa-lightbulb"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah PJU</span>
                            <span class="info-box-number">
                                <?php  
                                    $query = $this->db->query('SELECT * FROM mst_data WHERE tipe="KWT" ');
                                    echo $query->num_rows();                        
                                ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="far fa-lightbulb"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah PJU Bermasalah</span>
                            <span class="info-box-number">
                            <?php  
                                $query = $this->db->query('SELECT * FROM mst_data WHERE tipe="UMKM" ');
                                echo $query->num_rows();                        
                            ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="far fa-lightbulb"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah PJU Dalam Perbaikan</span>
                            <span class="info-box-number">
                                <?php  
                                    $query = $this->db->query('SELECT * FROM mst_produk');
                                    echo $query->num_rows();                        
                                ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">RW</span>
                            <span class="info-box-number">
                            <?php  
                                $query = $this->db->query('SELECT * FROM mst_anggota');
                                echo $query->num_rows();                        
                            ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content -->