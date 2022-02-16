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
        searching: false,
        columns: [
            {data: 'kode_antrian', name: 'kode_antrian'},
            {data: 'tgl_antrian', name: 'tgl_antrian'},
            {data: 'jam_antrian', name: 'jam_antrian'},
            {data: 'name', name: 'name'},
            {data: 'address', name: 'address'},
            {data: 'phone', name: 'phone'},
            {data: 'nik', name: 'nik'},
            {data: 'status', name: 'status'},
        ],
    });
    var Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000
    });
    $('body').on('click', '.action-delete', function () {
        var transaksi_id = $(this).data("id");
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
                    url: "/bbn/destroy" + '/' + transaksi_id,
                    dataType: 'JSON',
                    data: {
                        'id': transaksi_id,
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
        var transaksi_id = $(this).data('id');
        $.get("bbn" + '/' + transaksi_id + '/edit', function (data) {
            $('#modelHeading').html("Edit Transaksi");
            $('#ajaxModel').modal('show');
            $('#transaksi_id').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_name').prop('readonly', true);
            $('#edit_no_registrasi').val(data.no_registrasi);
            $('#edit_no_registrasi').prop('readonly', true);
            $('#edit_jenis_kendaraan').val(data.jenis_kendaraan);
            $('#edit_jenis_kendaraan').prop('readonly', true);
            $('#edit_merk_kendaraan').val(data.merk_kendaraan);
            $('#edit_merk_kendaraan').prop('readonly', true);
            $('#edit_tahun_kendaraan').val(data.tahun_kendaraan);
            $('#edit_tahun_kendaraan').prop('readonly', true);
            $('#edit_status_kendaraan').val(data.status_kendaraan);
            $('#edit_status_kendaraan').prop('readonly', true);
            $('#edit_status').val(data.status);
            $('#edit_status').attr("disabled", false);
            $('button.btn-submit-update').show();
        });
    });

    $('body').on('click', '.action-view', function () {
        var transaksi_id = $(this).data('id');
        $.get("bbn" + '/' + transaksi_id + '/edit', function (data) {
            $('#modelHeading').html("View Transaksi");
            $('#ajaxModel').modal('show');
            $('#transaksi_id').val(data.id);
            $('#edit_name').val(data.name);
            $('#edit_name').prop('readonly', true);
            $('#edit_no_registrasi').val(data.no_registrasi);
            $('#edit_no_registrasi').prop('readonly', true);
            $('#edit_jenis_kendaraan').val(data.jenis_kendaraan);
            $('#edit_jenis_kendaraan').prop('readonly', true);
            $('#edit_merk_kendaraan').val(data.merk_kendaraan);
            $('#edit_merk_kendaraan').prop('readonly', true);
            $('#edit_tahun_kendaraan').val(data.tahun_kendaraan);
            $('#edit_tahun_kendaraan').prop('readonly', true);
            $('#edit_status_kendaraan').val(data.status_kendaraan);
            $('#edit_status_kendaraan').prop('readonly', true);
            $('#edit_status').val(data.status);
            $('#edit_status').attr("disabled", true);
            $('button.btn-submit-update').hide();
        });
    });

    $('body').on('click', '.btn-action-add', function () {
        $('#modelAddHeading').html("Add Transaksi");
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
            data: $('#transaksiAddForm').serialize(),
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
            url: "bbn/update",
            method: 'PUT',
            data: $('#TransaksiForm').serialize(),
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

    $('body').on('click', '.action-stnk', function () {
        var transaksi_id = $(this).data('id');
        $.get("bbn" + '/' + transaksi_id + '/viewstnk', function (data) {
            $('#ajaxAddModel').modal('show');
            $("#frame").attr("src", 'berkas/' + data.shortpath);
        });
    })
});

