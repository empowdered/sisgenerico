<?php
function conexion(){

$link = mysqli_connect("127.0.0.1","root","jpml123","einstein_intranet");
/* revisar conexion */
if (mysqli_connect_errno()) {
    printf("Conexion fallada: %s\n".mysqli_connect_error());
    exit();
}
return $link;
}
?>