<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
</head>
    <body>
        <h2>{{t('auth.emails.reset.heading')}}</h2>
        <div>
            <p>
                {{t('auth.emails.reset.text', ['app' => config('app.name')])}}
            </p>
            <p>
                <a href="{{url('auth/reset/' . $token, ['email' => $user->email])}}">
                    {{t('auth.emails.reset.button')}}
                </a>
            </p>
        </div>
        <hr/>
        <div>
            <i>
                {{t('auth.emails.reset.contact')}}
                <a href="mailto:{{mail_address(config('mail.from', ''))}}">
                    {{config('mail.from')}}
                </a>.
            </i>
        </div>
    </body>
</html>