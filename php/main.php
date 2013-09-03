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

$_SESSION['username'] = ''.$nombre.'_'.$apellido.'';


CONECTADO($nick); // stoy conectado


?>

<html>
<head>


<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />



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





<table border=0 width=100% CELLSPACING=20 >

<tr>

	<td align="center" width=25% VALIGN=top> 

		<table  border=2 BACKGROUND="../img/fondo_panel_main.png">
		
		<tr><td align="center"> <br><?php echo '<IMG SRC="../fotos/'.$nick.'.jpg" ALT="Foto" BORDER=0 WIDTH=150 HEIGTH=180>'; ?> <br><br><b><?php echo "$nombre $apellido"; ?></b><br><br></td></tr>








		<tr><td> 





<a href="#" class="title"><img src="../img/triright.gif" class="tri" border=0><img src="../img/tridown.gif" style="display:none; border: none" class="tri"><IMG SRC="../img/admin.gif" ALT="Administracion" BORDER=0 WIDTH=30 HEIGTH=30 class="tri">Panel de Administraci&oacute;n</a><br />
<span class="options"><br><br>






<center><table width="200" height="286" border="2" bordercolor="#000000" BACKGROUND="../img/fondo_panel.png" fgcolor="#000000">



  <tr>
    <td height="74"><div align="center" >
      <div align="center"><IMG SRC="../img/admin.gif" ALT="Administracion" BORDER=0 WIDTH=30 HEIGTH=30><b>PANEL DE ADMINISTRACI&Oacute;N </b></div>
    </div></td>
  </tr>
  <tr>
    <td height="53"><div align="center"><a href="./cambiar_fondo_1.php">Cambiar Imagen de fondo</a></div>
    <div align="center"></div></td>
  <tr>
  <tr>
    <td height="53"><div align="center"><a href="./cambiar_foto_1.php">Cambiar Imagen de Usuario (foto)</a></div>
    <div align="center"></div></td>
  <tr>
    <td height="49"><div align="center"><a href="./cambiar_contrasena_1.php">Cambiar la Contrase&ntilde;a</a></div>
    <div align="center"></div></td>
  </tr>
  <tr>
    <td height="53"><div align="center"><a href="./subir_1.php"><IMG SRC="../img/up.gif" ALT="Subir" BORDER=0 WIDTH=30 HEIGTH=30>Subir Una canci&oacute;n</a></div></tr></table> 






</td></tr>



























		<tr><td> 





<a href="#" class="title"><img src="../img/triright.gif" class="tri" border=0><img src="../img/tridown.gif" style="display:none; border: none" class="tri"><IMG SRC="../img/fama.gif" ALT="Estrellas" BORDER=0 WIDTH=30 HEIGTH=30 class="tri">Mis Estrellas</a><br />
<span class="options"><br><br>




<center><table width="200" height="286" border="2" bordercolor="#000000" BACKGROUND="../img/fondo_panel.png" fgcolor="#000000">



  <tr>
    <td height="20" align="center">
      <IMG SRC="../img/fama.gif" ALT="Estrellas" BORDER=0 WIDTH=30 HEIGTH=30><b>MIS ESTRELLAS</b>
    </td>
  </tr>

  <tr>
    <td align="center"><br><?php LISTAR_ESTRELLAS($nick) ?></td>
  </tr>
</table>  





</td></tr>











































		<tr><td> 






<a href="#" class="title"><img src="../img/triright.gif" class="tri" border=0><img src="../img/tridown.gif" style="display:none; border: none" class="tri"><IMG SRC="../img/music.gif" ALT="Musica" BORDER=0 WIDTH=30 HEIGTH=30 class="tri"><b>Musica</b></a><br />
<span class="options"><br><br>




<center><table width="200" height="286" border="2" bordercolor="#000000" BACKGROUND="../img/fondo_panel.png" fgcolor="#000000">



  <tr>
    <td height="20" align="center">
      <IMG SRC="../img/music.gif" ALT="Estrellas" BORDER=0 WIDTH=30 HEIGTH=30><b>MUSICA</b>
    </td>
  </tr>

  <tr>
    <td align="center"><form action="./buscar.php" method="GET" name="buscar">
  <div align="center">
<b>Importante: </b> Usar una sola palabra para obtener una mejor busqueda.  <br> 
<b>Nota: </b> Para listar toda la musica usar un *  <br><input name="texto" type="text" id="texto" >
<br><br>
  <input type="submit" name="submit" value="Buscar" >
  </div>
</form></div></td>
  </tr>
</table>









</td></tr>























		<tr><td> 





<a href="./mural.php" target="_self"><IMG SRC="../img/people.gif" ALT="Fama" BORDER=0 WIDTH=30 HEIGTH=30 class="tri"> Mural de la Fama </a>












</td></tr>








<tr><td> 





<a href="#" class="title"><img src="../img/triright.gif" class="tri" border=0><img src="../img/tridown.gif" style="display:none; border: none" class="tri"><IMG SRC="../img/chat.gif" ALT="Estrellas" BORDER=0 WIDTH=30 HEIGTH=30 class="tri">CHAT</a><br />
<span class="options"><br><br>




<center><table width="200" height="286" border="2" bordercolor="#000000" BACKGROUND="../img/fondo_panel.png" fgcolor="#000000">



  <tr>
    <td height="20" align="center">
      <IMG SRC="../img/chat.gif" ALT="Estrellas" BORDER=0 WIDTH=30 HEIGTH=30><b>CHAT</b>
    </td>
  </tr>

  <tr>
    <td align="center"><br><?php LISTAR_CHAT($nick) ?></td>
  </tr>

  <tr>

<td <a href="./main.php" target="_self"><IMG SRC="../img/refresh.gif" ALT="Refresh" BORDER=0 WIDTH=15 HEIGTH=15 >Recargar Lista</a> </td>

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

<form action="./escribir.php" method="POST" name="escribir">

<TEXTAREA NAME="texto" ROWS=1 COLS=50 ></TEXTAREA>

<INPUT TYPE="SUBMIT" VALUE="Escribir en mi Pizarra >>">

</form>

</td>
</tr>
</table>





<?php IMPRIMIR_PIZARRA($nick); ?>

	</td>

</tr>

</table>
			



<script type="text/javascript" src="js/chat.js"></script>




</body>
</html>











