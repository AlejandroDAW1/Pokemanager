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

try {
    $conexion->beginTransaction();
    $stmtSobres = $conexion->prepare("
        SELECT sobres_disponibles 
        FROM usuarios 
        WHERE id = :usuario_id
    ");
    $stmtSobres->execute(['usuario_id' => $usuarioId]);
    $sobresDisponibles = $stmtSobres->fetchColumn();
    if ($sobresDisponibles <= 0) {
        echo json_encode([
            'status' => 'error',
            'message' => 'No tienes sobres disponibles'
        ]);
        exit;
    }
    $stmtUpdate = $conexion->prepare("
        UPDATE usuarios 
        SET sobres_disponibles = sobres_disponibles - 1 
        WHERE id = :usuario_id
    ");
    $stmtUpdate->execute(['usuario_id' => $usuarioId]);
    if ($stmtUpdate->rowCount() > 0) {
        $_SESSION['sobres_disponibles'] -= 1;
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error al actualizar los sobres disponibles'
        ]);
        exit;
    }
    $stmtSelect = $conexion->prepare("
        SELECT id 
        FROM pokemon 
        WHERE id NOT IN (
            SELECT pokemon_id 
            FROM colection 
            WHERE usuario_id = :usuario_id
        )
        ORDER BY RAND()
        LIMIT 5
    ");
    $stmtSelect->execute(['usuario_id' => $usuarioId]);
    $pokemons = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);

    $stmtInsert = $conexion->prepare("
        INSERT INTO colection (usuario_id, pokemon_id) 
        VALUES (:usuario_id, :pokemon_id)
    ");

    foreach ($pokemons as $pokemon) {
        $stmtInsert->execute([
            'usuario_id' => $usuarioId,
            'pokemon_id' => $pokemon['id']
        ]);
    }

    $conexion->commit();

    $pokemonIds = array_column($pokemons, 'id');
    $inClause = implode(',', array_fill(0, count($pokemonIds), '?'));

    $stmtDetails = $conexion->prepare("
        SELECT * FROM pokemon 
        WHERE id IN ($inClause)
    ");
    $stmtDetails->execute($pokemonIds);
    $insertedPokemon = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'data' => $insertedPokemon
    ]);
} catch (Exception $e) {
    $conexion->rollBack();
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
