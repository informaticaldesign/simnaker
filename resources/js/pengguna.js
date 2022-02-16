/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var _dataTable = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: urlFetch,
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nik', name: 'nik'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
    });
    var Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000
    });
    $('body').on('click', '.action-delete', function () {
        var pengguna_id = $(this).data("id");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: urlDelete + '/' + pengguna_id,
                    dataType: 'JSON',
                    data: {
                        'id': pengguna_id,
                    },
                    success: function (data) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil di hapus'
                        });
                        $('.data-table').DataTable().ajax.reload();
                    }
                });
            }
        });
    });
    $('body').on('click', '.action-edit', function () {
        $('.form-control').removeClass('is-invalid');
        $('.invalid-nik').text('');
        $('.invalid-name').text('');
        $('.invalid-email').text('');
        $('.invalid-address').text('');
        $('.invalid-phone').text('');
        $('button.btn-save').html('<i class="far fa-save"></i> Simpan');
        $('button.btn-save').prop('disabled', false);
        var pengguna_id = $(this).data('id');
        $.get("pengguna" + '/' + pengguna_id + '/edit', function (data) {
            $('#modelHeading').html("Edit Pengguna");
            $('#ajaxModel').modal('show');
            $('#pengguna_id').val(data.id);
            $('#name').val(data.name);
            $('#name').prop('readonly', false);
            $('#email').val(data.email);
            $('#email').prop('readonly', false);
            $('#nik').val(data.nik);
            $('#nik').prop('readonly', false);
            $('#phone').val(data.phone);
            $('#phone').prop('readonly', false);
            $('#address').val(data.address);
            $('#address').prop('readonly', false);
            $('button.btn-submit-update').show();
        });
    });

    $('body').on('click', '.action-view', function () {
        $('.form-control').removeClass('is-invalid');
        $('.invalid-nik').text('');
        $('.invalid-name').text('');
        $('.invalid-email').text('');
        $('.invalid-address').text('');
        $('.invalid-phone').text('');
        var pengguna_id = $(this).data('id');
        $.get("pengguna" + '/' + pengguna_id + '/edit', function (data) {
            $('#modelHeading').html("View Pengguna");
            $('#ajaxModel').modal('show');
            $('#pengguna_id').val(data.id);
            $('#nik').val(data.nik);
            $('#nik').prop('readonly', true);
            $('#name').val(data.name);
            $('#name').prop('readonly', true);
            $('#email').val(data.email);
            $('#email').prop('readonly', true);
            $('#phone').val(data.phone);
            $('#phone').prop('readonly', true);
            $('#address').val(data.address);
            $('#address').prop('readonly', true);
            $('button.btn-submit-update').hide();
        });
    });

    $('body').on('click', '.btn-action-add', function () {
        $('#modelHeading').html("Add Pengguna");
        $('#ajaxModel').modal('show');
        $('#pengguna_id').val('');
        $('button.btn-submit-update').show();
        $('#PenggunaForm')[0].reset();
        $('input').prop('readonly', false);
    });

    $('button.btn-submit-update').click(function (e) {
        $('button.btn-submit-update').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $('button.btn-submit-update').prop('disabled', true);
        e.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('.invalid-nik').text('');
        $('.invalid-name').text('');
        $('.invalid-email').text('');
        $('.invalid-address').text('');
        $('.invalid-phone').text('');
        $.ajax({
            url: "pengguna/update",
            method: 'PUT',
            data: $('#PenggunaForm').serialize(),
            success: function (result) {
                if (result.success) {
                    $('#ajaxModel').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil di update'
                    });
                    $('.data-table').DataTable().ajax.reload();
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

