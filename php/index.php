<?php

session_start();


	if(!isset($_SESSION['nick'])){

	echo "<meta http-equiv='Refresh' content='1;url=../index.php'>";
	die;

	}else{


	echo "<meta http-equiv='Refresh' content='1;url=./main.php'>";

	}


?>









