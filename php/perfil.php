<!DOCTYPE html>
<html lang="es">
<?php
include_once '../includes/header.php';
include_once '../includes/obtenerPokemonCapturados.php';
?>
<link rel="stylesheet" href="../css/stylePerfil.css">

<body>
  <h2 id="Perfil">Tu Perfil</h2>
  <section class="perfil-form">
    <?php
    $dias_ultima_conexion = round((strtotime(date("Y-m-d H:i:s")) - strtotime($_SESSION['ultima_conexion'])) / (60 * 60 * 24));
    $fecha_registro = date("d/m/Y", strtotime($_SESSION['fecha_registro']));
    $dias_registro = round((strtotime(date("Y-m-d H:i:s")) - strtotime($_SESSION['fecha_registro'])) / (60 * 60 * 24));
    echo "<img src='" . htmlspecialchars($_SESSION['foto_perfil']) . "' alt='Foto de perfil' class='perfil-img'>";
    echo "<div class='perfil-datos'>";
    echo "<p>" . htmlspecialchars($_SESSION['nombre']) . "</p>";
    echo "<p id='emailUsu'>" . htmlspecialchars($_SESSION['email']) . "</p>";
    echo "<p>Edad: " . htmlspecialchars($_SESSION['edad']) . "</p>";
    echo "</div>";
    ?>
  </section>
  <section class="perfil-conexion">
    <?php
    echo "<p><strong>Registro:</strong> " . $fecha_registro . " (Hace " . $dias_registro . " dias)</p>";
    echo "<p><strong>ultima conexion:</strong> " . htmlspecialchars($_SESSION['ultima_conexion']) . "</p>";
    ?>
  </section>
  <section class="perfil-sobres">
    <p id="sobresDisponibles">Sobres Disponibles: <?php echo htmlspecialchars($_SESSION['sobres_disponibles']); ?></p>
    <p id="pokemonCapturados">Pokémon Capturados: <?php echo htmlspecialchars($_SESSION['pokemon_capturados']) ?> </p>
  </section>
  <a id="borrarCuenta" href="../includes/borrarCuenta.php">Eliminar Cuenta</a>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/ModoOscuro.js"></script>