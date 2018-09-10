<?php 
error_reporting(1);
include_once("control.php");


$control_inventario = "";
$permiso_inventario = "";
$control_total = "";


$tipo_usuario = base64_decode($_SESSION["tipo_usuario"]) ;
$modulo_permiso = base64_decode($_SESSION["modulo_control"]);

if($tipo_usuario == "administrador" && $modulo_permiso =="academico"){
	$control_academico = "ok";
	$permiso_academico = "administrador";
}
if($tipo_usuario == "visualizador" && $modulo_permiso == "academico"){
	$control_academico = "ok";
	$permiso_academico = "visualizador";
}
if($tipo_usuario =="administrador" && $modulo_permiso =="inventario"){
	$control_inventario = "ok";
	$permiso_inventario = "administrador";
}
if($tipo_usuario == "visualizador" && $modulo_permiso == "inventario"){
	$control_inventario = "ok";
	$permiso_inventario = "visualizador";
}
$control_academico = NULL;
$permiso_academico = NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "panel administrador"; ?></title>
</head>
<body>
<div class="container">
<div class="row text-center">
	<div class="col-xs-12">
    
    </div>
</div>
<div class="row">
	<div class="col-xs-12 text-center">
  
    <img src="images/sisgen_logo.png" height="33" width="137" draggable="false"/>
    </div>
</div>
<div class="row">
	<div class="col-xs-12 text-center">
<?php 
if($control_inventario == "ok" or $permiso_inventario =="administrador" or $permiso_inventario=="visualizador")
{	
echo " Bienvenido: ".base64_decode($_SESSION["nbusuario"])." al sistema para la gesti�n de iInfraestructura de laboratorios"; 
}
?>
    </div>
</div>
<!-- fin de header del sitio -->
<div class="row">
<nav>
<ul><li class="drop">
				<a href="#">Cuenta</a>
				<div class="dropdownContain">
					<div class="dropOut">
					<div class="triangle"></div>
						<ul>
							<li onclick="javascript:abrir('cambio_clave');">cambiar clave</li>
                            <?php if($control_total !="" && $control_total=="ok"){?>
                            <li onclick="javascript:abrir('crear_usuario');">crear usuario</li>
                            <?php }?>
							<li onclick="javascript:window.location='salir.php';">salir</li>
						</ul>
					</div>
				</div>
			
			</li>
			<li><a href="" onclick="javascript:abrir('ayuda');">Ayuda</a></li>
		</ul>
        
