@inject('layoutHelper', 'App\Helpers\LayoutHelper')

@extends('adminlte::master')


@if($layoutHelper->isLayoutTopnavEnabled())
@php( $def_container_class = 'container' )
@else
@php( $def_container_class = 'container-fluid' )
@endif

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
<div class="wrapper" id="element">

    {{-- Top Navbar --}}
    @if($layoutHelper->isLayoutTopnavEnabled())
    @include('adminlte::partials.navbar.navbar-layout-topnav')
    @else
    @include('adminlte::partials.navbar.navbar')
    @endif

    {{-- Left Main Sidebar --}}
    @if(!$layoutHelper->isLayoutTopnavEnabled())
    @include('adminlte::partials.sidebar.left-sidebar')
    @endif

    {{-- Content Wrapper --}}
    <div class="content-wrapper {{ config('adminlte.classes_content_wrapper') ?? '' }}">

        {{-- Content Header --}}
        <div class="content-header">
            <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                @yield('content_header')
            </div>
        </div>

        {{-- Main Content --}}
        <div class="content">
            <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
                @yield('content')
            </div>
        </div>

    </div>

    {{-- Footer --}}
    @hasSection('footer')
    @include('adminlte::partials.footer.footer')
    @endif

    {{-- Right Control Sidebar --}}
    @if(config('adminlte.right_sidebar'))
    @include('adminlte::partials.sidebar.right-sidebar')
    @endif

</div>
@stop

@section('adminlte_js')
@stack('js')
@yield('js')
<script>
    $(function() {
        $('a.active').parent().closest('.has-treeview').addClass('menu-open');
        $('a.active').parent().closest('.has-treeview').children("a").addClass('active');
        $.ajax({
            url: "/home/notifcount",
            method: 'GET',
            success: function(result) {
                if (result.success) {
                    if (result.data.notif_all > 0) {
                        $('span.badge-count-notif').show();
                        $('span.badge-count-notif').text(result.data.notif_all);
                        $('span.dropdown-header-notif').text(result.data.notif_all + ' Notifications');
                        $('a.href-pjk3-proses').html('<i class="fas fa-shield-alt mr-2"></i> ' + result.data.pjkkk_proses + ' PJK3 Proses');
                        if (result.data.pjkkk_proses == 0) {
                            $('a.href-pjk3-proses').hide();
                        }
                        $('a.href-suket-online-pengajuan').html('<i class="fas fa-file-alt  mr-2"></i> ' + result.data.suket_online + ' Suket Online');
                        if (result.data.suket_online == 0) {
                            $('a.href-suket-online-pengajuan').hide();
                        }
                        $('a.href-suket-online-proses').html('<i class="fas fa-file-alt  mr-2"></i> ' + result.data.suket_proses + ' Suket Online');
                        if (result.data.suket_proses == 0) {
                            $('a.href-suket-online-proses').hide();
                        }
                        $('a.href-spt-proses-notif').html('<i class="fas fa-file-alt  mr-2"></i> ' + result.data.spt_open + ' SPT');
                        if (result.data.spt_open == 0) {
                            $('a.href-spt-proses-notif').hide();
                        }
                        $('a.href-renja-upt-notif').html('<i class="fas fa-file-alt  mr-2"></i> ' + result.data.renja_upt + ' Renja');
                        if (result.data.renja_upt == 0) {
                            $('a.href-renja-upt-notif').hide();
                        }

                        $('a.href-layanan-pengaduan').html('<i class="fas fa-file-alt  mr-2"></i> ' + result.data.pengaduan + ' Layanan Pengaduan');
                        if (result.data.pengaduan == 0) {
                            $('a.href-layanan-pengaduan').hide();
                        }

                        setInterval(blink_text, 1000);
                    } else {
                        $('span.badge-count-notif').hide();
                        $('span.dropdown-header-notif').text('0 Notifications');
                        $('a.href-pjk3-proses').hide();
                        $('a.href-suket-online-pengajuan').hide();
                        $('a.href-suket-online-proses').hide();
                        $('a.href-renja-upt-online-proses').hide();
                        $('a.href-spt-proses-notif').hide();
                        $('a.href-layanan-pengaduan').hide();
                    }
                }
            },
            error: function(err) {

            }
        });

        $('a.href-fullscreen').click(function(e) {
            if (IsFullScreenCurrently())
                GoOutFullscreen();
            else
                GoInFullscreen($("#element").get(0));
        });

        $(document).on('fullscreenchange webkitfullscreenchange mozfullscreenchange MSFullscreenChange', function() {
            if (IsFullScreenCurrently()) {
                $('a.href-fullscreen').html('<i class="fas fa-compress-arrows-alt"></i>');
            } else {
                $('a.href-fullscreen').html('<i class="fas fa-expand-arrows-alt"></i>');
            }
        });

        function blink_text() {
            $('.badge-count-notif').fadeOut(500);
            $('.badge-count-notif').fadeIn(500);
        }

    });

    /* Get into full screen */
    function GoInFullscreen(element) {
        if (element.requestFullscreen)
            element.requestFullscreen();
        else if (element.mozRequestFullScreen)
            element.mozRequestFullScreen();
        else if (element.webkitRequestFullscreen)
            element.webkitRequestFullscreen();
        else if (element.msRequestFullscreen)
            element.msRequestFullscreen();
    }

    /* Get out of full screen */
    function GoOutFullscreen() {
        if (document.exitFullscreen)
            document.exitFullscreen();
        else if (document.mozCancelFullScreen)
            document.mozCancelFullScreen();
        else if (document.webkitExitFullscreen)
            document.webkitExitFullscreen();
        else if (document.msExitFullscreen)
            document.msExitFullscreen();
    }

    /* Is currently in full screen or not */
    function IsFullScreenCurrently() {
        var full_screen_element = document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement || null;

        // If no element is in full-screen
        if (full_screen_element === null)
            return false;
        else
            return true;
    }
</script>
@stop