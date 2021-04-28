<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>ANGGOTA KWT</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    
                    <h3 class="card-title">
                        <button type="button" class="btn btn-block bg-gradient-primary" onclick="javascript:location.href='<?php echo base_url('kwt_anggota/add'); ?>'"><i class="icon fas fa-plus-circle"></i> Tambah Data</button>
                    </h3>
                    
                </div>
                <div class="card-body table-responsive">
                    <table id="kwtTable" name="kwtTable" class="table table-hover dataTable table-striped w-full" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Nama KWT</th>
                                <th>Alamat</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Foto KTP</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $iLoop = 1;                        
                        $GET_DATA = $this->db->query("
                        SELECT 
                              u.`nama_kecamatan`,
                              p.`nama_kelurahan`,
                              n.`nama_alias`,
                              k.`nik`,
                              k.`nama_anggota`,
                              k.`alamat`,
                              k.`jk`,
                              k.`ktp`,
                              k.`id_anggota`,
                              k.`id_data`,                                     
                              k.`created_by`,
                              k.`updated_by`
                            FROM
                              `mst_anggota` k
                              LEFT OUTER JOIN `kecamatan` u  ON k.`id_kecamatan` = u.`id_kecamatan`
                              LEFT OUTER JOIN `kelurahan` p ON k.`id_kelurahan` = p.`id_kelurahan` 
                              LEFT OUTER JOIN `mst_data` n ON k.`id_data` = n.`id_data` 
                              ORDER BY nama_alias ASC
                        ");
                        foreach($GET_DATA->result() as $rsData):
                    ?>
                            <tr>
                                <td><?php echo $iLoop; ?></td>
                                <td><?php echo $rsData->nama_anggota; ?></td>
                                <td><?php echo $rsData->nama_alias; ?></td>
                                <td><?php echo $rsData->alamat; ?></td>
                                <td><?php echo $rsData->nama_kecamatan; ?></td>
                                <td><?php echo $rsData->nama_kelurahan; ?></td>
                                <td>
                                    <?php if ($rsData->ktp == "Belum Ada" || $rsData->ktp == "") {
                                    echo "Belum Ada";
                                    }
                                    else{
                                        echo "<a class=\"btn btn-sm btn-success\" href=\"./assets/img/ktp/$rsData->ktp\" target=\"_blank\"><i class=\"fas fa-download\" aria-hidden=\"true\"></i></a>";
                                    }?>
                                </td>                                
                                <td><?php echo $rsData->created_by; ?></td>
                                <td><?php echo $rsData->updated_by; ?></td>
                                <td>
                                    <button onclick="editData('<?php echo $rsData->id_anggota; ?>')" type="button" class="btn btn-sm btn-warning"><i class="fas fa-edit" aria-hidden="true"></i> Ubah</button>

                                    <button onclick="hapusData('<?php echo $rsData->id_anggota; ?>')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash" aria-hidden="true"></i> Hapus</button>
                                </td>
                            </tr>
                            <?php
                        $iLoop++;
                    endforeach;
                    ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<script>
    function editData(UID) {

        $.ajax({
            url: BASE_URL + 'kwt_anggota/doLockCode',
            type: 'POST',
            data: {
                LOCK_CODE: UID
            },
            success: function(response) {
                console.log(response);
                window.location.href = BASE_URL + 'kwt_anggota/edit';
            }
        });

    }

    function hapusData(UID) {
        Swal.fire({
            title: 'Yakin data akan dihapus ?',
            text: "Data tidak bisa dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).
        then((result) => {
            if (result.value) {
                $.ajax({
                    url: BASE_URL + 'kwt_anggota/doTrash',
                    type: 'POST',
                    data: {
                        LOCK_CODE: UID
                    },
                    success: function(response) {
                        if (response == 'success') {
                            Swal.fire({
                                title: 'Hapus Data',
                                text: "Data berhasil dihapus",
                                icon: 'success',
                                showCancelButton: false,
                            }).then((result) => {
                                if (result.value) {
                                    window.location = BASE_URL + 'kwt_anggota'
                                }
                            });
                        }
                    }
                })
            }
        })
    }
</script>