</nav>
	         <div class="contenido">
             	<div class="panel panel-primary">
      <div class="panel-heading ">
        <h3 class="panel-title text-center text-capitalize">Opciones de <?=base64_decode($_SESSION["tipo_usuario"])?> para modulo <?=base64_decode($_SESSION["modulo_control"])?></h3>
      </div>
      <div class="panel-body">
       	<!-- comienzo cuerpo panel -->
        <?php if($control_academico == "ok" or $control_total== "ok"){ ?>
        	<div class="row center-block" id="contenedor_menu_central">
            <div class="page-header">modulo academico</div> 
            		<?php if($permiso_academico == "administrador" or $permiso_academico== "controltotal"){ ?>
                    <div class="col-xs-4" onmouseover="javascript:fondo_sobre('item_menu1');" onmouseout="javascript:fondo_fuera('item_menu1');" id="item_menu1">  
                    <div class="text-center" onclick="javascript:abrir('item_menu1');" style="z-index:1; position:absolute">
                    	Consolidar
                    </div>
<div id="info_consolidar" style=" z-index:2; height:10px; width:10px; position:absolute; left:20px; top:10px; visibility:hidden; font-size:10px; text-align:left;">
                        este es un ejemplo de la informacion!!!
                    </div>
                    </div>
                    <?php } ?>
                    
                    <div class="col-xs-4" onmouseover="javascript:fondo_sobre('item_menu2');" onmouseout="javascript:fondo_fuera('item_menu2')" id="item_menu2">
                    <?php if($permiso_academico == "visualizador" or $permiso_academico == "administrador" or  $permiso_academico== "controltotal"){ ?>
                    <div class="text-center" align="center" onclick="javascript:abrir('item_menu2');" style="z-index:1; position:absolute">
                   	 Gr�ficos
                    </div>
                    <?php } ?>
                    </div>
                    
                    
                    <div class="col-xs-4" onmouseover="javascript:fondo_sobre('item_menu3');" onmouseout="javascript:fondo_fuera('item_menu3')" id="item_menu3">
                    <?php if($permiso_academico == "visualizador" or  $permiso_academico == "administrador" or $permiso_academico== "controltotal"){ ?>
                    <div class="text-center" align="center" onclick="javascript:abrir('');">
                    	Sugerencias
                    </div>
                    <?php } ?> 
                    </div>
                    
            </div>
           <?php } ?>
          
 <?php if($control_inventario == "ok" or $control_total == "ok"){ ?>  
            <div class="row center-block" id="contenedor_menu_central">
             <div class="page-header">modulo inventario</div> 
            
           
            		<div class="col-xs-4" onmouseover="javascript:fondo_sobre('item_menu4');" onmouseout="javascript:fondo_fuera('item_menu4')" id="item_menu4">
<?php 
if($permiso_inventario=="visualizador" && $control_inventario="ok")
{
	echo "BLOQUEADO"; 		
}
?>
                    <?php if($permiso_inventario=="administrador" or $permiso_inventario == "controltotal"){?>
                    <div class="text-center" align="center" onclick="javascript:abrir('item_menu4');">
                    	Mantenedores
                    </div>
                 	<?php } ?>	<!-- aca va la llave -->
                   </div>
                   	
		
                    <div class="col-xs-4" onmouseover="javascript:fondo_sobre('item_menu5');" onmouseout="javascript:fondo_fuera('item_menu5')" id="item_menu5">
                    <?php if($permiso_inventario =="administrador" or $permiso_inventario=="visualizador" or $permiso_inventario == "controltotal"){?>
                    <div class="text-center" align="center" onclick="javascript:abrir('item_menu5');" style="font-size:10px;">
                    	OT
                    </div>
                    <?php }?>
                    </div>
                     	
               
                    <div class="col-xs-4" onmouseover="javascript:fondo_sobre('item_menu6');" onmouseout="javascript:fondo_fuera('item_menu6')" id="item_menu6">
                    <?php if($permiso_inventario =="administrador" or $permiso_inventario=="visualizador" or $permiso_inventario == "controltotal"){?> 
                    <div class="text-center" align="center" onclick="javascript:abrir('item_menu6');" style="font-size:10px;">
                    	Reportes
                    </div>
                   <?php } ?><!-- aca va la llave -->
                    </div>
                    
            </div>
    <?php } ?>
           
            <div class="row center-block" id="contenedor_menu_central">
            		<div class="col-xs-12 text-justify alert-info" id="mensaje" style="height:auto; font-size:12px; border-radius:6px; border-style:dotted; border-width:thin; border-color:#903;">
                    
                    </div>
            </div>
            <div class="row center-block" id="contenedor_menu_central">
            		<div class="col-xs-12 text-center alert-info" style="height:50px; font-size:14px; border-radius:6px; border-style:dotted; border-width:thin; border-color:#903; background-color:#CCC; padding-top:15px;">
                    <button data-toggle="modal" data-target="#myModal" style="background-color:transparent; border-style:none; color:#000;">
  	--�Preguntas frecuentes?--
					</button>
                    </div>
            </div>
           
 		<!-- 
        
        fin del cuerpo del panel 
        style="font-size:12px; color:#000; border:#F00; border-style:dotted; border-width:thin; visibility:hidden; height:50px;"
        
        -->	
      </div>
        </div>	
    </div>
</div> <!-- fin row -->
<!-- fin container -->
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">F.A.Q (preguntas y respuestas frecuentes...)</h4>
      </div>
      <div class="modal-body text-justify">
       
