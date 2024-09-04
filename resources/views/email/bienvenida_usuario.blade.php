<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a MS EXPORT FLOWERS</title>
</head>
<body>
    <h2>¡Bienvenido a MS EXPORT FLOWERS, {{ $user->name }}!</h2>
    
    <p>Tu cuenta ha sido creada con éxito.</p>
    
    <p>A continuación, encontrarás tus datos de acceso:</p>
    
    <ul>
        <li><strong>Correo electrónico:</strong> {{ $user->email }}</li>
        <li><strong>Contraseña:</strong> {{ $user->cedula }}</li>
    </ul>
    

    
    <p>¡Gracias por unirte a nosotros!</p>
    
    <p>Saludos,<br>Equipo de MS EXPORT FLOWERS</p>
</body>
</html>
