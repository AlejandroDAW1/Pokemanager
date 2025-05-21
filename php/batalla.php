<!DOCTYPE html>
<html lang="es">
<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/styleBatalla.css">
<link rel="stylesheet" href="../css/styleTipos.css">

<body>
  <div class="container">
    <main class="main-perfil">
      <div class="buttons-container bordeLetra">
        <a href="sobres.php" class="main-btn" id="sobres">Sobres</a>
        <a href="coleccion.php" class="main-btn" id="coleccion">Colección</a>
        <a href="batalla.php" class="main-btn" id="batalla">Batalla</a>
        <a href="perfil.php" class="main-btn" id="perfil">Perfil</a>
      </div>
      <section id="ComenzarBatalla">
        <button id="botonBatalla">LUCHAR</button>
      </section>
      <section id="batalla">
        <div id="usuarioActual" class="usuario">
          <div class="containerVida">
            <div class="vida">
              <div class="barraVida"><span></span></div>
            </div>
          </div>
          <div class="pokemon">
            <img src="" alt="Pokemon Usuario Actual">
          </div>
          <div class="nombre">
            <span></span>
            <div class="tipo"></div>
          </div>
          <div class="equipo"></div>
        </div>
        <div id="usuarioRival" class="usuario">
          <div class="containerVida">
            <div class="vida">
              <div class="barraVida"><span></span></div>
            </div>
          </div>
          <div class="pokemon">
            <img src="" alt="Pokemon Rival">
          </div>
          <div class="nombre">
            <span></span>
            <div class="tipo"></div>
          </div>
          <div class="equipo"></div>
        </div>
      </section>
      <section id="log">
        <p>pikachu ha usado un ataque especial</p>
        <p>pikachu ha usado un ataque especial</p>
        <p>pikachu ha usado un ataque normal</p>
        <p>pikachu ha recibido 50 de daño</p>
        <p>pikachu ha usado un ataque especial</p>
        <p>pikachu ha usado un ataque especial</p>
        <p>pikachu ha usado un ataque normal</p>
        <p>pikachu ha recibido 50 de daño</p>
        <p>pikachu ha usado un ataque especial</p>
        <p>pikachu ha usado un ataque especial</p>
        <p>pikachu ha usado un ataque normal</p>
        <p>pikachu ha recibido 50 de daño</p>
      </section>
    </main>
  </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/ModoOscuro.js"></script>
<script src="../js/batalla.js"></script>

<?php include_once '../includes/footer.php'; ?>