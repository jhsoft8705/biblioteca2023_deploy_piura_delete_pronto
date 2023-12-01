<?php
require_once "conexion.php";

// Creamos una instancia de la clase Conectar
$db = new Conectar();
 // Llamamos a la función Conexion() para conectarnos a la base de datos
$con = $db->Conexion();

// Si la conexión es exitosa, mostrar mensaje
if ($con) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error al conectar a la base de datos.";
}
?>
