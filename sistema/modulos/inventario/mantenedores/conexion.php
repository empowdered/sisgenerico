<?php
$Conn = NULL;
function Conexion() 
{ 
   if (!($Conn=mysqli_connect("localhost","root","","sisgen","3306"))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (mysqli_connect_errno())
   {
  	  echo "Falla al conectar a MySQL: " . mysqli_connect_error();
   }
   return $Conn; 
} 
?>
