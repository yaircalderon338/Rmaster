<?php 
include("../functions.php");

if ((!isset($_SESSION['uid']) || !isset($_SESSION['username']) || !isset($_SESSION['user_level']))) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['user_level'] != "admin") {
    header("Location: login.php");
    exit();
}

// Definir la consulta para mostrar el personal
$displayStaffQuery = "SELECT * FROM tbl_staff";

// Definir la consulta para mostrar los reportes
$displayReportsQuery = "SELECT * FROM tbl_reports"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Panel de Control</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
</head>
<body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1" href="index.php">Restaurante</a>
        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
            </li>
        </ul>
    </nav>

    <div id="wrapper">
        <ul class="sidebar navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Panel de Control</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="menu.php">
                    <i class="fas fa-fw fa-utensils"></i>
                    <span>Menú</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="sales.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Ventas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="staff.php">
                    <i class="fas fa-fw fa-user-circle"></i>
                    <span>Empleados</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-power-off"></i>
                    <span>Cerrar Sesión</span>
                </a>
            </li>
        </ul>

        <div id="content-wrapper">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php">Panel de Control</a>
                    </li>
                    <li class="breadcrumb-item active">Vista General</li>
                </ol>

                <h1>Panel de Administración</h1>
                <hr>
                <p>Vista General del Sistema.</p>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-utensils"></i>
                                Lista de Pedidos Actuales
                            </div>
                            <div class="card-body">
                                <table id="tblCurrentOrder" class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <th>Nro. Orden</th>
                                        <th>Menu</th>
                                        <th>Nombre de item</th>
                                        <th class='text-center'>Cantidad</th>
                                        <th class='text-center'>Estado</th>
                                    </thead>
                                    <tbody id="tblBodyCurrentOrder">
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer small text-muted"><i>Se refresca automáticamente cada 5 segundos</i></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-chart-bar"></i>
                                Disponibilidad del Personal
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered text-center" width="100%" cellspacing="0">
                                    <tr>
                                        <td><b>Personal</b></td>
                                        <td><b>Estado</b></td>
                                    </tr>
                                    <?php 
                                    if ($result = $sqlconnection->query($displayStaffQuery)) {
                                        while($staff = $result->fetch_array(MYSQLI_ASSOC)) {
                                            echo "<tr>";
                                            echo "<td>{$staff['username']}</td>";
                                            echo $staff['status'] == "Online" ? "<td><span class=\"badge badge-success\">Activo</span></td>" : "<td><span class=\"badge badge-secondary\">Inactivo</span></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Agregar tabla de reportes -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fas fa-file-alt"></i>
                                Reportes Generales
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <th>Nro. Orden</th>
                                        <th>Menu</th>
                                        <th>Nombre de item</th>
                                        <th class='text-center'>Cantidad</th>
                                        <th class='text-center'>Estado</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if ($reportResult = $sqlconnection->query($displayReportsQuery)) {
                                            while ($report = $reportResult->fetch_array(MYSQLI_ASSOC)) {
                                                echo "<tr>";
                                                echo "<td>{$report['order_number']}</td>";
                                                echo "<td>{$report['menu']}</td>";
                                                echo "<td>{$report['item_name']}</td>";
                                                echo "<td>{$report['quantity']}</td>";
                                                echo "<td>{$report['status']}</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No hay reportes disponibles.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- Botón para generar el PDF -->
                                <div class="card-footer text-right">
                                    <a href="../reportes.php" target="_blank" class="btn btn-primary">Generar PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Sistema de Restaurante</span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Preparado para partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="logout.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="js/sb-admin.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tblCurrentOrder').DataTable({
                "order": [[0, "desc"]],
                "pageLength": 1
            });
        });
    </script>
</body>
</html>
