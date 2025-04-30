<header class="navbar">
    <h1 class="logo">Pokemanager</h1>
    <div class="dark-mode-toggle">
        <p>Modo Oscuro</p>
        <label class="switch">
            <input type="checkbox" id="theme-toggle">
            <span class="slider round"></span>
        </label>
    </div>
    <?php
    if (isset($_SESSION["id"])) {
        echo "<button id='logout-btn'><a href='../includes/logout.php'>Cerrar sesión</a></button>";
      }
    ?>
</header>