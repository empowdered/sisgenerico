<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$include = "conexion.php";
require($include);
$conn = conexion();
$sql = "call devuelveUsuarios()";
$recurso = mysqli_query($conn,$sql);
while($fila=mysqli_fetch_array($recurso))
{
   echo $fila[0]. "<br>";    
   echo base64_decode($fila[1]). "<br>";  
   echo $fila[2]. "<br>";  
   echo base64_decode($fila[3]). "<br>";  
   echo $fila[4]. "<br>";  
   echo $fila[5]. "<br>";  
   echo $fila[6]. "<br>";  
}
?>

