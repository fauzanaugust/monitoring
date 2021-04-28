$(document).ready(function () {

////Validator ==========================================================================================================
    $.validator.setDefaults({
        submitHandler: function () {
            var formData = new FormData($("#formData")[0]);
            $.ajax({
                type: "POST",
                url: BASE_URL + "product/doUpdate",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response == 'success') {
                        Swal.fire({
                            title: 'Sukses',
                            text: "Data berhasil ditambah",
                            icon: 'success',
                            showCancelButton: false,
                        }).then((result) => {
                            if (result.value) {
                                window.location = BASE_URL + 'product'
                            }
                        });
                    }
                }
            });
        }
    });
    
    $('#formData').validate({
        rules: {
            id_data: {
                required: true
            },
            product: {
                required: true
            },
            harga: {
                required: true
            },
            deskripsi: {
                required: true
            },
        },
        messages: {
            id_data: {
                required: "Nama UMKM Wajib dipilih"
            },
            product: {
                required: "Nama Produk Harus Diisi"
            },
            harga: {
                required: "Harga Produk Belum diisi"
            },
            deskripsi: {
                required: "Deskripsi Belum Diisi"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});