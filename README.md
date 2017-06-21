# Authentication Plugin for Pletfix

## About This

This plugin provides forms that allow the user to register via Double opt-in process and to log in. The user can also
reset or change their password. In addition, the plugin provides the "remember-me" functionality. 

Furthermore, the plugin contains a simple administration frontend to manage the user accounts.

It assumes that the default user model from the [Pletfix Application Skeleton](https://github.com/pletfix/app) is used 
to store the user attributes.

## Installation 

Fetch the package by running the following terminal command under the application's directory:

    composer require pletfix/authentication

After downloading, enter this command in your terminal to register the plugin:

    php console plugin pletfix/authentication 
    
Execute the `migrate` command to create a `password_resets`database table:
 
    php console migrate
        
## Customize
    
### View    

If you would like to modified the views of the plugin, copy them to the application's view directory, where you can edit 
the views as you wish:
     
    cp -R ./vendor/pletfix/authentication/views/* ./resources/views/
 
For example, if you have installed the [Pletfix Application Skeleton](https://github.com/pletfix/app), you could add the 
suitable menu items by by adding the following partials in your `resources/views/app.blade.php` layout:
 
- Copy this line just above the marker `{{--left_menu_point--}}`: 
    
       @include('_username')
    
- Copy this line just above the marker `{{--right_menu_point--}}`: 
    
       @include('_login')
    
The `_username` partial prints the username of the current user and `_login` renders the menu items for login, logout, 
register and so on.

### Abilities
 
Add the `manage-user`ability to the Access Control List in `config/auth.php` to control the access to the 
user management frontend: 
    
    'acl' => [
        //...        
        'manage-user' => ['admin'],
    ],

### Routes
   
If you don't use the `manage-user`ability, or if you like to use an another route path, have a look in the plugin's 
route entries in `./vendor/pletfix/authentication/config/routes.php`. 
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

    // User Management Routes
    $route->get('admin/users/{user}/replicate', 'Admin\UserController@replicate');
    $route->get('admin/users/{user}/confirm',   'Admin\UserController@confirm');
    $route->resource('admin/users',             'Admin\UserController');
    
## Usage

### Registration

Enter the following URL into your Browser to open the registration form:

    https://<your-application>/auth/register

![Registration Form](https://raw.githubusercontent.com/pletfix/authentication/master/docs/screenshot1.png)

After the user submitted the form, a new entity is saved into the user model (with a "guest" role) so that the user is 
log in into the application immediately (but only as a guest). 

A mail is sent to the email address the user has entered.  

![Registration Mail](https://raw.githubusercontent.com/pletfix/authentication/master/docs/screenshot2.png)

While the user is logged in, he may resend the mail by entering this URL:

    https://<your-application>/auth/register/resend

If the user confirms the email, their role is updated to "user" and a confirmation message is printed: 
 
![Confirm Registration](https://raw.githubusercontent.com/pletfix/authentication/master/docs/screenshot3.png)
 
### Login and Logout

The URLs to login into the application is this: 

    https://<your-application>/auth/login
    
![Login](https://raw.githubusercontent.com/pletfix/authentication/master/docs/screenshot4.png)    

If the user ticks "remember-me", a long life (5 years) cookie is created on the browser. If the PHP session expires 
(because has close the browser and opens it later for example), the User will be re-login automaticaly.
 
Of course, you could logout by entering this URL:

    https://<your-application>/auth/logout

The `logout` method kill the authentication data and - additional - the "remember-me" cookie if exist.

### Reset Password

To reset the password, two forms are needed. Enter this to start the reset process:

    https://<your-application>/auth/reset

![Forgot Password](https://raw.githubusercontent.com/pletfix/authentication/master/docs/screenshot5.png)    

After submit a random token is saved into the `password_resets` database table and a mail is send to this email address.

![Reset Password Mail](https://raw.githubusercontent.com/pletfix/authentication/master/docs/screenshot6.png)   

If the user confirms the email, the token will be matched and the second form to receive the new password is opened:

![Reset Password](https://raw.githubusercontent.com/pletfix/authentication/master/docs/screenshot7.png)   

### Change Password

The user may change their password quickly if already log in: 

    https://<your-application>/auth/reset

![Change Password](https://raw.githubusercontent.com/pletfix/authentication/master/docs/screenshot8.png)   

### User Management Frontend

Enter the following URL into your Browser to open the user management:

    https://<your-application>/admin/users

![User Management](https://raw.githubusercontent.com/pletfix/authentication/master/docs/screenshot9.png)

![User Management](https://raw.githubusercontent.com/pletfix/authentication/master/docs/screenshot10.png)
