<?php

use Core\Services\Contracts\Route;

$route = \Core\Application::route();

// Registration Routes
$route->get('auth/register',          'RegistrationController@showForm');
$route->post('auth/register',         'RegistrationController@register');
$route->get('auth/register/{token}',  'RegistrationController@confirm');
$route->get('auth/register/resend',   'RegistrationController@resend', 'Auth');

// Authentication Routes
$route->get('auth/login',             'LoginController@showForm');
$route->post('auth/login',            'LoginController@login');
$route->post('auth/logout',           'LoginController@logout', 'Auth');

// Password Reset Routes
$route->get('auth/reset',             'PasswordResetController@showForgotForm');
$route->post('auth/reset/send',       'PasswordResetController@send');
$route->get('auth/reset/{token}',     'PasswordResetController@showResetForm');
$route->post('auth/reset',            'PasswordResetController@reset');

// Password Change Routes
$route->middleware('Auth', function(Route $route) {
    $route->get('auth/password',      'PasswordChangeController@showForm');
    $route->post('auth/password',     'PasswordChangeController@change');
});

// User Management Routes
$route->middleware('Ability:manage-user', function(Route $route) {
    $route->get('auth/users/{user}/replicate', 'UserManagerController@replicate');
    $route->get('auth/users/{user}/confirm',   'UserManagerController@confirm');
    $route->resource('auth/users',             'UserManagerController');
});
