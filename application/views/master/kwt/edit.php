<?php foreach($GET_SELECTED->result() as $rsData): ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Kelompok Wanita Tani</h1>
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
                            <h3 class="card-title">EDIT Data</h3>
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
                                                    <input type="text" class="form-control" name="latitude" id="Latitude" placeholder="Latitude" value="<?php echo $rsData->latitude; ?>">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Longitude</label>
                                                    <input type="text" class="form-control" name="longitude" id="Longitude" placeholder="Longitude" value="<?php echo $rsData->longitude; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Nama Kelompok Wanita Tani</label>
                                            <input type="text" class="form-control" id="nama_alias" name="nama_alias" placeholder="Isi Nama KWT" value="<?php echo $rsData->nama_alias; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Ketua</label>
                                            <input type="text" class="form-control" id="ketua" name="ketua" placeholder="Isi Nama Ketua" value="<?php echo $rsData->ketua; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Contact Person</label>
                                            <input type="text" class="form-control" name="cp" placeholder="Isi Nomor Telepon/handphone yang bisa dihubungi" value="<?php echo $rsData->cp; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Luas Lahan</label>
                                            <input type="number" class="form-control" name="luaslahan" placeholder="Isi Luas Lahan" value="<?php echo $rsData->luaslahan; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Legalitas</label>
                                            <input type="file" class="form-control" id="legalitas" name="legalitas">
                                            <input type="hidden" class="form-control" id="legalitas_old" name="legalitas_old" value="<?php echo $rsData->legalitas; ?>">
                                            <a class="btn">
                                                <i class="fas fa-file-pdf"></i> <?php echo $rsData->legalitas; ?>
                                            </a><br>
                                            <span><i>* Jika Belum Ada silahkan Kosongkan</i></span><br>
                                            <span><i>* Jika lebih dari 1 lembar, gunakan file PDF</i></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea type="text" class="form-control" name="alamat" placeholder="Isi Alamat KWT"><?php echo $rsData->alamat; ?></textarea>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label>Kecamatan</label>
                                                <select class="form-control " name="id_kecamatan" id="id_kecamatan" onchange="getKelurahan()">
                                                    <option value="">Pilih Kecamatan</option>
                                                    <?php
                                                        $GET_KECAMATAN = $this->db->query("SELECT * FROM kecamatan");
                                                        foreach($GET_KECAMATAN->result() as $rsCategory):
                                                        if($rsCategory->id_kecamatan == $rsData->id_kecamatan ) {
                                                            $selected = 'selected';
                                                        } else {
                                                            $selected = '';
                                                        }
                                                        echo "<option ".$selected." value=\"".$rsCategory->id_kecamatan."\">".$rsCategory->nama_kecamatan."</option>";
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
                                            <button type="submit" class="btn btn-primary btn-block" id="btnSave"><i class="icon fas fa-save"></i> Update</button>
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

    var map = L.map('map').setView([-6.175659, 106.6556966], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
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
<script>
    $(document).ready(function() {
        getKelurahan();
    });
    
    function getKelurahan() {
        var URS = $('#id_kecamatan').val();
        var KELURAHAN_ID = '<?php echo $rsData->id_kelurahan; ?>';

        $.ajax({
            type: "POST",
            url: BASE_URL + "kwt/getKelurahan",
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

<?php
endforeach
?>