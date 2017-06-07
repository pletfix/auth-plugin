<?php

$route = \Core\Application::route();

// Registration Routes
$route->get('auth/register',          'Auth\RegisterController@showForm');
$route->post('auth/register',         'Auth\RegisterController@register');
$route->get('auth/register/{token}',  'Auth\RegisterController@confirm');
$route->get('auth/register/resend',   'Auth\RegisterController@resend', 'Auth');
