



<?php
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
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(100, 8, 'LISTADO DE CAMBIOS DE PRECIOS', 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 8, 'Item', 0);
$pdf->Cell(80, 8, 'Descripcion', 0);
$pdf->Cell(40, 8, 'Fecha Ultimo Precio', 0,'0','C');
$pdf->Cell(25, 8, 'Precio Anterior', 0,'0','C');
$pdf->Cell(25, 8, 'Precio Actual', 0,'0','C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);


			
			
//CONSULTA POR FECHA
$productos = mysql_query("SELECT t1.descripcionProducto, t2.fechaPrecio, t2.precioAnterior, t2.precioActual FROM productos t1 LEFT JOIN precios t2 ON t1.idProducto = t2.idProducto
	 having t2.precioAnterior > 0 order by t2.fechaPrecio");
$item = 0;

while($productos2 = mysql_fetch_array($productos)){
	$item = $item+1;
	
	$pdf->Cell(15, 8, $item, 0);
	$pdf->Cell(80, 8,$productos2['descripcionProducto'], 0);
	$pdf->Cell(40, 8, $productos2['fechaPrecio'], 0,'0','C');
	$pdf->Cell(25, 8, '$ '.$productos2['precioAnterior'], 0,'0','C');
	$pdf->Cell(25, 8, '$ '.$productos2['precioActual'], 0,'0','C');
	$pdf->Ln(8);
}




$pdf->Output();
?>

