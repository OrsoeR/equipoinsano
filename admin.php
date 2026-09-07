<?php
session_start();

// Verificar que exista una sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}

// Verificar que sea administrador
if ($_SESSION["tipo"] !== "administrador") {
    header("Location: cliente.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Administrador</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        /* Barra superior */

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
            font-size: 14px;
        }

        .logout {
            background: #d32f2f;
            color: white;
            text-decoration: none;
            padding: 9px 15px;
            border-radius: 6px;
            margin-left: 15px;
        }

        .logout:hover {
            background: #b71c1c;
        }

        /* Contenido */

        .container {
            padding: 30px;
            max-width: 1200px;
            margin: auto;
        }

        .titulo {
            margin-bottom: 25px;
        }

        .titulo h2 {
            margin-bottom: 5px;
        }

        .titulo p {
            color: #666;
        }

        /* Tarjetas */

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .card h3 {
            margin-top: 0;
            color: #666;
            font-size: 16px;
        }

        .numero {
            font-size: 32px;
            font-weight: bold;
        }

        /* Gráfica */

        .grafica {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .grafica h2 {
            margin-top: 0;
        }

        .chart-container {
            position: relative;
            height: 350px;
        }

        /* Responsive */

        @media (max-width: 768px) {

            .cards {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .container {
                padding: 20px;
            }

        }

    </style>

</head>

<body>

    <!-- Barra superior -->

    <div class="navbar">

        <h1>🛒 E-Commerce</h1>

        <div class="usuario">

            Administrador: 
            <strong>
                <?php echo htmlspecialchars($_SESSION["usuario"]); ?>
            </strong>

            <a href="logout.php" class="logout">
                Cerrar sesión
            </a>

        </div>

    </div>


    <!-- Contenido -->

    <div class="container">

        <div class="titulo">

            <h2>📊 Dashboard del Administrador</h2>

            <p>
                Resumen general del sistema de e-commerce.
            </p>

        </div>


        <!-- Tarjetas -->

        <div class="cards">

            <div class="card">

                <h3>📦 Productos</h3>

                <div class="numero">
                    15
                </div>

            </div>


            <div class="card">

                <h3>🛒 Ventas</h3>

                <div class="numero">
                    48
                </div>

            </div>


            <div class="card">

                <h3>👥 Clientes</h3>

                <div class="numero">
                    25
                </div>

            </div>

        </div>


        <!-- Gráfica -->

        <div class="grafica">

            <h2>📈 Ventas de la semana</h2>

            <div class="chart-container">

                <canvas id="ventasChart"></canvas>

            </div>

        </div>

    </div>


    <!-- Código de la gráfica -->

    <script>

        const ctx = document.getElementById('ventasChart');

        new Chart(ctx, {

            type: 'bar',

            data: {

                labels: [
                    'Lunes',
                    'Martes',
                    'Miércoles',
                    'Jueves',
                    'Viernes',
                    'Sábado',
                    'Domingo'
                ],

                datasets: [{

                    label: 'Ventas realizadas',

                    data: [
                        5,
                        8,
                        6,
                        10,
                        7,
                        9,
                        3
                    ]

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                scales: {

                    y: {

                        beginAtZero: true

                    }

                }

            }

        });

    </script>

</body>

</html>