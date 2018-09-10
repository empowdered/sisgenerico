<?php 
//require("control.php")
?>
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
<script type="text/javascript">
function validar(id)
{
var ano = document.getElementById(id);
if(ano.value >0 || ano.value<=1000000)
{
ano.value = ano.value + '-01-01';	
}
}
</script>
</head>
<?php
error_reporting(1);
require("conexion.php");
$recurso = NULL;
$resultado = mysqli_query(Conexion(),"select count(software.SOF_IDSOFTW) FROM software");
$cantElementos = mysqli_fetch_row($resultado);
$link  = Conexion();
$id="";
$idequipo ="";
$nbsoftware = "";
$tiposoftware="";
$arquitectura ="";
$empresa ="";
$activacion="";
$anoversion="";
$fcreacion ="";
$version="";
$pagina="";
$opcion = "";
//*******************estas 2 son las variables para cargar el tipo
$cargar = "";
//*******************fin de carga de variables
$actualizarSoftware = "";

if(isset($_POST["idequipo"]) && $_POST["idequipo"]!=""){$idequipo= $_POST["idequipo"];}
if(isset($_POST["nbsoftware"]) && $_POST["nbsoftware"]!=""){$nbsoftware= $_POST["nbsoftware"];}
if(isset($_POST["tiposoftware"]) && $_POST["tiposoftware"]!=""){$tiposoftware= $_POST["tiposoftware"];}
if(isset($_POST["arquitectura"]) && $_POST["arquitectura"]!=""){$arquitectura= $_POST["arquitectura"];}
if(isset($_POST["empresa"]) && $_POST["empresa"]!=""){$empresa= $_POST["empresa"];}
if(isset($_POST["activacion"]) && $_POST["activacion"]!=""){$activacion= $_POST["activacion"];}
if(isset($_POST["anoversion"]) && $_POST["anoversion"]!=""){$anoversion= $_POST["anoversion"];}
if(isset($_POST["fcreacion"]) && $_POST["fcreacion"]!=""){$fcreacion = $_POST["fcreacion"];}
if(isset($_POST["version"]) && $_POST["version"]!=""){$version= $_POST["version"];}
if(isset($_POST["pagina"]) && $_POST["pagina"]!=""){$pagina= $_POST["pagina"];}
if(isset($_POST["opcion"]) && $_POST["opcion"]!=""){$opcion = $_POST["opcion"];}
if(isset($_GET["cargar"]) && $_GET["cargar"]!=""){$cargar= $_GET["cargar"];}
if(isset($_GET["id"]) && $_GET["id"]!=""){$id = $_GET["id"];}
if(isset($_POST["id"]) && $_POST["id"]!=""){$id = $_POST["id"];}
if($id!="" && $cargar!="" && $cargar=="cargarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
$fila=NULL;
$selectSoftware = "select * from software where software.SOF_IDSOFTW = '$id'";
$fila=mysqli_fetch_row(mysqli_query($link,$selectSoftware));
if($fila!==NULL)
{
$id=$fila[0];
$idequipo =$fila[1];
$nbsoftware =  $fila[2];
$tiposoftware=$fila[3];;
$arquitectura =$fila[4];
$empresa =$fila[5];
$activacion=$fila[6];;
$anoversion=$fila[7];
$fcreacion =$fila[8];
$version=$fila[9];
$pagina=$fila[10];
}
}
if($id!="" && $cargar!="" && $cargar=="borrarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
$borrarSoftware = "delete from software where software.SOF_IDSOFTW ='$id'";
if(mysqli_query($link,$borrarSoftware))
{
header("Location: Software.php?mensaje=registro borrado exitosamente");
exit();
}
}


