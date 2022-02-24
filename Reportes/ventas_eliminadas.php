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
$pdf->Cell(100, 8, 'LISTADO DE VENTAS ELIMINADAS', 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 8, 'Item', 0);
$pdf->Cell(15, 8, 'Vendedor', 0);
$pdf->Cell(80, 8, 'Producto', 0,'0','C');
$pdf->Cell(40, 8, 'Motivo Anulacion', 0,'0','C');
$pdf->Cell(25, 8, 'Fecha', 0,'0','C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);


			
			
//CONSULTA
$productos = mysql_query("SELECT t1.motivoAnulacion, t1.fechaAnulacion, t2.descripcionProducto, t3.nombreVendedores,COUNT(t1.idVentasEliminadas) as total
FROM ventaseliminadas t1
INNER JOIN productos t2 ON t1.idProducto = t2.idProducto
INNER JOIN vendedores t3 ON t1.idVendedores = t3.idVendedores
GROUP BY t1.idVentasEliminadas
ORDER BY t1.fechaAnulacion");
$item = 0;
$totaluni = 0;
while($productos2 = mysql_fetch_array($productos)){
	$item = $item+1;
	$totaluni = $totaluni + $productos2['total'];
	$pdf->Cell(15, 8, $item, 0);
	$pdf->Cell(15, 8,$productos2['nombreVendedores'], 0);
	$pdf->Cell(80, 8, $productos2['descripcionProducto'], 0,'0','C');
	$pdf->Cell(40, 8, $productos2['motivoAnulacion'], 0,'0','C');
	$pdf->Cell(25, 8, $productos2['fechaAnulacion'], 0,'0','C');
	$pdf->Ln(8);
}

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(114,8,'',0);
$pdf->Cell(31,8,'Cantidad Anulaciones: '.$totaluni,0);

$pdf->Cell(114,8,'',0);



$pdf->Output();
?>