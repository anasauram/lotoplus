<?php
require("includes/cabecera.php");

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idsorteo = $_POST['idsorteo'] ?? null;
    $nsorteo = $_POST['nsorteo'] ?? null;
    $fsorteo = $_POST['fsorteo'] ?? null;
    $descrip = $_POST['descrip'] ?? null;

    if (!is_numeric($idsorteo) || empty($nsorteo) || empty($fsorteo) || empty($descrip)) {
        $error = "Todos los campos son obligatorios y el ID del sorteo debe ser numérico";
    } else {
        try {
            $pdo = conectar();

            $sql = "INSERT INTO sorteos (idsorteo, nsorteo, fsorteo, descrip) 
                    VALUES (:idsorteo, :nsorteo, :fsorteo, :descrip)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'idsorteo' => $idsorteo,
                'nsorteo' => $nsorteo,
                'fsorteo' => $fsorteo,
                'descrip' => $descrip
            ]);

            $success = "Sorteo creado con éxito";
        } catch (Exception $e) {
            $error = "Error al crear el sorteo: " . $e->getMessage();
        }
    }
}
?>

<h2>Nuevo Sorteo</h2>
<form method="POST">
    <label for="idsorteo">ID Sorteo:</label>
    <input type="number" id="idsorteo" name="idsorteo" value="<?= htmlspecialchars($_POST['idsorteo'] ?? '') ?>" required>
    <br><br>

    <label for="nsorteo">Nombre del sorteo:</label>
    <input type="text" id="nsorteo" name="nsorteo" value="<?= htmlspecialchars($_POST['nsorteo'] ?? '') ?>" required>
    <br><br>

    <label for="fsorteo">Fecha del sorteo:</label>
    <input type="date" id="fsorteo" name="fsorteo" value="<?= htmlspecialchars($_POST['fsorteo'] ?? '') ?>" required>
    <br><br>

    <label for="descrip">Descripción:</label>
    <textarea id="descrip" name="descrip" required><?= htmlspecialchars($_POST['descrip'] ?? '') ?></textarea>
    <br><br>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <button type="submit">Guardar</button>
</form>

<p><a href="listSort.php"><button>Volver a lista de sorteos</button></a></p>

<?php
require("includes/pie.php");
?>
