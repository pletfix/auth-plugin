<?php

return [

    'nav' => [
        'login'                   => 'Login',
        'register'                => 'Register',
        'change_password'         => 'Change Password',
        'logout'                  => 'Logout',
        'administration'          => 'Administration',
        'user_accounts'           => 'User Accounts',
    ],

    'emails' => [
        'register' => [
            'subject'             => 'Verify e-mail address',
            'heading'             => 'You are Welcome!',
            'text'                => 'Your registration at {app} is almost finished! Please click on the link below to confirm the authenticity of your e-mail address.',
            'button'              => 'Yes, the e-mail address is correct!',
            'contact'             => 'If you have not registered, please contact us at',
        ],
        'reset' => [
            'subject'             => 'Your password reset link',
            'heading'             => 'Reset password',
            'text'                => 'If you forgot your password for {app}, click here to reset it:',
            'button'              => 'Reset password!',
            'contact'             => 'If you have not initiated resetting the password, please contact us at',
        ],
    ],

    'users' => [
        'index' => [
            'title'               => 'User Accounts',
            'heading'             => 'User Accounts',
            'email_not_confirmed' => 'authenticity not yet confirmed',
            'confirm_button'      => 'Confirm the Authenticity',
        ],
        'form' => [
            'title'               => 'User Account',
            'heading'             => 'User Account',
            'email_not_confirmed' => 'authenticity not yet confirmed',
            'change_password'     => 'Change password...',
            'confirm_password'    => 'Confirm Password',
            'password_not_matched'=> 'The password does not match!',
            'operation_failed'    => 'Operation failed!',
            'successful_created'  => 'The user account has been created.',
            'successful_updated'  => 'The user account has been updated.',
            'successful_deleted'  => 'The user account has been deleted.',
            'email_confirmed'     => 'Authenticity of the e-mail address confirmed.',
        ],
        'show' => [
            'title'               => 'User Profile',
            'heading'             => '{name}\'s Profile',
            'email_not_confirmed' => 'authenticity not yet confirmed',
        ],
    ],

    'register' => [
        'title'                   => 'Registration',
        'heading'                 => 'Registration',
        'confirm_password'        => 'Confirm Password',
        'submit'                  => 'Register',
        'email_sent'              => 'An e-mail has been sent to you for verification!',
        'email_already_used'      => 'This e-mail address is already registered!',
        'email_already_verified'  => 'The e-mail address has meantime been verified!',
        'password_not_matched'    => 'The password does not match!',
        'token_invalid'           => 'Token is invalid!',
    ],

    'login' => [
        'title'                   => 'Login',
        'heading'                 => 'Login',
        'remember_me'             => 'Remember Me',
        'forgot_password'         => 'Forgot Your Password?',
        'submit'                  => 'Login',
        'failed'                  => 'Incorrect credentials!',
    ],

    'forgot' => [
        'title'                   => 'Password forgotten',
        'heading'                 => 'Reset Password',
        'submit'                  => 'Send Reset Mail',
    ],

    'reset' => [
        'title'                   => 'Reset Password',
        'heading'                 => 'Reset Password',
        'confirm_password'        => 'Confirm Password',
        'submit'                  => 'Reset Password',
        'email_sent'              => 'An e-mail to reset the password has been sent.',
        'password_not_matched'    => 'The password does not match!',
        'email_required'          => 'E-mail address is required!',
        'email_unknown'           => 'The e-mail address doesn\'t match any user accounts. Are you sure you\'ve registered?',
        'token_invalid'           => 'Token is invalid!',
        'successful'              => 'Your password has been changed.',
    ],

    'password' => [
        'title'                   => 'Change Password',
        'heading'                 => 'Change Password',
        'current_password'        => 'Current Password',
        'new_password'            => 'New Password',
        'confirm_password'        => 'Confirm Password',
        'submit'                  => 'Change Password',
        'password_invalid'        => 'The password is not correct!',
        'password_not_matched'    => 'The password does not match!',
        'successful'              => 'Your password has been changed.',
    ],

    'confirm' => [
        'title'                   => 'Registration complete',
        'hello'                   => 'Hello {name}',
        'welcome'                 => 'You did it! Your registration is complete.',
        'login'                   => 'Login now',
    ],

];