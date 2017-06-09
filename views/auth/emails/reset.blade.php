<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
</head>
    <body>
        <h2>Reset Password</h2>
        <div>
            <p>
                Klick hier, um dein Kennwort zurückzusetzen:
            </p>
            <p>
                <a href="{{url('auth/reset/' . $token, ['email' => $user->email])}}">
                    Kennwort jetzt zurücksetzen!
                </a>
            </p>
        </div>
        <hr/>
        <div>
            <i>
                Falls du das Zurücksetzen des Kennwort nich initiert hast, benachrichtige uns bitte unter
                <a href="mailto:{{mail_address(config('mail.from', ''))}}">
                    {{config('mail.from')}}
                </a>.
            </i>
        </div>
    </body>
</html>