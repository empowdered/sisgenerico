<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="libs/Zebra_Pagination-master/public/css/zebra_pagination.css" />
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script src="../js/datetimepicker_css.js"></script>
<link rel="stylesheet" href="estilo.css" />
<title>equipamiento de computadores personales</title>
</head>
<?php
error_reporting(0);
require("conexion.php");
$link = Conexion();
$resultado = mysqli_query($link,"select count(equipo.EQ_IDEQUIPO) FROM equipo");
$cantElementos = mysqli_fetch_row($resultado);
$recurso = NULL;
//*******************estas 2 son las variables para cargar el tipo
$cargar = "";
$id = "";
//*******************fin de carga de variables

$ubicacion = "";
$tipo ="";
$nroequipo = "";
$serieequipo = "";
$marcaequipo = "";
$modeloequipo ="";
$ramequipo = "";
$discoequipo = "";
$macequipo = "";
$ipequipo ="";
$enlaceequipo = "";
$mascaraequipo = "";
$procesador = "";
$estado ="";

$fingreso = "";
$fechaGuardada ="";

$fcreacion = "";

$costoequipo = "";

$opcion = "";




if(isset($_POST["id"]) && $_POST["id"]!="")$id = $_POST["id"];
if(isset($_GET["id"]) && $_GET["id"]!="")$id = $_GET["id"];

if(isset($_GET["cargar"]) && $_GET["cargar"]!="") $cargar = $_GET["cargar"];

if($id!="" && $cargar!="" && $cargar=="cargarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
	$selectEquipo = "select * from equipo where equipo.EQ_IDEQUIPO='$id'";
	if($fila=mysqli_fetch_row(mysqli_query(Conexion(),$selectEquipo)))
	{	
		$id = $fila[0];
		$ubicacion = $fila[1];
		$tipo = $fila[2];
		$nroequipo = $fila[3];
		$serieequipo = $fila[4];
		$marcaequipo = $fila[5];
		$modeloequipo = $fila[6];
		$ramequipo = $fila[7];
		$discoequipo = $fila[8];
		$macequipo = $fila[9];
		$ipequipo = $fila[10];
		$enlaceequipo = $fila[11];
		$mascaraequipo = $fila[12];
		$procesador= $fila[13];
		$estado = $fila[14];
		$fingreso = $fila[15];
		$fcreacion = $fila[16];
		$costoequipo = $fila[17];
	}
}
if($id!="" && $cargar!="" && $cargar=="borrarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
	$borrarEquipo = "delete from equipo where equipo.EQ_IDEQUIPO ='$id'";
	if(mysqli_query(Conexion(),$borrarEquipo))
	{
		header("Location: equiposPC.php?mensaje=registro borrado exitosamente");
		exit();
	}
}


if(isset($_POST["ubicacion"]) && $_POST["tipo"]!="")$ubicacion = $_POST["ubicacion"];
if(isset($_POST["tipo"]) && $_POST["tipo"]!="")$tipo = $_POST["tipo"];
if(isset($_POST["nroequipo"]) && $_POST["tipo"]!="")$nroequipo = $_POST["nroequipo"];
if(isset($_POST["serieequipo"]) && $_POST["serieequipo"]!="")$serieequipo = $_POST["serieequipo"];
if(isset($_POST["marcaequipo"]) && $_POST["marcaequipo"]!="")$marcaequipo = $_POST["marcaequipo"];
if(isset($_POST["modeloequipo"]) && $_POST["modeloequipo"]!="")$modeloequipo = $_POST["modeloequipo"];
if(isset($_POST["ramequipo"]) && $_POST["ramequipo"]!="")$ramequipo = $_POST["ramequipo"];
if(isset($_POST["discoequipo"]) && $_POST["discoequipo"]!="")$discoequipo = $_POST["discoequipo"];
if(isset($_POST["macequipo"]) && $_POST["macequipo"]!="")$macequipo = $_variable =$_POST["macequipo"];
if(isset($_POST["ipequipo"]) && $_POST["ipequipo"]!="")$ipequipo = $_POST["ipequipo"];
if(isset($_POST["enlaceequipo"]) && $_POST["enlaceequipo"]!="")$enlaceequipo = $_POST["enlaceequipo"];
if(isset($_POST["mascaraequipo"]) && $_POST["mascaraequipo"]!="")$mascaraequipo = $_POST["mascaraequipo"];
if(isset($_POST["procesador"]) && $_POST["procesador"]!="")$procesador = $_POST["procesador"];
if(isset($_POST["estado"]) && $_POST["estado"]!="")$estado = $_POST["estado"];

