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

require_once "datos.php";


// Crear carrito si no existe
if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}


// Agregar producto al carrito
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $producto_id = intval($_POST["producto_id"] ?? 0);

    if (isset($productos[$producto_id])) {

        if (isset($_SESSION["carrito"][$producto_id])) {

            // Aumentar cantidad
            if (
                $_SESSION["carrito"][$producto_id] 
                < $productos[$producto_id]["existencias"]
            ) {
                $_SESSION["carrito"][$producto_id]++;
            }

        } else {

            // Agregar producto por primera vez
            $_SESSION["carrito"][$producto_id] = 1;
        }
    }

    header("Location: carrito.php");
    exit;
}


// Eliminar producto
if (isset($_GET["eliminar"])) {

    $producto_id = intval($_GET["eliminar"]);

    if (isset($_SESSION["carrito"][$producto_id])) {
        unset($_SESSION["carrito"][$producto_id]);
    }

    header("Location: carrito.php");
    exit;
}


// Vaciar carrito
if (isset($_GET["vaciar"])) {

    $_SESSION["carrito"] = [];

    header("Location: carrito.php");
    exit;
}


// Calcular total
$total = 0;

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Carrito de compras</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }


        /* NAVBAR */

        .navbar {
            background: #222;
            color: white;
            padding: 18px 40px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }

        .navbar a:hover {
            color: #ffc107;
        }


        /* CONTENEDOR */

        .contenedor {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .titulo {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
        }

        .titulo h1 {
            margin: 0;
        }


        /* BOTÓN VACIAR */

        .vaciar {
            background: #dc3545;
            color: white;

            padding: 10px 18px;

            border-radius: 7px;

            text-decoration: none;

            font-weight: bold;
        }

        .vaciar:hover {
            background: #b02a37;
        }


        /* CARRITO */

        .carrito {
            background: white;

            border-radius: 12px;

            box-shadow: 0 4px 15px rgba(0,0,0,0.08);

            overflow: hidden;
        }


        /* PRODUCTO */

        .producto {
            display: flex;

            align-items: center;

            padding: 20px;

            border-bottom: 1px solid #eee;

            gap: 20px;
        }

        .producto:last-child {
            border-bottom: none;
        }


        .producto img {
            width: 100px;
            height: 100px;

            object-fit: contain;

            background: #f5f5f5;

            padding: 8px;

            border-radius: 8px;
        }


        .informacion {
            flex: 1;
        }

        .informacion h3 {
            margin: 0 0 8px 0;
        }

        .informacion p {
            margin: 5px 0;
            color: #666;
        }


        .cantidad {
            text-align: center;
            min-width: 100px;
        }

        .cantidad strong {
            display: block;
            margin-bottom: 5px;
        }


        .subtotal {
            min-width: 130px;

            text-align: right;

            font-weight: bold;

            font-size: 18px;
        }


        /* ELIMINAR */

        .eliminar {
            background: #dc3545;

            color: white;

            text-decoration: none;

            padding: 8px 12px;

            border-radius: 6px;

            font-size: 14px;
        }

        .eliminar:hover {
            background: #b02a37;
        }


        /* TOTAL */

        .resumen {
            background: white;

            margin-top: 25px;

            padding: 25px;

            border-radius: 12px;

            box-shadow: 0 4px 15px rgba(0,0,0,0.08);

            display: flex;

            justify-content: space-between;

            align-items: center;
        }

        .resumen h2 {
            margin: 0;
        }

        .total {
            font-size: 28px;

            font-weight: bold;

            color: #28a745;
        }


        /* BOTÓN COMPRAR */

        .comprar {
            display: inline-block;

            margin-top: 20px;

            background: #28a745;

            color: white;

            padding: 14px 25px;

            border-radius: 7px;

            text-decoration: none;

            font-weight: bold;

            font-size: 16px;
        }

        .comprar:hover {
            background: #218838;
        }


        /* CARRITO VACÍO */

        .vacio {
            background: white;

            padding: 60px 20px;

            text-align: center;

            border-radius: 12px;

            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .vacio h2 {
            margin-bottom: 10px;
        }

        .vacio p {
            color: #666;
        }

        .catalogo {
            display: inline-block;

            margin-top: 15px;

            background: #222;

            color: white;

            padding: 12px 20px;

            border-radius: 7px;

            text-decoration: none;
        }

        .catalogo:hover {
            background: #444;
        }


        /* RESPONSIVE */

        @media (max-width: 700px) {

            .navbar {
                padding: 15px 20px;

                flex-direction: column;

                gap: 10px;
            }

            .navbar a {
                margin-left: 10px;
            }

            .titulo {
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

            .producto {
                flex-wrap: wrap;
            }

            .producto img {
                width: 80px;
                height: 80px;
            }

            .subtotal {
                text-align: left;
            }

            .resumen {
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

        }

    </style>

</head>


<body>


    <!-- NAVBAR -->

    <div class="navbar">

        <h2>🛒 E-Commerce</h2>

        <div>

            <span>
                Cliente: 
                <strong>
                    <?php echo htmlspecialchars($_SESSION["usuario"]); ?>
                </strong>
            </span>

            <a href="cliente.php">Catálogo</a>

            <a href="logout.php">Cerrar sesión</a>

        </div>

    </div>



    <!-- CONTENIDO -->

    <div class="contenedor">


        <div class="titulo">

            <h1>🛒 Carrito de compras</h1>

            <?php if (!empty($_SESSION["carrito"])): ?>

                <a href="carrito.php?vaciar=1" class="vaciar">
                    🗑️ Vaciar carrito
                </a>

            <?php endif; ?>

        </div>



        <?php if (empty($_SESSION["carrito"])): ?>


            <!-- CARRITO VACÍO -->

            <div class="vacio">

                <h2>🛒 Tu carrito está vacío</h2>

                <p>
                    Agrega algunos productos desde el catálogo.
                </p>

                <a href="cliente.php" class="catalogo">
                    Ver catálogo
                </a>

            </div>


        <?php else: ?>


            <!-- PRODUCTOS DEL CARRITO -->

            <div class="carrito">


                <?php foreach ($_SESSION["carrito"] as $id => $cantidad): ?>


                    <?php

                    if (!isset($productos[$id])) {
                        continue;
                    }

                    $producto = $productos[$id];

                    $subtotal = $producto["precio"] * $cantidad;

                    $total += $subtotal;

                    ?>


                    <div class="producto">


                        <!-- IMAGEN -->

                        <img 
                            src="<?php echo htmlspecialchars($producto["imagen"]); ?>" 
                            alt="<?php echo htmlspecialchars($producto["nombre"]); ?>"
                        >


                        <!-- INFORMACIÓN -->

                        <div class="informacion">

                            <h3>
                                <?php echo htmlspecialchars($producto["nombre"]); ?>
                            </h3>

                            <p>
                                Precio:
                                $<?php echo number_format($producto["precio"], 2); ?>
                            </p>

                            <p>
                                Stock disponible:
                                <?php echo $producto["existencias"]; ?>
                            </p>

                        </div>


                        <!-- CANTIDAD -->

                        <div class="cantidad">

                            <strong>Cantidad</strong>

                            <?php echo $cantidad; ?>

                        </div>


                        <!-- SUBTOTAL -->

                        <div class="subtotal">

                            $<?php echo number_format($subtotal, 2); ?>

                        </div>


                        <!-- ELIMINAR -->

                        <a 
                            href="carrito.php?eliminar=<?php echo $id; ?>" 
                            class="eliminar"
                        >
                            ❌ Eliminar
                        </a>


                    </div>


                <?php endforeach; ?>


            </div>



            <!-- RESUMEN -->

            <div class="resumen">

                <div>

                    <h2>Total de la compra</h2>

                    <div class="total">

                        $<?php echo number_format($total, 2); ?>

                    </div>

                </div>


                <!-- CONFIRMAR COMPRA -->

                <a href="confirmar.php" class="comprar">
                    ✅ Confirmar compra
                </a>

            </div>


        <?php endif; ?>


    </div>


</body>

</html>