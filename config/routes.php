<?php

use Core\Services\Contracts\Route;

$route = \Core\Application::route();

// Registration Routes
$route->get('auth/register',          'Auth\RegisterController@showForm');
$route->post('auth/register',         'Auth\RegisterController@register');
$route->get('auth/register/{token}',  'Auth\RegisterController@confirm');
$route->get('auth/register/resend',   'Auth\RegisterController@resend', 'Auth');

// Authentication Routes
$route->get('auth/login',             'Auth\LoginController@showForm');
$route->post('auth/login',            'Auth\LoginController@login');
$route->post('auth/logout',           'Auth\LoginController@logout', 'Auth');

// Password Reset Routes
$route->get('auth/reset',             'Auth\ResetController@showForgotForm');
$route->post('auth/reset/send',       'Auth\ResetController@send');
$route->get('auth/reset/{token}',     'Auth\ResetController@showResetForm');
$route->post('auth/reset',            'Auth\ResetController@reset');

// Password Change Routes
$route->middleware('Auth', function(Route $route) {
    $route->get('auth/password',      'Auth\PasswordController@showForm');
    $route->post('auth/password',     'Auth\PasswordController@change');
});

// User Management Routes
$route->middleware('Ability:manage-user', function(Route $route) {
    $route->get('admin/users/{user}/replicate', 'Admin\UserController@replicate');
    $route->get('admin/users/{user}/confirm',   'Admin\UserController@confirm');
    $route->resource('admin/users',             'Admin\UserController');
});
