<?php
require_once '../includes/conectarBBDD.php';
?>
<!DOCTYPE html>
<html lang="es">
<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/styleAdmin.css">
<body>
  <div class="container">
    <main class="main-admin">
      <div class="buttons-container bordeLetra">
        <a href="sobres.php" class="main-btn" id="sobres">Sobres</a>
        <a href="coleccion.php" class="main-btn" id="coleccion">Colección</a>
        <a href="batalla.php" class="main-btn" id="batalla">Batalla</a>
        <a href="perfil.php" class="main-btn" id="perfil">Perfil</a>
      </div>
      <section class="admin-section bordeLetra">
        <h1>Panel de Administración</h1>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            try {
              $stmt = $conexion->prepare("SELECT id, nombre, email FROM usuarios");
              $stmt->execute();
              $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

              foreach ($usuarios as $usuario) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($usuario['id']) . "</td>";
                echo "<td>" . htmlspecialchars($usuario['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($usuario['email']) . "</td>";
                echo "<td>";
                echo "<button id='botonEditar' data-id='" . htmlspecialchars($usuario['id']) . "'>Editar</button> ";
                echo "<a href='../includes/eliminarCuenta.php?id=" . urlencode($usuario['id']) . "' id='botonBorrar' >Eliminar</a>";
                echo "</td>";
                echo "</tr>";
              }
            } catch (PDOException $e) {
              echo "<tr><td colspan='4'>Error al obtener los usuarios: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </section>
      <dialog id="Dialogo_editarUsuario" class="bordeLetra">
        <form id="editarUsuarioForm" action="../includes/editarUsuarios.php" method="POST">
          <h2>Editar Usuario</h2>
          <input type="hidden" id="editUserId" name="id">
          <div>
            <label for="editUserName">Nombre:</label>
            <input type="text" id="editUserName" name="nombre" required>
          </div>
          <div>
            <label for="editUserEmail">Correo Electrónico:</label>
            <input type="email" id="editUserEmail" name="email" required>
          </div>
          <div id="ContainerIsAdmin">
            <input type="hidden" name="is_admin" value="0">
            <label for="editUserAdmin">Administrador:</label>
            <input type="checkbox" id="editUserAdmin" name="is_admin" value="1">
          </div>
          <button type="submit" id="guardarEdit">Guardar Cambios</button>
          <button type="button" id="cancelarEdit">Cancelar</button>
        </form>
      </dialog>
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
  <script src="../js/editarUsuarios.js"></script>

<?php include_once '../includes/footer.php';?>
