<?php
require("includes/cabecera.php");

// Se obtiene el número de página
if (isset($_GET['numPagina'])) {
    $numPag = $_GET['numPagina'];
} else {
    $numPag = 1;
}

// Se calcula la fila inicial para aplicar el LIMIT	(el offset)	
$numIni = ($numPag - 1) * $REGISTROS_PAG;
?>
<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE DE USUARIO</th>
        <th>NOMBRE</th>
        <th>APELLIDOS</th>
        <th colspan="3">ACCI&Oacute;N</th>
    </tr>
    <?php
    //nos conectamos a mysql
    $pdo = conectar();
    //consulta.
    $sql = "SELECT idusuario,nomusu,nombre,apellidos FROM usuarios ORDER BY idusuario ASC LIMIT $numIni, $REGISTROS_PAG";
    $res = $pdo->query($sql);
    $conta = 0;
    //mostramos los datos.
    while ($fila = $res->fetch()) {
        $conta++;
        if (($conta % 2 == 0)) {
            echo "<tr class='alt'>";
        } else {
            echo "<tr>";
        }
        echo "<td>" . $fila['idusuario'] . "</td>\n";
        echo "<td>" . $fila['nomusu'] . "</td>\n";
        echo "<td>" . $fila['nombre'] . "</td>\n";
        echo "<td>" . $fila['apellidos'] . "</td>\n";
        echo "<td><a href='verUsu.php?id=" . $fila['idusuario'] . "'>ver</a></td>\n";
        echo "<td><a href='editarUsu.php?id=" . $fila['idusuario'] . "'>editar</a></td>\n";
        echo "<td><a href='eliminarUsu.php?id=" . $fila['idusuario'] . "'>eliminar</a></td></tr>\n";
    }
    if ($conta == 0) {
        echo "<td colspan='7' align='center' >No se obtuvieron resultados</td>";
    }
    // +++++++++++++++++++ Paginación 
    // Calculamos el número total de páginas
    $sql = "select count(*) as contaFilas from usuarios";
    $res = $pdo->query($sql);
    $fila = $res->fetch();
    $totalFilas = $fila['contaFilas'];  // 34
    $totalPag = ceil($totalFilas / $REGISTROS_PAG);   // 34/20 = 2
    echo "<tr><td class='centrado' colspan='7'>Mostrados $conta usuarios - Total $totalFilas usuarios</td></tr>";
    // Si hay más páginas, mostramos los enlaces
    if ($totalPag > 1) {
        echo "<tr><td  class='centrado' colspan='7'>";
        if ($numPag > 1) {
            //Página anterior
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?numPagina=" . ($numPag - 1) . "'>Anterior</a> ";
        }
        if ($totalPag > $numPag) { // Si esta página no es la última
            //Página siguiente
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?numPagina=" . ($numPag + 1) . "'>Siguiente</a>";
        }
        echo "</td></tr>\n";
    }
    ?>
</table>
<br>
<p><a href='nuevo_pdo.php'>Nuevo registro</a></p>

<?php
require("includes/pie.php")
?>