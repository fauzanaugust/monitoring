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
                                     <input type="text" class="form-control" id="username" name="username" placeholder="Isi Username">
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Nama KWT/UMKM Pangan</label>
                                     <select class="form-control " name="id_data" id="id_data">
                                        <option value="">Pilih KWT/UKM PANGAN</option>
                                         <?php
                                            $GET_DATA = $this->db->query("SELECT * FROM mst_data");
                                            foreach($GET_DATA->result() as $rsData):
                                            echo "<option value=\"".$rsData->id_data."\">".$rsData->nama_alias."</option>";
                                            endforeach;
                                        ?>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputPassword1">Password</label>
                                     <input type="password" class="form-control" id="password" name="password" placeholder="Isi Password">
                                 </div>
                                 <div class="form-group">
                                     <label>Role</label>
                                     <select class="form-control" name="role" id="role">
                                         <option value="">- Pilih -</option>
                                         <option value="KWT">Kelompok Wanita Tani</option>
                                         <option value="UMKM">UMKM Pangan</option>
                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputPassword1">Avatar</label>
                                     <input type="file" class="form-control" id="avatar" name="avatar">
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