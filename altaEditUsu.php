<?php
require("includes/cabecera.php");

// Si no hay modo o el modo asignado no es ni editar ni alta entonces no puede seguir.
if (!isset($_GET['modo']) || ($_GET['modo'] != 'editar' && $_GET['modo'] != 'alta')) {
    header("Location: listUsu.php");
    exit;
}
// Si no hay id en modo editar no puede seguir.
if (empty($_GET['id']) && $_GET['modo'] == "editar") {
    header("Location: listUsu.php");
    exit;
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
    $nacimiento = DateTime::createFromFormat('d/m/Y', $fecha_nacimiento)->format('Y-m-d');
    $tipo_cuenta = $_POST['tipo_cuenta'];
    $ganancias_iniciales = $_POST['ganancias_iniciales'];
    $tlf = $_POST['tlf'];
    $condiciones = $_POST['condiciones'] ?? false;
    $marketing = (isset($_POST['marketing']) ? 'S' : 'N') ?? false;

    // -------- FOTO --------
    // Comprobamos si se ha enviado un archivo (foto) para añadirla a la carpeta img de la página web.
    try {
        if (isset($_FILES['subida']) && is_uploaded_file($_FILES['subida']['tmp_name'])) {
            $nombre_foto = $_FILES['subida']['name'];
            $nombre_ruta_foto = "uploads/" . $nombre_foto;

            // Comprobamos que no haya un archivo con el mismo nombre que la foto subida.
            if (is_file($nombre_ruta_foto)) {
                $nombre_foto = time() . "_" . $nombre_foto;
                $nombre_ruta_foto = "uploads/" . $nombre_foto;
            }

            // Movemos la foto de un fichero temporal a la carpeta uploads de la página web.
            move_uploaded_file($_FILES['subida']['tmp_name'], $nombre_ruta_foto);
        } else {
            // Si no se subió una nueva imagen, conserva la ruta anterior
            $nombre_ruta_foto = $_POST['foto'];
        }
    } catch (Exception $e) {
        $errores[] = "Error: Ha habido un problema con la imagen de usuario.";
    }


    // Validación de nombre de usuario.
    if ($_GET['modo'] == 'alta' && existeUsu($nombre_usuario)) {
        $errores[] = "Error: El usuario ya existe.";
    }
    // En el modo edición pasar el mismo nombre de usuario puede traer error sin pasar el id del usuario.
    if ($_GET['modo'] == 'editar' && existeUsu($nombre_usuario, $_GET['id'])) {
        $errores[] = "Error: El usuario ya existe.";
    }
    // Validación de edad.
    if (!esMayorDeEdad($fecha_nacimiento)) {
        $errores[] = "Error: El usuario no es mayor de edad.";
    }
}

// Si no hay algún error se evalúa si dar de alta a usuario, modificarlo o mostrar formulario.
if (empty($errores)) {
    // **************** Alta usuario ****************
    if (isset($_POST['submit']) && $_GET['modo'] == "alta") {
        $pdo = conectar();
        $sql = "INSERT INTO usuarios(nombre, apellidos, nomusu, clave, email, tel, ganancias, fechanac, imgusu, tipocu, marketing) VALUES(?,?,?,?,?,?,?,?,?,?,?);";
        $sentencia = $pdo->prepare($sql);
        $parametros = array($nombre, $apellidos, $nombre_usuario, $contraHashed, $email, $tlf, $ganancias_iniciales, $nacimiento, $nombre_ruta_foto, $tipo_cuenta, $marketing);
        $sentencia->execute($parametros);
?>
        <div>
            <h2>CUENTA CREADA</h2>
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
        exit;
    }

    // **************** Edición usuario ****************
    if (isset($_POST['submit']) && $_GET['modo'] == "editar") {
        $pdo = conectar();
        $sql = "UPDATE usuarios SET nombre = ?, apellidos = ?, nomusu = ?, clave = ?, email = ?, tel = ?, ganancias = ?, fechanac = ?, imgusu = ?, tipocu = ?, marketing = ? WHERE idusuario = ?";
        $sentencia = $pdo->prepare($sql);
        $parametros = array($nombre, $apellidos, $nombre_usuario, $contraHashed, $email, $tlf, $ganancias_iniciales, $nacimiento, $nombre_ruta_foto, $tipo_cuenta, $marketing, $_GET['id']);
        $sentencia->execute($parametros);
        ?>
            <script>
                alert("Registro actualizado");
            </script>
    <?php
        header("Location: listUsu.php");
        exit;
    }
}

// Mostrar datos a modificar en modo editar.
if (!isset($_POST['submit']) && $_GET['modo'] == "editar" && isset($_GET['id'])) {
    $pdo = conectar();
    $sql = "SELECT `nombre`, `apellidos`, `nomusu`, `clave`, `email`, `tel`, `ganancias`, `fechanac`, `imgusu`, `tipocu`, `marketing`, `tipousu` FROM `usuarios` WHERE `idusuario`= ?";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute([$_GET['id']]);

    // Si no hay registro se vuelve al listado de usuarios.
    if ($sentencia->rowCount() === 0) {
        header("Location: listUsu.php");
        exit;
    } else {
        // Si hay registro se muestra.
        $linea = $sentencia->fetch(PDO::FETCH_ASSOC);
        $nombre = $linea['nombre'];
        $apellidos = $linea['apellidos'];
        $nombre_usuario = $linea['nomusu'];
        $email = $linea['email'];
        $tlf = $linea['tel'];
        $ganancias_iniciales = $linea['ganancias'];
        $fecha_nacimiento = DateTime::createFromFormat('Y-m-d', $linea['fechanac'])->format('d/m/Y');
        $nombre_ruta_foto = $linea['imgusu'];
        $tipo_cuenta = $linea['tipocu'];
        $marketing = $linea['marketing'];
        $contraHashed = $linea['clave'];
    }
}

