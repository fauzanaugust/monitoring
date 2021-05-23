<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DAFTAR PENGGUNA</h1>
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
                        <button type="button" class="btn btn-block bg-gradient-primary" onclick="javascript:location.href='<?php echo base_url('user/add'); ?>'"><i class="icon fas fa-plus-circle"></i> Tambah Data</button>
                    </h3>
                </div>
                <?php if($this->session->flashdata('success')){ ?>
                <div class="alert alert-success">
                    <strong><span class="glyphicon glyphicon-ok"></span> <?php echo $this->session->flashdata('success'); ?></strong>
                </div>
                <?php } ?>
                <div class="card-body table-responsive">
                    <table id="kwtTable" name="kwtTable" class="table table-hover dataTable table-striped w-full" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Avatar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $iLoop = 1;
                        $GET_DATA = $this->db->query("SELECT * FROM `simoka_userlogin` ");
                        foreach($GET_DATA->result() as $rsData):
                    ?>
                            <tr>
                                <td><?php echo $iLoop; ?></td>
                                <td><?php echo $rsData->username; ?></td>
                                <td><?php echo $rsData->role; ?></td>
                                <td><img src="<?=base_url()?>assets/img/avatar/<?=$rsData->avatar?>" height="50px"></td>
                                <td>
                                    <button onclick="editData('<?php echo $rsData->userlogin_uid; ?>')" type="button" class="btn btn-sm btn-warning"><i class="fas fa-edit" aria-hidden="true"></i> Ubah</button>

                                    <button onclick="hapusData('<?php echo $rsData->userlogin_uid; ?>')" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash" aria-hidden="true"></i> Hapus</button>
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
            url: BASE_URL + 'user/doLockCode',
            type: 'POST',
            data: {
                LOCK_CODE: UID
            },
            success: function(response) {
                console.log(response);
                window.location.href = BASE_URL + 'user/edit';
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
                    url: BASE_URL + 'user/doTrash',
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
                                    window.location = BASE_URL + 'user'
                                }
                            });
                        }
                    }
                })
            }
        })
    }
</script>