<?php



####################FUNCION OBTENER DATOS#########################

function OBTENER_DATOS($nick)

{

include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

$consulta = "SELECT nombre FROM datos where nick = '$nick'" ; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$nombre = mysql_result($query,0,0);  // elaboramos la consulta




$datos[]=$nombre; //almacenamos en el array




$consulta = "SELECT apellido FROM datos where nick = '$nick'" ; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$apellido = mysql_result($query,0,0);  // elaboramos la consulta




$datos[]=$apellido; //almacenamos en el array





$consulta = "SELECT sexo FROM datos where nick = '$nick'" ; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$sexo = mysql_result($query,0,0);  // elaboramos la consulta




$datos[]=$sexo; //almacenamos en el array





$consulta = "SELECT estrellas FROM datos where nick = '$nick'" ; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$estrellas = mysql_result($query,0,0);  // elaboramos la consulta


$datos[]=$estrellas; //almacenamos en el array




$consulta = "SELECT contrasena FROM datos where nick = '$nick'" ; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$contrasena = mysql_result($query,0,0);  // elaboramos la consulta




$datos[]=$contrasena; //almacenamos en el array









return($datos);   // devolvemos el array con los datos



 

}


####################FIN FUNCION OBTENER DATOS#########################


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

####################FUNCION TOTAL ARRAY#########################

function TOTAL_ARRAY($array)

{

$i=0;

$cont=0;

while(isset($array[$i])){

$cont=$cont+1;
$i=$i+1;

}

return($cont);


}


####################FIN FUNCION TOTAL ARRAY#########################


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


####################FUNCION OBTENER NICKS#########################

function OBTENER_NICKS()

{



include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

$consulta = "SELECT nick FROM datos"; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$i=0;

while(mysql_result($query,$i,0)){

$array_nicks[]=mysql_result($query,$i,0);

$i=($i+1);

}


return($array_nicks);

}


####################FIN FUNCION OBTENER NICKS#########################

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


####################FUNCION EXISTE USER#########################

function EXISTE_USER($nick)

{



include("./config.php"); // Incluimos la configuracion


$array_nicks=OBTENER_NICKS();




$total = TOTAL_ARRAY($array_nicks);

for($j=0;$j<$total;$j++){

	if($array_nicks[$j]==$nick){
		return(true);
		die;
	}


}

return(false);
die;



}





####################FIN FUNCION EXISTE USER#########################

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////




####################FUNCION NUEVO USER#########################

function NUEVO_USER($nick,$nombre,$apellido,$sexo,$contrasena)

{


$estrellas=0;


$nick=trim(strtolower($nick));
$nombre=trim(strtolower($nombre));
$nombre=ucfirst($nombre);
$apellido=trim(strtolower($apellido));
$apellido=ucfirst($apellido);
$sexo=trim(strtolower($sexo));
$contrasena=trim(strtolower(md5($contrasena)));


include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

mysql_query("INSERT INTO datos VALUES('$nick','$nombre','$apellido','$sexo',$estrellas,'$contrasena')",$conexion_mysql);  // ingresamos

mysql_query("INSERT INTO conect VALUES('$nick',0)",$conexion_mysql);  // ingresamos

mysql_query("CREATE TABLE $nick(nick varchar(10),estrellas int)",$conexion_mysql);  // creamos tabla para el usuario

if(ereg("lino",$sexo)){

	copy("../img/he.gif","../fotos/$nick.jpg");
	copy("../img/fondo_predeterminado.jpg","../fondos/$nick.jpg");
	copy("../pizarras/basica","../pizarras/$nick");

	}else{

	copy("../img/she.gif","../fotos/$nick.jpg");
	copy("../img/fondo_predeterminado.jpg","../fondos/$nick.jpg");
	copy("../pizarras/basica","../pizarras/$nick");

}



}


####################FIN FUNCION NUEVO USER#########################



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////



####################FUNCION DAR_ESTRELLAS#########################

function DAR_ESTRELLAS($nick_from,$nick_to,$estrellas)

