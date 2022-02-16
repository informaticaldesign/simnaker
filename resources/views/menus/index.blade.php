<?php

use App\Http\Controllers\MenusController;
?>
@extends('adminlte::page')

@section('title', 'Menus')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Menus</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Settings</a></li>
            <li class="breadcrumb-item active">Menus</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-4 col-lg-4">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Modules <small>list</small></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body" id="tab-modules">
                <ul style="padding-left: 0px !important;">
                    @foreach ($modules as $module)
                    <li><i class="fa {{ $module->fa_icon }}"></i> {{ $module->name }} <a module_id="{{ $module->id }}" class="addModuleMenu pull-right"><i class="fa fa-plus"></i></a></li>
                    @endforeach
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-8 col-lg-8">
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title">Menus <small>list</small></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="dd" id="menu-nestable">
                    <ol class="dd-list">
                        @foreach ($menus as $menu)
                        <?php echo MenuHelper::print_menu_editor($menu); ?>
                        @endforeach
                    </ol>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.css">
<link rel="stylesheet" href="{{ asset('css/menus.css') }}">
@stop

@section('js')
<script src="{{ asset('vendor/nestable/jquery.nestable.js') }}"></script>
<script>
$(function () {
    $('#menu-nestable').nestable({
        group: 1
    });
    $('#menu-nestable').on('change', function () {
        var jsonData = $('#menu-nestable').nestable('serialize');
        $.ajax({
            url: "{{ route('menus.update') }}",
            method: 'PUT',
            data: {
                jsonData: jsonData,
                "_token": '{{ csrf_token() }}'
            }
        });
    });
    $("#tab-modules .addModuleMenu").on("click", function () {
        var module_id = $(this).attr("module_id");
        $.ajax({
            url: "{{ route('menus.store') }}",
            method: 'POST',
            data: {
                type: 'module',
                module_id: module_id,
                "_token": '{{ csrf_token() }}'
            },
            success: function (data) {
                // console.log(data);
                window.location.reload();
            }
        });
    });
});
</script>
@stop