if(isset($_POST["fingreso"]) && $_POST["fingreso"]!="")$fingreso= $_POST["fingreso"];
if(isset($_POST["fechaGuardada"]) && $_POST["fechaGuardada"]!="")$fechaGuardada= $_POST["fechaGuardada"];
if($fingreso=="")
{
    $fingreso = $fechaGuardada;
}
if(isset($_POST["fcreacion"]) && $_POST["fcreacion"]!="")$fcreacion= $_POST["fcreacion"];

if(isset($_POST["costoequipo"]) && $_POST["costoequipo"]!="")$costoequipo = $_POST["costoequipo"];

if(isset($_POST["opcion"]) && $_POST["opcion"]!="")$opcion = $_POST["opcion"];

if($ubicacion!="" && $tipo!="" && $nroequipo!="" && $serieequipo!="" && $marcaequipo!=""  && $modeloequipo!=""  && $opcion!="")
//inicio del consultar por variables vacias
{
//********************************************************************************************************
	if($opcion=="crear")
	//inicio de la opcion crear
	{	
		$crearEquipo = "INSERT INTO sisgen.equipo (UB_IDUBICACION, EQ_IDTIPO, EQ_NROEQUIPO, EQ_SERIEEQUIPO, EQ_MARCA, EQ_MODELO, EQ_RAM, EQ_DISCO, EQ_MAC, EQ_IP,EQ_PTAENLACE, EQ_MASCARA,"; 									
		$crearEquipo .= "EQ_PROCESADOR, EQ_ESTADO,EQ_FINGRESO,EQ_FCREACION,EQ_COSTO) VALUES ('$ubicacion', '$tipo', '$nroequipo', '$serieequipo', '$marcaequipo', '$modeloequipo', '$ramequipo',"; 
		$crearEquipo .= "'$discoequipo', '$macequipo','$ipequipo','$enlaceequipo', '$mascaraequipo','$procesador','$estado', '$fingreso',now(),$costoequipo)";
		
		$recurso = mysqli_query(Conexion(),$crearEquipo);
		if($recurso!=NULL)
		//inicio de la consulta del recurso != null
		{
			mysqli_free_result($recurso);
			header("Location: equiposPC.php?mensaje=creacion del computador personal ingresado, exitosa");
		}
		else
		//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
		{
			mysqli_free_result($recurso);
			header("Location: equiposPC.php?mensaje=no se pudo crear el registro del computador personal ingresado");
		}
	}//fin del crear
//*****************************************************************************************************
	if($opcion=="actualizar" && $id!="")
	//inicio del actualizar
	{
		$actualizarEquipo = "UPDATE sisgen.equipo SET 
        UB_IDUBICACION='$ubicacion',
        EQ_IDTIPO='$tipo', 
        EQ_NROEQUIPO='$nroequipo',
        EQ_SERIEEQUIPO='$serieequipo',
		EQ_MARCA='$marcaequipo', 
        EQ_MODELO='$modeloequipo', 
        EQ_RAM='$ramequipo', 
        EQ_DISCO='$discoequipo', 
        EQ_MAC='$macequipo',
        EQ_IP='$ipequipo',
		EQ_PTAENLACE='$enlaceequipo', 
        EQ_MASCARA='$mascaraequipo',
        EQ_PROCESADOR='$procesador', 
        EQ_ESTADO='$estado', 
        EQ_FINGRESO='$fingreso',
        EQ_FCREACION ='$fcreacion',
        EQ_COSTO='$costoequipo' 									
		WHERE 
        equipo.EQ_IDEQUIPO=$id";
	
		$recurso = mysqli_query(Conexion(),$actualizarEquipo);
		if($recurso!=NULL)
		//inicio de la consulta del recurso != null
		{
			header("Location: equiposPC.php?mensaje=actualizacion del computador personal ingresado, exitosa");
		}
		else
		//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
		{
			header("Location: equiposPC.php?mensaje=no se pudo actualizar el registro del computador personal ingresado");
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
        <form action="equiposPC.php" method="post">
        <input type="hidden" value="<?=$id?>" name="id" />
        	<table width="550" align="center" class="table-hover" style="font-size:12px;">
<th colspan="4" class="text-center">mantenedor de equipos pc</th>
<tr>
<td colspan="1" style="text-align:right;">
ubicacion:</td>
<?php
$vacio="";
$selected ="";

if($ubicacion=="")$vacio="selected='selected'";

$ubicacionx = "select ubicacion.UB_IDUBICACION,UBICACION.UB_TIPOSALA FROM ubicacion";
$recurso = mysqli_query(Conexion(),$ubicacionx);
?>
<td colspan="3" style="text-align:left;"> 
<select id="ubicacion" name="ubicacion">
<option value="" <?=$vacio?> >Seleccione</option>
<?php
				if($recurso)
				{
					while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
					{
						if($ubicacion==$fila[0])$selected = "selected='selected'";
						echo "<option value='".$fila[0]."' $selected >".$fila[1]."</option>";	
					}
				}
?>
</select>
</td>
</td>
</tr>
<tr>
<td>tipo o categoria:</td>
<td>
<?php
$vacio="";
$selected ="";
if($tipo=="")$vacio="selected='selected'";
$tipox = "select tipo.TIP_IDTIPO, tipo.TIP_NBTIPO FROM tipo";
$recurso = mysqli_query(Conexion(),$tipox);
?>
<select id="tipo" name="tipo">
<option value="" <?=$vacio?>>Seleccione</option>
<?php
$selected1= "";
				if($recurso)
				{
					while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
					{
						if($tipo==$fila[0])$selected = "selected='selected'";
						echo "<option value='".$fila[0]."' $selected >".$fila[1]."</option>";	
					}
				}
?>
</select>
</td>
<td>&nbsp;N° Equipo:</td>
<td><input type="text" name="nroequipo" value="<?=$nroequipo?>" size="15" /></td>
</tr>
<tr>
<td>serie:</td>
<td><input name="serieequipo" type="text" id="serieequipo" value="<?=$serieequipo?>" size="25" /></td>
<td>&nbsp;Marca:</td>
<td>
<select name="marcaequipo">
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
<td>modelo:</td>
<td><input name="modeloequipo" type="text" id="modeloequipo" value="<?=$modeloequipo?>" size="25" /></td>
<td>&nbsp;cant ram:</td>
<td><input name="ramequipo" type="text" id="ramequipo" value="<?=$ramequipo?>" size="15" /></td>
</tr>
<tr>
<td>tamano disco:</td>
<td><input name="discoequipo" type="text" id="discoequipo" value="<?=$discoequipo?>" size="25" /></td>
<td>&nbsp;MAC:</td>
<td><input name="macequipo" type="text" id="macequipo" value="<?=$macequipo?>" size="15" /></td>
</tr>
<tr>
<td>Dir IP:</td>
<td><input name="ipequipo" type="text" id="ipequipo" value="<?=$ipequipo?>" size="25" /></td>
<td>&nbsp;Pta Enlace:</td>
<td><input name="enlaceequipo" type="text" id="enlaceequipo" value="<?=$enlaceequipo?>" size="15" /></td>
</tr>
<tr>
<td>Mascara subred:</td>
<td><input name="mascaraequipo" type="text" id="mascaraequipo" value="<?=$mascaraequipo?>" size="25" /></td>
<td>&nbsp;Procesador:</td>
<td><input name="procesador" type="text" id="procesador" value="<?=$procesador?>" size="15" /></td>
</tr>
<tr>
<td>Estado equipo:</td>
<td>
<select name="estado" id="estado">
                	<option value="" <?php if($estado=="")echo "selected='selected'"; ?>>Seleccionar</option>
                    <option value="activo" <?php if($estado=="activo")echo "selected='selected'";?>>activo</option>
                    <option value="inactivo" <?php if($estado=="inactivo")echo "selected='selected'";?>>inactivo</option>
                    <option value="reparacion" <?php if($estado=="reparacion")echo "selected='selected'";?>>en taller</option>
                 	<option value="baja" <?php if($estado=="baja")echo "selected='selected'";?>>dado de baja</option>
               
</select>
</td>
</tr>
<?php
$fechaGuardada = $fingreso;
$fechaingreso = "";
?>
<tr>
<td>Fecha ingreso:<span class="glyphicon glyphicon-calendar" onclick="javascript:NewCssCal('fingreso','yyyyMMdd')" style="cursor:pointer"></span></td>
<td><input name="fingreso" type="text" id="fingreso" value="" size="25" data-format="yyyy/mm/dd" /></td>
<td>Fecha anterior:</td>
<td><input name="fechaGuardada" type="text" id="fechaGuardada" value="<?=$fechaGuardada?>" size="15" data-format="yyyy/mm/dd" /></td>
</tr>
<tr>
<td colspan="1" style="text-align:right;">Fecha creacion:</td>
<td colspan="3" style="text-align:left;"><input name="fcreacion" type="text" value="<?=$fcreacion?>" size="25" readonly="readonly" /></td>
</tr>
<tr>
<td colspan="1" style="text-align:right;">Costo:</td>
<td colspan="3" style="text-align:left;"><input name="costoequipo" type="text" id="costoequipo" value="<?=$costoequipo?>" size="15" /></td>
</tr>
        <tr>
        	<td colspan="3">
            <input name="opcion" type="submit" value="crear" class="boton"/>
            <input name="opcion" type="submit" value="actualizar" class="boton"/>
            <input name="opcion" type="reset" value="limpiar" class="boton" onclick="javascript:window.location='equiposPC.php';"/>
            </td>
        </tr>
        <tr>
        	<td colspan="4"><?php if(isset($_GET["mensaje"]) && $_GET["mensaje"]!="")echo $_GET["mensaje"]; ?></td>
        </tr>
    </table>
</form>
<hr />
<div id="despliegue">
<?php
$cant_pagina = 5;

require_once("libs/Zebra_Pagination-master/Zebra_Pagination.php");
$paginadorZebra = new Zebra_Pagination();

$cantidadRegistros = mysqli_num_rows(mysqli_query(Conexion(),"select equipo.EQ_IDEQUIPO from equipo"));
$paginar_resultados = "select * from  equipo order by  equipo.EQ_IDEQUIPO  asc  limit " . (( $paginadorZebra->get_page() - 1 ) * $cant_pagina ) . ",  " . $cant_pagina;

$paginadorZebra->records($cantidadRegistros);
$paginadorZebra->records_per_page($cant_pagina);
$paginadorZebra->render();
?>
<table width="500" align="center" class="table-hover" style="font-size:12px;">
<tr><td colspan="5">cantidad de registros:<?=$cantElementos[0]?></td></tr>
<tr>
<td colspan="5" class="text-center">listado de perifericos</td>
</tr>
<tr>
<td>codigo interno</td>
<td>nombre especifico</td>
<td>n° serie</td>
<td>marca</td>
<td colspan="2">opciones</td>
</tr>
<?php

	$recurso = mysqli_query(Conexion(),$paginar_resultados);
	if (!$recurso) {
    	printf("Error: %s\n", mysqli_error(Conexion()));
    	exit();
		}
	while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
	{
		echo "<tr><td>".$fila[0]."</td><td>".$fila[3]."<td>".$fila[4]."</td><td>".$fila[5]."</td>";

   	echo '<td><span class="glyphicon glyphicon-pencil" title="editar" onclick=cargar('.$fila[0].');></span></td>';
     echo '<td><span class="glyphicon glyphicon-remove" title="borrar" onclick=borrar('.$fila[0].');></span></td>';
    echo '</tr>';
	}
?>
</table>
<?=$paginadorZebra->render();?>
</div>

        </div>
        <script type="text/javascript">
function cargar(id)
{
	//alert(id);
	if(confirm("¿Desea cargar esta opcion para edicion?"))
	{
			window.location = "equiposPC.php?cargar=cargarDatos&id=" + id;
	}
	
}
function borrar(id)
{
	//alert(id);
	if(confirm("¿Realmente desea borrar esta opcion?"))
	{
			window.location = "equiposPC.php?cargar=borrarDatos&id=" + id;
	}
	
}
</script>
    	<!-- aca finaliza el cuerpo y el resto del contenido -->
    </div>
</div>
</body>
</html>