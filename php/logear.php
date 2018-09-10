<?php 
error_reporting(1);
include_once("conexion.php");
include_once("funcValidar.php");
include_once("validarIP.php");
$link = conexion();
$recurso = NULL;
$fila = NULL;

$datos = "";
$usuario = "";
$clave = "";
if(isset($_GET["informacion"])&& $_GET["informacion"]!="")$datos= $_GET["informacion"];
//tomamos los valores
if($datos!=""){
  $datos = preg_split("\-",base64_decode($datos));
  $usuario = $datos[0];
  $clave = $datos[1];
}
print_r($datos);
die;
//fin toma de valores
//*****************************************
if(!validarLogin($usuario,$clave))
//inicio del login del header
{
    header("Location:../index.php?mensaje=error desconocido");
}
echo $usuario. "<br>";
echo $clave ."<br>";
  
if($usuario!="" && $clave!="")
{
  $usuario = base64_encode($usuario);
  $clave =  base64_encode($clave);
  echo $login = "call selectUsuario('$usuario','$clave')"; 
  $recurso = mysqli_query($link,$login);
  $fila = mysqli_fetch_row($recurso);
//*******************************************************************************************************
if($fila!=NULL)
//constatamos si la funcion nos entrega un recurso, respecto a la consulta
{
    $login = "";
    $recurso = NULL;
	
    print_r($fila);
//*******************************************************************************************************
    if($fila!=NULL)
	//nos aseguramos que haya obtenido mas de una fila de la consulta
    {
	session_name("login_permisos");
        session_start();
		
	echo $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s"); 
        echo $_SESSION["idusuario"] = base64_encode($fila[0]);//tomamos el id para posteriores insert del log
        echo $_SESSION["nbusuario"] = $fila[1];//tomamos el nombre de usuario para saludo sistema
        echo $_SESSION["idpersona"] = base64_encode($fila[2]);//tomamos el id de persona, para seguimiento tabla logs
        echo $_SESSION["idSession"] = base64_encode(session_id());//generamos un id de sesion para poder identificar
		
	//ahora tomamos el tipo de usuario y el permiso sobre el modulo
	echo $_SESSION["tipo_usuario"] = base64_encode($fila["3"]) ;
	echo $_SESSION["modulo_control"] = base64_encode($fila["4"]);
	
        echo $_SESSION["estado"] = base64_encode("Logueado");//cambiamos el estado a logueado
	//aca damos la ip de origen del cliente
       	echo $ip = obtenerIp();
	echo $login = "call crearLog('$ip','login de usuario','".base64_decode($_SESSION["idusuario"])."')";
	$link = conexion();
  	$recurso = mysqli_query($link,$login);
	$fila = mysqli_fetch_row($recurso);
	echo $fila[0];
        if($fila[0]=="ok")
	//comienzo de consulta
        {
            mysqli_free_result($recurso);
            mysqli_close($conexion);
            header("Location: ../sistema/index.php");
        }
     // fin del else
    }
}
else
{
	header("Location: ../index.php?mensaje=error, no existe usuario o contraseña erronea");	
}
}
?>