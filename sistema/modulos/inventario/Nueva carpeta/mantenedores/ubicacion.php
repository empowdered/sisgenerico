<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="libs/Zebra_Pagination-master/public/css/zebra_pagination.css" />
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mantenedor de locaciones</title>
</head>
<?php
error_reporting(0);
require("conexion.php");
$resultado = mysqli_query(Conexion(),"select count(ubicacion.UB_IDUBICACION) FROM ubicacion");
$cantElementos = mysqli_fetch_row($resultado);
$id = "";
$nrosala = "";
$nropiso = "";
$descripcion = "";
//*******************estas 2 son las variables para cargar el tipo

$opcion = "";
$cargar = "";

//*******************fin de carga de variables
$recurso = NULL;


if(isset($_POST["id"]) && $_POST["id"]!="")$id= $_POST["id"];
if(isset($_GET["id"]) && $_GET["id"]!="")$id= $_GET["id"];

if(isset($_POST["nrosala"]) && $_POST["nropiso"]!="")$nrosala= $_POST["nrosala"];
if(isset($_POST["nropiso"]) && $_POST["nropiso"]!="")$nropiso= $_POST["nropiso"];
if(isset($_POST["descripcion"]) && $_POST["descripcion"]!="")$descripcion= $_POST["descripcion"];

if(isset($_POST["opcion"]) && $_POST["opcion"]!="")$opcion= $_POST["opcion"];

if(isset($_GET["cargar"]) && $_GET["cargar"]!="")$cargar= $_GET["cargar"];

if($id!="" && $cargar!="" && $cargar=="cargarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
	$selectUbicacion = "select * from ubicacion where ubicacion.UB_IDUBICACION =$id";
	if($fila=mysqli_fetch_row(mysqli_query(Conexion(),$selectUbicacion)))
	{
		$id = $fila[0];
		$nrosala = $fila[1];
		$nropiso  = $fila[2];
		$descripcion = $fila[3];
	}
}
if($id!="" && $cargar!="" && $cargar=="borrarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
	$borrarUbicacion = "delete from sisgen.ubicacion where ubicacion.UB_IDUBICACION='$id'";
	if(mysqli_query(Conexion(),$borrarUbicacion))
	{
		header("Location: ubicacion.php?mensaje=registro borrado exitosamente");
		exit();
	}
	else
	{
		header("Location: ubicacion.php?mensaje=");
		exit();
	}
}

