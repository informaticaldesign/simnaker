@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Profile</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{ Form::open(array('id' => 'MyForm','method'=>'post', 'enctype'=>"multipart/form-data",'name'=>'MyForm', 'class'=>'form-horizontal')) }}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label for="nib" class="col-sm-12 col-form-label">NIB (Nomor Induk Usaha)<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="nib" placeholder="" disabled>
                                <div class="invalid-feedback invalid-nib"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="no_wlkp" class="col-sm-12 col-form-label">NO. WLKP Online <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="no_wlkp" placeholder="" disabled>
                                <div class="invalid-feedback invalid-no_wlkp"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="name" class="col-sm-12 col-form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" placeholder="">
                                <div class="invalid-feedback invalid-name"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="address" class="col-sm-12 col-form-label">Alamat Perusahaan <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <div class="input-group mb-2">
                                    <input type="text" id="map-address" name="address" class="form-control" placeholder="" aria-label="address" aria-describedby="button-alamat">
                                    <button class="btn btn-outline-secondary" type="button" id="button-alamat">
                                        <i class="fa fa-map"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback invalid-address"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="latitude" class="col-sm-6 col-form-label">Latitude<span class="text-danger">*</span></label>
                                        <input type="text" id="map-lat" class="form-control" name="latitude" placeholder="Latitude">
                                        <div class="invalid-feedback invalid-latitude"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="longitude" class="col-sm-6 col-form-label">Longitude <span class="text-danger">*</span></label>
                                        <input type="text" id="map-lng" class="form-control" name="longitude" placeholder="Longitude">
                                        <div class="invalid-feedback invalid-longitude"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="city_code" class="col-sm-12 col-form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control" id="city_code" name="city_code">
                                    @foreach ($kotas as $key => $kota)
                                    <option value="{{ $key }}">{{ $kota }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback invalid-city_code"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="prov_code" class="col-sm-12 col-form-label">Provinsi <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control" id="prov_code" name="prov_code">
                                    @foreach ($provinsis as $key => $provinsi)
                                    <option value="{{ $key }}">{{ $provinsi }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback invalid-prov_code"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="jenis_usaha" class="col-sm-12 col-form-label">Jenis PJK3 <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control" name="jenis_usaha">
                                    @foreach ($jeniss as $key => $jenis)
                                    <option value="{{ $key }}">{{ $jenis }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback invalid-jenis_usaha"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="bidang_usaha" class="col-sm-12 col-form-label">Bidang <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control" name="bidang_usaha">
                                    @foreach ($bidangs as $key => $bidang)
                                    <option value="{{ $key }}">{{ $bidang }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback invalid-bidang_usaha"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="phone" class="col-sm-12 col-form-label">No. Tlp Perusahaan <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" name="phone" placeholder="">
                                <div class="invalid-feedback invalid-phone"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="email" class="col-sm-12 col-form-label">Email Perusahaan <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" name="email" placeholder="" disabled>
                                <div class="invalid-feedback invalid-email"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label for="npp_bpjs" class="col-sm-12 col-form-label">NPP BPJS <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="npp_bpjs">
                                <div class="invalid-feedback invalid-npp_bpjs"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="no_npwp" class="col-sm-12 col-form-label">NPWP <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="no_npwp">
                                <div class="invalid-feedback invalid-no_npwp"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="pemeriksa" class="col-sm-12 col-form-label">Nama Pemeriksa <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="pemeriksa">
                                <div class="invalid-feedback invalid-pemeriksa"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="nik_ktp_p" class="col-sm-12 col-form-label">NIK KTP <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="nik_ktp_p">
                                <div class="invalid-feedback invalid-nik_ktp_p"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="penanggung_jwb" class="col-sm-12 col-form-label">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="penanggung_jwb">
                                <div class="invalid-feedback invalid-penanggung_jwb"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="nik_ktp_t" class="col-sm-12 col-form-label">NIK KTP Penanggung Jawab <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="nik_ktp_t">
                                <div class="invalid-feedback invalid-nik_ktp_t"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="password" class="col-sm-12 col-form-label">Password Lama<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="password">
                                <div class="invalid-feedback invalid-password"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="password_new" class="col-sm-12 col-form-label">Password Baru<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="password_new">
                                <div class="invalid-feedback invalid-password_new"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="password_confirmation" class="col-sm-12 col-form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="password_confirmation">
                                <div class="invalid-feedback invalid-password_confirmation"></div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="col-sm-12">
                                <img name="img_logo" id="img_logo" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="col-sm-12 col-form-label">Logo Perusahaan <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="file" name="logo" width="50">
                                <div class="invalid-feedback invalid-logo"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-info btn-action-save"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                <a href="{{ url('admin') }}" class="btn btn-danger float-right"><i class="far fa-window-close"></i>&nbsp;Batal</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <input class="form-control controls mt-1"
                       id="pac-input"
                       type="text"
                       placeholder="Ketik Alamat"
                       />
                <div id="map"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-action-pick"><i class="far fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-danger btn-action-close" data-dismiss="modal"><i class="far fa-window-close"></i>&nbsp;Tutup</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
<style>
    #bizland {
        width: 100%;
        height: 75vh;
        background-size: cover;
        position: relative;
    }
    #map {
        height: 75vh;
        width: 100%;
    }

    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
    }

    #infowindow-content .title {
        font-weight: bold;
    }

    #infowindow-content {
        display: none;
    }

    #map #infowindow-content {
        display: inline;
    }

    .pac-card {
        background-color: #fff;
        border: 0;
        border-radius: 2px;
        box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
        margin: 10px;
        padding: 0 0.5em;
        font: 400 18px Roboto, Arial, sans-serif;
        overflow: hidden;
        font-family: Roboto;
        padding: 0;
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }

    .pac-container { z-index: 100000 !important; }

    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }

    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
        height: 40px;
    }

    #pac-input:focus {
        border-color: #4d90fe;
    }

    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }

    #target {
        width: 345px;
    }
