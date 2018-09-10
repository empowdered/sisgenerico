<?php   
//esta funcion validara si el login corresponde respecto a la estructura de los datos, y excluyendo malas digitaciones, o caracteres
//indebidamente insertados
function validarLogin($usuario,$clave)
{
    $usuario = htmlspecialchars($usuario);
    $usuario = trim($usuario);
    $correo = stripslashes($usuario);
    
    $clave = htmlspecialchars($correo);
    $clave = trim($clave);
    $clave = stripslashes($clave);
    
if($correo=="" && $clave=="")
{
    return  false;
}
//if(!filter_var($correo,FILTER_VALIDATE_EMAIL)) 
//{
  //  $resultado = false;
//}
if(!ereg("[a-zA-Z0-9\-_]{3,20}$",$usuario))
{
    return false;
}
if(!ereg("^[a-zA-Z0-9\-_]{3,20}$",$clave))
{
    return false;
}
return true;
}
?>