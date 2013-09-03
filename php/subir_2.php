
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


<?php

echo '<br><br><br>
<center><IMG SRC="../img/loading.gif" ALT="Cargando" BORDER=0 WIDTH=600 HEIGTH=200 align=center></center><br>
<h1><center>Espere Porfavor....</center></h1>';

$filename = ($_FILES['upfile']['name']);

$vector_comprobacion=explode(".",$filename);

$comprobacion=strtolower($vector_comprobacion[1]);

if($vector_comprobacion[1]!="mp3"){

echo "<meta http-equiv='Refresh' content='1;url=./main.php'>";
echo '<SCRIPT LANGUAGE="JavaScript">
alert("Solo archivos de tipo  MP3  !!");
</SCRIPT>';
die();

}




$titulo=$_POST['titulo'];
$artista=$_POST['artista'];


$nombre=GENERAR_NOMBRE($titulo,$artista);


if(EXISTE_MUSICA($nombre)){

	echo "<meta http-equiv='Refresh' content='1;url=./main.php'>";
	echo '<SCRIPT LANGUAGE="JavaScript">
	alert("Lo siento, esa Canción ya existe en SapoMusic");
	</SCRIPT>';
	die();

}







$uploaddir = "../musica/";


$uploadfile = $uploaddir . $filename;

if(move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile)) {







copy("../musica/$filename","../musica/$nombre");
unlink("../musica/$filename");



echo "<meta http-equiv='Refresh' content='1;url=./main.php'>";
echo '<SCRIPT LANGUAGE="JavaScript">
alert("La Canción está siendo Subida con Exito....");
</SCRIPT>';

SUBIR_DB($nick,$titulo,$artista);

include("./config.php");

DAR_ESTRELLAS("sapomusic",$nick,$estrellas_subida);

///implotar el nombre de la cancion

$espacio = chr(32);


$quitar_mp3= explode(".",$nombre);

	$autor = OBTENER_AUTOR($nombre);

	$sin_mp3=$quitar_mp3[0];

	$vector_primario = explode("-",$sin_mp3);

	$titulo_pre=$vector_primario[0];

	$artista_pre=$vector_primario[1];

	$vector_titulo=explode("_",$titulo_pre);

	$vector_artista=explode("_",$artista_pre);

	$titulo_show= implode($espacio,$vector_titulo);

	$artista_show= implode($espacio,$vector_artista);


///implotar el nombre de la cancion




$texto = 'Ha subido una Nueva Canci&oacute;n: <a href="./buscar.php?texto='.$nombre.'" target="_self" class="pizarra_link"> '.$titulo_show.' de '.$artista_show.'</a>';


ESCRIBIR_PIZARRA_TODAS($nick,$texto);





die();



} else {
echo "<meta http-equiv='Refresh' content='1;url=./main.php'>";
echo '<SCRIPT LANGUAGE="JavaScript">
alert("Error al subir la Canción, porfavor intente nuevamente");
</SCRIPT>';
die();
}


?>



</body>
</html>
 
 
