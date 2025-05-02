<?php
// Configuración predeterminada de la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Asegúrate de que esta contraseña sea segura y no compartida públicamente
$database = "restaurante";

// Establecer la conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
