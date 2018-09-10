<?php
require("conexion.php");
$recurso = NULL;
$link = Conexion();

$idx = "";
$categoria ="";

$glosa = "";
$resolucion = "";

$opcion = "";

if(isset($_POST["idx"]) && $_POST["idx"]!="")$idx = $_POST["idx"];
if(isset($_POST["categoria"]) && $_POST["categoria"]!="")$categoria = $_POST["categoria"];

if(isset($_POST["glosa"]) && $_POST["glosa"]!="")$glosa = $_POST["glosa"];
if(isset($_POST["resolucion"]) && $_POST["resolucion"]!="")$resolucion = $_POST["resolucion"];

if(isset($_POST["opcion"]) && $_POST["opcion"]!="")$opcion = $_POST["opcion"];

print_r($_POST);

if($opcion!="")
{
	if($categoria=="informe" || $categoria=="orden")
	{
		$updateInforme = "update taller set taller.TA_FEJECUCION=NOW(),taller.TA_ESTADO='finalizado',
		taller.TA_GLOSAFINAL='$glosa',taller.TA_ESTADOFINALREP='$resolucion' where taller.TA_IDTALLER='$idx'";
		$recurso=mysqli_query($link,$updateInforme);
		if($recurso!=NULL)
		{
			header("Location:cargarPendientes.php?mensaje=actualizado");
			exit();
		}
	}
	/*
	if($categoria=="orden")
	{
		$updateInforme = "update taller set taller.TA_FEJECUCION=NOW(),taller.TA_ESTADO='finalizado',
		taller.TA_GLOSAFINAL='$glosa',taller.TA_ESTADOFINALREP='$resolucion' where taller.TA_IDTALLER='$idx'";
		$recurso=mysqli_query($link,$updateInforme);
		if($recurso!=NULL)
		{
			header("Location:cargarPendientes.php?mensaje=actualizado");
			exit();
		}
	}
	*/
mysqli_close($link);
}
?>