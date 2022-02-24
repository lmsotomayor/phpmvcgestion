<?php

$v1 = $_GET['variable1'];
$fecha1 = $_GET['variable2'];
$fecha2 = $_GET['variable3'];
//CONSULTA
//$fecha1 = date("2017-01-30 00:00:00");
//$fecha2 = date("2018-02-03 23:59:59");

//cambio el formato a la fecha
/*
$fecha = new DateTime($fecha1);
$fecha_nueva1 = $fecha->format('d/m/Y');

$fecha = new DateTime($fecha2);
$fecha_nueva2 = $fecha->format('d/m/Y');
*/

require('../fpdf/fpdf.php');

$conexion = mysql_connect('localhost', 'root', 'Ramses2005*');
mysql_select_db('pantalon', $conexion);




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
$pdf->Cell(50, 8, 'LISTADO DE VENTAS POR FECHAS - Sucursal: '.$v1.'' ,  0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(55, 8, '', 0);
$pdf->Cell(55, 8, 'ENTRE: '.$fecha1.' y '.$fecha2.'' ,  0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 8, 'Item', 0);
$pdf->Cell(30, 8, 'Fecha Venta', 0,'0','C');
$pdf->Cell(80, 8, 'Descripcion', 0);
$pdf->Cell(40, 8, 'Cantidad', 0,'0','C');
$pdf->Cell(25, 8, 'Precio Venta', 0,'0','C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);


			



$productos = mysql_query("SELECT t1.cantidadVenta, SUM(t1.cantidadVenta) as suma, t1.precioTotal, t2.descripcionProducto, t3.idVenta, COUNT(t3.idVenta) as venta, t3.fechaVenta  
			FROM detalleventa t1 
            INNER JOIN productos t2 ON t1.idProducto = t2.idProducto 
            INNER JOIN venta t3 ON t1.idVenta = t3.idVenta 
			WHERE t3.fechaVenta >= $fecha1 
			and t3.fechaVenta <= $fecha2  and t3.idSucursal = '$v1'
            GROUP BY  t1.idProducto
            ORDER BY t3.fechaVenta
			");


$cantidadProducto = 0;
$item = 0;
$totaluni = 0;
$totalVentas = 0;
while($productos2 = mysql_fetch_array($productos)){
	//cambio el formato a la fecha
	$fecha = new DateTime($productos2['fechaVenta']);
	$fecha2 = $fecha->format('d/m/Y H:m:s');
	//
	$cantidadProducto = $cantidadProducto +  $productos2['suma']; 
	$item = $item+1;
	$totaluni = $totaluni + $productos2['venta'];
	$totalVentas = $totalVentas + $productos2['precioTotal'];
	$pdf->Cell(15, 8, $item, 0);
	$pdf->Cell(30, 8, $fecha2, 0,'0','C');
	$pdf->Cell(80, 8, $productos2['descripcionProducto'], 0);
	$pdf->Cell(40, 8, $productos2['cantidadVenta'], 0,'0','C');
	$pdf->Cell(25, 8, $productos2['precioTotal'], 0,'0','C');

	$pdf->Ln(8);
}

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(114,8,'',0);
$pdf->Cell(31,8,'Cantidad de Ventas: '.$totaluni,0);  
$pdf->Ln(8);
$pdf->Cell(114,8,'',0);
$pdf->Cell(31,8,'Cantidad de Productos : '.$cantidadProducto,0);
$pdf->Ln(8);
$pdf->Cell(114,8,'',0);
$pdf->Cell(31,8,'Venta Total : $ '.number_format($totalVentas,'2'),2);

$pdf->Cell(114,8,'',0);



$pdf->Output('I');
?>