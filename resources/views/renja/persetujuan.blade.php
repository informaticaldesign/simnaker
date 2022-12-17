@extends('adminlte::page')

@section('title', 'Rencana Kerja')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Rencana Kerja</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Rencana Kerja</li>
        </ol>
    </div>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="sticky-top mb-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Pegawai</h4>
                    <div class="card-tools">
                        <button class="btn btn-tool btn-sm text-success btn-action-refresh" >
                            <i class="fas fa-sync text-danger"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <div id="external-events">
                        @foreach($pegawai as $key => $val )
                        <div class="external-event ui-draggable ui-draggable-handle event-pegawai-renja" style="position: relative; background-color: {{ $val->color }}; cursor: pointer !important;" data-id="{{ $val->user_id }}">{{ $val->pegawai }}</div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card card-primary card-outline" style="border-top: 3px solid #1e375a;">
            <div class="card-body" style="height:710px;">
                <div class="row">
                    <div id='calendar'></div>
                </div>
                <div class="row mt-3 align-middle">
                    <table>
                        <tbody>
                            <tr>
                                <td class="align-baseline p-1"><i class="fas fa-circle fa-1x text-danger"></i></i>&nbsp;Pengajuan Ditolak</td>
                                <td class="align-baseline p-1"><i class="fas fa-circle fa-1x text-warning"></i></i>&nbsp;Menunggu Proses Persetujuan</td>
                                <td class="align-baseline p-1"><i class="fas fa-circle fa-1x text-success"></i></i>&nbsp;Pengajuan Disetujui</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list"></i>
                    Daftar Rencana Kerja <span class="badge badge-info right span-total-renja">0</span>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body list-rencana-kerja overflow-auto anyClass">
                <div class="alert alert-danger alert-dismissible alert-rencana-kerja" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    Belum ada rencana kerja yang dibuat di bulan ini.
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('id' => 'MyForm','name'=>'MyForm', 'class'=>'form-horizontal')) }}
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="menu" value="{{ $menu }}">
                <div class="form-group">
                    <label for="jenis_kegiatan" class="col-sm-12 control-label">Jenis Kegiatan</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="jenis_kegiatan" readonly>
                            <option value="" selected disabled>Pilih Jenis Kegiatan</option>
                            <option value="Pembinaan">Pembinaan</option>
                            <option value="Pemeriksaan">Pemeriksaan</option>
                            <option value="Pengujian">Pengujian</option>
                            <option value="Penyidikan Tindak Pidana Ketenagakerjaan">Penyidikan Tindak Pidana Ketenagakerjaan</option>
                        </select>
                        <div class="invalid-feedback invalid-jenis_kegiatan"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12 control-label">Tanggal Pelaksanaan</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="tgl_pelaksanaan" id="tgl_pelaksanaan" value="{{ date('Y-m-d') }}" readonly>
                        <div class="invalid-feedback invalid-tgl_pelaksanaan"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="company_id" class="col-sm-12 control-label">Nama Perusahaan</label>
                    <div class="col-sm-12">
                        <div class="invalid-feedback invalid-company_id"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-12 control-label">Alamat Perusahaan</label>
                    <div class="col-sm-12">
                        <textarea name="address" id="address" rows="2" cols="10" class="form-control form-control-border" readonly></textarea>
                        <div class="invalid-feedback invalid-address"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="keterangan" class="col-sm-12 control-label">Keterangan</label>
                    <div class="col-sm-12">
                        <textarea name="keterangan" rows="3" cols="10" class="form-control form-control-border" disabled></textarea>
                        <div class="invalid-feedback invalid-keterangan"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status" class="col-sm-12 control-label">Status</label>
                    <div class="col-sm-12">
                        <select class="form-control status" name="status">
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="disetujui">Di Setujui</option>
                            <option value="ditolak">Di Tolak</option>
                        </select>
                        <div class="invalid-feedback invalid-status"></div>
                    </div>
                </div>
                <div class="form-group field-reason" style="display:none">
                    <label for="reason" class="col-sm-12 control-label">Alasan</label>
                    <div class="col-sm-12">
                        <textarea name="reason" rows="3" cols="10" class="form-control form-control-border"></textarea>
                        <div class="invalid-feedback invalid-reason"></div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-action-save"><i class="far fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxAddModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cetak Rencana Kerja</h4>
            </div>
            <div class="modal-body">
                <iframe id="frame" src="" width="100%" height="500"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link href="{{ asset('vendor/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('vendor/fullcalendar-plugins/daygrid/main.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('vendor/fullcalendar-plugins/timegrid/main.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('vendor/fullcalendar-plugins/bootstrap/main.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
