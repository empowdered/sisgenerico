<?php require("control.php");?>
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
       escoja alguna de las opciones. !
    </div>
 </div>
</div>
</body>
</html>