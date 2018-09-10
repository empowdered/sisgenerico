<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<?php
error_reporting(0);
if(isset($_GET["mensaje"]) && $_GET["mensaje"]!="")
{
	if($_GET["mensaje"]=="actualizado")
	{
		echo "<script>alert('registro actualizado y finalizado');window.close();window.opener.location.reload();</script>";	
	}
}
?>
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css"/>
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>resolucion pendientes</title>
<?php
require("conexion.php");
$link = Conexion();
$idx = "";
$categoria ="";
$recurso = NULL;
$equipo = "";
$impresora= "";
$red = "";

if(isset($_GET["idx"]) && $_GET["idx"]!=""){$idx = $_GET["idx"];}
if(isset($_GET["categoria"]) && $_GET["categoria"]!=""){$categoria = $_GET["categoria"];}
?>
</head>
<body>
<div class="container">
<div class="row">
	<div class="col-xs-12">
    <hr />
    <table id="tabla" width="600" border="1" style="border-width:thin; border-style:dotted; font-family:Verdana, Geneva, sans-serif; font-size:13px;" align="center">
<?php
 $detalleEquipamiento = "call consultaEquipamiento('$idx')"; 
 $fila = mysqli_fetch_row(mysqli_query($link,$detalleEquipamiento));
 mysqli_close($link);
 if($fila[0]=="equipo")
 {
	 $link = Conexion();
	 $recurso = NULL;
	 $equipo = "
	 select tipo.TIP_NBTIPO,equipo.EQ_NROEQUIPO,equipo.EQ_SERIEEQUIPO,equipo.EQ_MARCA,taller.EQ_IDEQUIPO from
	 tipo, equipo,taller
	 where tipo.TIP_IDTIPO=equipo.EQ_IDTIPO
	 and 
	 equipo.EQ_IDEQUIPO = taller.EQ_IDEQUIPO
	 and
	 taller.TA_IDTALLER = '$idx'";
	 $fila = mysqli_fetch_row(mysqli_query($link,$equipo));
	 if(is_array($fila))
	 {
		 echo "<tr><td>Tipo de equipo</td><td>".$fila[0]."</td>";
		 echo "<td>nro  de equipo</td><td>".$fila[1]."</td></tr>";
		 echo "<tr><td colspan='4'>serie:".$fila[2]."</td></tr>";
		 echo "<tr><td>marca</td><td>".$fila[3]."</td>";
		 echo "<td>codigo interno:</td><td>".$fila[4]."</td></tr>";
	 }
 }
 if($fila[0]=="impresion")
 {
	 $link = Conexion();
	 $recurso = NULL;
	 $impresora = "select tipo.TIP_NBTIPO, impresion.IM_SERIEIMPRESION,impresion.IM_MODELO,impresion.IM_TIPOIMPRESION,taller.TA_IDTALLER	 
	 FROM
	 tipo,impresion,taller
	 where
	 tipo.TIP_IDTIPO = impresion.IM_IDIMPRESION
	 AND
	 impresion.IM_IDIMPRESION =
	 taller.IM_IDIMPRESION
	 AND
	 taller.TA_IDTALLER = '$idx'
	 ";
	 $fila = mysqli_fetch_row(mysqli_query($link,$impresora));
	 if(is_array($fila))
	 {
		 echo "<tr><td>Tipo de equipo</td><td>".$fila[0]."</td>";
		 echo "<td>serie impresora</td><td>".$fila[1]."</td></tr>";
		 echo "<tr><td colspan='4'>modelo:".$fila[2]."</td></tr>";
		 echo "<tr><td>tipo especifico:</td><td>".$fila[3]."</td>";
		 echo "<td>codigo interno:</td><td>".$fila[4]."</td></tr>";
	 }
 }
 if($fila[0]=="red")
 {
	 $link = Conexion();
	 $recurso = NULL;
	 $red = "select
	 tipo.TIP_NBTIPO,
	 red.RED_MARCAEQUIPO,red.RED_MODELO,
	 red.RED_SERIERED,red.RED_TIPOEQUIPO,
	 taller.TA_IDTALLER
	 FROM
	 tipo,red,taller
	 where
tipo.TIP_IDTIPO = red.TIP_IDTIPO
AND
red.RED_IDRED = taller.TA_IDRED
AND
taller.TA_IDTALLER='$idx'
	 ";
	 $fila = mysqli_fetch_row(mysqli_query($link,$red));
	 if(is_array($fila))
	 {
		 echo "<tr><td>tipo de disp. red</td><td>".$fila[0]."</td>";
		 echo "<td>marca de disp. red</td><td>".$fila[1]."</td></tr>";
		 echo "<tr><td colspan='4'>modelo:".$fila[2]."</td></tr>";
		 echo "<tr><td>serie:</td><td>".$fila[3]."</td>";
		 echo "<td>tipo especifico:</td><td>".$fila[4]."</td></tr>";
		 echo "<tr><td colspan='4'>codigo interno:</td><td>".$fila[5]."</td></tr>";
	 }
 }
 mysqli_close($link);
