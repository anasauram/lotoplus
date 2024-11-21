<?php
$titulo = "Formulario LotoPlus";
require("includes/cabecera.php");
?>
<h1>MENÚ DE INICIO</h1>
<h2>Usuarios:</h2>
<ul>
    <a href="listUsu.php">Listado usuarios</a><br>
    <a href="altaUsu.php">Alta usuarios</a>
</ul>
<h2>Sorteos:</h2>
<ul>
    <a href="listSort.php">Listado sorteos</a>
</ul>
<h2>Participaciones:</h2>
<ul>
    <a href="listPart.php">Listado participaciones</a>
</ul>
<h2>Premios:</h2>
<ul>
    <a href="listPrem.php">Listado premios</a><br>
    <a href="calcPrem.php">Cálculo premios</a>
</ul>
<?php
require("includes/pie.php")
?>