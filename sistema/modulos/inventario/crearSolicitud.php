<?php
require("conexion.php");
require("libs/fpdf17/fpdf.php");
$link = "";
$id = "";
$i=0;
class PDF extends FPDF{
	
}
if(isset($_GET["id"])&& $_GET["id"]!="")$id = $_GET["id"];
if($id!="")
{
//$arreglo = array();
$consulta = "call devuelveDetalle('$id')";
$link = Conexion();
$recurso = mysqli_query($link,$consulta);
if($recurso!=NULL)
{
	$pdf = new PDF();
	$pdf->AddPage("P","Legal");
	$pdf->SetFont('Times','',10);
	$pdf->Image('Solicitud.jpg' , 0 ,0, 210.59 , 350.56,'JPG');
	$y = 112;
	/*
	//seteamos la primera celda
	$pdf->SetXY(11.2,112);
	$pdf->Cell(23.5,10,'codigo',1,1,'C');
	
	//seteamos la 2da celda
	$pdf->SetXY(34.5,112);
	$pdf->Cell(25,10,'codigo2',1,1,'C');
	
	//seteamos la 3era celda
	$pdf->SetXY(59.5,112);
	$pdf->Cell(22.4,10,'codigo3',1,1,'C');
	
	//seteamos la 4ta celda
	$pdf->SetXY(82,112);
	$pdf->Cell(120.5,10,'codigo3',1,1,'C');
	
//vamos por la siguiente linea para determinar la altura de cada celda
	//2da linea primera celda
	$pdf->SetXY(11.2,122);
	$pdf->Cell(120.5,10,'codigo3',1,1,'C');
	//2da linea 3 2da celda
	$pdf->SetXY(11.2,132);
	$pdf->Cell(120.5,10,'codigo3',1,1,'C');
*/
while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
{
		//echo $fila[0];
		//$pdf->Cell(20,10,'Title',1,1,'C');
		//$i++;
		
		$pdf->SetXY(11.2,$y);
		$pdf->Cell(23.5,10,$fila[1],1,1,'C');
		
		//seteamos la 2da celda
		$pdf->SetXY(34.5,$y);
		$pdf->Cell(25,10,$fila[5],1,1,'C');
		
		//seteamos la 3era celda
		$pdf->SetXY(59.5,$y);
		$pdf->Cell(22.4,10,'',1,1,'C');
	
		//seteamos la 4ta celda
		$pdf->SetXY(82,$y);
		$pdf->Cell(120.5,10,'Item:' .$fila[2].',detalle:'.$fila[3].',costo ref:'.$fila[4],1,1,'C');
		$y = $y+10;
}
	$pdf->Output();
}
}
?>

<!-- aca va el formulario 
<form action="crearSolicitud.php" method="post">
<table align="center" width="500">
<tr>
<td>Numero:</td>
<td><?=$id?></td>
<td>Establecimiento:</td>
<td><input type="text" placeholder="establecimiento" name="establecimiento" /></td>
</tr>
<tr>
<td><input type="submit" value="crear" name="opcion" /></td>
<td><input type="reset" value="limpiar" name="opcion" /></td>
</tr>
</table>
</form>
-->