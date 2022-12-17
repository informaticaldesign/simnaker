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
    <div class="col-4">
        <div class="card card-primary card-outline" style="border-top: 3px solid #1e375a;">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-sitemap"></i>
                    Reporting Line
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body list-rencana-kerja overflow-auto anyClass">
                <input type="text" class="form-control" id="field-cari" placeholder="Cari...">
                <div id="jstree"></div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('id' => 'MyForm','name'=>'MyForm', 'class'=>'form-horizontal')) }}
                <input type="hidden" name="parent_id" id="parent_id">
                <div class="form-group">
                    <label for="prov_code" class="col-sm-12 control-label">Nama</label>
                    <div class="col-sm-12">
                        <select class="form-control company" name="user_id">
                            <option value="" selected disabled>Pilih Pengguna</option>
                            @foreach ($users as $key => $val)
                            <option value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback invalid-user_id"></div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-submit-update btn-save"><i class="far fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
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

    $('#jstree').jstree({
        'plugins': ['search', 'contextmenu', 'dnd'],
        'search': {
            'case_sensitive': false,
            'show_only_matches': true
        },
        'core': {
            'check_callback': true,
            'data': {
                'url': "{{ url('admin/reporting/fetch') }}",
                'dataType': "json",
                'data': function (node) {
                    return {'id': node.id};
                }
            }
        },
        'contextmenu': {
            'items': function (node) {
                var tree = $("#jstree").jstree(true);
                return {
                    'Create': {
                        'label': 'Tambah',
                        'icon': 'fa fa-plus',
                        'action': function (obj) {
                            $('#modelHeading').html("Tambah Approval");
                            $('#ajaxModel').modal('show');
                            $('button.btn-submit-update').show();
                            $('button.btn-save').html('<i class="far fa-save"></i> Simpan');
                            $('button.btn-save').prop('disabled', false);
                            $('#MyForm')[0].reset();
                            $('input').prop('readonly', false);
                            $('input#parent_id').val(node.id);
                        }
                    },
                    'Remove': {
                        'label': 'Hapus',
                        'icon': 'fa fa-times',
                        'action': function (obj) {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                $.ajax({
                                    type: "DELETE",
                                    url: "{{ url('admin/reporting/destroy') }}" + "/" + node.id,
                                    dataType: 'JSON',
                                    success: function (data) {
                                        if (data.success) {
                                            Toast.fire({
                                                icon: 'success',
                                                title: 'Data berhasil di hapus'
                                            });
                                            tree.delete_node(node);
                                        }
                                    }
                                });
                            });
                        }
                    }
                };
            }
        }
    });
    var to = false;
    $('#field-cari').keyup(function () {
        if (to) {
            clearTimeout(to);
        }
        to = setTimeout(function () {
            var v = $('#field-cari').val();
            $('#jstree').jstree(true).search(v);
        }, 250);
    });

    // 7 bind to events triggered on the tree
    $('#jstree').on("changed.jstree", function (e, data) {
//        console.log(data.selected);
    });
    // 8 interact with the tree - either way is OK
    $('button').on('click', function () {
        $('#jstree').jstree(true).select_node('child_node_1');
        $('#jstree').jstree('select_node', 'child_node_1');
        $.jstree.reference('#jstree').select_node('child_node_1');
    });

    $('button.btn-submit-update').click(function (e) {
        $('button.btn-submit-update').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('button.btn-submit-update').prop('disabled', true);
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $("form#MyForm :input").each(function () {
            var inputName = $(this).attr('name');
            $('.invalid-' + inputName).text('');
        });
        $.ajax({
            url: "{{ url('admin/reporting/store') }}",
            method: 'post',
            data: $('#MyForm').serialize(),
            success: function (result) {
                if (result.success) {
                    $('#ajaxModel').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil di update'
                    });
                    window.location.reload();
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
                $('button.btn-save').html('<i class="far fa-save"></i> Simpan');
                $('button.btn-save').prop('disabled', false);
            }
        });
    });
});
</script>
@stop