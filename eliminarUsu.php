<?php
require("includes/cabecera.php");

//eliminar_pdo.php
if (isset($_POST['enviar'])) {
    //nos conectamos al SGBD
    $pdo = conectar();

    // Sí mínimo hay una participación registrada del usuario devolverá 1 y, sino, false.
    $sql = "SELECT COUNT(*) AS 'presente' FROM participaciones WHERE idprop = " . $_POST['id'] . " LIMIT 1";
    $res = $pdo->query($sql);
    $linea = $res->fetch(PDO::FETCH_NUM);
    if ($linea[0] > 0) {
        echo "<script>
            if (confirm('Este usuario tiene participaciones asociadas. ¿Deseas eliminarlas también?')) {
                window.location.href = 'eliminarUsuParticipaciones.php?id=" . $_POST['id'] . "';
            } else {
                window.location.href = 'listUsu.php';
            }
        </script>";
        exit;
    } else {
        $sql = "DELETE FROM usuarios WHERE idusuario =" . $_POST['id'];
        $res = $pdo->exec($sql);
        echo "Registro " . $_POST['id'] . " eliminado.<br><a href='listUsu.php'>regresar</a>";
        exit;
    }
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
<?php
require("includes/pie.php");
?>