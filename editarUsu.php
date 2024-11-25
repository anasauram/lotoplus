<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejemplo UT3</title>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

<body>
    <?php
    // editar_pdo_prep.php
    include("includes/config.php");
    include("includes/funciones_pdo.php");

    //si el formulario se ha enviado editamos el registro
    if (isset($_POST['enviar'])) {
        //nos conectamos a mysql
        $pdo = conectar();
        // Construimos la sentencia
        $sql = "UPDATE contactos SET nombre = ?, apellido = ?, nick = ?, email = ?, url = ? WHERE id = ?";
        $sentencia = $pdo->prepare($sql);
        $parametros = array($_POST['nombre'], $_POST['apellido'], $_POST['nick'], $_POST['email'], $_POST['url'], $_POST['id']);
        $sentencia->execute($parametros);
        echo "Registro actualizado.<br><a href='listado_pdo_prep.php'>regresar</a>";
        exit;
    }

    //si no hay id, no puede seguir.
    if (empty($_GET['id'])) {
        header("Location: listado_pdo_prep.php");
        exit;
    }

    //nos conectamos a mysql
    $pdo = conectar();

    //consulta para mostrar los datos.
    $sql = "SELECT id,nombre,apellido,nick,email,url FROM contactos WHERE id=?";
    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam(1, $_GET['id']);
    $sentencia->execute();

    if ($fila = $sentencia->fetch()) {
        //si hay resultados "montamos" el formulario
    ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
            <table>
                <tr>
                    <th width="150">id</th>
                    <td><input name="id" type="hidden" id="id" value="<?= $fila['id'] ?>"><?= $fila['id'] ?></td>
                </tr>
                <tr>
                    <th>nombre</th>
                    <td><input name="nombre" type="text" id="nombre" value="<?= $fila['nombre'] ?>"></td>
                </tr>
                <tr>
                    <th>apellido</th>
                    <td><input name="apellido" type="text" id="apellido" value="<?= $fila['apellido'] ?>"></td>
                </tr>
                <tr>
                    <th>nick</th>
                    <td><input name="nick" type="text" id="nick" value="<?= $fila['nick'] ?>"></td>
                </tr>
                <tr>
                    <th>email</th>
                    <td><input name="email" type="text" id="email" value="<?= $fila['email'] ?>"></td>
                </tr>
                <tr>
                    <th>web site</th>
                    <td><input name="url" type="text" id="url" value="<?= $fila['url'] ?>"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="right"><input type="submit" name="enviar" value="enviar"></td>
                </tr>
            </table>
        </form>
    <?php
    } else {
        //no hay resultados, id erróneo o no existe el registro
        echo "No se obtuvieron resultados";
    }
    ?>
</body>

</html>