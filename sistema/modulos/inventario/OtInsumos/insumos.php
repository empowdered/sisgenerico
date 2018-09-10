<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../mantenedores/libs/Zebra_Pagination-master/public/css/zebra_pagination.css" />
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css"/>
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>insumos</title>
</head>
<?php
require("conexion.php");
$recurso = NULL;
$link = "";

$id = "";
$opcion = "";
$cargar = "";

$nbinsumo = "";
$codigox = "";
$detalleinsumo = "";
$costo = "";
$fcreacion = "";

if(isset($_POST["id"]) && $_POST["id"]!="")$id = $_POST["id"];
if(isset($_GET["id"]) && $_GET["id"]!="")$id = $_GET["id"];
if(isset($_GET["cargar"]) && $_GET["cargar"]!="")$cargar = $_GET["cargar"];

if($id!="" && $cargar!="" && $cargar=="cargarDatos")
{
	$link = Conexion();
	$recuperar = "call recuperaInsumo('$id')";
	$recurso = mysqli_query($link,$recuperar);
	if($recurso!=NULL)
	{
		$resultado = mysqli_fetch_row($recurso);
		
		$id= $resultado[0];
		$codigox = $resultado[1];
		$nbinsumo = $resultado[2];
		$detalleinsumo = $resultado[3];
		$fcreacion = $resultado[4];
		$costo = $resultado[5];
		mysqli_close($link);
	}
}
if($id!="" && $cargar!="" && $cargar=="borrarDatos")
{
	$link = Conexion();
	$borrar = "delete from insumos where insumos.INS_IDINSUMO='$id'";
	$recurso = mysqli_query($link,$borrar);
	if($recurso!=NULL)
	{
		mysqli_close($link);
		header("Location:insumos.php?mensaje=borrado del registro exitosa!!");
		exit();
	}
}
if(isset($_POST["codigox"]) && $_POST["codigox"]!="")$codigox = $_POST["codigox"];
if(isset($_POST["nbinsumo"]) && $_POST["nbinsumo"]!="")$nbinsumo = $_POST["nbinsumo"];
if(isset($_POST["detalleinsumo"]) && $_POST["detalleinsumo"]!="")$detalleinsumo = $_POST["detalleinsumo"];
if(isset($_POST["costo"]) && $_POST["costo"]!="")$costo = $_POST["costo"];
if(isset($_POST["opcion"]) && $_POST["opcion"]!="")$opcion = $_POST["opcion"];

if($codigox!="" && $nbinsumo!="" && $detalleinsumo!="" && $costo!="" && $opcion!="")
{
	if($opcion=="crear")
	{
		$link = Conexion();
		$crearInsumo="call insertaInsumo('$codigox','$nbinsumo','$detalleinsumo','$costo')";
		$recurso = mysqli_query($link,$crearInsumo);
		if($recurso)
		{
			$resultado = mysqli_fetch_row($recurso);
			if($resultado[0]=="ok"){
				mysqli_close($link);
				header("Location:insumos.php?mensaje=creacion del insumo exitosa!!");
				exit();
			}else{
				mysqli_close($link);
				header("Location:insumos.php?mensaje=error en la creacion!!");
				exit();	
			}
			
		}
	}
	if($id!="" && $opcion=="actualizar")
	{
		$link = Conexion();
		$actualizarInsumo="call actualizaInsumo('$id','$codigox','$nbinsumo','$detalleinsumo','$costo')";
		$recurso = mysqli_query($link,$actualizarInsumo);
		if($recurso)
		{
			$resultado = mysqli_fetch_row($recurso);
			if($resultado[0]=="ok"){
				mysqli_close($link);
				header("Location:insumos.php?mensaje=actualizacion del insumo exitosa!!");
				exit();
			}else{
				mysqli_close($link);
				header("Location:insumos.php?mensaje=error en la actualizacion del insumo");
				exit();	
			}
			
		}
	}
}
?>
<body>
<div class="container">
	<!-- aca le colocamos una cabecera, para que se vea mas lindo -->
	<div class="row text-center" id="cabecera">
    		<h4>FICHA DE GESTI&Oacute;N</h4>
    </div>
 <div class="row text-center" id="opciones">
    <div class="col-xs-2">
        <a href="index.php" accesskey="i">|
            <img src="../iconos/1434153087_kfm_home.png" height="18" width="18"/> ir a inicio
        </a>|
    </div>
    <div class="col-xs-2">
        <a href="pendientes.php" accesskey="p">|
            <img src="../iconos/1434153758_lists.png" height="18" width="18"/> pendientes
        </a>|
    </div>
    <div class="col-xs-2">
        <a href="nuevaFicha.php" accesskey="c">|
            <img src="../iconos/1434154526_txt2.png" height="18" width="18"/> crear nuevo
        </a>|
    </div>
    <div class="col-xs-2">
        <a href="historico.php" accesskey="h">|
            <img src="../iconos/1434154704_order-history.png" height="18" width="18"/> historico
        </a>|
    </div>
      <div class="col-xs-2">
        <a href="insumos.php" accesskey="i">|
            <img src="../iconos/1434153137_package_utilities.png" height="18" width="18"/> insumos
        </a>|
    </div>
      <div class="col-xs-2">|
        <a href="#" accesskey="c" onclick="javascript:window.close();">
            <img src="../iconos/1434155196_user_close_security.png" height="18" width="18"/> cerrar
        </a>|
        
    </div>
 </div>
 <div class="row">
 <div class="col-xs-4"></div>
    <div class="col-xs-4 text-center" id="contenido">
    <hr />
       <form action="insumos.php" method="post">
       <input type="hidden" name="id" value="<?=$id?>" />
       <table  border="0" cellspacing="1" cellpadding="1" id="tablaOt" align="center" width="300">
        <th colspan="3" style="text-align:center;">
        mantenedor de insumos
        </th>
    	<tr>
        <tr>
        <td>Nombre insumo:</td>
        <td><input type="text" size="25" name="nbinsumo" value="<?=$nbinsumo?>" /></td>
        <td></td>
        </tr>
       
    	  <tr>
         <tr>
        <td valign="top">Detalles:</td>
        <td>
        <textarea cols="30" rows="5" name="detalleinsumo" id="detalleinsumo"><?=rtrim($detalleinsumo)?></textarea>
        </td>
        <td></td>
        </tr>
        <tr><td>codigo:</td><td><input type="text" name="codigox" value="<?=$codigox?> "size="25" /></td></tr>
         <tr>
        <td>Costo:</td>
        <td><input type="text" name="costo" size="25" value="<?=$costo?>" /></td>
        <td></td>
        </tr>
        <tr> <tr>
        <td>fecha creacion:</td>
        <td><input type="text" name="fcreacion" size="25" value="<?=$fcreacion?>" readonly="readonly"/></td>
        <td></td>
        </tr>
        <tr>
        <td colspan="3" class="text-center text-alert">
        <?php if(isset($_GET["mensaje"])&& $_GET["mensaje"]!="")echo $_GET["mensaje"];?>
        </td>
        </tr>
    	  <tr>
        <td colspan="3">
        <input name="opcion" type="submit" value="crear" class="btn btn-default btn-sm"/>
            <input name="opcion" type="submit" value="actualizar" class="btn btn-default btn-sm"/>
            <input name="opcion" type="reset" value="limpiar" class="btn btn-default btn-sm" onclick="javascript:window.location='insumos.php';"/>
        </td>
        </tr>
  </table>
       </form>
       <hr />
    </div>
    <div class="col-xs-4"></div>
 </div>
 <?php
 $cant_pagina = 3;

