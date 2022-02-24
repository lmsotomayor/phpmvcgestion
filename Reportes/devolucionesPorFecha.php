<?php

$sucursal = $_GET['variable1'];
$fecha1 = $_GET['variable2'];
$fecha2 = $_GET['variable3'];




require('../fpdf/fpdf.php');

$conexion = mysql_connect('localhost', 'root', 'Ramses2005*');
mysql_select_db('pantalon', $conexion);

if($sucursal==0){
	$sucursal="Todas";
}


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
$pdf->Cell(50, 8, 'LISTADO DE DEVOLUCIONES POR FECHA - Sucursal: '.$sucursal.'' ,  0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(55, 8, '', 0);
$pdf->Cell(55, 8, 'ENTRE: '.$fecha1.' y '.$fecha2.'' ,  0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 8, 'Item', 0);
$pdf->Cell(80, 8, 'Producto', 0,'0','C');
$pdf->Cell(20, 8, 'Cantidad', 0);
$pdf->Cell(25, 8, 'Sucursal Origen', 0,'0','C');
$pdf->Cell(25, 8, 'Sucursal Destino', 0,'0','C');
$pdf->Cell(25, 8, 'Fecha', 0,'0','C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);




if($sucursal==0){
$productos = mysql_query("SELECT t1.*,  t2.descripcionProducto, t3.nombreSucursal as sucursal1, t4.nombreSucursal as sucursal2 FROM devoluciones t1 inner join productos t2 on t1.idProducto = t2.idProducto inner join sucursal t3 on t1.idSucursalOrigen = t3.idSucursal inner join sucursal t4 on t1.idSucursalDestino = t4.idSucursal
	WHERE t1.fechaDevolucion >= $fecha1
			and t1.fechaDevolucion <= $fecha2  
	ORDER BY t1.fechaDevolucion ASC
			");
}else{
$productos = mysql_query("SELECT t1.*,   t2.descripcionProducto, t3.nombreSucursal as sucursal1, t4.nombreSucursal as sucursal2 FROM devoluciones t1 inner join productos t2 on t1.idProducto = t2.idProducto inner join sucursal t3 on t1.idSucursalOrigen = t3.idSucursal inner join sucursal t4 on t1.idSucursalDestino = t4.idSucursal
	WHERE t1.fechaDevolucion >= $fecha1
			and t1.fechaDevolucion <= $fecha2  and t3.idSucursal = $sucursal
	ORDER BY t1.fechaDevolucion ASC
			");	
}

$cantidadProducto = 0;
$item = 0;

while($productos2 = mysql_fetch_array($productos)){

	//cambio el formato a la fecha
	$fecha = new DateTime($productos2['fechaDevolucion']);
	$fecha2 = $fecha->format('d/m/Y');

	$cantidadProducto = $item + 1;
	$item = $item+1;

	$pdf->Cell(15, 8, $item, 0);
	$pdf->Cell(80, 8, $productos2['descripcionProducto'], 0,'0','C');
	$pdf->Cell(20, 8, $productos2['cantidadDevolucion'], 0,'0','C');
	$pdf->Cell(25, 8, $productos2['sucursal1'], 0,'0','C');
	$pdf->Cell(25, 8, $productos2['sucursal2'], 0,'0','C');
	$pdf->Cell(25, 8, $fecha2, 0,'0','C');
	
	
	$pdf->Ln(8);
}

$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(114,8,'',0);
$pdf->Cell(31,8,'Cantidad de Productos : '.$cantidadProducto,0);
$pdf->Ln(8);


$pdf->Cell(114,8,'',0);



$pdf->Output('I');
?>