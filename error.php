<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Error de autenticación</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #141e30, #243b55);
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .error-container {
            background: white;
            width: 380px;
            padding: 40px 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .icono {
            font-size: 60px;
            margin-bottom: 10px;
        }

        h1 {
            color: #d32f2f;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            line-height: 1.5;
        }

        .mensaje {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .boton {
            display: inline-block;
            background: #222;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .boton:hover {
            background: #444;
            transform: scale(1.03);
        }
    </style>
</head>

<body>

    <div class="error-container">

        <div class="icono">❌</div>

        <h1>Acceso denegado</h1>

        <p>
            No fue posible iniciar sesión.
        </p>

        <div class="mensaje">
            El usuario o la contraseña son incorrectos.
        </div>

        <a href="index.php" class="boton">
            Volver al inicio de sesión
        </a>

    </div>

</body>
</html>