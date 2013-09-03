<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sapo Music</title>
<LINK REL="SHORTCUT ICON" HREF="./img/icono.ico">

<link rel="stylesheet" type="text/css" href="../css/main.css" />

</head>





<body BGCOLOR="#aaff44"  TEXT="#000000" class="bodymain">

<IMG SRC="../img/top_bar.png" ALT="SapoMusic" BORDER=0 WIDTH=300 HEIGTH=300 class="topbar">

<IMG SRC="../img/sapo.gif" ALT="SapoMusic" BORDER=0 WIDTH=300 HEIGTH=300 class="sapo">

<?php $num=rand(1,20); echo '  <IMG SRC="../img/logos/'.$num.'.png" ALT="SapoMusic" BORDER=0 WIDTH=500 HEIGTH=300 class="logo">'; ?>
<br><br>





<br><p><br>
<center>

<H1><B>INGRESA TUS DATOS</B></H1>
<br><br>



<form action="./registrar_2.php" method="POST" name="registrar" class="Estilo4">
<br>Nombre: <br><input name="nombre" type="text" id="nombre" ><br>
<br>Apellido: <br><input name="apellido" type="text" id="apellido" ><br>
<br>Nick: <br><input name="nick" type="text" id="nick" ><br>
<br>
<br>Sexo:<br>
<SELECT NAME="sexo" id="sexo">
<OPTION>Masculino
<OPTION>Femenino
</SELECT ><br>
<br>Contraseña:<br> <input name="pass1" type="password" id="pass1" >
<br>Confirmar Contraseña:<br> <input name="pass2" type="password" id="pass2" >
<br><br>
  <input type="submit" name="submit" value="Registrame!" >
<br><br>
</form>

</center>

<SCRIPT LANGUAGE="JavaScript">
alert("1) Ingresar solo Primer nombre, y primer apellido, en caso de ingresar algo más, será descartado\n2) No utiluzar simbolos especiales como (. , - _ @ # ~ %) o ningun otro en ninguno de los campos, caso contrario la cuenta creada tendra errores\n3) Usar siempre minusculas en su nick\n4) Tomar en cuenta las mayusculas en su contraseña\n5) El nick es, y sera usado solamente para ingresar a su cuenta, y no sera conocido por los demas usuarios SapoMusic\n6) Todos los campos a continuación son obligatorios");
</SCRIPT>

</body>
</html>