{

include("./config.php"); // Incluimos la configuracion


$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 



$consulta = "SELECT nick FROM $nick_to"; // elaboramos la consulta de las tablas existentes

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta de las tablas existentes

$i=0;

$existe="0";

while(mysql_result($query,$i,0)){

$nick=mysql_result($query,$i,0);

$i=($i+1);

if($nick==$nick_from){

$existe="1";

}

	
}


	if($existe=="1"){

	$consulta_estrellas = "SELECT estrellas FROM $nick_to where nick = '$nick_from'"; // elaboramos la consulta de las tablas existentes

	$query_estrellas = mysql_query($consulta_estrellas,$conexion_mysql);  // elaboramos la consulta de las tablas existentes

	$estrellas_old = mysql_result($query_estrellas,0,0);
	
	$estrellas_new = ($estrellas_old + $estrellas);

	mysql_query("UPDATE $nick_to SET estrellas = $estrellas_new where nick = '$nick_from'",$conexion_mysql);  // ingresamos las estrellas



	####sumamos las nuevas estrellas en la tabla datos

	$consulta = "SELECT estrellas FROM datos where nick = '$nick_to'" ; // elaboramos la consulta

	$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

	$estrellas_old_datos = mysql_result($query,0,0);  // elaboramos la consulta


	$estrellas_new_datos = ($estrellas_old_datos + $estrellas);

	mysql_query("UPDATE datos SET estrellas = $estrellas_new_datos where nick = '$nick_to'",$conexion_mysql);  // ingresamos las estrellas
	
	####FIN sumamos las nuevas estrellas en la tabla datos



	}else{

	
	mysql_query("INSERT INTO $nick_to VALUES('$nick_from',$estrellas)",$conexion_mysql);  // ingresamos las estrellas


	####sumamos las nuevas estrellas en la tabla datos

	$consulta = "SELECT estrellas FROM datos where nick = '$nick_to'" ; // elaboramos la consulta

	$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

	$estrellas_old_datos = mysql_result($query,0,0);  // elaboramos la consulta


	$estrellas_new_datos = ($estrellas_old_datos + $estrellas);

	mysql_query("UPDATE datos SET estrellas = $estrellas_new_datos where nick = '$nick_to'",$conexion_mysql);  // ingresamos las estrellas
	
	####FIN sumamos las nuevas estrellas en la tabla datos


	}






}


####################FIN FUNCION DAR_ESTRELLAS#########################




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////




####################FUNCION IMPRIMIR_PIZARRA#########################

function IMPRIMIR_PIZARRA($nick){

include("./config.php");

$descriptor_pizarra=fopen("../pizarras/$nick","r");

echo '<center><table border=10 BACKGROUND="../img/fondo_pizarra.png" WIDTH="90%" HEIGHT="90%" class="pizarra"><td ALIGN=left VALIGN=top>';

$entrada=0;



while($linea=fgets($descriptor_pizarra)){

if(ereg("-----------",$linea)){
	$entrada=($entrada+1);
	if($entrada==$entradas_max){

		die;
	}

}


	if(ereg("<<",$linea)){
		$vector_nick=explode("-",$linea);
		$nick_persona=$vector_nick[1];

	}elseif(ereg(">>",$linea)){
		$vector_linea=explode("-",$linea);
		$espacio=chr(32);
		$linea_lista=implode($espacio,$vector_linea);
			if(trim($nick_persona)=="sapomusic"){
				echo '<IMG SRC="../fotos/sapomusic.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60>
					<b><i><h4>'.$linea_lista.'</h4></i></b>   ';
			}elseif(trim($nick_persona)==trim($nick)){

				echo '<IMG SRC="../fotos/'.$nick.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60>
					<b><i><h4>'.$linea_lista.'</h4></i></b>   ';

			}else{

				echo '<a href="./public.php?nick='.$nick_persona.'" target="_self" class="pizarra_link"><IMG SRC="../fotos/'.$nick_persona.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60>
					<b><i><h4>'.$linea_lista.'</a></h4></i></b>   ';

			}

	}elseif(ereg("-----",$linea)){
		echo "<br><center><b>$linea</b></center><br>";
		
		}else{
		echo "$linea<br>";
	}
}

echo '</td></table></center><A NAME="final"></A>';


fclose($descriptor_pizarra);





}


####################FIN FUNCION IMPRIMIR_PIZARRA#########################



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////




####################FUNCION ESCRIBIR_PIZARRA#########################


function ESCRIBIR_PIZARRA($nick_from,$nick_to,$texto){



$datos_from=OBTENER_DATOS($nick_from);


$descriptor_pizarra_obtener = fopen("../pizarras/$nick_to","r");

while(!feof($descriptor_pizarra_obtener)){

	$pre=fgets($descriptor_pizarra_obtener);

	$pizarra = $pizarra.$pre;

}




$intro_nick="<<-$nick_from";

$intro="$datos_from[0]-$datos_from[1]->>";


$descriptor_pizarra=fopen("../pizarras/$nick_to","w");

fwrite($descriptor_pizarra,trim($intro_nick)."\n");
fwrite($descriptor_pizarra,trim($intro)."\n");

$cont=0;

$val=80;

for($i=0;$i<1000;$i++){

if(isset($texto[$i])){
	
	if($cont==$val){
		fwrite($descriptor_pizarra,"\n");
		$val=($val+80);	$i=($i-1);
	}else{
	

	fwrite($descriptor_pizarra,"$texto[$i]");

	}
$cont=($cont+1);

}else{}

	
}

fwrite($descriptor_pizarra,"\n");
fwrite($descriptor_pizarra,"------------------------------------------------------------\n");
fwrite($descriptor_pizarra,"$pizarra");
fclose($descriptor_pizarra);





}



####################FIN FUNCION ESCRIBIR_PIZARRA#########################



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


####################FUNCION ESCRIBIR_PIZARRA_DESCARGA#########################


