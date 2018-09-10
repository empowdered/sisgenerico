<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="libs/Zebra_Pagination-master/public/css/zebra_pagination.css" />
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <script src="../js/datetimepicker_css.js"></script>
<link rel="stylesheet" href="estilo.css" />
<title>licencias de software</title>
</head>
<?php
error_reporting(1);
require("conexion.php");
$link = "";
$resultado = mysqli_query(Conexion(),"select count(licencia.LIC_IDLICENCIA) FROM licencia");
$cantElementos = mysqli_fetch_row($resultado);
$recurso = NULL;
//*******************estas 2 son las variables para cargar el tipo
$cargar = "";
$id = "";

//*******************fin de carga de variables
$nroftware ="";
$nrolicencia="";
$fcompra="";
$tipolic="";
$fvencimiento="";
$fingreso="";
$fanterior="";
$fcreacion="";
$seriel="";
$usuario="";
$correo="";
$opcion="";


if(isset($_GET["id"]) && $_GET["id"]!="")$id = $_GET["id"];
if(isset($_POST["id"]) && $_POST["id"]!="")$id = $_POST["id"];

if(isset($_GET["cargar"]) && $_GET["cargar"]!="") $cargar = $_GET["cargar"];

if($id!="" && $cargar!="" && $cargar=="cargarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
	$link = Conexion();
	$selectLicencia = "select * from licencia where licencia.LIC_IDLICENCIA ='$id'";
	if($fila=mysqli_fetch_row(mysqli_query(Conexion(),$selectLicencia)))
	{	
		$id =$fila[0];
		$nroftware =$fila[1];
		$nrolicencia=$fila[2];
		$fcompra=$fila[3];
		$tipolic=$fila[4];
		$fvencimiento=$fila[5];
		$fingreso  =$fila[6];
		$fcreacion=$fila[7];
		$seriel=$fila[8];
		$usuario=$fila[9];
		$correo=$fila[10];
		
	}
}
if($id!="" && $cargar!="" && $cargar=="borrarDatos")
//aca comenzamos la creacion del select para cargar y editar
{
	$borrarLicencia = "delete from licencia where licencia.LIC_IDLICENCIA ='$id'";
	$link = Conexion();
	if(mysqli_query($link,$borrarLicencia))
	{
		header("Location: Licencias.php?mensaje=registro borrado exitosamente");
		exit();
	}
}


if(isset($_POST["nroftware"]) && $_POST["nroftware"]!="") $nroftware = $_POST["nroftware"];
if(isset($_POST["nrolicencia"]) && $_POST["nrolicencia"]!="") $nrolicencia = $_POST["nrolicencia"];
if(isset($_POST["fcompra"]) && $_POST["fcompra"]!="") $fcompra = $_POST["fcompra"];
if(isset($_POST["tipolic"]) && $_POST["tipolic"]!="") $tipolic = $_POST["tipolic"];
if(isset($_POST["fvencimiento"]) && $_POST["fvencimiento"]!="") $fvencimiento = $_POST["fvencimiento"];
if(isset($_POST["fingreso"]) && $_POST["fingreso"]!="") $fingreso = $_POST["fingreso"];
if(isset($_POST["fanterior"]) && $_POST["fanterior"]!="") $fanterior = $_POST["fanterior"];
if($fingreso==""){
	$fingreso = $fanterior;	
}
if(isset($_POST["fcreacion"]) && $_POST["fcreacion"]!="") $fcreacion = $_POST["fcreacion"];
if(isset($_POST["seriel"]) && $_POST["seriel"]!="") $seriel = $_POST["seriel"];
if(isset($_POST["usuario"]) && $_POST["usuario"]!="") $usuario = $_POST["usuario"];
if(isset($_POST["correo"]) && $_POST["correo"]!="") $correo = $_POST["correo"];
if(isset($_POST["opcion"]) && $_POST["opcion"]!="") $opcion = $_POST["opcion"];


