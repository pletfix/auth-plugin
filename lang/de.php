<?php

return [

    'nav' => [
        'login'                   => 'Anmelden',
        'register'                => 'Registrieren',
        'change_password'         => 'Kennwort ändern',
        'logout'                  => 'Abmelden',
        'administration'          => 'Administration',
        'user_accounts'           => 'Benutzerkonten',
    ],

    'emails' => [
        'register' => [
            'subject'             => 'E-Mail-Adresse verifizieren',
            'heading'             => 'Herzlich Willkommen!',
            'text'                => 'Deine Registrierung bei {app} ist fast abgeschlossen! Bitte rufe nachfolgenden Link auf, um die Echtheit deiner E-Mail-Adresse zu bestätigen.',
            'button'              => 'Ja, die E-Mail-Adresse ist korrekt!',
            'contact'             => 'Falls du dich nicht registriert haben solltest, benachrichtige uns bitte unter',
        ],
        'reset' => [
            'subject'             => 'Your Password Reset Link',
            'heading'             => 'Kennwort zurücksetzen',
            'text'                => 'Falls du dein Kennwort für {app} vergessen hast, klicke hier, um es zurückzusetzen:',
            'button'              => 'Kennwort zurücksetzen!',
            'contact'             => 'Falls du das Zurücksetzen des Kennworts nicht initiiert hast, benachrichtige uns bitte unter',
        ],
    ],

    'users' => [
        'index' => [
            'title'               => 'Benutzerkonten',
            'heading'             => 'Benutzerkonten',
            'email_not_confirmed' => 'Echtheit noch nicht bestätigt',
            'confirm_button'      => 'Echtheit bestätigen',
        ],
        'form' => [
            'title'               => 'Benutzerkonto',
            'heading'             => 'Benutzerkonto',
            'email_not_confirmed' => 'Echtheit noch nicht bestätigt',
            'change_password'     => 'Kennwort ändern...',
            'confirm_password'    => 'Kennwort bestätigen',
            'password_not_matched'=> 'Das Kennwort stimmt nicht überein!',
            'operation_failed'    => 'Operation fehlgeschlagen!',
            'successful_created'  => 'Das Benutzerkonto wurde erstellt.',
            'successful_updated'  => 'Das Benutzerkonto wurde aktualisiert.',
            'successful_deleted'  => 'Das Benutzerkonto wurde gelöscht.',
            'email_confirmed'     => 'Echtheit der E-Mail-Adresse bestätigt.',
        ],
        'show' => [
            'title'               => 'Benutzerprofil',
            'heading'             => '{name}\'s Profil',
            'email_not_confirmed' => 'Echtheit noch nicht bestätigt',
        ],
    ],

    'register' => [
        'title'                   => 'Registrierung',
        'heading'                 => 'Registrierung',
        'confirm_password'        => 'Kennwort bestätigen',
        'submit'                  => 'Registrieren',
        'email_sent'              => 'Eine E-Mail wurde zwecks Verifizierung an dich versendet!',
        'email_already_used'      => 'Diese E-Mail-Adresse ist bereits registriert!',
        'email_already_verified'  => 'Die E-Mail-Adresse wurde inzwischen verifiziert!',
        'password_not_matched'    => 'Das Kennwort stimmt nicht überein!',
        'token_invalid'           => 'Token ist ungültig!',
    ],

    'login' => [
        'title'                   => 'Login',
        'heading'                 => 'Login',
        'remember_me'             => 'Angemeldet bleiben',
        'forgot_password'         => 'Kennwort vergessen?',
        'submit'                  => 'Login',
        'failed'                  => 'Fehlerhafte Anmeldedaten!',
    ],

    'forgot' => [
        'title'                   => 'Kennwort vergessen',
        'heading'                 => 'Kennwort zurücksetzen',
        'submit'                  => 'Reset-Mail senden',
    ],

    'reset' => [
        'title'                   => 'Kennwort zurücksetzen',
        'heading'                 => 'Kennwort zurücksetzen',
        'confirm_password'        => 'Kennwort bestätigen',
        'submit'                  => 'Kennwort zurücksetzen',
        'email_sent'              => 'Eine E-Mail zum Zurücksetzen des Kennworts wurde versendet.',
        'password_not_matched'    => 'Das Kennwort stimmt nicht überein!',
        'email_required'          => 'E-Mail-Adresse ist erforderlich!',
        'email_unknown'           => 'Die E-Mail-Adresse passt zu keinem Benutzerkonto. Bist du sicher, dass du registriert bist?',
        'token_invalid'           => 'Token ist ungültig!',
        'successful'              => 'Dein Kennwort wurde geändert.',
    ],

    'password' => [
        'title'                   => 'Kennwort ändern',
        'heading'                 => 'Kennwort ändern',
        'current_password'        => 'Bisheriges Kennwort',
        'new_password'            => 'Neues Kennwort',
        'confirm_password'        => 'Neues Kennwort bestätigen',
        'submit'                  => 'Kennwort ändern',
        'password_invalid'        => 'Das Kennwort ist nicht korrekt!',
        'password_not_matched'    => 'Das Kennwort stimmt nicht überein!',
        'successful'              => 'Dein Kennwort wurde geändert.',
    ],

    'confirm' => [
        'title'                   => 'Registrierung abgeschlossen',
        'hello'                   => 'Hallo {name}',
        'welcome'                 => 'Du hast es geschafft! Deine Registrierung ist abgeschlossen.',
        'login'                   => 'Jetzt einloggen',
    ],

];