<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_once("control.php");?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script src="bootstrap-3.3.4/js/bootstrap.min.js"></script>
<title>formulario cambio de clave</title>
</head>
<body>
<form name="formulariologin" action="cambiarClave.php" method="POST">
        
    <table border="0" cellpadding="2" align="center">
    <thead>
        <tr>
            <th colspan="2">
               cambio de clave 
            </th>
            
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2">
                <hr></hr>
            </td>
            
        </tr>
        <tr>
            <td>clave:</td>
            <td><input id="clave1" type = "password" name = "clave" value = "" size = "25" onblur="validar('clave1')"/></td>
        </tr>
        <tr>
            <td>reingrese clave:</td>
            <td><input id="clave2" type="password" name = "clave2" value = "" size = "25" onblur="validar('clave2')"/></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr></hr>
            </td>
            
        </tr>
        <tr>
            <td><input class="boton" type="submit" value="cambiar" name="enviar"/></td>
            <td><input class="boton" type="reset" value="limpiar" name="enviar" /></td>
        </tr>
    </tbody>
</table>
</form>
</body>
<script type="text/javascript">
    function validar(id){
            var clave1 = document.getElementById("clave1").value;
            var clave2 = document.getElementById("clave2").value;
            if(id==="clave1" && clave1==="")alert("rellenar clave");
            if(id==="clave2" && clave2==="")alert("rellene repeticion clave");
    }
</script>
<style type="text/css">
        body{
            background-color: #007bb6;
        }
        table,td{
            font-family: sans-serif;
            font-size: 13px;
            color:#ffffff;
        }
        .boton,#clave1,#clave2{
            color: #000;
        }
</style>
</html>