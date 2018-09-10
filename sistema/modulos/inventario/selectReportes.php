<?php
require("conexion.php");
require("claseTabla.php");
$opcion="";
$link = Conexion();

if(isset($_GET["opcion"]) && $_GET["opcion"]!="")$opcion=$_GET["opcion"];

if($opcion!="")
{
	if($opcion=="equipo")
	{
		echo "1";
		$llamadoEquipo = "select tipo.TIP_NBTIPO, ubicacion.UB_TIPOSALA,equipo.EQ_NROEQUIPO,equipo.EQ_SERIEEQUIPO,equipo.EQ_MARCA,equipo.EQ_MODELO,
equipo.EQ_ESTADO from tipo,ubicacion,equipo where tipo.TIP_IDTIPO = equipo.EQ_IDTIPO AND ubicacion.UB_IDUBICACION = equipo.UB_IDUBICACION";
		$recurso = mysqli_query($link,$llamadoEquipo);
		if($recurso!=NULL)
		{
			
			
			$archivo = "";
			if(!($archivo=fopen("equipos.txt","w+")))
			{
				die("error en sistema");
			}
			else
			{
				while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
				{
					fwrite($archivo,$fila[0].";".$fila[1].";".$fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].PHP_EOL);	
					//echo $fila[0].";".$fila[1].";".$fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].PHP_EOL;
				}
				fclose($archivo);
				
				//mysqli_free_result($recurso);
				//mysqli_close($link);
				$header = array("TIPO","UBICACION","NRO-EQUIPO",'SERIE','MARCA','MODELO','ESTADO');
				$data = array();
				ob_start();
				$pdf = new PDF();
				$data = $pdf->LoadData('equipos.txt');
				$pdf->SetFont('Arial','',10);
				$pdf->AddPage('L', 'Legal');
				$pdf->BasicTable($header,$data);
				$fila=mysqli_fetch_row(mysqli_query($link,"select count(equipo.EQ_IDEQUIPO) FROM equipo"));
				$pdf->Cell(5,10,'fecha del reporte:'.date("Y/m/d"),0);
				$pdf->Cell(5,20,'cantidad registros:'.$fila[0],0);
				
				/*
				$pdf->BasicTable($header,$data);
				$pdf->AddPage();
				$pdf->ImprovedTable($header,$data);
				$pdf->AddPage();
				$pdf->FancyTable($header,$data);
				*/
				$pdf->Output();
	
			}
		
		}
	}//fin equipos

	if($opcion=="impresora")
	{
		echo "2";
		$llamadoImpresion = "select tipo.TIP_NBTIPO,impresion.IM_IDIMPRESION,impresion.IM_SERIEIMPRESION,
impresion.IM_MARCA,impresion.IM_MODELO,impresion.IM_TIPOIMPRESION
FROM
tipo,impresion
where
tipo.TIP_IDTIPO = impresion.TIP_IDTIPO
ORDER BY impresion.IM_IDIMPRESION ASC";
		$recurso = mysqli_query($link,$llamadoImpresion);
		if($recurso!=NULL)
		{
			
			
			$archivo = "";
			if(!($archivo=fopen("impresora.txt","w+")))
			{
				die("error en sistema");
			}
			else
			{
				while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
				{
					fwrite($archivo,$fila[0].";".$fila[1].";".$fila[2].";".$fila[3].";".$fila[4].";".$fila[5].PHP_EOL);	
					//echo $fila[0].";".$fila[1].";".$fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].PHP_EOL;
				}
				fclose($archivo);
				
				//mysqli_free_result($recurso);
				//mysqli_close($link);
				$header = array("TIPO","CODIGO","SERIE",'MARCA','MODELO','TIPO');
				$data = array();
				ob_start();
				$pdf = new PDF();
				$data = $pdf->LoadData('impresora.txt');
				$pdf->SetFont('Arial','',10);
				$pdf->AddPage('L', 'Legal');
				$pdf->BasicTable($header,$data);
				$fila=mysqli_fetch_row(mysqli_query($link,"select count(impresion.IM_IDIMPRESION) FROM impresion"));
				$pdf->Cell(5,10,'fecha del reporte:'.date("Y/m/d"),0);
				$pdf->Cell(5,20,'cantidad registros:'.$fila[0],0);
				
				/*
				$pdf->BasicTable($header,$data);
				$pdf->AddPage();
				$pdf->ImprovedTable($header,$data);
				$pdf->AddPage();
				$pdf->FancyTable($header,$data);
				*/
				$pdf->Output();
	
			}
		
		}
	}//fin de impresion
	if($opcion=="red")
	{
		echo "3";
		$llamadoRed = "select tipo.TIP_NBTIPO,
red.RED_MARCAEQUIPO,red.RED_MODELO,red.RED_SERIERED
FROM
tipo,red
where
tipo.TIP_IDTIPO = red.TIP_IDTIPO
ORDER BY
red.RED_IDRED ASC";
		$recurso = mysqli_query($link,$llamadoRed);
		if($recurso!=NULL)
		{
			
			
			$archivo = "";
			if(!($archivo=fopen("red.txt","w+")))
			{
				die("error en sistema");
			}
			else
			{
				while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
				{
					fwrite($archivo,$fila[0].";".$fila[1].";".$fila[2].";".$fila[3].PHP_EOL);	
					//echo $fila[0].";".$fila[1].";".$fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].PHP_EOL;
				}
				fclose($archivo);
				
				//mysqli_free_result($recurso);
				//mysqli_close($link);
				$header = array("TIPO","MARCA","MODELO",'SERIE');
				$data = array();
				ob_start();
				$pdf = new PDF();
				$data = $pdf->LoadData('red.txt');
				$pdf->SetFont('Arial','',10);
				$pdf->AddPage('P', 'Legal');
				$pdf->BasicTable($header,$data);
				$fila=mysqli_fetch_row(mysqli_query($link,"select count(red.RED_IDRED) FROM red"));
				$pdf->Cell(5,10,'fecha del reporte:'.date("Y/m/d"),0);
				$pdf->Cell(5,20,'cantidad registros:'.$fila[0],0);
				
				/*
				$pdf->BasicTable($header,$data);
				$pdf->AddPage();
				$pdf->ImprovedTable($header,$data);
				$pdf->AddPage();
				$pdf->FancyTable($header,$data);
				*/
				$pdf->Output();
	
			}
		
		}
		
	}
	if($opcion=="persona")
	{
		echo "3";
		$llamadoPersonas = "select * from persona";
		$recurso = mysqli_query($link,$llamadoPersonas);
		if($recurso!=NULL)
		{
			
			
			$archivo = "";
			if(!($archivo=fopen("personas.txt","w+")))
			{
				die("error en sistema");
			}
			else
			{
				while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
				{
					fwrite($archivo,$fila[0].";".$fila[1].";".$fila[2].";".substr($fila[3],0,15)."...;".$fila[4].PHP_EOL);	
					//echo $fila[0].";".$fila[1].";".$fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].PHP_EOL;
				}
				fclose($archivo);
				
				//mysqli_free_result($recurso);
				//mysqli_close($link);
				$header = array("CODIGO","NOMBRES","APELLIDOS",'DIRECCION',"RUT");
				$data = array();
				ob_start();
				$pdf = new PDF();
				$data = $pdf->LoadData('personas.txt');
				$pdf->SetFont('Arial','',10);
				$pdf->AddPage('L', 'Legal');
				$pdf->BasicTable($header,$data);
				$fila=mysqli_fetch_row(mysqli_query($link,"select count(persona.pers_idpersona) FROM persona"));
				$pdf->Cell(5,10,'fecha del reporte:'.date("Y/m/d"),0);
				$pdf->Cell(5,20,'cantidad registros:'.$fila[0],0);
				
				/*
				$pdf->BasicTable($header,$data);
				$pdf->AddPage();
				$pdf->ImprovedTable($header,$data);
				$pdf->AddPage();
				$pdf->FancyTable($header,$data);
				*/
				$pdf->Output();
	
			}
		
		}
	}
	if($opcion=="periferico")
	{
		echo "3";
		$llamadoPersonas = "select equipo.EQ_SERIEEQUIPO,
tipo.TIP_NBTIPO,periferico.PER_MARCAPERIFERICO,periferico.PER_MODELO,
periferico.PER_SERIEPERIFERICO
FROM
equipo,tipo,periferico
where
equipo.EQ_IDEQUIPO = periferico.EQ_IDEQUIPO
AND
tipo.TIP_IDTIPO = periferico.TIP_IDTIPO
ORDER BY
periferico.PER_IDPERIFERICO ASC";
		$recurso = mysqli_query($link,$llamadoPersonas);
		if($recurso!=NULL)
		{
			
			
			$archivo = "";
			if(!($archivo=fopen("perifericos.txt","w+")))
			{
				die("error en sistema");
			}
			else
			{
				while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
				{
					fwrite($archivo,$fila[0].";".$fila[1].";".$fila[2].";".$fila[3].";".$fila[4].PHP_EOL);	
					//echo $fila[0].";".$fila[1].";".$fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].PHP_EOL;
				}
				fclose($archivo);
				
				//mysqli_free_result($recurso);
				//mysqli_close($link);
				$header = array("SERIE","TIPO","MARCA",'MODELO',"SERIE");
				$data = array();
				ob_start();
				$pdf = new PDF();
				$data = $pdf->LoadData('perifericos.txt');
				$pdf->SetFont('Arial','',10);
				$pdf->AddPage('P', 'Legal');
				$pdf->BasicTable($header,$data);
				$fila=mysqli_fetch_row(mysqli_query($link,"select count(periferico.PER_IDPERIFERICO) FROM periferico"));
				$pdf->Cell(5,10,'fecha del reporte:'.date("Y/m/d"),0);
				$pdf->Cell(5,20,'cantidad registros:'.$fila[0],0);
				
				/*
				$pdf->BasicTable($header,$data);
				$pdf->AddPage();
				$pdf->ImprovedTable($header,$data);
				$pdf->AddPage();
				$pdf->FancyTable($header,$data);
				*/
				$pdf->Output();
	
			}
		
		}	
	}
	if($opcion=="ubicacion")
	{
		echo "3";
		$llamadoPersonas = "select * from ubicacion";
		$recurso = mysqli_query($link,$llamadoPersonas);
		if($recurso!=NULL)
		{
			
			
			$archivo = "";
			if(!($archivo=fopen("ubicacion.txt","w+")))
			{
				die("error en sistema");
			}
			else
			{
				while($fila=mysqli_fetch_array($recurso,MYSQLI_NUM))
				{
					fwrite($archivo,$fila[0].";".$fila[1].";".$fila[2].",piso;".$fila[3].PHP_EOL);	
					//echo $fila[0].";".$fila[1].";".$fila[2].";".$fila[3].";".$fila[4].";".$fila[5].";".$fila[6].PHP_EOL;
				}
				fclose($archivo);
				
				//mysqli_free_result($recurso);
				//mysqli_close($link);
				$header = array("CODIGO","NRO.SALA","PISO",'TIPO');
				$data = array();
				ob_start();
				$pdf = new PDF();
				$data = $pdf->LoadData('ubicacion.txt');
				$pdf->SetFont('Arial','',10);
				$pdf->AddPage('P', 'Legal');
				$pdf->BasicTable($header,$data);
				$fila=mysqli_fetch_row(mysqli_query($link,"select count(ubicacion.UB_IDUBICACION) FROM ubicacion"));
				$pdf->Cell(5,10,'fecha del reporte:'.date("Y/m/d"),0);
				$pdf->Cell(5,20,'cantidad registros:'.$fila[0],0);
				
				/*
				$pdf->BasicTable($header,$data);
				$pdf->AddPage();
				$pdf->ImprovedTable($header,$data);
				$pdf->AddPage();
				$pdf->FancyTable($header,$data);
				*/
				$pdf->Output();
	
			}
		
		}		
	}
}
?>