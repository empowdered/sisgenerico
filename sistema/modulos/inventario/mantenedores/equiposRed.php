<?php 
//require("control.php")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="libs/Zebra_Pagination-master/public/css/zebra_pagination.css" />
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css"/>
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/datetimepicker_css.js"></script>
<link rel="stylesheet" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mantenedor de equipos de red</title>
</head>
<?php
error_reporting(0);
require("conexion.php");
$resultado = mysqli_query(Conexion(),"select count(red.RED_IDRED) FROM red");
$cantElementos = mysqli_fetch_row($resultado);
$recurso=NULL;
$tipo="";
$ubicacion ="";
$marca ="";
$modelo ="";
$serie="";
$tipoEquipo ="";
$estado ="";
$costo ="";
$mac ="";
$bocas ="";
$ipinicial ="";
$ptaenlace ="";
$mascara ="";
$usuario ="";
$clave ="";
$fingreso ="";
$fechaGuardada ="";
$fcreacion ="";
$costo = "";
$opcion = "";
$id = "";
$fila=NULL;
//*******************estas 2 son las variables para cargar el tipo
$cargar = "";
//*******************fin de carga de variables

if(isset($_GET["cargar"]) && $_GET["cargar"]!=""){$cargar= $_GET["cargar"];}
if(isset($_GET["id"]) && $_GET["id"]!=""){$id= $_GET["id"];}
if(isset($_POST["id"]) && $_POST["id"]!=""){$id= $_POST["id"];}

if($id!="" && $cargar!="" && $cargar=="cargarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
$selectRed = "select * from red where red.RED_IDRED='$id'";
$fila=mysqli_fetch_row(mysqli_query(Conexion(),$selectRed));
if($fila)
{
$id = $fila[0];
$tipo=$fila[1];
$ubicacion =$fila[2];
$marca =$fila[3];
$modelo =$fila[4];
$serie=$fila[5];
$tipoEquipo =$fila[6];
$estado =$fila[7];
$mac =$fila[8];
$bocas =$fila[9];
$ipinicial =$fila[10];
$ptaenlace =$fila[11];
$mascara =$fila[12];
$usuario =$fila[13];
$clave =$fila[14];
$fingreso =$fila[15];
$fcreacion =$fila[16];
$costo = $fila[17];
}
}
if($id!="" && $cargar!="" && $cargar=="borrarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
$borrarRed = "delete from red where red.RED_IDRED='$id'";
if(mysqli_query(Conexion(),$borrarRed))
{
header("Location: equiposRed.php?mensaje=registro borrado exitosamente");
exit();
}
}
if(isset($_POST["tipo"]) && $_POST["tipo"]!=""){$tipo = $_POST["tipo"];}
if(isset($_POST["ubicacion"]) && $_POST["ubicacion"]!=""){$ubicacion = $_POST["ubicacion"];}
if(isset($_POST["marca"]) && $_POST["marca"]!=""){$marca = $_POST["marca"];}
if(isset($_POST["modelo"]) && $_POST["modelo"]!=""){$modelo = $_POST["modelo"];}
if(isset($_POST["serie"]) && $_POST["serie"]!=""){$serie = $_POST["serie"];}
if(isset($_POST["tipoEquipo"]) && $_POST["tipoEquipo"]!=""){$tipoEquipo = $_POST["tipoEquipo"];}
if(isset($_POST["estado"]) && $_POST["estado"]!=""){$estado = $_POST["estado"];}
if(isset($_POST["mac"]) && $_POST["mac"]!=""){$mac = $_POST["mac"];}
if(isset($_POST["bocas"]) && $_POST["bocas"]!=""){$bocas = $_POST["bocas"];}
if(isset($_POST["ipinicial"]) && $_POST["ipinicial"]!=""){$ipinicial = $_POST["ipinicial"];}
if(isset($_POST["ptaenlace"]) && $_POST["ptaenlace"]!=""){$ptaenlace = $_POST["ptaenlace"];}
if(isset($_POST["mascara"]) && $_POST["mascara"]!=""){$mascara = $_POST["mascara"];}
if(isset($_POST["usuario"]) && $_POST["usuario"]!=""){$usuario = $_POST["usuario"];}
if(isset($_POST["clave"]) && $_POST["clave"]!=""){$clave = $_POST["clave"];}
if(isset($_POST["fingreso"]) && $_POST["fingreso"]!=""){$fingreso = $_POST["fingreso"];}
if(isset($_POST["fechaGuardada"]) && $_POST["fechaGuardada"]!=""){$fechaGuardada = $_POST["fechaGuardada"];}
//si la fecha de ingreso esta en vacio, se mantienen la anterior
if($fingreso=="")
{
$fingreso = $fechaGuardada;
}
//nunca se insertara u actualizara con la variable $fechaGuardada
if(isset($_POST["fcreacion"]) && $_POST["fcreacion"]!=""){$fcreacion = $_POST["fcreacion"];}
if(isset($_POST["costo"]) && $_POST["costo"]!=""){$costo= $_POST["costo"];}

