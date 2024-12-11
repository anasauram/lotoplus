<?php
require("includes/cabecera.php");
//si el formulario se ha enviado insertamos el registro.
if (isset($_POST['inicio'])) {
        // **************** Logueo usuario ****************
        //nos conectamos a mysql
        $cnx = conectar();

        $campos = "nombre,apellido,nick,email,url";
        $valores = "'" . $_POST['nombre'] . "',";
        $valores .= "'" . $_POST['apellido'] . "',";
        $valores .= "'" . $_POST['nick'] . "',";
        $valores .= "'" . $_POST['email'] . "',";
        $valores .= "'" . $_POST['url'] . "'";
        $sql = "INSERT INTO contactos ($campos) VALUES($valores)";
        $res = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
        echo "Registro insertado.<br><a href='listado.php'>regresar</a>";
        mysqli_close($cnx);
        exit;


        header("Location: index.php");
        exit;
}
?>

<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <table>
                <tr>
                        <th>NOMBRE DE USUARIO</th>
                        <td><input name="nombre" type="text" id="nombre" class="inputtxt_minsize" value=""></td>
                </tr>
                <tr>
                        <th>CONTRASEÑA</th>
                        <td><input name="contra" type="password" id="contra" value=""></td>
                </tr>


        </table>
        <div class="centrado">
                <button type="submit" name="inicio" class="btn_submit">INICIAR SESIÓN</button>
                <button type="reset" class="btn_cancelar">CANCELAR</button>
        </div>
        <div class="centrado">
                <a class="p_peque" href="index.php">Registrarse</a>
        </div>
</form>
<?php
require("includes/pie.php");
?>