function ESCRIBIR_PIZARRA_DESCARGA($nick_from,$nick_to,$texto){



$datos_from=OBTENER_DATOS($nick_from);



$descriptor_pizarra_obtener = fopen("../pizarras/$nick_to","r");

while(!feof($descriptor_pizarra_obtener)){

	$pre=fgets($descriptor_pizarra_obtener);

	$pizarra = $pizarra.$pre;

}



$intro_nick="<<-$nick_from";

$intro="$datos_from[0]-$datos_from[1]->>";


$descriptor_pizarra=fopen("../pizarras/$nick_to","w");
fwrite($descriptor_pizarra,trim($intro_nick)."\n");
fwrite($descriptor_pizarra,trim($intro)."\n");

$cont=0;

$val=80;

for($i=0;$i<1000;$i++){

if(isset($texto[$i])){
	
	if($cont==$val){
		fwrite($descriptor_pizarra,"");
		$val=($val+80);	$i=($i-1);
	}else{
	

	fwrite($descriptor_pizarra,"$texto[$i]");

	}
$cont=($cont+1);

}else{}

	
}

fwrite($descriptor_pizarra,"\n");
fwrite($descriptor_pizarra,"------------------------------------------------------------\n");
fwrite($descriptor_pizarra,"$pizarra");
fclose($descriptor_pizarra);





}



####################FIN FUNCION ESCRIBIR_PIZARRA_DESCARGA#########################



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////




####################FUNCION COMPARAR_CLAVE#########################

function COMPARAR_CLAVE($nick,$contrasena){

$datos=OBTENER_DATOS($nick);

$contrasena=md5($contrasena);

$contrasena_base=$datos[4];

if($contrasena_base==$contrasena){

return(true);

}else{

return(false);

}

}

####################FIN FUNCION COMPARAR_CLAVE#########################



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////



####################FUNCION CAMBIAR_CONTRASENA#########################

function CAMBIAR_CONTRASENA($nick,$contrasena){

$contrasena=md5($contrasena);


include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

mysql_query("UPDATE datos SET contrasena = '$contrasena' WHERE nick = '$nick'",$conexion_mysql);  // ingresamos



}


####################FIN FUNCION CAMBIAR_CONTRASENA#########################



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////



####################FUNCION DESCARGAR#########################

function DESCARGAR($nick,$nombre){




include("./config.php"); // Incluimos la configuracion


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


$texto = 'Ha descargardo tu Canci&oacute;n: <a href="./buscar.php?texto='.$nombre.'" target="_self" class="pizarra_link"> '.$titulo_show.' de '.$artista_show.'</a>';

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 



$consulta = "SELECT nick FROM musica where nombre = '$nombre'"; // elaboramos la consulta de las tablas existentes

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta de las tablas existentes


$nick_autor = mysql_result($query,0,0);








	if(trim($nick)!=trim($nick_autor)){


		DAR_ESTRELLAS($nick,$nick_autor,$estrellas_descarga);

	}


#
if (!isset($nombre) || empty($nombre)) {
#
    exit();
#
}
#
$root = "../musica/";
#
$file = basename($nombre);
#
$path = $root.$file;
#
$type = '';
#
 
#
if (is_file($path)) {
#
    $size = filesize($path);
#
    if (function_exists('mime_content_type')) {
#
        $type = mime_content_type($path);
#
    } else if (function_exists('finfo_file')) {
#
        $info = finfo_open(FILEINFO_MIME);
#
        $type = finfo_file($info, $path);
#
        finfo_close($info); 
#
    }
#
    if ($type == '') {
#
        $type = "application/force-download";
#
    }
#
    // Set Headers
#
    header("Content-Type: $type");
#
    header("Content-Disposition: attachment; filename=$file");
#
    header("Content-Transfer-Encoding: binary");
#
    header("Content-Length: " . $size);
#
    // Download File
#
    readfile($path);

ESCRIBIR_PIZARRA_DESCARGA($nick,$nick_autor,$texto);

	return(true);
#
} else {
#
return(false);


}

}




####################FIN FUNCION DESCARGAR#########################





///////////////////////////////////////////////////////////////////////////////////////////////////////////////////



####################FUNCION GENERAR_NOMBRE########################

function GENERAR_NOMBRE($titulo,$autor){

$espacio = chr(32);

$vector_titulo=explode($espacio,$titulo);

$titulo_listo=implode("_",$vector_titulo);

$titulo_listo = trim($titulo_listo);

$titulo_listo = strtolower($titulo_listo);

$titulo_listo = ucfirst($titulo_listo);


//////


$vector_autor=explode($espacio,$autor);

$autor_listo=implode("_",$vector_autor);

$autor_listo = trim($autor_listo);

$autor_listo = strtolower($autor_listo);

$autor_listo = ucfirst($autor_listo);


////////////////////


$nombre = "$titulo_listo-$autor_listo.mp3";

return($nombre);

}


####################FIN FUNCION GENERAR_NOMBRE########################


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


####################FUNCION SUBIR_DB########################

