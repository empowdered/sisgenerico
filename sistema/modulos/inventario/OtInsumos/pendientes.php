<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css"/>
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <div style="height:10px;"> </div>
 <form action="pendientes.php" method="post">
 <table align="center" width="300" style="font-family:Verdana, Geneva, sans-serif;font-size:12px;">
 <tr>
 <td>tipo:</td>
 <td>
 <select name="categoria">
 <option value="" selected="selected">Seleccione</option>
 <option value="informe">informe</option>
 <option value="orden">orden</option>
 <option value="sep">sep</option>
 </select>
 </td>
 </tr>
<!--
 <tr>
 <td>folio:</td>
 <td><input type="text" name="folio" value="" size="25" /></td>
 </tr>
 -->
 <tr>
 <td><input type="submit"  value="Cargar" class="btn btn-default btn-sm" style="background-color:rgba(0,102,204,1); color:white;"/></td>
 </tr>
 </table>
 </form> 
       
<?php
require("conexion.php");
$recurso= NULL;
$link = "";
$id="";
$categoria="";
print_r($_POST);
session_name("login_permisos");
session_start();
if(isset($_POST["categoria"]) && $_POST["categoria"]!="")
//se hara la consulta siempre y cuando este seteado el id en variable de sesion
{
if(isset($_SESSION["idusuario"]) && $_SESSION["idusuario"]!="")$id = base64_decode($_SESSION["idusuario"]);
$categoria = $_POST["categoria"];

$link = Conexion();

if($categoria!="" && ($categoria=="informe" or $categoria=="orden"))
{
echo $pendientes = "call devuelvePendientes('$id','$categoria')";

/*
equipo.EQ_SERIEEQUIPO,
impresion.IM_SERIEIMPRESION,
red.RED_SERIERED,
taller.TA_IDTALLER,
taller.TA_IDUSUARIO,
taller.TA_FCREACION,
taller.TA_ESTADO 
*/
//$pendientes = "call devuelvePendientes('2')";
$recurso = mysqli_query($link,$pendientes);
echo '<table align="center" border="0" style="font-family:Verdana, Geneva, sans-serif;font-size:14px;" width="900">
       <th colspan="5" style="text-align:center;">pendientes del usuario</th>
       <tr>
       <td>creado el</td><td>creado por</td><td>estado</td><td>serie equipo</td><td>categoria</td>
       </tr>';
if($recurso!=NULL)
{
	while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
	{
		echo "<tr ondblclick=javascript:ventana(".$fila[2].",'".$categoria."',1024,650);>";
		echo "<td ondblclick=javascript:ventana(".$fila[2].",'".$categoria."',1024,650);>".$fila[4]."</td>";
		echo "<td ondblclick=javascript:ventana(".$fila[2].",'".$categoria."',1024,650);>".base64_decode($fila[1])."</td>";
		echo "<td ondblclick=javascript:ventana(".$fila[2].",'".$categoria."',1024,650);>".$fila[5]."</td>";
		echo "<td ondblclick=javascript:ventana(".$fila[2].",'".$categoria."',1024,650);>".$fila[0]."</td>";
		echo "<td ondblclick=javascript:ventana(".$fila[2].",'".$categoria."',1024,650);>".$fila[6]."</td>";
		echo "</tr>";	
	}
}
//".$fila[2].",800,600,
mysqli_close($link);
}
}
if($categoria!="" && $categoria=="sep")
{
	echo $pendientes = "call devuelvePendientes('$id','$categoria')";

/*
equipo.EQ_SERIEEQUIPO,
impresion.IM_SERIEIMPRESION,
red.RED_SERIERED,
taller.TA_IDTALLER,
taller.TA_IDUSUARIO,
taller.TA_FCREACION,
taller.TA_ESTADO 
*/
//$pendientes = "call devuelvePendientes('2')";
$recurso = mysqli_query($link,$pendientes);
echo '<table align="center" border="0" style="font-family:Verdana, Geneva, sans-serif;font-size:14px;" width="900">
       <th colspan="5" style="text-align:center;">pendientes del usuario</th>
       <tr>
       <td>creado el</td><td>creado por</td><td>estado</td><td>especial</td><td>categoria especial</td>
       </tr>';
if($recurso!=NULL)
{
	while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
	{
		echo "<tr ondblclick=javascript:ventanaSep(".$fila[2].",'".$categoria."',1024,650);>";
		echo "<td ondblclick=javascript:ventanaSep(".$fila[2].",'".$categoria."',1024,650);>".$fila[4]."</td>";
		echo "<td ondblclick=javascript:ventanaSep(".$fila[2].",'".$categoria."',1024,650);>".base64_decode($fila[1])."</td>";
		echo "<td ondblclick=javascript:ventanaSep(".$fila[2].",'".$categoria."',1024,650);>".$fila[5]."</td>";
		echo "<td ondblclick=javascript:ventanaSep(".$fila[2].",'".$categoria."',1024,650);>".$fila[0]."</td>";
		echo "<td ondblclick=javascript:ventanaSep(".$fila[2].",'".$categoria."',1024,650);>".$fila[6]."</td>";
		echo "</tr>";	
	}
}
echo "</table>";
//".$fila[2].",800,600,
mysqli_close($link);
}
?>      
    </div>
 </div>
</div>
<script type="text/javascript">
function ventana(id,categ,ancho,alto)
{
var locacion = "cargarPendientes.php?idx=" + id + "&categoria="+categ;
var posicion_x; 
var posicion_y; 
var posicion_x = (screen.width / 2)-(ancho/2); 
var posicion_y = (screen.height / 2)-(alto/2); 
window.open(locacion,"ventana pendientes", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
function ventanaSep(id,categ,ancho,alto)
{
var locacion = "cargarSep.php?idx=" + id +"&categoria="+categ;
var posicion_x; 
var posicion_y; 
var posicion_x = (screen.width / 2)-(ancho/2); 
var posicion_y = (screen.height / 2)-(alto/2); 
window.open(locacion,"ventana pendientes", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
</script>
</body>
</html>