if($nrosala!="" && $nropiso!="" && $descripcion!="" && $opcion!="")
//inicio del consultar por variables vacias
{
//********************************************************************************************************
	if($opcion=="crear")
	//inicio de la opcion crear
	{	
		$crearUbicacion = "INSERT INTO `sisgen`.`ubicacion` (`UB_NROSALA`, `UB_PISOSALA`, `UB_TIPOSALA`)";
		$crearUbicacion .=" VALUES ('$nrosala', '$nropiso', '$descripcion')";
		
		$recurso = mysqli_query(Conexion(),$crearUbicacion);
		if($recurso!=NULL)
		//inicio de la consulta del recurso != null
		{
			mysqli_free_result($recurso);
			header("Location: ubicacion.php?mensaje=creacion de la ubicacion");
		}
		else
		//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
		{
			mysqli_free_result($recurso);
			header("Location: ubicacion.php?mensaje=no se pudo crear la ubicacion ingresada");
		}
	}//fin del crear
//*****************************************************************************************************
	if($opcion=="actualizar")
	//inicio del actualizar
	{
		$actualizarUbicacion = "UPDATE `sisgen`.`ubicacion` SET `UB_NROSALA` = '$nrosala', `UB_PISOSALA` = '$nropiso',"; 
		$actualizarUbicacion .="`UB_TIPOSALA` = '$descripcion' WHERE `ubicacion`.`UB_IDUBICACION` = $id";
		$recurso = mysqli_query(Conexion(),$actualizarUbicacion);
		if($recurso!=NULL)
		//inicio de la consulta del recurso != null
		{
			mysqli_free_result($recurso);
			header("Location: ubicacion.php?mensaje=actualizacion de la ubicacion, exitosa !!!");
		}
		else
		//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
		{
			mysqli_free_result($recurso);
			header("Location: ubicacion.php?mensaje=no se pudo actualizar la ubicacion indicada");
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
                    <a href="#">impresoras</a>
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
                    <a href="#">licencias</a>
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
           <form action="ubicacion.php" method="post">
	<table width="250" align="center" class="table-hover" style="font-size:12px;">
    <input type="hidden" value="<?=$id?>" name="id" />
    <th colspan="2" style="text-align:center">mantenedor de ubicaciones</th>
    	<tr>
        	<td>N° Sala:</td>
            <td><input name="nrosala" type="text" size="20" value='<?=$nrosala?>'/></td>
            <td></td>
        </tr>
        <tr>	
            <td>N° Piso:</td>
            <td><input name="nropiso" type="text" size="20" value='<?=$nropiso?>'/></td>
        </tr>
        <tr>
        	<td>Detalle Sala:</td>
            <td>
            <!--
            <select  id="descripcion" name="descripcion">
            <option value="">escoja opcion</option>
            <option value="biblioteca" <?php if($descripcion=="biblioteca")echo "selected";?>>biblioteca</option>
            <option value="psicosocial" <?php if($descripcion=="psicosocial")echo "selected";?>>psicosocial</option>
            <option value="integracion" <?php if($descripcion=="integracion")echo "selected";?>>sala de integracion</option>
            <option value="sala profesores" <?php if($descripcion=="sala profesores")echo "selected";?>>sala profesores</option>
            <option value="auditorio" <?php if($descripcion=="auditorio")echo "selected";?>>Auditorio</option>
            <option value="sala" <?php if($descripcion=="sala")echo "selected";?>>Sala Clases</option>
            <option value="laboratorio"  <?php if($descripcion=="laboratorio")echo "selected";?>>Laboratorio</option>
            <option value="oficina" <?php if($descripcion=="oficina")echo "selected";?>>Oficina</option>
            <option value="bodega1"  <?php if($descripcion=="bodega1")echo "selected";?>>Bodega 1</option>
            <option value="bodega2"  <?php if($descripcion=="bodega2")echo "selected";?>>Bodega 2</option>
            <option value="bodega3"  <?php if($descripcion=="bodega3")echo "selected";?>>Bodega 3</option>
            <option value="utp"  <?php if($descripcion=="utp")echo "selected";?>>UTP</option>
            <option value="inspectoria"  <?php if($descripcion=="inspectoria")echo "selected";?>>Inspectoria</option>
            <option value="secretaria"  <?php if($descripcion=="secretaria")echo "selected";?>>Secretaria</option>
            <option value="orientacion"  <?php if($descripcion=="orientacion")echo "selected";?>>Orientacion</option>
            <option value="direccion"  <?php if($descripcion=="direccion")echo "selected";?>>Dirección</option>
            <option value="profesorado"  <?php if($descripcion=="profesorado")echo "selected";?>>Profesorado</option>
            </select>
            -->
            <input type="text" name="descripcion" value="<?=$descripcion?>" size="20" />
            </td>
        </tr>
        <tr>
        <tr>
        <td colspan="2"><hr /></td>
        </tr>
        	<td colspan="1">
            <input name="opcion" type="submit" value="crear" class="boton"/>
            </td>
            <td><input name="opcion" type="submit" value="actualizar"  class="boton"/></td>
            </tr>
            <tr>
            <td><input name="opcion" type="reset" value="Limpiar"  class="boton" onclick="javascript:location.href='ubicacion.php';"/>
            </td>
            </tr>
        <tr>
        	<td colspan="3"><?php if(isset($_GET["mensaje"]) && $_GET["mensaje"]!="")echo $_GET["mensaje"]; ?></td>
        </tr>
    </table>
</form>
<hr />
<?php
$cant_pagina = 5;
require_once("libs/Zebra_Pagination-master/Zebra_Pagination.php");
$paginadorZebra = new Zebra_Pagination();
$cantidadRegistros = mysqli_num_rows(mysqli_query(Conexion(),"select ubicacion.UB_IDUBICACION from ubicacion"));


$paginar_resultados = "select * FROM ubicacion ORDER BY UB_IDUBICACION ASC LIMIT ".(( $paginadorZebra->get_page() - 1 ) * $cant_pagina ).",  " . $cant_pagina;
?>
<div style="overflow:auto;">
<table width="500" align="center" class="table-hover" style="font-size:12px;">
<tr><td colspan="5">cantidad registros:<?=$cantElementos[0]?></td></tr>
<tr>
<td colspan="5" class="text-center">listado de ubicaciones</td>
</tr>
<tr>
<td>codigo interno</td>
<td>N° sala</td>
<td>Nº piso</td>
<td>descripcion</td>
<td colspan="2">opciones</td>
</tr>
<?php
	$recurso = mysqli_query(Conexion(),$paginar_resultados);
	if (!$recurso) {
    	printf("Error: %s\n", mysqli_error($link));
    	exit();
		}
	while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
	{
		echo "<tr><td>".$fila[0]."</td><td>".$fila[1]."<td>".$fila[2]."</td><td>".$fila[3]."</td>";
		echo '<td><span class="glyphicon glyphicon-pencil" title="editar" onclick=javascript:cargar('.$fila[0].')></span></td>';
    	echo '<td><span class="glyphicon glyphicon-remove" title="borrar" onclick=javascript:borrar('.$fila[0].');></span></td>';
    	echo '</tr>';
	}
?>
</table>
<?=$paginadorZebra->render();?>
</div>
<script type="text/javascript">
function cargar(id)
{
	if(confirm("¿Desea cargar esta opcion para edicion?"))
	{
			window.location ='ubicacion.php?cargar=cargarDatos&id=' + id;
	}
}
function borrar(id)
{
	if(confirm("¿Realmente desea borrar esta opcion?"))
	{
			window.location ='ubicacion.php?cargar=borrarDatos&id=' + id;
	}
}
</script>

            </div>
        </div>
    	<!-- aca finaliza el cuerpo y el resto del contenido -->
    </div>
</div>
</body>
</html>