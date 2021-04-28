$(document).ready(function () {
    $.validator.setDefaults({
        submitHandler: function () {
            var formData = new FormData($("#formData")[0]);
            $.ajax({
                type: "POST",
                url: BASE_URL + "kwt_anggota/doUpdate",
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
                                window.location = BASE_URL + 'Kwt_anggota'
                            }
                        });
                    }
                }
            });
        }
    });
    
    $('#formData').validate({
        rules: {
            nik: {
                required: true,
                minlength: 16
            },
            nama_anggota: {
                required: true
            },
            alamat: {
                required: true
            },
            jk: {
                required: true
            },
            dataname: {
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
            nik: {
                required: "NIK wajib diisi",
                minlength: "Masukan NIK 16 karakter"
            },
            nama_anggota: {
                required: "nama lengkap wajib diisi"
            },
            alamat: {
                required: "silahkan isi alamat"
            },
            jk: {
                required: "bidang ini wajib dipilih"
            },
            dataname: {
                required: "bidang ini wajib dipilih"
            },
            id_kecamatan: {
                required: "bidang ini wajib dipilih"
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