if(isset($_POST["opcion"]) && $_POST["opcion"]!=""){$opcion= $_POST["opcion"];}

if($opcion!="")
//inicio del consultar por variables vacias * recuerda llenarlas !!!
{
//********************************************************************************************************
if($opcion=="crear")
//inicio de la opcion crear
{	
$crearRed = "INSERT INTO `sisgen`.`red` (`TIP_IDTIPO`, `UB_IDUBICACION`, `RED_MARCAEQUIPO`, `RED_MODELO`, 
`RED_SERIERED`, `RED_TIPOEQUIPO`, `RED_ESTADO`, `RED_MACEQUIPO`, `RED_NROBOCAS`, `RED_IPINICIAL`, `RED_PTAENLACE`, 
`RED_MASCARA`, `RED_USUARIO`, `RED_CLAVE`, `RED_FINGRESO`, `RED_FCREACION`, `RED_COSTO`)
VALUES ( '$tipo', '$ubicacion', '$marca', '$modelo', '$serie', '$tipoEquipo', '$estado', '$mac', '$bocas', '$ipinicial',
 '$ptaenlace', '$mascara', '$usuario', '$clave', '$fingreso',now(), '$costo')";
$recurso = mysqli_query(Conexion(),$crearRed);
if($recurso!=NULL)
//inicio de la consulta del recurso != null
{
header("Location: equiposRed.php?mensaje=creacion del equipo de red ingresado, exitosa");
}
else
//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
{
header("Location: equiposRed.php?mensaje=no se pudo crear el equipo de red ingresado");
}
}//fin del crear
//*****************************************************************************************************
if($opcion=="actualizar")
//inicio del actualizar
{
$actualizarRed= "UPDATE `sisgen`.`red` SET 
`TIP_IDTIPO` = '$tipo', 
`UB_IDUBICACION` = '$ubicacion',   
`RED_MARCAEQUIPO` = '$marca',
`RED_MODELO` = '$modelo',
`RED_SERIERED` = '$serie', 
`RED_TIPOEQUIPO` = '$tipoEquipo', 
`RED_ESTADO` = '$estado', 
`RED_MACEQUIPO` = '$mac', 
`RED_NROBOCAS` = '$bocas',
`RED_IPINICIAL` = '$ipinicial', 
`RED_PTAENLACE` = '$ptaenlace',
`RED_MASCARA` = '$mascara', 
`RED_USUARIO` = '$usuario',
`RED_CLAVE` = '$clave',  
`RED_FINGRESO` = '$fingreso', 
`RED_FCREACION` = '$fcreacion',
`RED_COSTO` = '$costo' 
WHERE `red`.`RED_IDRED` ='".$id."'"; 	
$recurso = mysqli_query(Conexion(),$actualizarRed);
if($recurso!=NULL)
//inicio de la consulta del recurso != null
{
header("Location: equiposRed.php?mensaje=actualizacion del equipo de red ingresado, exitosa");
}
else
//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
{
header("Location: equiposRed.php?mensaje=no se pudo actualizar el equipo de red ingresado");
}
}//fin del actualizar
//***************************************************************************
}//fin del preguntar si variables llegan vacias o no
?>
<body>
<div class="container">
<!-- aca le colocamos una cabecera, para que se vea mas lindo -->
<div class="row text-center" id="cabecera"></div>
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
<div class="alert text-center"><hr />
<form action="equiposRed.php" method="post">
<input type="hidden" name="id" value="<?=$id?>" />
<table width="600" align="center" class="table-hover" style="font-size:12px;">
<tr><td colspan="4" class="text-center">mantenedor de equipos de red</td>
</tr>
<tr>
<td>Tipo u Categoria:</td>
<?php
$recurso = NULL;
$tipox = "select tipo.TIP_IDTIPO,tipo.TIP_NBTIPO FROM tipo order by tipo.TIP_NBTIPO ASC";
$recurso = mysqli_query(Conexion(),$tipox);
$vacio = "";
$selected="";
if($tipo=="")
{
$vacio = "selected ='selected'";
}
?>
<td>
<select id="tipo" name="tipo">
<option value="" <?=$vacio?>>Seleccionar</option>
<?php
if($recurso)
{
while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
{
if($tipo==$fila[0])
{    
echo "<option value='".$fila[0]."' selected='selected' >".$fila[1]."</option>";	
}
else 
{
echo "<option value='".$fila[0]."'  >".$fila[1]."</option>";	  
}
}
}
?>
</select>
</td>
<td>Ubicacion:</td>
<?php
$vacio="";
$selected ="";
if($ubicacion==""){$vacio="selected='selected'";}
$ubicacionx = "select * FROM ubicacion order by ubicacion.UB_IDUBICACION ASC";
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
if($ubicacion==$fila[0])
{
echo "<option value='".$fila[0]."' selected='selected'>".$fila[3].", N° ".$fila[1].", piso ".$fila[2]."</option>";	
}
else 
{   
echo "<option value='".$fila[0]."' >".$fila[3].", N° ".$fila[1].", piso ".$fila[2]."</option>";	
}
}
}
?>
</select>
</td>
</tr>
<tr>
<td>marca:</td>
<td><select name="marca">
<option value="">Seleccione</option>
<?php
$cargarMarca = "call obtieneMarca()";
$recurso = mysqli_query(Conexion(),$cargarMarca);
if($recurso!=NULL)
{
while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
{
if($marca==$fila[0])
{
echo "<option value='".$fila[0]."' selected='selected'>".$fila[1]."</option>";    
}
else 
{
echo "<option value='".$fila[0]."'>".$fila[1]."</option>";   
}	
}
}
?>
</select>
</td>
<td>modelo:</td>
<td><input name="modelo" type="text" size="15" maxlength="20" value="<?=$modelo?>"/></td>
</tr>
<tr>
<td>serie:</td>
<td><input name="serie" type="text" size="15" maxlength="20" value="<?=$serie?>"/></td>
<td>desc. equipo:</td>
 <td><input name="tipoEquipo" type="text" size="15" maxlength="20" value="<?=$tipoEquipo?>"/></td>
