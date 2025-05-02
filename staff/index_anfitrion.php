<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['uid']) || $_SESSION['user_level'] !== 'anfitrion') {
    header("Location: login_anfitrion.php");
    exit();
}

// Contenido de la página protegida
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio - Anfitrión</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body>
    <!-- Contenido de la página protegida -->
    <div class="container">
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <!-- Más contenido aquí -->
    </div>
</body>
</html>
