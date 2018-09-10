<?php
$Conn = NULL;
function conexion()
{
    if(!($Conn = mysqli_connect("127.0.0.1","root","","sisgen","3306")))
    {
        echo "Falla en la conexion de la base de datos: " . mysqli_connect_error() . ", Con N°: " . mysqli_connect_errno();
        
    }
    return $Conn;
}
?>