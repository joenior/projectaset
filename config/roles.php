<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Package Connection
    |--------------------------------------------------------------------------
    |
    | You can set a different database connection for this package. It will set
    | new connection for models Roles and Permission. When this option is null,
    | it will connect to the main database, which is set up in database.php
    |
    */

    'connection'            => env('Roles_DATABASE_CONNECTION', null),
    'RolesTable'            => env('Roles_Roles_DATABASE_TABLE', 'Roles'),
    'RolesUserTable'         => env('Roles_Roles_USER_DATABASE_TABLE', 'Roles_user'),
    'permissionsTable'      => env('Roles_PERMISSIONS_DATABASE_TABLE', 'permissions'),
    'permissionsRolesTable'  => env('Roles_PERMISSION_Roles_DATABASE_TABLE', 'permission_Roles'),
    'permissionsUserTable'  => env('Roles_PERMISSION_USER_DATABASE_TABLE', 'permission_user'),

    /*
    |--------------------------------------------------------------------------
    | GUI routes custom prefix
    |--------------------------------------------------------------------------
    |
    | Here you can add custom prefix to web routes accessing the GUI CRUD
    | interface.
    |
    */

    'GUIRoutesPrefix'           => env('Roles_GUI_ROUTES_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Slug Separator
    |--------------------------------------------------------------------------
    |
    | Here you can change the slug separator. This is very important in matter
    | of magic method __call() and also a `Slugable` trait. The default value
    | is a dot.
    |
    */

    'separator' => env('Roles_DEFAULT_SEPARATOR', '.'),

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | If you want, you can replace default models from this package by models
    | you created. Have a look at `jeremykenedy\LaravelRoles\Models\Roles` model and
    | `jeremykenedy\LaravelRoles\Models\Permission` model.
    |
    */

    'models' => [
        'Roles'          => env('Roles_DEFAULT_Roles_MODEL', jeremykenedy\LaravelRoles\Models\Roles::class),
        'permission'    => env('Roles_DEFAULT_PERMISSION_MODEL', jeremykenedy\LaravelRoles\Models\Permission::class),
        'defaultUser'   => env('Roles_DEFAULT_USER_MODEL', config('auth.providers.users.model')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Inheritance
    |--------------------------------------------------------------------------
    |
    | By default, the plugin is configured so that all Roles inherit all
    | permissions applied to Roles defined at a lower level than the Roles in
    | question. If this is not desired, setting the below to false will disable
    | this inheritance
    |
    */

    'inheritance' => env('Roles_INHERITANCE', true),

    /*
    |--------------------------------------------------------------------------
    | Roles, Permissions and Allowed "Pretend"
    |--------------------------------------------------------------------------
    |
    | You can pretend or simulate package behavior no matter what is in your
    | database. It is really useful when you are testing you application.
    | Set up what will methods hasRoles(), hasPermission() and allowed() return.
    |
    */

    'pretend' => [
        'enabled' => false,
        'options' => [
            'hasRoles'       => true,
            'hasPermission' => true,
            'allowed'       => true,
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Default Migrations
    |--------------------------------------------------------------------------
    |
    | These are the default package migrations. If you publish the migrations
    | to your project, then this is not necessary and should be disabled. This
    | will enable our default migrations.
    |
    */

    'defaultMigrations' => [
        'enabled'        => env('Roles_MIGRATION_DEFAULT_ENABLED', false),
    ],
    /*
    |--------------------------------------------------------------------------
    | Default Seeds
    |--------------------------------------------------------------------------
    |
    | These are the default package seeds. You can seed the package built
    | in seeds without having to seed them. These seed directly from
    | the package. These are not the published seeds.
    |
    */

    'defaultSeeds' => [
        'PermissionsTableSeeder'        => env('Roles_SEED_DEFAULT_PERMISSIONS', true),
        'RolesTableSeeder'              => env('Roles_SEED_DEFAULT_Roles', true),
        'ConnectRelationshipsSeeder'    => env('Roles_SEED_DEFAULT_RELATIONSHIPS', true),
        'UsersTableSeeder'              => env('Roles_SEED_DEFAULT_USERS', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Roles GUI Settings
    |--------------------------------------------------------------------------
    |
    | This is the GUI for Laravel Roles to be able to CRUD them
    | easily and fast. This is optional and is not needed
    | for your application.
    |
    */

    // Enable Optional Roles Gui
    'RolesGuiEnabled'               => env('Roles_GUI_ENABLED', false),

    // Enable `auth` middleware
    'RolesGuiAuthEnabled'           => env('Roles_GUI_AUTH_ENABLED', true),

    // Enable Roles GUI middleware
    'RolesGuiMiddlewareEnabled'     => env('Roles_GUI_MIDDLEWARE_ENABLED', true),

    // Optional Roles GUI Middleware
    'RolesGuiMiddleware'            => env('Roles_GUI_MIDDLEWARE', 'Roles:admin'),

    // User Permissions or Roles needed to create a new Roles
    'RolesGuiCreateNewRolesMiddlewareType'   => env('Roles_GUI_CREATE_Roles_MIDDLEWARE_TYPE', 'Roles'), //permissions or Roles
    'RolesGuiCreateNewRolesMiddleware'       => env('Roles_GUI_CREATE_Roles_MIDDLEWARE', 'admin'), // admin, XXX. ... or perms.XXX

    // User Permissions or Roles needed to create a new permission
    'RolesGuiCreateNewPermissionMiddlewareType'  => env('Roles_GUI_CREATE_PERMISSION_MIDDLEWARE_TYPE', 'Roles'), //permissions or Roles
    'RolesGuiCreateNewPermissionsMiddleware'     => env('Roles_GUI_CREATE_PERMISSION_MIDDLEWARE', 'admin'), // admin, XXX. ... or perms.XXX

    // The parent blade file
    'bladeExtended'                 => env('Roles_GUI_BLADE_EXTENDED', 'layouts.app'),

    // Blade Extension Placement
    'bladePlacement'                => env('Roles_GUI_BLADE_PLACEMENT', 'yield'),
    'bladePlacementCss'             => env('Roles_GUI_BLADE_PLACEMENT_CSS', 'inline_template_linked_css'),
    'bladePlacementJs'              => env('Roles_GUI_BLADE_PLACEMENT_JS', 'inline_footer_scripts'),

    // Titles placement extend
    'titleExtended'                 => env('Roles_GUI_TITLE_EXTENDED', 'template_title'),

    // Switch Between bootstrap 3 `panel` and bootstrap 4 `card` classes
    'bootstapVersion'               => env('Roles_GUI_BOOTSTRAP_VERSION', '4'),

    // Additional Card classes for styling -
    // See: https://getbootstrap.com/docs/4.0/components/card/#background-and-color
    // Example classes: 'text-white bg-primary mb-3'
    'bootstrapCardClasses'          => env('Roles_GUI_CARD_CLASSES', ''),

    // Bootstrap Tooltips
    'tooltipsEnabled'               => env('Roles_GUI_TOOLTIPS_ENABLED', true),

    // jQuery
    'enablejQueryCDN'               => env('Roles_GUI_JQUERY_CDN_ENABLED', true),
    'JQueryCDN'                     => env('Roles_GUI_JQUERY_CDN_URL', 'https://code.jquery.com/jquery-3.3.1.min.js'),

    // Selectize JS
    'enableSelectizeJsCDN'          => env('Roles_GUI_SELECTIZEJS_CDN_ENABLED', true),
    'SelectizeJsCDN'                => env('Roles_GUI_SELECTIZEJS_CDN_URL', 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js'),
    'enableSelectizeJs'             => env('Roles_GUI_SELECTIZEJS_ENABLED', true),
    'enableSelectizeJsCssCDN'       => env('Roles_GUI_SELECTIZEJS_CSS_CDN_ENABLED', true),
    'SelectizeJsCssCDN'             => env('Roles_GUI_SELECTIZEJS_CSS_CDN_URL', 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.min.css'),

    // Font Awesome
    'enableFontAwesomeCDN'          => env('Roles_GUI_FONT_AWESOME_CDN_ENABLED', true),
    'fontAwesomeCDN'                => env('Roles_GUI_FONT_AWESOME_CDN_URL', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'),

    // Flash Messaging
    'builtInFlashMessagesEnabled'   => env('Roles_GUI_FLASH_MESSAGES_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Laravel Roles API Settings
    |--------------------------------------------------------------------------
    |
    | This is the API for Laravel Roles to be able to CRUD them
    | easily and fast via an API. This is optional and is
    | not needed for your application.
    |
    */
    'RolesApiEnabled'               => env('Roles_API_ENABLED', false),

    // Enable `auth` middleware
    'RolesAPIAuthEnabled'           => env('Roles_API_AUTH_ENABLED', true),

    // Enable Roles API middleware
    'RolesAPIMiddlewareEnabled'     => env('Roles_API_MIDDLEWARE_ENABLED', true),

    // Optional Roles API Middleware
    'RolesAPIMiddleware'            => env('Roles_API_MIDDLEWARE', 'Roles:admin'),

    // User Permissions or Roles needed to create a new Roles
    'RolesAPICreateNewRolesMiddlewareType'   => env('Roles_API_CREATE_Roles_MIDDLEWARE_TYPE', 'Roles'), //permissions or Roles
    'RolesAPICreateNewRolesMiddleware'       => env('Roles_API_CREATE_Roles_MIDDLEWARE', 'admin'), // admin, XXX. ... or perms.XXX

    // User Permissions or Roles needed to create a new permission
    'RolesAPICreateNewPermissionMiddlewareType'  => env('Roles_API_CREATE_PERMISSION_MIDDLEWARE_TYPE', 'Roles'), //permissions or Roles
    'RolesAPICreateNewPermissionsMiddleware'     => env('Roles_API_CREATE_PERMISSION_MIDDLEWARE', 'admin'), // admin, XXX. ... or perms.XXX

    /*
    |--------------------------------------------------------------------------
    | Laravel Roles GUI Datatables Settings
    |--------------------------------------------------------------------------
    */

    'enabledDatatablesJs'           => env('Roles_GUI_DATATABLES_JS_ENABLED', false),
    'datatablesJsStartCount'        => env('Roles_GUI_DATATABLES_JS_START_COUNT', 25),
    'datatablesCssCDN'              => env('Roles_GUI_DATATABLES_CSS_CDN', 'https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'),
    'datatablesJsCDN'               => env('Roles_GUI_DATATABLES_JS_CDN', 'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'),
    'datatablesJsPresetCDN'         => env('Roles_GUI_DATATABLES_JS_PRESET_CDN', 'https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'),

    /*
    |--------------------------------------------------------------------------
    | Laravel Roles Package Integration Settings
    |--------------------------------------------------------------------------
    */

    'laravelUsersEnabled'           => env('Roles_GUI_LARAVEL_Roles_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Register 'Roles', 'permission', 'level' route middlewares
    |--------------------------------------------------------------------------
    */

    'route_middlewares' => true,
];
