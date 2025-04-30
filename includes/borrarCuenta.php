<?php
session_start();
include_once 'conectarBBDD.php';
if ($_SESSION['id']) {
    $id = $_SESSION['id'];
    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        session_destroy();
        session_start();
        $_SESSION['success'] = "Cuenta eliminada con éxito.";
    } else {
        $_SESSION['error'] = "Error al eliminar la cuenta.";
    }
    header("Location: ../php/loginPokemon.php");
}
