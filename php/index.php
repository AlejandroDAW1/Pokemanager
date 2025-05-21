<!DOCTYPE html>
<html lang="es">
<?php include_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/styleIndex.css">
<body>
  <div class="container">
    <main>
      <div class="buttons-container bordeLetra">
        <a href="sobres.php" class="main-btn" id="sobres">Sobres</a>
        <a href="coleccion.php" class="main-btn" id="coleccion">Colección</a>
        <a href="batalla.php" class="main-btn" id="batalla">Batalla</a>
        <a href="perfil.php" class="main-btn" id="perfil">Perfil</a>
      </div>
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
<script src="../js/index.js"></script>

<?php include_once '../includes/footer.php';?>