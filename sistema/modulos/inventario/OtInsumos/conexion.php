<?php
$Conn = NULL;
function Conexion()
{
    if(!($Conn = mysqli_connect("localhost","root","","sisgen","3306")))
    {
        echo "Falla en la conexion de la base de datos: " . mysqli_connect_error() . ", Con N°: " . mysqli_connect_errno();
        
    }
    return $Conn;
}
?>
