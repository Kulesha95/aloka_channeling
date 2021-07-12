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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Aloka E - Channeling And Pharmacy Management System',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Aloka</b> Channeling',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => '<b>Aloka</b> Channeling',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-dark',
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => true,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => 'nav-child-indent nav-flat',
    'classes_topnav' => 'navbar-dark navbar-dark',
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => true,
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        [
            'text'    => '',
            'icon'    => 'fas fa-fw fa-fw fa-bell',
            'topnav_right' => true,
            'url'  => '#',
        ],
        ['header' => ''],
        ['header' => 'general'],
        [
            'text' => 'dashboard',
            'url'  => 'dashboard',
            'icon' => 'fas fa-fw fa-tachometer-alt',
        ],
        [
            'text' => 'channelTypes',
            'url'  => 'channelTypes',
            'icon' => 'fas fa-fw fa-heartbeat',
            'can' => 'manage-channel-types'
        ],
        [
            'text' => 'doctors',
            'url'  => 'doctors',
            'icon' => 'fas fa-fw fa-user-md',
            'can' => 'manage-doctors'
        ],
        [
            'text' => 'schedules',
            'url'  => 'schedules',
            'icon' => 'fas fa-fw fa-calendar-alt',
            'can' => 'manage-schedules'
        ],
        [
            'text' => 'userTypes',
            'url'  => 'userTypes',
            'icon' => 'fas fa-fw fa-user-shield',
            'can' => 'manage-user-types'
        ],
        [
            'text' => 'users',
            'url'  => 'users',
            'icon' => 'fas fa-fw fa-user',
            'can' => 'manage-users'
        ],
        [
            'text' => 'patients',
            'url'  => 'patients',
            'icon' => 'fas fa-fw fa-user-injured',
            'can' => 'manage-patients'
        ],
        [
            'text' => 'channelingCalendar',
            'url'  => 'calendar',
            'icon' => 'fas fa-fw fa-calendar-alt',
            'can' => 'view-channeling-calendar'
        ],
        [
            'text' => 'appointments',
            'url'  => 'appointments',
            'icon' => 'fas fa-fw fa-calendar-plus',
            'can' => 'manage-appointments'
        ],
        [
            'text' => 'channelings',
            'url'  => 'channelings',
            'icon' => 'fas fa-fw fa-heart',
            'can' => 'manage-channelings'
        ],
        [
            'text' => 'itemTypes',
            'url'  => 'itemTypes',
            'icon' => 'fas fa-fw fa-tag',
            'can' => 'manage-item-types'
        ],
        [
            'text' => 'genericNames',
            'url'  => 'genericNames',
            'icon' => 'fas fa-fw fa-bookmark',
            'can' => 'manage-generic-names'
        ],
        [
            'text' => 'dosageUnits',
            'url'  => 'dosageUnits',
            'icon' => 'fas fa-fw fa-copyright',
            'can' => 'manage-dosage-units'
        ],
        [
            'text' => 'items',
            'url'  => 'items',
            'icon' => 'fas fa-fw fa-pills',
            'can' => 'manage-items'
        ],
        [
            'text' => 'prescriptions',
            'url'  => 'prescriptions',
            'icon' => 'fas fa-fw fa-file-prescription',
            'can' => 'manage-prescriptions'
        ],
        [
            'text' => 'payments',
            'url'  => 'payments',
            'icon' => 'fas fa-fw fa-hand-holding-usd',
            'can' => 'manage-payments'
        ],
        [
            'text' => 'explorationTypes',
            'url'  => 'explorationTypes',
            'icon' => 'fas fa-fw fa-thermometer',
            'can' => 'manage-exploration-types'
        ],
        [
            'text' => 'suppliers',
            'url'  => 'suppliers',
            'icon' => 'fas fa-fw fa-truck',
            'can' => 'manage-suppliers'
        ],
        [
            'text' => 'purchaseOrders',
            'url'  => 'purchaseOrders',
            'icon' => 'fas fa-fw fa-shopping-cart',
            'can' => 'manage-purchase-orders'
        ],
        [
            'text' => 'goodReceives',
            'url'  => 'goodReceives',
            'icon' => 'fas fa-fw fa-truck-loading',
            'can' => 'manage-goods-receives'
        ],
        [
            'text' => 'salesReturns',
            'url'  => 'salesReturns',
            'icon' => 'fas fa-fw fa-undo-alt',
            'can' => 'manage-sales-returns'
        ],
        [
            'text' => 'purchaseReturns',
            'url'  => 'purchaseReturns',
            'icon' => 'fas fa-fw fa-undo-alt',
            'can' => 'manage-purchase-returns'
        ],
        [
            'text' => 'supplierPayments',
            'url'  => 'supplierPayments',
            'icon' => 'fas fa-fw fa-truck-loading',
            'can' => 'manage-supplier-payments'
        ],
        [
            'text' => 'doctorPayments',
            'url'  => 'doctorPayments',
            'icon' => 'fas fa-fw fa-user-md',
            'can' => 'manage-doctor-payments'
        ],        
        [
            'text' => 'batches',
            'url'  => 'batches',
            'icon' => 'fas fa-fw fa-boxes',
            'can' => 'manage-batch-prices'
        ],        
        [
            'text' => 'disposals',
            'url'  => 'disposals',
            'icon' => 'fas fa-fw fa-recycle',
            'can' => 'manage-disposals'
        ],        
        [
            'text' => 'backups',
            'url'  => 'backups',
            'icon' => 'fas fa-fw fa-database',
            'can' => 'manage-backups'
        ],        
        [
            'header' => 'reports',
            'can' => 'generate-reports'
        ],
        [
            'text' => 'profitAndLossReport',
            'url'  => 'reports/profitAndLossReport',
            'icon' => 'fas fa-fw fa-chart-line',
            'can' => 'generate-profit-and-loss-report'
        ],  
        [
            'text' => 'deficitItemsReport',
            'url'  => 'reports/deficitItemsReport',
            'icon' => 'fas fa-fw fa-box-open',
            'can' => 'generate-deficit-items-report'
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'plugins' => [
        'ApexCharts' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.jsdelivr.net/npm/apexcharts',
                ],
            ]
        ],
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
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
        'FullCalendar' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//unpkg.com/tooltip.js/dist/umd/tooltip.min.js',
                ],
            ],
        ],
        'moment' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js',
                ],
            ],
        ],
        'summernote' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js',
                ]
            ],
        ],
        'tippy' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//unpkg.com/@popperjs/core@2/dist/umd/popper.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/@fullcalendar/rrule@5.5.0/main.global.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//unpkg.com/tippy.js@6/themes/light.css',
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
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    */

    'livewire' => false,
];