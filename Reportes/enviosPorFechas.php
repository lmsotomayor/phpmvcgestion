<?php


$fecha1 = $_GET['variable1'];
$fecha2 = $_GET['variable2'];





//$number = (string)$porcentaje;
//$porcentaje_final = str_replace('', '', $number);



//echo $porcentaje_final;


require('../fpdf/fpdf.php');

$conexion = mysql_connect('localhost', 'root', 'Ramses2005*');
mysql_select_db('pantalon', $conexion);




$pdf = new FPDF();


//$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 

		


$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
//$pdf->Image('../recursos/tienda.gif' , 10 ,8, 10 , 13,'GIF');
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(130, 10, 'La casa del Pantalon', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 10, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(70, 8, 'Envios de Mercaderia por Fechas' ,  0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(50, 8, '', 0);	
$pdf->Cell(50, 8, 'Desde:'.$fecha1. ' '. 'hasta'. ' ' .$fecha2.' ' , 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(50, 8, 'Producto', 0, '0','C');
$pdf->Cell(30, 8, 'Sucursal Origen', 0,'0','C');
$pdf->Cell(30, 8, 'Sucursal Destino', 0,'0','C');
$pdf->Cell(30, 8, 'Cantidad Enviada', 0,'0','C');
$pdf->Cell(30, 8, 'Fecha Envio', 0,'0','C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);




$productos = mysql_query("SELECT t1.idEnvioMercaderia, t1.cantidadEnvio, t1.fechaEnvio, t2.descripcionProducto, t3.nombreSucursal as nosirve1, t4.nombreSucursal as nosirve2 FROM enviomercaderia t1
inner join productos t2 on
t1.idProducto = t2.idProducto
inner join sucursal t3 on
t1.idSucursalOrigen = t3.idSucursal
inner join sucursal t4 on
t1.idSucursalDestino = t4.idSucursal
WHERE t1.fechaEnvio >= '".$fecha1."' and t1.fechaEnvio <= '".$fecha2."'
ORDER BY t1.fechaEnvio");



$totalEnvios = 0;
while($productos2 = mysql_fetch_array($productos)){
	
	
	$totalEnvios = $productos2['cantidadEnvio']+ $totalEnvios;
	$pdf->Cell(50, 8, $productos2['descripcionProducto'], 0,'0','C');
	$pdf->Cell(30, 8, $productos2['nosirve1'], 0,'0','C');
	$pdf->Cell(30, 8, $productos2['nosirve2'], 0,'0','C');
	$pdf->Cell(30, 8, $productos2['cantidadEnvio'], 0,'0','C');
	$pdf->Cell(30, 8, $productos2['fechaEnvio'], 0,'0','C');
	

	

	$pdf->Ln(8);
}


$pdf->Cell(114,8,'',0);

$pdf->Ln(8);
$pdf->Cell(114,8,'',0);
$pdf->Cell(31,8,'Total Envios: '.number_format($totalEnvios),2);



$pdf->Output('I');
?>