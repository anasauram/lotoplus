<?php

/** Función conectar: se conecta a mysql, selecciona la base de datos y devuelve el identificador de conexión. */
function conectar()
{
    global $HOSTNAME, $USERNAME, $PASSWORD, $DATABASE;
    try {
        $pdo = new PDO("mysql:host=$HOSTNAME;dbname=$DATABASE;charset=UTF8", $USERNAME, $PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error de conexión con la base de datos: " . $e->getMessage();
    }
    return $pdo;
}

/** Función existeUsu: comprueba que el usuario pasado por parámetro existe en la base de datos. */
function existeUsu($nomUsu): bool
{
    $pdo = conectar();
    $sql = "SELECT 1 FROM usuarios WHERE nomusu = ?";
    $sentencia = $pdo->prepare($sql);
    $sentencia->bindValue(0, $nomUsu, PDO::PARAM_STR);
    $sentencia->execute();
    // fetchColumn devuelve el resultado de una sola columna de una fila, en este caso o 1 o false.
    return $sentencia->fetchColumn() !== false;
}
