<?php


$fecha = $_GET['fecha'];
$porcentaje = $_GET['porcentaje'];



//$number = (string)$porcentaje;
//$porcentaje_final = str_replace('', '', $number);



//echo $porcentaje_final;


require('../fpdf/fpdf.php');

$conexion = mysql_connect('localhost', 'root', 'Ramses2005*');
mysql_select_db('pantalon', $conexion);




$pdf = new FPDF();


$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 

		


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
$pdf->Cell(70, 8, 'Comisiones Vendedores ' ,  0);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(80, 8, '', 0);	
$pdf->Cell(80, 8, ''.$meses[date('n')-1]. ' '. 'de'. ' ' .date('Y').' ' , 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(30, 8, 'Num. Vendedor', 0, '0','C');
$pdf->Cell(30, 8, 'Nombre Vendedor', 0,'0','C');
$pdf->Cell(30, 8, 'Sucursal', 0,'0','C');
$pdf->Cell(30, 8, 'Cantidad Ventas', 0,'0','C');
$pdf->Cell(30, 8, 'Ventas Totales', 0,'0','C');
$pdf->Cell(30, 8, 'Comision', 0,'0','C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);


			



$productos = mysql_query("SELECT t1.numeroVendedores, t1.nombreVendedores, t2.nombreSucursal, sum(t3.subTotalVenta) as suma, t2.idSucursal, t1.idVendedores,COUNT(t3.idVenta) as ventas from vendedores t1 
				inner join sucursal t2 on t1.idSucursal = t2.idSucursal
				inner join venta t3 on t1.idVendedores = t3.idVendedor 
				where MONTH(t3.fechaVenta) = $fecha
				group by t1.idVendedores
				order by t1.numeroVendedores DESC
			");


$comision = 0;


while($productos2 = mysql_fetch_array($productos)){
	
	$comision = $productos2['suma'] * $porcentaje/100;


	$pdf->Cell(30, 8, $productos2['numeroVendedores'], 0,'0','C');
	$pdf->Cell(30, 8, $productos2['nombreVendedores'], 0,'0','C');
	$pdf->Cell(30, 8, $productos2['nombreSucursal'], 0,'0','C');
	$pdf->Cell(30, 8, $productos2['ventas'], 0,'0','C');
	$pdf->Cell(30, 8, '$ ' .$productos2['suma'], 0,'0','C');
	$pdf->Cell(30, 8, '$ '.number_format($comision,'2'),0,'0','C');

	

	$pdf->Ln(8);
}


$pdf->Cell(114,8,'',0);



$pdf->Output('I');
?>