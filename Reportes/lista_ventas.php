<?php
require('../fpdf/fpdf.php');

$conexion = mysql_connect('localhost', 'root', 'Ramses2005*');
mysql_select_db('pantalon', $conexion);

$v1 = $_GET['variable1'];


$pdf = new FPDF();


$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
//$pdf->Image('../recursos/tienda.gif' , 10 ,8, 10 , 13,'GIF');
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(150, 10, 'La casa del Pantalon', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 10, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(50, 8, '', 0);
$pdf->Cell(50, 8, 'LISTADO DE VENTAS DIARIAS - Sucursal: '.$v1.'' ,  0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 8, 'Item', 0);
$pdf->Cell(80, 8, 'Descripcion', 0);
$pdf->Cell(40, 8, 'Cantidad', 0);
$pdf->Cell(25, 8, 'Precio Venta', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);


			
			
//CONSULTA
$fecha1 = date("Y-m-d 00:00:00");
$fecha2 = date("Y-m-d 23:59:59");


$productos = mysql_query("SELECT SUM(t1.cantidadVenta) as suma, t1.precioTotal, t2.descripcionProducto, t3.idVenta FROM detalleventa t1 INNER JOIN productos t2 ON t1.idProducto = t2.idProducto INNER JOIN venta t3 ON t1.idVenta = t3.idVenta 
	WHERE t3.fechaVenta BETWEEN '".$fecha1."' and '".$fecha2."' and t3.idSucursal = $v1
	group by t2.idProducto 
			");
$item = 0;
$totaluni = 0;
$totalVentas = 0;
while($productos2 = mysql_fetch_array($productos)){
	$item = $item+1;
	$totaluni = $totaluni + $productos2['suma'];
	$totalVentas = $totalVentas + $productos2['precioTotal'];
	$pdf->Cell(15, 8, $item, 0);
	$pdf->Cell(80, 8, $productos2['descripcionProducto'], 0);
	$pdf->Cell(40, 8, $productos2['suma'], 0);
	$pdf->Cell(25, 8, $productos2['precioTotal'], 0);

	$pdf->Ln(8);
}

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(114,8,'',0);
$pdf->Cell(31,8,'Cantidad de Ventas: '.$totaluni,0);
$pdf->Ln(8);
$pdf->Cell(114,8,'',0);
$pdf->Cell(31,8,'Venta Total : $ '.number_format($totalVentas,'2'),2);

$pdf->Cell(114,8,'',0);



$pdf->Output('I');
?>