<?php

use Core\Services\Contracts\Router;

$router = Core\Services\DI::getInstance()->get('router');

// Registration Routes
$router->get('auth/register',          'RegistrationController@showForm');
$router->post('auth/register',         'RegistrationController@register');
$router->get('auth/register/{token}',  'RegistrationController@confirm');
$router->get('auth/register/resend',   'RegistrationController@resend', 'Auth');

// Authentication Routes
$router->get('auth/login',             'LoginController@showForm');
$router->post('auth/login',            'LoginController@login');
$router->post('auth/logout',           'LoginController@logout', 'Auth');

// Password Reset Routes
$router->get('auth/reset',             'PasswordResetController@showForgotForm');
$router->post('auth/reset/send',       'PasswordResetController@send');
$router->get('auth/reset/{token}',     'PasswordResetController@showResetForm');
$router->post('auth/reset',            'PasswordResetController@reset');

// Password Change Routes
$router->middleware('Auth', function(Router $router) {
    $router->get('auth/password',      'PasswordChangeController@showForm');
    $router->post('auth/password',     'PasswordChangeController@change');
});

// User Management Routes
$router->middleware('Ability:manage-user', function(Router $router) {
    $router->get('auth/users/{user}/replicate', 'UserManagerController@replicate');
    $router->get('auth/users/{user}/confirm',   'UserManagerController@confirm');
    $router->resource('auth/users',             'UserManagerController');
});
