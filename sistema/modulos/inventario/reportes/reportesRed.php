<?php
require("control.php");
require("conexion.php");
require('../libs/html_table.php');
$campo = "";
$opcion="";
$recurso = NULL;
$html = "";
/*
$html='<table border="1" width="600">
<tr>
<td width="200" height="30">cell 1</td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
</tr>
<tr>
<td width="200" height="30">cell 3</td><td width="200" height="30">cell 4</td>
</tr>
</table>';
*/


if(isset($_GET["campo"])&& $_GET["campo"])$campo = $_GET["campo"];
if(isset($_GET["opcion"])&& $_GET["opcion"])$opcion = $_GET["opcion"];
/*************************************/
if($opcion=="software")
{
	$html = '<table  border="1" width="700"><tr><td>fecha-hora:</td><td colspan="5">'.date("Y-m-d,h:m:s").'</td></tr>';
	$html .='<tr><td>codigo</td><td>serie eq.</td><td>modelo</td><td>nombre</td><td>tipo</td><td width="200">nro. lic.</td></tr>';
	$link = Conexion();
	$consultaSoftware = "call ()";
	$recurso = mysqli_query($link,$consultaSoftware);
	if($recurso!=NULL)
	{
		while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
		{
			$html .= '<tr>';
			$html .= '<td>'.$fila[0].'</td><td>'.$fila[1].'</td><td>'.$fila[2].'</td><td>'.$fila[3].'</td><td>'.$fila[4].'</td><td width="200">'.$fila[5].'</td>';
			$html .= '</tr>';		
		}
		ob_start();
		$pdf=new PDF();
		$pdf->SetFont('Arial','',8);
		$pdf->AddPage('L', 'Legal');
		$pdf->WriteHTML($html);
		$pdf->Output();
		//mysqli_close($link);
	}
}
/**************************/
if($opcion=="Datosubicacion")
{
	$html = '<table  border="1" width="700"><tr><td>fecha-hora:</td><td colspan="5">'.date("Y-m-d,h:m:s").'</td></tr>';
	$html .='<tr><td>modelo</td><td>serie</td><td>mac</td><td>Sala</td><td>Piso</td><td>tipo sala</td></tr>';
	$link = Conexion();
	$consultaSoftware = "call reporteUbicacionRed()";
	$recurso = mysqli_query($link,$consultaSoftware);
	if($recurso!=NULL)
	{
		while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
		{
			$html .= '<tr>';
			$html .= '<td>'.$fila[0].'</td><td>'.$fila[1].'</td><td>'.$fila[2].'</td><td>'.$fila[3].'</td><td>'.$fila[4].'</td><td>'.$fila[5].'</td>';
			$html .= '</tr>';		
		}
		ob_start();
		$pdf=new PDF();
		$pdf->SetFont('Arial','',8);
		$pdf->AddPage('L', 'Legal');
		$pdf->WriteHTML($html);
		$pdf->Output();
		//mysqli_close($link);
	}
}
/***************************/
if($opcion=="DatosTecnicos")
{
	$html = '<table  border="1" width="700"><tr><td>fecha-hora:</td><td>'.date("Y-m-d,h:m:s").'</td><td>Busqueda para:</td><td>'.$campo.'</td></tr>';
	$html .='<tr><td>modelo</td><td>serie</td><td>mac</td><td>bocas</td><td>ip-inicial</td><td>mascara</td><td>pta enlace</td><td>tipo.</td><td>marca</td></tr>';
	$link = Conexion();
	$consultaSoftware = "call reporteTecnicoRed()";
	$recurso = mysqli_query($link,$consultaSoftware);
	if($recurso!=NULL)
	{
		while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
		{
			$html .= '<tr>';
			$html .= '<td>'.$fila[0].'</td><td>'.$fila[1].'</td><td>'.$fila[2].'</td><td>'.$fila[3].'</td><td>'.$fila[4].'</td><td>'.$fila[5].'</td>
			<td>'.$fila[6].'</td><td>'.$fila[7].'</td><td>'.$fila[8].'</td>';
			$html .= '</tr>';		
		}
		ob_start();
		$pdf=new PDF();
		$pdf->SetFont('Arial','',8);
		$pdf->AddPage('L', 'Legal');
		$pdf->WriteHTML($html);
		$pdf->Output();
		//mysqli_close($link);
	}
}
/***************************/
if($opcion=="Busqueda")
{
	$html = '<table  border="1" width="700"><tr><td>fecha-hora:</td><td>'.date("Y-m-d,h:m:s").'</td><td>Busqueda para:</td><td>'.$campo.'</td></tr>';
	$html .='<tr><td>codigo</td><td>serie</td><td>modelo</td><td></td><td>estado</td><td>creado</td><td>ingresado</td></tr>';
	$link = Conexion();
	$consultaSoftware = "call reporteBusquedaImpresion('$campo')";
	$recurso = mysqli_query($link,$consultaSoftware);
	if($recurso!=NULL)
	{
		while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
		{
			$html .= '<tr>';
			$html .= '<td>'.$fila[0].'</td><td>'.$fila[3].'</td><td>'.$fila[5].'</td><td>'.$fila[8].'</td><td>'.$fila[9].'</td><td>'.$fila[10].'</td>';
			$html .= '</tr>';		
		}

		ob_start();
		$pdf=new PDF();
		$pdf->SetFont('Arial','',8);
		$pdf->AddPage('L', 'Legal');
		$pdf->WriteHTML($html);
		$pdf->Output();
		//mysqli_close($link);
	}
}
/**************************/
if($opcion=="Completo")
{
	
}
/*************************/
?>