$link =Conexion();

?>
    <?php if(isset($_GET["categoria"]) && $_GET["categoria"]=="informe"){?>
        <div>
<form action="finalizarPendientes.php" method="post">
    		<!-- esto es por la categoria informe -->
            <table width="600" border="1" style="border-width:thin; border-style:dotted; font-family:Verdana, Geneva, sans-serif; font-size:12px;" align="center">
            <tr>
            <td colspan="2">categoria:<?=$_GET["categoria"]?></td>
            </tr>
            <input type="hidden" name="idx" value="<?=$idx?>" />
            <input type="hidden" name="categoria" value="<?=$categoria?>" />
            <tr>
          <td valign="top">Glosa final:</td> 
          <td>
          <textarea name="glosa" cols="10" rows="10">
          
          </textarea>
          </td> 
            </tr>
            <tr>
            <td>resolucion final:</td>
               <td>
          <select name="resolucion">
          <option value="">Seleccione</option>
          <option value="revisado">revisado</option>
          <option value="no revisado">no revisado</option>
          <option value="anulado">Anulada</option>
          </select>
          </td>
            </tr>
         
            <tr>
            <td colspan="2">
            <input  id="Ejecutar" name="opcion" type="submit" value="Finalizar" class="btn btn-default btn-sm"/>
            <input id="Limpiar" name="opcion" type="submit" value="Limpiar" class="btn btn-default btn-sm"/>
            </td>
            </tr>
                </table>
                </form>
        </div>

<!-- crearemos las variables, y habilitaremos los elementos para actualizar y finalizar -->		

 <?php } ?>
    
    <?php if(isset($_GET["categoria"]) && $_GET["categoria"]=="orden"){?>
    		<!-- esto es por la categoria orden -->
           <form action="finalizarPendientes.php" method="post">
    		<!-- esto es por la categoria informe -->
            <table width="600" border="1" style="border-width:thin; border-style:dotted; font-family:Verdana, Geneva, sans-serif; font-size:14px;" align="center">
            <tr>
            <td colspan="2">categoria:<?=$_GET["categoria"]?></td>
            </tr>
            <input type="hidden" name="idx" value="<?=$idx?>" />
            <input type="hidden" name="categoria" value="<?=$categoria?>" />
            <tr>
          <td valign="top">Glosa final:</td> 
          <td>
          <textarea name="glosa" cols="40" rows="10">
          
          </textarea>
          </td> 
            </tr>
            <tr>
            <td>
            resolucion final:
            </td>
          <td>
          <select name="resolucion">
          <option value="">Seleccione</option>
          <option value="reparado">no reparado</option>
          <option value="no reparado">reparado</option>
          <option value="anulado">Anulada</option>
          </select>
          </td>
            </tr>
          
            <tr>
            <td colspan="2">
            <input  id="Ejecutar" name="opcion" type="submit" value="Finalizar" class="btn btn-default btn-sm"/>
            <input id="Limpiar" name="opcion" type="submit" value="Limpiar" class="btn btn-default btn-sm"/>
            </td>
            </tr>
                </table>
                </form>
<?php 
$link = Conexion();
$recurso = NULL;

if(isset($_GET["categoria"]) && $_GET["categoria"]!="" && $_GET["categoria"]=="orden")
{
	echo "<hr/>";
	echo "<table width='600' align='center' style='font-size:14px;' border='1'>";
	echo "<tr>";
	echo "<td title='id interno'>codigo</td><td>nombre</td><td>costo</td><td title='cantidad solicitada'>cantidad</td";
	echo "</tr>";
$Listado ="call devuelveDetalle('$idx')";
$recurso = mysqli_query($link,$Listado);
if($recurso!=NULL)
{
	$total = 0;
while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
{
	echo "<tr>";
	echo "<td>".$fila[0]."</td>";
	echo "<td>".$fila[1]."</td>";
	echo "<td>".$fila[4]."</td>";
	echo "<td>".$fila[5]."</td>";
	echo "</tr>";
	$total = $total + ($fila[4]*$fila[5]);
}
echo "<tr><td colspan='3'>total:</td><td colspan='1' title='total precio referencia'>".$total."</td></tr>";
echo "</table>";
}
}
?>
<!-- es el fin del listado de elementos -->
<?php
//crearemos las variables, y habilitaremos los elementos para actualizar y finalizar	
?> 
    <?php } ?>
    </div>
</div>
</div>
</body>
<style type="text/css">
div{font-family:Verdana, Geneva, sans-serif; font-size:14px;}
.container{height:auto;}
.col-xs-12{height:650px;}
#Guardar,#Ejecutar,#Limpiar{ background-color:rgba(0,51,204,1); color:rgba(255,255,255,1); border-radius:8px; width:70px; text-align:center;}
</style>
</html>
