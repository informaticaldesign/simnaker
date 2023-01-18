@extends('adminlte::page')
@section('title', 'Akta Pengawasan' )
@section('content_header')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
@stop
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Akta Pengawasan</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <a href="{{ url('/admin') }}" class="btn btn-default"> <i class="fas fa-times"></i> Tutup</a>&nbsp;
            <button type="button" class="btn btn-danger btn-save btn-action-submit"><i class="far fa-save"></i> Simpan</button>&nbsp;
        </ol>
    </div>
</div>
@stop

@section('content')
{{ Form::open(array('route' => 'admin.pengawasan.store','method'=>'post', 'enctype'=>"multipart/form-data", 'id'=>'form-input')) }}
<input type="hidden" name="id">
<?php
$widthLabel = 'col-sm-3 col-form-label';
$widthField = 'col-sm-6';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline">
            <div class="card-body">
                <div class="form-group row text-center">
                    <div class="col-md-12 text-center">
                        <h3 class="text-center">AKTE PENGAWASAN KETENAGAKERJAAN</h3>
                        <h5 class="text-center">Nomor : 560/XX-DTKT/BINWAS/{{ date('m') }}/{{ date('Y') }}</h5>
                    </div>
                </div>
                <hr>
                <div class="form-group row mt-1">
                    <label for="company_id" class="{{ $widthLabel }}">Nama Perusahaan <span class="text-danger">*</span></label>
                    <div class="{{ $widthField }}">
                        {{ Form::select('company_id',[],old('company_id'),['class'=>'form-control','id'=>'company_id']); }}
                        <div class="invalid-feedback invalid-company_id"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="{{ $widthLabel }}">Alamat</label>
                    <div class="{{ $widthField }}">
                        {{ Form::textarea('address', old('address'),['class'=>'form-control','rows'=>3,'id'=>'address']); }}
                        <div class="invalid-feedback invalid-address"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_pemilik" class="{{ $widthLabel }}">Nama Pemilik <span class="text-danger">*</span></label>
                    <div class="{{ $widthField }}">
                        {{ Form::text('nama_pemilik',old('nama_pemilik'),['class'=>'form-control','id'=>'nama_pemilik']); }}
                        <div class="invalid-feedback invalid-nama_pemilik"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="add_pemilik" class="{{ $widthLabel }}">Alamat</label>
                    <div class="{{ $widthField }}">
                        {{ Form::textarea('add_pemilik', old('add_pemilik'),['class'=>'form-control','rows'=>3,'id'=>'add_pemilik']); }}
                        <div class="invalid-feedback invalid-add_pemilik"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_pengurus" class="{{ $widthLabel }}">Nama Pengurus <span class="text-danger">*</span></label>
                    <div class="{{ $widthField }}">
                        {{ Form::text('nama_pengurus',old('nama_pengurus'),['class'=>'form-control','id'=>'nama_pengurus']); }}
                        <div class="invalid-feedback invalid-nama_pengurus"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="add_pengurus" class="{{ $widthLabel }}">Alamat</label>
                    <div class="{{ $widthField }}">
                        {{ Form::textarea('add_pengurus', old('add_pengurus'),['class'=>'form-control','rows'=>3,'id'=>'add_pengurus']); }}
                        <div class="invalid-feedback invalid-add_pengurus"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_usaha" class="{{ $widthLabel }}">Jenis Usaha <span class="text-danger">*</span></label>
                    <div class="col-sm-3">
                        {{ Form::text('jenis_usaha',old('jenis_usaha'),['class'=>'form-control','id'=>'jenis_usaha']); }}
                        <div class="invalid-feedback invalid-jenis_usaha"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl_berdiri" class="{{ $widthLabel }}">Tanggal Mendirikan, Membangun Kembali atau Memindahkan <span class="text-danger">*</span></label>
                    <div class="col-sm-2">
                        {{ Form::date('tgl_berdiri',old('tgl_berdiri'),['class'=>'form-control','id'=>'tgl_berdiri']); }}
                        <div class="invalid-feedback invalid-tgl_berdiri"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_akte" class="{{ $widthLabel }}">Nomor Akte Pendirian Perusahaan <span class="text-danger">*</span></label>
                    <div class="{{ $widthField }}">
                        {{ Form::text('no_akte',old('no_akte'),['class'=>'form-control','id'=>'no_akte']); }}
                        <div class="invalid-feedback invalid-no_akte"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jml_cabang" class="{{ $widthLabel }}">Cabang di Seluruh Indonesia <span class="text-danger">*</span></label>
                    <div class="col-sm-2">
                        {{ Form::number('jml_cabang',old('jml_cabang'),['class'=>'form-control','id'=>'jml_cabang']); }}
                        <div class="invalid-feedback invalid-jml_cabang"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jml_cabang" class="{{ $widthLabel }}">Data Tenaga Kerja <span class="text-danger">*</span></label>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th rowspan="3" class="align-middle">Jumlah & Status Upah</th>
                                    <th colspan="4" class="text-center">W.N.I</th>
                                    <th colspan="4" class="text-center">W.N.A</th>
                                    <th colspan="2" class="text-center align-middle">Jumlah</th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">L</th>
                                    <th colspan="2" class="text-center">P</th>
                                    <th colspan="2" class="text-center">L</th>
                                    <th colspan="2" class="text-center">P</th>
                                    <th rowspan="2" class="text-center align-middle">L</th>
                                    <th rowspan="2" class="text-center align-middle">P</th>
                                </tr>
                                <tr>
                                    <th class="text-center">&#8805; 18th</th>
                                    <th class="text-center">&#60; 18th</th>
                                    <th class="text-center">&#8805; 18th</th>
                                    <th class="text-center">&#60; 18th</th>
                                    <th class="text-center">&#8805; 18th</th>
                                    <th class="text-center">&#60; 18th</th>
                                    <th class="text-center">&#8805; 18th</th>
                                    <th class="text-center">&#60; 18th</th>
                                </tr>
                                <tr>
                                    <td class="align-middle">Bulanan</td>
                                    <td>
                                        {{ Form::number('wni_l_bul_a',old('wni_l_bul_a'),['class'=>'form-control bulanan_l','id'=>'wni_l_bul_a']); }}
                                        <div class="invalid-feedback invalid-wni_l_bul_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_l_bul_d',old('wni_l_bul_d'),['class'=>'form-control bulanan_l','id'=>'wni_l_bul_d']); }}
                                        <div class="invalid-feedback invalid-wni_l_bul_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_p_bul_a',old('wni_p_bul_a'),['class'=>'form-control bulanan_p','id'=>'wni_p_bul_a']); }}
                                        <div class="invalid-feedback invalid-wni_p_bul_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_p_bul_d',old('wni_p_bul_d'),['class'=>'form-control bulanan_p','id'=>'wni_p_bul_d']); }}
                                        <div class="invalid-feedback invalid-wni_p_bul_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_l_bul_a',old('wna_l_bul_a'),['class'=>'form-control bulanan_l','id'=>'wna_l_bul_a']); }}
                                        <div class="invalid-feedback invalid-wna_l_bul_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_l_bul_d',old('wna_l_bul_d'),['class'=>'form-control bulanan_l','id'=>'wna_l_bul_d']); }}
                                        <div class="invalid-feedback invalid-wna_l_bul_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_p_bul_a',old('wna_p_bul_a'),['class'=>'form-control bulanan_p','id'=>'wna_p_bul_a']); }}
                                        <div class="invalid-feedback invalid-wna_p_bul_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_p_bul_d',old('wna_p_bul_d'),['class'=>'form-control bulanan_p','id'=>'wna_p_bul_d']); }}
                                        <div class="invalid-feedback invalid-wna_p_bul_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('jml_bul_l',old('jml_bul_l'),['class'=>'form-control-plaintext','id'=>'jml_bul_l']); }}
                                    </td>
                                    <td>
                                        {{ Form::number('jml_bul_p',old('jml_bul_p'),['class'=>'form-control-plaintext','id'=>'jml_bul_p']); }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Borongan</td>
                                    <td>
                                        {{ Form::number('wni_l_bor_a',old('wni_l_bor_a'),['class'=>'form-control borongan_l','id'=>'wni_l_bor_a']); }}
                                        <div class="invalid-feedback invalid-wni_l_bor_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_l_bor_d',old('wni_l_bor_d'),['class'=>'form-control borongan_l','id'=>'wni_l_bor_d']); }}
                                        <div class="invalid-feedback invalid-wni_l_bor_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_p_bor_a',old('wni_p_bor_a'),['class'=>'form-control borongan_p','id'=>'wni_p_bor_a']); }}
                                        <div class="invalid-feedback invalid-wni_p_bor_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_p_bor_d',old('wni_p_bor_d'),['class'=>'form-control borongan_p','id'=>'wni_p_bor_d']); }}
                                        <div class="invalid-feedback invalid-wni_p_bor_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_l_bor_a',old('wna_l_bor_a'),['class'=>'form-control borongan_l','id'=>'wna_l_bor_a']); }}
                                        <div class="invalid-feedback invalid-wna_l_bor_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_l_bor_d',old('wna_l_bor_d'),['class'=>'form-control borongan_l','id'=>'wna_l_bor_d']); }}
                                        <div class="invalid-feedback invalid-wna_l_bor_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_p_bor_a',old('wna_p_bor_a'),['class'=>'form-control borongan_p','id'=>'wna_p_bor_a']); }}
                                        <div class="invalid-feedback invalid-wna_p_bor_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_p_bor_d',old('wna_p_bor_d'),['class'=>'form-control borongan_p','id'=>'wna_p_bor_d']); }}
                                        <div class="invalid-feedback invalid-wna_p_bor_d"></div>
                                    </td>
                                    <td class="text-right">
                                        {{ Form::number('jml_bor_l',old('jml_bor_l'),['class'=>'form-control-plaintext','id'=>'jml_bor_l']); }}
                                    </td>
                                    <td class="text-right">
                                        {{ Form::number('jml_bor_p',old('jml_bor_p'),['class'=>'form-control-plaintext','id'=>'jml_bor_p']); }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Harian Lepas</td>
                                    <td>
                                        {{ Form::number('wni_l_hl_a',old('wni_l_hl_a'),['class'=>'form-control harian_l','id'=>'wni_l_hl_a']); }}
                                        <div class="invalid-feedback invalid-wni_l_hl_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_l_hl_d',old('wni_l_hl_d'),['class'=>'form-control harian_l','id'=>'wni_l_hl_d']); }}
                                        <div class="invalid-feedback invalid-wni_l_hl_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_p_hl_a',old('wni_p_hl_a'),['class'=>'form-control harian_p','id'=>'wni_p_hl_a']); }}
                                        <div class="invalid-feedback invalid-wni_p_hl_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_p_hl_d',old('wni_p_hl_d'),['class'=>'form-control harian_p','id'=>'wni_p_hl_d']); }}
                                        <div class="invalid-feedback invalid-wni_p_hl_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_l_hl_a',old('wna_l_hl_a'),['class'=>'form-control harian_l','id'=>'wna_l_hl_a']); }}
                                        <div class="invalid-feedback invalid-wna_l_hl_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_l_hl_d',old('wna_l_hl_d'),['class'=>'form-control harian_l','id'=>'wna_l_hl_d']); }}
                                        <div class="invalid-feedback invalid-wna_l_hl_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_p_hl_a',old('wna_p_hl_a'),['class'=>'form-control harian_p','id'=>'wna_p_hl_a']); }}
                                        <div class="invalid-feedback invalid-wna_p_hl_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_p_hl_d',old('wna_p_hl_d'),['class'=>'form-control harian_p','id'=>'wna_p_hl_d']); }}
                                        <div class="invalid-feedback invalid-wna_p_hl_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('jml_hl_l',old('jml_hl_l'),['class'=>'form-control-plaintext','id'=>'jml_hl_l']); }}
                                    </td>
                                    <td>
                                        {{ Form::number('jml_hl_p',old('jml_hl_p'),['class'=>'form-control-plaintext','id'=>'jml_hl_p']); }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle" colspan="12">Status Hubungan Kerja</th>
                                </tr>
                                <tr>
                                    <td class="align-middle">PKWT</td>
                                    <td>
                                        {{ Form::number('wni_l_pkwt_a',old('wni_l_pkwt_a'),['class'=>'form-control pkwt_l','id'=>'wni_l_pkwt_a']); }}
                                        <div class="invalid-feedback invalid-wni_l_pkwt_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_l_pkwt_d',old('wni_l_pkwt_d'),['class'=>'form-control pkwt_l','id'=>'wni_l_pkwt_d']); }}
                                        <div class="invalid-feedback invalid-wni_l_pkwt_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_p_pkwt_a',old('wni_p_pkwt_a'),['class'=>'form-control pkwt_p','id'=>'wni_p_pkwt_a']); }}
                                        <div class="invalid-feedback invalid-wni_p_pkwt_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_p_pkwt_d',old('wni_p_pkwt_d'),['class'=>'form-control pkwt_p','id'=>'wni_p_pkwt_d']); }}
                                        <div class="invalid-feedback invalid-wni_p_pkwt_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_l_pkwt_a',old('wna_l_pkwt_a'),['class'=>'form-control pkwt_l','id'=>'wna_l_pkwt_a']); }}
                                        <div class="invalid-feedback invalid-wna_l_pkwt_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_l_pkwt_d',old('wna_l_pkwt_d'),['class'=>'form-control pkwt_l','id'=>'wna_l_pkwt_d']); }}
                                        <div class="invalid-feedback invalid-wna_l_pkwt_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_p_pkwt_a',old('wna_p_pkwt_a'),['class'=>'form-control pkwt_p','id'=>'wna_p_pkwt_a']); }}
                                        <div class="invalid-feedback invalid-wna_p_pkwt_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_p_pkwt_d',old('wna_p_pkwt_d'),['class'=>'form-control pkwt_p','id'=>'wna_p_pkwt_d']); }}
                                        <div class="invalid-feedback invalid-wna_p_pkwt_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('jml_pkwt_l',old('jml_pkwt_l'),['class'=>'form-control-plaintext','id'=>'jml_pkwt_l']); }}
                                    </td>
                                    <td>
                                        {{ Form::number('jml_pkwt_p',old('jml_pkwt_p'),['class'=>'form-control-plaintext','id'=>'jml_pkwt_p']); }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">PKWTT</td>
                                    <td>
                                        {{ Form::number('wni_l_pkwtt_a',old('wni_l_pkwtt_a'),['class'=>'form-control pkwtt_l','id'=>'wni_l_pkwtt_a']); }}
                                        <div class="invalid-feedback invalid-wni_l_pkwtt_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_l_pkwtt_d',old('wni_l_pkwtt_d'),['class'=>'form-control pkwtt_l','id'=>'wni_l_pkwtt_d']); }}
                                        <div class="invalid-feedback invalid-wni_l_pkwtt_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_p_pkwtt_a',old('wni_p_pkwtt_a'),['class'=>'form-control pkwtt_p','id'=>'wni_p_pkwtt_a']); }}
                                        <div class="invalid-feedback invalid-wni_p_pkwtt_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wni_p_pkwtt_d',old('wni_p_pkwtt_d'),['class'=>'form-control pkwtt_p','id'=>'wni_p_pkwtt_d']); }}
                                        <div class="invalid-feedback invalid-wni_p_pkwtt_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_l_pkwtt_a',old('wna_l_pkwtt_a'),['class'=>'form-control pkwtt_l','id'=>'wna_l_pkwtt_a']); }}
                                        <div class="invalid-feedback invalid-wna_l_pkwtt_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_l_pkwtt_d',old('wna_l_pkwtt_d'),['class'=>'form-control pkwtt_l','id'=>'wna_l_pkwtt_d']); }}
                                        <div class="invalid-feedback invalid-wna_l_pkwtt_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_p_pkwtt_a',old('wna_p_pkwtt_a'),['class'=>'form-control pkwtt_p','id'=>'wna_p_pkwtt_a']); }}
                                        <div class="invalid-feedback invalid-wna_p_pkwtt_a"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('wna_p_pkwtt_d',old('wna_p_pkwtt_d'),['class'=>'form-control pkwtt_p','id'=>'wna_p_pkwtt_d']); }}
                                        <div class="invalid-feedback invalid-wna_p_pkwtt_d"></div>
                                    </td>
                                    <td>
                                        {{ Form::number('jml_pkwtt_l',old('jml_pkwtt_l'),['class'=>'form-control-plaintext','id'=>'jml_pkwtt_l']); }}
                                    </td>
                                    <td>
                                        {{ Form::number('jml_pkwtt_p',old('jml_pkwtt_p'),['class'=>'form-control-plaintext','id'=>'jml_pkwtt_p']); }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gaya_gerak" class="{{ $widthLabel }}">Gaya Gerak <span class="text-danger">*</span></label>
                    <div class="{{ $widthField }}">
                        {{ Form::text('gaya_gerak',old('gaya_gerak'),['class'=>'form-control','id'=>'gaya_gerak']); }}
                        <div class="invalid-feedback invalid-gaya_gerak"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jns_pesawat_tenaga" class="{{ $widthLabel }}">Jenis Pesawat Tenaga <span class="text-danger">*</span></label>
                    <div class="{{ $widthField }}">
                        {{ Form::text('jns_pesawat_tenaga',old('jns_pesawat_tenaga'),['class'=>'form-control','id'=>'jns_pesawat_tenaga']); }}
                        <div class="invalid-feedback invalid-jns_pesawat_tenaga"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jml_pesawat_tenaga" class="{{ $widthLabel }}">Jumlah Pesawat Tenaga <span class="text-danger">*</span></label>
                    <div class="col-md-2">
                        {{ Form::number('jml_pesawat_tenaga',old('jml_pesawat_tenaga'),['class'=>'form-control','id'=>'jml_pesawat_tenaga']); }}
                        <div class="invalid-feedback invalid-jml_pesawat_tenaga"></div>
                    </div>
                    <div class="col-md-1">
                        <p>TK/KVA</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bahan_baku" class="{{ $widthLabel }}">Bahan Baku & Bahan Penolong yang dianggap berbahaya <span class="text-danger">*</span></label>
                    <div class="{{ $widthField }}">
                        {{ Form::text('bahan_baku',old('bahan_baku'),['class'=>'form-control','id'=>'bahan_baku']); }}
                        <div class="invalid-feedback invalid-bahan_baku"></div>
                    </div>
                </div>
                <hr>
                <div class="form-group row text-right">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-success btn-save btn-action-submit"><i class="far fa-save"></i> Simpan</button>&nbsp;
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    {{ Form::close() }}
    @stop

    @section('css')
    <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
    <style>
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #ffffff;
            background: #2196f3;
            padding: 3px 7px;
            border-radius: 3px;
        }

        .bootstrap-tagsinput {
            width: 100%;
        }
    </style>
    @stop

    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var $eventSelect = $("#company_id");
            $eventSelect.select2({
                placeholder: 'Pilih perusahaan',
                minimumInputLength: 0,
                ajax: {
                    url: "{{ url('admin/pengawasan/get-company') }}",
                    dataType: 'json',
                    delay: 150,
                    data: function(params) {
                        console.log(1232)
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        };
                    },
                    cache: true
                },
            });

            $eventSelect.on("select2:selecting", function(e) {
                $('#address').val(e.params.args.data.address);
            });

            $('button.btn-action-submit').click(function(e) {
                $('button.btn-save').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
                $('button.btn-save').prop('disabled', true);
                event.preventDefault();
                $('.form-control').removeClass('is-invalid');
                $('.invalid-tgl_pemeriksaan').text('');

                var _form = $("#form-input");
                var formData = new FormData(_form[0]);
                $.ajax({
                    url: "{{ route('admin.pengawasan.store') }}",
                    type: "POST",
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-bottom-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            toastr.success('Pengajuan Akta Pengawasan Berhasil', 'Success');
                        } else {
                            toastr.error('Update LHP Pengawasan Gagal', 'Error');
                        }
                        $('button.btn-save').html('<i class="far fa-save"></i> Update');
                        $('button.btn-save').prop('disabled', false);
                    },
                    error: function(err) {
                        $.each(err.responseJSON.message, function(i, error) {
                            var _field = $(document).find('[name="' + i + '"]');
                            _field.addClass('is-invalid');
                            var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                            el.css('display', 'block');
                            el.text(error[0]);
                        });
                        $('button.btn-save').html('<i class="far fa-save"></i> Save');
                        $('button.btn-save').prop('disabled', false);
                    }
                });
            });

            $("#tgl_pemeriksaan").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            });

            $(".bulanan_l").on('change', function() {
                var sum = 0;
                $('.bulanan_l').each(function() {
                    var tal = parseInt($(this).val());
                    if (isNaN(tal)) {
                        tal = 0;
                    }
                    sum += tal;
                });
                $('#jml_bul_l').val(sum);
            });

            $(".bulanan_p").on('change', function() {
                var sum = 0;
                $('.bulanan_p').each(function() {
                    var tal = parseInt($(this).val());
                    if (isNaN(tal)) {
                        tal = 0;
                    }
                    sum += tal;
                });
                $('#jml_bul_p').val(sum);
            });

            $(".borongan_l").on('change', function() {
                var sum = 0;
                $('.borongan_l').each(function() {
                    var tal = parseInt($(this).val());
                    if (isNaN(tal)) {
                        tal = 0;
                    }
                    sum += tal;
                });
                $('#jml_bor_l').val(sum);
            });

            $(".borongan_p").on('change', function() {
                var sum = 0;
                $('.borongan_p').each(function() {
                    var tal = parseInt($(this).val());
                    if (isNaN(tal)) {
                        tal = 0;
                    }
                    sum += tal;
                });
                $('#jml_bor_p').val(sum);
            });

            $(".harian_l").on('change', function() {
                var sum = 0;
                $('.harian_l').each(function() {
                    var tal = parseInt($(this).val());
                    if (isNaN(tal)) {
                        tal = 0;
                    }
                    sum += tal;
                });
                $('#jml_hl_l').val(sum);
            });

            $(".harian_p").on('change', function() {
                var sum = 0;
                $('.harian_p').each(function() {
                    var tal = parseInt($(this).val());
                    if (isNaN(tal)) {
                        tal = 0;
                    }
                    sum += tal;
                });
                $('#jml_hl_p').val(sum);
            });

            $(".pkwt_l").on('change', function() {
                var sum = 0;
                $('.pkwt_l').each(function() {
                    var tal = parseInt($(this).val());
                    if (isNaN(tal)) {
                        tal = 0;
                    }
                    sum += tal;
                });
                $('#jml_pkwt_l').val(sum);
            });

            $(".pkwt_p").on('change', function() {
                var sum = 0;
                $('.pkwt_p').each(function() {
                    var tal = parseInt($(this).val());
                    if (isNaN(tal)) {
                        tal = 0;
                    }
                    sum += tal;
                });
                $('#jml_pkwt_p').val(sum);
            });

            $(".pkwtt_l").on('change', function() {
                var sum = 0;
                $('.pkwtt_l').each(function() {
                    var tal = parseInt($(this).val());
                    if (isNaN(tal)) {
                        tal = 0;
                    }
                    sum += tal;
                });
                $('#jml_pkwtt_l').val(sum);
            });

            $(".pkwtt_p").on('change', function() {
                var sum = 0;
                $('.pkwtt_p').each(function() {
                    var tal = parseInt($(this).val());
                    if (isNaN(tal)) {
                        tal = 0;
                    }
                    sum += tal;
                });
                $('#jml_pkwtt_p').val(sum);
            });

        });
    </script>
    @stop