<!-- /container -->
		
            <h3>�Que puedo hacer si soy usuario visualizador inventario?</h3>
            <ol>
            	<li>Podra crear y gestionar OT, visualizar los reportes, pero no podra modificar la informacion de laboratorio</li>
            </ol>
            <hr />
            <h3>�Que puedo hacer si soy usuario administrador de inventario?</h3>
            <ol>
            	<li>Podra gestionar la informacion de equipos, crear OT, y generar reportes</li>
            </ol>
            <hr />
            <h3>�Puedo modificar toda mi informacion de la cuenta?</h3>
            <ol>
            	<li>No, solamente se puede modificar su clave de usuario.</li>
            </ol>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</body>
<link href="bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script src="bootstrap-3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript">
function abrir(id)
{	
    
        var locacion = "";
	 var alto = 730;
	 var ancho = 1360;
	 
	 switch(id){
		 		case 'item_menu1': locacion = "modulos/academico/notas.php";
									break;
				case 'item_menu2': locacion = "modulos/actividades/actividades.php";
									break;
				case 'item_menu3': locacion = "modulos/publicador/index.php";
									break;
                case 'cambio_clave': locacion = "cambiarClave.php";alto=300;ancho=400;
                                    break;
				
                case 'item_menu4': locacion = "modulos/inventario/mantenedores/inicio.php";
									break;
				case 'item_menu5': locacion = "modulos/inventario/OtInsumos/";
									break;
				case 'item_menu6': locacion = "modulos/inventario/index.php";
									break;
				case 'ayuda': locacion="ayuda/ManualdelusuariosistemaSISGEN.pdf";
								break;
				case 'crear_usuario':locacion="crearPerfil.php";
									
									break;
        /*
	 var locacion = "";
	 var alto = 700;
	 var ancho = 1360;
	 
	 switch(id){
		 		case 'item_menu1': locacion = "modulos/academico/notas.php";
									break;
				case 'item_menu2': locacion = "modulos/actividades/actividades.php";
									break;
				case 'item_menu3': locacion = "modulos/publicador/index.php";
									break;
                case 'cambio_clave': locacion = "cambiarClave.php";
                                    break;
				
                case 'item_menu4': locacion = "modulos/inventario/mantenedores/inicio.php";
									break;
				case 'item_menu5': locacion = "modulos/inventario/fichaGestion.php";
									break;
				case 'item_menu6': locacion = "modulos/inventario/index.php";
									break;
				case 'cambio_clave': locacion = "cambiarClave.php";
									ancho = 400;
									alto = 400;
								    break;
                */
				case 'ayuda': locacion="ayuda/index.htm";
								break;
		 }
	ventana(locacion,ancho,alto); 
}
function ventana(locacion,ancho,alto)
{
var posicion_x; 
var posicion_y; 
var posicion_x = (screen.width / 2)-(ancho/2); 
var posicion_y = (screen.height / 2)-(alto/2); 
window.open(locacion,"ventana sistema", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
</script>
<link rel="stylesheet" href="css/estilo_menu.css" />
<link rel="stylesheet" href="css/estilo.css" />
<style type="text/css">
body{
background-image:url(images/low_contrast_linen_@2X.png);
	background-repeat:repeat;
	font-family:"Adobe Caslon Pro", "Adobe Caslon Pro Bold", "Adobe Garamond Pro", "Adobe Garamond Pro Bold", "Agency FB", "VeraBd", serif, monospace, fantasy, "Goudy Stout", "Goudy Old Style", "Gloucester MT Extra Condensed";
	font-size:16px;
}
.col-xs-12{
	height:55px;
	border-style:none;
}
.row{
	border-style:none;
}
div.container{
	box-shadow:-2px -2px 10px #FFFFFF;
	box-decoration-break:slice;
}
div.col-xs-4{
	cursor: pointer;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size:13px;
	font-style:normal;
	color:#333;
	text-shadow: -5px 5px 5px #006699;
	color:#03C;
	box-shadow:-2px -2px 10px #333333;
	padding-top:35px;
}
div.panel.panel-primary{
	color:#333;
text-shadow: -5px 5px 5px rgba(0,0,0, 0.3);
}
div.contenido{
    height:auto;
    }
</style>
</html>