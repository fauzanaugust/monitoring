$(document).ready(function () {
    $.validator.setDefaults({
        submitHandler: function () {
            var formData = new FormData($("#formData")[0]);
            $.ajax({
                type: "POST",
                url: BASE_URL + "user/doSave",
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
                                window.location = BASE_URL + 'user'
                            }
                        });
                    }
                }
            });
        }
    });
    
    $('#formData').validate({
        rules: {
            username: {
                required: true,
                nowhitespace: true
            },
            password: {
                required: true,
                minlength: 5
            },
            id_data: {
                required: true
            },
            role: {
                required: true
            },
        },
        messages: {
            username: {
                required: "username wajib diisi",
                nowhitespace: "username tidak boleh pakai spasi"
            },
            aliasname: {
                required: "nama KWT/UMKM Pangan wajib diisi"
            },
            password: {
                required: "silahkan isi password",
                minlength: "password minimal 5 karakter"
            },
            id_data: {
                required: "bidang ini wajib dipilih"
            },
            role: {
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