<?php
require("includes/cabecera.php");

$idUsuarioError = "";
$idSorteoError = "";
$errorGeneral = "";

try {
    // Nos conectamos a la base de datos
    $pdo = conectar();

    // Si se envía el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idUsuario = $_POST['idUsuario'];
        $idSorteo = $_POST['idSorteo'];
        $importe = $_POST['importe'];

        // Verificamos si el usuario existe
        $sql = "SELECT COUNT(*) FROM usuarios WHERE idusuario = ?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute([$idUsuario]);
        if (!$consulta->fetchColumn()) {
            $idUsuarioError = "El usuario no existe.";
        }

        // Verificamos si el sorteo existe
        $sql = "SELECT COUNT(*) FROM sorteos WHERE idsorteo = ?";
        $consulta = $pdo->prepare($sql);
        $consulta->execute([$idSorteo]);
        if (!$consulta->fetchColumn()) {
            $idSorteoError = "El sorteo no existe.";
        }

        // Si no hay errores, se crea la participación
        if (!$idUsuarioError && !$idSorteoError) {
            // Se genera un número de participación único
            do {
                $numeroParticipacion = rand(100000, 999999); // Rango para el número aleatorio
                $sql = "SELECT COUNT(*) FROM participaciones WHERE numero = ?";
                $consulta = $pdo->prepare($sql);
                $consulta->execute([$numeroParticipacion]);
            } while ($consulta->fetchColumn() > 0);

            // Insertamos la nueva participación
            $sql = "INSERT INTO participaciones (idprop, idsorteo, numero, importe) VALUES (?, ?, ?, ?)";
            $consulta = $pdo->prepare($sql);
            $consulta->execute([$idUsuario, $idSorteo, $numeroParticipacion, $importe]);

            echo "Participación creada con éxito<br>";
            echo "Número de participación: $numeroParticipacion";
            echo "<p><a href='listPart.php'>Volver al listado</a></p>";
            exit;
        }
    }
} catch (Exception $e) {
    $errorGeneral = $e->getMessage();
}
?>

<h2>Nueva participación</h2>

<form method="POST">
    <?php if ($errorGeneral): ?>
        <p style="color: red;"><?= $errorGeneral ?></p>
    <?php endif; ?>

    <label for="idUsuario">ID Usuario:</label>
    <input type="number" id="idUsuario" name="idUsuario" value="<?= ($_POST['idUsuario'] ?? '') ?>" required>
    <span style="color: red;"><?= $idUsuarioError ?></span>
    <br><br>

    <label for="idSorteo">ID Sorteo:</label>
    <input type="number" id="idSorteo" name="idSorteo" value="<?= ($_POST['idSorteo'] ?? '') ?>" required>
    <span style="color: red;"><?= $idSorteoError ?></span>
    <br><br>

    <label for="importe">Importe:</label>
    <input type="number" id="importe" name="importe" step="0.01" value="<?= ($_POST['importe'] ?? '') ?>" required>
    <br><br>

    <button type="submit">Crear Participación</button>
</form>

<p><a href="listPart.php">Cancelar</a></p>

<?php require("includes/pie.php"); ?>
