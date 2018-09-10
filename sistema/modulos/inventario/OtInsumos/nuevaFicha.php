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
       <div class="row" id="eleccion">
       		<div class="col-xs-12">
            <hr />
            	<form name="formulario" id="formulario" method="post" action="crearFicha.php">
                
<table align="center" width="600" id="tablaform" border="0">
                <tr>
             <td>opcion:</td>   	
<td><select name="categoria" onchange="javascript:adaptar();" id="categoria">
<option value="">Seleccione</option>
<option value="informe">informe</option>
<option value="orden">Orden Trabajo</option>
<option value="sep">especial sep</option>
</select>
</td>
                 </tr>
                 <tr>
                 <td colspan="2">
       <?php
if(isset($_GET["mensaje"]) && $_GET["mensaje"]!="")
{
echo $_GET["mensaje"];
}
?>          
</td>
                 </tr>
                 </table>


                <table width="600"  border="1" align="center" cellpadding="1" cellspacing="1">
                  <tr>
                    <td width="28" valign="middle"><input type="checkbox" name="checkbox1" id="check1"
                    onclick="javascript:activar('check1');" />
                  </td>
<td width="71" valign="middle">equipos(especial):</td>
                    <td width="106" valign="middle">
                      <select name="idequipo" id="equipos" disabled="disabled">
                        <option value="" selected="selected">Seleccione</option>
<?php
require("conexion.php");
$link = Conexion();
$recurso = NULL;
$equipos="select equipo.EQ_IDEQUIPO,equipo.EQ_SERIEEQUIPO FROM equipo";
$recurso=mysqli_query($link,$equipos);
if($recurso!=NULL)
{
	while($fila=mysqli_fetch_array($recurso))
	{
		echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
	}
}
mysqli_close($link);
$recurso=NULL;
?>                        
                    </select></td>
                    <td width="22" valign="middle"><input type="checkbox" name="checkbox2" id="check2" onclick="javascript:activar('check2');" /></td>
                    <td width="56" valign="middle">impresoras:</td>
                    <td width="94" valign="middle"><select name="idimpresora" id="impresora" disabled="disabled">
                      <option value="" selected="selected">Seleccione</option>
                      <?php
$link = Conexion();
$recurso = NULL;
$impresoras="select impresion.IM_IDIMPRESION,impresion.IM_SERIEIMPRESION FROM impresion";
$recurso=mysqli_query($link,$impresoras);
if($recurso!=NULL)
{
	while($fila=mysqli_fetch_array($recurso))
	{
		echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
	}
}
mysqli_close($link);
$recurso=NULL;
?>
</select>
</td>
<td valign="middle">
<input type="checkbox" name="checkbox3" id="check3" onchange="javascript:activar('check3');"/></td>
                    <td width="21" valign="middle">red:</td>
                    <td width="28" valign="middle"><select name="idred" id="red" disabled="disabled">
                      <option value="" selected="selected">Seleccione</option>
                      <?php
$link = Conexion();
$recurso = NULL;
$red="select red.RED_IDRED,red.RED_SERIERED from red";
$recurso=mysqli_query($link,$red);
if($recurso!=NULL)
{
	while($fila=mysqli_fetch_array($recurso))
	{
		echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
	}
}
mysqli_close($link);
$recurso=NULL;
?>
                    </select></td>
                  </tr>
                  <tr>
                  <td colspan="9">
                  <hr />
                  </td></tr>
                  <tr>
<td colspan="2">usuario:</td>
<td colspan="2">
<?php
session_name("login_permisos");
session_start();
if(isset($_SESSION["nbusuario"]) && isset($_SESSION["idusuario"]))
{
$nb_usuario=base64_decode($_SESSION["nbusuario"]);
$id_usuario=base64_decode($_SESSION["idusuario"]);
}
?>
                    <input name="usuario" type="text" id="usuario" size="10" value="<?php if(isset($nb_usuario))echo $nb_usuario;?>" readonly="readonly"/>        
                    
<input name="idusuario" type="hidden" id="textfield" size="25"  value="<?php if(isset($id_usuario))echo $id_usuario;?>"/>
                    </td>
                    <td colspan="5">&nbsp;</td>
                  </tr>
                  <tr>
                  <td height="10" colspan="9"></td>
                  </tr>
                  <tr id="detallex" >
                    <td height="99" colspan="2" valign="top">detalles:</td>
                    <td colspan="7">
                    <textarea name="detalle" id="textarea" cols="60" rows="5"></textarea></td>
                  </tr>
                  <tr>
                  <td height="10" colspan="9"></td>
                  </tr>
                      <td height="32" colspan="2">defecto:</td>
                    <td colspan="2">
