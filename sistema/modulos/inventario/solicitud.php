<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
require("conexion.php");
$link = Conexion();
$recurso = NULL;
?>
<link rel="stylesheet" href="bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="bootstrap-3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="OtInsumos/estilo.css" />
<style type="text/css">
.container{
	height:auto;
}
#resultado{
	height:400px;
}
.btn{
	background-color:#06F;
	border-radius:6px;
}
</style>
<script src="js/datetimepicker_css.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>reportes y solicitud</title>
</head>

<body>
<div class="container">
	<!-- aca le colocamos una cabecera, para que se vea mas lindo -->
	<div class="row text-center" id="cabecera" style="height:40px;">
    		<h4>solicitud y reportes</h4>
    </div>
 <div class="row text-center" id="opciones">
    <div class="col-xs-2">
        <a href="index.php" accesskey="i">|
            <img src="iconos/1434153087_kfm_home.png" height="18" width="18"/> ir a inicio
        </a>|
    </div>
    <div class="col-xs-2">
        <a href="solicitud.php" accesskey="p">|
            <img src="iconos/1434153758_lists.png" height="18" width="18"/> solicitud 
        </a>|
    </div>
    <div class="col-xs-2">
        <a href="inicioReportes.php" accesskey="c">|
            <img src="iconos/1434154526_txt2.png" height="18" width="18"/> reportes
        </a>|
    </div>
    <div class="col-xs-2">
        <a href="historico.php" accesskey="h">|
            <img src="iconos/1434154704_order-history.png" height="18" width="18"/> busqueda
        </a>|
    </div>
      <div class="col-xs-2">
        
    </div>
      <div class="col-xs-2">|
        <a href="#" accesskey="c" onclick="javascript:window.close();">
            <img src="iconos/1434155196_user_close_security.png" height="18" width="18"/> cerrar
        </a>|
        
    </div>
 </div>
 <div class="row">
    <div class="col-xs-12 text-center" id="contenido">
    <hr />
    <form action="solicitud.php" name="form" method="post">
    	<table align="center" width="400">
        	<tr>
            	<td>desde<span class="glyphicon glyphicon-calendar" onclick="javascript:NewCssCal('desde','yyyyMMdd')" style="cursor:pointer"></span></td>
                <td><input type="text" name="desde" value="" id="desde" readonly="readonly"/></td>
                <td>hasta<span class="glyphicon glyphicon-calendar" onclick="javascript:NewCssCal('hasta','yyyyMMdd')" style="cursor:pointer"></span></td>
                <td><input type="text" name="hasta" value="" id="hasta" readonly="readonly"/></td>
            </tr>
            	<tr>
            	<td colspan="2"><input type="submit" name="opcion" value="Buscar" class="btn btn-default btn-sm"/></td>
                <td colspan="2"><input type="reset" name="opcion" value="Limpiar" class="btn btn-default btn-sm"/></td>
            </tr>
        </table>
    </form>
    <hr />
<div id="resultado" style="overflow:auto;">
<?php
$desde = "";
$hasta = "";

if(isset($_POST["desde"])&& $_POST["desde"]!="")$desde = $_POST["desde"];
if(isset($_POST["hasta"])&& $_POST["hasta"]!="")$hasta = $_POST["hasta"];
print_r($_POST);

if($desde!="" && $hasta!=""){
$consultaTaller = "call selectSolicitud('$desde','$hasta')";
$recurso = mysqli_query($link,$consultaTaller);
	echo "<table width='600' align='center' border='1'>";
	echo "<tr>";
	echo "<td colspan='8'>RESULTADO BUSQUEDA</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>codigo taller</td><td>descripcion</td><td>defecto</td><td>diagnostico</td><td>motivo</td><td>creado el</td><td>finalizado el</td><td>cargar</td>";
	echo "</tr>";
	if($recurso!=NULL)
	{
		while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
		{
			echo "<tr><td>".$fila[0]."</td><td>".$fila[1]."</td><td>".$fila[2]."</td><td>".$fila[3]."</td><td>".$fila[4]."</td><td>".$fila[5]."</td><td>".$fila[5]."</td>";	
			echo "<td><input type='radio' name='cargar' value='' onclick=javascript:cargar(".$fila[0].");></td></tr>";
		}
	echo "</table>";
	}
}
?>
</div>
<div id="formulario_creacion" style="visibility:hidden; position:absolute;">
<form action="crearSolicitud.php" method="post">
	<table width="400">
    	<tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
    </table>
</form>
</div>
    </div>
 </div>
</div>
</body>
<script type="text/javascript">
function cargar(id)
{
var locacion = "crearSolicitud.php?id=" +id;
ventana(locacion,"1024","768")
}
function ventana(locacion,ancho,alto)
{
var posicion_x; 
var posicion_y; 
var posicion_x = (screen.width / 2)-(ancho/2); 
var posicion_y = (screen.height / 2)-(alto/2); 
window.open(locacion," ", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
</script>
<style type="text/css">
.table{
	background-color:#FFF;
    border-radius:6px;
	width:600px;
}
.table.td{
	height:auto;
}
.btn{
	background-color:#06F;
	color:white;
}
</style>
</html>