function SUBIR_DB($nick,$titulo,$autor){


$nombre = GENERAR_NOMBRE($titulo,$autor);


include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

mysql_query("INSERT INTO musica VALUES('$nombre','$nick')",$conexion_mysql);  // ingresamos



}






####################FIN FUNCION SUBIR_DB#########################


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


####################FUNCION OBTENER MUSICA#########################

function OBTENER_MUSICA()

{



include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

$consulta = "SELECT nombre FROM musica"; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$i=0;

while(mysql_result($query,$i,0)){

$array_musica[]=mysql_result($query,$i,0);

$i=($i+1);

}


return($array_musica);

}


####################FIN FUNCION OBTENER MUSICA#########################


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


####################FUNCION EXISTE MUSICA#########################

function EXISTE_MUSICA($nombre)

{


$musica=OBTENER_MUSICA();

$numero_musica=TOTAL_ARRAY($musica);



for($i=0;$i<$numero_musica;$i++){

if($nombre==$musica[$i]){

	return(true);
	break;
}

}

return(false);


}


####################FIN FUNCION EXISTE MUSICA#########################




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////



####################FUNCION LISTAR_ESTRELLAS#########################

function LISTAR_ESTRELLAS($nick)

{


include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

$consulta = "SELECT * FROM $nick"; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$i=0;

$total_estrellas=0;

while(mysql_result($query,$i,0)){

$nick_remoto=mysql_result($query,$i,0);

$estrellas=mysql_result($query,$i,1);

if($nick_remoto=="sapomusic"){

echo '<IMG SRC="../fotos/'.$nick_remoto.'.jpg" ALT="Foto" BORDER=1 WIDTH=60 HEIGTH=40 align=center>';
echo "   <------>$estrellas   ".'<IMG SRC="../img/star.gif" ALT="Estrellas" BORDER=0 WIDTH=20 HEIGTH=20 align=center><br><br>';

}else{


echo '<a href="./public.php?nick='.$nick_remoto.'" target="_self"><IMG SRC="../fotos/'.$nick_remoto.'.jpg" ALT="Foto" BORDER=1 WIDTH=60 HEIGTH=40 align=center></a>';
echo "   <------>$estrellas   ".'<IMG SRC="../img/star.gif" ALT="Estrellas" BORDER=0 WIDTH=20 HEIGTH=20 align=center><br><br>';

}

$total_estrellas=($total_estrellas+$estrellas);

$i=($i+1);

}


echo "<hr><br>Total: ";
echo "$total_estrellas   ".'<IMG SRC="../img/star.gif" ALT="Estrellas" BORDER=0 WIDTH=20 HEIGTH=20 align=center><br>';




}


####################FIN FUNCION LISTAR_ESTRELLAS#########################


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////



####################FUNCION OBTENER_AUTOR#########################

function OBTENER_AUTOR($nombre)

{


include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

$consulta = "SELECT nick FROM musica where nombre = '$nombre'" ; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$autor = mysql_result($query,0,0);  // elaboramos la consulta

return($autor);

}

####################FIN FUNCION OBTENER_AUTOR#########################


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


####################FUNCION OBTENER_MUSICA_LISTA#########################

function OBTENER_LISTA_MUSICA($nick)

