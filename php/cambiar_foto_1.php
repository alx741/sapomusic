<?php

session_start();


	if(!isset($_SESSION['nick'])){

	echo "<meta http-equiv='Refresh' content='1;url=../index.php'>";
	die;

	}

$nick = $_SESSION['nick'];


include("./lib.php");

$datos = OBTENER_DATOS($nick);

//Datos

$nombre = $datos[0];
$apellido = $datos[1];
$sexo = $datos[2];

//Datos


?>

<html>
<head>
<style type="text/css">

.pizarra {
	color: white;
}

.pizarra_link {
	color: white;
	text-decoration: underline;
}

body{

	background-image: url("../fondos/<?php echo "$nick.jpg"; ?>");
	background-attachment: fixed;

}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sapo Music -- <?php echo "$nombre $apellido"; ?></title>
<LINK REL="SHORTCUT ICON" HREF="../img/icono.ico">
</head>
<body BGCOLOR="#aaff44"  TEXT="#000000" >

<script type="text/javascript" src="./jquery.js"></script>
<script type="text/javascript"> 
$(document).ready(function() 
{
	$("span.options").hide();
	$("a.title").click(function() 
	{
		$(this).children("img").toggle();
		$(this).next().next("span").slideToggle("fast");
		return false; 
	});
}); 
</script>



<table border=0 width=100% BACKGROUND="../img/fondo_top_bar.png">
<tr>
	<td align="center"> <IMG SRC="../img/sapo.gif" ALT="SapoMusic" BORDER=0 WIDTH=100 HEIGTH=90> </td>
	
	<td align="left"> <?php $num=rand(1,20); echo '<IMG SRC="../img/logos/'.$num.'.png" ALT="SapoMusic" BORDER=0 WIDTH=300 HEIGTH=100>'; ?> </td>

	<td align="center"> <?php echo "$nombre $apellido"; ?> </td>

	<td align="center"> <a href="./main.php" target="_self"><?php echo '<IMG SRC="../fotos/'.$nick.'.jpg" ALT="Foto" BORDER=1 WIDTH=60 HEIGTH=50>'; ?></a> </td>

	<td align="center"> <a href="./main.php" target="_self"><input type="submit" value="Perfil"></a><br><br><a href="./cerrar.php" target="_self"><input type="submit" value="Salir"></a> </td>


</tr>

</table><br><br>

<center><br><br>

<table border=1 BACKGROUND="../img/fondo_panel_main.png">

<tr><td>
<br>
<form name="enviador" method="post" action="./cambiar_foto_2.php" enctype="multipart/form-data">

Archivo JPG: 
<input type="file" name="upfile">
<input type="submit" value="Cargar">
</form> 

</td></tr>

</table>


</center>



</body>
</html>

