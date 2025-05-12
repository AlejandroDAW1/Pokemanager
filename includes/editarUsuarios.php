<?php
require_once 'conectarBBDD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'], $data['nombre'], $data['email'], $data['is_admin'])) {
        $id = $data['id'];
        $nombre = $data['nombre'];
        $email = $data['email'];
        $isAdmin = $data['is_admin'];

        try {
            $stmt = $conexion->prepare("UPDATE usuarios SET nombre = :nombre, email = :email, is_admin = :is_admin WHERE id = :id");
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':is_admin', $isAdmin, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                http_response_code(200);
                echo json_encode(['message' => 'Usuario actualizado con éxito.']);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Error al actualizar el usuario.']);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Datos incompletos.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido.']);
}
?>