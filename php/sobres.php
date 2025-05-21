<!DOCTYPE html>
<html lang="es">
<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/styleSobres.css">
<body>
  <div class="container">
    <main class="main-sobres">
      <div class="buttons-container bordeLetra">
        <a href="sobres.php" class="main-btn" id="sobres">Sobres</a>
        <a href="coleccion.php" class="main-btn" id="coleccion">Colección</a>
        <a href="batalla.php" class="main-btn" id="batalla">Batalla</a>
        <a href="perfil.php" class="main-btn" id="perfil">Perfil</a>
      </div>
      <h2 id="Sobres">Sobres</h2>
      <section class="section-sobres">
        <h3 id="sobresDisponibles">Sobres Disponibles</h3>
        <p id="sobresNum"><?php echo htmlspecialchars($_SESSION['sobres_disponibles']); ?></p>
        <button id="abrirSobre">Abrir un sobre</button>
      </section>
      <section class="section-sobres-abiertos" id="sobresAbiertos"></section>
    </main>
  </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/ModoOscuro.js"></script>
<script src="../js/abrirSobres.js"></script>

<?php include_once '../includes/footer.php';?>