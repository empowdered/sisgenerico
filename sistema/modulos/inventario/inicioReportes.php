<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="bootstrap-3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="OtInsumos/estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>reportes y solicitud</title>
</head>

<body>
<div class="container">
	<!-- aca le colocamos una cabecera, para que se vea mas lindo -->
	<div class="row text-center" id="cabecera">
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
<form action="" method="">
    <table width="700" align="center" border="1">
    <th colspan="6">Escoja la opcion deseada</th>
    <tr>
    <td>Equipos:</td>
    <td>por software</td>
    <td><input type="radio" name="seleccion" onclick="javascript:habilitarDiv('reporteEquipos.php?opcion=software');"/></td>
    <td>Busqueda:</td>
    <td><input type="text" name="busqueda"  placeholder="introduzca serie" id="equipos"/></td>
    <td><input type="button" name="buscar" value="buscar" class="boton" onclick="campo('equipos')"/></td>
    </tr>
    <tr>
    <td>Datos ubicacion:</td>
    <td><input type="radio" name="seleccion" onclick="javascript:habilitarDiv('reporteEquipos.php?opcion=Datosubicacion');"/></td>
    <td>Datos tecnicos:</td>
    <td><input type="radio" name="seleccion" onclick="javascript:habilitarDiv('reporteEquipos.php?opcion=DatosTecnicos');"/></td>
    <td>Listado completo:</td>
    <td><input type="radio" name="seleccion" onclick="alert('se construira en una segunda etapa');"/></td>
    </tr>
    <tr>
    <td style="background-color:rgba(204,204,204,1); height:2px;" colspan="6"></td>
    </tr>
    <!-- fin de equipos-->
       <tr>
    <td colspan="3">Disp. Red:</td>
    
    <td>Busqueda:</td>
    <td><input type="text" name="busqueda" onclick="" placeholder="introduzca serie" id="redes"/></td>
    <td><input type="button" name="buscar" value="buscar" class="boton" onclick="campo('redes')"/></td>
    </tr>
    <tr>
    <td>Datos ubicacion:</td>
    <td><input type="radio" name="seleccion" onclick="javascript:habilitarDiv('reportesRed.php?opcion=Datosubicacion');"/></td>
    <td>Datos tecnicos:</td>
    <td><input type="radio" name="seleccion" onclick="javascript:habilitarDiv('reportesRed.php?opcion=DatosTecnicos');"/></td>
    <td>Listado completo:</td>
    <td><input type="radio" name="seleccion" onclick="alert('se construira en una segunda etapa');"/></td>
    </tr>
    <tr>
    <td style="background-color:rgba(204,204,204,1); height:2px;" colspan="6"></td>
    </tr>
    <!-- por impresion -->
       <tr>
    <td colspan="6">Impresoras:</td>
    </tr>
    <tr>
    <td colspan="6">Listado completo:
      <input type="radio" name="seleccion" onclick="javascript:habilitarDiv('reporteImpresora.php?opcion=Completo');"/></td>
    </tr>
    <tr>
    <td style="background-color:rgba(204,204,204,1); height:2px;" colspan="6"></td>
    </tr>
    <!-- -->
       <tr>
    <td colspan="6">Generales</td>
    </tr>
    <tr>
    <td>Datos Personas:</td>
    <td><input type="radio" name="seleccion" onclick="javascript:habilitarDiv('Generales.php?opcion=Personas');"/></td>
    <td>Conteo General:</td>
    <td><input type="radio" name="seleccion" onclick="javascript:habilitarDiv('Generales.php?opcion=Conteo');"/></td>
    <td>Listado accesos:</td>
    <td><input type="radio" name="seleccion" onclick="javascript:habilitarDiv('Generales.php?opcion=Logs');"/></td>
    </tr>
    <tr>
    <td style="background-color:rgba(204,204,204,1); height:2px;" colspan="6"></td>
    </tr>
    </table>
</form>
    </div>
 </div>
</div>
</body>
<script type="text/javascript">
function habilitarDiv(enlace)
{
	var direccion = "reportes/";
	ventana(direccion + enlace,"1024","600");	
}
function ventana(locacion,ancho,alto)
{
var posicion_x; 
var posicion_y; 
var posicion_x = (screen.width / 2)-(ancho/2); 
var posicion_y = (screen.height / 2)-(alto/2); 
window.open(locacion,"reporte", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
function campo(itemx)
{
	var valor = itemx;
	var campo="";
	if(itemx=="equipos")
	{
		campo = document.getElementById("equipos").value;	
		ventana("reportes/reporteEquipos.php?opcion=Busqueda&campo="+campo);
	}
	if(itemx=="redes")
	{
		campo = document.getElementById("redes").value;	
		ventana("reportes/reportesRed.php?opcion=Busqueda&campo="+campo);
	}
}
</script>
<style type="text/css">
.boton{
	background-color:rgba(0,51,153,1);
	width:100px;
	font-size:12px;
	color:rgba(255,255,255,1);
	border-radius:6px;
}
</style>
</html>