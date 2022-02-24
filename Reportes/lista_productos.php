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
$pdf->Cell(100, 8, 'LISTADO DE PRODUCTOS', 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 8, 'Item', 0);
$pdf->Cell(80, 8, 'Descripcion', 0);
$pdf->Cell(40, 8, 'Codigo de Barras', 0,'0','C');
$pdf->Cell(25, 8, 'Stock', 0,'0','C');
$pdf->Cell(25, 8, 'Precio Venta', 0,'0','C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);


			
			
//CONSULTA

$productos = mysql_query("select  t1.descripcionProducto, t1.codigoBarras, t1.precioVenta, t2.stockGeneral from productos t1
left join stockgeneral t2 on t1.idProducto = t2.idProducto
");
$item = 0;
$totaluni = 0;
while($productos2 = mysql_fetch_array($productos)){
	$item = $item+1;
	$totaluni = $totaluni + $productos2['stockGeneral'];
	$pdf->Cell(15, 8, $item, 0);
	$pdf->Cell(80, 8,$productos2['descripcionProducto'], 0);
	$pdf->Cell(40, 8, $productos2['codigoBarras'], 0,'0','C');
	$pdf->Cell(25, 8, $productos2['stockGeneral'], 0,'0','C');
	$pdf->Cell(25, 8, '$ '.$productos2['precioVenta'], 0,'0','C');
	$pdf->Ln(8);
}

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(114,8,'',0);
$pdf->Cell(31,8,'Cantidad Total: '.$totaluni,0);

$pdf->Cell(114,8,'',0);



$pdf->Output();
?>