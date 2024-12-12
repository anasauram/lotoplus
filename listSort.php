<?php
require("includes/cabecera.php");

// Se obtiene el número de página
$numPag = (int)($_GET['numPagina'] ?? 1);

// Número de registros por página
$REGISTROS_PAG = 10;

// Se calcula la fila inicial para el LIMIT
$numIni = ($numPag - 1) * $REGISTROS_PAG;

try {
    // Conexión a la base de datos
    $pdo = conectar();

    // Consulta para obtener los sorteos
    $sql = "SELECT idsorteo, nsorteo, fsorteo, descrip 
            FROM sorteos 
            ORDER BY idsorteo ASC 
            LIMIT $numIni, $REGISTROS_PAG";

    $res = $pdo->query($sql);
    $conta = 0;

    // Mostramos las filas de la tabla
    echo "<table><tr>
        <th>ID SORTEO</th>
        <th>NOMBRE</th>
        <th>FECHA SORTEO</th>
        <th>DESCRIPCIÓN</th>
        <th>ACCIÓN</th>
    </tr>";

    while ($fila = $res->fetch()) {
        $conta++;
        echo $conta % 2 === 0 ? "<tr class='alt'>" : "<tr>";
        echo "<td>" . $fila['idsorteo'] . "</td>\n";
        echo "<td>" . htmlspecialchars($fila['nsorteo']) . "</td>\n";
        echo "<td>" . htmlspecialchars($fila['fsorteo']) . "</td>\n";
        echo "<td>" . htmlspecialchars($fila['descrip']) . "</td>\n";
        echo "<td>
                <a href='editarSort.php?id=" . $fila['idsorteo'] . "'>Editar</a>
                <a href='eliminarSort.php?id=" . $fila['idsorteo'] . "'>Eliminar</a>
              </td>\n";
        echo "</tr>";
    }

    if ($conta === 0) {
        echo "<tr><td colspan='5' align='center'>No se encontraron sorteos</td></tr>";
    }

    // Calculamos el total de registros
    $sql = "SELECT COUNT(*) as total FROM sorteos";
    $res = $pdo->query($sql);
    $fila = $res->fetch();
    $totalFilas = $fila['total'];
    $totalPag = ceil($totalFilas / $REGISTROS_PAG);

    // Mostramos total de sorteos y su paginación
    echo "<tr><td colspan='5'>$conta sorteos - Filas $totalFilas</td></tr>";

    if ($totalPag > 1) {
        echo "<tr><td colspan='5'>";

        if ($numPag > 1) {
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?numPagina=" . ($numPag - 1) . "'>Anterior</a> ";
        }
        if ($totalPag > $numPag) {
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?numPagina=" . ($numPag + 1) . "'>Siguiente</a>";
        }

        echo "</td></tr>";
    }
} catch (Exception $e) {
    // Capturamos el error y mostramos un mensaje
    echo "<p>Error: " . $e->getMessage() . "</p>";
}

?>
</table>
<p><a href='nuevoSort.php'>Nuevo sorteo</a></p>

<?php
require("includes/pie.php");
?>