<?php

$conexion = mysqli_connect("localhost","root","jpml123","sisgen","3306") or die("Error en la conexion:".mysqli_errno());

$id = 1;

$consulta_activo = "call consultaSO(1)";
$recurso = mysqli_query($conexion,$consulta_activo);

if($recurso)
{
    
    $resultado = mysqli_fetch_row($recurso);
    echo $resultado[0];
    
} 
?>