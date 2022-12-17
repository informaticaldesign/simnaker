<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo">
            <a href="{{ url('/') }}"></a>
        </h1>
        <!-- Uncomment below if you prefer to use an image logo -->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link {{ request()->route()->uri=='/'?'active':'' }}" href="{{ url('/') }}"><i class="bx bxs-home bx-sm"></i>&nbsp;BERANDA</a></li>
                @if( request()->route()->uri == 'layanan' )
                <li><a class="nav-link {{ request()->route()->uri=='regulasi'?'active':'' }}" href="{{ url('admin/pengajuan/create/1/0') }}"><i class='bx bxs-pencil bx-sm'></i>&nbsp; AJUKAN PERMOHONAN</a></li>
                @else
                <li><a class="nav-link {{ request()->route()->uri=='regulasi'?'active':'' }}" href="{{ url('/regulasi') }}"><i class='bx bxs-news bx-sm'></i>&nbsp; REGULASI K3</a></li>
                <li><a class="nav-link {{ request()->route()->uri=='talkshow'?'active':'' }}" href="{{ url('/talkshow') }}"><i class='bx bxl-youtube bx-sm'></i>&nbsp; TALKSHOW</a></li>
                <li><a class="nav-link {{ request()->route()->uri=='layanan'?'active':'' }}" href="{{ url('/layanan') }}"><i class='bx bxs-cog bx-sm'></i>&nbsp; LAYANAN K3</a></li>
                <li><a class="nav-link {{ request()->route()->uri=='akses'?'active':'' }}" href="{{ url('/akses') }}"><i class='bx bxs-building bx-sm'></i>&nbsp; AKSES</a></li>
                @endif
                @if(Auth::user())
                <li><a class="nav-link {{ request()->route()->uri=='admin'?'active':'' }}" href="{{ url('/admin') }}"><i class='bx bxs-user-circle bx-sm'></i>&nbsp; Hi {{ Auth::user()->name }}</a> </li>
                @endif
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->