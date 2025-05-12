<?php
session_start();
require_once '../includes/conectarBBDD.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pokemanager</title>
  <link rel="stylesheet" href="../css/styleCommon.css">
  <link rel="stylesheet" href="../css/styleColeccion.css">
  <link rel="shortcut icon" href="https://emojis.slackmojis.com/emojis/images/1643514062/186/pokeball.png?1643514062">
  <link href="https://fonts.cdnfonts.com/css/pok" rel="stylesheet">
</head>

<body>
  <div class="container">
    <?php include_once '../includes/header.php'; ?>
    <main class="main-admin">
      <div class="buttons-container">
        <a href="sobres.php" class="main-btn" id="sobres">Sobres</a>
        <a href="coleccion.php" class="main-btn" id="coleccion">Colección</a>
        <a href="batalla.php" class="main-btn" id="batalla">Batalla</a>
        <a href="perfil.php" class="main-btn" id="perfil">Perfil</a>
      </div>
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
                        echo "<a href='../includes/eliminar.php?id=" . urlencode($usuario['id']) . "' id='botonBorrar' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este usuario?\")'>Eliminar</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='4'>Error al obtener los usuarios: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                }
            ?>
        </tbody>
      </table>
      <dialog id="Dialogo_editarUsuario">
            <form id="editUserForm">
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
                <div>
                <label for="editUserAdmin">Administrador:</label>
                <input type="checkbox" id="editUserAdmin" name="is_admin">
                </div>
                <button type="button" id="guardarEdit">Guardar Cambios</button>
                <button type="button" id="cancelarEdit">Cancelar</button>
            </form>
        </dialog>
    </main>
  <script src="../js/editarUsuarios.js"></script>
  <script src="../js/ModoOscuro.js"></script>
</body>

</html>