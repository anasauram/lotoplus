<?php
require("includes/cabecera.php");

// Inicialización en caso de que no se haya registrado un error por exceso de tamaño de imagen subida.
if (!isset($errores)) {
    $errores = "";
}

// Si se abre la página habiendo pulsado el botón CREAR CUENTA se procederá a mostrar 
// los datos almacenados en el formulario.
if (isset($_POST['submit'])) {
    // Asignación a variables php de los datos introducidos en formulario.
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $contra = $_POST['contra'];
    $email = $_POST['email'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $tipo_cuenta = $_POST['tipo_cuenta'];
    $ganancias_iniciales = $_POST['ganancias_iniciales'];
    $tlf = $_POST['tlf'];
    $condiciones = $_POST['condiciones'] ?? false;
    $publicidad = $_POST['publicidad'] ?? false;
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

    $pdo = conectar();
    // Validación de nombre de usuario.
    if (existeUsu($nombre_usuario, $pdo)) {
        $errores .= "\nError: El usuario ya existe.";
    }
    // Validación de edad.
    if (!esMayorDeEdad($fecha_nacimiento)) {
        $errores .= "\nError: El usuario no es mayor de edad.";
    }

    // Si no hay algún error se registra el usuario.
    if (empty($errores)) {
        // **************** Alta usuario ****************
        $sql = "INSERT INTO usuarios(nombre, apellidos, nomusu, clave, email, tel, ganancias, fechanac, imgusu, tipocu, marketing) VALUES(?,?,?,?,?,?,?,?,?,?,?);";
        // Hasheo de contraseña para almacenarla hasheada.
        $contraHashed = password_hash($contra, PASSWORD_DEFAULT);
        // Protección de inyección de SQL con prepare.
        $sentencia = $pdo->prepare($sql);
        $parametros = array($nombre, $apellidos, $nombre_usuario, $contraHashed, $email, $tlf, $ganancias_iniciales, $fecha_nacimiento, $nombre_ruta_foto, $tipo_cuenta, $publicidad);
        $sentencia->execute($parametros);

        echo "<script>alert('Usuario creado correctamente');";
        // Refresco la pantalla para limpiar el formulario.
        echo "window.location.reload();</script>";
        exit;
    } else {
        // Muestro los errores si los hay.
        echo "\n\n\n\n\n" . $errores;
        echo "<script>alert('" . $errores . "');</script>";
    }
    // Si se abre la página sin venir de pulsar el botón CREAR CUENTA se muestra el formulario para cumplimentarlo.
}
?>
<!-- ***************************** HTML *****************************-->
<div id="formout_container">
    <div id="formout_title_container">
        <div class="formin_title_container">
            <p class="p_grande">CREAR CUENTA DE USUARIO</p>
        </div>
        <div class="formin_title_container" id="logo_lotoplus_title">
            <p class="p_grande">LotoPlus</p>
            <img src="img/lotoplus.png" alt="Logo de LotoPlus" id="logo_lotoplus">
        </div>
    </div>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <div id="datos_form">
            <div class="formin_container">
                <input type="text" maxlength="45" placeholder="Nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" class="inputtxt_minsize" name="nombre" value="<?= isset($nombre) ? $nombre : "" ?>" required>
                <input type="text" maxlength="65" placeholder="Apellidos" class="inputtxt_minsize" name="apellidos" value="<?= isset($apellidos) ? $apellidos : "" ?>" required>
                <input type="text" minlength="3" maxlength="30" placeholder="Nombre de usuario" pattern="[a-zA-Z0-9]+" name="nombre_usuario" class="inputtxt_minsize" value="<?= isset($nombre_usuario) ? $nombre_usuario : "" ?>" required>
                <!-- <div id="contra_container"> -->
                <input type="password" minlength="4" maxlength="20" placeholder="Contraseña" id="contra" name="contra"
                    pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+" value="<?= isset($contra) ? $contra : "" ?>" required>
                <!-- <input type="image" src="img/mostrarContra.png" alt="Mostrar/Ocultar contraseña" id="img-contra" onclick="togglePasswordVisibility(event)"> -->
                <!-- </div> -->
                <input type="email" placeholder="Correo electrónico" class="inputtxt_minsize" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" value="<?= isset($email) ? $email : "" ?>" required>
            </div>
            <div class="formin_container">
                <div>
                    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                    <input type="text" id="fecha_nacimiento" placeholder="dd/mm/aaaa" name="fecha_nacimiento" pattern="^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/\d{4}$" value="<?= isset($fecha_nacimiento) ? $fecha_nacimiento : "" ?>" required>
                </div>
                <div>
                    <label for="img_perfil">Imagen de perfil</label>
                    <input type="file" id="img_perfil" accept=".jpg, .gif, .png" name="foto">
                </div>
                <div>
                    <label for="tipo_cuenta">Tipo de cuenta</label>
                    <select id="tipo_cuenta" name="tipo_cuenta">
                        <option value="suscripcion" selected>Suscripci&oacuten</option>
                        <option value="gratuita" <?= isset($tipo_cuenta) && $tipo_cuenta == "gratuita" ? "selected" : "" ?>>Gratuita</option>
                    </select>
                    <input type="number" placeholder="Ganancias iniciales" step="0.01" name="ganancias_iniciales" value="<?= isset($ganancias_iniciales) ? $ganancias_iniciales : "" ?>">
                </div>
                <input type="tel" minlength="9" maxlength="9" placeholder="Móvil" name="tlf" value="<?= isset($tlf) ? $tlf : "" ?>" required>
            </div>
        </div>
        <div>
            <div>
                <input type="checkbox" id="condiciones" name="condiciones" required <?= isset($condiciones) && $condiciones == true  ? "checked" : false ?>>
                <label for="condiciones" id="lbl_condiciones">Acepto las condiciones de uso de LotoPlus.</label>
            </div>
            <div>
                <input type="checkbox" id="marketing" name="publicidad" <?= isset($publicidad) && $publicidad == true ? "checked" : false ?>>
                <label for="marketing" id="lbl_marketing">Me gustaría recibir novedades de marketing de LotoPlus por correo electrónico.</label>
            </div>
        </div>
        <div class="centrado">
            <button type="submit" class="btn_submit" name="submit">CREAR CUENTA</button>
            <button type="reset" class="btn_cancelar">CANCELAR</button>
        </div>
        <div class="centrado">
            <a class="p_peque" href="inicioSesion.php">Inicio de sesión</a>
        </div>
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
            $errores = "\nEl archivo subido supera el tamaño requerido.";
            ?>
        }
    });
</script>

<!-- Cambio de visibilidad de contraseña
    <script>
        function togglePasswordVisibility(event) {
            event.preventDefault(); // Evitar que se envíe el formulario al hacer clic en la imagen

            const passwordInput = document.getElementById('contra');
            const isPasswordVisible = passwordInput.type === "text"; // Cambiar el tipo de input entre "password" y "text"
            passwordInput.type = isPasswordVisible ? "password" : "text";

            const img = event.target; // Cambiar la imagen del botón según el estado
            img.src = isPasswordVisible ? "img/mostrarContra.png" : "img/ocultarContra.png"; // Cambia la ruta de la imagen de ocultar
        }
    </script> -->
<?php
require("includes/pie.php");
?>