{


$musica_bruta=OBTENER_MUSICA();

$total = TOTAL_ARRAY($musica_bruta);

$espacio = chr(32);

$var=1;

$contador=1;

for($i=0;$i<$total;$i++){

	$quitar_mp3= explode(".",$musica_bruta[$i]);

	$autor = OBTENER_AUTOR($musica_bruta[$i]);

	$sin_mp3=$quitar_mp3[0];

	$vector_primario = explode("-",$sin_mp3);

	$titulo_pre=$vector_primario[0];

	$artista_pre=$vector_primario[1];

	$vector_titulo=explode("_",$titulo_pre);

	$vector_artista=explode("_",$artista_pre);

	$titulo= implode($espacio,$vector_titulo);

	$artista= implode($espacio,$vector_artista);




	$datos=OBTENER_DATOS($autor);












if($nick==$autor){

	if($var==1){

	echo '<table border="1" BORDER WIDTH="100%" bordercolor="#0000ff" BACKGROUND="../img/fondo_panel_main.png"> <tr><td ALIGN=CENTER>';

	}else{

	echo '<td ALIGN=CENTER>';

	}


		
			
			echo "<center><table border=0> <tr> <TD ALIGN=CENTER><b>Canci&oacute;n:</b></td> <TD ALIGN=CENTER>$titulo</td> </tr>  <tr><TD ALIGN=CENTER><b>Artista:</b></td> <TD ALIGN=CENTER>$artista</td> </tr></table><br>".
'<table border="0"><tr><td align=center><embed src="niftyplayer.swf?file=../musica/'.$musica_bruta[$i].'&as=0" quality=high bgcolor=#FFFFFF width="165" height="38" name="niftyPlayer'.$contador.'" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></td>     <td align=center> <A HREF="./descargar.php?file='.$musica_bruta[$i].'" target="_blank"><IMG SRC="../img/down.gif" ALT="Descargar" BORDER=0></A></center></td></tr></table><br><br> Subido por:  <IMG SRC="../fotos/'.$autor.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60 align=center> '.$datos[0].' '. $datos[1].' <br><p><br><p><br>';


if($var==1){

echo '</td>';

$var=2;

}else{

echo '</td></tr></table><br>';

$var=1;

}



}else{


if($var==1){

echo '<table border="1" BORDER WIDTH="100%" bordercolor="#0000ff" BACKGROUND="../img/fondo_panel_main.png"> <tr><td ALIGN=CENTER>';

}else{

echo '<td ALIGN=CENTER>';

}



echo "<center><table border=0> <tr> <TD ALIGN=CENTER><b>Canci&oacute;n:</b></td> <TD ALIGN=CENTER>$titulo</td> </tr>  <tr><TD ALIGN=CENTER><b>Artista:</b></td> <TD ALIGN=CENTER>$artista</td> </tr></table><br>".
'<table border="0"><tr><td align=center><embed src="niftyplayer.swf?file=../musica/'.$musica_bruta[$i].'&as=0" quality=high bgcolor=#FFFFFF width="165" height="38" name="niftyPlayer'.$contador.'" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></td>     <td align=center> <A HREF="./descargar.php?file='.$musica_bruta[$i].'" target="_blank"><IMG SRC="../img/down.gif" ALT="Descargar" BORDER=0></A></center></td></tr></table><br><br> Subido por:  <a href="./public.php?nick='.$autor.'" target="_self"><IMG SRC="../fotos/'.$autor.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60 align=center> '.$datos[0].' '. $datos[1].' </a> <br> ------------------------------------------------------ <br>   Dar Estrellas: <form action="./dar.php?nick='.$autor.'" method="POST" name="formulario" ><SELECT NAME="stars">
<OPTION>1
<OPTION>2
<OPTION>3
<OPTION>4
<OPTION>5
<OPTION>6
<OPTION>7
<OPTION>8
<OPTION>9
<OPTION>10
<OPTION>11
<OPTION>12
<OPTION>13
<OPTION>14
<OPTION>15
<OPTION>16
<OPTION>17
<OPTION>18
<OPTION>19
<OPTION>20
</SELECT >
<input type="submit" name="submit" value="Dar" ></form> ';

if($var==1){

echo '</td>';

$var=2;

}else{

echo '</td></tr></table><br>';

$var=1;

}

}


$contador=($contador+1);






}


}

####################FIN FUNCION OBTENER_MUSICA_LISTA#########################





///////////////////////////////////////////////////////////////////////////////////////////////////////////////////





####################FUNCION OBTENER_MUSICA_LISTA_BUSCAR#########################

function OBTENER_LISTA_MUSICA_BUSCAR($nick,$texto)