// Variable necesaria para que el formulario la ejecute como acción al hacer submit.
$ruta = $_SERVER['PHP_SELF'] . "?modo=" . $_GET['modo'];
if (isset($_GET['id'])) {
    $ruta .= "&id=" . $_GET['id'];
}
    ?>
    <!-- ***************************** HTML ***************************** -->
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
        <form action="<?= $ruta ?>" method="POST" enctype="multipart/form-data">
            <div id="datos_form">
                <div class="formin_container">
                    <input type="text" maxlength="45" placeholder="Nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" class="inputtxt_minsize" name="nombre" value="<?= ($_GET['modo'] == 'editar') ? $nombre : "" ?>" required>
                    <input type=" text" maxlength="65" placeholder="Apellidos" class="inputtxt_minsize" name="apellidos" value="<?= ($_GET['modo'] == 'editar') ? $apellidos : "" ?>" required>
                    <input type="text" minlength="3" maxlength="30" placeholder="Nombre de usuario" name="nombre_usuario" class="inputtxt_minsize" pattern="[a-zA-Z0-9]+" value="<?= ($_GET['modo'] == 'editar') ? $nombre_usuario : "" ?>" required>
                    <div id="contra_container">
                        <input type="password" minlength="4" maxlength="20" placeholder="Contraseña" id="contra" name="contra"
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+" required>
                        <input type="image" src="img/mostrarContra.png" alt="Mostrar/Ocultar contraseña" id="img-contra" onclick="togglePasswordVisibility(event)">
                    </div>
                    <input type="email" placeholder="Correo electrónico" class="inputtxt_minsize" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                        value="<?= ($_GET['modo'] == 'editar') ? $email : "" ?>" required>
                </div>
                <div class="formin_container">
                    <div>
                        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                        <input type="text" id="fecha_nacimiento" placeholder="dd/mm/aaaa" name="fecha_nacimiento" pattern="^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/\d{4}$"
                            value="<?= ($_GET['modo'] == 'editar') ? $fecha_nacimiento : "" ?>" required>
                    </div>
                    <div>
                        <label for="tipo_cuenta">Tipo de cuenta</label>
                        <select id="tipo_cuenta" name="tipo_cuenta">
                            <option value="gratuita" <?= ($_GET['modo'] == 'editar' && $tipo_cuenta == 'gratuita') ? 'selected' : '' ?>>Gratuita</option>
                            <option value="suscripcion" <?= ($_GET['modo'] == 'alta') ? 'selected' : '' ?><?= ($_GET['modo'] == 'editar' && $tipo_cuenta == 'suscripcion') ? 'selected' : '' ?>>Suscripci&oacuten</option>
                        </select>
                        <input type="number" placeholder="Ganancias iniciales" step="0.01" name="ganancias_iniciales" value="<?= ($_GET['modo'] == 'editar') ? $ganancias_iniciales : '' ?>">
                    </div>
                    <input type="tel" minlength="9" maxlength="9" placeholder="Móvil" name="tlf" value="<?= ($_GET['modo'] == 'editar') ? $tlf : '' ?>" $pattern='/^(9[1-9][0-9]{7}|6[0-9]{8}|7[0-9]{8})$/' ; required>
                    <div>
                        <label for="img_perfil">Imagen de perfil</label>
                        <input type="file" id="img_perfil" accept=".jpg, .gif, .png" name="subida">
                    </div>
                    <!-- Ruta de foto de bd  -->
                    <input type="hidden" name="foto" value="<?= ($_GET['modo'] == 'editar') ? $nombre_ruta_foto : "" ?>">
                    <!-- Imagen a mostrar al mostrar los datos a modificar  -->
                    <?php if ($_GET['modo'] == 'editar' && $nombre_ruta_foto): ?>
                        <div style="width: 100%;overflow:hidden;">
                            <img src="uploads/<?= $nombre_ruta_foto ?>" alt="Imagen de perfil" width="70" height="auto" style="float:right;" name="foto_perfil">
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
            <div class="centrado">
                <button type="submit" class="btn_submit" name="submit"><?= ($_GET['modo'] == 'alta') ? 'CREAR ' : 'MODIFICAR ' ?>USUARIO</button>
                <button type="reset" class="btn_cancelar">CANCELAR</button>
            </div>
            <?php
            if ($_GET['modo'] == "alta") {
            ?>
                <div class="centrado">
                    <a class="p_peque" href="#">Inicio de sesión</a>
                </div>
            <?php
            }
            // Muestro los errores si los hay.
            if (!empty($errores)) {
                echo "<p style=\"color:red; text-align: center;\">";
                foreach ($errores as $error) {
                    echo $error;
                }
                echo "</p>";
            }

            ?>

        </form>
    </div>

    <!-- *********************** SCRIPTS *********************** -->
    <!-- Control de tamaño máximo de archivo subido -->
    <script>
        document.getElementById('myForm').addEventListener('submit', function(e) {
            var file = document.getElementById('img_perfil').files[0];

            // Tamaño máximo permitido (en bytes).
            var maxSize = 4096 * 1024; // 4096KB

            if (file.size > maxSize) {
                e.preventDefault(); // Detener el envío del formulario
                <?php
                $errores[] = "El archivo subido supera el tamaño requerido";
                ?>
            }
        });
    </script>

    <!-- Cambio de visibilidad de contraseña -->
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
    <?php
    require("includes/pie.php");
    ?>