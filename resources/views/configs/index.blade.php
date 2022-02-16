@extends('adminlte::page')

@section('title', 'Configs')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Configs</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Settings</a></li>
            <li class="breadcrumb-item active">Configs</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Configs <small>list</small></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{route('configs.store')}}" method="POST">
                    {{ csrf_field() }}
                    <!-- text input -->
                    <div class="form-group">
                        <label>Sitename</label>
                        <input type="text" class="form-control" placeholder="Lara" name="sitename" value="{{$configs->sitename}}">
                    </div>
                    <div class="form-group">
                        <label>Sitename First Word</label>
                        <input type="text" class="form-control" placeholder="Lara" name="sitename_part1" value="{{$configs->sitename_part1}}">
                    </div>
                    <div class="form-group">
                        <label>Sitename Second Word</label>
                        <input type="text" class="form-control" placeholder="Admin 1.0" name="sitename_part2" value="{{$configs->sitename_part2}}">
                    </div>
                    <div class="form-group">
                        <label>Sitename Short (2/3 Characters)</label>
                        <input type="text" class="form-control" placeholder="LA" maxlength="2" name="sitename_short" value="{{$configs->sitename_short}}">
                    </div>
                    <div class="form-group">
                        <label>Site Description</label>
                        <input type="text" class="form-control" placeholder="Description in 140 Characters" maxlength="140" name="site_description" value="{{$configs->site_description}}">
                    </div>
                    <!-- checkbox -->
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="sidebar_search" @if($configs->sidebar_search) checked @endif>
                                Show Search Bar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="show_messages" @if($configs->show_messages) checked @endif>
                                Show Messages Icon
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="show_notifications" @if($configs->show_notifications) checked @endif>
                                Show Notifications Icon
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="show_tasks" @if($configs->show_tasks) checked @endif>
                                Show Tasks Icon
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="show_rightsidebar" @if($configs->show_rightsidebar) checked @endif>
                                Show Right SideBar Icon
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="body_small_text" @if($configs->body_small_text) checked @endif>
                                Body small text
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="dark_mode" @if($configs->dark_mode) checked @endif>
                                Dark Mode
                            </label>
                        </div>
                    </div>
                    <!-- select -->
                    <div class="form-group">
                        <label>Navbar Variants</label>
                        <select class="form-control" name="navbar_variants">
                            @foreach($variantsnav as $name=>$property)
                            <option value="{{ $property }}" @if($configs->navbar_variants == $property) selected @endif>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Skin Color</label>
                        <select class="form-control" name="skin">
                            @foreach($skins as $name=>$property)
                            <option value="{{ $property }}" @if($configs->skin == $property) selected @endif>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Layout</label>
                        <select class="form-control" name="layout">
                            @foreach($layouts as $name=>$property)
                            <option value="{{ $property }}" @if($configs->layout == $property) selected @endif>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Default Email Address</label>
                        <input type="text" class="form-control" placeholder="To send emails to others via SMTP" maxlength="100" name="default_email" value="{{$configs->default_email}}">
                    </div><!-- comment -->
                    <div class="form-group float-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@stop