{

$espacio = chr(32);

$vec_text = explode($espacio,$texto);

$texto_listo=$vec_text[0];


$texto_listo=trim($texto_listo);

$texto_listo=strtolower($texto_listo);



$musica_bruta=OBTENER_MUSICA();

$total = TOTAL_ARRAY($musica_bruta);



$var=1;

$contador=1;

for($i=0;$i<$total;$i++){




if(ereg($texto_listo,strtolower($musica_bruta[$i]))){



	$quitar_mp3= explode(".",$musica_bruta[$i]);

	$autor = OBTENER_AUTOR($musica_bruta[$i]);

	$sin_mp3=$quitar_mp3[0];

	$vector_primario = explode("-",$sin_mp3);

	$titulo_pre=$vector_primario[0];

	$artista_pre=$vector_primario[1];

	$vector_titulo=explode("_",$titulo_pre);

	$vector_artista=explode("_",$artista_pre);

	$titulo= implode($espacio,$vector_titulo);

	$artista= implode($espacio,$vector_artista);




	$datos=OBTENER_DATOS($autor);












if($nick==$autor){

	if($var==1){

	echo '<table border="1" BORDER WIDTH="100%" bordercolor="#0000ff" BACKGROUND="../img/fondo_panel_main.png"> <tr><td ALIGN=CENTER>';

	}else{

	echo '<td ALIGN=CENTER>';

	}


		
			
			echo "<center><table border=0> <tr> <TD ALIGN=CENTER><b>Canci&oacute;n:</b></td> <TD ALIGN=CENTER>$titulo</td> </tr>  <tr><TD ALIGN=CENTER><b>Artista:</b></td> <TD ALIGN=CENTER>$artista</td> </tr></table><br>".
'<table border="0"><tr><td align=center><embed src="niftyplayer.swf?file=../musica/'.$musica_bruta[$i].'&as=0" quality=high bgcolor=#FFFFFF width="165" height="38" name="niftyPlayer'.$contador.'" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></td>     <td align=center> <A HREF="./descargar.php?file='.$musica_bruta[$i].'" target="_blank"><IMG SRC="../img/down.gif" ALT="Descargar" BORDER=0></A></center></td></tr></table><br><br> Subido por:  <IMG SRC="../fotos/'.$autor.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60 align=center> '.$datos[0].' '. $datos[1].' <br><p><br><p><br>';


if($var==1){

echo '</td>';

$var=2;

}else{

echo '</td></tr></table><br>';

$var=1;

}



}else{


if($var==1){

echo '<table border="1" BORDER WIDTH="100%" bordercolor="#0000ff" BACKGROUND="../img/fondo_panel_main.png"> <tr><td ALIGN=CENTER>';

}else{

echo '<td ALIGN=CENTER>';

}



echo "<center><table border=0> <tr> <TD ALIGN=CENTER><b>Canci&oacute;n:</b></td> <TD ALIGN=CENTER>$titulo</td> </tr>  <tr><TD ALIGN=CENTER><b>Artista:</b></td> <TD ALIGN=CENTER>$artista</td> </tr></table><br>".
'<table border="0"><tr><td align=center><embed src="niftyplayer.swf?file=../musica/'.$musica_bruta[$i].'&as=0" quality=high bgcolor=#FFFFFF width="165" height="38" name="niftyPlayer'.$contador.'" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></td>     <td align=center> <A HREF="./descargar.php?file='.$musica_bruta[$i].'" target="_blank"><IMG SRC="../img/down.gif" ALT="Descargar" BORDER=0></A></center></td></tr></table><br><br> Subido por:  <a href="./public.php?nick='.$autor.'" target="_self"><IMG SRC="../fotos/'.$autor.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60 align=center> '.$datos[0].' '. $datos[1].' </a> <br> ------------------------------------------------------ <br>   Dar Estrellas: <form action="./dar.php?nick='.$autor.'" method="POST" name="formulario" ><SELECT NAME="stars">
<OPTION>1
<OPTION>2
<OPTION>3
<OPTION>4
<OPTION>5
<OPTION>6
<OPTION>7
<OPTION>8
<OPTION>9
<OPTION>10
<OPTION>11
<OPTION>12
<OPTION>13
<OPTION>14
<OPTION>15
<OPTION>16
<OPTION>17
<OPTION>18
<OPTION>19
<OPTION>20
</SELECT >
<input type="submit" name="submit" value="Dar" ></form> ';

if($var==1){

echo '</td>';

$var=2;

}else{

echo '</td></tr></table><br>';

$var=1;

}

}


$contador=($contador+1);




}

}


}

####################FIN FUNCION OBTENER_MUSICA_LISTA_BUSCAR#########################



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////



####################FUNCION ESCRIBIR_PIZARRA_TODAS#########################


function ESCRIBIR_PIZARRA_TODAS($nick_from,$texto){

$nicks=OBTENER_NICKS();

$total=TOTAL_ARRAY($nicks);

$datos_from=OBTENER_DATOS($nick_from);

$intro_nick="<<-$nick_from";

$intro="$datos_from[0]-$datos_from[1]->>";

for($j=0;$j<$total;$j++){


$descriptor_pizarra_obtener = fopen("../pizarras/$nicks[$j]","r");

while(!feof($descriptor_pizarra_obtener)){

	$pre=fgets($descriptor_pizarra_obtener);

	$pizarra = $pizarra.$pre;

}


$descriptor_pizarra=fopen("../pizarras/$nicks[$j]","w");
fwrite($descriptor_pizarra,trim($intro_nick)."\n");
fwrite($descriptor_pizarra,trim($intro)."\n");

$cont=0;

$val=80;

for($i=0;$i<1000;$i++){

if(isset($texto[$i])){
	
	if($cont==$val){
		fwrite($descriptor_pizarra,"");
		$val=($val+80);	$i=($i-1);
	}else{
	

	fwrite($descriptor_pizarra,"$texto[$i]");

	}
$cont=($cont+1);

}else{}

	
}

fwrite($descriptor_pizarra,"\n");
fwrite($descriptor_pizarra,"------------------------------------------------------------\n");
fwrite($descriptor_pizarra,"$pizarra");
fclose($descriptor_pizarra);


}


}



####################FIN FUNCION ESCRIBIR_PIZARRA_TODAS#########################












/////////////////////////  PUBLIC  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


function OBTENER_LISTA_MUSICA_PUBLIC()

