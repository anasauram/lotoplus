<?php
require("includes/cabecera.php");

// Si no hay modo no puede seguir.
if (!isset($_GET['modo'])) {
    header("Location: listUsu.php");
    exit;
}
// Si no hay id en modo editar no puede seguir.
if (empty($_GET['id']) && $_GET['modo'] == "editar") {
    header("Location: listUsu.php");
    exit;
}

// Mostrar datos a modificar en modo editar.
if (!isset($_POST['submit']) && $_GET['modo'] == "editar" && isset($_GET['id'])) {
    $pdo = conectar();
    $sql = "SELECT `nombre`, `apellidos`, `nomusu`, `clave`, `email`, `tel`, `ganancias`, `fechanac`, `imgusu`, `tipocu`, `marketing`, `tipousu` FROM `usuarios` WHERE `idusuario`= ?";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute([$_GET['id']]);
    $linea = $sentencia->fetch(PDO::FETCH_ASSOC);

    $nombre = $linea['nombre'];
    $apellidos = $linea['apellidos'];
    $nombre_usuario = $linea['nomusu'];
    $email = $linea['email'];
    $tlf = $linea['tel'];
    $ganancias_iniciales = $linea['ganancias'];
    $fecha_nacimiento = $linea['fechanac'];
    $nombre_ruta_foto = $linea['imgusu'];
    $tipo_cuenta = $linea['tipocu'];
    $marketing = $linea['marketing'];
    $contraHashed = $linea['clave'];
}

$errores = [];
// Asignación a variables php de los datos introducidos en formulario y validación de los mismos.
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $contra = $_POST['contra'];
    $contraHashed = password_hash($contra, PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $tipo_cuenta = $_POST['tipo_cuenta'];
    $ganancias_iniciales = $_POST['ganancias_iniciales'];
    $tlf = $_POST['tlf'];
    $condiciones = $_POST['condiciones'] ?? false;
    $marketing = ($_POST['marketing'] == 'on' ? 'S' : 'N') ?? false;
    $nombre_ruta_foto = "";

    // -------- FOTO --------
    // Comprobamos si se ha enviado un archivo (foto) para añadirla a la carpeta img de la página web.
    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $nombre_foto = $_FILES['foto']['name'];
        $nombre_ruta_foto = "uploads/" . $nombre_foto;
        // Comprobamos que no haya un archivo con el mismo nombre que la foto subida.
        // Si lo hubiera le cambiamos el nombre para ponerle un identificador que lo haga único.
        if (is_file($nombre_ruta_foto)) {
            $nombre_foto = time() . $nombre_foto;
            $nombre_ruta_foto = "uploads/" . $nombre_foto;
        }
        // Movemos la foto de un fichero temporal a la carpeta uploads de la página web.
        move_uploaded_file($_FILES['foto']['tmp_name'], $nombre_ruta_foto);
    }

    // Validación de datos.
    // Nombre de usuario.
    if (!existeUsu($nombre_usuario)) {
        $errores[] = "Error: El usuario ya existe.";
    }
}

