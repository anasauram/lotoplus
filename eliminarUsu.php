<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejemplo UT3</title>
    <link rel="stylesheet" type="text/css" href="style/tablas.css" />
</head>

<body>
    <?php
    //eliminar_pdo.php
    if (isset($_POST['enviar'])) {
        require("includes/config.php");
        require("includes/funciones.php");

        //nos conectamos al SGBD
        $pdo = conectar();

        $sql = "DELETE FROM usuarios WHERE idusuario =" . $_POST['id'];
        $res = $pdo->exec($sql);
        echo "Registro " . $_POST['id'] . " eliminado.<br><a href='listUsu.php'>regresar</a>";
        exit;
    }
    //si no hay id, no puede seguir.
    if (!isset($_GET['id'])) {
        header("Location: listUsu.php");
        exit;
    }
    ?>
    <form name="form1" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <table>
            <tr>
                <td><input name="id" type="hidden" id="id" value="<?= $_GET['id']; ?>"><br>
                    ¿Seguro que quieres borrar el registro con id <?= $_GET['id']; ?>?</td>
            </tr>
            <tr>
                <td><input type="submit" name="enviar" value="Borrar registro."></td>
            </tr>
            <tr>
                <td><a href="listUsu.php">cancelar</a></td>
            </tr>
        </table>
    </form>
</body>

</html>