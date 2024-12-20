<?php
require("includes/cabecera.php");

try {
    // Si no se encuentra ninguna id de participación vuelve automaticamente al listado
    if (!isset($_GET['id'])) {
        header("Location: listPart.php");
        exit;
    }

    $id = $_GET['id'];
    
    // Nos conectamos a la base de datos
    $pdo = conectar();

    // Obtenemos la información de la participación
    $sql = "SELECT * FROM participaciones WHERE idpart = ?";
    $consulta = $pdo->prepare($sql);
    $consulta->execute([$id]);
    $participacion = $consulta->fetch();

    if (!$participacion) {
        echo "Participación no encontrada <a href='listPart.php'>vuelve al listado</a>";
        exit;
    }

    // Se elimina la participación
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = "DELETE FROM participaciones WHERE idpart = ?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute([$id]);

        echo "Participación eliminada <a href='listPart.php'>vuelve al listado</a>";
        exit;
    }

} catch (Exception $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<p><a href='listPart.php'>Volver al listado</a></p>";
    exit;
}

?>

<h2>Eliminar participación</h2>
<p>¿Estás seguro de que quieres eliminar esta participación?</p>

<form method="POST">
    <button type="submit">Eliminar</button>
    <a href="listPart.php">Cancelar</a>
</form>

<?php require("includes/pie.php"); ?>
