$(document).ready(function () {
////Show Maps =============================================================================================================
    var curLocation = [0, 0];
    if (curLocation[0] == 0 && curLocation[1] == 0) {
        curLocation = [-6.175659, 106.6556966];
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

////Validator ==========================================================================================================
    $.validator.setDefaults({
        submitHandler: function () {
            var formData = new FormData($("#formData")[0]);
            $.ajax({
                type: "POST",
                url: BASE_URL + "kwt/doSave",
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
            nama_alias: {
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
            nama_alias: {
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