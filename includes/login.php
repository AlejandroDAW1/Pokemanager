<?php
session_start();
include('conectarBBDD.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['emailLogin'];
    $password = $_POST['pass'];

    if (empty($correo) || empty($password)) {
        $_SESSION['error'] = "Todos los campos son requeridos.";
        header("Location: ../php/loginPokemon.php");
        die();
    } else {
        try {
            $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->bindParam(':email', $correo);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($usuario) {
                if (password_verify($password, $usuario['pass'])) {
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['nombre'] = $usuario['nombre'];
                    $_SESSION['email'] = $usuario['email'];
                    $_SESSION['edad'] = $usuario['edad'];
                    $_SESSION['foto_perfil'] = $usuario['foto_perfil'];
                    $_SESSION['fecha_registro'] = $usuario['fecha_registro'];
                    $_SESSION['sobres_disponibles'] = $usuario['sobres_disponibles'];
                    $_SESSION['ultima_conexion'] = $usuario['ultima_conexion'];
                    $_SESSION['is_admin'] = (bool)$usuario['is_admin'];
                    
                    $dias_ultima_conexion = round((strtotime(date("Y-m-d H:i:s")) - strtotime($_SESSION['ultima_conexion'])) / (60 * 60 * 24));
                    if ($dias_ultima_conexion > 0) {
                        $stmtSobres = $conexion->prepare("UPDATE usuarios SET sobres_disponibles = sobres_disponibles + :sobres WHERE id = :id");
                        $sobres = $dias_ultima_conexion;
                        $stmtSobres->bindParam(':sobres', $sobres);
                        $stmtSobres->bindParam(':id', $usuario['id']);
                        $stmtSobres->execute();
                        $_SESSION['sobres_disponibles'] += $sobres;
                    }

                    $stmt2 = $conexion->prepare("UPDATE usuarios SET ultima_conexion = NOW() WHERE id = :id");
                    $stmt2->bindParam(':id', $usuario['id']);
                    $stmt2->execute();

                    header("Location: ../php/index.php");
                } else {
                    $_SESSION['error'] = "Contraseña incorrecta.";
                    header("Location: ../php/loginPokemon.php");
                    die();
                }
            } else {
                $_SESSION['error'] = "El correo electronico no esta registrado.";
                header("Location: ../php/loginPokemon.php");
                die();
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error al conectar a la base de datos.";
            exit();
        }
    }
}
