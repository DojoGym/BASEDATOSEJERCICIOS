<?php
// Datos de conexión a la base de datos MySQL en Aiven
$host = "exercicis-gym-exericisgym-0ad1.a.aivencloud.com";
$port = 20637;
$username = "avnadmin";
$password = "AVNS_rE2jRG9p6DfcjrpYkQV";
$database = "defaultdb";

// Conexión a la base de datos MySQL
$mysqli = new mysqli($host, $username, $password, $database, $port);

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$series = $_POST['series'];
$repeticiones = $_POST['repeticiones'];
$peso = isset($_POST['peso']) ? $_POST['peso'] : null;

// Preparar la consulta SQL para insertar el ejercicio
$sql = "INSERT INTO ejercicios (nombre, series, repeticiones, peso) VALUES (?, ?, ?, ?)";
if ($stmt = $mysqli->prepare($sql)) {
    // Vincular parámetros a la declaración preparada
    $stmt->bind_param("siii", $nombre, $series, $repeticiones, $peso);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        // Éxito al insertar el ejercicio
        echo "Ejercicio registrado exitosamente.";
    } else {
        // Error al ejecutar la declaración
        echo "Error al registrar el ejercicio: " . $mysqli->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    // Error al preparar la consulta SQL
    echo "Error al preparar la consulta: " . $mysqli->error;
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>
