<?php 
session_name("login_permisos");
session_start();
if(base64_decode($_SESSION["estado"])!="Logueado")
{
session_unset();
session_destroy();
header("Location: http://127.0.0.1/SisGen/index.php?mensaje=no tiene permiso para acceder a este recurso"); 
}
else
{
$fechaGuardada = $_SESSION["ultimoAcceso"]; 
$ahora = date("Y-n-j H:i:s"); 
$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
if($tiempo_transcurrido >= 600) { 
session_unset();
session_destroy(); 
header("Location: ../index.php?mensaje=ha salido del sistema"); 
}
else
{
$_SESSION["ultimoAcceso"] = $ahora;
} 
}
?>