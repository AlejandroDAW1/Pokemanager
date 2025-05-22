<?php
require_once '../includes/conectarBBDD.php';

$usuarioId = $_SESSION['id'] ?? null;

if (!$usuarioId) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Usuario no autenticado'
    ]);
    exit;
}

try {
    $stmt = $conexion->prepare("
        SELECT COUNT(*) as total_pokemon
        FROM colection
        WHERE usuario_id = :usuario_id
    ");
    
    $stmt->execute(['usuario_id' => $usuarioId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $_SESSION['pokemon_capturados'] = $result['total_pokemon'];
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>