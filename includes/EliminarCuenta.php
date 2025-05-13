<?php
require_once 'conectarBBDD.php';
session_start();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = "ID de usuario no proporcionado.";
    header("Location: ../php/admin.php");
    exit();
}

$usuarioId = $_GET['id'];

try {

    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $usuarioId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Usuario eliminado con éxito.";
    } else {
        $_SESSION['error'] = "Error al eliminar el usuario.";
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Error en la base de datos: " . $e->getMessage();
}
sleep(1);
header("Location: ../php/admin.php");
exit();
?>