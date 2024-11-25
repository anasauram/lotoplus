<?php
require("includes/cabecera.php");

// Se obtiene el número de página
$numPag = (int)($_GET['numPagina'] ?? 1);

// Número de registros por página
$REGISTROS_PAG = 10;

// Se calcula la fila inicial para el LIMIT
$numIni = ($numPag - 1) * $REGISTROS_PAG;

try {
    // Nos conectamos a la base de datos
    $pdo = conectar();

    // Consulta para obtener las participaciones
    $sql = "SELECT idpart, idprop, idsorteo, numero, importe, captura 
            FROM participaciones 
            ORDER BY idpart ASC 
            LIMIT $numIni, $REGISTROS_PAG";

    $res = $pdo->query($sql);
    $conta = 0;

    // Mostramos las filas de la tabla
    echo "<table><tr>
        <th>ID PARTICIPACIÓN</th>
        <th>ID USUARIO</th>
        <th>ID SORTEO</th>
        <th>NÚMERO</th>
        <th>IMPORTE</th>
        <th>ACCIÓN</th>
    </tr>";

    while ($fila = $res->fetch()) {
        $conta++;
        echo $conta % 2 === 0 ? "<tr class='alt'>" : "<tr>";
        echo "<td>" . $fila['idpart'] . "</td>\n";
        echo "<td>" . $fila['idprop'] . "</td>\n";
        echo "<td>" . $fila['idsorteo'] . "</td>\n";
        echo "<td>" . $fila['numero'] . "</td>\n";
        echo "<td>" . number_format($fila['importe'], 2) . " €</td>\n";
        echo "<td><a href='editarPart.php?id=" . $fila['idpart'] . "'>Editar</a></td>\n";
        echo "<td><a href='eliminarPart.php?id=" . $fila['idpart'] . "'>Eliminar</a></td>\n";
        echo "</tr>";
    }

    if ($conta === 0) {
        echo "<tr><td colspan='8' align='center'>No se encontraron participaciones</td></tr>";
    }

    // Calculamos el total de registros
    $sql = "SELECT COUNT(*) as total FROM participaciones";
    $res = $pdo->query($sql);
    $fila = $res->fetch();
    $totalFilas = $fila['total'];
    $totalPag = ceil($totalFilas / $REGISTROS_PAG);

    // Mostramos total de participaciones y su paginación
    echo "<tr><td colspan='8' class='centrado'>$conta participaciones - Filas $totalFilas</td></tr>";

    if ($totalPag > 1) {
        echo "<tr><td colspan='8' class='centrado'>";

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
<p><a href='nuevaPart.php'>Nueva participación</a></p>

<p><a href="inicio.php"><button>Volver a Inicio</button></a></p>

<?php
require("includes/pie.php");
?>
