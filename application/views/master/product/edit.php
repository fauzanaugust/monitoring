<?php foreach($GET_SELECTED->result() as $rsData): ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Produk UMKM</h1>
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
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data</h3>
                        </div>
                        <!-- form start -->
                        <form id="formData" action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama UMKM Pangan</label>
                                    <select class="form-control " name="id_data" id="id_data">
                                        <option value="">Pilih UKM PANGAN</option>
                                        <?php
                                            $GET_DATA = $this->db->query("SELECT * FROM mst_data WHERE tipe = 'umkm'");
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
                                    <label for="exampleInputEmail1">Nama Produk</label>
                                    <input type="text" class="form-control" id="product" name="product" placeholder="Isi nama produk" value="<?php echo $rsData->product; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea type="text" rows="4" class="form-control" name="deskripsi" placeholder="Isi Deskripsi Produk"><?php echo $rsData->deskripsi; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="">Rp</i></span>
                                        </div>
                                        <input type="number" name="harga" class="form-control" placeholder="Harga" value="<?php echo $rsData->harga; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Gambar Produk</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="<?php echo base_url('assets/img/product/')?><?php echo $rsData->productimg; ?>" height="100px">
                                        </div>
                                        <div class="col-9">
                                            <input type="file" class="form-control" id="productimg" name="productimg">
                                            <input type="hidden" class="form-control" id="productimgold" name="productimgold" value="<?php echo $rsData->productimg; ?>">
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

<?php
endforeach
?>