<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Title
      |--------------------------------------------------------------------------
      |
      | Here you can change the default title of your admin panel.
      |
      | For detailed instructions you can look the title section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
      |
     */

    'title' => 'Simnaker',
    'title_prefix' => '',
    'title_postfix' => '-Simnaker',
    /*
      |--------------------------------------------------------------------------
      | Favicon
      |--------------------------------------------------------------------------
      |
      | Here you can activate the favicon.
      |
      | For detailed instructions you can look the favicon section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
      |
     */
    'use_ico_only' => true,
    'use_full_favicon' => true,
    /*
      |--------------------------------------------------------------------------
      | Logo
      |--------------------------------------------------------------------------
      |
      | Here you can change the logo of your admin panel.
      |
      | For detailed instructions you can look the logo section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
      |
     */
    'logo' => '',
    'logo_admin' => 'SIMNAKER',
    'logo_img' => 'bizland/img/logo-login-simnaker.png',
    'logo_img_admin' => 'images/frontend/opendata-white.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Simnaker',
    /*
      |--------------------------------------------------------------------------
      | User Menu
      |--------------------------------------------------------------------------
      |
      | Here you can activate and change the user menu.
      |
      | For detailed instructions you can look the user menu section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
      |
     */
    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,
    /*
      |--------------------------------------------------------------------------
      | Layout
      |--------------------------------------------------------------------------
      |
      | Here we change the layout of your admin panel.
      |
      | For detailed instructions you can look the layout section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
      |
     */
    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    /*
      |--------------------------------------------------------------------------
      | Authentication Views Classes
      |--------------------------------------------------------------------------
      |
      | Here you can change the look and behavior of the authentication views.
      |
      | For detailed instructions you can look the auth classes section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
      |
     */
    'classes_auth_card' => '',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-secondary',
    /*
      |--------------------------------------------------------------------------
      | Admin Panel Classes
      |--------------------------------------------------------------------------
      |
      | Here you can change the look and behavior of the admin panel.
      |
      | For detailed instructions you can look the admin panel classes here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
      |
     */
    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'elevation-4 sidebar-dark-primary',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',
    /*
      |--------------------------------------------------------------------------
      | Sidebar
      |--------------------------------------------------------------------------
      |
      | Here we can modify the sidebar of the admin panel.
      |
      | For detailed instructions you can look the sidebar section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
      |
     */
    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,
    /*
      |--------------------------------------------------------------------------
      | Control Sidebar (Right Sidebar)
      |--------------------------------------------------------------------------
      |
      | Here we can modify the right sidebar aka control sidebar of the admin panel.
      |
      | For detailed instructions you can look the right sidebar section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/7.-Layout-and-Styling-Configuration
      |
     */
    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',
    /*
      |--------------------------------------------------------------------------
      | URLs
      |--------------------------------------------------------------------------
      |
      | Here we can modify the url settings of the admin panel.
      |
      | For detailed instructions you can look the urls section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/6.-Basic-Configuration
      |
     */
    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    /*
      |--------------------------------------------------------------------------
      | Laravel Mix
      |--------------------------------------------------------------------------
      |
      | Here we can enable the Laravel Mix option for the admin panel.
      |
      | For detailed instructions you can look the laravel mix section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
      |
     */
    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',
    /*
      |--------------------------------------------------------------------------
      | Menu Items
      |--------------------------------------------------------------------------
      |
      | Here we can modify the sidebar/top navigation of the admin panel.
      |
      | For detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
      |
     */
    'menu' => [
        [
            'text' => 'Settings',
            'icon' => 'fas fa-fw fa-cogs',
            'submenu' => [
                [
                    'text' => 'Roles',
                    'url' => 'menu',
                    'active' => ['menu']
                ],
                [
                    'text' => 'Users',
                    'route' => 'users',
                ],
                [
                    'text' => 'Modules',
                    'url' => 'modules',
                ],
                [
                    'text' => 'Menus',
                    'url' => 'menus',
                ],
            ]
        ],
    ],
    /*
      |--------------------------------------------------------------------------
      | Menu Filters
      |--------------------------------------------------------------------------
      |
      | Here we can modify the menu filters of the admin panel.
      |
      | For detailed instructions you can look the menu filters section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration
      |
     */
    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],
    /*
      |--------------------------------------------------------------------------
      | Plugins Initialization
      |--------------------------------------------------------------------------
      |
      | Here we can modify the plugins used inside the admin panel.
      |
      | For detailed instructions you can look the plugins section here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
      |
     */
    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/select2/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '/vendor/select2/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'SweetAlert' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@10',
                ],
            ],
        ],
    ],
    /*
      |--------------------------------------------------------------------------
      | Livewire
      |--------------------------------------------------------------------------
      |
      | Here we can enable the Livewire support.
      |
      | For detailed instructions you can look the livewire here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/9.-Other-Configuration
     */
    'livewire' => false,
];