if($opcion!="")
//inicio del consultar por variables vacias
{
//********************************************************************************************************
	if($opcion=="crear")
	//inicio de la opcion crear
	{	
	       
		$link = Conexion();
		$crearLicencia = "INSERT INTO `sisgen`.`licencia` (`SOF_IDSOFTW`, `LIC_NROLICENCIA`, `LIC_FCOMPRALIC`, `LIC_TIPOLICENCIA`, `LIC_FVENCIMIENTO`, 
        `LIC_FINGRESO`, `LIC_FCREACION`, `LIC_SERIELICENCIA`, `LIC_USUARIOLIC`, `LIC_CORREOASOCIADO`) 
        VALUES ('$nroftware', '$nrolicencia', '$fcompra', '$tipolic', '$fvencimiento', '$fingreso', NOW(), '$seriel', '$usuario', '$correo')";
		$recurso = mysqli_query($link,$crearLicencia);
		if($recurso!=NULL)
		//inicio de la consulta del recurso != null
		{
			mysqli_close($link);
			header("Location: Licencias.php?mensaje=creacion de la licencia, exitosa");
			exit();	
		}
		else
		//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierra conexion
		{
			mysqli_close($link);
			header("Location: Licencias.php?mensaje=no se pudo crear el registro de la licencia ingresada");
			exit();
		}
	}//fin del crear
//*****************************************************************************************************
	if($opcion=="actualizar" && $id!="")
	//inicio del actualizar
	{
		$link = Conexion();
		$actualizarLicencia = "update licencia set 
		`LIC_NROLICENCIA` = '$nrolicencia', 
		`LIC_FCOMPRALIC` ='$fcompra', 
		`LIC_TIPOLICENCIA`='$tipolic', 
		`LIC_FVENCIMIENTO`='$fvencimiento', 
        `LIC_FINGRESO`='$fingreso',  
		`LIC_SERIELICENCIA`='$seriel', 
		`LIC_USUARIOLIC`='$usuario',
		 `LIC_CORREOASOCIADO` ='$correo'
		 where licencia.LIC_IDLICENCIA='$id'";
		 /*
		 '$fcompra', '$tipolic', '$fvencimiento', '$fingreso', NOW(), '$seriel', '$usuario', '$correo'
		 */
		
		$recurso = mysqli_query($link,$actualizarLicencia);
		if($recurso!=NULL)
		//inicio de la consulta del recurso != null
		{
			mysqli_close($link);
			header("Location: Licencias.php?mensaje=actualizacion de la licencia ingresada,ok");
			exit();
		}
		else
		//sino resulta el recurso se envia un mensaje de error, se libera recursos y cierr conexion
		{
			mysqli_close($link);
			header("Location: Licencias.php?mensaje=no se pudo actualizar el registro de la licencia ingresada");
			exit();
		}
	}//fin del actualizar
//***************************************************************************
}//fin del preguntar si variables llegan vacias o no
?>
<body>
<div class="container">
	<!-- aca le colocamos una cabecera, para que se vea mas lindo -->
	<div class="row text-center" id="cabecera">
    
    </div>
    <!-- aca termina la cabecera -->
    <div class="row">
    	<!-- aca comienza el cuerpo de la cuestion, menu izquierda y contenido centro -->
        <div class="col-xs-4 text-left" id="menu">
                	<div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="equiposImpresion.php">impresoras</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="equiposPC.php">computadores</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="equiposRed.php">equipos de red</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="Perifericos.php">perifericos</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="Software.php">programas</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="Licencias.php">licencias</a>
                    </div>
                     <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="tipos.php">categoria equipos</a>
                    </div>
                     <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="ubicacion.php">ubicaciones</a>
                    </div>
                    <div class="row" id="enlace">
                    <span class="glyphicon glyphicon-expand"></span>
                    <a href="marca.php">Marca</a>
                    </div>
        </div>
        <div class="col-xs-8" id="formularios">
        	<div class="alert text-center">
        <hr />
