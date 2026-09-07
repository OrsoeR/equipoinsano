<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}

if ($_SESSION["tipo"] !== "cliente") {
    header("Location: admin.php");
    exit;
}

// Vaciar carrito después de confirmar
$_SESSION["carrito"] = [];

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Compra realizada</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;

            display: flex;
            justify-content: center;
            align-items: center;

            height: 100vh;
        }

        .confirmacion {
            background: white;
            width: 400px;

            padding: 40px;

            text-align: center;

            border-radius: 15px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        .icono {
            font-size: 70px;
        }

        h1 {
            color: #28a745;
        }

        p {
            color: #555;
            line-height: 1.5;
        }

        .boton {
            display: inline-block;

            margin-top: 20px;

            padding: 12px 25px;

            background: #222;

            color: white;

            text-decoration: none;

            border-radius: 7px;
        }

        .boton:hover {
            background: #444;
        }

    </style>

</head>

<body>

    <div class="confirmacion">

        <div class="icono">
            ✅
        </div>

        <h1>
            ¡Compra realizada!
        </h1>

        <p>
            Gracias por tu compra.
            Tu pedido ha sido procesado correctamente.
        </p>

        <a
            href="cliente.php"
            class="boton"
        >
            Volver al catálogo
        </a>

    </div>

</body>

</html>