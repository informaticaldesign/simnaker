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
@if(!$users->biodata_id)
<div clas="row">
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Pemberitahuan!</h5>
        Mohon lengkapi data diri terlebih dahulu.
    </div>
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{ Form::open(array('id' => 'MyForm','method'=>'post', 'enctype'=>"multipart/form-data",'name'=>'MyForm', 'class'=>'form-horizontal')) }}
                <input type="hidden" name="id" value="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-1">
                            <label for="name" class="col-sm-12 col-form-label">Nama Pegawai<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" value="{{ $users->name }}">
                                <div class="invalid-feedback invalid-name"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="nip" class="col-sm-12 col-form-label">NIP<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="nip" placeholder="">
                                <div class="invalid-feedback invalid-nip"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-1">
                            <div class="row">
                                <label for="birth_place" class="col-sm-12 col-form-label">Tempat & Tanggal Lahir<span class="text-danger">*</span></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="birth_place" placeholder="">
                                    <div class="invalid-feedback invalid-birth_place"></div>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="birth_date" name="birth_date" placeholder="">
                                    <div class="invalid-feedback invalid-birth_date"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="id_jabatan" class="col-sm-12 col-form-label">Jabatan <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control" name="id_jabatan">
                                    <option value="" selected disabled>Pilih Jabatan</option>
                                    @foreach ($jabatan as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback invalid-id_jabatan"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-1">
                            <div class="row">  
                                <div class="col-sm-6">
                                    <label for="id_pangkat" class="col-form-label">Pangkat<span class="text-danger">*</span></label>
                                    <select class="form-control" id="id_pangkat" name="id_pangkat">
                                        <option value="" selected disabled>Pilih Pangkat</option>
                                        @foreach ($pangkat as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback invalid-id_pangkat"></div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label for="id_golongan" class="col-form-label">Golongan<span class="text-danger">*</span></label>
                                    <select class="form-control" id="id_golongan" name="id_golongan">
                                        <option value="" selected disabled>Pilih Golongan</option>
                                        @foreach ($golongan as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback invalid-id_golongan"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1">
                            <label for="id_unit" class="col-sm-12 col-form-label">Unit Kerja<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control" id="id_uptd" name="id_uptd">
                                    <option value="" selected disabled>Pilih Unit Kerja K3</option>
                                    @foreach ($unitkerja as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback invalid-id_uptd"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="address" class="col-sm-12 col-form-label">Alamat<span class="text-danger">*</span></label>
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
                    </div>
                    <div class="col-sm-6">

                        <div class="mb-1">
                            <label for="id_kota" class="col-sm-12 col-form-label">Kabupaten/Kota <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control" id="id_kota" name="id_kota">
                                    <option value="" selected disabled>Pilih Kota/Kabupaten</option>
                                    @foreach ($kotas as $key => $kota)
                                    <option value="{{ $key }}">{{ $kota }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback invalid-id_kota"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="id_provinsi" class="col-sm-12 col-form-label">Provinsi <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <select class="form-control" id="id_provinsi" name="id_provinsi">
                                    <option value="" selected disabled>Pilih Provinsi</option>
                                    @foreach ($provinsis as $key => $provinsi)
                                    <option value="{{ $key }}">{{ $provinsi }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback invalid-id_provinsi"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="phone" class="col-sm-12 col-form-label">No. Tlp <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" name="phone" placeholder="">
                                <div class="invalid-feedback invalid-phone"></div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="email" class="col-sm-12 col-form-label">Email<span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" name="email" placeholder="" value="{{ $users->email }}" disabled>
                                <div class="invalid-feedback invalid-email"></div>
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
                                <img name="img_avatar" id="img_avatar" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="col-sm-12 col-form-label">Foto Profile <span class="text-danger">*</span></label>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                        <label class="custom-file-label" for="customFile">Choose Photo</label>
                                        <div class="invalid-feedback invalid-avatar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="card-footer">
                <a href="{{ url('admin') }}" class="btn btn-danger float-right"><i class="far fa-window-close"></i>&nbsp;Batal</a>
                <button type="button" class="btn btn-info btn-action-save float-right mr-1"><i class="fa fa-save"></i>&nbsp;Simpan</button>
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
<link href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css"/>
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
<script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
bsCustomFileInput.init();
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

    $('.form-control').removeClass('is-invalid');
    $("form#MyForm :input").each(function () {
        var inputName = $(this).attr('name');
        $('.invalid-' + inputName).text('');
    });

    $.get('profile/personal', function (data) {
        $("form#MyForm :input").each(function () {
            var inputName = $(this).attr('name');
            if (inputName !== undefined) {
                var _field = $(document).find('[name="' + inputName + '"]');
                if (inputName == 'avatar') {
                    $('#img_avatar').attr("src", data['avatar_path']);
                    $('#img_avatar').attr("width", 90);
                } else {
                    _field.val(data[inputName]);
                }
                $(document).find('[name="_token"]').val('{{ csrf_token() }}');
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
            url: "{{ url('profile/simpan') }}",
            type: "POST",
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.success) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: "Data profile berhasil di update.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#1e375b',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        $('button.btn-action-save').html('<i class="far fa-save"></i> Simpan');
                        $('button.btn-action-save').prop('disabled', false);
                        window.location.href = "{{ url('profile')}}";
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

    $("#birth_date").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
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