<style>
    .fc-sat { 
        color:blue; 
    }
    .fc-sun { 
        color:red;  
    }
    .fc-day:hover{
        background:lightblue;
        cursor: pointer;
    }

    .anyClass {
        height:670px;
        overflow-y: scroll;
    }
</style>
@stop
@section('js')
<script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('vendor/moment/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/moment/locale/id.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/fullcalendar/main.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/fullcalendar-plugins/interaction/main.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/fullcalendar-plugins/daygrid/main.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendor/fullcalendar-plugins/bootstrap/main.min.js') }}" type="text/javascript"></script>
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var calendarEl = document.getElementById('calendar');
    var Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000
    });
    function handleDatesRender(arg) {
        var _month = moment(arg.view.currentStart).format('M');
        var _year = moment(arg.view.currentStart).format('Y');
        $('a.btn-action-excel').attr('href', '/admin/renja/export_excel?m=' + _month + '&y=' + _year);
    }
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid'],
        defaultView: 'dayGridMonth',
        datesRender: handleDatesRender,
        defaultDate: moment().format("YYYY-MM-DD"),
        locale: 'in',
        header: {
            right: 'prev,next',
            center: '',
            left: 'title'
        },
        events: {
            url: "{{ url('admin/renja/event') }}",
            method: 'get',
            dataType: 'json',
            extraParams: {
                menu: '{{ $menu }}',
            },
            failure: function () {
                Toast.fire({
                    icon: 'error',
                    title: 'There was an error while fetching events!'
                });
            },
            success: function (e) {
                $('.list-rencana-kerja .callout').remove();
                var modelHTML = "";
                if (e.length > 0) {
                    $('.alert-rencana-kerja').hide();
                    $('span.span-total-renja').text(e.length);
                } else {
                    $('.alert-rencana-kerja').show();
                    $('span.span-total-renja').text(0);
                }
                $.each(e, function (index, value) {
                    var status = '';
                    switch (value.status) {
                        case 'terkirim':
                            status = 'callout-warning';
                            break;
                        case 'proses':
                            status = 'callout-warning';
                            break;
                        case 'disetujui':
                            status = 'callout-success';
                            break;
                        case 'ditolak':
                            status = 'callout-danger';
                            break;
                    }
                    modelHTML += '<div class="callout ' + status + '"><h5>' + value.title + '</h5><p>' + value.pegawai + '<br>' + moment(value.start).format("dddd,Do MMMM YYYY") + '</p></div>';
                });

                $('.list-rencana-kerja').append(modelHTML);
            },
            loading: true,
            color: 'yellow',
            textColor: 'black',
        },
        eventClick: function (info) {
            $('.form-control').removeClass('is-invalid');
            $("form#MyForm :input").each(function () {
                var inputName = $(this).attr('name');
                if (inputName != '_token') {
                    $('.invalid-' + inputName).text('');
                }
            });
            $('button.btn-action-save').html('<i class="far fa-save"></i> Simpan');
            $('button.btn-action-save').prop('disabled', false);
            var id = info.event.id;
            $.get("/admin/renja" + '/' + id + '/edit', function (data) {
                $('#modelHeading').html("Ubah Rencana Kerja");
                $('#ajaxModel').modal('show');
                $("form#MyForm :input").each(function () {
                    var inputName = $(this).attr('name');
                    if (inputName !== undefined) {
                        var _field = $(document).find('[name="' + inputName + '"]');
                        if (inputName === 'id') {
                            _field.attr('disabled', false);
                            _field.val(data[inputName]);
                        } else if (inputName === 'status') {
                            _field.attr('disabled', false);
                        } else if (inputName === 'menu') {
                            _field.attr('disabled', false);
                        } else if (inputName === 'reason') {
                            _field.attr('disabled', false);
                        } else {
                            if (inputName != '_token') {
                                _field.attr('disabled', true);
                                _field.val(data[inputName]);
                            }
                        }
                    }
                });
            });
        }
    });
    calendar.render();
    $("#tgl_pelaksanaan").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

    $('select.company').change(function (e) {
        $.ajax({
            url: "/admin/renja/address",
            method: 'POST',
            data: {
                id: $(this).val()
            },
            success: function (result) {
                if (result.success) {
                    $('#address').val(result.data.address);
                }
            }
        });
    });
    $('button.btn-action-save').click(function (e) {
        $('button.btn-action-save').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('button.btn-action-save').prop('disabled', true);
        e.preventDefault();
        $("form#MyForm :input").each(function () {
            var inputName = $(this).attr('name');
            if (inputName != '_token') {
                $('.invalid-' + inputName).text('');
            }
        });
        $('.form-control').removeClass('is-invalid');
        $('.invalid-name').text('');
        $.ajax({
            url: "/admin/renja/store",
            method: 'POST',
            data: $('#MyForm').serialize(),
            success: function (result) {
                if (result.success) {
                    $('#ajaxModel').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil di update'
                    });
                    calendar.refetchEvents();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Data gagal di update'
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
    $('body').on('click', '.btn-action-renja', function () {
        $('#modelHeading').html("Buat Rencana Kerja");
        $('#ajaxModel').modal('show');
        $('#id').val('');
        $('button.btn-action-save').show();
        $('button.btn-action-save').html('<i class="far fa-save"></i> Simpan');
        $('button.btn-action-save').prop('disabled', false);
        $('#MyForm')[0].reset();
        $('input').prop('readonly', false);
    });

    $('.event-pegawai-renja').on('click', function () {
        var _userId = $(this).attr('data-id');
        calendar.destroy();
        calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid'],
            defaultView: 'dayGridMonth',
            datesRender: handleDatesRender,
            defaultDate: moment().format("YYYY-MM-DD"),
            locale: 'in',
            header: {
                right: 'prev,next',
                center: '',
                left: 'title'
            },
            events: {
                url: "{{ url('admin/renja/event') }}",
                method: 'get',
                dataType: 'json',
                extraParams: {
                    menu: '{{ $menu }}',
                    user_id: _userId
                },
                failure: function () {
                    Toast.fire({
                        icon: 'error',
                        title: 'There was an error while fetching events!'
                    });
                },
                success: function (e) {
                    $('.list-rencana-kerja .callout').remove();
                    var modelHTML = "";
                    if (e.length > 0) {
                        $('.alert-rencana-kerja').hide();
                        $('span.span-total-renja').text(e.length);
                        $('button.btn-action-print').prop("disabled", false);
                        $('button.btn-action-excel').prop("disabled", false);
                    } else {
                        $('.alert-rencana-kerja').show();
                        $('span.span-total-renja').text(0);
                        $('button.btn-action-print').prop("disabled", true);
                        $('button.btn-action-excel').prop("disabled", true);
                    }
                    $.each(e, function (index, value) {
                        var status = '';
                        switch (value.status) {
                            case 'terkirim':
                                status = 'callout-warning';
                                break;
                            case 'proses':
                                status = 'callout-warning';
                                break;
                            case 'disetujui':
                                status = 'callout-success';
                                break;
                            case 'ditolak':
                                status = 'callout-danger';
                                break;
                        }
                        modelHTML += '<div class="callout ' + status + '"><h5>' + value.title + '</h5><p>' + value.pegawai + '<br>' + moment(value.start).format("dddd,Do MMMM YYYY") + '</p></div>';
                    });

                    $('.list-rencana-kerja').append(modelHTML);
                },
                loading: true,
                color: 'yellow',
                textColor: 'black',
            },
            eventClick: function (info) {
                $('.form-control').removeClass('is-invalid');
                $("form#MyForm :input").each(function () {
                    var inputName = $(this).attr('name');
                    if (inputName != '_token') {
                        $('.invalid-' + inputName).text('');
                    }
                });
                $('button.btn-action-save').html('<i class="far fa-save"></i> Simpan');
                $('button.btn-action-save').prop('disabled', false);
                var id = info.event.id;
                $.get("/admin/renja" + '/' + id + '/edit', function (data) {
                    $('#modelHeading').html("Ubah Rencana Kerja");
                    $('#ajaxModel').modal('show');
                    $("form#MyForm :input").each(function () {
                        var inputName = $(this).attr('name');
                        if (inputName !== undefined) {
                            var _field = $(document).find('[name="' + inputName + '"]');
                            if (inputName === 'id') {
                                _field.attr('disabled', false);
                                _field.val(data[inputName]);
                            } else if (inputName === 'status') {
                                _field.attr('disabled', false);
                            } else if (inputName === 'menu') {
                                _field.attr('disabled', false);
                            } else if (inputName === 'reason') {
                                _field.attr('disabled', false);
                            } else {
                                if (inputName != '_token') {
                                    _field.attr('disabled', true);
                                    _field.val(data[inputName]);
                                }
                            }
                        }
                    });
                });
            }
        });
        calendar.render();
    });

    $('.btn-action-refresh').on('click', function () {
        calendar.destroy();
        calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid'],
            defaultView: 'dayGridMonth',
            datesRender: handleDatesRender,
            defaultDate: moment().format("YYYY-MM-DD"),
            locale: 'in',
            header: {
                right: 'prev,next',
                center: '',
                left: 'title'
            },
            events: {
                url: "{{ url('admin/renja/event') }}",
                method: 'get',
                dataType: 'json',
                extraParams: {
                    menu: '{{ $menu }}',
                },
                failure: function () {
                    Toast.fire({
                        icon: 'error',
                        title: 'There was an error while fetching events!'
                    });
                },
                success: function (e) {
                    $('.list-rencana-kerja .callout').remove();
                    var modelHTML = "";
                    if (e.length > 0) {
                        $('.alert-rencana-kerja').hide();
                        $('span.span-total-renja').text(e.length);
                        $('button.btn-action-print').prop("disabled", false);
                        $('button.btn-action-excel').prop("disabled", false);
                    } else {
                        $('.alert-rencana-kerja').show();
                        $('span.span-total-renja').text(0);
                        $('button.btn-action-print').prop("disabled", true);
                        $('button.btn-action-excel').prop("disabled", true);
                    }
                    $.each(e, function (index, value) {
                        var status = '';
                        switch (value.status) {
                            case 'terkirim':
                                status = 'callout-warning';
                                break;
                            case 'proses':
                                status = 'callout-warning';
                                break;
                            case 'disetujui':
                                status = 'callout-success';
                                break;
                            case 'ditolak':
                                status = 'callout-danger';
                                break;
                        }
                        modelHTML += '<div class="callout ' + status + '"><h5>' + value.title + '</h5><p>' + value.pegawai + '<br>' + moment(value.start).format("dddd,Do MMMM YYYY") + '</p></div>';
                    });

                    $('.list-rencana-kerja').append(modelHTML);
                },
                loading: true,
                color: 'yellow',
                textColor: 'black',
            },
            eventClick: function (info) {
                $('.form-control').removeClass('is-invalid');
                $("form#MyForm :input").each(function () {
                    var inputName = $(this).attr('name');
                    if (inputName != '_token') {
                        $('.invalid-' + inputName).text('');
                    }
                });
                $('button.btn-action-save').html('<i class="far fa-save"></i> Simpan');
                $('button.btn-action-save').prop('disabled', false);
                var id = info.event.id;
                $.get("/admin/renja" + '/' + id + '/edit', function (data) {
                    $('#modelHeading').html("Ubah Rencana Kerja");
                    $('#ajaxModel').modal('show');
                    $("form#MyForm :input").each(function () {
                        var inputName = $(this).attr('name');
                        if (inputName !== undefined) {
                            var _field = $(document).find('[name="' + inputName + '"]');
                            if (inputName === 'id') {
                                _field.attr('disabled', false);
                                _field.val(data[inputName]);
                            } else if (inputName === 'status') {
                                _field.attr('disabled', false);
                            } else if (inputName === 'menu') {
                                _field.attr('disabled', false);
                            } else if (inputName === 'reason') {
                                _field.attr('disabled', false);
                            } else {
                                _field.attr('disabled', true);
                                _field.val(data[inputName]);
                            }
                        }
                    });
                });
            }
        });
        calendar.render();
    });

    $('body').on('click', 'button.btn-action-print', function () {
        $('button.btn-action-print').html('<i class="fas fa-spinner text-warning"></i>');
        $('button.btn-action-print').prop('disabled', true);
        var _month = moment(calendar.getDate()).format('M');
        var _year = moment(calendar.getDate()).format('Y');
        $.ajax({
            url: "{{ route('admin.renja.cetak') }}",
            type: "post",
            data: {
                m: _month,
                y: _year
            },
            dataType: "json",
            success: function (result) {
                if (result.status == 'success') {
                    $('button.btn-action-print').html('<i class="fas fa-print text-warning"></i>');
                    $('button.btn-action-print').prop('disabled', false);
                    $('#ajaxAddModel').modal('show');
                    $("#frame").attr("src", result.data.url);
                }
            },
            error: function (xhr, Status, err) {
                Toast.fire({
                    icon: 'error',
                    title: Status
                });
            }
        });
    });

    $('select.status').on('change', function () {
        var _status = $(this).val();
        if (_status === 'disetujui') {
            $('.field-reason').hide();
        } else {
            $('.field-reason').show();
        }
    });
});
</script>
@stop