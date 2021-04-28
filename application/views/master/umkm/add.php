 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0 text-dark">Data UMKM Pangan</h1>
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
                                 <div class="row">
                                     <div class="col-sm-7">
                                         <!-- text input -->
                                         <div class="form-group">
                                             <label>Pilih Lokasi</label>
                                             <div id='map' style='width: 100%; height: 610px;'></div>
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
                                     <div class="col-sm-5">
                                         <div class="form-group">
                                             <label>Nama UMKM Pangan</label>
                                             <input type="text" class="form-control" id="nama_alias" name="nama_alias" placeholder="Isi Nama UMKM Pangan">
                                         </div>
                                         <div class="form-group">
                                             <label>Nama Pemilik</label>
                                             <input type="text" class="form-control" id="ketua" name="ketua" placeholder="Isi Nama Pemilik">
                                         </div>
                                         <div class="form-group">
                                             <label>Contact Person</label>
                                             <input type="number" class="form-control" name="cp" placeholder="Isi Nomor Telepon/handphone yang bisa dihubungi">
                                         </div>
                                         <div class="form-group">
                                             <label>Kapasitas Produksi</label>
                                             <div class="input-group mb-3">
                                                 <input type="number" class="form-control" name="kapasitasproduksi" placeholder="Isi Kapasitas Produksi">
                                                 <div class="input-group-append">
                                                     <span class="input-group-text"><i class=""></i>Kg</span>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label>Legalitas</label>
                                             <input type="file" class="form-control" id="legalitas" name="legalitas">
                                             <span><i>* Jika Belum Ada silahkan Kosongkan</i></span><br>
                                             <span><i>* Jika lebih dari 1 lembar, gunakan file PDF</i></span>
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
                                             <button type="submit" class="btn btn-primary btn-block" id="btnSave"><i class="icon fas fa-save"></i> Tambah</button>
                                         </div>
                                     </div>
                                 </div>
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