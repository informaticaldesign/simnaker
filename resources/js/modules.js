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
            {data: 'name', name: 'name'},
            {data: 'label', name: 'label'},
            {data: 'url', name: 'url'},
            {data: 'fa_icon', name: 'fa_icon'},
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
        var module_id = $(this).data("id");
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
                    url: "/modules/destroy" + '/' + module_id,
                    dataType: 'JSON',
                    data: {
                        'id': module_id,
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
        var module_id = $(this).data('id');
        $.get("modules" + '/' + module_id + '/edit', function (data) {
            $('#modelHeading').html("Edit User");
            $('#ajaxModel').modal('show');
            $('#module_id').val(data.id);
            $('#name').val(data.name);
            $('#name').prop('readonly', false);
            $('#label').val(data.label);
            $('#label').prop('readonly', false);
            $('#url').val(data.url);
            $('#url').prop('readonly', false);
            $('#fa_icon').val(data.fa_icon);
            $('#fa_icon').prop('readonly', false);
            $('button.btn-submit-update').show();
        });
    });

    $('body').on('click', '.action-view', function () {
        var module_id = $(this).data('id');
        $.get("modules" + '/' + module_id + '/edit', function (data) {
            $('#modelHeading').html("View Module");
            $('#ajaxModel').modal('show');
            $('#module_id').val(data.id);
            $('#name').val(data.name);
            $('#name').prop('readonly', true);
            $('#label').val(data.label);
            $('#label').prop('readonly', true);
            $('#url').val(data.url);
            $('#url').prop('readonly', true);
            $('#fa_icon').val(data.fa_icon);
            $('#fa_icon').prop('readonly', true);
            $('button.btn-submit-update').hide();
        });
    });

    $('body').on('click', '.btn-action-add', function () {
        $('#modelAddHeading').html("Add Module");
        $('#ajaxAddModel').modal('show');
    });

    $('button.btn-action-submit').click(function (e) {
        event.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('.invalid-name').text('');
        $('.invalid-label').text('');
        $('.invalid-url').text('');
        $('.invalid-fa_icon').text('');
        $.ajax({
            url: urlStore,
            type: "POST",
            data: $('#moduleAddForm').serialize(),
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
            url: "modules/update",
            method: 'PUT',
            data: $('#ModuleForm').serialize(),
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
            }
        });
    });
});

