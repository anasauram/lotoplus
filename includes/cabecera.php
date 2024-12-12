<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulario LotoPlus</title>
	<link rel="stylesheet" href="style/registro_formulario.css">
	<link rel="stylesheet" href="style/registro_datos.css">
	<link rel="stylesheet" href="style/tablas.css">
	<link rel="stylesheet" href="style/menu.css">
</head>

<body>
	<header>
		<nav>
			<ul class="menu centrado">
				<li><a href="inicio.php">Inicio</a></li>
				<li class="submenu">
					<a href="#">Usuarios</a>
					<ul class="submenu-items">
						<li><a href="listUsu.php">Listado</a></li>
						<li><a href="altaEditUsu.php">Alta</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="listSort.php">Sorteos</a>
					<ul class="submenu-items">
						<li><a href="listSort.php">Listado</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#">Participaciones</a>
					<ul class="submenu-items">
						<li><a href="listPart.php">Listado</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#">Premios</a>
					<ul class="submenu-items">
						<li><a href="listPrem.php">Listado</a></li>
						<li><a href="calcPrem.php">Cálculo</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header>
	<?php
	require("config.php");
	require("funciones.php");

	ini_set('display_errors', 1);       // Habilita la visualización de errores
	ini_set('display_startup_errors', 1); // Muestra errores en el inicio de PHP
	error_reporting(E_ALL);             // Reporta todos los errores, advertencias y avisos
	?>