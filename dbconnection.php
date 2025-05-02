<?php
require("config.php");

// Crear la conexión
$sqlconnection = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($sqlconnection->connect_error) {
    die("Conexión fallida: " . $sqlconnection->connect_error);
}
?>
