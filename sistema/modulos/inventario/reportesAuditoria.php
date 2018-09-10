<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php

?>
<link href="../../bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../../bootstrap-3.3.4/js/jquery-1.11.2.js"></script> 
<script type="text/javascript" src="../../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>reportes del sistema</title>
</head>
<body>
<body>
<div class="container">
	<!-- aca le colocamos una cabecera, para que se vea mas lindo -->
	<div class="row text-center" id="cabecera">
    		<h4>reportes y detalles sistema</h4>
    </div>
 <div class="row text-center" id="opciones">
    
 </div>
 <div class="row">
    <div class="col-xs-12 text-center" id="contenido">
<?php
ob_start();
require('libs/html_table.php');
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',11);

$html='<table border="1" width="600">
<tr>
<td width="200" height="30">cell 1</td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
</tr>
<tr>
<td width="200" height="30">cell 3</td><td width="200" height="30">cell 4</td>
</tr>
</table>';

$pdf->WriteHTML($html);
$pdf->Output();
	  ?>
    </div>
 </div>
</div>
</body>
<style type="text/css">
/*
div{ border-style:dotted;border-width:thin; border-color: red;}
*/
body{background-color:rgba(0,51,102,1); font-family:Verdana, Geneva, sans-serif;font-size:10px;}
a:link,a:visited,a:hover{text-decoration:none; font-size:10px; color:black;}
.container{width:1360px;height:auto; background-image:url(../../images/swirl_pattern.png); margin-top: 50px; }
#cabecera{ height:40px; background-color:transparent;}
#opciones{background-color: #E5E5E5;}
#contenido{height: 750px;background-color:white;}
</style>
</body>
</html>