require_once("../mantenedores/libs/Zebra_Pagination-master/Zebra_Pagination.php");
$paginadorZebra = new Zebra_Pagination();
$cantidadRegistros = mysqli_num_rows(mysqli_query(Conexion(),"select insumos.INS_IDINSUMO from insumos"));

$paginar_resultados = "select * from insumos order by INS_IDINSUMO  limit " . (( $paginadorZebra->get_page() - 1 ) * $cant_pagina ) . ",  " . $cant_pagina;

$paginadorZebra->records($cantidadRegistros);
$paginadorZebra->records_per_page($cant_pagina);
?>
 <hr />
 <div class="row">
    	<div class="col-xs-12" id="despliegue">
            <table align="center" class="table-hover" width="600" style="font-size:12px;">
<th colspan="5" class="text-center">listado de insumos</th>
<tr>
<td>codigo interno</td><td>codigo externo</td>
<td>nombre especifico</td>
<td>descripcion</td>
<td colspan="3">opciones</td>
</tr>
<?php

	$recurso = mysqli_query(Conexion(),$paginar_resultados);
	if (!$recurso) {
    	printf("Error: %s\n", mysqli_error(Conexion()));
    	exit();
		}
	while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
	{
		echo "<tr><td>".$fila[0]."</td><td>".$fila[1]."</td><td>".$fila[2]."<td class='' title='".$fila[2]."'>".substr($fila[2],0,5)."</td>";

   	echo '<td><span class="glyphicon glyphicon-pencil" title="editar" onclick=cargar('.$fila[0].');></span></td>';
    echo '<td><span class="glyphicon glyphicon-remove" title="borrar" onclick=borrar('.$fila[0].');></span></td>';
    echo '</tr>';
	}
?>
</table>
<?=$paginadorZebra->render()?>
        </div>
    </div>
</div>
<script type="text/javascript">
function cargar(id)
{
	//alert(id);
	if(confirm("¿Desea cargar esta opcion para edicion?"))
	{
			window.location = "insumos.php?cargar=cargarDatos&id=" + id;
	}
	
}
function borrar(id)
{
	//alert(id);
	if(confirm("¿Realmente desea borrar esta opcion?"))
	{
			window.location = "insumos.php?cargar=borrarDatos&id=" + id;
	}
	
}
</script>
</body>
<style type="text/css">
body{background-color:rgba(0,51,102,1);font-family:Verdana, Geneva, sans-serif;font-size:12px;}
a:link,a:visited,a:hover{text-decoration:none; font-size:12px; color:black;}
.container{width:1360px;height:650px; background-image:url(../../../images/swirl_pattern.png); margin-top: 50px; }
#cabecera{ height:40px; background-color:transparent;}
#opciones{background-color: #E5E5E5;}
#contenido{height:350px;;background-color:white;}
#tablaOt{ font-size:12px; color:rgba(0,0,0,1);}
.col-xs-4{ opacity:0.7; height:350px;}
#despliegue{width:1360px; height:auto; overflow:auto;}
</style>
</html>