{


$musica_bruta=OBTENER_MUSICA();

$total = TOTAL_ARRAY($musica_bruta);

$espacio = chr(32);

$var=1;

$contador=1;

for($i=0;$i<$total;$i++){

	$quitar_mp3= explode(".",$musica_bruta[$i]);

	$autor = OBTENER_AUTOR($musica_bruta[$i]);

	$sin_mp3=$quitar_mp3[0];

	$vector_primario = explode("-",$sin_mp3);

	$titulo_pre=$vector_primario[0];

	$artista_pre=$vector_primario[1];

	$vector_titulo=explode("_",$titulo_pre);

	$vector_artista=explode("_",$artista_pre);

	$titulo= implode($espacio,$vector_titulo);

	$artista= implode($espacio,$vector_artista);




	$datos=OBTENER_DATOS($autor);












if("1"=="1"){

	if($var==1){

	echo '<table border="1" BORDER WIDTH="100%" bordercolor="#0000ff" BACKGROUND="../img/fondo_panel_main.png"> <tr><td ALIGN=CENTER>';

	}else{

	echo '<td ALIGN=CENTER>';

	}


		
			
			echo "<center><table border=0> <tr> <TD ALIGN=CENTER><b>Canci&oacute;n:</b></td> <TD ALIGN=CENTER>$titulo</td> </tr>  <tr><TD ALIGN=CENTER><b>Artista:</b></td> <TD ALIGN=CENTER>$artista</td> </tr></table><br>".
'<table border="0"><tr><td align=center><embed src="niftyplayer.swf?file=../musica/'.$musica_bruta[$i].'&as=0" quality=high bgcolor=#FFFFFF width="165" height="38" name="niftyPlayer'.$contador.'" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></td>     <td align=center> </center></td></tr></table><br><br> Subido por:  <IMG SRC="../fotos/'.$autor.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60 align=center> '.$datos[0].' '. $datos[1].' <br><p>Para Descargar esta canci&oacute;n o dar estrellas a este usuario porfavor <a href="../index.php">Ingrese</a> en su cuenta o <a href="./registrar_1.php">Cree</a> una.<br><p><br>';


if($var==1){

echo '</td>';

$var=2;

}else{

echo '</td></tr></table><br>';

$var=1;

}



}else{


if($var==1){

echo '<table border="1" BORDER WIDTH="100%" bordercolor="#0000ff" BACKGROUND="../img/fondo_panel_main.png"> <tr><td ALIGN=CENTER>';

}else{

echo '<td ALIGN=CENTER>';

}



echo "<center><table border=0> <tr> <TD ALIGN=CENTER><b>Canci&oacute;n:</b></td> <TD ALIGN=CENTER>$titulo</td> </tr>  <tr><TD ALIGN=CENTER><b>Artista:</b></td> <TD ALIGN=CENTER>$artista</td> </tr></table><br>".
'<table border="0"><tr><td align=center><embed src="niftyplayer.swf?file=../musica/'.$musica_bruta[$i].'&as=0" quality=high bgcolor=#FFFFFF width="165" height="38" name="niftyPlayer'.$contador.'" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></td>     <td align=center> </center></td></tr></table><br><br> Subido por:  <IMG SRC="../fotos/'.$autor.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60 align=center> '.$datos[0].' '. $datos[1].' <br><p>Para Descargar esta canci&oacute;n o dar estrellas a este usuario porfavor <a href="../index.php">Ingrese</a> en su cuenta o <a href="./registrar_1.php">Cree</a> una.<br><p><br>';

if($var==1){

echo '</td>';

$var=2;

}else{

echo '</td></tr></table><br>';

$var=1;

}

}


$contador=($contador+1);






}


}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////



function OBTENER_LISTA_MUSICA_BUSCAR_PUBLIC($texto)

{

$espacio = chr(32);

$vec_text = explode($espacio,$texto);

$texto_listo=$vec_text[0];


$texto_listo=trim($texto_listo);

$texto_listo=strtolower($texto_listo);



$musica_bruta=OBTENER_MUSICA();

$total = TOTAL_ARRAY($musica_bruta);



$var=1;

$contador=1;

for($i=0;$i<$total;$i++){




if(ereg($texto_listo,strtolower($musica_bruta[$i]))){



	$quitar_mp3= explode(".",$musica_bruta[$i]);

	$autor = OBTENER_AUTOR($musica_bruta[$i]);

	$sin_mp3=$quitar_mp3[0];

	$vector_primario = explode("-",$sin_mp3);

	$titulo_pre=$vector_primario[0];

	$artista_pre=$vector_primario[1];

	$vector_titulo=explode("_",$titulo_pre);

	$vector_artista=explode("_",$artista_pre);

	$titulo= implode($espacio,$vector_titulo);

	$artista= implode($espacio,$vector_artista);




	$datos=OBTENER_DATOS($autor);












if("1"=="1"){

	if($var==1){

	echo '<table border="1" BORDER WIDTH="100%" bordercolor="#0000ff" BACKGROUND="../img/fondo_panel_main.png"> <tr><td ALIGN=CENTER>';

	}else{

	echo '<td ALIGN=CENTER>';

	}


		
			
			echo "<center><table border=0> <tr> <TD ALIGN=CENTER><b>Canci&oacute;n:</b></td> <TD ALIGN=CENTER>$titulo</td> </tr>  <tr><TD ALIGN=CENTER><b>Artista:</b></td> <TD ALIGN=CENTER>$artista</td> </tr></table><br>".
'<table border="0"><tr><td align=center><embed src="niftyplayer.swf?file=../musica/'.$musica_bruta[$i].'&as=0" quality=high bgcolor=#FFFFFF width="165" height="38" name="niftyPlayer'.$contador.'" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></td>     <td align=center> </center></td></tr></table><br><br> Subido por:  <IMG SRC="../fotos/'.$autor.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60 align=center> '.$datos[0].' '. $datos[1].' <br><p>Para Descargar esta canci&oacute;n o dar estrellas a este usuario porfavor <a href="../index.php">Ingrese</a> en su cuenta o <a href="./registrar_1.php">Cree</a> una.<br><p><br>';


if($var==1){

echo '</td>';

$var=2;

}else{

echo '</td></tr></table><br>';

$var=1;

}



}else{


if($var==1){

echo '<table border="1" BORDER WIDTH="100%" bordercolor="#0000ff" BACKGROUND="../img/fondo_panel_main.png"> <tr><td ALIGN=CENTER>';

}else{

echo '<td ALIGN=CENTER>';

}



echo "<center><table border=0> <tr> <TD ALIGN=CENTER><b>Canci&oacute;n:</b></td> <TD ALIGN=CENTER>$titulo</td> </tr>  <tr><TD ALIGN=CENTER><b>Artista:</b></td> <TD ALIGN=CENTER>$artista</td> </tr></table><br>".
'<table border="0"><tr><td align=center><embed src="niftyplayer.swf?file=../musica/'.$musica_bruta[$i].'&as=0" quality=high bgcolor=#FFFFFF width="165" height="38" name="niftyPlayer'.$contador.'" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></td>     <td align=center> </center></td></tr></table><br><br> Subido por:  <IMG SRC="../fotos/'.$autor.'.jpg" ALT="Foto" BORDER=1 WIDTH=50 HEIGTH=60 align=center> '.$datos[0].' '. $datos[1].' <br><p>Para Descargar esta canci&oacute;n o dar estrellas a este usuario porfavor <a href="../index.php">Ingrese</a> en su cuenta o <a href="./registrar_1.php">Cree</a> una.<br><p><br>';

if($var==1){

echo '</td>';

$var=2;

}else{

echo '</td></tr></table><br>';

$var=1;

}

}


$contador=($contador+1);




}

}


}







