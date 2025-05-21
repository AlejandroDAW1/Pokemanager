<!DOCTYPE html>
<html lang="es">
<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/styleLogin.css">
<body>
  <div class="container">
    <h2>Descubre el mundo de PokeManager</h2>
    <p>
      ¡Saludos Entrenador/a! Has llegado a <strong>Pokemanager</strong>, la mejor plataforma para gestionar tus Pokémon. 
      Aquí podrás registrar tus Pokémon y combatir con ellos. Si ya tienes una cuenta, inicia sesión. Si no, <strong>¡regístrate ahora!</strong>
    </p>
    <p>
      En Pokemanager, podrás disfrutar de una experiencia única en la que podrás gestionar tus Pokémon de manera sencilla y divertida.
      Si eres nuevo en el mundo Pokémon, no te preocupes, aquí encontrarás todo lo que necesitas para comenzar tu aventura.
    </p>
    <main class="registro">
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
</body>

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

<?php include_once '../includes/footer.php';?>