</style>
@stop

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgaWFBpt4UyShxn_m-Ax5PVquLK4VemSw&callback=initAutocomplete&libraries=places&v=weekly&channel=2" async></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '#button-alamat', function () {
        $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.btn-action-close', function () {
        $('#ajaxModel').modal('hide');
    });

    $('body').on('click', '.btn-action-pick', function () {
        $('#ajaxModel').modal('hide');
    });
    // load data edit
    $('.form-control').removeClass('is-invalid');
    $("form#MyForm :input").each(function () {
        var inputName = $(this).attr('name');
        $('.invalid-' + inputName).text('');
    });
    $.get('profile/show', function (data) {
        $("form#MyForm :input").each(function () {
            var inputName = $(this).attr('name');
            if (inputName !== undefined) {
                var _field = $(document).find('[name="' + inputName + '"]');
                if (inputName == 'logo') {
                    $('#img_logo').attr("src", data['logo_path']);
                    $('#img_logo').attr("width", 90);
                } else {
                    _field.val(data[inputName]);
                }
            }
        });
    });

    $('button.btn-action-save').click(function (e) {

        $('button.btn-action-save').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('button.btn-action-save').prop('disabled', true);
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $("form#MyForm :input").each(function () {
            var inputName = $(this).attr('name');
            $('.invalid-' + inputName).text('');
        });
        var _form = $("form#MyForm");
        var formData = new FormData(_form[0]);
        $.ajax({
            url: "{{ url('profile/update') }}",
            type: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: "Data profile perusahaan berhasil di update.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#1e375b',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        $('button.btn-action-save').html('<i class="far fa-save"></i> Simpan');
                        $('button.btn-action-save').prop('disabled', false);
                    });
                } else {
                    Swal.fire({
                        title: 'Gagal',
                        text: "Update profile gagal disimpan",
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#dc3741',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        $('button.btn-action-save').html('<i class="far fa-save"></i> Simpan');
                        $('button.btn-action-save').prop('disabled', false);
                    });
                }
            },
            error: function (err) {
                $.each(err.responseJSON.message, function (i, error) {
                    var _field = $(document).find('[name="' + i + '"]');
                    _field.addClass('is-invalid');
                    var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                    el.css('display', 'block');
                    el.text(error[0]);
                });
                $('button.btn-action-save').html('<i class="far fa-save"></i> Simpan');
                $('button.btn-action-save').prop('disabled', false);
            }
        });
    });
});

function initAutocomplete() {
    const _center = new google.maps.LatLng(-6.364233, 106.272860);
    const map = new google.maps.Map(document.getElementById("map"), {
        center: _center,
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        mapTypeControl: false,
        scaleControl: true,
        zoomControl: true
    });

    const input = document.getElementById("pac-input");
    const searchBox = new google.maps.places.SearchBox(input);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
    });

    let markers = [];

    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        markers.forEach((marker) => {
            marker.setMap(null);
        });
        markers = [];

        const bounds = new google.maps.LatLngBounds();

        places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
                console.log("Returned place contains no geometry");
                return;
            }

            const icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25),
            };

            markers.push(
                    new google.maps.Marker({
                        map,
                        title: place.name,
                        position: place.geometry.location,
                        label: {
                            fontFamily: "'Font Awesome 5 Free'",
                            text: '\uf1ad',
                            fontWeight: '500',
                            color: '#FFFFFF',
                        },
                    })
                    );

            document.getElementById("map-address").value = place.formatted_address;
            document.getElementById("map-lat").value = place.geometry.location.lat();
            document.getElementById("map-lng").value = place.geometry.location.lng();
            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}
</script>
@stop