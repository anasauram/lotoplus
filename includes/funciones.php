<?php

/** Función conectar: se conecta a mysql, selecciona la base de datos y devuelve el identificador de conexión. */
function conectar()
{
    global $HOSTNAME, $USERNAME, $PASSWORD, $DATABASE;
    try {
        // Crear la conexión PDO
        $pdo = new PDO("mysql:host=$HOSTNAME;dbname=$DATABASE;charset=UTF8", $USERNAME, $PASSWORD);
        // Configurar el modo de error para excepciones
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;  // Si la conexión es exitosa, devuelve el objeto PDO
    } catch (PDOException $e) {
        // Si hay un error, muestra el mensaje y retorna null
        echo "Error de conexión con la base de datos: " . $e->getMessage();
        return null;  // Devolver null si la conexión falla
    }
}


/** Función existeUsu: comprueba que el usuario pasado por parámetro existe en la base de datos. 
 * @param string $nomUsu -> nombre de usuario a buscar en la base de datos.
 * @param int $id_usuario -> posible id de usuario. Valor predeterminado null.
 * @return bool true si hay algún usuario registrado con ese nombre de usuario; false si no.
 */
// function existeUsu($nomUsu, $id_usuario = null): bool
// {
//     $pdo = conectar();
//     $sql = "SELECT * FROM usuarios WHERE nomusu = ? AND (idusuario != ? OR ? IS NULL)";
//     $sentencia = $pdo->prepare($sql);
//     $sentencia->execute([$nomUsu, $id_usuario, $id_usuario]);
//     return $sentencia->rowCount() > 0;
// }

/** Función existeUsu: comprueba que el usuario pasado por parámetro existe en la base de datos. 
 * @param string $nomUsu -> nombre de usuario a buscar en la base de datos.
 * @param PDO $pdo -> conexión a base de datos.
 * @param int $id_usuario -> posible id de usuario. Valor predeterminado null.
 * @return bool true si hay algún usuario registrado con ese nombre de usuario; false si no.
 */
function existeUsu($nomUsu, $id_usuario = null): bool
{
    $pdo = conectar();
    $sql = "SELECT * FROM usuarios WHERE nomusu = ? AND (idusuario != ? OR ? IS NULL)";
    $sentencia = $pdo->prepare($sql);
    $sentencia->execute([$nomUsu, $id_usuario, $id_usuario]);
    return $sentencia->rowCount() > 0;
}

/**
 * Comprueba si una persona es mayor de edad según su fecha de nacimiento.
 * @param string $fechaNacimiento - Fecha de nacimiento en formato "YYYY-MM-DD".
 * @return bool - Retorna true si es mayor de edad, false si no lo es.
 */
function esMayorDeEdad($fechaNacimiento)
{
    $hoy = new DateTime();
    $nacimiento = DateTime::createFromFormat('d/m/Y', $fechaNacimiento);
    $edad = $hoy->diff($nacimiento)->y;     // Diferencia de años.
    return $edad >= 18;
}
