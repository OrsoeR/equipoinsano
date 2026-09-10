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
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #141e30, #243b55);
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login {
            background: #ffffff;
            width: 100%;
            max-width: 380px;
            padding: 45px 32px;
            border-radius: 18px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
            animation: aparecer 0.5s ease;
        }

        @keyframes aparecer {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .icono-wrapper {
            width: 72px;
            height: 72px;
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icono {
            font-size: 34px;
            line-height: 1;
        }

        h1 {
            color: #1a1a1a;
            font-size: 22px;
            font-weight: 700;
            text-align: center;
            margin: 0 0 6px;
        }

        .descripcion {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin: 0 0 25px;
        }

        label {
            display: block;
            color: #374151;
            font-size: 13px;
            font-weight: 600;
            margin-top: 16px;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            background: #fafafa;
            transition: all 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: #243b55;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(36, 59, 85, 0.12);
        }

        input::placeholder {
            color: #aaa;
        }

        button {
            width: 100%;
            margin-top: 26px;
            padding: 13px 25px;
            border: none;
            border-radius: 10px;
            background: #1a1a1a;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        button:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
        }

        button:active {
            transform: translateY(0);
        }
    </style>
</head>

<body>

    <div class="login">

        <div class="icono-wrapper">
            <div class="icono">🛒</div>
        </div>

        <h1>E-Commerce</h1>

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