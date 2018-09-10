<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--
<style type="text/css">
body{background-color:white;}
.btn{background-color:#06F;color:white;}
.tablex{font-size:12px; border-color: #06F;}
</style>
    -->
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css"/>
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>historico al detalle</title>
</head>
<body>
<?php
require("conexion.php");
$recurso = NULL;
$idx = "";
$nbusuario="";
$idequipo ="";
$id_impresion="";
$idred="";
$idusuario ="";
$fcreacion="";
$fejecucion="";
$descripcion="";
$motivo="";
$defecto="";
$diagnostico="";
$estado="";
$glosa="";
$estadofinal="";
if(isset($_GET["idx"]) && $_GET["idx"]!="") $idx=$_GET["idx"];
//echo $idx;
$callProcedure = "call devuelveHistorico('$idx')";
$recurso = mysqli_query($link,$callProcedure);
if($recurso!=NULL)
{
$fila = mysqli_fetch_row($recurso);
$nbusuario=$fila[0];
$idtaller = $fila[1];
$idequipo =$fila[2];
$id_impresion=$fila[3];
$idred=$fila[4];
$idusuario =$fila[5];
$fcreacion=$fila[6];
$fejecucion=$fila[7];
$descripcion=$fila[8];
$motivo=$fila[9];
$defecto=$fila[10];
$diagnostico=$fila[11];
$estado=$fila[12];
$glosa=$fila[13];
$estadofinal=$fila[14];
}
//fin del if
?>
<hr />
<table align="center" width="600" border="1" class="tablex">
<tr  style="text-align:center; color:rgba(0,0,0,1);"><td colspan="4">detalle del historico</td></tr>
<tr>
<td>creado por:</td><td><?=base64_decode($nbusuario)?></td><td>codigo equipo(PC):</td><td><?=$idequipo?></td>
</tr>
<tr>
<td>codigo impresora:</td><td><?=$id_impresion?></td><td>codigo disp. red:</td><td><?=$idred?></td>
</tr>
<tr>
<td colspan="4"></td>
</tr>
<tr>
<td>codigo usuario:</td><td><?=$idusuario?></td>
<td>creado el:</td><td><?=$fcreacion?></td>
</tr>
<tr>
<td valign="top">cerrado el:</td><td valign="top"><?=$fejecucion?></td>
<td valign="top">descripcion:</td>
<td>
<textarea cols="30" rows="5" readonly="readonly">
<?=rtrim($descripcion)?>
</textarea>
</td>
</tr>
<tr>
<td>Categoria detalle:</td><td><?=$motivo?></td>
<td>Defecto indicado:</td><td><?=$defecto?></td>
</tr>  
<tr>
<td>diagnostico:</td><td><?=$diagnostico?></td>
<td>estado:</td><td><?=$estado?></td>
</tr>
<tr>
<td valign="top">glosa final:</td>
<td valign="top">
<textarea cols="30" rows="5" readonly="readonly">
<?=rtrim($glosa)?>
</textarea>
</td>
<td valign="top">resolucion:</td><td valign="top"><?=$estadofinal?></td>
</tr>
<tr>
<td><input type="button" onclick="javascript:window.print();" value="imprimir" name="opcion" class="btn btn-default btn-sm"/></td>
<td><input type="button" onclick="javascript:window.close();" value="cerrar" name="opcion" class="btn btn-default btn-sm"/></td>
<td colspan="2"></td>
</tr>
</table>
<hr />
<table align="center" width="600" border="1" style="" class="tablex">
<tr>
<td>cod. interno</td>
<td>codigo solicitud</td>
<td>nombre</td>
<td>detalle</td>
<td>costo</td>
<td>cantidad</td>
</tr>
<?php
$suma = 0;
$recurso = NULL;
$link = Conexion();
$llamadaDetalle = "call devuelveDetalle('$idx')";
$recurso = mysqli_query($link,$llamadaDetalle);
if($recurso!=NULL)
{
while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
{
echo "<tr><td>".$fila[0]."</td>";	
echo "<td>".$fila[1]."</td>";	
echo "<td>".$fila[2]."</td>";	
echo "<td>".$fila[3]."</td>";	
echo "<td>$".number_format($fila[4])."</td>";	
echo "<td>".$fila[5]."</td></tr>";	
$suma = $suma + ($fila[4]*$fila[5]);
}
echo "<tr><td colspan='5'>total:</td><td>$".number_format($suma)."</td></tr>";
}
?>
</table>
</body>
</html>