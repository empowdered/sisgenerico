<?php
		include_once("Conexion.php");
                include_once("control.php");

		$link = Conexion();
		$clave = "";
			if(isset($_POST["clave"])&& $_POST["clave"]!="") $clave = $_POST["clave"];
			if($clave!="")
			{	session_name("login_permisos");
				session_start();
				$updateClave = "update usuario set usuario.usu_passusuario = '".base64_encode($clave)."' where usuario.usu_idusuario= '".base64_decode($_SESSION['idusuario'])."'";
				if(mysqli_query($link,$updateClave))
				{
					//echo "<br>Clave Actualizada correctamente";
                                        echo "<script type='text/javascript'>";
                                        echo "window.alert('clave actualizada correctamente');";
                                        echo "window.close();</script>";
				}
				else
				{
					echo "<br>Error al actualizar la clave";	
				}
			}
			else
			{
				echo "<br>No ha sido ingresado ningun cambio de clave";
			}
?>
