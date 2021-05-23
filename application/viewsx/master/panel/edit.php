<?php foreach($GET_SELECTED->result() as $rsData): ?>

 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0 text-dark">Data PANEL PJU Kampung Terang</h1>
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
                     <div class="card card-warning">
                         <div class="card-header">
                             <h3 class="card-title">Ubah Data</h3>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <form method="post" action="" id="formData">
                                 <div class="row">
                                     <div class="col-sm-8">
                                         <!-- text input -->
                                         <div class="form-group">
                                             <label>Pilih Lokasi</label>
                                             <div id='map' style='width: 100%; height: 305px;'></div>
                                             <div class="form-row">
                                                 <div class="form-group col-6">
                                                     <label>Latitude</label>
                                                     <input type="text" class="form-control" name="latitude" id="Latitude" placeholder="Latitude" value="<?php echo $rsData->latitude; ?>">
                                                 </div>
                                                 <div class="form-group col-6">
                                                     <label>Longitude</label>
                                                     <input type="text" class="form-control" name="longitude" id="Longitude" placeholder="Longitude" value="<?php echo $rsData->longitude; ?>">
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-sm-4">
                                         <div class="form-group">
                                             <label>Kode PJU</label>
                                             <input type="text" class="form-control" id="kode_pju" name="kode_pju" placeholder="Isi Kode PJU" value="<?php echo $rsData->kode_pju; ?>">
                                         </div>
                                         <div class="form-row">
                                             <div class="form-group col-6">
                                                 <label>RW</label>
                                                 <select class="form-control" name="rw" id="rw">
                                                     <option value="">- Pilih -</option>
                                                     <option value="01" <?php echo ($rsData->rw == '01') ? "selected": "" ?>>01</option>
                                                     <option value="02" <?php echo ($rsData->rw == '02') ? "selected": "" ?>>02</option>
                                                     <option value="03" <?php echo ($rsData->rw == '03') ? "selected": "" ?>>03</option>
                                                     <option value="04" <?php echo ($rsData->rw == '04') ? "selected": "" ?>>04</option>
                                                     <option value="05" <?php echo ($rsData->rw == '05') ? "selected": "" ?>>05</option>
                                                     <option value="06" <?php echo ($rsData->rw == '06') ? "selected": "" ?>>06</option>
                                                 </select>
                                             </div>
                                             <div class="form-group col-6">
                                                 <label>RT</label>
                                                 <select class="form-control" name="rt" id="rt">
                                                     <option value="">- Pilih -</option>
                                                     <option value="01" <?php echo ($rsData->rt == '01') ? "selected": "" ?>>01</option>
                                                     <option value="02" <?php echo ($rsData->rw == '02') ? "selected": "" ?>>02</option>
                                                     <option value="03" <?php echo ($rsData->rw == '03') ? "selected": "" ?>>03</option>
                                                     <option value="04" <?php echo ($rsData->rw == '04') ? "selected": "" ?>>04</option>
                                                     <option value="05" <?php echo ($rsData->rw == '05') ? "selected": "" ?>>05</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="form-group">
                                             <label>Alamat</label>
                                             <textarea type="text" class="form-control" name="alamat" placeholder="Isi Alamat pju"><?php echo $rsData->alamat; ?></textarea>
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
                                             <button type="submit" class="btn btn-primary btn-block" id="btnSave"><i class="icon fas fa-save"></i> Ubah</button>
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
    var curLocation = [0, 0];
    if (curLocation[0] == 0 && curLocation[1] == 0) {
        curLocation = [<?php echo $rsData->latitude; ?>, <?php echo $rsData->longitude; ?>];
    }

    var map = L.map('map').setView([<?php echo $rsData->latitude; ?>, <?php echo $rsData->longitude; ?>], 16);
    L.tileLayer('https://api.mapbox.com/styles/v1/fauzanaugust/cke3usw670kap19o8ccs6vi3z/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiZmF1emFuYXVndXN0IiwiYSI6ImNrZTN1aTVqazBtenQydnA4ZGU0eTEzdDcifQ.xFI1QjnDv75hMhCSZaBhdw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(map);

    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation, {
        draggable: 'true'
    });

    marker.on('dragend', function (event) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        $("#Latitude").val(position.lat);
        $("#Longitude").val(position.lng).keyup();
    });

    $("#Latitude, #Longitude").change(function () {
        var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        map.panTo(position);
    });
    map.addLayer(marker);
</script>

<!--
<script>
    $(document).ready(function() {
        getKelurahan();
    });
    
    function getKelurahan() {
        var URS = $('#id_kecamatan').val();
        var KELURAHAN_ID = '<?php echo $rsData->id_kelurahan; ?>';

        $.ajax({
            type: "POST",
            url: BASE_URL + "pju/getKelurahan",
            data: {
                DATA: URS
            },
            cache: false,
            success: function(data) {
                document.getElementById('id_kelurahan').innerHTML = "" + data + "";
                $("#id_kelurahan option[value='" + KELURAHAN_ID + "']").prop("selected", "true");
                $('#id_kelurahan').select().select('val', KELURAHAN_ID);
            }
        });
    }    
</script>
-->

<?php
endforeach
?>