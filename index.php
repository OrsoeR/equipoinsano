<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar Sesión - E-Commerce</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login {
            background: white;
            width: 350px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #222;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #444;
        }

        .descripcion {
            text-align: center;
            color: #666;
        }
    </style>
</head>

<body>

    <div class="login">

        <h1>🛒 E-Commerce</h1>

        <p class="descripcion">
            Inicia sesión para continuar
        </p>

        <form action="validar.php" method="POST">

            <label for="usuario">Usuario</label>

            <input
                type="text"
                id="usuario"
                name="usuario"
                placeholder="Ingresa tu usuario"
                required
            >

            <label for="password">Contraseña</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Ingresa tu contraseña"
                required
            >

            <button type="submit">
                Iniciar sesión
            </button>

        </form>

    </div>

</body>
</html>