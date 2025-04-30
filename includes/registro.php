<?php
session_start();
include('conectarBBDD.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombreRegistro'];
    $email = $_POST['emailRegistro'];
    $email_repeat = $_POST['email_repeat'];
    $password = $_POST['passwordRegistro'];
    $password_repeat = $_POST['password_repeat'];
    $edad = $_POST['edad'];

    if (empty($nombre) || empty($email) || empty($password) || empty($edad)) {
        $_SESSION['error'] = "Todos los campos son requeridos.";
        header("Location: ../php/loginPokemon.php");
        exit();
    }

    if ($email !== $email_repeat) {
        $_SESSION['error'] = "Todos los campos son requeridos.";
        header("Location: ../php/loginPokemon.php");
        exit();
    }

    if ($password !== $password_repeat) {
        $_SESSION['error'] = "Las contraseñas no coinciden.";
        header("Location: ../php/loginPokemon.php");
        exit();
    }
    if ($edad < 14) {
        $_SESSION['error'] = "Debes tener más de 14 años para registrarte.";
        header("Location: ../php/loginPokemon.php");
        exit();
    }
    if (strlen($password) < 8) {
        $_SESSION['error'] = "La contraseña debe tener al menos 8 caracteres.";
        header("Location: ../php/loginPokemon.php");
        exit();
    }


    if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
        $fotoTmp = $_FILES['fotoPerfil']['tmp_name'];
        $fotoNombre = basename($_FILES['fotoPerfil']['name']);
        $fotoDestino = "../fotosPerfil/" . uniqid() . "_" . $fotoNombre;

        if (!move_uploaded_file($fotoTmp, $fotoDestino)) {
            $_SESSION['error'] = "Error al subir la foto de perfil";
            header("Location: ../php/loginPokemon.php");
            exit();
        }
    } else {
        $fotoDestino = "../fotosPerfil/default.jpg";
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, pass, edad, foto_perfil) VALUES (:nombre, :email, :pass, :edad, :foto_perfil)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $passwordHash);
        $stmt->bindParam(':edad', $edad);
        $stmt->bindParam(':foto_perfil', $fotoDestino);
        $stmt->execute();

        $_SESSION['success'] = "Registro exitoso. Ahora puedes iniciar sesión.";
        header("Location: ../php/loginPokemon.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error al registrar el usuario: " . $e->getMessage();
        header("Location: ../php/loginPokemon.php");
        exit();
    }
}
