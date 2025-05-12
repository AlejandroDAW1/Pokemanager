<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once('conectarBBDD.php');

try {
    $stmt = $conexion->prepare("
        SELECT p.*
        FROM colection c
        JOIN pokemon p ON c.pokemon_id = p.id
        WHERE c.usuario_id = :usuario_id
    ");
    $stmt->execute(['usuario_id' => $_SESSION['id']]);
    $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($pokemons) {
        foreach ($pokemons as $pokemon) {
            echo "<div class='ColeccionPokemon'>";
            echo "<img id='imagenPokemon'src='../" . $pokemon['icon_path'] . "'>";
            echo "<p> " . $pokemon['id'] . ". " . $pokemon['Name'] . "</p>";
            echo "<p class='pokemonTipo'> " . $pokemon['Type 1'] . "</p>";
            if (!empty($pokemon['Type 2'])) {
                echo "<p class='pokemonTipo'> " . $pokemon['Type 2'] . "</p>";
            }
            echo "</div>";
        }
    } else {
        echo "<p class='error'>No tienes pokemon en tu colección.</p>";
    }
} catch (PDOException $e) {
    $_SESSION['error'] = "Error al conectar a la base de datos.";
    exit();
}
