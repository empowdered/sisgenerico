<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="libs/Zebra_Pagination-master/public/css/zebra_pagination.css" />
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>pantalla de inicio</title>
</head>
<?php
error_reporting(0);
require("conexion.php");
$resultado = mysqli_query(Conexion(),"select
 count(periferico.PER_IDPERIFERICO) FROM periferico");
$cantElementos = mysqli_fetch_row($resultado);
$recurso=NULL;

$serieequipo = "";
$tipoequipo="";
$marcaperif="";
$modeloperif="";
$serieperif ="";
$colorperif= "";
$estadoperif ="";
$costoperif ="";
$nroperif="";
$opcion = "";

$id = "";
//*******************estas 2 son las variables para cargar el tipo
$cargar = "";
//*******************fin de carga de variables

if(isset($_GET["cargar"]) && $_GET["cargar"]!="")$cargar= $_GET["cargar"];
if(isset($_GET["id"]) && $_GET["id"]!="")$id= $_GET["id"];
if(isset($_POST["id"]) && $_POST["id"]!="")$id= $_POST["id"];

if(isset($_POST["serieequipo"]) && $_POST["serieequipo"]!="")$serieequipo = $_POST["serieequipo"];
if(isset($_POST["tipoequipo"]) && $_POST["tipoequipo"]!="")$tipoequipo = $_POST["tipoequipo"];
if(isset($_POST["marcaperif"]) && $_POST["marcaperif"]!="")$marcaperif= $_POST["marcaperif"];
if(isset($_POST["modeloperif"]) && $_POST["modeloperif"]!="")$modeloperif = $_POST["modeloperif"];
if(isset($_POST["serieperif"]) && $_POST["serieperif"]!="")$serieperif = $_POST["serieperif"];
if(isset($_POST["colorperif"]) && $_POST["colorperif"]!="")$colorperif = $_POST["colorperif"];
if(isset($_POST["estadoperif"]) && $_POST["estadoperif"]!="")$estadoperif = $_POST["estadoperif"];
if(isset($_POST["costoperif"]) && $_POST["costoperif"]!="")$costoperif = $_POST["costoperif"];
if(isset($_POST["nroperif"]) && $_POST["nroperif"]!="")$nroperif = $_POST["nroperif"];

if(isset($_POST["opcion"]) && $_POST["opcion"]!="")$opcion= $_POST["opcion"];

if($id!="" && $cargar!="" && $cargar=="cargarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
	$selectPeriferico = "select * from periferico where periferico.PER_IDPERIFERICO=$id";
	if($fila=mysqli_fetch_row(mysqli_query(Conexion(),$selectPeriferico)))
	{
		$id = $fila[0];
		$serieequipo = $fila[1];
		$tipoequipo = $fila[2];
		$marcaperif = $fila[3];
		$modeloperif = $fila[4];
		$serieperif = $fila[5];
		$colorperif = $fila[6];
		$estadoperif = $fila[7];
		$costoperif = $fila[8];
		$nroperif = $fila[9];
	}
}
if($id!="" && $cargar!="" && $cargar=="borrarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
	$borrarPeriferico = "delete from periferico where periferico.PER_IDPERIFERICO=$id";
	if(mysqli_query(Conexion(),$borrarPeriferico))
	{
		header("Location: Perifericos.php?mensaje=registro borrado exitosamente");
		exit();
	}
}
if(isset($_POST["ubicacion"]) && $_POST["tipo"]!="")$ubicacion = $_POST["ubicacion"];


if($serieequipo != "" && $tipoequipo!="" && $marcaperif!="" && $modeloperif!="" && $serieperif !="" && $colorperif !="" && $estadoperif !="" && $opcion!="")
//inicio del consultar por variables vacias
{
//********************************************************************************************************
	if($opcion=="crear")
	//inicio de la opcion crear
	{	
		$crearPeriferico = "INSERT INTO sisgen.periferico(EQ_IDEQUIPO, TIP_IDTIPO, PER_MARCAPERIFERICO, PER_MODELO, PER_SERIEPERIFERICO, PER_COLORPERIFERICO,";
		$crearPeriferico .= "PER_ESTADOPERIFERICO, PER_COSTO, PER_NROPERIFERICO) VALUES($serieequipo,$tipoequipo, '$marcaperif', '$modeloperif',"; 									
		$crearPeriferico .= "'$serieperif', '$colorperif', '$estadoperif','$costoperif','$nroperif')";
		echo $crearPeriferico;
		$recurso = mysqli_query(Conexion(),$crearPeriferico);
		
		if($recurso!=NULL)
		//inicio de la consulta del recurso != null
		{
			mysqli_free_result($recurso);
			header("Location: Perifericos.php?mensaje=creacion del periferico ingresado, exitosa");
		}
		else
		//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
		{
			mysqli_free_result($recurso);
			header("Location: Perifericos.php?mensaje=no se pudo crear el periferico ingresado");
		}
	}//fin del crear
//*****************************************************************************************************
	if($opcion=="actualizar" && $id!="")
	//inicio del actualizar
	{
		$actualizarPeriferico = "UPDATE sisgen.periferico SET EQ_IDEQUIPO ='$serieequipo',TIP_IDTIPO= '$tipoequipo', PER_MARCAPERIFERICO= '$marcaperif', PER_MODELO='$modeloperif',"; 									
		$actualizarPeriferico .= "PER_SERIEPERIFERICO ='$serieperif',PER_COLORPERIFERICO='$colorperif',PER_ESTADOPERIFERICO ='$estadoperif', PER_COSTO ='$costoperif',PER_NROPERIFERICO = '$nroperif' ";
		$actualizarPeriferico .= "WHERE periferico.PER_IDPERIFERICO = '$id'";
		
		$recurso = mysqli_query(Conexion(),$actualizarPeriferico);
		if($recurso!=NULL)
		//inicio de la consulta del recurso != null
		{
			mysqli_free_result($recurso);
			header("Location: Perifericos.php?mensaje=actualizacion del periferico ingresado, exitosa");
		}
		else
		//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
		{
			mysqli_free_result($recurso);
			mysqli_close($link);
			header("Location: Perifericos.php?mensaje=no se pudo actualizar el periferico ingresado");
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
        	<div class="alert text-center">
            <hr />
            <form action="Perifericos.php" method="post" >
            <input type="hidden" name="id" value="<?=$id?>" />
            <table width="500" align="center" class="table-hover" style="font-size:12px;">
            	<th colspan="4" class="text-center">mantenedor de perifericos</th>
                <tr>
                <td>serie equipo:</td>
                <td>
                 <?php
					$serie = "select EQ_IDEQUIPO, EQ_SERIEEQUIPO from equipo";
					$recurso = mysqli_query(Conexion(),$serie);
				$vacio = "";
				$selected="";
				if($serieequipo=="")
				{
					$vacio = "selected ='selected'";
				}
				?>
                <select id="serieequipo" name="serieequipo">
                <option value="" <?=$vacio?>>Seleccionar</option>
                <?php
				if($recurso)
				{
              		while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
					{
						if($fila[0] == $serieequipo)$selected = "selected='selected'";
						echo "<option value='".$fila[0]."' $selected >".$fila[1]."</option>";	
						
					}
				}
					?>
                </select>
                </td>
                <td>tipo  o categoria:</td>
                <td>
                <?php
				$vacio = "";
				$selected = "";
				if($tipoequipo=="")$vacio="selected='selected'";
					$tipo = "select tipo.TIP_IDTIPO, tipo.TIP_NBTIPO FROM tipo";
					$recurso = mysqli_query(Conexion(),$tipo);
				?>
                <select name="tipoequipo" id="tipoequipo">
                <option value="">Seleccionar</option>
                <?php
				if($recurso)
				{
					while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
					{
						if($tipoequipo==$fila[0])$selected = "selected='selected'";
						echo "<option value='".$fila[0]."' $selected >".$fila[1]."</option>";	
					}
				}
				?>
                </select>
                </td>
                </tr>
                <tr>
                <td>marca:</td>
                <td>
                <select name="marcaperif">
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
                <td>modelo:</td>
                <td><input name="modeloperif" type="text" size="15" maxlength="20" value="<?=$modeloperif?>"/></td>
                </tr>
                   <tr>
                <td>serie:</td>
                <td><input name="serieperif" type="text" size="15" maxlength="20" value="<?=$serieperif?>"/></td>
                <td>color:</td>
                <td><input name="colorperif" type="text" size="15" maxlength="20" value="<?=$colorperif?>"/></td>
                </tr>
                 </tr>
                  <tr>
                <td>estado:</td>
                <td>
                <select name="estadoperif" id="estadoperif">
                	<option value="" >Seleccionar</option>
                    <option value="activo" <?php if($estadoperif=="activo")echo "selected='selected'";?>>activo</option>
                    <option value="inactivo" <?php if($estadoperif=="inactivo")echo "selected='selected'";?>>inactivo</option>
                    <option value="reparacion" <?php if($estadoperif=="reparacion")echo "selected='selected'";?>>en taller</option>
                 	<option value="baja" <?php if($estadoperif=="baja")echo "selected='selected'";?>>dado de baja</option>
                </select>
                </td>
                <td>costo:</td>
                <td><input name="costoperif" type="text" size="15" maxlength="20" value="<?=$costoperif?>" /></td>
                </tr>
                <tr>
                 <td>N° periferico:</td>
                <td><input name="nroperif" type="text" size="15" maxlength="20" value="<?=$nroperif?>"/></td>
                </tr>
                <tr>
        	<td colspan="4">
            <input name="opcion" type="submit" value="crear" class="boton"/>
            <input name="opcion" type="submit" value="actualizar" class="boton"/>
            <input name="opcion" type="reset" value="limpiar" class="boton" onclick="javascript:window.location='Perifericos.php';"/>
            </td>
        </tr>
        <tr>
        	<td colspan="4"><?php if(isset($_GET["mensaje"]) && $_GET["mensaje"]!="")echo $_GET["mensaje"]; ?></td>
        </tr>
            </table>
            </form>
            <hr />
            <div class="row" id="despliegue">
<?php
$cant_pagina = 5;

require_once("libs/Zebra_Pagination-master/Zebra_Pagination.php");
$paginadorZebra = new Zebra_Pagination();


$cantidadRegistros = mysqli_num_rows(mysqli_query(Conexion(),"select periferico.PER_IDPERIFERICO from periferico"));


$paginar_resultados = "select * from periferico order by PER_IDPERIFERICO  limit " . (( $paginadorZebra->get_page() - 1 ) * $cant_pagina ) . ",  " . $cant_pagina;

$paginadorZebra->records($cantidadRegistros);
$paginadorZebra->records_per_page($cant_pagina);
?>
<table width="500" align="center" class="table-hover" style="font-size:12px;">
<tr><td colspan="5">cantidad de registros:<?=$cantElementos[0]?></td>
<tr>
<td colspan="5" class="text-center">listado de perifericos</td>
</tr>
<tr>
<td>codigo interno</td>
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
		echo "<tr><td>".$fila[0]."</td><td>".$fila[3]."<td>".$fila[4]."</td>";

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
	alert(id);
	if(confirm("¿Desea cargar esta opcion para edicion?"))
	{
			window.location = "Perifericos.php?cargar=cargarDatos&id=" + id;
	}
	
}
function borrar(id)
{
	alert(id);
	if(confirm("¿Realmente desea borrar esta opcion?"))
	{
			window.location = "Perifericos.php?cargar=borrarDatos&id=" + id;
	}
	
}
</script>
</div>
            </div>
        </div>
    	<!-- aca finaliza el cuerpo y el resto del contenido -->
    </div>
</div>
            </div>
        </div>
    	<!-- aca finaliza el cuerpo y el resto del contenido -->
    </div>
</div>
<script type="text/javascript">
function cargar(id)
{
	if(confirm("¿Desea cargar esta opcion para edicion?"))
	{
			window.location ='Perifericos.php?cargar=cargarDatos&id=' + id;
	}
}
function borrar(id)
{
	if(confirm("¿Realmente desea borrar esta opcion?"))
	{
			window.location ='Perifericos.php?cargar=borrarDatos&id=' + id;
	}
}
</script>
</body>
</html>