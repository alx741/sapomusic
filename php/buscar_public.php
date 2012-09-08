<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sapo Music -- Buscar Musica</title>
<LINK REL="SHORTCUT ICON" HREF="../img/icono.ico">

<link rel="stylesheet" type="text/css" href="../css/main.css" />

<style type="text/css">
body{

	background-image: url("../img/fondo.png");
	background-attachment: fixed;

}
</style>


</head>





<body BGCOLOR="#aaff44"  TEXT="#000000" >

<IMG SRC="../img/top_bar.png" ALT="SapoMusic" BORDER=0 WIDTH=300 HEIGTH=300 class="topbar">

<IMG SRC="../img/sapo.gif" ALT="SapoMusic" BORDER=0 WIDTH=300 HEIGTH=300 class="sapo">

<?php $num=rand(1,20); echo '  <IMG SRC="../img/logos/'.$num.'.png" ALT="SapoMusic" BORDER=0 WIDTH=500 HEIGTH=300 class="logo">'; ?>
<br><br><br><p><br><p><br>


<?php

include("./lib.php");

$texto=$_GET['texto'];


if($texto=="*"){

OBTENER_LISTA_MUSICA_PUBLIC();

}else{

OBTENER_LISTA_MUSICA_BUSCAR_PUBLIC($texto);

}

?>

