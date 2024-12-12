<?php
$ocultarNav = true;
require("includes/cabecera.php");

session_start();

//si el formulario se ha enviado insertamos el registro.
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
        // **************** Logueo usuario ****************
        // si el usuario acaba de intentar conectarse
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        // Nos conectamos a MySQL
        $pdo = conectar();

        $sql = "SELECT * FROM usuarios WHERE nomusu = '$usuario'";
        $res = $pdo->query($sql);

        if ($fila = $res->fetch()) {
                // Comprobamos la contraseña			
                if (password_verify($clave, $fila['clave'])) {
                        // **************** Variables de sesión ****************
                        // Si está en la base de datos y coincide, registramos al usuario
                        $_SESSION['idusuario_valido'] = $fila['idusuario']; // Guardamos la clave primaria del registro
                        $_SESSION['usuario_valido'] = $fila['nomusu'];     // Guardamos el nombre de usuario		

                        header("Location: inicio.php");
                        exit;
                }
        } else {
                echo '<script>alert("Credenciales no válidas");</script>';
        }
}
?>

<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <table>
                <tr>
                        <th>NOMBRE DE USUARIO</th>
                        <td><input name="usuario" type="text" id="nombre" class="inputtxt_minsize" value=""></td>
                </tr>
                <tr>
                        <th>CONTRASE&Ntilde;A</th>
                        <td><input name="clave" type="password" id="contra" value=""></td>
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