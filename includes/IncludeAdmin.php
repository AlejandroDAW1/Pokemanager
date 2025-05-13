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
        $_SESSION['success'] = "Bienvenido, administrador.";
        header('Location: ../php/admin.php');
        exit();
    } else {
        $_SESSION['error'] = "No tienes permiso para acceder a esta página.";
        header('Location: ../php/index.php');
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Error al conectar a la base de datos.";
    exit();
}
?>