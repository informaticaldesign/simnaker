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
            {data: 'description', name: 'description'},
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
        var role_id = $(this).data("id");
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
                    url: "/roles/destroy" + '/' + role_id,
                    dataType: 'JSON',
                    data: {
                        'id': role_id,
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
        var role_id = $(this).data('id');
        $.get("roles" + '/' + role_id + '/edit', function (data) {
            $('#modelHeading').html("Edit User");
            $('#ajaxModel').modal('show');
            $('#role_id').val(data.id);
            $('#name').val(data.name);
            $('#name').prop('readonly', false);
            $('#label').val(data.label);
            $('#label').prop('readonly', false);
            $('#description').val(data.description);
            $('#description').prop('readonly', false);
            $('button.btn-submit-update').show();
        });
    });

    $('body').on('click', '.action-view', function () {
        var role_id = $(this).data('id');
        $.get("roles" + '/' + role_id + '/edit', function (data) {
            $('#modelHeading').html("View Role");
            $('#ajaxModel').modal('show');
            $('#role_id').val(data.id);
            $('#name').val(data.name);
            $('#name').prop('readonly', true);
            $('#label').val(data.label);
            $('#label').prop('readonly', true);
            $('#description').val(data.description);
            $('#description').prop('readonly', true);
            $('button.btn-submit-update').hide();
        });
    });

    $('body').on('click', '.btn-action-add', function () {
        $('#modelAddHeading').html("Add Role");
        $('#ajaxAddModel').modal('show');
    });

    $('button.btn-action-submit').click(function (e) {
        event.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('.invalid-name').text('');
        $('.invalid-label').text('');
        $('.invalid-description').text('');
        $.ajax({
            url: urlStore,
            type: "POST",
            data: $('#roleAddForm').serialize(),
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
            url: "roles/update",
            method: 'PUT',
            data: $('#RoleForm').serialize(),
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

