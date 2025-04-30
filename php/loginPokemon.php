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
  <link rel="stylesheet" href="../css/styleLogin.css">
  <link rel="shortcut icon" href="https://emojis.slackmojis.com/emojis/images/1643514062/186/pokeball.png?1643514062">
  <link href="https://fonts.cdnfonts.com/css/pok" rel="stylesheet">
</head>

<body>
  <div class="container">
    <?php
    include_once '../includes/header.php';
    ?>
    <main class="main-login">
      <section class="login-form">
        <h2 id="InicioSesion">Inicio de Sesión</h2>
        <form id="login-form" action="../includes/login.php" method="POST">
          <div>
            <label for="emailLogin">Correo electrónico</label>
            <input type="email" id="emailLogin" name="emailLogin" placeholder="Ingresa tu email">
          </div>
          <div>
            <label for="pass">Contraseña</label>
            <input type="password" id="pass" name="pass" placeholder="Ingresa tu contraseña">
          </div>
          <button type="submit" id="botonLogin">Iniciar Sesión</button>
          <a id="NoCuentaLogin">¿No tienes cuenta?, registrate aqui.</a>
        </form>

        <dialog id="RegistroUsuarioDialog">
          <form id="registration-form" action="../includes/registro.php" method="POST" enctype="multipart/form-data">
            <div>
              <label for="nombreRegistro">Nombre</label>
              <input type="text" id="nombreRegistro" name="nombreRegistro" placeholder="Ingresa tu nombre" required>
            </div>
            <div>
              <label for="emailRegistro">Correo electrónico</label>
              <input type="email" id="emailRegistro" name="emailRegistro" placeholder="Ingresa tu email" required>
            </div>
            <div>
              <label for="email_repeat">Repite tu correo electrónico</label>
              <input type="email" id="email_repeat" name="email_repeat" placeholder="Repite tu email">
            </div>
            <div>
              <label for="passwordRegistro">Contraseña</label>
              <input type="password" id="passwordRegistro" name="passwordRegistro" placeholder="Crea una contraseña" required>
            </div>
            <div>
              <label for="password_repeat">Repite la contraseña</label>
              <input type="password" id="password_repeat" name="password_repeat" placeholder="Repite la contraseña">
            </div>
            <div>
              <label for="edad">Edad</label>
              <input type="text" id="edad" name="edad" required>
            </div>
            <div>
              <label for="fotoPerfil">Foto de perfil</label>
              <input type="file" id="fotoPerfil" name="fotoPerfil" accept="image/*">
            </div>
            <button type="submit">Registrarse</button>
            <button type="button" id="cancelarRegistro">Cancelar</button>
          </form>
        </dialog>
      </section>
    </main>
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
  <script src="../js/login.js"></script>
</body>

</html>