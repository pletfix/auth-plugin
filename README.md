# Registration Form Plugin for Pletfix

## About This

This plugin provides a form with which the user can register. It assumes that the default user model 
from the [Pletfix Application Skeleton](https://github.com/pletfix/app) is used to authenticate.

## Installation 

Fetch the package by running the following terminal command under the application's directory:

    composer require pletfix/registration

After downloading, enter this command in your terminal to register the plugin:

    php console plugin pletfix/registration 
    
## Customize
    
If you would like to modified the views of the plugin, copy them to the application's view directory, where you can edit 
the views as you wish:
     
    cp -R ./vendor/pletfix/registration/views/* ./resources/views/
    
If you like to use an another root path, have a look in the plugin's route entries in `./vendor/pletfix/registration/config/routes.php`. 
You can override  or modify the route entries in the application's route file `./config/boot/routes.php` like you wish:

    $route->get('auth/register',          'Auth\RegisterController@showForm');
    $route->post('auth/register',         'Auth\RegisterController@register');
    $route->get('auth/register/{token}',  'Auth\RegisterController@confirm');
    $route->get('auth/register/resend',   'Auth\RegisterController@resend', 'Auth');
 
## Usage

Enter the following URL into your Browser to open the user management:

    https://<your-application>/auth/register

---
   
![Screenshot1](https://raw.githubusercontent.com/pletfix/registration/master/screenshot1.png)

---

![Screenshot2](https://raw.githubusercontent.com/pletfix/registration/master/screenshot2.png)

---

![Screenshot3](https://raw.githubusercontent.com/pletfix/registration/master/screenshot3.png)

---