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



if(isset($_GET["opcion"])&& $_GET["opcion"])$opcion = $_GET["opcion"];
/*************************************/

/**************************/

/***************************/
if($opcion=="Conteo")
{
	$fila1="";
	$fila2="";
	$fila3="";
	
	$html = '<table  border="1" width="700"><tr><td>fecha-hora:</td><td>'.date("Y-m-d,h:m:s").'</td><td>Busqueda para:</td><td>'.$campo.'</td></tr>';
	$html .='<tr><td>CANTIDAD EQUIPOS</td><td>CANTIDAD IMPRESORAS</td><td>CANTIDAD DE DISP. DE RED</td></tr>';
	//<td>CANTIDAD IMPRESORAS</td><td>CANTIDAD DE DISP. DE RED</td>
	$link = Conexion();
	$conteoEquipo = "select equipo.EQ_IDEQUIPO from equipo";
	$recurso = mysqli_query($link,$conteoEquipo);
	$cantidadEquipos = mysqli_num_rows($recurso);
	$conteoImpresion = "select impresion.IM_IDIMPRESION from impresion";
	$recurso = mysqli_query($link,$conteoImpresion);
	$cantidadImpresoras = mysqli_num_rows($recurso);
	$conteoRed = "select red.RED_IDREDfrom red";
	$recurso = mysqli_query($link,$conteoImpresion);
	$cantidadDispositivos = mysqli_num_rows($recurso);
	
	$html .= '<tr>';
	$html .= '<td>'.$cantidadEquipos.'</td><td>'.$cantidadImpresoras.'</td><td>'.$cantidadDispositivos.'</td>';
	//<td>'.$fila2[0].'</td><td>'.$fila3[0].'</td>
	$html .= '</tr>';		
		
	ob_start();
	$pdf=new PDF();
	$pdf->SetFont('Arial','',8);
	$pdf->AddPage('L', 'Legal');
	$pdf->WriteHTML($html);
	$pdf->Output();
	//mysqli_close($link);
	//echo $html;
}
/***************************/
if($opcion=="Personas")
{
	$html = '<table  border="1" width="700" align="center" style="font:Arial; font-size:14px;border-width:1px;"><tr><td>fecha-hora:</td><td>'.date("Y-m-d,h:m:s").'</td><td>Busqueda para:</td><td>'.$campo.'</td></tr>';
	$html .='<tr><td>COD.</td><td>NOMBRE</td><td>APELLIDO</td><td>DIRECCION</td><td>RUT</td></tr>';
	$link = Conexion();
	$consultaSoftware = "call selectPersona()";
	$recurso = mysqli_query($link,$consultaSoftware);
	if($recurso!=NULL)
	{
		while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
		{
			$html .= '<tr>';
			$html .= '<td>'.$fila[0].'</td><td>'.$fila[1].'</td><td>'.$fila[2].'</td><td>'.$fila[3].'</td><td>'.$fila[4].'</td>';
			$html .= '</tr>';		
		}
	/*
		ob_start();
		$pdf=new PDF();
		$pdf->SetFont('Arial','',8);
		$pdf->AddPage('L', 'Legal');
		$pdf->WriteHTML($html);
		$pdf->Output();
		//mysqli_close($link);
	*/
	echo $html;
	echo '<center><input type="button" value="imprimir" onclick="window.print();"></center>';
	}
}
/**************************/
if($opcion=="Logs")
{
	//reporteObtenLog
	$html = '<table  border="1" width="700"><tr><td>fecha-hora:</td><td>'.date("Y-m-d,h:m:s").'</td><td>Busqueda para:</td><td>'.$campo.'</td></tr>';
	$html .='<tr><td>fecha</td><td>ip</td><td>observacion</td><td>usuario</td><td>nombre</td><td>apellido</td><td>rut</td></tr>';
	$link = Conexion();
	$consultaSoftware = "call reporteObtenLog()";
	$recurso = mysqli_query($link,$consultaSoftware);
	if($recurso!=NULL)
	{
		while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
		{
			$html .= '<tr>';
			$html .= '<td>'.$fila[0].'</td><td>'.$fila[1].'</td><td>'.$fila[2].'</td><td>'.base64_decode($fila[3]).'</td><td>'.$fila[4].'</td><td>'.$fila[5].'</td><td>'.$fila[6].'</td>';
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
/*************************/
if($opcion=="Completo")
{
	//reporteObtenLog
	$html = '<table  border="1" width="700"><tr><td>fecha-hora:</td><td>'.date("Y-m-d,h:m:s").'</td><td>Busqueda para:</td><td>'.$campo.'</td></tr>';
	$html .='<tr><td>fecha</td><td>ip</td><td>observacion</td><td>usuario</td><td>nombre</td><td>apellido</td><td>rut</td></tr>';
	$link = Conexion();
	$consultaSoftware = "call ";
	$recurso = mysqli_query($link,$consultaSoftware);
	if($recurso!=NULL)
	{
		while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
		{
			$html .= '<tr>';
			$html .= '<td>'.$fila[0].'</td><td>'.$fila[1].'</td><td>'.$fila[2].'</td><td>'.base64_decode($fila[3]).'</td><td>'.$fila[4].'</td><td>'.$fila[5].'</td><td>'.$fila[6].'</td>';
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
?>