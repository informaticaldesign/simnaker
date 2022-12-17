<nav class="{{ ConfigsHelper::getByKey('navbar_variants') }}" style="background-color: #1e375b;">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{ url('/') }}" role="button">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="far fa-bell"></i>
                <span class="badge badge-danger navbar-badge badge-count-notif" style="display: none">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <span class="dropdown-item dropdown-header dropdown-header-notif">0 Notifications</span>
                <div class="dropdown-divider divider-pjk3-proses"></div>
                <a href="{{ route('admin.pjkkk.proses') }}" class="dropdown-item href-pjk3-proses">
                    <i class="fas fa-shield-alt mr-2"></i> 0 PJK3 Proses
                </a>
                <a href="{{ route('admin.pengajuan') }}" class="dropdown-item href-suket-online-pengajuan">
                    <i class="fas fa-file-alt  mr-2"></i> 0 Suket Online
                </a>
                <a href="{{ route('admin.proses') }}" class="dropdown-item href-suket-online-proses">
                    <i class="fas fa-file-alt  mr-2"></i> 0 Suket Online
                </a>
                <a href="{{ route('admin.spt') }}" class="dropdown-item href-spt-proses-notif">
                    <i class="fas fa-file-alt  mr-2"></i> 0 SPT
                </a>
                <a href="{{ route('admin.persetujuanrenja') }}" class="dropdown-item href-renja-upt-notif">
                    <i class="fas fa-file-alt  mr-2"></i> 0 Renja
                </a>
                <a href="{{ route('admin.layanan.pengaduan') }}" class="dropdown-item href-layanan-pengaduan">
                    <i class="fas fa-file-alt  mr-2"></i> 0 Layanan Pengaduan
                </a>
                <div class="dropdown-divider"></div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link href-fullscreen" data-value="0" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        @if(Auth::user())
        @if(config('adminlte.usermenu_enabled'))
        @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
        @else
        @include('adminlte::partials.navbar.menu-item-logout-link')
        @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if(config('adminlte.right_sidebar'))
        @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>
</nav>