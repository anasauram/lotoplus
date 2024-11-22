<table>
    <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Nombre de usuario</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Ganancias</th>
        <th>Fecha de nacimiento</th>
        <th>Tipo de cuenta</th>
        <th>Marketing</th>
        <th>Tipo de usuario</th>
    </tr>

    <?php
    $conta = 1;
    if (mysqli_num_rows($res) > 0) {
        //mostramos los datos.
        //while (list($ciudad, $poblacion) = mysqli_fetch_array($res)) {
        while ($datosCiudad = mysqli_fetch_array($res)) {
            echo "<tr>";
            $conta++;
            $poblacion = number_format($datosCiudad['Population'], 0, ',', '.');
            $ciudad = $datosCiudad['Name'];
            //$ciudad = mb_convert_encoding($datosCiudad['Name'], 'ISO-8859-1', 'UTF-8');
            echo "<td>$ciudad</td>\n";
            echo "<td class='derecha'>$poblacion</td>\n";
            echo "</tr>\n";
        }
        $conta = $conta - 1;

        // +++++++++++++++++++ Paginación 
        // Calculamos el número total de páginas
        $sql2 = "select count(*) as contaFilas from city where CountryCode = (select Code from country where Name = '" . $pais . "') and (Population > " . $pobCiudad . ")";
        $res2 = mysqli_query($cnx, $sql2) or die(mysqli_error($cnx));
        $fila = mysqli_fetch_array($res2);
        $totalFilas = $fila['contaFilas'];
        $totalPag = ceil($totalFilas / $numFilasPag);
        echo "<tr><td class='centrado' colspan='2'>Mostradas $conta ciudades - Total $totalFilas ciudades</td></tr>";
        // Si hay más páginas, mostramos los enlaces
        if ($totalPag > 1) {
            // Mostramos los enlaces a las páginas
            echo "<tr><td  class='centrado' colspan='2'>";
            for ($pag = 1; $pag <= $totalPag; $pag++) {
                if ($pag == $numPag) {
                    echo "[$pag] ";
                } else {
                    echo "[<a href='" . $_SERVER['PHP_SELF'] . "?numPagina=$pag&pais=$pais&pobCiudad=$pobCiudad'>$pag</a>] ";
                }
            }
            echo "</td></tr>\n";
        }
    } else {
        echo "<tr><td colspan='2' class='centrado' >No se obtuvieron resultados</td></tr>";
    }
