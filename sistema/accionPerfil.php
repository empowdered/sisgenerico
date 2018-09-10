<?php
require("conexion.php");

$recurso = NULL;
$link = "";
$idPersona = "";

$nombre ="";
$apellido ="";
$direccion ="";
$rutpers ="";
$idperfil ="";
$nbusuario ="";
$correo ="";
$claveusu ="";
$observacion = "";

$opcion = "";


if(isset($_POST["nombre"]) && $_POST["nombre"]!="")$nombre=$_POST["nombre"];

if(isset($_POST["apellido"]) && $_POST["apellido"]!="")$apellido=$_POST["apellido"];

if(isset($_POST["direccion"]) && $_POST["direccion"]!="")$direccion=$_POST["direccion"];

if(isset($_POST["rutpers"]) && $_POST["rutpers"]!="")$rutpers=$_POST["rutpers"];

if(isset($_POST["idperfil"]) && $_POST["idperfil"]!="")$idperfil=$_POST["idperfil"];

if(isset($_POST["nbusuario"]) && $_POST["nbusuario"]!="")$nbusuario=base64_encode($_POST["nbusuario"]);

if(isset($_POST["correo"]) && $_POST["correo"]!="")$correo=$_POST["correo"];

if(isset($_POST["claveusu"]) && $_POST["claveusu"]!="")$claveusu=base64_encode($_POST["claveusu"]);

if(isset($_POST["observacion"]) && $_POST["observacion"]!="")$observacion=$_POST["observacion"];

if(isset($_POST["opcion"]) && $_POST["opcion"]!="")$opcion=$_POST["opcion"];

print_r($_POST);

if($opcion!="" && $opcion=="crear")
{
	$link = Conexion();
	echo "<br>".$crearP = "call crearPerfil2('$nombre','$apellido','$direccion','$rutpers','$idperfil','$nbusuario'
	,'$correo','$claveusu','$observacion')";
	$recurso = mysqli_query($link,$crearP);
	if($recurso!=NULL)
	{
	  	$fila = mysqli_fetch_row($recurso);
		if($fila[0]=="ok")
		{
			header("Location: crearPerfil.php?mensaje=usuario creado exitosamente");
		}
	}
	
}
?>