// **************** Alta usuario ****************
if (isset($_POST['submit']) && $_GET['modo'] == "alta") {
    $pdo = conectar();
    $sql = "INSERT INTO usuarios(nombre, apellidos, nomusu, clave, email, tel, ganancias, fechanac, imgusu, tipocu, marketing) VALUES(?,?,?,?,?,?,?,?,?,?,?);";
    $sentencia = $pdo->prepare($sql);
    $parametros = array($nombre, $apellidos, $nombre_usuario, $contraHashed, $email, $tlf, $ganancias_iniciales, $fecha_nacimiento, $nombre_ruta_foto, $tipo_cuenta, $marketing);
    $sentencia->execute($parametros);
?>
    <div>
        <h1>Creación de cuenta. Datos enviados</h1>
        <p>Estos son los datos introducidos para el registro del usuario:</p>
        <div class="datos">
            <?php
            // -------- IMPRESIÓN DATOS --------
            print "<img src=\"$nombre_ruta_foto\" alt=\"Foto usuario\" id=\"usuario_foto\">";
            print "<ul><li>Nombre.............: " . $nombre . "</li>";
            print "<li>Apellidos..........: " . $apellidos . "</li>";
            print "<li>Usuario............: " . $nombre_usuario . "</li>";
            print "<li>Clave..............: " . $contra . "</li>";
            print "<li>Email..............: " . $email . "</li>";
            print "<li>F. Nacimiento......: " . $fecha_nacimiento . "</li>";
            print "<li>Tipo de cuenta.....: " . $tipo_cuenta . "</li>";
            print "<li>Ganancias iniciales: " . $ganancias_iniciales . "</li>";
            print "<li>Teléfono...........: " . $tlf . "</li>";
            if ($condiciones) {
                print "<li>Condiciones de uso.: aceptadas</li>";
            } else {
                print "<li>Condiciones de uso.: rechazadas</li>";
            }
            if ($marketing == 'S') {
                print "<li>Publicidad.........:: aceptada</li>";
            } else {
                print "<li>Publicidad.........: rechazada</li></ul>";
            }
            print "</div>";
            ?>
            <br><a href='listUsu.php'>regresar</a>
        </div>
    <?php
}

