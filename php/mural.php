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



<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
</head>
<body BGCOLOR="#aaff44"  TEXT="#000000" >

<script type="text/javascript" src="js/jquery.js"></script>
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






<?php



$nicks=OBTENER_NICKS();

$total_nicks=TOTAL_ARRAY($nicks);

for($i=0;$i<$total_nicks;$i++){


$datos=OBTENER_DATOS($nicks[$i]);


$nick=$nicks[$i];

$nombre=$datos[0];

$apellido=$datos[1];
$estrellas=$datos[3];
$foto="../fotos/$nick.jpg";

$dibujar_trofeos="";
$trofeos=0;



if($estrellas<50){
$trofeos=0;
}elseif($estrellas<100){
$trofeos=1;
}elseif($estrellas<150){
$trofeos=2;
}elseif($estrellas<200){
$trofeos=3;
}elseif($estrellas<150){
$trofeos=4;
}elseif($estrellas<200){
$trofeos=5;
}elseif($estrellas<250){
$trofeos=6;
}elseif($estrellas<300){
$trofeos=7;
}elseif($estrellas<350){
$trofeos=8;
}elseif($estrellas<400){
$trofeos=9;
}elseif($estrellas<500){
$trofeos=10;
}else{
$trofeos=10;
}

for($j=0;$j<$trofeos;$j++){

$dibujar_trofeos=$dibujar_trofeos.'   <IMG SRC="../img/trofeo.gif" ALT="Trofeo" BORDER=0 WIDTH=30 HEIGTH=50 align=bottom>   ';

}


echo '<table border="3" WIDTH="100%" BACKGROUND="../img/fondo_panel_main.png">

	<tr>
	
	<td align="left" WIDTH="40%">
		<a href="./public.php?nick='.$nick.'" target="_self"><IMG SRC="../fotos/'.$nick.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 			HEIGTH=60 align=center><b> '.$nombre.' '. $apellido.'</b> </a>
	</td>

	<td align="center" WIDTH="10%">

		<IMG SRC="../img/star.gif" ALT="Estrellas" BORDER=0 WIDTH=20 HEIGTH=20 align=center><br><br><b>'.$estrellas.'</b>
	</td>

	<td align="center">
		
		'.$dibujar_trofeos.'

	</td>

	</tr>

</table><br><br>';


}

?>


<script type="text/javascript" src="js/chat.js"></script>




</body>
</html>
			




