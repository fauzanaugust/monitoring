$(document).ready(function () {
////Show Maps =============================================================================================================


////Validator ==========================================================================================================
    $.validator.setDefaults({
        submitHandler: function () {
            var formData = new FormData($("#formData")[0]);
            $.ajax({
                type: "POST",
                url: BASE_URL + "pju/doUpdate",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response == 'success') {
                        Swal.fire({
                            title: 'Sukses',
                            text: "Data berhasil diubah",
                            icon: 'success',
                            showCancelButton: false,
                        }).then((result) => {
                            if (result.value) {
                                window.location = BASE_URL + 'pju'
                            }
                        });
                    }
                }
            });
        }
    });
    
    $('#formData').validate({
        rules: {
            latitude: {
                required: true
            },
            longitude: {
                required: true
            },
            kode_pju: {
                required: true
            },
            rw: {
                required: true
            },
            rt: {
                required: true
            },
            alamat: {
                required: true
            },
            id_kecamatan: {
                required: true
            },
            id_kelurahan: {
                required: true
            },
        },
        messages: {
            latitude: {
                required: "Titik Koordinat Belum diisi"
            },
            longitude: {
                required: "Titik Koordinat Belum diisi"
            },
            kode_pju: {
                required: "Kode PJU Belum diisi"
            },
            ketua: {
                required: "bidang ini wajib diisi"
            },
            rw: {
                required: "bidang ini wajib diisi"
            },
            rt: {
                required: "bidang ini wajib diisi"
            },
            alamat: {
                required: "bidang ini wajib diisi"
            },
            id_kecamatan: {
                required: "bidang ini wajib diisi"
            },
            id_kelurahan: {
                required: "bidang ini wajib diisi"
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