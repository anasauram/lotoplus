<?php
require("includes/cabecera.php");
$pdo = conectar();
?>
<h1>MENÚ DE INICIO</h1>
<h2>Usuarios:</h2>
<ul>
    <li><a href="listUsu.php">Listado usuarios</a></li>
    <li><a href="altaUsu.php">Alta usuarios</a></li>
</ul>
<h2>Sorteos:</h2>
<ul>
    <li><a href="listSort.php">Listado sorteos</a></li>
</ul>
<h2>Participaciones:</h2>
<ul>
    <li><a href="listPart.php">Listado participaciones</a></li>
</ul>
<h2>Premios:</h2>
<ul>
    <li><a href="listPrem.php">Listado premios</a></li>
    <li> <a href="calcPrem.php">Cálculo premios</a></li>
</ul>
<?php
require("includes/pie.php")
?>