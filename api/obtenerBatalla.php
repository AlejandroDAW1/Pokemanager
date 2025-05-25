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

$stmtSelect = $conexion->prepare("
    SELECT p.*
    FROM colection c
    JOIN pokemon p ON c.pokemon_id = p.id
    WHERE c.usuario_id = :usuario_id
    ORDER BY RAND()
    LIMIT 6;
");

$stmtSelect->bindParam(':usuario_id', $usuarioId);
$stmtSelect->execute();
$pokemons = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);

$stmtSelectRivalId = $conexion->prepare("
    SELECT c.usuario_id, u.nombre
    FROM colection c
    JOIN usuarios u ON c.usuario_id = u.id
    WHERE usuario_id != :usuario_id
    ORDER BY RAND()
    LIMIT 1
");
$stmtSelectRivalId->bindParam(':usuario_id', $usuarioId);
$stmtSelectRivalId->execute();
$rivalDatos = $stmtSelectRivalId->fetchAll();
$rivalId = $rivalDatos[0]['usuario_id'] ?? null;
$rivalNombre = $rivalDatos[0]['nombre'] ?? null;

if (!$rivalId) {
    echo json_encode([
        'status' => 'error',
        'message' => 'No se encontró un rival',
        'swal' => [
            'title' => 'Sin rival',
            'text' => 'No se encontró un rival disponible para la batalla.',
            'icon' => 'warning'
        ]
    ]);
    exit;
}

$stmtSelectRival = $conexion->prepare("
    SELECT p.*
    FROM colection c
    JOIN pokemon p ON c.pokemon_id = p.id
    WHERE c.usuario_id = :rival_id
    ORDER BY RAND()
    LIMIT 6;
");
$stmtSelectRival->bindParam(':rival_id', $rivalId);
$stmtSelectRival->execute();
$pokemonsRival = $stmtSelectRival->fetchAll(PDO::FETCH_ASSOC);

if ($pokemons && $pokemonsRival) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Pokemon obtenidos correctamente',
        'data' => [
            'usuario' => [
                'id' => $usuarioId,
                'nombre' => $_SESSION['nombre'],
                'pokemons' => $pokemons
            ],
            'rival' => [
                'id' => $rivalId,
                'nombre' => $rivalNombre,
                'pokemons' => $pokemonsRival
            ]
        ]
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'No se encontraron pokemon'
    ]);
}
?>