<form action="Licencias.php" method="post">
<input type="hidden" name="id" id="id" value="<?=$id?>" />
       <table width="500" align="center" class="table-hover" style="font-size:12px; height:100px;">
       <th colspan="4" class="text-center">mantenedor de licencias</th>
  <tr>
    <td>&nbsp;Equipo Asociado:</td>
    <td>&nbsp;
    <?php
		$link = Conexion();
        $vacio ="";
        $selected ="";
        if($nroftware=="")$vacio = "selected='selected'";
        $recurso = NULL;
        $nbSoftware = "select equipo.EQ_IDEQUIPO,equipo.EQ_SERIEEQUIPO,software.SOF_NBSOFTW,software.SOFT_ACTIVADO,
                        software.SOF_IDSOFTW
                            from
                        equipo,software
                        where
                        equipo.EQ_IDEQUIPO = software.EQ_IDEQUIPO
                        and
                        software.SOF_IDSOFTW 
                        not in(select licencia.SOF_IDSOFTW from licencia)and software.SOFT_ACTIVADO='activo'";
        $recurso = mysqli_query($link,$nbSoftware);
        ?>
        <select name="nroftware" id="nroftware" onchange="javascript:selected('nroftware');">
        <option value="" <?=$vacio?>>Seleccione</option>
        <?php
        $idx = array();
        $nombreSoft = array();
        $estado = array();
          
        if($recurso!=NULL && $nroftware=="")
        {
            $i = 0;
            while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
            {
                echo "<option value='".$fila[4]."' $selected  >".$fila[1]."</option>";
                $nombreSoft[$i] = $fila[2]; 
                $estado[$i] = $fila[3];
                $i++;
            }
            
        }
		mysqli_close($link);
    ?>
    </select>
    </td>
    <td>Estado del software:</td>
    <td>
    <select name="" id="estadox" disabled="disabled">
    <option selected="selected">Seleccione</option>
    <?php
	if($nroftware=="")
	{
        for($i=0;$i<count($estado);$i++)
        {
            echo "<option value='$i'>".$estado[$i]."</option>";  
        }    
	}
	?>
    </select>
    </td>
    </tr>
    <tr>
    <td>Nombre del software:</td>
    <td><select name="" id="nombresoftx" disabled="disabled">
    <option selected="selected">Seleccione</option>
    <?php
        if($nroftware=="")for($i=0;$i<count($nombreSoft);$i++)echo "<option value='$i'>".$nombreSoft[$i]."</option>";
    ?>
    </select>
    </td>
    <td></td>
    </tr>
    <td>&nbsp;N° Licencia:</td>
    <td><input name="nrolicencia" type="text" value="<?=$nrolicencia?>" size="15" /></td>
  </tr>
  <tr>
    <td>&nbsp;Fecha Compra:<span class="glyphicon glyphicon-calendar" onclick="javascript:NewCssCal('fcompra','yyyyMMdd')" style="cursor:pointer"></span></td>
    <td><input name="fcompra" id="fcompra" type="text" value="<?=$fcompra?>" size="15"  /></td>
    <td>&nbsp;Tipo Licencia:</td>
    <td><input name="tipolic" type="text" value="<?=$tipolic?>" size="15" /></td>
  </tr>
  <tr>
    <td>&nbsp;Fecha venc.:<span class="glyphicon glyphicon-calendar" onclick="javascript:NewCssCal('fvencimiento','yyyyMMdd')" style="cursor:pointer"></span></td>
    <td><input name="fvencimiento" id="fvencimiento" type="text" value="<?=$fvencimiento?>" size="15"  /></td>
    <?php
	$fanterior = $fingreso;
	$fingreso = "";
	?>
    <td>&nbsp;Fecha ingreso:<span class="glyphicon glyphicon-calendar" onclick="javascript:NewCssCal('fingreso','yyyyMMdd')" style="cursor:pointer"></span></td>
    <td><input name="fingreso" id="fingreso" type="text" value="" size="15"  /></td>
  </tr>
  <tr>
  	<td>&nbsp;Fecha anterior:</td>
    <td><input name="fanterior" type="text" value="<?=$fanterior?>" size="15" readonly="readonly" /></td>
    <td>&nbsp;Fecha creacion:</td>
    <td><input name="fcreacion" type="text" value="<?=$fcreacion?>" size="15"  /></td>
  </tr>
  <tr>
    <td>&nbsp;Serie Licencia:</td>
    <td>&nbsp;<input name="seriel" type="text" value="<?=$seriel?>" size="15" /></td>
    <td>&nbsp;Usuario:</td>
    <td><input name="usuario" type="text" value="<?=$usuario?>" size="15"  /></td>
  </tr>
  <tr>
    <td>&nbsp;Correo asociado:</td>
    <td><input name="correo" type="text" value="<?=$correo?>" size="15"  /></td>
  </tr>
  <tr>
  <td colspan="4" class="text-alert"><?php if(isset($_GET["mensaje"]) && $_GET["mensaje"]!="")echo $_GET["mensaje"];?></td>
  </tr>
  <tr>
    <td colspan="4">
    <input name="opcion" type="submit" value="crear" class="boton"/>
    <input name="opcion" type="submit" value="actualizar" class="boton"/>
    <input name="opcion" type="reset" value="limpiar" class="boton" onclick="javascript:window.location='Licencias.php';"/>
    </td>
  </tr>
