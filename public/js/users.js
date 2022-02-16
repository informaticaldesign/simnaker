/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/users.js ***!
  \*******************************/
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
    columns: [{
      data: 'id',
      name: 'id'
    }, {
      data: 'name',
      name: 'name'
    }, {
      data: 'email',
      name: 'email'
    }, {
      data: 'role_name',
      name: 'role_name'
    }, {
      data: 'action',
      name: 'action',
      orderable: false,
      searchable: false
    }]
  });

  var Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000
  });
  $('body').on('click', '.action-delete', function () {
    var user_id = $(this).data("id");
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function (result) {
      if (result.isConfirmed) {
        $.ajax({
          type: "DELETE",
          url: "/users/destroy" + '/' + user_id,
          dataType: 'JSON',
          data: {
            'id': user_id
          },
          success: function success(data) {
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
    var user_id = $(this).data('id');
    $.get("users" + '/' + user_id + '/edit', function (data) {
      $('#modelHeading').html("Edit User");
      $('#ajaxModel').modal('show');
      $('#user_id').val(data.id);
      $('#name').val(data.name);
      $('#name').prop('readonly', false);
      $('#email').val(data.email);
      $('#role_id').val(data.role_id);
      $('#email').prop('readonly', false);
      $('button.btn-submit-update').show();
    });
  });
  $('body').on('click', '.action-view', function () {
    var user_id = $(this).data('id');
    $.get("users" + '/' + user_id + '/edit', function (data) {
      $('#modelHeading').html("View User");
      $('#ajaxModel').modal('show');
      $('#user_id').val(data.id);
      $('#name').val(data.name);
      $('#name').prop('readonly', true);
      $('#email').val(data.email);
      $('#email').prop('readonly', true);
      $('button.btn-submit-update').hide();
    });
  });
  $('body').on('click', '.btn-action-add', function () {
    $('#modelAddHeading').html("Add User");
    $('#ajaxAddModel').modal('show');
  });
  $('button.btn-action-submit').click(function (e) {
    event.preventDefault();
    $('.form-control').removeClass('is-invalid');
    $('.invalid-name').text('');
    $('.invalid-email').text('');
    $('.invalid-password').text('');
    $('.invalid-password-confirm').text('');
    $.ajax({
      url: urlStore,
      type: "POST",
      data: $('#userAddForm').serialize(),
      statusCode: {
        401: function _() {
          console.log(1221);
        },
        419: function _() {
          console.log(2222);
        }
      },
      success: function success(response) {
        $('#ajaxAddModel').modal('hide');
        Toast.fire({
          icon: 'success',
          title: response.message
        });
        $('.data-table').DataTable().ajax.reload();
      },
      error: function error(err) {
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
      url: "users/update",
      method: 'PUT',
      data: $('#UserForm').serialize(),
      success: function success(result) {
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
/******/ })()
;