<?php
session_start();

// Verificar si el usuario está autenticado y redirigir si no lo está
if (empty($_SESSION['nombre']) || empty($_SESSION['apellido'])) {
    header('Location: admin/login.php'); // Asegúrate de que la ruta de redirección sea correcta
    exit();
}

// Incluir el archivo de conexión a la base de datos
include "../db_connection.php"; // Ajusta la ruta según la ubicación real de tu archivo de conexión

// Incluir otros archivos necesarios
include "controlador_eliminar_pedido.php";

// Definir la consulta para obtener los datos de los clientes
$sql = $sqlconnection->query("SELECT
    client_id,
    nombre AS 'nom_cliente',
    cedula AS 'dni',
    correo,
    numero_de_integrantes AS 'numero_personas',
    fecha_hora AS 'hora_fecha'
FROM
    tbl_clients");
?>

<style>
    ul li:nth-child(1) .activo {
        background: rgb(11, 158, 214) !important;
    }
</style>

<!-- Cargar el topbar -->
<?php require('topbar.php'); ?>

<!-- Cargar el sidebar -->
<?php require('sidebar.php'); ?>

<!-- Inicio del contenido principal -->
<div class="page-content">
    <h4 class="text-center text-secondary">SOLICITUDES DE REGISTRO</h4>

    <!-- Botón para generar el reporte en PDF -->
    <div class="text-right mb-2">
        <a href="generar_reporte.php" class="btn btn-success"> <i class="fa-solid fa-file-pdf"></i> GENERAR REPORTES</a>
    </div>

    <table class="table table-bordered table-hover col-12" id="example">
        <thead>
            <tr>
                <th scope="col">CLIENTE</th>
                <th scope="col">DNI</th>
                <th scope="col">CORREO</th>
                <th scope="col">NÚMERO DE PERSONAS</th>
                <th scope="col">HORA Y FECHA</th>
                <th scope="col" class="hidden">ESTADO</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($datos = $sql->fetch_object()) { ?>
                <tr>
                    <td><?= htmlspecialchars($datos->nom_cliente) ?></td>
                    <td><?= htmlspecialchars($datos->dni) ?></td>
                    <td><?= htmlspecialchars($datos->correo) ?></td>
                    <td><?= htmlspecialchars($datos->numero_personas) ?></td>
                    <td><?= htmlspecialchars($datos->hora_fecha) ?></td>
                    <td class="hidden"><?= htmlspecialchars($datos->estado) ?></td>
                    <td>
                        <audio id="alertSound" src="alert.mp3" preload="auto"></audio>
                        <a href="inicio.php?id=<?= $datos->client_id ?>" onclick="return advertenciaEliminar()" class="btn btn-danger btn-sm">ELIMINAR<i class=""></i></a>
                        <!-- Formulario para eliminar todos los registros -->
                        <form action="eliminar_todos.php" method="post" onsubmit="return advertenciaEliminar()">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!-- Fin del contenido principal -->

<!-- Cargar el footer -->
<?php require('footer.php'); ?>
