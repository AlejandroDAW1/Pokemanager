<?php
require_once 'conectarBBDD.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de usuario no proporcionado.']);
        exit();
    }

    $usuarioId = $_GET['id'];

    try {
        $stmt = $conexion->prepare("SELECT id, nombre, email, is_admin FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            echo json_encode($usuario);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado.']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al conectar a la base de datos.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido.']);
}
?>