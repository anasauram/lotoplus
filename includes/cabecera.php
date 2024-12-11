<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulario LotoPlus</title>
	<link rel="stylesheet" href="style/registro_formulario.css">
	<link rel="stylesheet" href="style/registro_datos.css">
	<link rel="stylesheet" href="style/tablas.css">
</head>

<body>
	<?php
	require("config.php");
	require("funciones.php");

	ini_set('display_errors', 1);       // Habilita la visualización de errores
	ini_set('display_startup_errors', 1); // Muestra errores en el inicio de PHP
	error_reporting(E_ALL);             // Reporta todos los errores, advertencias y avisos
	?>