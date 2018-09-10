<?php
session_start();
//esta variable contiene el resultado de la comparacion
$error ="";
$datos = "";
$usuario = "";
$clave = "";
$captcha ="";

if(isset($_POST["usuario"]) && $_POST["usuario"]!="")$usuario = $_POST["usuario"];	
if(isset($_POST["clave"]) && $_POST["clave"]!="")$clave = $_POST["clave"];
if(isset($_POST["code"]) && $_POST["code"]!="")$captcha = $_POST["code"];	

if($captcha != $_SESSION["captcha"] or $captcha=="") {
    
  $error = "Usted no ha escrito el codigo de verificacion correctamente. Por favor, intentelo de nuevo!";
  header("Location:index.php?mensaje=".$error);

} 
else 
{
if($usuario !="" && $clave!="")
{
  $datos = base64_encode($usuario."-".$clave);
  header("Location: php/logear.php?informacion=".$datos);
  //exit();
}
else
{
  header("Location: index.php?mensaje=debe ingresar usuario y clave");	
  //exit();
}
}
?>