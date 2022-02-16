@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
@php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
@php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif
<div class="card">
    <div class="card-header text-center" style="background-color:#1e375b !important; color:#fff !important;">
        Akses Pengguna
    </div>
    <div class="card-body">
        {{ Form::open(array('id' => 'MyFormLogin','name'=>'MyFormLogin', 'class'=>'form-horizontal')) }}
        <div class="mb-3 row">
            <label for="email" class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="email">
                <div class="invalid-feedback invalid-email"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-4 col-form-label">Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="password">
                <div class="invalid-feedback invalid-password"></div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <button type="button" class="btn btn-primary btn-login" style="background-color:#1e375b !important; color:#fff !important; border-color: #1e375b !important;"><i class="fa fa-sign-in-alt"></i>&nbsp;Masuk </button> 
            <a href="{{ $password_reset_url }}" class="text-body">Lupa Password?</a>
        </div>
        {{ Form::close() }}
    </div>
    <div class="card-footer text-center" style="background-color:#1e375b !important; color:#fff !important;">
        Belum Punya Akun? <a href="{{ url('registrasi') }}" class="text-white">Daftar</a>
    </div>
</div>