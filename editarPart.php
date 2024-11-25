<?php
require("includes/cabecera.php");

// Si no se encuentra ninguna id de participación vuelve automaticamente al listado
if (!isset($_GET['id'])) {
    header("Location: listPart.php");
    exit;
}

$id = $_GET['id'];

try {
    // Nos conectamos a la base de datos
    $pdo = conectar();

    // Obtenemos la participación
    $sql = "SELECT * FROM participaciones WHERE idpart = ?";
    $consulta = $pdo->prepare($sql);
    $consulta->execute([$id]);
    $participacion = $consulta->fetch();

    if (!$participacion) {
        throw new Exception("Participación no encontrada.");
    }

    // Si se envía el formulario, actualizamos la participación
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $numero = $_POST['numero'];
        $importe = $_POST['importe'];
    
        // Nos aseguramos de que los datos sean obligatoriamente numericos
        if (!is_numeric($numero) || !is_numeric($importe)) {
            echo "El número de participación y el importe deben ser números válidos.";
            exit;
        }
    
        // Actualizamos la participación
        $sql = "UPDATE participaciones SET numero = ?, importe = ? WHERE idpart = ?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute([$numero, $importe, $id]);
    
        echo "Participación actualizada <a href='listPart.php'>vuelve al listado</a>";
        exit;
    }
} catch (Exception $e) {
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<p><a href='listPart.php'>Volver al listado</a></p>";
    exit;
}
?>

<h2>Editar participación</h2>
<form method="POST">
    <label for="numero">Número de participación:</label>
    <input type="text" id="numero" name="numero" value="<?= $participacion['numero'] ?? '' ?>"><br><br>

    <label for="importe">Importe:</label>
    <input type="text" id="importe" name="importe" value="<?= $participacion['importe'] ?? '' ?>"><br><br>

    <button type="submit">Actualizar</button>
</form>

<p><a href="listPart.php">Cancelar</a></p>

<?php require("includes/pie.php"); ?>
