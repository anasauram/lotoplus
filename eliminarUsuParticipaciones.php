<?php
require("includes/cabecera.php");

if (!isset($_GET['id'])) {
    header("Location: listUsu.php");
    exit;
}

$id = $_GET['id'];

try {
    $pdo = conectar();

    // Iniciar una transacción para asegurar consistencia
    $pdo->beginTransaction();

    // Eliminar participaciones asociadas al usuario
    $sql = "DELETE FROM participaciones WHERE idprop = ?";
    $stmtParticipaciones = $pdo->prepare($sql);
    $stmtParticipaciones->execute([$id]);

    // Eliminar el usuario
    $sql = "DELETE FROM usuarios WHERE idusuario = ?";
    $stmtUsuario = $pdo->prepare($sql);
    $stmtUsuario->execute([$id]);

    // Confirmar la transacción
    $pdo->commit();

    echo "Usuario y participaciones asociadas eliminados correctamente. <a href='listUsu.php'>Regresar</a>";
} catch (Exception $e) {
    // En caso de error, revertir la transacción
    $pdo->rollBack();
    echo "Error al eliminar el usuario: " . $e->getMessage() . ". <a href='listUsu.php'>Regresar</a>";
}
require("includes/pie.php");
