<?php

session_start();


	if(!isset($_SESSION['nick'])){

	echo "<meta http-equiv='Refresh' content='1;url=../index.php'>";
	die;

	}

$nick = $_SESSION['nick'];


?>

<br><br><br>
<center><IMG SRC="../img/loading.gif" ALT="Cargando" BORDER=0 WIDTH=600 HEIGTH=200 align=center></center><br>
<h1><center>Espere Porfavor....</center></h1>

<?php

include("./lib.php");

DESCONECTADO($nick);

session_destroy();

	echo "<meta http-equiv='Refresh' content='1;url=../index.php'>";

?>
