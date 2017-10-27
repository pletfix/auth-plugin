# Authentication Plugin for Pletfix

## About This

This plugin provides forms that allow the user to register via Double opt-in process and to log in. The user can also
reset or change their password. In addition, the plugin provides the "remember-me" functionality. 

Furthermore, the plugin contains a simple administration frontend to manage the user accounts.

It assumes that the default user model from the [Pletfix Application Skeleton](https://github.com/pletfix/app) is used 
to store the user attributes.

## Installation 

Fetch the package by running the following terminal command under the application's directory:

    composer require pletfix/auth-plugin

After downloading, enter this command in your terminal to register the plugin:

    php console plugin pletfix/auth-plugin
    
Execute the `migrate` command to create a `password_resets`database table:
 
    php console migrate
        
## Customize
    
### View    

If you would like to modified the views of the plugin, create a folder `auth` under the view directory of the application, 
and copy the views there. Here you can edit the views as you like:
     
    mkdir ./resources/views/auth 
    cp -R ./vendor/pletfix/auth-plugin/views/* ./resources/views/
     
If you have installed the [Pletfix Application Skeleton](https://github.com/pletfix/app), you could add the necessary 
menu items ("login", "logout", "register" and so on) by including the partial `_nav` in your 
`resources/views/app.blade.php` layout just above the marker `{{--menu_point--}}`: 
    
       @include('auth._nav')
    
### Abilities
 
Add the `manage-user`ability to the Access Control List in `config/auth.php` to control the access to the 
user management frontend: 
    
    'acl' => [
        //...        
        'manage-user' => ['admin'],
    ],

### Routes
   
If you don't use the `manage-user`ability, or if you like to use another route paths, copy the route entries from 
`./vendor/pletfix/auth-plugin/boot/routes.php` into the application's routing file `./boot/routes.php`, where 
you can modify them as you wish:

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
    
#### Basic Authentication

As an alternative to the default login form you can use HTML Basic Authentication. In this case the action method 
`LoginController@basicAuth` must be called instead of `LoginController@showForm` if the login route is requested.
To do this, add the following route entry into `./boot/routes. php`:

    $route->get('auth/login', 'LoginController@basicAuth');

Of course, you can also create a new route so that the previous login form is still accessible: 

    $route->get('auth/basic', 'LoginController@basicAuth');
        
## Usage

### Registration

Enter the following URL into your Browser to open the registration form:

    https://<your-application>/auth/register

![Registration Form](https://raw.githubusercontent.com/pletfix/auth-plugin/master/docs/screenshot1.png)

After the user submitted the form, a new entity is saved into the user model (with a "guest" role) so that the user is 
log in into the application immediately (but only as a guest). 

A mail is sent to the email address the user has entered.  

![Registration Mail](https://raw.githubusercontent.com/pletfix/auth-plugin/master/docs/screenshot2.png)

While the user is logged in, he may resend the mail by entering this URL:

    https://<your-application>/auth/register/resend

If the user confirms the email, their role is updated to "user" and a confirmation message is printed: 
 
![Confirm Registration](https://raw.githubusercontent.com/pletfix/auth-plugin/master/docs/screenshot3.png)
 
### Login and Logout

The URLs to login into the application is this: 

    https://<your-application>/auth/login
    
![Login](https://raw.githubusercontent.com/pletfix/auth-plugin/master/docs/screenshot4.png)    

If the user ticks "remember-me", a long life (5 years) cookie is created on the browser. If the PHP session expires 
(because has close the browser and opens it later for example), the User will be re-login automaticaly.
 
Of course, you could logout by entering this URL:

    https://<your-application>/auth/logout

The `logout` method kill the authentication data and - additional - the "remember-me" cookie if exist.
    
### Reset Password

To reset the password, two forms are needed. Enter this to start the reset process:

    https://<your-application>/auth/reset

![Forgot Password](https://raw.githubusercontent.com/pletfix/auth-plugin/master/docs/screenshot5.png)    

After submit a random token is saved into the `password_resets` database table and a mail is send to this email address.

![Reset Password Mail](https://raw.githubusercontent.com/pletfix/auth-plugin/master/docs/screenshot6.png)   

If the user confirms the email, the token will be matched and the second form to receive the new password is opened:

![Reset Password](https://raw.githubusercontent.com/pletfix/auth-plugin/master/docs/screenshot7.png)   

### Change Password

The user may change their password quickly if already log in: 

    https://<your-application>/auth/reset

![Change Password](https://raw.githubusercontent.com/pletfix/auth-plugin/master/docs/screenshot8.png)   

### User Management Frontend

Enter the following URL into your Browser to open the user management:

    https://<your-application>/auth/users

![User Management](https://raw.githubusercontent.com/pletfix/auth-plugin/master/docs/screenshot9.png)

![User Management](https://raw.githubusercontent.com/pletfix/auth-plugin/master/docs/screenshot10.png)
