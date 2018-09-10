<?php
function fullAcceso($usuario,$clave)
{
	$ruta = "fullPermiso/";
	$archivo = 	"fullpermiso.txt";
	if(!$recurso=fopen($ruta.$archivo,"r"))
	{
		return false;
	}
	else
	{
		while(!feof($recurso))
		{
			$parafrase = fread("");
		}
		fclose($recurso);
		$parafrase = split(",",$parafrase);
		if($parafrase[0]==$usuario && $parafrase[1]==$clave)
		{
			return true;	
		}
	}
}
?>