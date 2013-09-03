
<?php

echo '<br><br><br>
<center><IMG SRC="../img/loading.gif" ALT="Cargando" BORDER=0 WIDTH=600 HEIGTH=200 align=center></center><br>
<h1><center>Espere Porfavor....</center></h1>';

include("./lib.php");

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$nick=$_POST['nick'];
$sexo=$_POST['sexo'];
$pass1=$_POST['pass1'];
$pass2=$_POST['pass2'];



$nick = DESECHAR($nick);
$nombre = DESECHAR($nombre);
$apellido = DESECHAR($apellido);


if($nombre=="" || $apellido=="" || $nick=="" || $pass1=="" || $pass2==""){




echo "<meta http-equiv='Refresh' content='1;url=./registrar_1.php'>";
echo '<SCRIPT LANGUAGE="JavaScript">
alert("Todos los datos son obligatorios!");
</SCRIPT>';
die;


}

$total_nick=0;

for($h=0;$h<20;$h++){

	if(isset($nick[$h])){

		$total_nick=($total_nick+1);
	}

}


if($total_nick>10){


echo "<meta http-equiv='Refresh' content='1;url=./registrar_1.php'>";
echo '<SCRIPT LANGUAGE="JavaScript">
alert("El nick no puede contener más de 10 letras, intenta nuevamente");
</SCRIPT>';
die;


}



if($pass1!=$pass2){

echo "<meta http-equiv='Refresh' content='1;url=./registrar_1.php'>";
echo '<SCRIPT LANGUAGE="JavaScript">
alert("Las contraseñas no coinciden, intenta nuevamente");
</SCRIPT>';
die;


}









if(EXISTE_USER($nick)){


echo "<meta http-equiv='Refresh' content='1;url=./registrar_1.php'>";
echo '<SCRIPT LANGUAGE="JavaScript">
alert("Lo siento, pero ese nick ya existe en sapomusic, porfavor usa otro");
</SCRIPT>';
die;


}




NUEVO_USER($nick,$nombre,$apellido,$sexo,$pass1);


echo '<SCRIPT LANGUAGE="JavaScript">
alert("Ha sido Registrad@ con exito, ya puede acceder a su cuenta SapoMusic! :-)");
</SCRIPT>';

echo '<SCRIPT LANGUAGE="JavaScript">
alert("Su Nick es: '.$nick.' , y su contraseña es: ******** (oculta)");
</SCRIPT>';

echo "<meta http-equiv='Refresh' content='1;url=../index.php'>";


?>
