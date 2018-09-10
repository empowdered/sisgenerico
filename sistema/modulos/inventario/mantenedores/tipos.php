<?php require("control.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<link rel="stylesheet" href="libs/Zebra_Pagination-master/public/css/zebra_pagination.css" />
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css"/>
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>pantalla de inicio</title>
</head>
<?php
error_reporting(0);
require("conexion.php");
$resultado = mysqli_query(Conexion(),"select count(tipo.TIP_IDTIPO) FROM tipo");
$cantElementos = mysqli_fetch_row($resultado);
$id="";
$tipo = "";
$descripcion = "";
$opcion = "";
//*******************estas 2 son las variables para cargar el tipo
$cargar = "";
//*******************fin de carga de variables
$recurso = NULL;
if(isset($_GET["cargar"]) && $_GET["cargar"]!=""){$cargar= $_GET["cargar"];}
if(isset($_GET["id"]) && $_GET["id"]!=""){$id= $_GET["id"];}
if(isset($_POST["id"]) && $_POST["id"]!=""){$id= $_POST["id"];}
if($id!="" && $cargar!="" && $cargar=="cargarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
$selectTipo = "select * from tipo where tipo.TIP_IDTIPO='$id'";
if($fila=mysqli_fetch_row(mysqli_query(Conexion(),$selectTipo)))
{
$id = $fila[0];
$tipo = $fila[1];
$descripcion = $fila[2];
}
}
if($id!="" && $cargar!="" && $cargar=="borrarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
$borrarTipo = "delete from tipo where tipo.TIP_IDTIPO = '$id'";
if(mysqli_query(Conexion(),$borrarTipo))
{
header("Location: tipos.php?mensaje=registro borrado exitosamente");
exit();
}
else
{
header("Location: tipos.php?mensaje=imposible borrar, existe un registro asociado");
exit();
}
}
if(isset($_POST["tipo"]) && $_POST["tipo"]!=""){$tipo= $_POST["tipo"];}
if(isset($_POST["descripcion"]) && $_POST["descripcion"]!=""){$descripcion = $_POST["descripcion"];}
if(isset($_POST["id"]) && $_POST["id"]!=""){$id = $_POST["id"];}
if(isset($_POST["opcion"]) && $_POST["opcion"]!=""){$opcion = $_POST["opcion"];}
if($tipo!="" && $descripcion!="" && $opcion!="")
//inicio del consultar por variables vacias
{
//********************************************************************************************************
if($opcion=="crear")
//inicio de la opcion crear
{	
$crearTipo = "INSERT INTO sisgen.tipo (TIP_NBTIPO,TIPO_DESCTIPO) VALUES('$tipo', '$descripcion')";
$recurso = mysqli_query(Conexion(),$crearTipo);
if($recurso!=NULL)
//inicio de la consulta del recurso != null
{
mysqli_free_result($recurso);
header("Location: tipos.php?mensaje=creacion de la categoria ingresada, ha sido realizado de manera exitosa!!");
}
else
//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
{
mysqli_free_result($recurso);
header("Location: tipos.php?mensaje=no se pudo crear el tipo ingresado");
}
}//fin del crear
//*****************************************************************************************************
if($opcion=="actualizar")
//inicio del actualizar
{
$actualizarTipo = "UPDATE sisgen.tipo SET TIP_NBTIPO = '$tipo', `TIPO_DESCTIPO` = '$descripcion' WHERE tipo.TIP_IDTIPO = '$id'";
$recurso = mysqli_query(Conexion(),$actualizarTipo);
if($recurso!=NULL)
//inicio de la consulta del recurso != null
{
mysqli_free_result($recurso);
header("Location: tipos.php?mensaje=actualizacion del tipo ingresado, exitosa");
}
else
//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
{
mysqli_free_result($recurso);
header("Location: tipos.php?mensaje=no se pudo actualizar el tipo ingresado");
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
            <form action="tipos.php" method="post">
            <input type="hidden" value="<?=$id?>" name="id" />
	<table width="500" align="center" class="table-hover" style="font-size:12px;">
    <th colspan="5" class="text-center">mantenedor de tipos(categorias)</th>
    	<tr>
        	<td>Nombre Tipo:</td>
            <td><input name="tipo" type="text" size="20" value='<?=$tipo?>'/></td>
            	
        	<td></td>
        </tr>
        <tr>
        	<td valign="top">Descripcion:</td>
            <td>
            <textarea name="descripcion" rows="8" cols="30" style="text-align:left;"><?=trim($descripcion)?></textarea>
            </td>
            <td></td>
        </tr>
        <tr>
        	<td colspan="3">
            <input name="opcion" type="submit" value="crear" class="boton"/>
            <input name="opcion" type="submit" value="actualizar" class="boton"/>
            <input name="opcion" type="button" value="limpiar" class="boton" onclick="javascript:window.location='tipos.php';"/>
            </td>
        </tr>
        <tr>
                <td colspan="3"><?php if(isset($_GET["mensaje"]) && $_GET["mensaje"]!=""){echo $_GET["mensaje"];}?></td>
        </tr>
    </table>
</form>
<hr />
<div class="row" id="despliegue">
<?php
$cant_pagina = 5;
require_once("libs/Zebra_Pagination-master/Zebra_Pagination.php");
$paginadorZebra = new Zebra_Pagination();
$cantidadRegistros = mysqli_num_rows(mysqli_query(Conexion(),"select * from tipo"));
$paginar_resultados = "select * from tipo order by TIP_IDTIPO  limit " .(( $paginadorZebra->get_page() - 1 ) * $cant_pagina ) . ",  " . $cant_pagina;
$paginadorZebra->records($cantidadRegistros);
$paginadorZebra->records_per_page($cant_pagina);
?>
<table width="600" align="center" class="table-hover" style="font-size:12px;">
<tr><td colspan="5">cantidad de registros:<?=$cantElementos[0]?></td></tr>
<tr>
<td colspan="5" class="text-center">listado de tipos o categorias de hardware</td>
</tr>
<tr>
<td>codigo interno</td>
<td>nombre especifico</td>
<td>descripcion</td>
<td colspan="3">opciones</td>
</tr>
<?php
$recurso = mysqli_query(Conexion(),$paginar_resultados);
if(!$recurso) 
{
printf("Error: %s\n", mysqli_error(Conexion()));
exit();
}
while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
{
echo "<tr><td>".$fila[0]."</td><td>".$fila[1]."<td>".$fila[2]."</td>";
echo '<td><span class="glyphicon glyphicon-pencil" title="editar" onclick=cargar('.$fila[0].');></span></td>';
echo '<td><span class="glyphicon glyphicon-remove" title="borrar" onclick=borrar('.$fila[0].');></span></td>';
echo '</tr>';
}
?>
</table>
<?php
$paginadorZebra->render();
?>
<script type="text/javascript">
function cargar(id)
{
//alert(id);
if(confirm("¿Desea cargar esta opcion para edicion?"))
{
window.location = "tipos.php?cargar=cargarDatos&id=" + id;
}	
}
function borrar(id)
{
//alert(id);
if(confirm("¿Realmente desea borrar esta opcion?"))
{
window.location = "tipos.php?cargar=borrarDatos&id=" + id;
}	
}
</script>
</div>
            </div>
        </div>
    	<!-- aca finaliza el cuerpo y el resto del contenido -->
    </div>
</div>
</body>
</html>