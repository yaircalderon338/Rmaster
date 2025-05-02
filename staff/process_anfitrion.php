<?php
session_start();
include("../staff/funtions2.php"); // Asegúrate de que este archivo sea correcto y esté en la ubicación correcta

// Verificar que se reciban los datos del formulario
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conectar a la base de datos
    $conn = new mysqli('localhost', 'username', 'password', 'database_name');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Preparar la consulta
    $stmt = $conn->prepare("SELECT * FROM tbl_anfitrion WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $row['password'])) {
            // Establecer las variables de sesión
            $_SESSION['uid'] = $row['ID'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_level'] = 'anfitrion';  // Cambiar el nivel de usuario a 'anfitrion'

            echo 'correct';
        } else {
            echo 'Usuario o contraseña incorrectos';
        }
    } else {
        echo 'Usuario o contraseña incorrectos';
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
} else {
    echo 'Datos no recibidos';
}
?>
