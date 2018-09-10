<?php
$conexion = NULL;
//localhost =>127.0.0.1
function Conexion(){
	
	if(!$conexion = mysqli_connect("127.0.0.1","root","","sisgen","3306"))
	{
		echo "error en la conexion...". mysqli_connect_error(). "Con numero: " .mysqli_connect_errno();
	}
	return $conexion;		
}
?>