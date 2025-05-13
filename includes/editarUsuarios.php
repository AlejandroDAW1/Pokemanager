<?php
require_once 'conectarBBDD.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['nombre'], $_POST['email'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $isAdmin = $_POST['is_admin'] === '1' ? 1 : 0;

        try {
            $stmt = $conexion->prepare("UPDATE usuarios SET nombre = :nombre, email = :email, is_admin = :is_admin WHERE id = :id");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':is_admin', $isAdmin, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Usuario actualizado correctamente.";
            } else {
                $_SESSION['error'] = "No se pudo actualizar el usuario.";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error en la base de datos: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Por favor, completa todos los campos.";
    }

    header("Location: ../php/admin.php");
    exit();
} else {
    $_SESSION['error'] = "Método no permitido.";
    header("Location: ../php/admin.php");
    exit();
}
?>