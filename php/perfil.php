<!DOCTYPE html>
<html lang="es">
<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/stylePerfil.css">
<body>
  <div class="container">
      <h2 id="Perfil">Tu Perfil</h2>
      <section class="perfil-form">
        <?php
        if (isset($_SESSION['nombre']) && isset($_SESSION['email'])) {
          $dias_ultima_conexion = round((strtotime(date("Y-m-d H:i:s")) - strtotime($_SESSION['ultima_conexion'])) / (60 * 60 * 24));
          $fecha_registro = date("d/m/Y", strtotime($_SESSION['fecha_registro']));
          echo "<img src='" . htmlspecialchars($_SESSION['foto_perfil']) . "' alt='Foto de perfil' class='perfil-img'>";
          echo "<div class='perfil-datos'>";
          echo "<p>" . htmlspecialchars($_SESSION['nombre']) . "</p>";
          echo "<p id='emailUsu'>" . htmlspecialchars($_SESSION['email']) . "</p>";
          echo "<p><strong>Edad:</strong> " . htmlspecialchars($_SESSION['edad']) . "</p>";
          echo "<p><strong>Registro:</strong> " . $fecha_registro . " (Hace " . $dias_ultima_conexion . " dias)</p>";
          echo "<p><strong>ultima conexion:</strong> " . htmlspecialchars($_SESSION['ultima_conexion']) . "</p>";
          echo "</div>";
        }
        ?>
      </section>
      <section class="perfil-sobres">
        <h3 id="sobresDisponibles">Sobres Disponibles</h3>
        <p id="sobresNum"><?php echo htmlspecialchars($_SESSION['sobres_disponibles']); ?></p>
        <a id="borrarCuenta" href="../includes/borrarCuenta.php">Eliminar Cuenta</a>
      </section>
  </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/ModoOscuro.js"></script>

