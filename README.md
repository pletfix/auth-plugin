# Authentication Plugin for Pletfix

## About This

This plugin provides forms that allow the user to register via Double opt-in process and to log in. The user can also
reset or change their password. In addition, the plugin provides the "remember-me" functionality. 

Furthermore, the plugin contains a complete user administration.

It assumes that the default user model from the [Pletfix Application Skeleton](https://github.com/pletfix/app) is used 
to store the user attributes.

## Installation 

Fetch the package by running the following terminal command under the application's directory:

    composer require pletfix/authentication

After downloading, enter this command in your terminal to register the plugin:

    php console plugin pletfix/authentication 
    
## Customize
    
If you would like to modified the views of the plugin, copy them to the application's view directory, where you can edit 
the views as you wish:
     
    cp -R ./vendor/pletfix/authentication/views/* ./resources/views/
    
If you like to use an another root path, have a look in the plugin's route entries in `./vendor/pletfix/authentication/config/routes.php`. 
You can override or modify the route entries in the application's route file `./config/boot/routes.php` like you wish:

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
 
## Usage

### Registration

Enter the following URL into your Browser to open the registration form:

    https://<your-application>/auth/register

![Registration Form](https://raw.githubusercontent.com/pletfix/registration/master/docs/screenshot1.png)

After the user submitted the form, a new entity is saved into the user model (with a "guest" role) so that the user is 
log in into the application immediately (but only as a guest). 

A mail is sent to the email address the user has entered.  

![Registration Mail](https://raw.githubusercontent.com/pletfix/registration/master/docs/screenshot2.png)

WHile the user is logged in, he may resend the mail by entering this URL:

    https://<your-application>/auth/register/resend

If the user confirms the email, their role is updated to "user" and a confirmation message is printed: 
 
![Confirm Registration](https://raw.githubusercontent.com/pletfix/registration/master/docs/screenshot3.png)
 
### Login and Logout

The URLs to login into the application is this: 

    https://<your-application>/auth/login
    
![Login](https://raw.githubusercontent.com/pletfix/registration/master/docs/screenshot4.png)    

If the user ticks "remember-me", a long life (5 years) cookie is created on the browser. If the PHP session expires 
(because has close the browser and opens it later for example), the User will be re-login automaticaly.
 
Of course, you could logout by entering this URL:

    https://<your-application>/auth/logout

The `logout` method kill the authentication data and - additional - the "remember-me" cookie if exist.

### Reset Password

To reset the password, two forms are needed. Enter this to start the reset process:

    https://<your-application>/auth/reset

![Forgot Password](https://raw.githubusercontent.com/pletfix/registration/master/docs/screenshot5.png)    

After submit a random token is saved into the `password_resets` database table and a mail is send to this email address.

![Reset Password Mail](https://raw.githubusercontent.com/pletfix/registration/master/docs/screenshot6.png)   

If the user confirms the email, the token will be matched and the second form to receive the new password is opened:

![Reset Password](https://raw.githubusercontent.com/pletfix/registration/master/docs/screenshot7.png)   

### Change Password

The user may change their password quickly if already log in: 

    https://<your-application>/auth/reset

![Change Password](https://raw.githubusercontent.com/pletfix/registration/master/docs/screenshot8.png)   

