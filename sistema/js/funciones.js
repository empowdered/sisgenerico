// JavaScript Document
function fondo_sobre(id,id2){
	document.getElementById(id).style.backgroundColor="#6C91FF";
	document.getElementById(id).style.opacity="0.6";
	document.getElementById("mensaje").style.visibility = "visible";
	colocarinfo(id);
}
function fondo_fuera(id,id2){
	document.getElementById(id).style.backgroundColor="transparent";
	document.getElementById(id).style.opacity="1.0";
	document.getElementById("mensaje").innerHTML ="";
	document.getElementById("mensaje").style.visibility = "hidden";
}
//******************************************
function colocarinfo(opcion)
{
	infomensaje = document.getElementById("mensaje");
	switch(opcion)
	{
		case 'item_menu1': infomensaje.innerHTML ="Es el inicio, esta opcion, permite subir los archivos excel para analisis";
								break;
		case 'item_menu2': infomensaje.innerHTML ="Esto es el analizador de los excel, arroja informacion junto con graficos";
								break;
		case 'item_menu3': infomensaje.innerHTML ="Esta opcion, permite setear las reglas, como la nota minima, la nota maxima. Etc.";
								break;
		case 'item_menu4': infomensaje.innerHTML ="Es el inicio del modulo inventario, con ello puede gestionar la informacion del inventario";
								break;
		case 'item_menu5':infomensaje.innerHTML ="Esta opcion, le permitira crear una Orden de Trabajo, y agregarle insumos para su reparacion";
								break;
		case 'item_menu6': infomensaje.innerHTML ="Esta opcion nos entregara detalles, a un excel, o un pdf, ya sea la opcion de reporte escogido";
								break;
	}
}