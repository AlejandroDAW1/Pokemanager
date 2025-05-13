<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pokemanager - Inicio</title>
  <link rel="stylesheet" href="../css/styleCommon.css">
  <link rel="stylesheet" href="../css/styleIndex.css">
  <link rel="shortcut icon" href="https://emojis.slackmojis.com/emojis/images/1643514062/186/pokeball.png?1643514062">
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
  <link href="https://fonts.cdnfonts.com/css/pok" rel="stylesheet">
</head>

<body>
  <div class="container">
    <?php
    include_once '../includes/header.php';
    ?>
    <main>
      <div class="buttons-container">
        <a href="sobres.php" class="main-btn" id="sobres">Sobres</a>
        <a href="coleccion.php" class="main-btn" id="coleccion">Colección</a>
        <a href="batalla.php" class="main-btn" id="batalla">Batalla</a>
        <a href="perfil.php" class="main-btn" id="perfil">Perfil</a>
      </div>
    </main>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php
  if (isset($_SESSION['error'])) {
    echo "<script>Swal.fire('Error', '" . $_SESSION['error'] . "', 'error');</script>";
    unset($_SESSION['error']);
  }
  if (isset($_SESSION['success'])) {
    echo "<script>Swal.fire('Éxito', '" . $_SESSION['success'] . "', 'success');</script>";
    unset($_SESSION['success']);
  }
  ?>
  <script src="../js/ModoOscuro.js"></script>
  <script src="../js/index.js"></script>
</body>

</html>