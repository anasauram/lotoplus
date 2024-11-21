<?php
/*función conectar: se conecta a mysql, selecciona la base de datos y devuelve el identificador de conexión */
function conectar()
{
    global $HOSTNAME, $USERNAME, $PASSWORD, $DATABASE;
    try {
        $pdo = new PDO("mysql:host=$HOSTNAME;dbname=$DATABASE;charset=UTF8", $USERNAME, $PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexión exitosa";
    } catch (PDOException $e) {
        echo "Error de conexión con la base de datos: " . $e->getMessage();
    }
    return $pdo;
}
