$(document).ready(function () {
////Show Maps =============================================================================================================
    var curLocation = [0, 0];
    if (curLocation[0] == 0 && curLocation[1] == 0) {
        curLocation = [-6.194400477384734, 106.59287429856532];
    }

    var map = L.map('map').setView([-6.194400477384734, 106.59287429856532], 16);
    L.tileLayer('https://api.mapbox.com/styles/v1/fauzanaugust/cke3usw670kap19o8ccs6vi3z/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiZmF1emFuYXVndXN0IiwiYSI6ImNrZTN1aTVqazBtenQydnA4ZGU0eTEzdDcifQ.xFI1QjnDv75hMhCSZaBhdw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 20,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
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
                url: BASE_URL + "panel/doSave",
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
                                window.location = BASE_URL + 'panel'
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
            kode_panel: {
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
            kode_panel: {
                required: "Kode PANEL Belum diisi"
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