@extends('adminlte::page')

@section('title', 'Bank Nota 1')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Bank Nota 1</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('banknota/jenis') }}">Bank Nota 1</a></li>
            <li class="breadcrumb-item active">Buat Bank Nota 1</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="invoice p-3 mb-3" style="width: 29.7cm;">
            <table style="margin-top: 15px; margin-left: auto;margin-right: auto;" cellspacing='0'>
                <thead>
                    <tr style="height:10px !important;">
                        <td style="text-align: right; " rowspan="5" width='100'>
                            <img style="height: auto; width: 90px;" src="{{ asset('images/logo-banten.png')}}" />
                        </td>
                        <td style="text-align: center; font-size: 14pt; font-weight: bold;">PEMERINTAH PROVINSI BANTEN </td>
                    </tr>
                    <tr style="height:10px !important;">
                        <td style="text-align: center; font-size: 16pt; font-weight: bold;">DINAS TENAGA KERJA DAN TRANSMIGRASI</td>
                    </tr>
                    <tr style="height:10px !important;">
                        <td style="text-align: center; font-size: 9pt; font-weight: bold;">KAWASAN PUSAT PEMERINTAHAN PROVINSI BANTEN (KP3B)</td>
                    </tr>
                    <tr style="height:10px !important;">
                        <td style="text-align: center; font-size: 9pt">Jl. Syekh KH. Nawawi Al-Bantani Kota Serang-Provinsi Banten</td>
                    </tr>
                    <tr style="height:10px !important;">
                        <td style="text-align: center; font-size: 9pt">Telp. (0254) 267111 – Fax. (0254) 267112</td>
                    </tr>
                </thead>
            </table>
            <div style="border-bottom: double; margin-top: 10px"></div>
            <table width=100% class="banknota">
                <tr>
                    <td style="text-align:right;">{{ $banknota->kota }}, {{ \Carbon\Carbon::parse($banknota->tanggal)->locale('id')->isoFormat('D MMMM Y') }}</td>
                </tr>
            </table>
            <table width=100% class="banknota">
                <tr>
                    <td style="text-align:left;">Nomor</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:left;">{{ $banknota->document_no }}</td>
                    <td style="text-align:left;">Yth</td>
                </tr>
                <tr>
                    <td style="text-align:left;">Sifat</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:left;">Rahasia</td>
                    <td style="text-align:left;">Sdr. Pimpinan Perusahaan</td>
                </tr>
                <tr>
                    <td style="text-align:left;">Lampiran</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:left;">-</td>
                    <td style="text-align:left;"><b>{{ $banknota->company_name }}</b></td>
                </tr>
                <tr>
                    <td style="text-align:left;">Perihal</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:left;">{{ $banknota->perihal }}</td>
                    <td style="text-align:left;">di {{ $banknota->kota }}</td>
                </tr>
            </table>
            {!! $banknota->description !!}
            <table>
                @php ($i = 1)
                @foreach($jenis as $key => $val)
                <tr>
                    <td style="text-align:left;vertical-align:top;padding-right: 10; width:30px;"><b>{{ $i }}.</b> </td>
                    <td style="text-align:left;vertical-align:top;" class="desc-banknota-{{ $val->id }}">{!! $val->description !!}</td>
                </tr>
                @php ($i++)
                @endforeach
            </table>
            {!! $banknota->description_footer !!}
            <table width=100% class="banknota" style="margin-top:20px;">
                <tr>
                    <td style="text-align:center;">Mengetahui</td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:left;"></td>
                    <td style="text-align:left;"></td>
                </tr>
                <tr>
                    <td style="text-align:center;">Kepala Dinas Tenaga Kerja dan</td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:center;">Pengawas Ketenagakerjaan</td>
                </tr>
                <tr>
                    <td style="text-align:center;">Transmigrasi Provinsi Banten</td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:left;"></td>
                    <td style="text-align:center;">Yang Memeriksa</td>
                </tr>
                <tr>
                    <td style="text-align:left; height: 50px;"></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:left;"></td>
                    <td style="text-align:left;"></td>
                </tr>
                <tr>
                    <td style="text-align:center;"><b style="text-decoration: underline;">{!! $banknota->kadis_name !!}</b></td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:left;"></td>
                    <td style="text-align:center;"><b style="text-decoration: underline;">{!! $banknota->pengawas_name !!}</b></td>
                </tr>
                <tr>
                    <td style="text-align:center;">Nip {!! $banknota->kadis_nip !!}</td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:left;"></td>
                    <td style="text-align:center;">Nip {!! $banknota->pengawas_nip !!}</td>
                </tr>
            </table>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-center pb-2">
            <a href="{{ url('/banknota/listbn') }}" class="btn btn-default float-right"><i class="fa fa-close"></i>&nbsp;Tutup</a>&nbsp;
            <a href="javascript:void(0)" data-toggle="tooltip" data-id="{{ $banknota->uuid }}" data-original-title="Cetak" class="action-cetak btn btn-info"><i class="fas fa-print"></i>&nbsp;Cetak</a>
        </div>
    </div>
</div>


<div class="modal fade" id="ajaxAddModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bank Nota</h4>
            </div>
            <div class="modal-body">
                <iframe id="frame" src="" width="100%" height="500"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop


@section('js')
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.action-cetak', function () {
            $(this).html('<i class="fa fa-spinner fa-spin"></i> Wait...');
            $(this).prop('disabled', true);
            var _button = $(this);
            var module_id = $(this).data("id");
            $.ajax({
                url: "{{ route('banknota.listbn.cetak') }}",
                type: "get",
                data: {id: module_id},
                dataType: "json",
                success: function (result) {
                    if (result.status == 'success') {
                        _button.html('<i class="fas fa-file-pdf"></i> Cetak');
                        _button.prop('disabled', false);
                        $('#ajaxAddModel').modal('show');
                        $("#frame").attr("src", result.data.url);
                    }
                },
                error: function (xhr, Status, err) {
                    $("Terjadi error : " + Status);
                }
            });
        });

    });
</script>
@stop