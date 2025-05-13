<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pokemanager</title>
  <link rel="stylesheet" href="../css/styleCommon.css">
  <link rel="stylesheet" href="../css/styleSobres.css">
  <link rel="shortcut icon" href="https://emojis.slackmojis.com/emojis/images/1643514062/186/pokeball.png?1643514062">
  <link href="https://fonts.cdnfonts.com/css/pok" rel="stylesheet">
</head>

<body>
  <div class="container">
    <?php
    include_once '../includes/header.php';
    ?>
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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../js/ModoOscuro.js"></script>
  <script src="../js/abrirSobres.js"></script>
</body>

</html>

