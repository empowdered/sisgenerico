<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="libs/Zebra_Pagination-master/public/css/zebra_pagination.css" />
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<script src="../js/datetimepicker_css.js"></script>
<link rel="stylesheet" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>equipos de impresion</title>
</head>
<?php
error_reporting(0);
require("conexion.php");
$recurso = NULL;
$resultado = mysqli_query(Conexion(),"select count(impresion.IM_IDIMPRESION) FROM impresion");
$cantElementos = mysqli_fetch_row($resultado);
$id ="";
$tipo="";
$ubicacion="";
$serieequipo="";
$marca="";
$modelo="";
$tipoimpresora="";
$costo="";
$descripcion="";
$estado ="";
$fingreso="";
$fcreacion="";

$faanterior =""; //opcional, tomara el valor anterior de la fecha ingresada, luego asumira esa variable como nueva, en caso de que venga vacia, asumira el valor de esta misma variable.

//*******************estas 2 son las variables para cargar el tipo
$cargar = "";
$opcion ="";
//*******************fin de carga de variables



if(isset($_GET["cargar"]) && $_GET["cargar"]!="")$cargar= $_GET["cargar"];

if(isset($_GET["id"]) && $_GET["id"]!="")$id= $_GET["id"];
if(isset($_POST["id"]) && $_POST["id"]!="")$id= $_POST["id"];

if($id!="" && $cargar!="" && $cargar=="cargarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
	$selectImpresora = "select * from impresion where impresion.IM_IDIMPRESION ='$id'";
	if($fila=mysqli_fetch_row(mysqli_query(Conexion(),$selectImpresora)))
	//desde aca nosotros cargamos el registro para edicion
	{
		$id = $fila[0];
		$tipo = $fila[1];
		$ubicacion = $fila[2];
		$serieequipo = $fila[3];
		$marca = $fila[4];
		$modelo = $fila[5];
		$tipoimpresora = $fila[6];
		$descripcion = $fila[7];
		$estado = $fila[8];
		$fingreso = $fila[9];
		$fcreacion = $fila[10];
		$costo = $fila[11];
	}
}
if($id!="" && $cargar!="" && $cargar=="borrarDatos")
//aca comenzamos la creacion del select para cargar y borrar
{
	$borrarImpresora = "delete from impresion where impresion.IM_IDIMPRESION='$id'";
	if(mysqli_query(Conexion(),$borrarImpresora))
	//si la consulta es exitosa, el registro sera borrado...
	{
		header("Location: equiposImpresion.php?mensaje=registro borrado exitosamente");
		exit();
	}
}
if(isset($_POST["tipo"]) && $_POST["tipo"]!="")$tipo= $_POST["tipo"];
if(isset($_POST["ubicacion"]) && $_POST["ubicacion"]!="")$tipo= $_POST["ubicacion"];
if(isset($_POST["marca"]) && $_POST["marca"]!="")$marca= $_POST["marca"];
if(isset($_POST["serieequipo"]) && $_POST["serieequipo"]!="")$serieequipo= $_POST["serieequipo"];
if(isset($_POST["marca"]) && $_POST["ubicacion"]!="")$ubicacion= $_POST["ubicacion"];
if(isset($_POST["modelo"]) && $_POST["modelo"]!="")$modelo= $_POST["modelo"];
if(isset($_POST["tipoimpresora"]) && $_POST["tipoimpresora"]!="")$tipoimpresora= $_POST["tipoimpresora"];
if(isset($_POST["costo"]) && $_POST["costo"]!="")$costo= $_POST["costo"];
if(isset($_POST["descripcion"]) && $_POST["descripcion"]!="")$descripcion = $_POST["descripcion"];
if(isset($_POST["estado"]) && $_POST["estado"]!="")$estado = $_POST["estado"];
if(isset($_POST["fingreso"]) && $_POST["fingreso"]!="")$fingreso= $_POST["fingreso"];
if(isset($_POST["faanterior"]) && $_POST["faanterior"]!="")$faanterior= $_POST["faanterior"];

	if($fingreso=="")
	{
		$fingreso = $fechaanterior;	
	}
	
//if(isset($_POST["fcreacion"]) && $_POST["fcreacion"]!="")$fcreacion= $_POST["fcreacion"];//esta viene vacia, pero sera usada en el update

if(isset($_POST["opcion"]) && $_POST["opcion"]!="")$opcion = $_POST["opcion"];

