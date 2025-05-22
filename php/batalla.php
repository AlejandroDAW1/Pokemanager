<!DOCTYPE html>
<html lang="es">
<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/styleBatalla.css">
<link rel="stylesheet" href="../css/styleTipos.css">

<body>
  <section id="comenzarBatalla">
    <button id="botonBatalla">LUCHAR</button>
  </section>
  <section id="containerBatalla">
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
  <section id="repetir"><button id="botonVolver">VOLVER</button></section>
  <section id="log"></section>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/batalla.js"></script>