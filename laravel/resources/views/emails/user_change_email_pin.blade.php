<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PIN para cambiar email y contraseña</title>
    </head>
    <body>
        <p>Hola,</p>
        <p>Este es tu PIN para cambiar tu email y contraseña:</p>
        <h2>{{ $pin }}</h2>
        <p>El nuevo email será: <strong>{{ $newEmail }}</strong></p>
        <p>Si no has solicitado este cambio, ignora este mensaje.</p>
    </body>
</html>
