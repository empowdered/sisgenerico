<?php 
//require("control.php")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="libs/Zebra_Pagination-master/public/css/zebra_pagination.css" />
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mantenedor de marca</title>
</head>
<?php
error_reporting(1);
require("conexion.php");
$id = "";
$marca = "";
$observacion ="";
$opcion = "";
$cargar = "";
$resultado = mysqli_query($link,"select count(marca.MAR_IDMARCA) FROM marca");
$cantElementos = mysqli_fetch_row($resultado);
$recurso=NULL;

if(isset($_POST["id"]) && $_POST["id"]!=""){$id = $_POST["id"];}
if(isset($_GET["id"]) && $_GET["id"]!=""){$id = $_GET["id"];}
if(isset($_POST["marca"]) && $_POST["marca"]!=""){$marca = $_POST["marca"];}
if(isset($_POST["observacion"]) && $_POST["observacion"]!=""){$observacion = $_POST["observacion"];}
if(isset($_POST["opcion"]) && $_POST["opcion"]!=""){$opcion = $_POST["opcion"];}
if(isset($_GET["cargar"]) && $_GET["cargar"]!=""){$cargar= $_GET["cargar"];}

if($cargar=="cargarDatos")
{
$select = "call selectMarca('$id')";
$recurso = mysqli_query(Conexion(),$select);
if($recurso!=NULL)
{
$fila = mysqli_fetch_row($recurso);
$id = $fila[0];
$marca = $fila[1];
$observacion = $fila[2];
}
}
if($cargar=="borrarDatos")
{
$delete = "delete from marca where MAR_IDMARCA='$id'";
$recurso = mysqli_query(Conexion(),$delete);
if($recurso!=NULL)
{
header("Location: marca.php?mensaje=registro borrado exitosamente");
}
}
if($marca!="" && $observacion!=""  && $opcion!="")
{
if($opcion=="Crear")
{
$crearMarca = "call insertaMarca('$marca','$observacion')";
$recurso = mysqli_query(Conexion(),$crearMarca);
if($recurso!=NULL)
{
$fila = mysqli_fetch_row($recurso);
if($fila[0]=="ok")header("Location:marca.php?mensaje=registro creado exitosamente");
}
}
if($opcion=="Actualizar")
{
$actualizaMarca = "call actualizaMarca('$id','$marca','$observacion')";
$recurso = mysqli_query(Conexion(),$actualizaMarca);
if($recurso!=NULL)
{
$fila = mysqli_fetch_row($recurso);
if($fila[0]=="ok"){header("Location:marca.php?mensaje=registro actualizado exitosamente");}
}
}
}
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
<?php if(isset($_GET["mensaje{"])){echo $_GET["mensaje"];} ?>
            <form action="marca.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>" />
        <table align="center" width="450" style="font-size:12px;">
        <th colspan="2" style="text-align:center;">mantenedor de marca</th>
        <tr>
        <td>nombre de la marca:</td>
        <td>
<input type="text" name="marca" value="<?=$marca?>" size="20" />
        </td>
        </tr>
        <tr>
        <td valign="top">observaciones:</td>
        <td>
<textarea cols="40" rows="10" name="observacion">
<?=rtrim($observacion)?>
</textarea>
        </td>
        </tr>
        <tr><td colspan="2"><hr></hr></td></tr>
        <tr>
        <td><input type="submit" name="opcion" value="Crear" class="boton"/></td>
        <td><input type="submit" name="opcion" value="Actualizar" class="boton" /></td>
        </tr>
        <tr>
        <td>
        <input type="button" name="opcion" value="Limpiar" class="boton" onclick="javascript:window.location='marca.php';"/>
        </td>
        </tr>
        </table>
        </form>
        <div id="despliegue">
<?php
$link = Conexion();
$cant_pagina = 5;
include_once("libs/Zebra_Pagination-master/Zebra_Pagination.php");
$paginadorZebra = new Zebra_Pagination();
$cantidadRegistros = mysqli_num_rows(mysqli_query($link,"select marca.MAR_IDMARCA from marca"));
$paginar_resultados = "select marca.MAR_IDMARCA,marca.MAR_NBMARCA,marca.MAR_FCREACION from marca  
order by marca.MAR_IDMARCA  limit " . (( $paginadorZebra->get_page() - 1 ) * $cant_pagina ) . ",  " . $cant_pagina;
$paginadorZebra->records($cantidadRegistros);
$paginadorZebra->records_per_page($cant_pagina);
?>
<hr />
<table width="500" align="center" class="table-hover" style="font-size:12px;">
<tr>
<td colspan="6">cantidad de registros:<?=$cantElementos[0]?></td>
</tr>
</tr>
<td colspan="6" class="text-center">listado de programas</th>
<tr>
<td>codigo</td>
<td>nombre marca</td>
<td>fecha de creacion</td>
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
echo "<tr><td>".$fila[0]."</td><td>".$fila[1]."<td>".$fila[2]."</td>";
echo '<td><span class="glyphicon glyphicon-pencil" title="editar" onclick=javascript:cargar('.$fila[0].');></span></td>';
echo '<td><span class="glyphicon glyphicon-remove" title="borrar" onclick=javascript:borrar('.$fila[0].');></span></td>';
echo '</tr>';
    
}
?>
</table>
<?=$paginadorZebra->render()?>
</div>
            </div>
        </div>
    	<!-- aca finaliza el cuerpo y el resto del contenido -->
    </div>
</div>
<script type="text/javascript">
function cargar(id)
{
//alert(id);
if(confirm("¿Desea cargar esta opcion para edicion?"))
{
window.location = "marca.php?cargar=cargarDatos&id=" + id;
}	
}
function borrar(id)
{
//alert(id);
if(confirm("¿Realmente desea borrar esta opcion?"))
{
window.location = "marca.php?cargar=borrarDatos&id=" + id;
}	
}
</script>
</body>
</html>