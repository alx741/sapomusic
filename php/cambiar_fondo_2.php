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
<br><br><br>
<center><IMG SRC="../img/loading.gif" ALT="Cargando" BORDER=0 WIDTH=600 HEIGTH=200 align=center></center><br>
<h1><center>Espere Porfavor....</center></h1>

<?php




$uploaddir = "../fondos/";
$filename = ($_FILES['upfile']['name']);
$uploadfile = $uploaddir . $filename;
if (move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile)) {

unlink("../fondos/$nick.jpg");
copy("../fondos/$filename","../fondos/$nick.jpg");


unlink("../fondos/$filename");

echo "<meta http-equiv='Refresh' content='1;url=./main.php'>";

} else {
echo "<h1><center><b>Error al subir el fondo, intente nuevamente</b></center></h1>";

echo "<br><br>";

echo "<center><h3><b><a href='./main.php'>Regresar</a></b></h3></center>";
}



?>



</body>
</html>
 
 
