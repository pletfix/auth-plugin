<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
</head>
    <body>
        <h2>{{t('auth.emails.register.heading')}}</h2>
        <div>
            <p>
                {{t('auth.emails.register.text', ['app' => config('app.name')])}}
            </p>
            <p>
                <a href="{{url('auth/register/' . $user->confirmation_token, ['email' => $user->email])}}">
                    {{t('auth.emails.register.button')}}
                </a>
            </p>
        </div>
        <hr/>
        <div>
            <i>
                {{t('auth.emails.register.contact')}}
                <a href="mailto:{{mail_address(config('mail.from', ''))}}">
                    {{config('mail.from')}}
                </a>.
            </i>
        </div>
    </body>
</html>