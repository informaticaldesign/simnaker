@extends('frontend.page')
@section('title_prefix', 'Regulasi K3 - ')
@section('title', 'Simnaker')
@section('content')
<!-- ======= Hero Section ======= -->
<section id="services" class="services" style="padding: 20px 0 !important;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/regulasi"><i class='bx bxs-chevron-left-circle'></i>&nbsp;Kembali</a></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm-8">
                <table class="table table-striped">
                    <thead class="text-white" style="background-color:#1e375b;">
                        <tr>
                            <th scope="col">META</th>
                            <th scope="col">KETERANGAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tipe Dokumen</td>
                            <td>{{ $regulasi->type }}</td>
                        </tr>
                        <tr>
                            <td>Judul Peraturan</td>
                            <td>{{ $regulasi->judul }}</td>
                        </tr>
                        <tr>
                            <td>Tajuk Entri Utama</td>
                            <td>{{ $regulasi->tajuk }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Peraturan</td>
                            <td>{{ $regulasi->nomor }}</td>
                        </tr>
                        <tr>
                            <td>Tahun Peraturan</td>
                            <td>{{ $regulasi->tahun }}</td>
                        </tr>
                        <tr>
                            <td>Jenis/Bentuk Peraturan</td>
                            <td>{{ $regulasi->jenis }}</td>
                        </tr>
                        <tr>
                            <td>Singkatan Bentuk Peraturan</td>
                            <td>{{ $regulasi->singkatan }}</td>
                        </tr>
                        <tr>
                            <td>Tempat Penetapan</td>
                            <td>{{ $regulasi->tmp_netap }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Penetapan</td>
                            <td>{{ Carbon\Carbon::createFromTimestamp($regulasi->tgl_netap)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengundangan</td>
                            <td>{{ $regulasi->tgl_undang }}</td>
                        </tr>
                        <tr>
                            <td>Sumber</td>
                            <td>{{ $regulasi->sumber }}</td>
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td>{{ $regulasi->lokasi }}</td>
                        </tr>
                        <tr>
                            <td>Bidang Hukum</td>
                            <td>{{ $regulasi->bid_hukum }}</td>
                        </tr>
                        <tr>
                            <td>Bahasa</td>
                            <td>{{ $regulasi->bahasa }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td> @if( $regulasi->status=='on' ) Active @endif</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4">
                <div class="embed-responsive embed-responsive-16by1">
                    <iframe class="embed-responsive-item" src="{{ url($regulasi->attachment) }}" frameborder="0" style="height:70%;width:100%;top:0px;left:0px;right:0px;" height="70%" width="100%"></iframe>
                </div>
                <div class="d-grid gap-2 col-12 mx-auto mt-2">
                    <a href="{{ url($regulasi->attachment) }}" class="button btn" download style=" color: #fff; background-color: #1e375b; border-color: #1e375b;"><i class="fa fa-download"></i>&nbsp;Dwonload Peraturan</a>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
<style>
    #bizland {
        width: 100%;
        height: 75vh;
        background-size: cover;
        position: relative;
    }
</style>
@stop
@section('js')
<script>

</script>
@stop