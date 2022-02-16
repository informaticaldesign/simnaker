@extends('adminlte::page')

@section('title', 'Inbox')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Kotak Masuk</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Inbox</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-3">
        <a href="{{ url('admin/inbox') }}" class="btn btn-primary btn-block mb-3" style="border: 1px solid #1e375a !important; background-color: #1e375a !important;">Kembali ke Kotak Masuk</a>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Folders</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item active">
                        <a href="#" class="nav-link">
                            <i class="fas fa-inbox"></i> Kotak Masuk
                            <span class="badge bg-primary float-right">1</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-envelope"></i> Terkirim
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-file-alt"></i> Konsep
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-filter"></i> Junk
                            <span class="badge bg-warning float-right">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-trash-alt"></i> Sampah
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Labels</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-circle text-danger"></i> Important</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-circle text-warning"></i> Promotions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="far fa-circle text-primary"></i> Social</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card card-primary card-outline" style="border-top: 3px solid #1e375a !important;">
            <div class="card-header">
                <h3 class="card-title">Read Mail</h3>

                <div class="card-tools">
                    <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="mailbox-read-info">
                    <h5>Kelengkapan data</h5>
                    <h6>Dari: admin.simnaker@bantenprov.go.id
                        <span class="mailbox-read-time float-right">15 Jan. 2022 11:03 PM</span></h6>
                </div>
                <!-- /.mailbox-read-info -->
                <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm" data-container="body" title="Hapus">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm" data-container="body" title="Balas">
                            <i class="fas fa-reply"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm" data-container="body" title="Teruskan">
                            <i class="fas fa-share"></i>
                        </button>
                    </div>
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm" title="Cetak">
                        <i class="fas fa-print"></i>
                    </button>
                </div>
                <!-- /.mailbox-controls -->
                <div class="mailbox-read-message">
                    <p>Hello PT Propan Raya Tbk,</p>

                    <p>Proses pengajuan Nomor Berkas yang anda ajukan belum sesuai, harap dilengkapi untuk nanti akan dilakukan verifikasi ulang. Terima Kasih.
                        PAA/005/SYNERGY/2021</p>

                    <p>Apabila anda ada pertanyaan, silahkan klik pada layanan bantuan yang tertera pada kanan bawah melalui Chat WhatsApp, petugas kami akan merespon secara cepat.
                    </p>

                    <p>Terimakasih,<br>Admin</p>
                </div>
                <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Hapus</button>
                <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Cetak</button>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
@stop

@section('js')
@stop