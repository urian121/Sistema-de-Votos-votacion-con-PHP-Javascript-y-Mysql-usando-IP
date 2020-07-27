<?php
$usuario = "root";
$password = "";
$servidor = "localhost";
$basededatos = "mivotos";
$con = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
$db = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");

/*$usuario = "epiz_21499340";
$password = "gooYes9FLVMT";
$servidor = "sql302.epizy.com";
$basededatos = "epiz_21499340_victimas";
$con = mysqli_connect($servidor, $usuario, $password) or die("No se ha podido conectar al Servidor");
$db = mysqli_select_db($con, $basededatos) or die("Upps! Error en conectar a la Base de Datos");
*/
?>
