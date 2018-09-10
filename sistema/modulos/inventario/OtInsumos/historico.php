<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
error_reporting(0);
?>
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css"/>
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../js/datetimepicker_css.js"></script>
<title>ficha de gestion</title>
</head>

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
    <div class="col-xs-12 text-center" id="contenido">
    <div style="height:10px;"></div>
   <form action="historico.php" method="post">
   	<table align="center" width="400" border="1" style="">
    <tr>
    <td>desde:<span class="glyphicon glyphicon-calendar" onclick="javascript:NewCssCal('desde','yyyyMMdd')" style="cursor:pointer"></span></td>
    <td><input type="text" name="desde" id="desde"  /></td>
    </tr>
    <tr>
    <td>hasta:<span class="glyphicon glyphicon-calendar" onclick="javascript:NewCssCal('hasta','yyyyMMdd')" style="cursor:pointer"></span></td>
    <td><input type="text" name="hasta" id="hasta"  /></td>
    </tr>
    <tr>
    <td>tipo:</td>
    <td>
    <select name="categoria">
    <option value="">Seleccione</option>
    <option value="informe">informes</option>
    <option value="orden">ordenes</option>
    </select>
    </td>
    <td>
    <input type="submit" value="consultar" name="opcion" class="btn btn-default btn-sm"/>
    </td>
    </tr>
   </form>
   <table>
   <hr />
 <?php
require("conexion.php");
$link = Conexion();
$recurso="";
$fila="";

$categoria = "";
$desde ="";
$hasta ="";
$consulta = "";

if(isset($_POST["categoria"]) && $_POST["categoria"]!="")$categoria = $_POST["categoria"];
if(isset($_POST["desde"]) && $_POST["desde"]!="")$desde = $_POST["desde"];
if(isset($_POST["hasta"]) && $_POST["hasta"]!="")$hasta = $_POST["hasta"];

if($categoria!="" && ($desde =="" && $hasta==""))
{
$consulta = "SELECT usuario.usu_nbusuario,
taller.TA_IDTALLER,
taller.TA_FCREACION,
taller.TA_FEJECUCION
from usuario,taller where 
usuario.usu_idusuario = taller.TA_IDUSUARIO
AND (
taller.TA_MOTIVO='$categoria' and  taller.TA_ESTADO  = 'finalizado')";
}
if($categoria!="" && $desde !="" && $hasta!="")
{
$consulta = "SELECT 
usuario.usu_nbusuario,
taller.TA_IDTALLER,
taller.TA_FCREACION,
taller.TA_FEJECUCION
from usuario,taller  where 
taller.TA_FCREACION  between'$desde' and '$hasta'
AND 
taller.TA_MOTIVO='$categoria' and  taller.TA_ESTADO  = 'finalizado'
and 
usuario.usu_idusuario = taller.TA_IDUSUARIO;";	
}
?>
<table align="center" class="" width="600" style="">
<th colspan="4" class="text-center">listado de finalizados</th>
<tr>
<td>codigo interno</td>
<td>creado por</td>
<td>fecha creacion</td>
<td>fecha finalizacion</td>
</tr>
<?php
if($consulta!="")
{
	$recurso = mysqli_query($link,$consulta);
	/*
	if (!$recurso) {
    	printf("Error: %s\n", mysqli_error(Conexion()));
    	exit();
		}
	*/
	while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
	{
		echo "<tr><td ondblclick=javascript:ventana(".$fila[1].",1024,650);>".$fila[1]."</td>";
		echo"<td ondblclick=javascript:ventana(".$fila[1].",1024,650);>".base64_decode($fila[0])."</td>";
		echo "<td ondblclick=javascript:ventana(".$fila[1].",1024,650);>".$fila[2]."</td>";
		echo "<td ondblclick=javascript:ventana(".$fila[1].",1024,650);>".$fila[3]."</td>";
    	echo '</tr>';
	}
}
?>

 <script type="text/javascript">
function ventana(id,ancho,alto)
{
var locacion = "cargarHistorico.php?idx=" + id;
var posicion_x; 
var posicion_y; 
var posicion_x = (screen.width / 2)-(ancho/2); 
var posicion_y = (screen.height / 2)-(alto/2); 
window.open(locacion,"ventana historico al detalles", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
</script>
    </div>
 </div>
</div>

</body>
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