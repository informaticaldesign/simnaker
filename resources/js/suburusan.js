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
            {data: 'opd', name: 'opd'},
            {data: 'urusan', name: 'urusan'},
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
        var suburusan_id = $(this).data("id");
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
                    url: "/suburusan/destroy" + '/' + suburusan_id,
                    dataType: 'JSON',
                    data: {
                        'id': suburusan_id,
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
        var suburusan_id = $(this).data('id');
        $.get("suburusan" + '/' + suburusan_id + '/edit', function (data) {
            $.ajax({
                url: urlSektor,
                type: "POST",
                data: {
                    provinsi_id: data.provinsi_id
                },
                success: function (datax) {
                    $('select.sektor_id').empty();
                    $.each(datax.sektor, function (index, subcategory) {
                        var _selected = "";
                        if (data.sektor_id == subcategory.id) {
                            _selected = "selected";
                        }
                        $('select.sektor_id').append('<option value="' + subcategory.id + '" ' + _selected + '>' + subcategory.name + '</option>');
                    });
                }
            });
            $.ajax({
                url: urlBidang,
                type: "POST",
                data: {
                    sektor_id: data.sektor_id
                },
                success: function (datax) {
                    $('select.bidang_id').empty();
                    $.each(datax.bidang, function (index, subcategory) {
                        var _selected = "";
                        if (data.bidang_id == subcategory.id) {
                            _selected = "selected";
                        }
                        $('select.bidang_id').append('<option value="' + subcategory.id + '" ' + _selected + '>' + subcategory.name + '</option>');
                    });
                }
            });
            $.ajax({
                url: urlUrusan,
                type: "POST",
                data: {
                    bidang_id: data.bidang_id
                },
                success: function (datax) {
                    $('select.urusan_id').empty();
                    $.each(datax.urusan, function (index, subcategory) {
                        var _selected = "";
                        if (data.urusan_id == subcategory.id) {
                            _selected = "selected";
                        }
                        $('select.urusan_id').append('<option value="' + subcategory.id +  '" ' + _selected + '>' + subcategory.name + '</option>');
                    });
                }
            });
            $('#modelHeading').html("Edit Sub Urusan");
            $('#ajaxModel').modal('show');
            $('#edit_suburusan_id').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_name').prop('readonly', false);
            $('#edit_code').val(data.code);
            $('#edit_code').prop('readonly', false);
            $('#edit_provinsi_id').val(data.provinsi_id);
            $('#edit_provinsi_id').attr('disabled',false);
            $('#edit_sektor_id').attr('disabled',false);
            $('#edit_bidang_id').attr('disabled',false);
            $('#edit_urusan_id').attr('disabled',false);
            $('button.btn-submit-update').show();
        });
    });

    $('body').on('click', '.action-view', function () {
        var suburusan_id = $(this).data('id');
        $.get("suburusan" + '/' + suburusan_id + '/edit', function (data) {
            $.ajax({
                url: urlSektor,
                type: "POST",
                data: {
                    provinsi_id: data.provinsi_id
                },
                success: function (datax) {
                    $('select.sektor_id').empty();
                    $.each(datax.sektor, function (index, subcategory) {
                        var _selected = "";
                        if (data.sektor_id == subcategory.id) {
                            _selected = "selected";
                        }
                        $('select.sektor_id').append('<option value="' + subcategory.id + '" ' + _selected + '>' + subcategory.name + '</option>');
                    });
                }
            });
            $.ajax({
                url: urlBidang,
                type: "POST",
                data: {
                    sektor_id: data.sektor_id
                },
                success: function (datax) {
                    $('select.bidang_id').empty();
                    $.each(datax.bidang, function (index, subcategory) {
                        var _selected = "";
                        if (data.bidang_id == subcategory.id) {
                            _selected = "selected";
                        }
                        $('select.bidang_id').append('<option value="' + subcategory.id + '" ' + _selected + '>' + subcategory.name + '</option>');
                    });
                }
            });
            $.ajax({
                url: urlUrusan,
                type: "POST",
                data: {
                    bidang_id: data.bidang_id
                },
                success: function (datax) {
                    $('select.urusan_id').empty();
                    $.each(datax.urusan, function (index, subcategory) {
                        var _selected = "";
                        if (data.urusan_id == subcategory.id) {
                            _selected = "selected";
                        }
                        $('select.urusan_id').append('<option value="' + subcategory.id +  '" ' + _selected + '>' + subcategory.name + '</option>');
                    });
                }
            });
            $('#modelHeading').html("View Sub Urusan");
            $('#ajaxModel').modal('show');
            $('#edit_suburusan_id').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_name').prop('readonly', true);
            $('#edit_code').val(data.code);
            $('#edit_code').prop('readonly', true);
            $('#edit_provinsi_id').val(data.provinsi_id);
            $('#edit_provinsi_id').attr('disabled',true);
            $('#edit_sektor_id').attr('disabled',true);
            $('#edit_bidang_id').attr('disabled',true);
            $('#edit_urusan_id').attr('disabled',true);
            $('button.btn-submit-update').hide();
        });
    });

    $('body').on('click', '.btn-action-add', function () {
        $('#modelAddHeading').html("Add Sub Urusan");
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
            data: $('#suburusanAddForm').serialize(),
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
            url: "suburusan/update",
            method: 'PUT',
            data: $('#SuburusanForm').serialize(),
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
});

