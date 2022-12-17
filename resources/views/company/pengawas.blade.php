@extends('adminlte::page')

@section('title', $company->name)

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>{{ $company->name }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Master Data</a></li>
            <li class="breadcrumb-item"><a href="{{ url('company') }}">Pengawas</a></li>
            <li class="breadcrumb-item active">{{ $company->name }}</li>
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
                    Silahkan pilih atau checked untuk menambah pengawas perusahaan.
                </div>
                <table id="dtBasicExample"  class="table table-striped table-bordered table-sm display select">
                    <thead>
                        <tr>
                            <th><input name="select_all" value="1" type="checkbox" disabled></th>
                            <th width="40%">
                                Nama Pegawai
                            </th>
                            <th width="15%">
                                NIP
                            </th>
                            <th width="15%">
                                JABATAN
                            </th>
                            <th width="15%">
                                PANGKAT
                            </th>
                            <th width="15%">
                                GOLONGAN
                            </th>
                        </tr>
                    </thead>
                    @foreach($biodata as $module)
                    <tr>
                        <td><input value="{{ $module->id }}" type="checkbox" @if($module->ttl_comp >0 ) checked @endif ></td>
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->nip }}</td>
                        <td>{{ $module->jabatan_name }}</td>
                        <td>{{ $module->pangkat_name }}</td>
                        <td>{{ $module->golongan_name }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ url('/company') }}" class="btn btn-danger float-right"><i class="far fa-window-close"></i>&nbsp;Tutup</a>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script>
    function updateDataTableSelectAllCtrl(table) {
        var $table = table.table().node();
        var $chkbox_all = $('tbody input[type="checkbox"]', $table);
        var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
        var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

        // If none of the checkboxes are checked
        if ($chkbox_checked.length === 0) {
            chkbox_select_all.checked = false;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If all of the checkboxes are checked
        } else if ($chkbox_checked.length === $chkbox_all.length) {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = false;
            }

            // If some of the checkboxes are checked
        } else {
            chkbox_select_all.checked = true;
            if ('indeterminate' in chkbox_select_all) {
                chkbox_select_all.indeterminate = true;
            }
        }
    }
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var rows_selected = [];
        var table = $('#dtBasicExample').DataTable({
            'pageLength': 10,
        });
        var Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000
        });
        $('#dtBasicExample tbody').on('click', 'input[type="checkbox"]', function (e) {
            var _status = 'unchecked';
            var _msg = 'Pengawas berhasil dihapus';
            if (this.checked) {
                _status = 'checked';
                _msg = 'Pengawas berhasil ditambahkan';
            }

            $.ajax({
                url: "/company/pegawai",
                method: 'POST',
                data: {
                    biodata_id: $(this).val(),
                    company_id: '{{ $company->id }}',
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

            // Determine whether row ID is in the list of selected row IDs
            var index = $.inArray(rowId, rows_selected);

            // If checkbox is checked and row ID is not in list of selected row IDs
            if (this.checked && index === -1) {
                rows_selected.push(rowId);

                // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
            }

            if (this.checked) {
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }

            // Update state of "Select all" control
            updateDataTableSelectAllCtrl(table);

            // Prevent click event from propagating to parent
            e.stopPropagation();
        });

    });

</script>
@stop