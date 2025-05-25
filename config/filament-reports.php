<?php

// config for EightyNine/Reports
return [
    /**
     * The directory where your reports are located
     */
    'reports_directory' => app_path('Filament/Reports'),

    /**
     * The namespace where your reports are located
     */
    'reports_namespace' => 'App\\Filament\\Reports',

    /**
     * Disable the default reports menu page
     */
    'reports_custom_menu_page' => true,

    /**
     * Panel-specific report configurations
     *
     * Example:
     * 'panel_reports' => [
     *     'admin' => [
     *         'directory' => app_path('Filament/AdminReports'),
     *         'namespace' => 'App\\Filament\\AdminReports',
     *     ],
     *     'customer' => [
     *         'directory' => app_path('Filament/CustomerReports'),
     *         'namespace' => 'App\\Filament\\CustomerReports',
     *     ],
     * ],
     */
    'panel_reports' => [],
];
