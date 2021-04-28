 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0 text-dark">Anggota KWT</h1>
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
                                     <label for="exampleInputEmail1">Nomor Induk Kependudukan (NIK)</label>
                                     <input type="text" class="form-control" id="nik" name="nik" placeholder="Isi Nomor Induk Kependudukan (NIK)">
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Nama Lengkap</label>
                                     <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" placeholder="Isi Nama Lengkap">
                                 </div>
                                 <div class="form-group">
                                     <label>Jenis Kelamin</label>
                                     <select class="form-control" name="jk" id="jk">
                                         <option value="">- Pilih -</option>
                                         <option value="Laki-laki">Laki-laki</option>
                                         <option value="Perempuan">Perempuan</option>
                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Anggota KWT</label>
                                     <select class="form-control " name="dataname" id="dataname" <?php if($this->session->userdata('sess_moka_role')!='Admin') echo 'disabled';?>>
                                         <option value="">Pilih KWT</option>
                                         <?php
                                            $userdata = $this->session->userdata('sess_moka_uid');
                                            $GET_DATA = $this->db->query("SELECT * FROM mst_data WHERE tipe='KWT'");
                                            foreach($GET_DATA->result() as $rsCategory):
                                            if($rsCategory->id_data == $userdata ) {
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
                                     <label>Alamat</label>
                                     <textarea type="text" class="form-control" name="alamat" placeholder="Isi Alamat KWT"></textarea>
                                 </div>
                                 <div class="form-row">
                                     <div class="form-group col-6">
                                         <label>Kecamatan</label>
                                         <select class="form-control " name="id_kecamatan" id="id_kecamatan" onchange="getKelurahan()">
                                             <option value="">Pilih Kecamatan</option>
                                             <?php
                                                $GET_KECAMATAN = $this->db->query("SELECT * FROM kecamatan");
                                                foreach($GET_KECAMATAN->result() as $rsKecamatan):
                                                echo "<option value=\"".$rsKecamatan->id_kecamatan."\">".$rsKecamatan->nama_kecamatan."</option>";
                                                endforeach;
                                            ?>
                                         </select>
                                     </div>
                                     <div class="form-group col-6">
                                         <label>Kelurahan</label>
                                         <select class="form-control" name="id_kelurahan" id="id_kelurahan">
                                             <option value="">Pilih Kelurahan</option>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputPassword1">Foto KTP</label>
                                     <input type="file" class="form-control" id="ktp" name="ktp">
                                     <span><i>ukuran file maksimal 2Mb</i></span>
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
 <script>
     function getKelurahan() {
         var URS = $('#id_kecamatan').val();

         $.ajax({
             type: "POST",
             url: BASE_URL + "kwt/getKelurahan",
             data: {
                 DATA: URS
             },
             cache: false,
             success: function(data) {
                 document.getElementById('id_kelurahan').innerHTML = "" + data + ""
             }
         });
     }
 </script>