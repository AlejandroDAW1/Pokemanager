<?php
session_start();
require_once 'conectarBBDD.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../php/loginPokemon.php');
    exit();
}

$usuarioId = $_SESSION['id'];

try {
    $stmt = $conexion->prepare("SELECT is_admin FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $usuarioId, PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && $usuario['is_admin']) {
        echo "<h1>Panel de Administración</h1>";
        echo "<a href='../php/admin.php'>Administrar Usuarios</a>";
    } else {
        echo "<h1>No tienes permisos para acceder a esta página.</h1>";
        echo "<a href='../php/index.php'>Volver al inicio</a>";
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Error al conectar a la base de datos.";
    exit();
}
?>