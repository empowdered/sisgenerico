<?php
require("conexion.php");
$link = Conexion();
$recurso = NULL;
$categoria ="";

$idequipo = "";
$idimpresora= "";
$idred = "";

$idusuario = "";
$detalle="";
$categoria = "";
$defecto = "";
$diagnostico = "";

$select = "";

$opcion ="";
$ideq ="";
$idr = "";
$idim = "";
//aca tomamos la opcion y la categoria


if(isset($_POST["categoria"]) && $_POST["categoria"]!="")$categoria= $_POST["categoria"];
if(isset($_POST["idequipo"]) && $_POST["idequipo"]!="")$idequipo= $_POST["idequipo"];
if(isset($_POST["idimpresora"]) && $_POST["idimpresora"]!="")$idimpresora= $_POST["idimpresora"];
if(isset($_POST["idred"]) && $_POST["idred"]!="")$idred= $_POST["idred"];
if(isset($_POST["idusuario"]) && $_POST["idusuario"]!="")$idusuario= $_POST["idusuario"];

if(isset($_POST["detalle"]) && $_POST["detalle"]!="")$detalle= $_POST["detalle"];
if(isset($_POST["defecto"]) && $_POST["defecto"]!="")$defecto= $_POST["defecto"];
if(isset($_POST["diagnostico"]) && $_POST["diagnostico"]!="")$diagnostico= $_POST["diagnostico"];

if(isset($_POST["opcion"]) && $_POST["opcion"]!="")$opcion = $_POST["opcion"];



if($idequipo!="")$select ="equipo";
if($idimpresora!="")$select ="impresora";
if($idred!="")$select ="red";

if($idequipo=="")$idequipo="NULL";
if($idimpresora=="")$idimpresora="NULL";
if($idred=="")$idred="NULL";
if($idusuario=="")$idusuario="NULL";

if($defecto=="")$defecto="no definido";
if($diagnostico=="")$diagnostico="no definido";

print_r($_POST);

echo "<br>id equipo:".$idequipo;
echo "<br>id impresora:".$idimpresora;
echo "<br>id red:".$idred;
echo "<br>id usuario:".$idusuario;
echo "<br>detalle:".$detalle;
echo "<br>categoria o motivo:".$categoria;
echo "<br>Defecto:".$defecto;
echo "<br>Diagnostico:".$diagnostico;

echo "<br>opcion:".$opcion;


if($opcion!="" && $opcion=="Guardar" && $categoria=="informe")
{

	/*
	insertaTaller(idequipo int, idimpresion int,idred int,idusuario int,descripcion varchar(200),motivo varchar(50),defecto varchar(100),diagnostico varchar(200),estado varchar(50))
	*/
	
	
	$Guardar = "call insertaTaller($idequipo,$idimpresora,$idred,$idusuario,'$detalle','$categoria','$defecto','$diagnostico','pendiente')";
	$recurso = mysqli_query($link,$Guardar);
	if($recurso!=NULL)
	{
		$resultado=mysqli_fetch_row($recurso);
		if($resultado[0]=="ok")
		{
			$id=$resultado[0];
			header("Location:nuevaFicha.php?mensaje=ficha creada correctamente.con el siguiente codigo interno: " .$id);
			exit();	
		}
		else if($resultado[0]=="no")
		{
			header("Location:nuevaFicha.php?mensaje=no se puede crear un nuevo informe, sobre otro ya existente");
			exit();
		}
	}
}
if($opcion!="" && $opcion=="Ejecutar" && $categoria=="orden")
{
	
	if($idequipo!="NULL")
	{
		$ideq = $idequipo;
		$idim = 0;
		$idr = 0;
	}
	
	if($idimpresora!="NULL")
	{
		$idim = $idimpresora;
		$ideq = 0;
		$idred= 0;
	}
	
	if($idred!="NULL")
	{
		$idr=$idred;
		$ideq = 0;
		$idim = 0;
	}
	echo $consultarExistente = "call consultaExistentePendiente('$ideq','$idim','$idr')";
	
	$recurso = mysqli_query($link,$consultarExistente);
	$fila = mysqli_fetch_row($recurso);
	
	if($fila[0]=="si"){
		header("Location: nuevaFicha.php?mensaje=no se puede crear OT, sobre una ya existente");exit();
	}
	else if($fila[0]=="no")
	{
	$recurso = NULL;
	
	$Ejecutar = "call insertaTaller2($idequipo,$idimpresora,$idred,$idusuario,'$detalle','$categoria','$defecto','$diagnostico','pendiente','$select')";
	$link = Conexion();
	$recurso = mysqli_query($link,$Ejecutar);
	
	if($recurso!=NULL)
	{
		$resultado=mysqli_fetch_row($recurso);
		$id=$resultado[0];
		$recurso=NULL;
		
		$arreglo = devuelveDetalle();
		
		for($i=0;$i<count($arreglo);$i++)
		{	
			echo "<br>".$insertarDetalle = "call insertaDetalle(".$id.",".$arreglo[$i][0].",".$arreglo[$i][1].")";
			$link = Conexion();
			$recurso = mysqli_query($link,$insertarDetalle);
			if($recurso==NULL)
			{
				header("Location:crearFicha.php?mensaje=error al crear");	
				//echo "<br>error!!!";
				exit();	
			}
			$recurso = NULL;
			mysqli_close($link);
		}
		destruirItems();
		header("Location:nuevaFicha.php?mensaje=orden de trabajo creada correctamente, codigo interno" . $id);
		exit();	
	}
	}
}
if($opcion!="" && $opcion=="Ejecutar" && $categoria=="sep")
{
	$Ejecutar = "call insertaSep('$idequipo','$idusuario','$detalle','$categoria','pendiente')";
	$recurso = mysqli_query($link,$Ejecutar);
	if($recurso!=NULL)
	{
		$resultado=mysqli_fetch_row($recurso);
		$id=$resultado[0];
		
		$recurso=NULL;
		
		$arreglo = devuelveDetalle();
		
		for($i=0;$i<count($arreglo);$i++)
		{	
			echo "<br>".$insertarDetalle = "call insertaDetalle(".$id.",".$arreglo[$i][0].",".$arreglo[$i][1].")";
			$link = Conexion();
			$recurso = mysqli_query($link,$insertarDetalle);
			if($recurso==NULL)
			{
				header("Location:crearFicha.php?mensaje=error al crear");	
				echo "<br>error!!!";
				exit();	
			}
			$recurso = NULL;
			mysqli_close($link);
		}
		destruirItems();
		header("Location:nuevaFicha.php?mensaje=orden especial sep creada correctamente, codigo interno" . $id);
		exit();	
	}
}
function devuelveDetalle()
{	
	$ids = array();
	session_name("items");
	session_start();
	if($_SESSION["cantidad"]==0)
	{
		header("Location: nuevaFicha.php?mensaje=no hay items para ingresar como detalle de la orden");
		exit();	
	}
	else
	{
		for($i=0;$i<$_SESSION["cantidad"];$i++)
		{
			if($_SESSION["item"][$i][0]!=0)
			{
				$ids[$i] = 	array($_SESSION["item"][$i][0],$_SESSION["item"][$i][3]);
			}
		}
	}
	return $ids;
}
function destruirItems()
{
session_name("items");
session_start();
unset($_SESSION);
session_destroy();
}
?>