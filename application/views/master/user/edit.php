<?php foreach($GET_SELECTED->result() as $rsData): ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User Data</h1>
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

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- general form elements disabled -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data</h3>
                        </div>
                        <!-- form start -->
                        <form id="formData" action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Isi Username" value="<?php echo $rsData->username; ?>">
                                </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Nama KWT/UMKM Pangan</label>
                                     <select class="form-control " name="id_data" id="id_data">
                                        <option value="">Pilih KWT/UKM PANGAN</option>
                                        <?php
                                            $GET_DATA = $this->db->query("SELECT * FROM mst_data");
                                            foreach($GET_DATA->result() as $rsCategory):
                                            if($rsCategory->id_data == $rsData->id_data ) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo "<option ".$selected." value=\"".$rsCategory->id_data."\">".$rsCategory->nama_alias."</option>";
                                            endforeach;
                                        ?>
                                    </select>
                                 </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Isi Password" value="<?php echo $rsData->password; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" name="role" id="role">
                                        <option value="">- Pilih -</option>
                                        <option value="KWT" <?php echo ($rsData->role == 'KWT') ? "selected": "" ?>>Kelompok Wanita Tani</option>
                                        <option value="UMKM" <?php echo ($rsData->role == 'UMKM') ? "selected": "" ?>>UMKM Pangan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Avatar</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="<?php echo base_url('assets/img/avatar/')?><?php echo $rsData->avatar; ?>" height="100px">
                                        </div>
                                        <div class="col-9">
                                            <input type="file" class="form-control" id="avatar" name="avatar">
                                            <input type="hidden" class="form-control" id="avatar_old" name="avatar_old" value="<?php echo $rsData->avatar; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="btnSave" id="btnSave">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php endforeach ?>