</table>
</form>
<div id="despliegue">
<?php
$link = Conexion();
$cant_pagina = 5;
include_once("libs/Zebra_Pagination-master/Zebra_Pagination.php");
$paginadorZebra = new Zebra_Pagination();
$cantidadRegistros = mysqli_num_rows(mysqli_query($link,"select licencia.LIC_IDLICENCIA from licencia"));

$paginar_resultados = "select software.SOF_NBSOFTW,licencia.LIC_IDLICENCIA,
licencia.LIC_NROLICENCIA,licencia.LIC_SERIELICENCIA from software,licencia  
where software.SOF_IDSOFTW = licencia.SOF_IDSOFTW
order by licencia.LIC_IDLICENCIA  limit " . (( $paginadorZebra->get_page() - 1 ) * $cant_pagina ) . ",  " . $cant_pagina;
$paginadorZebra->records($cantidadRegistros);
$paginadorZebra->records_per_page($cant_pagina);

?>
<hr />
<table width="500" align="center" class="table-hover" style="font-size:12px;">
<tr>
<td colspan="6">cantidad de registros:<?=$cantElementos[0]?></td>
</tr>
</tr>
<td colspan="6" class="text-center">listado de programas</th>
<tr>
<td>software</td>
<td>codigo licencia</td>
<td>nombre</td>
<td>descripcion</td>
<td colspan="2">opciones</td>
</tr>
<?php
$recurso = mysqli_query($link,$paginar_resultados);
	if (!$recurso) {
    	printf("Error: %s\n", mysqli_error($link));
    	exit();
		}
	while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
	{
		echo "<tr><td>".$fila[0]."</td><td>".$fila[1]."<td>".$fila[2]."</td><td title='".$fila[3]."'>".substr($fila[3],0,7)."..."."</td>";
		echo '<td><span class="glyphicon glyphicon-pencil" title="editar" onclick=javascript:cargar('.$fila[1].');></span></td>';
    	echo '<td><span class="glyphicon glyphicon-remove" title="borrar" onclick=javascript:borrar('.$fila[1].');></span></td>';
    	echo '</tr>';
    
	}
?>
</table>
<?=$paginadorZebra->render();?>
</div>
<script type="text/javascript">
function cargar(id)
{
	//alert(id);
	if(confirm("¿Desea cargar esta opcion para edicion?"))
	{
			window.location = "Licencias.php?cargar=cargarDatos&id=" + id;
	}
	
}
function borrar(id)
{
	//alert(id);
	if(confirm("¿Realmente desea borrar esta opcion?"))
	{
			window.location = "Licencias.php?cargar=borrarDatos&id=" + id;
	}
	
}
function selected(id)
{
    controlador = document.getElementById(id);
    estadox = document.getElementById("estadox");
    estadox.disabled = false;
    nbsoftw = document.getElementById("nombresoftx");
    nbsoftw.disabled = false;
    estadox.selectedIndex = controlador.selectedIndex;
    nbsoftw.selectedIndex = controlador.selectedIndex;
    //alert('es real la seleccion');
    //alert('la opcion escogida es:' + controlador.selectedIndex);
    estadox.disabled = true;
    nbsoftw.disabled = true;
}
</script>
    	<!-- aca finaliza el cuerpo y el resto del contenido -->
    </div>
</div>
 </div>
  </div>
</body>
</html>