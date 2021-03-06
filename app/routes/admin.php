<?php

$app->group('/dashboard', function () use ($app) {

    // Dashboard Home
    $app->get('', 'Admin:dashboard')
        ->setName('dashboard');

    // Users Routes
    $app->group('/users', function () use ($app) { 
        // User List
        $app->get('', 'AdminUsers:users')
            ->setName('admin-users');
        // Add New User
        $app->map(['GET', 'POST'], '/add', 'AdminUsers:usersAdd')
            ->setName('admin-users-add');
        // Edit User
        $app->map(['GET', 'POST'], '/edit/{user_id}', 'AdminUsers:usersEdit')
            ->setName('admin-users-edit');
        // Delete User
        $app->post('/delete', 'AdminUsers:usersDelete')
            ->setName('admin-users-delete');

        //User Roles
        $app->group('/roles', function () use ($app) {
            $app->post('/delete', 'AdminRoles:rolesDelete')
                ->setName('admin-roles-delete');
            $app->map(['GET', 'POST'], '/edit/{role}', 'AdminRoles:rolesEdit')
                ->setName('admin-roles-edit');
            $app->post('/add', 'AdminRoles:rolesAdd')
                ->setName('admin-roles-add');
        });
    });

    // Global Settings
    $app->map(['GET', 'POST'], '/settings/global', 'AdminSettings:settingsGlobal')
        ->setName('settings-global');
    $app->post('/settings/add', 'AdminSettings:settingsGlobalAdd')
        ->setName('settings-global-add');
    $app->post('/settings/group/add', 'AdminSettings:settingsGlobalAddGroup')
        ->setName('settings-global-group-add');
    $app->post('/settings/group/delete', 'AdminSettings:settingsGlobalDeleteGroup')
        ->setName('settings-global-group-delete');

    $app->map(['GET', 'POST'], '/settings/page-settings/{page_name}', 'AdminSettings:settingsPage')
        ->setName('settings-page');
    
    // Edit Settings.json
    $app->map(['GET', 'POST'], '/developer/settings', 'AdminSettings:settingsDeveloper')
        ->setName('settings-developer');

    // My Account
    $app->map(['GET', 'POST'], '/my-account', 'Admin:myAccount')
        ->setName('my-account');

    // Media Manager
    $app->group('/media', function () use ($app) {
        // Media
        $app->map(['GET'], '', 'AdminMedia:media')
            ->setName('admin-media');
        // Media
        $app->map(['POST'], '/folder', 'AdminMedia:mediaFolder')
            ->setName('admin-media-folder');

        $app->map(['POST'], '/folder/new', 'AdminMedia:mediaFolderNew')
            ->setName('admin-media-folder-new');

        $app->map(['POST'], '/upload', 'AdminMedia:mediaUpload')
            ->setName('admin-media-upload');

        $app->map(['POST'], '/delete', 'AdminMedia:mediaDelete')
            ->setName('admin-media-delete');

        $app->map(['GET'], '/cloudinary-sign', 'AdminMedia:cloudinarySign')
            ->setName('cloudinary-sign');
    });

    // Email Manager
    $app->group('/email', function () use ($app) {

        $app->map(['GET'], '', 'AdminEmail:email')
            ->setName('admin-email');

        $app->map(['GET'], '/details/{email}', 'AdminEmail:emailDetails')
            ->setName('admin-email-details');

        $app->map(['GET','POST'], '/new', 'AdminEmail:emailNew')
            ->setName('admin-email-new');

        $app->map(['GET'], '/templates', 'AdminEmail:templates')
            ->setName('admin-email-template');

        $app->map(['GET','POST'], '/templates/add', 'AdminEmail:templatesAdd')
            ->setName('admin-email-template-add');

        $app->map(['GET','POST'], '/templates/edit/{template_id}', 'AdminEmail:templatesEdit')
            ->setName('admin-email-template-edit');

        $app->map(['POST'], '/templates/delete', 'AdminEmail:templatesDelete')
            ->setName('admin-email-template-delete');

        $app->map(['POST'], '/test', 'AdminEmail:testEmail')
            ->setName('admin-email-test');
    });

    // SEO Manager
    $app->group('/seo', function () use ($app) {

        $app->map(['GET'], '', 'AdminSeo:seo')
            ->setName('admin-seo');

        $app->map(['GET','POST'], '/add', 'AdminSeo:seoAdd')
            ->setName('admin-seo-add');

        $app->map(['GET','POST'], '/edit/{seo_id}', 'AdminSeo:seoEdit')
            ->setName('admin-seo-edit');

        $app->map(['POST'], '/delete', 'AdminSeo:seoDelete')
            ->setName('admin-seo-delete');

        $app->map(['POST'], '/default', 'AdminSeo:seoDefault')
            ->setName('admin-seo-default');
    });

    // SEO Manager
    $app->group('/oauth2', function () use ($app) {
        $app->map(['GET'], '', 'AdminOauth2:providers')
            ->setName('admin-oauth2');

        $app->map(['GET'], '/users', 'AdminOauth2:oauth2Users')
            ->setName('admin-oauth2-users');

        $app->map(['GET','POST'], '/add', 'AdminOauth2:oauth2Add')
            ->setName('admin-oauth2-add');

        $app->map(['GET','POST'], '/edit/{provider_id}', 'AdminOauth2:oauth2Edit')
            ->setName('admin-oauth2-edit');

        $app->map(['POST'], '/enable[/login]', 'AdminOauth2:oauth2Enable')
            ->setName('admin-oauth2-enable');

        $app->map(['POST'], '/disable[/login]', 'AdminOauth2:oauth2Disable')
            ->setName('admin-oauth2-disable');

        $app->map(['POST'], '/delete', 'AdminOauth2:oauth2Delete')
            ->setName('admin-oauth2-delete');
    });

    // Contact Requests
    $app->map(['GET'], '/contact', 'Admin:contact')
        ->setName('admin-contact');
})
->add(new Dappur\Middleware\Auth($container))
->add(new Dappur\Middleware\Admin($container))
->add($container->get('csrf'));
