<?php

session_start();

// Verificar que los datos provengan del formulario
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}


// ==========================================
// USUARIOS DEL SISTEMA
// ==========================================

$usuarios = [

    "administrador" => [
        "password" => "asd",
        "tipo" => "administrador"
    ],

    "cliente" => [
        "password" => "123",
        "tipo" => "cliente"
    ]

];


// ==========================================
// RECIBIR DATOS
// ==========================================

$usuario = trim($_POST["usuario"] ?? "");
$password = $_POST["password"] ?? "";


// ==========================================
// VALIDAR CREDENCIALES
// ==========================================

if (
    isset($usuarios[$usuario]) &&
    $usuarios[$usuario]["password"] === $password
) {

    // Crear sesión
    $_SESSION["usuario"] = $usuario;
    $_SESSION["tipo"] = $usuarios[$usuario]["tipo"];


    // Redireccionar según el tipo de usuario

    if ($_SESSION["tipo"] === "administrador") {

        header("Location: admin.php");
        exit;

    }


    if ($_SESSION["tipo"] === "cliente") {

        header("Location: cliente.php");
        exit;

    }

} else {

    // Credenciales incorrectas
    header("Location: error.php");
    exit;

}

?>