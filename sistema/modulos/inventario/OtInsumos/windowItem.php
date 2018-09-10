<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
require("funciones.php");
//session_name("items");
//session_start();
error_reporting(E_ALL);
//actualizar campo

$idItem="";
$nbitem="";
$costo="";
$cantidad="";


//recogemos las variables
if(isset($_POST["iditem"]) && $_POST["iditem"]!="")$idItem = $_POST["iditem"];
if(isset($_POST["codigox"]) && $_POST["codigox"]!="")$codigox = $_POST["codigox"];
if(isset($_POST["nbitem"]) && $_POST["nbitem"]!="")$nbitem = $_POST["nbitem"];
if(isset($_POST["costo"]) && $_POST["costo"]!="")$costo = $_POST["costo"];
if(isset($_POST["cantidad"]) && $_POST["cantidad"]!="")$cantidad = $_POST["cantidad"];
if(isset($_POST["opcion"]) && $_POST["opcion"]!="")$opcion = $_POST["opcion"];

//declaracion de variables
if($idItem!="" && $nbitem!="" && $costo!="" && $cantidad!="" && $opcion!="" && $opcion=="agregar")
{
//aca comienza la insercion del item
	agregar($idItem,$nbitem,$costo,$cantidad);
	echo "<script type='text/javascript'>
	alert('producto agregado exitosamente');
	window.opener.document.getElementById('framex').src = 'mostrarLista.php';
	window.close();
	</script>";
	//header("Location: windowItem.php?mensaje=el item ha sido agregado al detalle");
	////window.close();
	//window.opener.location.reload();
	//exit();
}
//$_POST = array();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>escoger item</title>
</head>
<body>
<form method="post" action="windowItem.php" onsubmit="javascript:activar();">
<?php
require("conexion.php");
$link = Conexion();
$recurso = NULL;
$id = array();
$codigox = array();
$nombre = array();
//$detalle = array();
$costo = array();
$cantidad = array();

$devuelveInsumo = "call selectInsumo()";
$recurso = mysqli_query($link,$devuelveInsumo);
if($recurso!=NULL)
{
	$i = 0;
	while($resultado = mysqli_fetch_array($recurso,MYSQLI_NUM)){
		$id[$i] = $resultado[0];
		$codigox[$i] = $resultado[1];
		$nombre[$i] = $resultado[2];
		$costo[$i] = $resultado[5];
		$i++;	
	}
}
mysqli_close($link);
?>
<table align="center">
<tr>
<td style="color:#000;">codigo item:</td>
<td style="color:#000;">
<select name="iditem" id="iditem" disabled="disabled">
<option value="" selected="selected">Seleccione</option>
<?php
for($i=0;$i<count($id);$i++)echo "<option value='".$id[$i]."'>".$id[$i]."</option>"
?>
</select>
</td>
</tr>
<tr>
<td>codigo externo:</td>
<td>
<select name="codigox" id="codigox" disabled="disabled">
<option value="" selected="selected">Seleccione</option>
<?php
for($i=0;$i<count($codigox);$i++)echo "<option value='".$codigox[$i]."'>".$codigox[$i]."</option>"
?>
</select>
</td>
</tr>
<tr>
<td style="color:#000;">nombre item:</td>
<td style="color:#000;">
<select name="nbitem" id="nbitem" onchange="javascript:selected();">
<option value="" selected="selected">Seleccione</option>
<?php
for($i=0;$i<count($nombre);$i++)echo "<option value='".$nombre[$i]."'>".$nombre[$i]."</option>"
?>
</select>
seleccione aqui.
</td>
</tr>
<tr>
<td style="color:#000;">costo:</td>
<td style="color:#000;">
<select name="costo" id="costo" disabled="disabled">
<option value="" selected="selected">Seleccione</option>
<?php
for($i=0;$i<count($costo);$i++)echo "<option value='".$costo[$i]."' style='color:#000;'>".$costo[$i]."</option>"
?>
</select>
</td>
</tr>
<tr>
<td style="color:#000;">cantidad requerida:</td>
<td style="color:#000;"><input type="text" size="25" name="cantidad" value="" /></td>
</tr>
<tr>
<td colspan="2" style="text-align:center;text-transform:uppercase;">
<?php
if(isset($_GET["mensaje"])&& $_GET["mensaje"]!="")echo $_GET["mensaje"];
?>
</td>
</tr>
<tr>
<td style="color:#000;"><input type="submit" name="opcion" value="agregar" /></td>
<td style="color:#000;"><input type="button" name="opcion" value="limpiar" onclick="javascript:window.location='windowItem.php';"/>
</tr>
</table>
<?php
//mostrar();
?>
<script type="text/javascript">
function selected()
{
	controlador = document.getElementById("nbitem");
    itemx = document.getElementById("iditem");
	codigox = document.getElementById("codigox");
	costo = document.getElementById("costo");
    itemx.disabled = false;
	codigox.disabled=false;
    costo.disabled = false;
	//ahora debemos setear el asunto
    itemx.selectedIndex = controlador.selectedIndex;
	codigox.selectedIndex = controlador.selectedIndex;
    costo.selectedIndex = controlador.selectedIndex;
    //alert('es real la seleccion');
    //alert('la opcion escogida es:' + controlador.selectedIndex);
    itemx.disabled = true;
	codigox.disabled=true;
    costo.disabled = true;
}
function activar()
{
	
	itemx = document.getElementById("iditem");
	codigox=document.getElementById("codigox");
	costo = document.getElementById("costo");
	itemx.disabled = false;
	codigox.disabled=false;
    costo.disabled = false;
	
}
</script>
</body>
<style type="text/css">
</style>
</html>