<input name="defecto" type="text" id="defecto" size="25"  disabled="disabled"/></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                    </tr>
                  <tr>
                  <td height="10" colspan="9"></td>
                  </tr>
                  <tr>
                    <td height="93" colspan="2" valign="top">diagnostico:</td>
                    <td colspan="7" valign="top">
  <textarea name="diagnostico" id="diagnostico" cols="60" rows="5" value="" disabled="disabled"></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="2" id="agregar" style="visibility:hidden;"><span class="glyphicon glyphicon-plus" title="añadir item" onclick="javascript:ventana('windowItem.php','270','200');">Agregar</span></td>
                    <td colspan="2" id="borrar" style="visibility:hidden;"><span class="glyphicon glyphicon-remove" title="quitar todos los item" onclick="javascript:window.location='eliminarItems.php';">Borrar</span></td>
 <td colspan="4"><input id="Guardar" name="opcion" type="submit" value="Guardar" class="btn btn-default btn-sm"/>
   <input  id="Ejecutar" name="opcion" type="submit" value="Ejecutar" class="btn btn-default btn-sm" disabled="disabled"/>
   <input id="Limpiar" name="opcion" type="submit" value="Limpiar" class="btn btn-default btn-sm"/>
 
 </td>                   
                  </tr>
                </table>
   </form>
</div>
</div>
<iframe src="mostrarLista.php" name="listado" width="700" height="100" sandbox="allow-scripts allow-forms" frameborder="0" style="overflow-y:auto; visibility:hidden;" id="framex">
            	
            </iframe>
</div> 
    <hr />   
    </div>
 </div>
</div>
</body>
<script type="text/javascript">
function activar(id)
{	
	if(id=="check1")
	{	
		//esta linea es para desactivar los check menos el 1
		document.getElementById("check2").checked = false;
		document.getElementById("check3").checked = false;
		//*******************************************************
		//aca habilitamos el  elemento desabilitado
		document.getElementById("equipos").disabled = false;
		//aca tomamos los elementos y seteamos el primero, por defecto
		document.getElementById("impresora").selectedIndex = 0;
		document.getElementById("red").selectedIndex = 0;
		//aun estando deshabilitado, deshabilitamos igual
		document.getElementById("impresora").disabled = true;
		document.getElementById("red").disabled = true;
	}
	if(id=="check2")
	{
		//deshabilitamos todos menos el checkbox 2
		document.getElementById("check1").checked=false;
		document.getElementById("check3").checked=false;
		//*******************************************************
		//aca habilitamos el  elemento desabilitado
		document.getElementById("impresora").disabled = false;
		//aca tomamos los elementos y seteamos el primero, por defecto
		document.getElementById("equipos").selectedIndex = 0;
		document.getElementById("red").selectedIndex = 0;
		//aun estando deshabilitado, deshabilitamos igual
		document.getElementById("equipos").disabled = true;
		document.getElementById("red").disabled = true;	
	}
	if(id=="check3")
	{
		//esta linea desactiva los check 1 y 2 menos el 3
		document.getElementById("check1").checked=false;
		document.getElementById("check2").checked=false;
		
		//*******************************************************
		//aca habilitamos el  elemento desabilitado
		document.getElementById("red").disabled = false;
		//aca tomamos los elementos y seteamos el primero, por defecto
		document.getElementById("equipos").selectedIndex = 0;
		document.getElementById("impresora").selectedIndex = 0;
		//aun estando deshabilitado, deshabilitamos igual
		document.getElementById("equipos").disabled = true;
		document.getElementById("impresora").disabled = true;
		
	}
	/**/
}
function adaptar()
{
	var control = document.getElementById("categoria");
	if(control.selectedIndex==1)
	{
		document.getElementById("defecto").disabled = true;
		document.getElementById("diagnostico").disabled= true;
			document.getElementById("agregar").style.visibility="hidden";
		document.getElementById("borrar").style.visibility="hidden";
		document.getElementById("framex").style.visibility="hidden";
		document.getElementById("Ejecutar").disabled = true;
		document.getElementById("Guardar").disabled = false;
	}
	if(control.selectedIndex==2)
	{
		document.getElementById("defecto").disabled= false;
		document.getElementById("diagnostico").disabled= false;
		document.getElementById("agregar").style.visibility="visible";
		document.getElementById("borrar").style.visibility="visible";
		document.getElementById("framex").style.visibility="visible";
		document.getElementById("Ejecutar").disabled = false;
		document.getElementById("Guardar").disabled = true;
	}
	if(control.selectedIndex==3)
	{
		document.getElementById("defecto").disabled = true;
		document.getElementById("diagnostico").disabled= true;
		document.getElementById("agregar").style.visibility="visible";
		document.getElementById("borrar").style.visibility="visible";
		document.getElementById("framex").style.visibility="visible";
		document.getElementById("Ejecutar").disabled = false;
		document.getElementById("Guardar").disabled = true;
	}
}
function ventana(locacion,ancho,alto)
{
var posicion_x; 
var posicion_y; 
var posicion_x = (screen.width / 2)-(ancho/2); 
var posicion_y = (screen.height / 2)-(alto/2); 
window.open(locacion,"escoger item", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
</script>
<style type="text/css">
/*
div{ border-style:dotted;border-width:thin; border-color: red;}
*/
</style>
</html>