if($idequipo!="" && $nbsoftware!="" && $tiposoftware!="" && $arquitectura !="" && $empresa!="" && $activacion!="" && $version!="" && $pagina !="")
//inicio del consultar por variables vacias
{
//********************************************************************************************************
if($opcion=="crear")
//inicio de la opcion crear
{	
$consultarSoftware = "CALL consultaSO($idequipo)";
$recurso = mysqli_query(Conexion(),$consultarSoftware);
if($recurso)
{
$fila = mysqli_fetch_row($recurso);
if($fila[0]=='2')
{
header("Location: Software.php?mensaje=ya existe un sistema operativo instalado, para esta maquina");
//echo "<div style='color:white;'>".$fila[0]."</div>";
//echo '<META http-equiv="refresh" content="0;URL=Software.php?mensaje=existe un SO,activo e instalado,favor setear a inactivo">';
 exit(); 
}
else if($fila[0]=='1')
{
//mysqli_free_result($recurso);
$crearSoftware = "INSERT INTO sisgen.software(EQ_IDEQUIPO,SOF_NBSOFTW,SOFT_TIPOSOFTW,SOFT_ARQUITEC,SOFT_EMPRESA, SOFT_ACTIVADO,SOFT_ANOVERS,SOF_FCREACION";
$crearSoftware .= ",SOFT_VERSION,SOFT_WEBSOFT) VALUES('$idequipo', '$nbsoftware', '$tiposoftware', '$arquitectura', '$empresa', '$activacion',";
$crearSoftware .= "'$anoversion', now(), '$version', '$pagina')";
$recurso=NULL;
$recurso = mysqli_query(Conexion(),$crearSoftware);
if($recurso)
//inicio de la consulta del recurso != null
{
//mysqli_free_result($recurso);
header("Location: Software.php?mensaje=creacion del sfw ingresado, exitosa");
exit();
}
else
//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
{
//mysqli_free_result($recurso);
header("Location: Software.php?mensaje=no se pudo crear el sftw ingresado");
exit();
}
}
}
}
////fin del crear
//}
//*****************************************************************************************************
if($opcion=="actualizar")
//inicio del actualizar
{
$actualizarSoftware = "UPDATE sisgen.software SET EQ_IDEQUIPO=$idequipo,SOF_NBSOFTW='$nbsoftware', SOFT_TIPOSOFTW='$tiposoftware',SOFT_ARQUITEC='$arquitectura',SOFT_EMPRESA='$empresa',SOFT_ACTIVADO='$activacion', 
SOFT_ANOVERS='$anoversion',SOF_FCREACION='$fcreacion',SOFT_VERSION='$version',SOFT_WEBSOFT='$pagina'
WHERE software.SOF_IDSOFTW = '$id'";
if(mysqli_query(Conexion(),$actualizarSoftware))
//inicio de la consulta del recurso != null
{
header("Location: Software.php?mensaje=actualizacion del software ingresado, exitosa");
//echo "<script>alert('actualizacion ok!');
exit();
}
else
//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
{
header("Location: Software.php?mensaje=no se pudo actualizar software ingresado");
//echo "<script>alert('actualizacion no!');
exit();
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
        <form action="Software.php" method="post" id="software" name="software">
        <input type="hidden" name="id" value="<?=$id?>" />
            	<table width="600" align="center" class="table-hover" style="font-size:12px;">
                <th colspan="6" class="text-center">mantenedor de programas o software</th>
<tr>
<td width="71">serie equipo:</td>
<td width="179">
<?php
$vacio = "";
$selected = "";
if($idequipo=="")
{
$vacio="selected='selected'";   
}
?>
<select id="idequipo" name="idequipo">
<option value="" <?=$vacio?>>Seleccione</option>
<?php
$fila=NULL;
$ubicacion = "select equipo.EQ_IDEQUIPO, equipo.EQ_SERIEEQUIPO FROM equipo";
$recurso = mysqli_query(Conexion(),$ubicacion);
if($recurso)
{
while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
{
if($idequipo == $fila[0])
{
echo "<option value='".$fila[0]."' selected='selected' >".$fila[1]."</option>";
}
else { echo "<option value='".$fila[0]."'>".$fila[1]."</option>"; }
}
}
mysqli_free_result($recurso);
?>
</select>
</td>
<td width="97">Nombre Software</td>
<td width="166"><input name="nbsoftware" type="text" value="<?=$nbsoftware?>" size="25" maxlength="20" /></td>
</tr>
<tr>
<td>Tipo Software:</td>
<td>
<select name="tiposoftware" id="tiposoftware" />
<option value=""  <?php if($tiposoftware==""){echo "selected='selected'";}?>>Seleccione</option>
<option value="sistema operativo" <?php if($tiposoftware=="sistema operativo"){echo "selected='selected'";}?>>Sistema operativo</option>
<option value="ofimatica" <?php if($tiposoftware=="ofimatica"){echo "selected='selected'";}?>>Ofimatica</option>
<option value="diseño" <?php if($tiposoftware=="diseño"){echo "selected='selected'";}?>>Diseño</option>
<option value="educativo" <?php if($tiposoftware=="educativo"){echo "selected='selected'";}?>>Educativo</option>
<option value="ingenieria" <?php if($tiposoftware=="ingenieria"){echo "selected='selected'";}?>>ingenieria</option>
<option value="mantencion" <?php if($tiposoftware=="mantencion"){echo "selected='selected'";}?>>mantencion</option>
<option value="antivirus" <?php if($tiposoftware=="antivirus"){echo "selected='selected'";}?>>antivirus</option>
</select>
</td>
<td>Arquitectura (x64;32):</td>
<td>
<select id="arquitectura" name="arquitectura">
<option value="" <?php if($arquitectura=="")echo "selected='selected'";?>>Escoja</option>
<option value="64bits" <?php if($arquitectura=="64bits")echo "selected='selected'";?>>64 bits</option>
<option value="32bits" <?php if($arquitectura=="32bits")echo "selected='selected'";?>>32 bits</option>
</select>
</td>
</tr>
<tr>
<td colspan="1">Empresa:</td>
<td colspan="3" style="text-align:left;"><input name="empresa" type="text" value="<?=$empresa?>" size="25" maxlength="20" /></td>
</tr>
<tr>
<td>Estado:</td>
<td>
<select id="activacion" name="activacion">
<option value="" <?php if($activacion==""){echo "selected='selected'";}?>>Escoja</option>
<option value="activo" <?php if($activacion=="activo"){echo "selected='selected'";}?>>activo</option>
<option value="inactivo" <?php if($activacion=="inactivo"){echo "selected='selected'";}?>>inactivo</option>
</select>
</td>
<td>Año Version</td>
<td><input type="text" name="anoversion" id="anoversion" value="<?=$anoversion?>" size="25" format="yyyy-MM-dd" onchange="validar('anoversion');"/></td>
</tr>
<tr>
<td>fecha creacion:</td>
<td><input  name="fcreacion" type="text" value="<?=$fcreacion?>" size="25" /></td>
<td><span style="text-align:left;">N° Version:</span></td>
<td><span style="text-align:left;">
  <input type="text" name="version" value="<?=$version?>" size="25" />
</span></td>
</tr>
<tr>
<td>Web Fabricante</td>
<td><input type="text" name="pagina" value="<?=$pagina?>" size="25" /></td>
<td colspan="2"></td>
</tr>
                <tr><td colspan="4"><hr></td></tr>
        <tr>
        	<td colspan="4">
            <input name="opcion" type="submit" value="crear" class="boton"/>
            <input name="opcion" type="submit" value="actualizar" class="boton"/>
            <input name="opcion" type="button" value="limpiar" class="boton" onclick="javascript:window.location='Software.php';"/>
            </td>
        </tr>
        <tr>
        	<td colspan="4" class="text-warning"><?php if(isset($_GET["mensaje"]) && $_GET["mensaje"]!="")echo $_GET["mensaje"]; ?></td>
        </tr>
    </table>
</form>
<?php
$cant_pagina = 5;
include_once("libs/Zebra_Pagination-master/Zebra_Pagination.php");
$paginadorZebra = new Zebra_Pagination();
$cantidadRegistros = mysqli_num_rows(mysqli_query(Conexion(),"select SOF_IDSOFTW from software"));
$paginar_resultados = "select software.SOF_IDSOFTW, software.SOF_NBSOFTW, software.SOFT_EMPRESA from software  order by software.SOF_IDSOFTW "
        . " limit " . (( $paginadorZebra->get_page() - 1 ) * $cant_pagina ) . ", " . $cant_pagina;
$paginadorZebra->records($cantidadRegistros);
$paginadorZebra->records_per_page($cant_pagina);
?>
<hr />
<table width="600" align="center" class="table-hover" style="font-size:12px;">
<tr><td>cantidad de registros:<?=$cantElementos[0]?></td></tr>
<tr>
<td colspan="6" class="text-center">listado de programas</td>
</tr>
<tr>
<td>codigo interno</td>
<td>nombre especifico</td>
<td>descripcion</td>
<td colspan="2">opciones</td>
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
echo '<td><span class="glyphicon glyphicon-pencil" title="editar" onclick=javascript:cargar('.$fila[0].');></span></td>';
echo '<td><span class="glyphicon glyphicon-remove" title="borrar" onclick=javascript:borrar('.$fila[0].');></span></td>';
echo '</tr>';
}
?>
</table>
<?php 
$paginadorZebra->render(); 
mysqli_free_result($recurso);
?>
<script type="text/javascript">
function cargar(id)
{
if(confirm("¿Desea cargar esta opcion para edicion?"))
{
window.location ='Software.php?cargar=cargarDatos&id=' + id;
}
}
function borrar(id)
{
if(confirm("¿Realmente desea borrar esta opcion?"))
{
window.location ='Software.php?cargar=borrarDatos&id=' + id;
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