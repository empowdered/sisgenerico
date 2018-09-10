<?php
session_name("items");
session_start();
$id="";
if(isset($_GET["id"]) && $_GET["id"]!="")$id=$_GET["id"];

if($id!="")
{
	restar($id);
	header("Location:mostrarLista.php");	
}

/*
for($i=0;$i<10;$i++)$_SESSION["sesion" . $i] = $i;
for($i=0;$i<10;$i++)echo $_SESSION["sesion" . $i];

$_SESSION["item"][0] = array(1,2,3,4,5);
$_SESSION["item"][1] = array('Q111','w333','e','r','t','y');

print_r($_SESSION["item"][0]);
print_r($_SESSION["item"][1]);
echo "<br>".$_SESSION["item"][0][0] ."<br>";
echo $_SESSION["item"][0][1] ."<br>";
echo $_SESSION["item"][0][2] ."<br>";
echo $_SESSION["item"][0][3] ."<br>";
echo $_SESSION["item"][0][4] ."<br>";

echo "<br>".$_SESSION["item"][1][0] ."<br>";
echo $_SESSION["item"][1][1] ."<br>";
echo $_SESSION["item"][1][2] ."<br>";
echo $_SESSION["item"][1][3] ."<br>";
echo $_SESSION["item"][1][4] ."<br>";
echo $_SESSION["item"][1][5] ."<br>";
*/
if(!isset($_SESSION["cantidad"]))
{
	iniciarVariable();
}
function iniciarVariable()
{
	$_SESSION["cantidad"] = 0;
}
function devuelveItem()
{
for($i=0;$i<$_SESSION["cantidad"];$i++){
return $_SESSION["item"][$i][0];
}
}
//
function agregar($id,$nb,$cost,$cant)
{
$_SESSION["item"][$_SESSION["cantidad"]] = array($id,$nb,$cost,$cant);
$_SESSION["cantidad"] = $_SESSION["cantidad"] + 1;
}
//
function restar($id)
{
$_SESSION["item"][$id][0] = 0;	
}
function mostrar()
{
if($_SESSION["cantidad"]==0)
{
echo "<center>Listado vacio...</center>";
}
else
{
echo "<hr>";
echo '<div class="" id="despliegue">';
echo "<table align='center' class='table-hover' id='sesion' border='1' width='600'>";
echo "<th colspan='5' style='text-align:center;' >detalle materiales requeridos</th>";
echo "<tr><td style='text-align:center;'>codigo</td><td style='text-align:center;'>item</td><td style='text-align:center;'>costo referencia</td><td style='text-align:center;'>cantidad solicitada</td>
	<td style='text-align:center;'>eliminar</td>
	</tr>";
for($i=0;$i<$_SESSION["cantidad"];$i++)
{
echo "<tr>";
for($f=0;$f<4;$f++)
{
if($_SESSION["item"][$i][0]!=0)
{
if($f!=2 && $f!=3)echo "<td style='text-align:center;'>".$_SESSION["item"][$i][$f]."</td>";
else echo "<td style='text-align:center;'>".$_SESSION["item"][$i][$f]."</td>";
}
}
if($_SESSION["item"][$i][0]!=0)echo '<td style="text-align:center;">
<input type="radio" name="op" value="$i" onclick=javascript:borrar('.$i.');>
</td>';
echo "</tr>";
}
echo "</table>";
echo "</div>";
}
}//fin else
?>
<link rel="stylesheet" href="../bootstrap-3.3.4/css/bootstrap.min.css">
<script type="text/javascript" src="../bootstrap-3.3.4/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../bootstrap-3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript">
function borrar(id)
{
	//alert("hola: " + id);
	if(confirm("Desea eliminarlo de la lista ¿?"))window.location="funciones.php?id="+id;
}
</script>
<style type="text/css">
#sesion{ font-size:12px; text-align:center;font-family:Verdana, Geneva, sans-serif;}
/*
#despliegue{overflow-y: auto;}
*/
</style>