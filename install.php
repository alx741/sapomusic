<?php


include("./php/config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 


mysql_query("CREATE TABLE conect(nick varchar(10),conect int)",$conexion_mysql);  // creamos tabla para conect



mysql_query("CREATE TABLE musica(nombre varchar(100),nick varchar(10))",$conexion_mysql);  // creamos tabla para musica



mysql_query("CREATE TABLE datos(nick varchar(10),nombre varchar(50),apellido varchar(50),sexo varchar(10),estrellas int,contrasena varchar(50))",$conexion_mysql);  // creamos tabla para datos





mysql_query("CREATE TABLE `chat` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `from` VARCHAR(255) NOT NULL DEFAULT '',
  `to` VARCHAR(255) NOT NULL DEFAULT '',

  `message` TEXT NOT NULL,
  `sent` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` INTEGER UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
)
ENGINE = InnoDB",$conexion_mysql);  // creamos tabla para datos




echo "<h1><center><b>SAPO MUSIC INSTALADO CON EXITO (posiblemente.. :$ )</h1></center></b><br><br>";

echo "<center>porfavor remover el script install.php</center>";





?>
