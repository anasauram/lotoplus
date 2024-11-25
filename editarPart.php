<?php
require("includes/cabecera.php");

if (!isset($_GET['id'])) {
    header("Location: listPart.php");
    exit;
}

$id = $_GET['id'];

// Nos conectamos a mysql
$pdo = conectar();

// Recibimos la información de la participación
$sql = "SELECT * FROM participaciones WHERE idpart = ?";
$consulta = $pdo->prepare($sql);
$consulta->execute([$id]);
$participacion = $consulta->fetch();

if (!$participacion) {
    echo "Participación no encontrada <a href='listPart.php'>vuelve a la página anterior</a>";
    exit;
}

// Introducimos la información el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero = $_POST['numero'];
    $importe = $_POST['importe'];

    // Actualizar la participación
    $sql = "UPDATE participaciones SET numero = ?, importe = ? WHERE idpart = ?";
    $consulta = $pdo->prepare($sql);
    $consulta->execute([$numero, $importe, $id]);

    echo "Participación actualizada <a href='listPart.php'>vuelve al listado</a>";
    exit;
}

?>

<h2>Editar participación</h2>
<form method="POST">
    <label for="numero">Número de participación:</label>
    <input type="text" id="numero" name="numero" value="<?= $participacion['numero'] ?>"><br><br>

    <label for="importe">Importe:</label>
    <input type="text" id="importe" name="importe" value="<?= $participacion['importe'] ?>"><br><br>

    <button type="submit">Actualizar</button>
</form>

<p><a href="listPart.php">Cancelar</a></p>

<?php require("includes/pie.php"); ?>
