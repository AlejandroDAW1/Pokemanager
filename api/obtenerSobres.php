<?php
session_start();
require_once '../includes/conectarBBDD.php';

header('Content-Type: application/json');
$usuarioId = $_SESSION['id'] ?? null;
if (!$usuarioId) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Usuario no autenticado'
    ]);
    exit;
}

// Read JSON input
$jsonInput = file_get_contents('php://input');
$data = json_decode($jsonInput, true);
$cantidadSobres = $data['cantidadSobres'] ?? 0;

if ($cantidadSobres <= 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Cantidad de sobres no válida ('.$cantidadSobres.')'
    ]);
    exit;
}
$stmtUpdate = $conexion->prepare("
        UPDATE usuarios 
        SET sobres_disponibles = sobres_disponibles + :cantidadSobres 
        WHERE id = :usuario_id
    ");
$stmtUpdate->execute(['cantidadSobres' => $cantidadSobres, 'usuario_id' => $usuarioId]);

if ($stmtUpdate->rowCount() > 0) {
    $_SESSION['sobres_disponibles'] += $cantidadSobres; 
    echo json_encode([
        'status' => 'success',
        'message' => 'Sobres actualizados correctamente',
        'sobres_disponibles' => $_SESSION['sobres_disponibles']
    ]);
    exit;
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al actualizar los sobres disponibles'
    ]);
    exit;
}
