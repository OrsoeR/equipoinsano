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
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(180deg, #f4f6fb 0%, #eef1f8 100%);
            color: #222;
        }

        /* Barra superior */

        .navbar {
            background: linear-gradient(90deg, #1e1e2f 0%, #2a2a45 100%);
            color: white;
            padding: 20px 35px;

            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 0.5px;
        }

        .usuario {
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .logout {
            background: #d32f2f;
            color: white;
            text-decoration: none;
            padding: 9px 16px;
            border-radius: 8px;
            margin-left: 15px;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s ease, transform 0.15s ease;
        }

        .logout:hover {
            background: #b71c1c;
            transform: translateY(-1px);
        }

        /* Contenido */

        .container {
            padding: 35px 30px 50px;
            max-width: 1200px;
            margin: auto;
        }

        .titulo {
            margin-bottom: 30px;
        }

        .titulo h2 {
            margin-bottom: 6px;
            font-size: 26px;
            color: #1e1e2f;
        }

        .titulo p {
            color: #777;
            font-size: 15px;
        }

        /* Tarjetas */

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            margin-bottom: 35px;
        }

        .card {
            background: white;
            padding: 26px;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            border: 1px solid #eef0f5;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin-top: 0;
            margin-bottom: 12px;
            color: #666;
            font-size: 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .numero {
            font-size: 34px;
            font-weight: 700;
            color: #1e1e2f;
        }

        /* Gráfica */

        .grafica {
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            border: 1px solid #eef0f5;
        }

        .grafica h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 19px;
            color: #1e1e2f;
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
                align-items: flex-start;
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
                    ],

                    backgroundColor: '#1e1e2f',

                    borderRadius: 6

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