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

$old = $_POST['oldpass'];
$new1 = $_POST['newpass1'];
$new2 = $_POST['newpass2'];





if(!COMPARAR_CLAVE($nick,$old)){

echo "<meta http-equiv='Refresh' content='1;url=./main.php'>";

echo '<SCRIPT LANGUAGE="JavaScript">
alert("Contraseña Incorrecta!! -- Porfavor Intente Nuevamente ");
</SCRIPT>';
die;

}


if($new1!=$new2){

echo "<meta http-equiv='Refresh' content='1;url=./main.php'>";

echo '<SCRIPT LANGUAGE="JavaScript">
alert("Las contraseñas no coinciden!! -- Porfavor Intente Nuevamente ");
</SCRIPT>';
die;

}


CAMBIAR_CONTRASENA($nick,$new1);

echo "<meta http-equiv='Refresh' content='1;url=./main.php'>";

echo '<SCRIPT LANGUAGE="JavaScript">
alert("Contraseña Cambiada con exito");
</SCRIPT>';
die;






?>



</body>
</html>
 
 
