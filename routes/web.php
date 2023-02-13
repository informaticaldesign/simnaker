<?php

use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('admin', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('layanan-pengaduan', [App\Http\Controllers\Frontend\PengaduanController::class, 'index']);
Route::get('akta-pemeriksaan', [App\Http\Controllers\Frontend\PemeriksaanController::class, 'index']);
Route::post('akta-pemeriksaan/register', [App\Http\Controllers\Frontend\PemeriksaanController::class, 'register']);
Route::post('akta-pemeriksaan/masuk', [App\Http\Controllers\Frontend\PemeriksaanController::class, 'masuk']);
Route::get('akta-pemeriksaan/login', [App\Http\Controllers\Frontend\PemeriksaanController::class, 'login']);
Route::post('layanan-pengaduan/submit', [App\Http\Controllers\Frontend\PengaduanController::class, 'store']);
Route::get('pelatihan', [App\Http\Controllers\Frontend\PelatihanController::class, 'index']);
Route::get('layanan', [App\Http\Controllers\Frontend\LayananController::class, 'index'])->name('layanan');
Route::get('akses', [App\Http\Controllers\Frontend\AksesController::class, 'index'])->name('akses');
Route::get('regulasi', [App\Http\Controllers\Frontend\RegulasiController::class, 'index']);
Route::get('regulasi/{slug}', [\App\Http\Controllers\Frontend\RegulasiController::class, 'show']);
Route::get('talkshow', [App\Http\Controllers\Frontend\TalkshowController::class, 'index']);
Route::get('talkshow/{slug}', [\App\Http\Controllers\Frontend\TalkshowController::class, 'show']);
Route::get('perusahaan', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('registrasi', [App\Http\Controllers\Frontend\RegistrasiController::class, 'index']);
Route::post('registrasi/submit', [App\Http\Controllers\Frontend\RegistrasiController::class, 'submit']);
Route::get('/', [\App\Http\Controllers\Frontend\BerandaController::class, 'index']);
Route::get('/beranda/fetch', [App\Http\Controllers\Frontend\BerandaController::class, 'fetch'])->name('beranda.fetch');
Route::get('/reload-captcha', [App\Http\Controllers\Auth\RegisterController::class, 'reloadCaptcha']);
Route::auth();
Auth::routes();

Route::get('/cetak-akta', function () {
    return View('akta.pengawasan.cetak');
});

$as = "";
Route::group(['as' => $as, 'middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/home/pengajuan', ['as' => 'home.pengajuan', 'uses' => 'HomeController@pengajuan']);
    Route::post('/home/pieajukan', ['as' => 'home.pieajukan', 'uses' => 'HomeController@pieajukan']);
    Route::post('/home/dbbn', ['as' => 'home.dbbn', 'uses' => 'HomeController@dbbn']);
    Route::post('/admin/visitor/chartline', ['as' => 'admin.visitor.chartline', 'uses' => 'HomeController@chartline']);
    Route::get('/home/notifcount', ['as' => 'home.notifcount', 'uses' => 'HomeController@notifcount']);

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/show', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/personal', [App\Http\Controllers\ProfileController::class, 'personal'])->name('profile.personal');
    Route::post('/profile/simpan', [App\Http\Controllers\ProfileController::class, 'simpan'])->name('profile.simpan');

    /* ================== Users ================== */
    Route::get('/users', ['as' => 'users', 'uses' => 'UsersController@index']);
    Route::get('/users/fetch', ['as' => 'users.fetch', 'uses' => 'UsersController@fetch']);
    Route::post('/users/store', ['as' => 'users.store', 'uses' => 'UsersController@store']);
    Route::delete('/users/destroy/{id}', ['as' => 'users.destroy', 'uses' => 'UsersController@destroy']);
    Route::put('/users/update', ['as' => 'users.update', 'uses' => 'UsersController@update']);
    Route::get('/users/{id}/edit', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);

    /* ================== Modules ================== */
    Route::get('/modules', ['as' => 'modules', 'uses' => 'ModulesController@index']);
    Route::get('/modules/fetch', ['as' => 'modules.fetch', 'uses' => 'ModulesController@fetch']);
    Route::post('/modules/store', ['as' => 'modules.store', 'uses' => 'ModulesController@store']);
    Route::delete('/modules/destroy/{id}', ['as' => 'modules.destroy', 'uses' => 'ModulesController@destroy']);
    Route::put('/modules/update', ['as' => 'modules.update', 'uses' => 'ModulesController@update']);
    Route::get('/modules/{id}/edit', ['as' => 'modules.edit', 'uses' => 'ModulesController@edit']);

    /* ================== Menus ================== */
    Route::get('/menus', ['as' => 'menus', 'uses' => 'MenusController@index']);
    Route::post('/menus/store', ['as' => 'menus.store', 'uses' => 'MenusController@store']);
    Route::delete('/menus/destroy/{id}', ['as' => 'menus.destroy', 'uses' => 'MenusController@destroy']);
    Route::put('/menus/update', ['as' => 'menus.update', 'uses' => 'MenusController@update']);

    /* ================== Roles ================== */
    Route::get('/roles', ['as' => 'roles', 'uses' => 'RolesController@index']);
    Route::get('/roles/create', ['as' => 'roles.create', 'uses' => 'RolesController@create']);
    Route::get('/roles/show/{id}', ['as' => 'roles.show', 'uses' => 'RolesController@show']);
    Route::get('/roles/fetch', ['as' => 'roles.fetch', 'uses' => 'RolesController@fetch']);
    Route::post('/roles/store', ['as' => 'roles.store', 'uses' => 'RolesController@store']);
    Route::delete('/roles/destroy/{id}', ['as' => 'roles.destroy', 'uses' => 'RolesController@destroy']);
    Route::put('/roles/update', ['as' => 'roles.update', 'uses' => 'RolesController@update']);
    Route::get('/roles/{id}/edit', ['as' => 'roles.edit', 'uses' => 'RolesController@edit']);
    Route::post('/roles/save/{id}', 'RolesController@save');
    Route::post('/roles/save_provinsi/{id}', 'RolesController@save_provinsi');
    Route::post('/roles/save_sektor/{id}', 'RolesController@save_sektor');
    Route::post('/roles/save_opd/{id}', 'RolesController@save_opd');
    Route::post('/roles/save_urusan/{id}', 'RolesController@save_urusan');
    Route::post('/roles/save_suburusan/{id}', 'RolesController@save_suburusan');

    /* ================== Configs ================== */
    Route::get('/configs', ['as' => 'configs', 'uses' => 'ConfigsController@index']);
    Route::post('/configs/store', ['as' => 'configs.store', 'uses' => 'ConfigsController@store']);

    Route::get('/pemeriksaan', ['as' => 'pemeriksaan', 'uses' => 'PemeriksaanController@create']);
    Route::get('/pemeriksaan/rekap', ['as' => 'pemeriksaan.rekap', 'uses' => 'PemeriksaanController@index']);
    Route::post('/pemeriksaan/store', ['as' => 'pemeriksaan.store', 'uses' => 'PemeriksaanController@store']);
    Route::get('/pemeriksaan/fetch', ['as' => 'pemeriksaan.fetch', 'uses' => 'PemeriksaanController@fetch']);
    Route::delete('/pemeriksaan/destroy/{id}', ['as' => 'pemeriksaan.destroy', 'uses' => 'PemeriksaanController@destroy']);
    Route::get('/pemeriksaan/{id}/show', ['as' => 'pemeriksaan.show', 'uses' => 'PemeriksaanController@show']);
    Route::get('/pemeriksaan/{id}/edit', ['as' => 'pemeriksaan.edit', 'uses' => 'PemeriksaanController@edit']);
    Route::post('/pemeriksaan/update', ['as' => 'pemeriksaan.update', 'uses' => 'PemeriksaanController@update']);

    Route::get('/pengawasan', ['as' => 'pengawasan', 'uses' => 'PengawasanController@create']);
    Route::get('/pengawasan/rekap', ['as' => 'pengawasan.rekap', 'uses' => 'PengawasanController@index']);
    Route::post('/pengawasan/store', ['as' => 'pengawasan.store', 'uses' => 'PengawasanController@store']);
    Route::get('/pengawasan/fetch', ['as' => 'pengawasan.fetch', 'uses' => 'PengawasanController@fetch']);
    Route::delete('/pengawasan/destroy/{id}', ['as' => 'pengawasan.destroy', 'uses' => 'PengawasanController@destroy']);
    Route::get('/pengawasan/{id}/show', ['as' => 'pengawasan.show', 'uses' => 'PengawasanController@show']);
    Route::get('/pengawasan/{id}/edit', ['as' => 'pengawasan.edit', 'uses' => 'PengawasanController@edit']);
    Route::post('/pengawasan/update', ['as' => 'pengawasan.update', 'uses' => 'PengawasanController@update']);

    Route::get('/pengguna', ['as' => 'pengguna', 'uses' => 'PenggunaController@index']);
    Route::get('/pengguna/fetch', ['as' => 'pengguna.fetch', 'uses' => 'PenggunaController@fetch']);
    Route::get('/pengguna/fcomp/{id}', ['as' => 'pengguna.fcomp', 'uses' => 'PenggunaController@fcomp']);
    Route::post('/pengguna/store', ['as' => 'pengguna.store', 'uses' => 'PenggunaController@store']);
    Route::post('/pengguna/ucomp', ['as' => 'pengguna.ucomp', 'uses' => 'PenggunaController@ucomp']);
    Route::get('/pengguna/{id}/edit', ['as' => 'pengguna.edit', 'uses' => 'PenggunaController@edit']);
    Route::put('/pengguna/update', ['as' => 'pengguna.update', 'uses' => 'PenggunaController@update']);
    Route::delete('/pengguna/destroy/{id}', ['as' => 'pengguna.destroy', 'uses' => 'PenggunaController@destroy']);
    Route::get('/pengguna/{id}/company', ['as' => 'pengguna.company', 'uses' => 'PenggunaController@company']);
    Route::get('/pengguna/{id}/upt', ['as' => 'pengguna.upt', 'uses' => 'PenggunaController@upt']);
    Route::get('/pengguna/fupt/{id}', ['as' => 'pengguna.fupt', 'uses' => 'PenggunaController@fupt']);
    Route::post('/pengguna/eupt', ['as' => 'pengguna.eupt', 'uses' => 'PenggunaController@eupt']);

    Route::get('/jabatan', ['as' => 'jabatan', 'uses' => 'JabatanController@index']);
    Route::get('/jabatan/fetch', ['as' => 'jabatan.fetch', 'uses' => 'JabatanController@fetch']);
    Route::post('/jabatan/store', ['as' => 'jabatan.store', 'uses' => 'JabatanController@store']);
    Route::get('/jabatan/{id}/edit', ['as' => 'jabatan.edit', 'uses' => 'JabatanController@edit']);
    Route::put('/jabatan/update', ['as' => 'jabatan.update', 'uses' => 'JabatanController@update']);
    Route::delete('/jabatan/destroy/{id}', ['as' => 'jabatan.destroy', 'uses' => 'JabatanController@destroy']);

    Route::get('/golongan', ['as' => 'golongan', 'uses' => 'GolonganController@index']);
    Route::get('/golongan/fetch', ['as' => 'golongan.fetch', 'uses' => 'GolonganController@fetch']);
    Route::post('/golongan/store', ['as' => 'golongan.store', 'uses' => 'GolonganController@store']);
    Route::get('/golongan/{id}/edit', ['as' => 'golongan.edit', 'uses' => 'GolonganController@edit']);
    Route::put('/golongan/update', ['as' => 'golongan.update', 'uses' => 'GolonganController@update']);
    Route::delete('/golongan/destroy/{id}', ['as' => 'golongan.destroy', 'uses' => 'GolonganController@destroy']);

    Route::get('/pangkat', ['as' => 'pangkat', 'uses' => 'PangkatController@index']);
    Route::get('/pangkat/fetch', ['as' => 'pangkat.fetch', 'uses' => 'PangkatController@fetch']);
    Route::post('/pangkat/store', ['as' => 'pangkat.store', 'uses' => 'PangkatController@store']);
    Route::get('/pangkat/{id}/edit', ['as' => 'pangkat.edit', 'uses' => 'PangkatController@edit']);
    Route::put('/pangkat/update', ['as' => 'pangkat.update', 'uses' => 'PangkatController@update']);
    Route::delete('/pangkat/destroy/{id}', ['as' => 'pangkat.destroy', 'uses' => 'PangkatController@destroy']);

    Route::get('/kota', ['as' => 'kota', 'uses' => 'KotaController@index']);
    Route::get('/kota/fetch', ['as' => 'kota.fetch', 'uses' => 'KotaController@fetch']);
    Route::post('/kota/store', ['as' => 'kota.store', 'uses' => 'KotaController@store']);
    Route::get('/kota/{id}/edit', ['as' => 'kota.edit', 'uses' => 'KotaController@edit']);
    Route::get('/admin/kota/{code}/combo', ['as' => 'admin.kota.combo', 'uses' => 'KotaController@combo']);
    Route::put('/kota/update', ['as' => 'kota.update', 'uses' => 'KotaController@update']);
    Route::delete('/kota/destroy/{id}', ['as' => 'kota.destroy', 'uses' => 'KotaController@destroy']);

    Route::get('/admin/kecamatan', ['as' => 'admin.kecamatan', 'uses' => 'KecamatanController@index']);
    Route::get('/admin/kecamatan/fetch', ['as' => 'admin.kecamatan.fetch', 'uses' => 'KecamatanController@fetch']);
    Route::post('/admin/kecamatan/store', ['as' => 'admin.kecamatan.store', 'uses' => 'KecamatanController@store']);
    Route::get('/admin/kecamatan/{id}/edit', ['as' => 'admin.kecamatan.edit', 'uses' => 'KecamatanController@edit']);
    Route::put('/admin/kecamatan/update', ['as' => 'admin.kecamatan.update', 'uses' => 'KecamatanController@update']);
    Route::delete('/admin/kecamatan/destroy/{id}', ['as' => 'admin.kecamatan.destroy', 'uses' => 'KecamatanController@destroy']);
    Route::get('/admin/kecamatan/{code}/combo', ['as' => 'admin.kecamatan.combo', 'uses' => 'KecamatanController@combo']);

    Route::get('/admin/kelurahan', ['as' => 'admin.kelurahan', 'uses' => 'KelurahanController@index']);
    Route::get('/admin/kelurahan/fetch', ['as' => 'admin.kelurahan.fetch', 'uses' => 'KelurahanController@fetch']);
    Route::post('/admin/kelurahan/store', ['as' => 'admin.kelurahan.store', 'uses' => 'KelurahanController@store']);
    Route::get('/admin/kelurahan/{id}/edit', ['as' => 'admin.kelurahan.edit', 'uses' => 'KelurahanController@edit']);
    Route::put('/admin/kelurahan/update', ['as' => 'admin.kelurahan.update', 'uses' => 'KelurahanController@update']);
    Route::delete('/admin/kelurahan/destroy/{id}', ['as' => 'admin.kelurahan.destroy', 'uses' => 'KelurahanController@destroy']);
    Route::get('/admin/kelurahan/{code}/combo', ['as' => 'admin.kelurahan.combo', 'uses' => 'KelurahanController@combo']);

    Route::get('/provinsi', ['as' => 'provinsi', 'uses' => 'ProvinsiController@index']);
    Route::get('/provinsi/fetch', ['as' => 'provinsi.fetch', 'uses' => 'ProvinsiController@fetch']);
    Route::post('/provinsi/store', ['as' => 'provinsi.store', 'uses' => 'ProvinsiController@store']);
    Route::get('/provinsi/{id}/edit', ['as' => 'provinsi.edit', 'uses' => 'ProvinsiController@edit']);
    Route::put('/provinsi/update', ['as' => 'provinsi.update', 'uses' => 'ProvinsiController@update']);
    Route::delete('/provinsi/destroy/{id}', ['as' => 'provinsi.destroy', 'uses' => 'ProvinsiController@destroy']);

    Route::get('/jenispem', ['as' => 'jenispem', 'uses' => 'JenispemController@index']);
    Route::get('/jenispem/fetch', ['as' => 'jenispem.fetch', 'uses' => 'JenispemController@fetch']);
    Route::post('/jenispem/store', ['as' => 'jenispem.store', 'uses' => 'JenispemController@store']);
    Route::get('/jenispem/{id}/edit', ['as' => 'jenispem.edit', 'uses' => 'JenispemController@edit']);
    Route::put('/jenispem/update', ['as' => 'jenispem.update', 'uses' => 'JenispemController@update']);
    Route::delete('/jenispem/destroy/{id}', ['as' => 'jenispem.destroy', 'uses' => 'JenispemController@destroy']);

    Route::get('/jenisusaha', ['as' => 'jenisusaha', 'uses' => 'JenisusahaController@index']);
    Route::get('/jenisusaha/fetch', ['as' => 'jenisusaha.fetch', 'uses' => 'JenisusahaController@fetch']);
    Route::post('/jenisusaha/store', ['as' => 'jenisusaha.store', 'uses' => 'JenisusahaController@store']);
    Route::get('/jenisusaha/{id}/edit', ['as' => 'jenisusaha.edit', 'uses' => 'JenisusahaController@edit']);
    Route::put('/jenisusaha/update', ['as' => 'jenisusaha.update', 'uses' => 'JenisusahaController@update']);
    Route::delete('/jenisusaha/destroy/{id}', ['as' => 'jenisusaha.destroy', 'uses' => 'JenisusahaController@destroy']);

    Route::get('/sifatdok', ['as' => 'sifatdok', 'uses' => 'SifatdokController@index']);
    Route::get('/sifatdok/fetch', ['as' => 'sifatdok.fetch', 'uses' => 'SifatdokController@fetch']);
    Route::post('/sifatdok/store', ['as' => 'sifatdok.store', 'uses' => 'SifatdokController@store']);
    Route::get('/sifatdok/{id}/edit', ['as' => 'sifatdok.edit', 'uses' => 'SifatdokController@edit']);
    Route::put('/sifatdok/update', ['as' => 'sifatdok.update', 'uses' => 'SifatdokController@update']);
    Route::delete('/sifatdok/destroy/{id}', ['as' => 'sifatdok.destroy', 'uses' => 'SifatdokController@destroy']);

    Route::get('/bidangusaha', ['as' => 'bidangusaha', 'uses' => 'BidangusahaController@index']);
    Route::get('/bidangusaha/fetch', ['as' => 'bidangusaha.fetch', 'uses' => 'BidangusahaController@fetch']);
    Route::post('/bidangusaha/store', ['as' => 'bidangusaha.store', 'uses' => 'BidangusahaController@store']);
    Route::get('/bidangusaha/{id}/edit', ['as' => 'bidangusaha.edit', 'uses' => 'BidangusahaController@edit']);
    Route::put('/bidangusaha/update', ['as' => 'bidangusaha.update', 'uses' => 'BidangusahaController@update']);
    Route::delete('/bidangusaha/destroy/{id}', ['as' => 'bidangusaha.destroy', 'uses' => 'BidangusahaController@destroy']);

    Route::get('/unitkerja', ['as' => 'unitkerja', 'uses' => 'UnitkerjaController@index']);
    Route::get('/unitkerja/fetch', ['as' => 'unitkerja.fetch', 'uses' => 'UnitkerjaController@fetch']);
    Route::post('/unitkerja/store', ['as' => 'unitkerja.store', 'uses' => 'UnitkerjaController@store']);
    Route::get('/unitkerja/{id}/edit', ['as' => 'unitkerja.edit', 'uses' => 'UnitkerjaController@edit']);
    Route::put('/unitkerja/update', ['as' => 'unitkerja.update', 'uses' => 'UnitkerjaController@update']);
    Route::delete('/unitkerja/destroy/{id}', ['as' => 'unitkerja.destroy', 'uses' => 'UnitkerjaController@destroy']);

    Route::get('/company', ['as' => 'company', 'uses' => 'CompanyController@index']);
    Route::get('/company/agent', ['as' => 'company.agent', 'uses' => 'CompanyController@agent']);
    Route::get('/company/create', ['as' => 'company.create', 'uses' => 'CompanyController@create']);
    Route::post('/company/submit', ['as' => 'company.submit', 'uses' => 'CompanyController@submit']);
    Route::get('/company/fetch', ['as' => 'company.fetch', 'uses' => 'CompanyController@fetch']);
    Route::post('/company/store', ['as' => 'company.store', 'uses' => 'CompanyController@store']);
    Route::get('/company/{id}/edit', ['as' => 'company.edit', 'uses' => 'CompanyController@edit']);
    Route::get('/company/{id}/show', ['as' => 'company.show', 'uses' => 'CompanyController@show']);
    Route::get('/company/{id}/ubah', ['as' => 'company.ubah', 'uses' => 'CompanyController@ubah']);
    Route::get('/company/{id}/pengawas', ['as' => 'company.pengawas', 'uses' => 'CompanyController@pengawas']);
    Route::get('/company/{id}/view', ['as' => 'company.view', 'uses' => 'CompanyController@view']);
    Route::put('/company/update', ['as' => 'company.update', 'uses' => 'CompanyController@update']);
    Route::delete('/company/destroy/{id}', ['as' => 'company.destroy', 'uses' => 'CompanyController@destroy']);
    Route::post('/company/pegawai', ['as' => 'company.pegawai', 'uses' => 'CompanyController@pegawai']);
    Route::get('/company/export_excel', ['as' => 'company.export_excel', 'uses' => 'CompanyController@export_excel']);
    Route::get('/company/{id}/anggota', ['as' => 'company.anggota', 'uses' => 'CompanyController@anggota']);
    Route::get('/company/fcomp/{id}', ['as' => 'company.fcomp', 'uses' => 'CompanyController@fcomp']);
    Route::post('/company/ucomp', ['as' => 'company.ucomp', 'uses' => 'CompanyController@ucomp']);

    Route::get('/admin/regulasi', ['as' => 'admin.regulasi', 'uses' => 'RegulasiController@index']);
    Route::get('/admin/regulasi/fetch', ['as' => 'admin.regulasi.fetch', 'uses' => 'RegulasiController@fetch']);
    Route::post('/admin/regulasi/store', ['as' => 'admin.regulasi.store', 'uses' => 'RegulasiController@store']);
    Route::get('/admin/regulasi/{id}/edit', ['as' => 'admin.regulasi.edit', 'uses' => 'RegulasiController@edit']);
    Route::post('/admin/regulasi/update', ['as' => 'admin.regulasi.update', 'uses' => 'RegulasiController@update']);
    Route::delete('/admin/regulasi/destroy/{id}', ['as' => 'admin.regulasi.destroy', 'uses' => 'RegulasiController@destroy']);

    Route::get('/admin/talkshow', ['as' => 'admin.talkshow', 'uses' => 'TalkshowController@index']);
    Route::get('/admin/talkshow/fetch', ['as' => 'admin.talkshow.fetch', 'uses' => 'TalkshowController@fetch']);
    Route::post('/admin/talkshow/store', ['as' => 'admin.talkshow.store', 'uses' => 'TalkshowController@store']);
    Route::get('/admin/talkshow/{id}/edit', ['as' => 'admin.talkshow.edit', 'uses' => 'TalkshowController@edit']);
    Route::put('/admin/talkshow/update', ['as' => 'admin.talkshow.update', 'uses' => 'TalkshowController@update']);
    Route::delete('/admin/talkshow/destroy/{id}', ['as' => 'admin.talkshow.destroy', 'uses' => 'TalkshowController@destroy']);

    Route::get('/admin/manual', ['as' => 'admin.manual', 'uses' => 'ManualController@index']);
    Route::get('/admin/manual/fetch', ['as' => 'admin.manual.fetch', 'uses' => 'ManualController@fetch']);
    Route::post('/admin/manual/store', ['as' => 'admin.manual.store', 'uses' => 'ManualController@store']);
    Route::get('/admin/manual/{id}/edit', ['as' => 'admin.manual.edit', 'uses' => 'ManualController@edit']);
    Route::post('/admin/manual/update', ['as' => 'admin.manual.update', 'uses' => 'ManualController@update']);
    Route::delete('/admin/manual/destroy/{id}', ['as' => 'admin.manual.destroy', 'uses' => 'ManualController@destroy']);

    Route::get('/admin/homepage', ['as' => 'admin.homepage', 'uses' => 'HomepageController@index']);
    Route::get('/admin/homepage/fetch', ['as' => 'admin.homepage.fetch', 'uses' => 'HomepageController@fetch']);
    Route::post('/admin/homepage/store', ['as' => 'admin.homepage.store', 'uses' => 'HomepageController@store']);
    Route::get('/admin/homepage/{id}/edit', ['as' => 'admin.homepage.edit', 'uses' => 'HomepageController@edit']);
    Route::post('/admin/homepage/update', ['as' => 'admin.homepage.update', 'uses' => 'HomepageController@update']);
    Route::delete('/admin/homepage/destroy/{id}', ['as' => 'admin.homepage.destroy', 'uses' => 'HomepageController@destroy']);

    Route::get('/admin/inbox', ['as' => 'admin.inbox', 'uses' => 'InboxController@index']);
    Route::get('/admin/inbox/read/{id}', ['as' => 'admin.inbox.read', 'uses' => 'InboxController@show']);

    Route::get('/admin/pengajuan', ['as' => 'admin.pengajuan', 'uses' => 'PengajuanController@index']);
    Route::get('/admin/pengajuan/create/{step}/{id}', ['as' => 'admin.pengajuan.create', 'uses' => 'PengajuanController@create']);
    Route::post('/admin/pengajuan/store', ['as' => 'admin.pengajuan.store', 'uses' => 'PengajuanController@store']);
    Route::get('/admin/pengajuan/fetch', ['as' => 'admin.pengajuan.fetch', 'uses' => 'PengajuanController@fetch']);
    Route::delete('/admin/pengajuan/destroy/{id}', ['as' => 'admin.pengajuan.destroy', 'uses' => 'PengajuanController@destroy']);

    Route::get('/admin/persetujuan', ['as' => 'admin.persetujuan', 'uses' => 'PersetujuanController@index']);
    Route::get('/admin/persetujuan/fetch', ['as' => 'admin.persetujuan.fetch', 'uses' => 'PersetujuanController@fetch']);

    Route::get('/admin/proses', ['as' => 'admin.proses', 'uses' => 'ProsesController@index']);
    Route::get('/admin/proses/fetch', ['as' => 'admin.proses.fetch', 'uses' => 'ProsesController@fetch']);
    Route::get('/admin/proses/create/{step}/{id}', ['as' => 'admin.proses.create', 'uses' => 'ProsesController@create']);
    Route::post('/admin/proses/store', ['as' => 'admin.proses.store', 'uses' => 'PengajuanController@store']);

    Route::get('/admin/terverifikasi', ['as' => 'admin.terverifikasi', 'uses' => 'TerverifikasiController@index']);
    Route::get('/admin/terverifikasi/fetch', ['as' => 'admin.terverifikasi.fetch', 'uses' => 'TerverifikasiController@fetch']);

    Route::get('/admin/renja', ['as' => 'admin.renja', 'uses' => 'RenjaController@index']);
    Route::get('/admin/renja/event', ['as' => 'admin.renja.event', 'uses' => 'RenjaController@event']);
    Route::post('/admin/renja/store', ['as' => 'admin.renja.store', 'uses' => 'RenjaController@store']);
    Route::post('/admin/renja/address', ['as' => 'admin.renja.address', 'uses' => 'RenjaController@address']);
    Route::get('/admin/renja/{id}/edit', ['as' => 'admin.renja.edit', 'uses' => 'RenjaController@edit']);
    Route::post('/admin/renja/cetak', ['as' => 'admin.renja.cetak', 'uses' => 'RenjaController@cetak']);
    Route::get('/admin/renja/export_excel', ['as' => 'admin.renja.export_excel', 'uses' => 'RenjaController@export_excel']);
    Route::post('/admin/renja/chartbar', ['as' => 'admin.renja.chartbar', 'uses' => 'RenjaController@chartbar']);
    Route::post('/admin/renja/chartpie', ['as' => 'admin.renja.chartpie', 'uses' => 'RenjaController@chartpie']);
    Route::get('/admin/persetujuanrenja', ['as' => 'admin.persetujuanrenja', 'uses' => 'RenjaController@persetujuan']);
    Route::get('/admin/renja/company', ['as' => 'admin.renja.company', 'uses' => 'RenjaController@company']);
    Route::get('/admin/renja/view/{month}/{year}', ['as' => 'admin.renja.view', 'uses' => 'RenjaController@view']);

    Route::get('/admin/sektor', ['as' => 'admin.sektor', 'uses' => 'SektorController@index']);
    Route::get('/admin/sektor/fetch', ['as' => 'admin.sektor.fetch', 'uses' => 'SektorController@fetch']);
    Route::post('/admin/sektor/store', ['as' => 'admin.sektor.store', 'uses' => 'SektorController@store']);
    Route::get('/admin/sektor/{id}/edit', ['as' => 'admin.sektor.edit', 'uses' => 'SektorController@edit']);
    Route::put('/admin/sektor/update', ['as' => 'admin.sektor.update', 'uses' => 'SektorController@update']);
    Route::get('/admin/sektor/cari', ['as' => 'admin.sektor.cari', 'uses' => 'SektorController@cari']);
    Route::delete('/admin/sektor/destroy/{id}', ['as' => 'admin.sektor.destroy', 'uses' => 'SektorController@destroy']);

    Route::get('/admin/templates', ['as' => 'admin.template', 'uses' => 'TemplatesController@index']);
    Route::match(['get', 'post'], '/admin/templates/create', ['as' => 'admin.template.create', 'uses' => 'TemplatesController@create']);

    Route::get('/admin/pjkkk/proses', ['as' => 'admin.pjkkk.proses', 'uses' => 'PjkkkController@proses']);
    Route::get('/admin/pjkkk/fetch', ['as' => 'admin.pjkkk.fetch', 'uses' => 'PjkkkController@fetch']);
    Route::get('/admin/pjkkk/{id}/edit', ['as' => 'admin.pjkkk.edit', 'uses' => 'PjkkkController@edit']);
    Route::get('/admin/pjkkk/{id}/show', ['as' => 'admin.pjkkk.pjkkk.show', 'uses' => 'PjkkkController@show']);
    Route::get('/admin/pjkkk/{id}/ubah', ['as' => 'admin.pjkkk.ubah', 'uses' => 'PjkkkController@ubah']);
    Route::get('/admin/pjkkk/{id}/view', ['as' => 'admin.pjkkk.view', 'uses' => 'PjkkkController@view']);
    Route::post('/admin/pjkkk/submit', ['as' => 'admin.pjkkk.submit', 'uses' => 'PjkkkController@submit']);
    Route::get('/admin/pjkkk/verify', ['as' => 'admin.pjkkk.verify', 'uses' => 'PjkkkController@verify']);

    Route::get('/admin/spt', ['as' => 'admin.spt', 'uses' => 'SptController@index']);
    Route::get('/admin/spt/create', ['as' => 'admin.spt.create', 'uses' => 'SptController@create']);
    Route::get('/admin/spt/cetak', ['as' => 'admin.spt.cetak', 'uses' => 'SptController@cetak']);
    Route::get('/admin/spt/fetch', ['as' => 'admin.spt.fetch', 'uses' => 'SptController@fetch']);
    Route::post('/admin/spt/submit', ['as' => 'admin.spt.submit', 'uses' => 'SptController@submit']);
    Route::get('/admin/spt/{id}/edit', ['as' => 'admin.spt.edit', 'uses' => 'SptController@edit']);
    Route::get('/admin/spt/{id}/view', ['as' => 'admin.spt.view', 'uses' => 'SptController@view']);
    Route::put('/admin/spt/update', ['as' => 'admin.spt.update', 'uses' => 'SptController@update']);
    Route::get('/admin/spt/cari', ['as' => 'admin.spt.cari', 'uses' => 'SptController@cari']);
    Route::delete('/admin/spt/destroy/{id}', ['as' => 'admin.spt.destroy', 'uses' => 'SptController@destroy']);
    Route::get('/admin/spt/{id}/pengawas', ['as' => 'admin.spt.pengawas', 'uses' => 'SptController@pengawas']);
    Route::post('/admin/spt/pegawai', ['as' => 'admin.spt.pegawai', 'uses' => 'SptController@pegawai']);
    Route::match(['post', 'get'], '/admin/spt/template', ['as' => 'admin.spt.template', 'uses' => 'SptController@template']);

    Route::get('/admin/layanan-pengaduan', ['as' => 'admin.layanan.pengaduan', 'uses' => 'PengaduanController@index']);
    Route::get('/admin/layanan-pengaduan/fetch', ['as' => 'admin.layanan.pengaduan.fetch', 'uses' => 'PengaduanController@fetch']);
    Route::get('/admin/layanan-pengaduan/{id}/edit', ['as' => 'admin.layanan.pengaduan.edit', 'uses' => 'PengaduanController@edit']);
    Route::post('/admin/layanan-pengaduan/store', ['as' => 'admin.layanan.pengaduan.store', 'uses' => 'PengaduanController@store']);

    Route::group(['prefix' => 'spt'], function () {
    });

    Route::get('/tembusan', ['as' => 'tembusan', 'uses' => 'TembusanController@index']);
    Route::get('/tembusan/fetch', ['as' => 'tembusan.fetch', 'uses' => 'TembusanController@fetch']);
    Route::post('/tembusan/store', ['as' => 'tembusan.store', 'uses' => 'TembusanController@store']);
    Route::get('/tembusan/{id}/edit', ['as' => 'tembusan.edit', 'uses' => 'TembusanController@edit']);
    Route::put('/tembusan/update', ['as' => 'tembusan.update', 'uses' => 'TembusanController@update']);
    Route::delete('/tembusan/destroy/{id}', ['as' => 'tembusan.destroy', 'uses' => 'TembusanController@destroy']);

    Route::get('/admin/upt', ['as' => 'admin.upt', 'uses' => 'UptController@index']);
    Route::get('/admin/upt/fetch', ['as' => 'admin.upt.fetch', 'uses' => 'UptController@fetch']);
    Route::post('/admin/upt/store', ['as' => 'admin.upt.store', 'uses' => 'UptController@store']);
    Route::get('/admin/upt/{id}/edit', ['as' => 'admin.upt.edit', 'uses' => 'UptController@edit']);
    Route::put('/admin/upt/update', ['as' => 'admin.upt.update', 'uses' => 'UptController@update']);
    Route::delete('/admin/upt/destroy/{id}', ['as' => 'admin.upt.destroy', 'uses' => 'UptController@destroy']);
    Route::get('/admin/upt/{id}/pegawai', ['as' => 'admin.upt.pegawai', 'uses' => 'UptController@pegawai']);
    Route::post('/admin/upt/anggota', ['as' => 'admin.upt.anggota', 'uses' => 'UptController@anggota']);
    Route::get('/admin/upt/{id}/company', ['as' => 'admin.upt.company', 'uses' => 'UptController@company']);
    Route::get('/admin/upt/fcomp/{id}', ['as' => 'admin.upt.fcomp', 'uses' => 'UptController@fcomp']);
    Route::post('/admin/upt/ucomp', ['as' => 'admin.upt.ucomp', 'uses' => 'UptController@ucomp']);

    Route::get('/admin/reporting', ['as' => 'admin.reporting', 'uses' => 'ReportingController@index']);
    Route::get('/admin/reporting/fetch', ['as' => 'admin.reporting.fetch', 'uses' => 'ReportingController@fetch']);
    Route::delete('/admin/reporting/destroy/{id}', ['as' => 'admin.reporting.destroy', 'uses' => 'ReportingController@destroy']);
    Route::post('/admin/reporting/store', ['as' => 'admin.reporting.store', 'uses' => 'ReportingController@store']);

    Route::get('/admin/pengawasan/list', ['as' => 'admin.pengawasan.list', 'uses' => 'Akta\PengawasanController@list']);
    Route::get('/admin/pengawasan/add', ['as' => 'admin.pengawasan.add', 'uses' => 'Akta\PengawasanController@add']);
    Route::post('/admin/pengawasan/store', ['as' => 'admin.pengawasan.store', 'uses' => 'Akta\PengawasanController@store']);

    Route::get('/admin/pengawasan/mesin/list', ['as' => 'admin.pengawasan.mesin.list', 'uses' => 'Akta\PengawasanController@list_mesin']);
    Route::get('/admin/pengawasan/mesin/fetch', ['as' => 'admin.pengawasan.mesin.fetch', 'uses' => 'Akta\PengawasanController@fetch_mesin']);
    Route::get('/admin/pengawasan/mesin/add', ['as' => 'admin.pengawasan.mesin.add', 'uses' => 'Akta\PengawasanController@add_mesin']);
    Route::post('/admin/pengawasan/mesin/store', ['as' => 'admin.pengawasan.mesin.store', 'uses' => 'Akta\PengawasanController@store_mesin']);
    Route::delete('/admin/pengawasan/mesin/destroy/{id}', ['as' => 'admin.pengawasan.mesin.destroy', 'uses' => 'Akta\PengawasanController@destroy_mesin']);
    Route::get('/admin/pengawasan/mesin/{id}/edit', ['as' => 'admin.pengawasan.mesin.edit', 'uses' => 'Akta\PengawasanController@edit_mesin']);
    Route::get('/admin/pengawasan/mesin/{id}/show', ['as' => 'admin.pengawasan.mesin.show', 'uses' => 'Akta\PengawasanController@show_mesin']);

    Route::get('/admin/pengawasan/list-akta', ['as' => 'admin.pengawasan.list-akta', 'uses' => 'Akta\PengawasanController@list_akta']);
    Route::get('/admin/pengawasan/persetujuan/list', ['as' => 'admin.pengawasan.persetujuan.list', 'uses' => 'Akta\PengawasanController@list_persetujuan']);
    Route::get('/admin/pengawasan/persetujuan/{id}/approve-akta', ['as' => 'admin.pengawasan.persetujuan.approve-akta', 'uses' => 'Akta\PengawasanController@approve_akta']);

    Route::delete('/admin/pengawasan/destroy-akta/{id}', ['as' => 'admin.pengawasan.destroy-akta', 'uses' => 'Akta\PengawasanController@destroy_akta']);
    Route::get('/admin/pengawasan/{id}/edit-akta', ['as' => 'admin.pengawasan.edit-akta', 'uses' => 'Akta\PengawasanController@edit_akta']);
    Route::get('/admin/pengawasan/{id}/show-akta', ['as' => 'admin.pengawasan.show-akta', 'uses' => 'Akta\PengawasanController@show_akta']);
    Route::get('/admin/pengawasan/get-company', ['as' => 'admin.pengawasan.company', 'uses' => 'Akta\PengawasanController@combo_company']);
    Route::get('/admin/pengawasan/cetak-akta', ['as' => 'admin.pengawasan.cetak-akta', 'uses' => 'Akta\PengawasanController@cetak_akta']);

    Route::get('/admin/pengawasan/document/list-doc', ['as' => 'admin.document.list-doc', 'uses' => 'Akta\PengawasanController@list_doc']);

    Route::group(['prefix' => 'spt'], function () {
        Route::get('list', 'Spt\ListController@index')->name('spt.list');
        Route::get('list/fetch', 'Spt\ListController@fetch')->name('spt.list.fetch');
        Route::get('list/cetak', 'Spt\ListController@cetak')->name('spt.list.cetak');
        Route::get('list/view/{id}', 'Spt\ListController@view')->name('spt.list.view');
        Route::post('list/desc', 'Spt\ListController@desc')->name('spt.list.desc');
    });

    Route::group(['prefix' => 'pemberitahuan'], function () {
        Route::get('list', 'Pemberitahuan\ListController@index')->name('pemberitahuan.list');
        Route::get('list/fetch', 'Pemberitahuan\ListController@fetch')->name('pemberitahuan.list.fetch');
        Route::get('list/cetak', 'Pemberitahuan\ListController@cetak')->name('pemberitahuan.list.cetak');
        Route::get('list/view/{id}', 'Pemberitahuan\ListController@view')->name('pemberitahuan.list.view');
        Route::post('list/desc', 'Pemberitahuan\ListController@desc')->name('pemberitahuan.list.desc');

        Route::get('template', 'Pemberitahuan\TemplateController@index')->name('pemberitahuan.template.list');
        Route::post('template/store', 'Pemberitahuan\TemplateController@store')->name('pemberitahuan.template.store');
    });

    Route::group(['prefix' => 'banknota'], function () {
        Route::get('jenis', 'Banknota\JenisController@index')->name('banknota.jenis');
        Route::get('jenis/fetch', 'Banknota\JenisController@fetch')->name('banknota.jenis.fetch');
        Route::get('jenis/create', 'Banknota\JenisController@create')->name('banknota.jenis.create');
        Route::post('jenis/store', 'Banknota\JenisController@store')->name('banknota.jenis.store');
        Route::get('jenis/{id}/edit', 'Banknota\JenisController@edit')->name('banknota.jenis.edit');
        Route::delete('jenis/destroy/{id}', 'Banknota\JenisController@destroy')->name('banknota.jenis.destroy');

        Route::get('listbn', 'Banknota\ListbnController@index')->name('banknota.listbn');
        Route::get('listbn/fetch', 'Banknota\ListbnController@fetch')->name('banknota.listbn.fetch');
        Route::get('listbn/create', 'Banknota\ListbnController@create')->name('banknota.listbn.create');
        Route::post('listbn/store', 'Banknota\ListbnController@store')->name('banknota.listbn.store');
        Route::post('listbn/desc', 'Banknota\ListbnController@desc')->name('banknota.listbn.desc');
        Route::post('listbn/send', 'Banknota\ListbnController@send')->name('banknota.listbn.send');
        Route::get('listbn/{slug}/edit', 'Banknota\ListbnController@edit')->name('banknota.listbn.edit');
        Route::get('listbn/{id}/spt', 'Banknota\ListbnController@spt')->name('banknota.listbn.spt');
        Route::get('listbn/preview/{slug}', 'Banknota\ListbnController@preview')->name('banknota.listbn.preview');
        Route::get('listbn/view/{slug}', 'Banknota\ListbnController@view')->name('banknota.listbn.view');
        Route::delete('listbn/destroy/{id}', 'Banknota\ListbnController@destroy')->name('banknota.listbn.destroy');
        Route::get('listbn/cetak', 'Banknota\ListbnController@cetak')->name('banknota.listbn.cetak');

        Route::get('listbnn', 'Banknota\ListbnnController@index')->name('banknota.listbnn');
        Route::get('listbnn/fetch', 'Banknota\ListbnnController@fetch')->name('banknota.listbnn.fetch');
        Route::get('listbnn/create', 'Banknota\ListbnnController@create')->name('banknota.listbnn.create');
        Route::post('listbnn/store', 'Banknota\ListbnnController@store')->name('banknota.listbnn.store');
        Route::post('listbnn/desc', 'Banknota\ListbnnController@desc')->name('banknota.listbnn.desc');
        Route::post('listbnn/send', 'Banknota\ListbnnController@send')->name('banknota.listbnn.send');
        Route::get('listbnn/{slug}/edit', 'Banknota\ListbnnController@edit')->name('banknota.listbnn.edit');
        Route::get('listbnn/{id}/spt', 'Banknota\ListbnnController@spt')->name('banknota.listbnn.spt');
        Route::get('listbnn/preview/{slug}', 'Banknota\ListbnnController@preview')->name('banknota.listbnn.preview');
        Route::get('listbnn/view/{slug}', 'Banknota\ListbnnController@view')->name('banknota.listbnn.view');
        Route::delete('listbnn/destroy/{id}', 'Banknota\ListbnnController@destroy')->name('banknota.listbnn.destroy');
        Route::get('listbnn/cetak', 'Banknota\ListbnnController@cetak')->name('banknota.listbnn.cetak');

        Route::get('approval', 'Banknota\ApprovalController@index')->name('banknota.approval');
        Route::get('approval/fetch', 'Banknota\ApprovalController@fetch')->name('banknota.approval.fetch');
        Route::get('approval/create', 'Banknota\ApprovalController@create')->name('banknota.approval.create');
        Route::post('approval/store', 'Banknota\ApprovalController@store')->name('banknota.approval.store');
        Route::post('approval/desc', 'Banknota\ApprovalController@desc')->name('banknota.approval.desc');
        Route::post('approval/send', 'Banknota\ApprovalController@send')->name('banknota.approval.send');
        Route::get('approval/{slug}/edit', 'Banknota\ApprovalController@edit')->name('banknota.approval.edit');
        Route::get('approval/{id}/spt', 'Banknota\ApprovalController@spt')->name('banknota.approval.spt');
        Route::get('approval/preview/{slug}', 'Banknota\ApprovalController@preview')->name('banknota.approval.preview');
        Route::get('approval/view/{slug}', 'Banknota\ApprovalController@view')->name('banknota.approval.view');
        Route::delete('approval/destroy/{id}', 'Banknota\ApprovalController@destroy')->name('banknota.approval.destroy');
        Route::get('approval/cetak', 'Banknota\ApprovalController@cetak')->name('banknota.approval.cetak');

        Route::get('configs', 'Banknota\ConfigsController@index')->name('banknota.configs');
        Route::post('configs/store', 'Banknota\ConfigsController@store')->name('banknota.configs.store');
    });

    Route::get('qr-code-g', function () {
        \QrCode::size(500)
            ->format('png')
            ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));

        return view('qrCode');
    });
});