// **************** Edición usuario ****************
if (isset($_POST['submit']) && $_GET['modo'] == "editar" && isset($_GET['id'])) {
    $pdo = conectar();
    $sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, nomusu = ?, clave = ?, email = ?, tel = ?, ganancias = ?, fechanac = ?, imgusu = ?, tipocu = ?, marketing = ? WHERE id = ?";
    $sentencia = $pdo->prepare($sql);
    $parametros = array($nombre, $apellidos, $nombre_usuario, $contraHashed, $email, $tlf, $ganancias_iniciales, $fecha_nacimiento, $nombre_ruta_foto, $tipo_cuenta, $marketing, $_GET['id']);
    $sentencia->execute($parametros);
    ?>
        <script>
            alert("Registro actualizado");
        </script>
    <?php
    header("Location: listUsu.php");
}

    ?>
    <!-- ***************************** HTML *****************************-->
    <div id="formout_container">
        <div id="formout_title_container">
            <div class="formin_title_container">
                <p class="p_grande"><?= ($_GET['modo'] == 'alta') ? 'CREACIÓN DE ' : 'MODIFICAR ' ?>USUARIO</p>
            </div>
            <div class="formin_title_container" id="logo_lotoplus_title">
                <p class="p_grande">LotoPlus</p>
                <img src="img/lotoplus.png" alt="Logo de LotoPlus" id="logo_lotoplus">
            </div>
        </div>
        <script>
            function togglePasswordVisibility(event) {
                event.preventDefault(); // Evitar que se envíe el formulario al hacer clic en la imagen.

                const passwordInput = document.getElementById('contra');
                const isPasswordVisible = passwordInput.type === "text"; // Cambiar el tipo de input entre "password" y "text".
                passwordInput.type = isPasswordVisible ? "password" : "text";

                const img = event.target; // Cambiar la imagen del botón según el estado
                img.src = isPasswordVisible ? "img/mostrarContra.png" : "img/ocultarContra.png"; // Cambia la ruta de la imagen de ocultar.
            }
        </script>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <div id="datos_form">
                <div class="formin_container">
                    <input type="text" maxlength="45" placeholder="Nombre" class="inputtxt_minsize" name="nombre" value="<?= ($_GET['modo'] == 'editar') ? $nombre : "" ?>" required>
                    <input type=" text" maxlength="65" placeholder="Apellidos" class="inputtxt_minsize" name="apellidos" value="<?= ($_GET['modo'] == 'editar') ? $apellidos : "" ?>" required>
                    <input type="text" minlength="3" maxlength="30" placeholder="Nombre de usuario" name="nombre_usuario" class="inputtxt_minsize" value="<?= ($_GET['modo'] == 'editar') ? $nombre_usuario : "" ?>" required>
                    <div id="contra_container">
                        <input type="password" minlength="4" maxlength="20" placeholder="Contraseña" id="contra" name="contra" required>
                        <input type="image" src="img/mostrarContra.png" alt="Mostrar/Ocultar contraseña" id="img-contra" onclick="togglePasswordVisibility(event)">
                    </div>
                    <input type="email" placeholder="Correo electrónico" class="inputtxt_minsize" name="email" value="<?= ($_GET['modo'] == 'editar') ? $email : "" ?>" required>
                </div>
                <div class="formin_container">
                    <div>
                        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                        <input type="text" id="fecha_nacimiento" placeholder="dd/mm/aaaa" name="fecha_nacimiento" value="<?= ($_GET['modo'] == 'editar') ? DateTime::createFromFormat('Y-m-d', $fecha_nacimiento)->format('d/m/Y') : "" ?>" required>
                    </div>
                    <div>
                        <label for="tipo_cuenta">Tipo de cuenta</label>
                        <select id="tipo_cuenta" name="tipo_cuenta">
                            <option value="gratuita" <?= ($_GET['modo'] == 'editar' && $tipo_cuenta == 'gratuita') ? 'selected' : '' ?>>Gratuita</option>
                            <option value="suscripcion" <?= ($_GET['modo'] == 'alta') ? 'selected' : '' ?><?= ($_GET['modo'] == 'editar' && $tipo_cuenta == 'suscripcion') ? 'selected' : '' ?>>Suscripci&oacuten</option>
                        </select>
                        <input type="number" placeholder="Ganancias iniciales" name="ganancias_iniciales" value="<?= ($_GET['modo'] == 'editar') ? $ganancias_iniciales : '' ?>">
                    </div>
                    <input type="tel" placeholder="Móvil" name="tlf" value="<?= ($_GET['modo'] == 'editar') ? $tlf : '' ?>" required>
                    <div>
                        <label for="img_perfil">Imagen de perfil</label>
                        <input type="file" id="img_perfil" accept=".jpg, .gif, .png" name="foto">
                    </div>
                    <!-- Imagen a mostrar al mostrar los datos a modificar  -->
                    <?php if ($_GET['modo'] == 'editar' && $nombre_ruta_foto): ?>
                        <div style="width: 100%;overflow:hidden;">
                            <img src="uploads/<?= $nombre_ruta_foto ?>" alt="Imagen de perfil" width="70" height="auto" style="float:right;">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <?php if ($_GET['modo'] == "alta") { ?>
                    <div>
                        <!-- Se devuelve el value on si está marcado -->
                        <input type="checkbox" id="condiciones" name="condiciones" required>
                        <label for="condiciones" id="lbl_condiciones">Acepto las condiciones de uso de LotoPlus.</label>
                    </div>
                <?php } ?>
                <div>
                    <input type="checkbox" id="marketing" name="marketing" <?= ($_GET['modo'] == 'editar' && $marketing == 'S') ? 'checked' : '' ?>>
                    <label for="marketing" id="lbl_marketing">Me gustaría recibir novedades de marketing de LotoPlus por correo electrónico.</label>
                </div>
            </div>
            <div id="botones_container">
                <button type="submit" id="btn_submit" name="submit"><?= ($_GET['modo'] == 'alta') ? 'CREAR ' : 'MODIFICAR ' ?>USUARIO</button>
                <button type="reset" id="btn_cancelar">CANCELAR</button>
            </div>
            <?php
            if ($_GET['modo'] == "alta") {
            ?>
                <div id="inicio_sesion">
                    <a class="p_peque" href="#">Inicio de sesión</a>
                </div>
            <?php } ?>
        </form>
    </div>
    <?php
    require("includes/pie.php");
    ?>