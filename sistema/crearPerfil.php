<link href="bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<link rel="stylesheet" href="modulos/inventario/mantenedores/estilo.css" />
<?php
session_name("login_permisos");
session_start();
require("conexion.php");
$link = Conexion();
$recurso=NULL;
if(isset($_SESSION["tipo_usuario"]) && $_SESSION["tipo_usuario"]!="")
{
	if(base64_decode($_SESSION["tipo_usuario"])=="administrador")
	{
?>
<!-- construccion del formulario para crear perfil administrador-->
<hr />
<form action="accionPerfil.php" method="post">
<table align="center" width="650">
<tr>
<td>&nbsp;nombres:&nbsp;</td><td>&nbsp;<input type="text" size="20" value="" name="nombre"/>&nbsp;</td>
<td>&nbsp;apellidos:&nbsp;</td><td>&nbsp;<input type="text" size="20" value="" name="apellido"/>&nbsp;</td>
</tr>
<tr>
    <td colspan="4"><hr></td>
</tr>
<tr>
<td valign="top">&nbsp;direccion:&nbsp;</td>
<td>&nbsp;<textarea cols="20" rows="5" name="direccion"></textarea>&nbsp;</td>
<td valign="top">&nbsp;rut:&nbsp;</td>
<td valign="top">&nbsp;<input type="text" size="20" value="" name="rutpers"/>&nbsp;</td>
</tr>
<tr>
    <td colspan="4"><hr></td>
</tr>
<tr>
<td>&nbsp;perfil:&nbsp;</td>
<?php
$perfil = "call selectPerfilAdmin()";
$recurso=mysqli_query($link,$perfil);
?>
<td>&nbsp;
<select name="idperfil" style="color:#000;">
<option value="" selected="selected">Seleccionar</option>
<?php
if($recurso!=NULL)
{
	while($fila=mysqli_fetch_row($recurso))
	{
			echo "<option value='".$fila[0]."'>".$fila[1]."</option>";
	}
}
mysqli_close($link);
?>
</select>
    &nbsp;
</td>
<td valign="top">&nbsp;nombre usuario:&nbsp;</td>&nbsp;
<td valign="top"><input type="text" size="20" value="" name="nbusuario"/>&nbsp;</td>
</tr>
<tr>
<td valign="top">&nbsp;correo usuario:&nbsp;</td><td>&nbsp;
    <input name="correo" type="text" id="correo" value="" size="20"/>&nbsp;</td>
<td colspan="2"></td>
</tr>
<tr>
<td valign="top">&nbsp;clave usuario:&nbsp;</td><td valign="top">&nbsp;
    <input type="password" size="20" value="" name="claveusu"/>&nbsp;</td>
<td valign="top">&nbsp;observacion:&nbsp;</td>
<td>&nbsp;
    <textarea cols="20" rows="5" name="observacion"> 
    </textarea>&nbsp;
</td>
</tr>
<tr>
    <td colspan="4"><hr></td>
</tr>
<tr>
<td>&nbsp;<input type="submit" class="btn btn-default btn-sm" name="opcion" value="crear"/>&nbsp;</td>
<td>&nbsp;<input type="reset" class="btn btn-default btn-sm" name="opcion" value="limpiar"/>&nbsp;</td>
</tr>
<tr>
<td colspan="4">
<?php
if(isset($_GET["mensaje"]) &&$_GET["mensaje"]!="")echo $_GET["mensaje"];
?>
</td>
</tr>
</table>
</form>
<div style="height:1px; background-color:#CCC;"></div>
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
            <br />
                <table align="center" width="600" border="1" class="table-hover">
                <th colspan="4" style="text-align:center;color:black;">personas</th>
                <tr>
                <td style="text-align:center;color:black;">codigo</td>
                <td style="text-align:center;color:black;">nombres</td>
                <td style="text-align:center;color:black;">apellidos</td>
                <td style="text-align:center;color:black;">rut</td>
                </tr>
                <?php
				$recurso = NULL;
				$link =Conexion();
					$llamada = "call selectPersona()";
					$recurso = mysqli_query($link,$llamada);
					if($recurso!=NULL)
					{
						while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
						{
							echo "<tr>";
							echo "<td style='color:black;'>".$fila[0]."</td><td style='color:black;'>".$fila[1]."</td><td style='color:black;'>".$fila[2]."</td><td style='color:black;'>".$fila[4]."</td>";
							echo "</tr>";
						}
					}
					mysqli_close($link);
				?>
                </table>
            </div>
        </div>
    </div>
<?php
	}
//fin del if
}
?>
<style type="text/css">
table th,td {
	color:#FFF;
	font-size:12px;
	font-family:Verdana, Geneva, sans-serif;
}
input,textarea{
	color:#000;
}
.container{
	background-color:#FFF;
	height:350px;
	font-size:12px;
	font-family:Verdana, Geneva, sans-serif;
	color:#000;
	overflow:auto;
}
</style>