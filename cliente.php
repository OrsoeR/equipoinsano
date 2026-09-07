<?php

session_start();

// Verificar que exista una sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}

// Verificar que sea cliente
if ($_SESSION["tipo"] !== "cliente") {
    header("Location: admin.php");
    exit;
}

// Cargar los productos
require_once "datos.php";

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo - E-Commerce</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #222;
        }

        /* =========================
           BARRA SUPERIOR
        ========================= */

        .navbar {
            background: #1e1e2f;
            color: white;
            padding: 18px 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .usuario {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .carrito {
            background: #28a745;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .logout {
            background: #d32f2f;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .carrito:hover {
            background: #218838;
        }

        .logout:hover {
            background: #b71c1c;
        }


        /* =========================
           CONTENIDO
        ========================= */

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 30px;
        }

        .titulo {
            margin-bottom: 30px;
        }

        .titulo h2 {
            margin-bottom: 5px;
        }

        .titulo p {
            color: #666;
        }


        /* =========================
           PRODUCTOS
        ========================= */

        .productos {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .producto {
            background: white;
            border-radius: 12px;
            overflow: hidden;

            box-shadow: 0 4px 15px rgba(0,0,0,0.08);

            transition: 0.3s;
        }

        .producto:hover {
            transform: translateY(-5px);
        }


        /* =========================
           IMAGEN DEL PRODUCTO
        ========================= */

        .producto img {
            width: 100%;
            height: 160px;

            object-fit: contain;

            background: #f5f5f5;

            padding: 10px;

            display: block;
        }


        /* =========================
           INFORMACIÓN
        ========================= */

        .info {
            padding: 20px;
        }

        .info h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .precio {
            font-size: 24px;
            font-weight: bold;

            margin-bottom: 10px;
        }

        .existencias {
            color: #555;

            margin-bottom: 15px;
        }


        /* =========================
           BOTÓN
        ========================= */

        .boton {
            width: 100%;

            padding: 12px;

            border: none;

            border-radius: 7px;

            background: #222;

            color: white;

            font-size: 15px;

            cursor: pointer;
        }

        .boton:hover {
            background: #444;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {

            .productos {
                grid-template-columns: repeat(2, 1fr);
            }

        }


        @media (max-width: 550px) {

            .productos {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .usuario {
                flex-wrap: wrap;
                justify-content: center;
            }

        }

    </style>

</head>


<body>


    <!-- =========================
         BARRA SUPERIOR
    ========================= -->

    <div class="navbar">

        <h1>🛒 E-Commerce</h1>

        <div class="usuario">

            <span>

                Cliente:

                <strong>
                    <?php echo htmlspecialchars($_SESSION["usuario"]); ?>
                </strong>

            </span>


            <a href="carrito.php" class="carrito">

                🛒 Carrito

            </a>


            <a href="logout.php" class="logout">

                Cerrar sesión

            </a>

        </div>

    </div>



    <!-- =========================
         CATÁLOGO
    ========================= -->

    <div class="container">


        <div class="titulo">

            <h2>
                🛍️ Catálogo de Productos
            </h2>

            <p>
                Selecciona los productos que deseas comprar.
            </p>

        </div>



        <div class="productos">


            <?php foreach ($productos as $id => $producto): ?>


                <div class="producto">


                    <!-- Imagen -->

                    <img
                        src="<?php echo htmlspecialchars($producto["imagen"]); ?>"
                        alt="<?php echo htmlspecialchars($producto["nombre"]); ?>"
                    >



                    <div class="info">


                        <!-- Nombre -->

                        <h3>

                            <?php
                            echo htmlspecialchars($producto["nombre"]);
                            ?>

                        </h3>



                        <!-- Precio -->

                        <div class="precio">

                            $

                            <?php
                            echo number_format($producto["precio"], 2);
                            ?>

                        </div>



                        <!-- Existencias -->

                        <div class="existencias">

                            Existencias:

                            <strong>

                                <?php
                                echo $producto["existencias"];
                                ?>

                            </strong>

                        </div>



                        <!-- Agregar al carrito -->

                        <form
                            action="carrito.php"
                            method="POST"
                        >

                            <input
                                type="hidden"
                                name="producto_id"
                                value="<?php echo $id; ?>"
                            >


                            <button
                                type="submit"
                                class="boton"
                            >

                                🛒 Agregar al carrito

                            </button>

                        </form>


                    </div>

                </div>


            <?php endforeach; ?>


        </div>

    </div>


</body>

</html>