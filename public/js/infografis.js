/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/infografis.js ***!
  \************************************/
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
      data: 'image',
      name: 'image'
    }, {
      data: 'title',
      name: 'title'
    }, {
      data: 'organizations_name',
      name: 'organizations_name'
    }, {
      data: 'topic_name',
      name: 'topic_name'
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
    var role_id = $(this).data("id");
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
          url: "/admin/infografis/destroy" + '/' + role_id,
          dataType: 'JSON',
          data: {
            'id': role_id
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
});
/******/ })()
;