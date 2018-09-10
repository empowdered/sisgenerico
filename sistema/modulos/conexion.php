<?php
$conexion = NULL;
//localhost =>127.0.0.1
function Coneccion(){
	
	if(!$conexion = mysqli_connect("localhost","root","","sisgen","3306"))
	{
		echo "error en la conexion...". mysqli_connect_error(). "Con numero: " .mysqli_connect_errno();
	}
	return $conexion;		
}


?>