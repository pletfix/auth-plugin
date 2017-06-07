<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
</head>
    <body>
        <h2>You are Welcome!</h2>
        <div>
            <p>
                Deine Registrierung bei <a href="{{url()}}">{{config('app.name')}}</a> ist fast abgeschlossen!
                Bitte rufe nachfolgenden Link auf, um die Echtheit deiner E-Mail-Adresse zu bestätigen.
            </p>
            <p>
                <a href="{{url('auth/register/' . $user->confirmation_token, ['email' => $user->email])}}">
                    Ja, die E-Mail-Adresse ist korrekt!
                </a>
            </p>
        </div>
        <hr/>
        <div>
            <i>
                Falls du keinen Account bei {{config('app.name')}} eingerichtet haben solltest, benachrichtige uns bitte unter
                <a href="mailto:{{mail_address(config('mail.from', ''))}}">
                    {{config('mail.from')}}
                </a>.
            </i>
        </div>
    </body>
</html>