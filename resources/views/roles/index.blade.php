@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Roles</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Settings</a></li>
            <li class="breadcrumb-item active">Roles</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Users <small>list</small></h3>
                <div class="card-tools">
                    <a href="{{ route('roles.create') }}" class="btn btn-tool"><i class="fas fa-plus text-primary"></i></a>
                    <a href="#" class="btn btn-tool"><i class="fas fa-file-excel text-gray-300"></i></a>
                    <a href="#" class="btn btn-tool"><i class="fas fa-file-pdf text-gray-300"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Name</th>
                            <th>Label</th><!-- comment -->
                            <th>Description</th>
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
                {{ Form::open(array('id' => 'RoleForm','name'=>'RoleForm', 'class'=>'form-horizontal')) }}
                <input type="hidden" name="role_id" id="role_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="256" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Label</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="label" name="label" placeholder="Enter Label" value="" maxlength="256" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter description" value="" maxlength="256" required="">
                    </div>
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
                <form id="roleAddForm" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="name" placeholder="name">
                            <div class="invalid-feedback invalid-name"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="label" class="col-sm-2 col-form-label">Label<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="label" class="form-control" id="label" placeholder="label">
                            <div class="invalid-feedback invalid-label"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="description" class="form-control" id="description" placeholder="description">
                            <div class="invalid-feedback invalid-description"></div>
                        </div>
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
    var urlFetch = "{{ route('roles.fetch') }}";
    var urlStore = "{{ route('roles.store') }}";
</script>
<script src="{{ asset('js/roles.js') }}?{{date('YmdHis')}}"></script>
@stop