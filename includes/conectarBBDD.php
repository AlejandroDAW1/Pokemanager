<?php
$host = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "pokemanager";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$base_de_datos", $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
