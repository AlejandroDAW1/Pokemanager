<!DOCTYPE html>
<html lang="es">
<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/styleSobres.css">

<body>
  <h2 id="Sobres">Sobres</h2>
  <section class="section-sobres">
    <h3 id="sobresDisponibles">Sobres Disponibles</h3>
    <p id="sobresNum"><?php echo htmlspecialchars($_SESSION['sobres_disponibles']); ?></p>
    <button id="abrirSobre">Abrir un sobre</button>
  </section>
  <section class="section-sobres-abiertos" id="sobresAbiertos"></section>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/ModoOscuro.js"></script>
<script src="../js/abrirSobres.js"></script>