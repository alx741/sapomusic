	
<?php

session_start();

if(isset($_SESSION['nick'])){

echo "<meta http-equiv='Refresh' content='1;url=./php/main.php'>";
die;

}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sapo Music</title>
<LINK REL="SHORTCUT ICON" HREF="./img/icono.ico">

<link rel="stylesheet" type="text/css" href="./css/main.css" />

</head>





<body BGCOLOR="#aaff44"  TEXT="#000000" class="bodymain">

<IMG SRC="./img/top_bar.png" ALT="SapoMusic" BORDER=0 WIDTH=300 HEIGTH=300 class="topbar">

<IMG SRC="./img/sapo.gif" ALT="SapoMusic" BORDER=0 WIDTH=300 HEIGTH=300 class="sapo">

<?php $num=rand(1,20); echo '  <IMG SRC="./img/logos/'.$num.'.png" ALT="SapoMusic" BORDER=0 WIDTH=500 HEIGTH=300 class="logo">'; ?>



<IMG SRC="./img/login.gif" ALT="Login" BORDER=0 class="imglogin">

<form action="./php/login.php" method="POST" name="login" class="login">
Nick: <input name="user" type="text" id="user" > <br>  Contrase&ntilde;a:  <input name="pass" type="password" id="pass" >
  <input type="submit" name="submit" value="Entrar" >
</form>


<div class="registrar">No tienes una cuenta <b> SapoMusic</b>???<a href="./php/registrar_1.php" target="_self">  Registrate AQUI </a></div>


<div class="buscar">


<form action="./php/buscar_public.php" method="GET" name="formulario" class="Estilo4">
  <div align="center">
<h2>Buscar Musica:</h2><br>
<b>Nota: </b> Para listar toda la musica usar un *<br>Usar busquedas de una sola palabra<br>para obtener mejores resultados  <br> 
<br><input name="texto" type="text" id="texto" > <br>
<br>
  <input type="submit" name="submit" value="Buscar" >
  </div>
</form>


<div class="intro">

<b>Sapo Music</b> es una red de usuarios util para compartir<br>
musica, entre la comunidad <b>Sapo Music</b>, puedes <i>subir</i>,<br>
<i>Escuchar</i>, y <i>Descargar</i> Musica, podras dar y recibir estrellas<br>
entre los demas usuarios de <b>Sapo Music</b>, consige estrellas, <br>
trofeos y ganate un buen lugar en el mural de la FAMA.

</div>




</body>
</html>
