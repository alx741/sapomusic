<?php

session_start();


	if(!isset($_SESSION['nick'])){

	echo "<meta http-equiv='Refresh' content='1;url=../index.php'>";
	die;

	}

$nick = $_SESSION['nick'];

$nick_remoto = $_GET['nick'];


include("./lib.php");

$datos = OBTENER_DATOS($nick);

//Datos

$nombre = $datos[0];
$apellido = $datos[1];
$sexo = $datos[2];

//Datos

$datos_remoto = OBTENER_DATOS($nick_remoto);


//Datos_remoto

$nombre_remoto = $datos_remoto[0];
$apellido_remoto = $datos_remoto[1];
$sexo_remoto = $datos_remoto[2];

//Datos_remoto


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

	background-image: url("../fondos/<?php echo "$nick_remoto.jpg"; ?>");
	background-attachment: fixed;

}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sapo Music -- <?php echo "$nombre_remoto $apellido_remoto"; ?></title>
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





<table border=0 width=100% CELLSPACING=20>

<tr>

	<td align="center" width=25% VALIGN=top> 

		<table  border=2 BACKGROUND="../img/fondo_panel_main.png">
		
		<tr><td align="center"> <br><?php echo '<IMG SRC="../fotos/'.$nick_remoto.'.jpg" ALT="Foto" BORDER=0 WIDTH=150 HEIGTH=180>'; ?> <br><br><b><?php echo "$nombre_remoto $apellido_remoto"; ?></b><br><br></td></tr>


































		<tr><td> 










<center><table width="200" height="286" border="2" bordercolor="#000000" BACKGROUND="../img/fondo_panel.png" fgcolor="#000000">



  <tr>
    <td height="20" align="center">
      <IMG SRC="../img/fama.gif" ALT="Estrellas" BORDER=0 WIDTH=30 HEIGTH=30><b>Estrellas de <?php echo "$nombre_remoto  $apellido_remoto"; ?></b>
    </td>
  </tr>

  <tr>
    <td align="center"><br><?php LISTAR_ESTRELLAS($nick_remoto) ?></td>
  </tr>
</table>  





</td></tr>


















		</table>
	

















	</td>


	<td align="center" VALIGN=top>

		<table border=0 width=50% BACKGROUND="../img/fondo_pizarra.png" class="pizarra">

	<tr>

		<td align="center" VALIGN=top> 

			<IMG SRC="../img/comment.gif" ALT="Pizarra" BORDER=0 WIDTH=50 HEIGTH=50 align="center">

		</td>

		<td align="center" VALIGN=center>

			<h1>PIZARRA</h1><br>

		</td>

	</tr>

	</table>



<table border=0 BACKGROUND="../img/fondo_pizarra.png" class="pizarra">

<tr>

<td>

<form action="./escribir_public.php" method="POST" name="escribir">

<TEXTAREA NAME="texto" ROWS=1 COLS=50 ></TEXTAREA>
<?php echo '<input name="remoto" type="hidden" value="'.$nick_remoto.'">'; ?>
<?php echo '<INPUT TYPE="SUBMIT" VALUE="Escribir en la Pizarra de '.$nombre_remoto.' '.$apellido_remoto.' >>">'; ?>

</form>

</td>
</tr>
</table>






<?php IMPRIMIR_PIZARRA($nick_remoto); ?>

	</td>

</tr>

</table>
			


<script type="text/javascript" src="js/chat.js"></script>




</body>
</html>












