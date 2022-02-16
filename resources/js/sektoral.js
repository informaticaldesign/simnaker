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
            {data: 'provinsi', name: 'provinsi'},
            {data: 'opd', name: 'opd'},
            {data: 'urusan', name: 'urusan'},
            {data: 'suburusan', name: 'suburusan'},
            {data: 'tahun', name: 'tahun'},
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
        var satuan_id = $(this).data("id");
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
                    url: "/sektoral/destroy" + '/' + satuan_id,
                    dataType: 'JSON',
                    data: {
                        'id': satuan_id,
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
        var satuan_id = $(this).data('id');
        $.get("sektoral" + '/' + satuan_id + '/edit', function (data) {
            $('#modelHeading').html("Edit User");
            $('#ajaxModel').modal('show');
            $('#satuan_id').val(data.id);
            $('#name').val(data.name);
            $('#name').prop('readonly', false);
            $('#code').val(data.code);
            $('#code').prop('readonly', false);
            $('button.btn-submit-update').show();
        });
    });

    $('body').on('click', '.action-view', function () {
        var satuan_id = $(this).data('id');
        $.get("sektoral" + '/' + satuan_id + '/edit', function (data) {
            $('#modelHeading').html("View Satuan");
            $('#ajaxModel').modal('show');
            $('#satuan_id').val(data.id);
            $('#name').val(data.name);
            $('#name').prop('readonly', true);
            $('#code').val(data.code);
            $('#code').prop('readonly', true);
            $('button.btn-submit-update').hide();
        });
    });

    $('body').on('click', '.btn-action-add', function () {
        $('#modelAddHeading').html("Add Data Sektoral");
        $('#ajaxAddModel').modal('show');
    });

    $('button.btn-action-submit').click(function (e) {
        event.preventDefault();
        $('.form-control').removeClass('is-invalid');
        $('.invalid-provinsi_id').text('');
        $('.invalid-bidang_id').text('');
        $('.invalid-urusan_id').text('');
        $('.invalid-suburusan_id').text('');
        $('.invalid-tahun').text('');
        $.ajax({
            url: urlStore,
            type: "POST",
            data: $('#satuanAddForm').serialize(),
            success: function (response) {
                window.location.href = urlRedirect + '/' + response.id;
//                $('#ajaxAddModel').modal('hide');
//                Toast.fire({
//                    icon: 'success',
//                    title: response.message
//                });
//                $('.data-table').DataTable().ajax.reload();
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
            url: "satuan/update",
            method: 'PUT',
            data: $('#SatuanForm').serialize(),
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

    $('select.provinsi_id').on('change', function (e) {
        var provinsi_id = e.target.value;
        $.ajax({
            url: urlSektor,
            type: "POST",
            data: {
                provinsi_id: provinsi_id
            },
            success: function (data) {
                $('select.sektor_id').empty();
                $('select.sektor_id').append('<option value="" selected disabled>Please select</option>');
                $.each(data.sektor, function (index, subcategory) {
                    $('select.sektor_id').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                });
            }
        });
    });

    $('select.sektor_id').on('change', function (e) {
        var sektor_id = e.target.value;
        $.ajax({
            url: urlBidang,
            type: "POST",
            data: {
                sektor_id: sektor_id
            },
            success: function (data) {
                $('select.bidang_id').empty();
                $('select.bidang_id').append('<option value="" selected disabled>Please select</option>');
                $.each(data.bidang, function (index, subcategory) {
                    $('select.bidang_id').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                });
            }
        });
    });

    $('select.bidang_id').on('change', function (e) {
        var bidang_id = e.target.value;
        $.ajax({
            url: urlUrusan,
            type: "POST",
            data: {
                bidang_id: bidang_id
            },
            success: function (data) {
                $('select.urusan_id').empty();
                $('select.urusan_id').append('<option value="" selected disabled>Please select</option>');
                $.each(data.urusan, function (index, subcategory) {
                    $('select.urusan_id').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                });
            }
        });
    });

    $('select.urusan_id').on('change', function (e) {
        var urusan_id = e.target.value;
        $.ajax({
            url: urlSuburusan,
            type: "POST",
            data: {
                urusan_id: urusan_id
            },
            success: function (data) {
                $('select.suburusan_id').empty();
                $('select.suburusan_id').append('<option value="" selected disabled>Please select</option>');
                $.each(data.suburusan, function (index, subcategory) {
                    $('select.suburusan_id').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                });
            }
        });
    });
});

