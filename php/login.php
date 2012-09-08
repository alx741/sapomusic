<?php

$usuario=$_POST['user'];
$password=$_POST['pass'];

$nick = $usuario;

$nick = trim($nick);

$nick = strtolower($nick);





$pass = $password;

$pass = trim($pass);

$pass = strtolower($pass);


include("./lib.php");






if(EXISTE_USER($nick)){

	if(COMPARAR_CLAVE($nick,$pass)){

		echo '<br><br><br>
		<center><IMG SRC="../img/loading.gif" ALT="Cargando" BORDER=0 WIDTH=600 HEIGTH=200 align=center></center><br>
		<h1><center>Espere Porfavor....</center></h1>';

		echo "<meta http-equiv='Refresh' content='1;url=./main.php'>";
		session_start();
		$_SESSION['nick']=$nick;
		die;

	}else{

		echo '<SCRIPT LANGUAGE="JavaScript">
		alert("Usuario O Contraseña Incorrectos!! -- Porfavor Intente Nuevamente ");
		</SCRIPT>';

		echo "<meta http-equiv='Refresh' content='1;url=../index.php'>";
		die;
	}

}else{

echo '<SCRIPT LANGUAGE="JavaScript">
alert("Usuario O Contraseña Incorrectos!! -- Porfavor Intente Nuevamente ");
</SCRIPT>';

echo "<meta http-equiv='Refresh' content='1;url=../index.php'>";
die;

}





?>







