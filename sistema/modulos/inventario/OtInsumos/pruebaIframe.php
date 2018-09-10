<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
function ventana(locacion,ancho,alto)
{
var posicion_x; 
var posicion_y; 
var posicion_x = (screen.width / 2)-(ancho/2); 
var posicion_y = (screen.height / 2)-(alto/2); 
window.open(locacion,"escoger item", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<form action="" name="">
<iframe frameborder="1" src="mostrarLista.php" id="iframex" height="350" width="600">

</iframe>
<input type="button" name="click" value="abrir" onclick="ventana('ventana.php','300','300');" />
</form>
</body>
</html>