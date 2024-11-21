<?php
$titulo = "Formulario LotoPlus";
require("includes/cabecera.php");

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

    // -------- FOTO --------
    // Comprobamos si se ha enviado un archivo (foto) para añadirla a la carpeta img de la página web.
    if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
        $nombre_foto = $_FILES['foto']['name'];
        $nombre_ruta_foto = "img/" . $nombre_foto;
        // Comprobamos que no haya un archivo con el mismo nombre que la foto subida.
        // Si lo hubiera le cambiamos el nombre para ponerle un identificador que lo haga único.
        if (is_file($nombre_ruta_foto)) {
            $nombre_foto = time() . $nombre_foto;
            $nombre_ruta_foto = "img/" . $nombre_foto;
        }
        // Movemos la foto de un fichero temporal a la carpeta img de la página web.
        move_uploaded_file($_FILES['foto']['tmp_name'], $nombre_ruta_foto);
    }

    // Comprobamos que no hay un usuario que ya exista con ese nombre de usuario.
    $array_usuarios = file('persistencia.txt');
    $existe_usuario = false;
    foreach ($array_usuarios as $usuario) {
        $array_usuario_datos = str_getcsv($usuario, '#');
        if ($array_usuario_datos[2] == $nombre_usuario) {
            $existe_usuario = true;
        }
    }

    if ($existe_usuario) {
        print "<p style=\"color:red;\">Error: El usuario ya existe.</p>";
    } else {
        // -------- PERSISTENCIA: CSV --------
        // Guardamos la información en un archivo csv para garantizar persistencia de datos.
        $linea = "$nombre#$apellidos#$nombre_usuario#$contra#$email#$fecha_nacimiento#$tipo_cuenta#$ganancias_iniciales#$tlf#$condiciones#$publicidad#$nombre_ruta_foto\n";
        $fichero_datos = fopen('persistencia.txt', 'a');
        fputs($fichero_datos, $linea);
        fclose($fichero_datos);
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
                if ($publicidad) {
                    print "<li>Publicidad.........:: aceptada</li>";
                } else {
                    print "<li>Publicidad.........: rechazada</li></ul>";
                }
                print "</div>";
                ?>
            </div>
        <?php
    }
    // Si se abre la página sin venir de pulsar el botón CREAR CUENTA se muestra el formulario para cumplimentarlo.
} else {
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
            <script>
                function togglePasswordVisibility(event) {
                    event.preventDefault(); // Evitar que se envíe el formulario al hacer clic en la imagen

                    const passwordInput = document.getElementById('contra');
                    const isPasswordVisible = passwordInput.type === "text"; // Cambiar el tipo de input entre "password" y "text"
                    passwordInput.type = isPasswordVisible ? "password" : "text";

                    const img = event.target; // Cambiar la imagen del botón según el estado
                    img.src = isPasswordVisible ? "img/mostrarContra.png" : "img/ocultarContra.png"; // Cambia la ruta de la imagen de ocultar
                }
            </script>

            <form action="registro.php" method="POST" enctype="multipart/form-data">
                <div id="datos_form">
                    <div class="formin_container">
                        <input type="text" maxlength="45" placeholder="Nombre" class="inputtxt_minsize" name="nombre" required>
                        <input type="text" maxlength="65" placeholder="Apellidos" class="inputtxt_minsize" name="apellidos" required>
                        <input type="text" minlength="3" maxlength="30" placeholder="Nombre de usuario" name="nombre_usuario" class="inputtxt_minsize" required>
                        <div id="contra_container">
                            <input type="password" minlength="4" maxlength="20" placeholder="Contraseña" id="contra" name="contra" required>
                            <input type="image" src="img/mostrarContra.png" alt="Mostrar/Ocultar contraseña" id="img-contra" onclick="togglePasswordVisibility(event)">
                        </div>
                        <input type="email" placeholder="Correo electrónico" class="inputtxt_minsize" name="email" required>
                    </div>
                    <div class="formin_container">
                        <div>
                            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                            <input type="text" id="fecha_nacimiento" placeholder="dd/mm/aaaa" name="fecha_nacimiento" required>
                        </div>
                        <div>
                            <label for="img_perfil">Imagen de perfil</label>
                            <input type="file" id="img_perfil" accept=".jpg, .gif, .png" name="foto">
                        </div>
                        <div>
                            <label for="tipo_cuenta">Tipo de cuenta</label>
                            <select id="tipo_cuenta" name="tipo_cuenta">
                                <option value="gratuita">Gratuita</option>
                                <option value="suscripcion" selected>Suscripci&oacuten</option>
                            </select>
                            <input type="number" placeholder="Ganancias iniciales" name="ganancias_iniciales">
                        </div>
                        <input type="tel" placeholder="Móvil" name="tlf" required>
                    </div>
                </div>
                <div>
                    <div>
                        <input type="checkbox" id="condiciones" name="condiciones" required>
                        <label for="condiciones" id="lbl_condiciones">Acepto las condiciones de uso de LotoPlus.</label>
                    </div>
                    <div>
                        <input type="checkbox" id="marketing" name="publicidad">
                        <label for="marketing" id="lbl_marketing">Me gustaría recibir novedades de marketing de LotoPlus por correo electrónico.</label>
                    </div>
                </div>
                <div id="botones_container">
                    <button type="submit" id="btn_submit" name="submit">CREAR CUENTA</button>
                    <button type="reset" id="btn_cancelar">CANCELAR</button>
                </div>
                <div id="inicio_sesion">
                    <a class="p_peque" href="#">Inicio de sesión</a>
                </div>
            </form>
        </div>
    <?php
    require("includes/pie.php");
}
    ?>