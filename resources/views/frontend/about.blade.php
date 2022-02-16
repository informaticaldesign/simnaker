@extends('frontend.page')
@section('title', 'About - Open Data')
@section('content')
<main class="site-main">
    <section class="about">
        <div class="container">
            <div class="side-bar">
                <div class="side-bar-item">
                    <h2>Langsung ke</h2>
                    <a href="#data-sharing"><div class="page-anchor-link">Prinsip Berbagi Data</div></a>
                    <a href="#help-us-improve"><div class="page-anchor-link">Bantu Kami Meningkatkan</div></a>
                </div>
            </div>
            <div class="main-content">
                <div class="main-section">
                    <div>
                        <h2>Opendata.bantenprov.go.id</h2>
                        <p>
                            Opendata.bantenprov.go.id pertama kali diluncurkan pada tahun 2021 sebagai portal satu pintu pemerintah untuk kumpulan data yang tersedia untuk umum dari 70 badan publik. Hingga saat ini, lebih dari 100 aplikasi telah dibuat menggunakan data terbuka pemerintah.
                        </p>

                        <p>
                            Opendata.bantenprov.go.id baru, sekarang dalam versi beta publik, lebih dari sekadar tempat penyimpanan data. Ini bertujuan untuk membuat data pemerintah relevan dan dapat dipahami oleh publik, melalui penggunaan bagan dan artikel secara aktif..
                        </p>

                        <p>
                            Kami secara aktif mengerjakan fitur dan peningkatan baru. Kami ingin mengundang umpan balik dari anggota masyarakat tentang bagaimana kami dapat lebih meningkatkan Opendata.bantenprov.go.id baru dan memberikan pengalaman pengguna yang lebih baik untuk semua.
                        </p>

                        <p>
                            Tujuan dari portal ini meliputi:
                        </p>

                        <ol>
                            <li>Menyediakan akses satu atap ke data pemerintah yang tersedia untuk umum</li>
                            <li>Komunikasikan data dan analisis pemerintah melalui visualisasi dan artikel</li>
                            <li>Ciptakan nilai dengan mendorong pengembangan aplikasi</li>
                            <li>Memfasilitasi analisis dan penelitian</li>
                        </ol>
                    </div>
                </div>
                <div class="main-section" id="data-sharing">
                    <div>
                        ​<h2>Prinsip Berbagi Data</h2>

                        <p>
                            Prinsip berbagi data berikut bertujuan untuk memandu upaya Data Terbuka instansi Pemerintah.
                        </p>
                        <ul>
                            <li>Data harus dapat diakses dengan mudah</li>
                            <li>Data harus tersedia untuk kreasi bersama</li>
                            <li>Data harus dirilis tepat waktu</li>
                            <li>Data harus dibagikan dalam format yang dapat dibaca mesin</li>
                            <li>Data harus sekasar mungkin</li>
                        </ul>
                        <p></p>
                    </div>
                </div>
                <div class="main-section" id="help-us-improve">
                    <div>
                        <h2>Bantu Kami Meningkatkan</h2>
                        <p>
                            Punya umpan balik tentang situs beta atau tidak dapat menemukan kumpulan data yang Anda cari??
                        </p>

                        <p>Kirim email kepada kami di <a href="mailto:feedback@opendata.bantenprov.go.id">feedback@opendata.bantenprov.go.id</a>.</p>
                    </div>
                </div>
            </div>
        </div></section> 

</main>
@stop
@section('css')
<link href="{{ asset('css/frontend/_bundle_terms.min.css') }}" rel="stylesheet" type="text/css"/>
@stop

@section('js')
@stop
