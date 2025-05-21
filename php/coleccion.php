<!DOCTYPE html>
<html lang="es">
<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/styleTipos.css">
<link rel="stylesheet" href="../css/styleColeccion.css">
<body>
  <div class="container">
    <main class="main-perfil">
      <div class="buttons-container bordeLetra">
        <a href="sobres.php" class="main-btn" id="sobres">Sobres</a>
        <a href="coleccion.php" class="main-btn" id="coleccion">Colección</a>
        <a href="batalla.php" class="main-btn" id="batalla">Batalla</a>
        <a href="perfil.php" class="main-btn" id="perfil">Perfil</a>
      </div>
      <section id="section_coleccion">
        <?php
        include_once '../includes/mostrarPokemon.php';
        ?>
      </section>
  </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/ModoOscuro.js"></script>

<?php include_once '../includes/footer.php';?>