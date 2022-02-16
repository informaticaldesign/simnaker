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
                <h3 class="card-title">Detail <small>Role</small></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width:25%; border-top: 1px solid white;">Name:</th>
                                        <td style="border-top: 1px solid white;">{{$role->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Label</th>
                                        <td>{{$role->label}}</td>
                                    </tr>
                                    <tr>
                                        <th>Description:</th>
                                        <td>{{$role->description}}</td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-default color-palette-box">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-key"></i>
                    Role Access
                </h3>
            </div>
            <div class="card-body">
                {{ Form::open(array('url' => 'roles/save/'.$role->id,'method'=>'post')) }}
                <table class="table table-bordered dataTable no-footer table-access">
                    <thead>
                        <tr class="blockHeader">
                            <th width="40%">
                                <input class="alignTop" type="checkbox" id="module_select_all" id="module_select_all" checked="checked">&nbsp; Modules
                            </th>
                            <th width="15%">
                                <input type="checkbox" id="view_all" checked="checked">&nbsp; View
                            </th>
                            <th width="15%">
                                <input type="checkbox" id="create_all" checked="checked">&nbsp; Create
                            </th>
                            <th width="15%">
                                <input type="checkbox" id="edit_all" checked="checked">&nbsp; Edit
                            </th>
                            <th width="15%">
                                <input class="alignTop" id="delete_all" type="checkbox"  checked="checked">&nbsp; Delete
                            </th>
                        </tr>
                    </thead>
                    @foreach($modules_access as $module)
                    <tr>
                        <td><input module_id="{{ $module->id }}" class="module_checkb" type="checkbox" name="module_{{$module->id}}" id="module_{{$module->id}}" checked="checked">&nbsp; {{ $module->name }}</td>
                        <td><input module_id="{{ $module->id }}" class="view_checkb" type="checkbox" name="module_view_{{$module->id}}" id="module_view_{{$module->id}}" <?php
                            if ($module->acc_view == 1) {
                                echo 'checked="checked"';
                            }
                            ?> >
                        </td>
                        <td><input module_id="{{ $module->id }}" class="create_checkb" type="checkbox" name="module_create_{{$module->id}}" id="module_create_{{$module->id}}" <?php
                            if ($module->acc_create == 1) {
                                echo 'checked="checked"';
                            }
                            ?> >
                        </td>
                        <td><input module_id="{{ $module->id }}" class="edit_checkb" type="checkbox" name="module_edit_{{$module->id}}" id="module_edit_{{$module->id}}" <?php
                            if ($module->acc_edit == 1) {
                                echo 'checked="checked"';
                            }
                            ?> >
                        </td>
                        <td><input module_id="{{ $module->id }}" class="delete_checkb" type="checkbox" name="module_delete_{{$module->id}}" id="module_delete_{{$module->id}}" <?php
                            if ($module->acc_delete == 1) {
                                echo 'checked="checked"';
                            }
                            ?> >
                        </td>
                    </tr>
                    @endforeach
                </table>
                <button type="submit" class="btn btn-info">Submit</button>
                <a href="{{ route('roles') }}" class="btn btn-default float-right" role="button" data-bs-toggle="button">Cancel</a>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@stop

@section('js')
<script src="{{ asset('js/detailroles.js') }}?v={{ date('YmdHis')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
@if (Session::has('message'))
        toastr.options =
        {
        "closeButton" : true,
                "progressBar" : true,
                "positionClass": "toast-bottom-right",
                }
toastr.success("{{ session('message') }}");
@endif
</script>
@stop