if($tipo!="" && $descripcion!="" && $opcion!="")
//inicio del consultar por variables vacias
{
//********************************************************************************************************
	if($opcion=="crear")
	//inicio de la opcion crear
	{	
		$crearImpresora = "INSERT INTO `sisgen`.`impresion` (`TIP_IDTIPO`, `UB_IDUBICACION`, `IM_SERIEIMPRESION`, `IM_MARCA`, `IM_MODELO`, `IM_TIPOIMPRESION`, `IM_DESCRIPCION`,`IM_ESTADOIMP`, `IM_FEINGRESO`, `IM_FCREACION`, `IM_COSTO`) VALUES ('$tipo', '$ubicacion', '$serieequipo', '$marca', '$modelo', '$tipoimpresora', '$descripcion','$estado', '$fingreso',NOW(), $costo);";
		$recurso = mysqli_query(Conexion(),$crearImpresora);
		if($recurso!=NULL)
		//inicio de la consulta del recurso != null
		{
			header("Location: equiposImpresion.php?mensaje=creacion de la impresora, exitosa");
		}
		else
		//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
		{
			header("Location: equiposImpresion.php?mensaje=no se pudo la impresora ingresada");
		}
	}//fin del crear
//*****************************************************************************************************
	if($opcion=="actualizar" && $id!="")
	//inicio del actualizar
	{
		$actualizarImpresora = "UPDATE `sisgen`.`impresion` SET `TIP_IDTIPO` = '$tipo',`UB_IDUBICACION` = '$ubicacion', `IM_SERIEIMPRESION` = '$serieequipo', `IM_MARCA` = '$marca', `IM_MODELO` = '$modelo', `IM_TIPOIMPRESION` = '$tipoimpresora', `IM_DESCRIPCION` = '$descripcion', IM_ESTADOIMP='$estado',`IM_FEINGRESO` = '$fingreso', `IM_COSTO` = '$costo' WHERE `impresion`.`IM_IDIMPRESION` = '$id'";
		$recurso = mysqli_query(Conexion(),$actualizarImpresora);
		if($recurso!=NULL)
		//inicio de la consulta del recurso != null
		{
			header("Location: equiposImpresion.php?mensaje=actualizacion del tipo ingresado, exitosa");
		}
		else
		//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
		{
			header("Location: equiposImpresion.php?mensaje=no se pudo actualizar el tipo ingresado");
		}
	}//fin del actualizar
//***************************************************************************
}//fin del preguntar si variables llegan vacias o no
?>
<body>
<div class="container">
	<!-- aca le colocamos una cabecera, para que se vea mas lindo -->
	<div class="row text-center" id="cabecera">
    		
    </div>
    <!-- aca termina la cabecera -->
    <div class="row">
    	<!-- aca comienza el cuerpo de la cuestion, menu izquierda y contenido centro -->
        <div class="col-xs-4 text-left" id="menu">
               <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="equiposImpresion.php">impresoras</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="equiposPC.php">computadores</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="equiposRed.php">equipos de red</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="Perifericos.php">perifericos</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="Software.php">programas</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="Licencias.php">licencias</a>
                    </div>
                     <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="tipos.php">categoria equipos</a>
                    </div>
                     <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="ubicacion.php">ubicaciones</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="marca.php">Marca</a>
                    </div>
        </div>
        <div class="col-xs-8" id="formularios">
        <hr />
        <form action="equiposImpresion.php" method="post">
        <input type="hidden" name="id" value="<?=$id?>" />
        	<table width="500" align="center" class="table-hover" style="font-size:12px;">
<th colspan="4" class="text-center">mantenedor de impresoras</th>
<tr>
<td style="text-align:right;">Tipo Equipo:</td>
<td>
<?php
$vaciox ="";
$selected ="";
if($tipo =="")$vaciox="selected='selected'";
?>
<select id="tipo" name="tipo">
<option value=""  <?=$vacio?>>Seleccione</option>
<?php
$recurso =NULL;

$tipox = "select tipo.TIP_IDTIPO, tipo.TIP_NBTIPO FROM tipo";
$recurso = mysqli_query(Conexion(),$tipox);

if($recurso!=NULL)
{
	while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
	{
		if($tipo==$fila[0])$selected="selected='selected'";
		echo "<option value='".$fila[0]."' $selected >".$fila[1]."</option>";
	}
}
?>
</select>
</td>
<td style="text-align:right;">Ubicacion:&nbsp;</td>
<td>
<?php
$vaciox ="";
$selected ="";
if($ubicacion=="")$vaciox="selected='selected'";
?>
<select id="ubicacion" name="ubicacion">
<option value="" <?=$vacio?>>Seleccione</option>
<?php
$recurso = NULL;

$ubicacionx = "select UB_IDUBICACION, UB_TIPOSALA FROM ubicacion";
$recurso = mysqli_query(Conexion(),$ubicacionx);

