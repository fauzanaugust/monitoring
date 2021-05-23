<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DAFTAR PJU KAMPUNG TERANG</h1>
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
                        <button type="button" class="btn btn-block bg-gradient-primary" onclick="javascript:location.href='<?php echo base_url('pju/add'); ?>'"><i class="icon fas fa-plus-circle"></i> Tambah Data</button>
                    </h3>
                </div>
                <div class="card-body table-responsive">
                    <table id="pjuTable" name="pjuTable" class="table table-hover dataTable table-striped w-full" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode PJU</th>
                                <th>RW</th>
                                <th>RT</th>
                                <th>Alamat</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Created by</th>
                                <th>Updated by</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $iLoop = 1;
                                $GET_DATA = $this->db->query("SELECT * FROM `mst_data` WHERE tipe = 'pju'");
                            foreach($GET_DATA->result() as $rsData):
                            ?>
                            <tr>
                                <td><?php echo $iLoop; ?></td>
                                <td><?php echo $rsData->kode_pju; ?></td>
                                <td><?php echo $rsData->rw; ?></td>
                                <td><?php echo $rsData->rt; ?></td>
                                <td><?php echo $rsData->alamat; ?></td>
                                <td><?php echo $rsData->latitude; ?></td>
                                <td><?php echo $rsData->longitude; ?></td>
                                <td><?php echo $rsData->created_by; ?></td>
                                <td><?php echo $rsData->updated_by; ?></td>
                                <td>
                                    <button onclick="editData('<?php echo $rsData->id_data; ?>')" type="button" class="btn btn-sm btn-warning"><i class="fas fa-edit" aria-hidden="true"></i> Ubah</button>

                                    <button onclick="hapusData('<?php echo $rsData->id_data; ?>')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash" aria-hidden="true"></i> Hapus</button>
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
            url: BASE_URL + 'pju/doLockCode',
            type: 'POST',
            data: {
                LOCK_CODE: UID
            },
            success: function(response) {
                console.log(response);
                window.location.href = BASE_URL + 'pju/edit';
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
                    url: BASE_URL + 'pju/doTrash',
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
                                    window.location = BASE_URL + 'pju'
                                }
                            });
                        }
                    }
                })
            }
        })
    }
</script>