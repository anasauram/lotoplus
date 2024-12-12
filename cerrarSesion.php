<?php
session_start();

if (isset($_SESSION['idusuario_valido'])) {
    unset($_SESSION['idusuario_valido']);
    unset($_SESSION['usuario_valido']);
    session_destroy();
    $datosSesion = session_get_cookie_params();
    setcookie(session_name(), "", 0, $datosSesion["path"], $datosSesion["domain"]);
}
header("Location: inicioSesion.php");
exit;