/////////////////////////////////////////////////////////////////////////////////////7



function CONECTADO($nick)

{



include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

mysql_query("UPDATE conect SET conect = 1 where nick = '$nick'",$conexion_mysql);  // ingresamos



}


/////////////////////////////////////////////////////////////////////////////////////7


function DESCONECTADO($nick)

{



include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

mysql_query("UPDATE conect SET conect = 0 where nick = '$nick'",$conexion_mysql);  // ingresamos



}


/////////////////////////////////////////////////////////////////////////////////////7



function LISTA_CONECTADOS()

{



include("./config.php"); // Incluimos la configuracion

$conexion_mysql = mysql_connect($mysql_host,$mysql_user,$mysql_pass); //conectamos con la base de datos

mysql_select_db($mysql_db,$conexion_mysql); //seleccionamos la base de datos 

$consulta = "SELECT nick FROM conect where conect = 1"; // elaboramos la consulta

$query = mysql_query($consulta,$conexion_mysql);  // elaboramos la consulta

$i=0;

while(mysql_result($query,$i,0)){

$array_nicks[]=mysql_result($query,$i,0);

$i=($i+1);

}


return($array_nicks);




}


/////////////////////////////////////////////////////////////////////////////////////7

function LISTAR_CHAT($nick)

{

$conectados = LISTA_CONECTADOS();

$total_conectados = TOTAL_ARRAY($conectados);

for($i=0;$i<$total_conectados;$i++){


	if($nick!=$conectados[$i]){

		$datos = OBTENER_DATOS($conectados[$i]);

		$nombre = $datos[0];
		$apellido = $datos[1];


echo '<a href="javascript:void(0)" onclick="javascript:chatWith(\''.$nombre.'_'.$apellido.'\')">';

		echo '<IMG SRC="../fotos/'.$conectados[$i].'.jpg" ALT="Foto" BORDER=1 WIDTH=40 HEIGTH=20 align="center"> '.$nombre.' '.$apellido.'</a><br><br>';

	}

}

}


//////////////////////////////////////////////////////////////////////////////////////////////


function DESECHAR($texto)

{

$espacio = chr(32);

$vector = explode($espacio,$texto);

$listo = $vector[0];

return($listo);

}

//////////////////////////////////////////////////////////////////////////////////////////////////7





###$nicks = OBTENER_NICKS();

###$total = TOTAL_ARRAY($nicks);

###echo "Total de Nicks existentes en la base de datos: $total<br><br>";

###$tamano = TOTAL_ARRAY($nicks);


###echo "<center><h2>Datos de todos los usuarios</h2></center><br><br>";



###for($i=0;$i<$tamano;$i++){

###$nick = $nicks[$i];

###$datos_user = OBTENER_DATOS($nick);

###echo "Nombre: $datos_user[0]<br>";
###echo "Apellido: $datos_user[1]<br>";
###echo "Sexo: $datos_user[2]<br>";
###echo "Estrellas: $datos_user[3]<br>";
###echo "Contrase&ntilde;a: $datos_user[4]<br><br><p><br>";

###}





?>
