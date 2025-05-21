<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemanager</title>
    <link rel="stylesheet" href="../css/styleCommon.css">
    <link rel="shortcut icon" href="https://emojis.slackmojis.com/emojis/images/1643514062/186/pokeball.png?1643514062">
    <link href="https://fonts.cdnfonts.com/css/pok" rel="stylesheet">
</head>

<header class="navbar container">
    <h1 class="logo">Pokemanager</h1>
    <div class="dark-mode-toggle">
        <p>Modo Oscuro</p>
        <label class="switch">
            <input type="checkbox" id="theme-toggle">
            <span class="slider round"></span>
        </label>
    </div>
    <?php if (!isset($_SESSION["id"])): ?>
        <div id="login">
            <form action="../includes/login.php" method="POST" class="header-login-form">
                <input type="email" name="emailLogin" id="emailLogin" placeholder="Email" required>
                <input type="password" name="pass" id="pass" placeholder="Contraseña" required>
                <button type="submit" id="botonLogin" class="bordeLetra">Iniciar Sesión</button>
            </form>
            <a href="../php/loginPokemon.php" id="NoCuentaLogin">¿No tienes cuenta?, registrate aqui.</a>
        </div>
    <?php else: ?>
        <div id="botonesInicio">
            <div class="bienvenida-usuario">
                <span>Hola, <?php echo $_SESSION['nombre']; ?></span>
                <img src="<?php echo $_SESSION['foto_perfil'] ? '../uploads/' . $_SESSION['foto_perfil'] : '../img/default-profile.png'; ?>" id="FotoPerfil"> 
                     
            </div>
            <a href="../includes/includeAdmin.php" id="admin-btn" class="bordeLetra">Admin</a>
            <button id="logout-btn" class="bordeLetra">
                <a href="../includes/logout.php">Cerrar sesión</a>
            </button>
        </div>
    <?php endif; ?>
</header>