<!DOCTYPE html>
<html lang="es">
<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/styleIndex.css">

<body>
  <div class="container">
    <main>
      <div class="tabs">
        <button class="tab-btn active bordeLetra" data-tab="sobres">Sobres</button>
        <button class="tab-btn bordeLetra" data-tab="coleccion">Colección</button>
        <button class="tab-btn bordeLetra" data-tab="batalla">Batalla</button>
        <button class="tab-btn bordeLetra" data-tab="perfil">Perfil</button>
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1): ?>
          <button class="tab-btn bordeLetra" data-tab="admin">Admin</button>
        <?php endif; ?>
      </div>
      <div class="tab-content">
        <div id="sobres" class="tab-pane active">
          <?php include_once 'sobres.php'; ?>
        </div>
        <div id="coleccion" class="tab-pane">
          <?php include_once 'coleccion.php'; ?>
        </div>
        <div id="batalla" class="tab-pane">
          <?php include_once 'batalla.php'; ?>
        </div>
        <div id="perfil" class="tab-pane">
          <?php include_once 'perfil.php'; ?>
        </div>
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1): ?>
          <div id="admin" class="tab-pane">
            <?php include_once 'admin.php'; ?>
          </div>
        <?php endif; ?>
      </div>
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
  <script src="../js/index.js"></script>

  <?php include_once '../includes/footer.php'; ?>