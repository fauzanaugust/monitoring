 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0 text-dark">Data PJU Kampung Terang</h1>
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
                 <div class="col-md-12">
                     <!-- general form elements disabled -->
                     <div class="card card-primary">
                         <div class="card-header">
                             <h3 class="card-title">Tambah Data</h3>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <form method="post" action="" id="formData">
<!--                                 <div class="row">-->
                                     <div class="col-sm-12">
                                         <!-- text input -->
                                         <div class="form-group">
                                             <label>Pilih Lokasi</label>
                                             <div id='map' style='width: 100%; height: 500px;'></div>
                                             <div class="form-row">
                                                 <div class="form-group col-6">
                                                     <label>Latitude</label>
                                                     <input type="text" class="form-control" name="latitude" id="Latitude" placeholder="Latitude">
                                                 </div>
                                                 <div class="form-group col-6">
                                                     <label>Longitude</label>
                                                     <input type="text" class="form-control" name="longitude" id="Longitude" placeholder="Longitude">
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-sm-4">
                                         <div class="form-group">
                                             <label>Kode PJU</label>
                                             <input type="text" class="form-control" id="kode_pju" name="kode_pju" placeholder="Isi Kode PJU" value="PJU-">
                                         </div>
                                         <div class="form-row">
                                             <div class="form-group col-6">
                                                 <label>RW</label>
                                                 <select class="form-control" name="rw" id="rw">
                                                     <option value="">- Pilih -</option>
                                                     <option value="01">01</option>
                                                     <option value="02">02</option>
                                                     <option value="03">03</option>
                                                     <option value="04">04</option>
                                                     <option value="05">05</option>
                                                     <option value="06">06</option>
                                                 </select>
                                             </div>
                                             <div class="form-group col-6">
                                                 <label>RT</label>
                                                 <select class="form-control" name="rt" id="rt">
                                                     <option value="">- Pilih -</option>
                                                     <option value="01">01</option>
                                                     <option value="02">02</option>
                                                     <option value="03">03</option>
                                                     <option value="04">04</option>
                                                     <option value="05">05</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label>Alamat</label>
                                             <textarea type="text" class="form-control" name="alamat" placeholder="Isi Alamat"></textarea>
                                         </div>
<!--
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
-->
                                         <div class="form-group">
                                             <button type="submit" class="btn btn-primary btn-block" id="btnSave"><i class="icon fas fa-save"></i> Tambah</button>
                                         </div>
                                     </div>
<!--                                 </div>-->
                             </form>
                         </div>
                         <!-- /.card-body -->
                     </div>
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
             url: BASE_URL + "pju/getKelurahan",
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