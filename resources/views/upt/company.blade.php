@extends('adminlte::page')

@section('title', $biodata->name)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>{{ $biodata->name }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Master Data</a></li>
            <li class="breadcrumb-item"><a href="{{ url('pengguna') }}">Pengawas</a></li>
            <li class="breadcrumb-item active">{{ $biodata->name }}</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                    <h5><i class="icon fas fa-info"></i> Informasi!</h5>
                    Silahkan pilih atau checked untuk menambah perusahaan.
                </div>
                <table id="dtBasicExample"  class="table table-striped table-bordered table-sm display select">
                    <thead>
                        <tr>
                            <th><input name="select_all" value="1" type="checkbox" disabled></th>
                            <th width="50px">Logo</th>
                            <th>Nama Perusahaan</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Kab/Kota</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ url('/admin/upt') }}" class="btn btn-danger float-right"><i class="far fa-window-close"></i>&nbsp;Tutup</a>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000
        });

        var table = $('#dtBasicExample').DataTable({
            processing: true,
            serverSide: true,
            columnDefs: [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'width': '1%',
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return '<input type="checkbox" value=' + data + '>';
                    }
                }
            ],
            ajax: "{{ url('admin/upt/fcomp') }}/{{ $biodata->id }}",
            data: {
                biodata_id: '{{ $biodata->id }}',
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'image', name: 'image'},
                {data: 'name', name: 'name'},
                {data: 'kel_name', name: 'kel_name'},
                {data: 'kec_name', name: 'kec_name'},
                {data: 'city_name', name: 'city_name'}
            ],
            rowCallback: function (row, data, dataIndex) {
                if (data.checked > 0) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            }
        });

        $('#dtBasicExample tbody').on('click', 'input[type="checkbox"]', function (e) {
            var _status = 'unchecked';
            var _msg = 'Perusahaan berhasil dihapus';
            if (this.checked) {
                _status = 'checked';
                _msg = 'Perusahaan berhasil ditambahkan';
            }
            $.ajax({
                url: "/admin/upt/ucomp",
                method: 'POST',
                data: {
                    company_id: $(this).val(),
                    biodata_id: '{{ $biodata->id }}',
                    status: _status
                },
                success: function (result) {
                    Toast.fire({
                        icon: 'success',
                        title: _msg
                    });
                }
            });

            var $row = $(this).closest('tr');

            // Get row data
            var data = table.row($row).data();

            // Get row ID
            var rowId = data[0];

            if (this.checked) {
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }
            e.stopPropagation();
        });

    });

</script>
@stop