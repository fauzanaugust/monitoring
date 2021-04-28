$(document).ready(function () {
////Show Maps =============================================================================================================


////Validator ==========================================================================================================
    $.validator.setDefaults({
        submitHandler: function () {
            var formData = new FormData($("#formData")[0]);
            $.ajax({
                type: "POST",
                url: BASE_URL + "kwt/doUpdate",
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
                                window.location = BASE_URL + 'kwt'
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
            nama_kwt: {
                required: true
            },
            ketua: {
                required: true
            },
            cp: {
                required: true
            },
            luaslahan: {
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
            nama_kwt: {
                required: "Nama KWT Belum diisi"
            },
            ketua: {
                required: "bidang ini wajib diisi"
            },
            cp: {
                required: "bidang ini wajib diisi"
            },
            luaslahan: {
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