if($recurso!=NULL)
{
	while($fila=mysqli_fetch_array($recurso))
	{
		if($ubicacion==$fila[0])$selected="selected='selected'";
		echo "<option value='".$fila[0]."' $selected >".$fila[1]."</option>";
	}
}
?>
</select>
</td>
</tr>
<tr>
<td style="text-align:right;">Serie Equipo:&nbsp;</td>
<td><input type="text" name="serieequipo" value="<?=$serieequipo?>" size="20" /></td>
<td style="text-align:right;">Marca:&nbsp;</td>
<td>
<select name="marca">
<option value="">Seleccione</option>
<?php
$link = Conexion();
$cargarMarca = "call obtieneMarca()";
$recurso = mysqli_query($link,$cargarMarca);
if($recurso!=NULL)
{
	while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
	{
		echo "<option value='".$fila[0]."'>".$fila[1]."</option>";	
	}
}
?>
</select>
</td>
</tr>
<tr>
<tr>
<td colspan="1" style="text-align:right;">Modelo:&nbsp;</td>
<td colspan="3" style="text-align:left;"><input type="text" name="modelo" value="<?=$modelo?>" size="20" /></td>
</tr>
<td>genero impresora:</td>
<td><input type="text" name="tipoimpresora" value="<?=$tipoimpresora?>" size="20"  id="tipoimpresora"/></td>
<td>$Costo:&nbsp;</td>
<td><input type="text" name="costo" value="<?=$costo?>" size="20" id="costo"/></td>
</tr>
<td colspan="1" style="text-align:left;" valign="top">
Descripcion:&nbsp;
</td>
<td colspan="3" style="text-align:left;">
<textarea name="descripcion" cols="40" rows="5">
<?=trim($descripcion)?>
</textarea>
</td>
</tr>
<tr>
<td colspan="1" style="text-align:right;">Estado:&nbsp;</td>
<td colspan="3" style="text-align:left;">
<select name="estado" id="estado">
                	<option value="" >Seleccionar</option>
                    <option value="activo" <?php if($estado=="activo")echo "selected='selected'";?>>activo</option>
                    <option value="inactivo" <?php if($estado=="inactivo")echo "selected='selected'";?>>inactivo</option>
                    <option value="reparacion" <?php if($estado=="reparacion")echo "selected='selected'";?>>en taller</option>
                 	<option value="baja" <?php if($estado=="baja")echo "selected='selected'";?>>dado de baja</option>
               
</select>
</td>
</tr>
<?php
$faanterior = $fingreso;
$fingreso = "";
?>
<tr>
<td>fecha ingreso:&nbsp;<span class="glyphicon glyphicon-calendar" onclick="javascript:NewCssCal('fingreso','yyyyMMdd')" style="cursor:pointer"></span></td>
<td><input type="text" name="fingreso" value="" size="10" id="fingreso"/></td>
<td>fecha anterior:</td>
<td><input type="text" name="faanterior" value="<?=$faanterior?>" size="10" id="fingreso"/></td>
</tr>        
<tr>
<td>fecha creacion:&nbsp;</td>
<td><input type="text" name="fcreacion" value="<?=$fcreacion?>" size="20" readonly="readonly"/></td>
</tr>
<tr>
        	<td colspan="4">
            <input name="opcion" type="submit" value="crear" class="boton"/>
            <input name="opcion" type="submit" value="actualizar" class="boton"/>
            <input name="opcion" type="button" value="limpiar" class="boton" onclick="javascript:window.location='equiposImpresion.php';"/>
            </td>
        </tr>
        <tr>
        	<td colspan="4"><?php if(isset($_GET["mensaje"]) && $_GET["mensaje"]!="")echo $_GET["mensaje"]; ?></td>
        </tr>
    </table>
</form>
<hr />
<?php

$cant_pagina = 5;

require_once("libs/Zebra_Pagination-master/Zebra_Pagination.php");
$paginadorZebra = new Zebra_Pagination();


$cantidadRegistros = mysqli_num_rows(mysqli_query(Conexion(),"select impresion.IM_IDIMPRESION FROM impresion"));


$paginar_resultados = "select * from impresion order by IM_IDIMPRESION  limit " . (( $paginadorZebra->get_page() - 1 ) * $cant_pagina ) . ",  " . $cant_pagina;

$paginadorZebra->records($cantidadRegistros);
$paginadorZebra->records_per_page($cant_pagina);

?>
<table width="500" align="center" class="table-hover" style="font-size:12px;">
<tr><td colspan="5">cantidad de registros:<?=$cantElementos[0]?></td></tr>
<tr>
<td colspan="5" class="text-center text-capitalize">listado de tipos o categorias de hardware
</td>
<tr>
<td>codigo interno</td>
<td>nombre especifico</td>
<td>descripcion</td>
<td colspan="2">opciones</td>
</tr>
<tr>
<?php
	$recurso = mysqli_query(Conexion(),$paginar_resultados);
	if (!$recurso) {
    	printf("Error: %s\n", mysqli_error(Conexion()));
    	exit();
		}
	while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
	{
		echo "<tr><td>".$fila[0]."</td><td>".$fila[4]."<td>".$fila[6]."</td>";
    	echo '<td><span class="glyphicon glyphicon-pencil" title="editar" onclick=cargar('.$fila[0].');></span></td>';
     	echo '<td><span class="glyphicon glyphicon-remove" title="borrar" onclick=borrar('.$fila[0].');></span></td>';
    	echo '</tr>';  
	}
?>
</table>
<?=$paginadorZebra->render();?>
<script type="text/javascript">
function cargar(id)
{
	if(confirm("¿Desea cargar esta opcion para edicion?"))
	{
			window.location ='equiposImpresion.php?cargar=cargarDatos&id=' + id;
	}
}
function borrar(id)
{
	if(confirm("¿Realmente desea borrar esta opcion?"))
	{
			window.location ='equiposImpresion.php?cargar=borrarDatos&id=' + id;
	}
}
</script>
        </div>
    	<!-- aca finaliza el cuerpo y el resto del contenido -->
    </div>
</div>
</body>
</html>