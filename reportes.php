<?php
session_start();

// Comprobar si el usuario está autenticado y si es un administrador
if ((!isset($_SESSION['uid']) || !isset($_SESSION['username']) || !isset($_SESSION['user_level']))) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['user_level'] != "admin") {
    header("Location: login.php");
    exit();
}

require '../Rmaster/fpdf186/fpdf.php';
require '../Rmaster/config.php';

// Conectar a la base de datos
$conexion = new mysqli($servername, $username, $password, $database);
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consultar los pedidos de la base de datos
$sql = "SELECT order_id, menu_name, item_name, quantity, status FROM tbl_orders";
$result = $conexion->query($sql);

// Crear el documento PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Título del reporte
$pdf->Cell(0, 10, 'Reporte de Pedidos', 0, 1, 'C');
$pdf->Ln(10);

// Encabezado de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 10, 'Nro. Orden', 1, 0, 'C');
$pdf->Cell(40, 10, 'Menu', 1, 0, 'C');
$pdf->Cell(60, 10, 'Nombre de item', 1, 0, 'C');
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C');
$pdf->Cell(30, 10, 'Estado', 1, 1, 'C'); // Agregar un salto de línea con el 1 en el parámetro

// Datos de la base de datos
$pdf->SetFont('Arial', '', 10);

if ($result->num_rows > 0) {
    while ($datos = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, $datos['order_id'], 1, 0, 'C'); // Centrado
        $pdf->Cell(40, 10, $datos['menu_name'], 1, 0, 'C'); // Centrado
        $pdf->Cell(60, 10, $datos['item_name'], 1, 0, 'C'); // Centrado
        $pdf->Cell(30, 10, $datos['quantity'], 1, 0, 'C'); // Centrado
        $pdf->Cell(30, 10, $datos['status'], 1, 1, 'C'); // Centrado
    }
} else {
    $pdf->Cell(0, 10, 'No hay pedidos para mostrar', 0, 1, 'C');
}

// Enviar el PDF directamente al navegador para abrirlo en una nueva pestaña
$pdf->Output('I');  // 'I' para abrirlo en el navegador, 'D' sería para descargarlo

// Cerrar la conexión a la base de datos
$conexion->close();
?>