</tr>
<tr>
<td>estado:</td>
<td>
<select name="estado" id="estado">
<option value="" <?php if($estado==""){echo "selected='selected'";}?>>Seleccionar</option>
<option value="activo" <?php if($estado=="activo"){echo "selected='selected'";}?>>activo</option>
<option value="inactivo" <?php if($estado=="inactivo"){echo "selected='selected'";}?>>inactivo</option>
<option value="reparacion" <?php if($estado=="reparacion"){echo "selected='selected'";}?>>en taller</option>
<option value="baja" <?php if($estado=="baja"){echo "selected='selected'";}?>>dado de baja</option>
</select>
</td>
<td>Dir Mac:</td>
<td><input name="mac" type="text" size="15" maxlength="20" value="<?=$mac?>" /></td>
</tr>
<tr>
<td>Bocas:</td>
<td><input name="bocas" type="text" size="15" maxlength="20" value="<?=$bocas?>"/></td>
<td>ip inicial:</td>
<td><input name="ipinicial" type="text" size="15" maxlength="20" value="<?=$ipinicial?>"/></td>
</tr>
<tr>
<td>ip pta enlace:</td>
<td><input name="ptaenlace" type="text" size="15" maxlength="20" value="<?=$ptaenlace?>" />&nbsp;</td>
<td>ip mascara:</td>
<td><input name="mascara" type="text" size="15" maxlength="20" value="<?=$mascara?>" /></td>
</tr>
<tr>
<td>usuario:</td>
<td><input name="usuario" type="text" size="15" maxlength="20" value="<?=$usuario?>"/></td>
<td>clave:</td>
<td><input name="clave" type="text" size="15" maxlength="20" value="<?=$clave?>"/></td>
</tr>
<!-- aca comienza la fecha de ingreso y la de creacion-->
<?php
$fechaGuardada= $fingreso;
$fingreso ="";
?>
<tr>
<td>fecha ingreso:<span class="glyphicon glyphicon-calendar" onclick="javascript:NewCssCal('fingreso','yyyyMMdd')" style="cursor:pointer"></span></td>
<td><input name="fingreso" id="fingreso" type="text" size="15" maxlength="20" value=""/></td>
<td>fecha anterior:</td>
<td><input name="fechaGuardada" id="fingreso" type="text" size="15" maxlength="20" value="<?=$fechaGuardada?>"/></td>
</tr>
<tr>
</tr>
<!-- aca termina la fecha de ingreso y de creacion -->
<!-- aca transportamos la fecha de creacion -->
<tr>
<td>fecha creacion:</td>
<td><input name="fcreacion" type="text" size="15" maxlength="20" value="<?=$fcreacion?>" readonly="readonly"/></td>
</tr>
<tr>
<!-- aca termina la fecha de creacion -->
<td>$ costo:</td>
<td><input name="costo" type="text" size="15" maxlength="20" value="<?=$costo?>"/></td>
</tr>
<tr><td colspan="4"><hr></td></tr>
<tr>
<td colspan="4">
<input name="opcion" type="submit" value="crear" class="boton"/>
<input name="opcion" type="submit" value="actualizar" class="boton"/>
<input name="opcion" type="reset" value="limpiar" class="boton" onclick="javascript:window.location='equiposRed.php';"/>
</td>
</tr>
<tr>
<td colspan="4">
<?php if(isset($_GET["mensaje"]) && $_GET["mensaje"]!=""){echo $_GET["mensaje"];}?></td>
</tr>
</table>
</form>
<hr />
<div id="despliegue">
<?php
$cant_pagina = 5;
require_once("libs/Zebra_Pagination-master/Zebra_Pagination.php");
$paginadorZebra = new Zebra_Pagination();
$cantidadRegistros = mysqli_num_rows(mysqli_query(Conexion(),"select red.RED_IDRED from red"));
$paginar_resultados = "select red.*,tipo.TIP_NBTIPO from "
        . "red,tipo where red.TIP_IDTIPO=tipo.TIP_IDTIPO order by red.RED_IDRED ASC limit " . (( $paginadorZebra->get_page() - 1 ) * $cant_pagina ) . ",  " . $cant_pagina;
$paginadorZebra->records($cantidadRegistros);
$paginadorZebra->records_per_page($cant_pagina);
?>
<table width="600" align="center" class="table-hover" style="font-size:12px;">
<tr>
<td colspan="5">cantidad de registros:<?=$cantElementos[0]?></td>
</tr>
<tr>
<td colspan="5" class="text-center">listado de perifericos</td>
</tr>
<tr>
<td>codigo interno</td>
<td>tipo equipo</td>
<td>n° serie</td>
<td>mac</td>
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
echo "<tr><td>".$fila[0]."</td><td>".$fila[18]."<td>".$fila[4]."</td><td>".$fila[8]."</td>";
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
//alert(id);
if(confirm("¿Desea cargar esta opcion para edicion?"))
{
window.location = "equiposRed.php?cargar=cargarDatos&id=" + id;
}	
}
function borrar(id)
{
//alert(id);
if(confirm("¿Realmente desea borrar esta opcion?"))
{
window.location = "equiposRed.php?cargar=borrarDatos&id=" + id;
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