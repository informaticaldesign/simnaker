@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Users</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Settings</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </div>
</div>
@stop

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Users <small>list</small></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-action-add" data-toggle="tooltip" data-placement="top" title="Add User">
                        <i class="fas fa-plus text-primary"></i>
                    </button>
                    <a href="#" class="btn btn-tool"><i class="fas fa-file-excel text-gray-300"></i></a>
                    <a href="#" class="btn btn-tool" target="_blank"><i class="fas fa-file-pdf text-gray-300"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role Name</th>
                            <th width="200px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('id' => 'UserForm','name'=>'UserForm', 'class'=>'form-horizontal')) }}
                <input type="hidden" name="user_id" id="user_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="256" required="">
                    </div>
                    <div class="invalid-feedback invalid-name"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="256" required="">
                    </div>
                    <div class="invalid-feedback invalid-email"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Roles</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="role_id">
                            @foreach ($roles as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="invalid-feedback invalid-role_id"></div>
                </div>

                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-submit-update">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxAddModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelAddHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="userAddForm" method="post">
                    {{ csrf_field() }}

                    {{-- Name field --}}
                    <div class="input-group mb-3">
                        <select class="form-control biodata" name="biodata_id">
                            <option value="" disabled selected>Pilih nama pegawai</option>
                            @foreach ($biodata as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback invalid-biodata_id"></div>
                    </div>

                    {{-- Email field --}}
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control email {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback invalid-email"></div>
                    </div>

                    <div class="input-group mb-3">
                        <select class="form-control" name="role_id">
                            <option value="" disabled selected>Pilih role user</option>
                            @foreach ($roles as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-link {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback invalid-role_id"></div>
                    </div>

                    {{-- Password field --}}
                    <div class="input-group mb-3">
                        <input type="password" name="password"
                               class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                               placeholder="{{ __('adminlte::adminlte.password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback invalid-password"></div>
                    </div>

                    {{-- Confirm password field --}}
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation"
                               class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                               placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback invalid-password-confirm"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-action-submit">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    var urlFetch = "{{ route('users.fetch') }}";
    var urlStore = "{{ route('users.store') }}";
</script>
<script>
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
                {data: 'email', name: 'email'},
                {data: 'role_name', name: 'role_name'},
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
            var user_id = $(this).data("id");
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
                        url: "/users/destroy" + '/' + user_id,
                        dataType: 'JSON',
                        data: {
                            'id': user_id,
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
                    401: function () {
                        console.log(1221)
                    },
                    419: function () {
                        console.log(2222)
                    }
                },
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
                url: "{{ route('users.update') }}",
                method: 'PUT',
                data: $('#UserForm').serialize(),
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
                }
            });
        });

        $('body').on('change', 'select.biodata', function () {
            $.get("pengguna" + '/' + $(this).val() + '/edit', function (data) {
                $('input.email').val(data.email);
            });
        });
    });
</script>
@stop