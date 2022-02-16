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
            {data: 'jenis_kendaraan', name: 'jenis_kendaraan'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
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
        var brand_id = $(this).data("id");
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
                    url: "/brand/destroy" + '/' + brand_id,
                    dataType: 'JSON',
                    data: {
                        'id': brand_id,
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
        var brand_id = $(this).data('id');
        $.get("brand" + '/' + brand_id + '/edit', function (data) {
            $('#modelHeading').html("Edit Brand");
            $('#ajaxModel').modal('show');
            $('#brand_id').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_name').prop('readonly', false);
            $('#edit_code').val(data.code);
            $('#edit_code').prop('readonly', false);
            $('#edit_jenis_id').val(data.jenis_id);
            $('#edit_jenis_id').attr('disabled',false);
            $('button.btn-submit-update').show();
        });
    });

    $('body').on('click', '.action-view', function () {
        var brand_id = $(this).data('id');
        $.get("brand" + '/' + brand_id + '/edit', function (data) {
            $('#modelHeading').html("View Brand");
            $('#ajaxModel').modal('show');
            $('#brand_id').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_name').prop('readonly', true);
            $('#edit_code').val(data.code);
            $('#edit_code').prop('readonly', true);
            $('#edit_jenis_id').val(data.jenis_id);
            $('#edit_jenis_id').attr('disabled',true);
            $('button.btn-submit-update').hide();
        });
    });

    $('body').on('click', '.btn-action-add', function () {
        $('#modelAddHeading').html("Add Brand");
        $('#ajaxAddModel').modal('show');
    });

    $('button.btn-action-submit').click(function (e) {
        event.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('.invalid-name').text('');
        $('.invalid-code').text('');
        $.ajax({
            url: urlStore,
            type: "POST",
            data: $('#brandAddForm').serialize(),
            success: function (response) {
                $('#ajaxAddModel').modal('hide');
                Toast.fire({
                    icon: 'success',
                    title: response.message
                });
                $('.data-table').DataTable().ajax.reload();
            },
            error: function (err) {
                $.each(err.responseJSON.message, function (i, error) {
                    var _field = $(document).find('[name="' + i + '"]');
                    _field.addClass('is-invalid');
                    var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                    el.css('display', 'block');
                    el.text(error[0]);
                });
            }
        });
    });

    $('button.btn-submit-update').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: "brand/update",
            method: 'PUT',
            data: $('#BrandForm').serialize(),
            success: function (result) {
                if (result.success) {
                    $('#ajaxModel').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: 'Data berhasil di update'
                    });
                    _dataTable.ajax.reload(null, false);
                    //$('.data-table').DataTable().ajax.reload();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Data gagal di update'
                    });
                }
            }
        });
    });
});

