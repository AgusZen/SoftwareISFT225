<?php
session_start(); // Comienza la sesión para poder usar datos de la misma si es necesario.

require('./conexion.php'); // Incluye el archivo de conexión a la base de datos.

// Recoge los datos que el usuario envió desde el formulario.
$ciclo_electivo = $_POST['nombre_ciclo'];
$carrera = $_POST['nombre_carrera'];
$anio_carrera = $_POST['anio_carrera'];
$materia = $_POST['materia'];
$fecha = $_POST['fecha'];
$personal = $_POST['personal'];
$asistencias = $_POST['asistencia']; // Este es un array que contiene las asistencias de los estudiantes.

// Inicia una transacción en la base de datos para asegurarse de que todo se guarde bien o nada.
$conn->begin_transaction();

try {
    // Prepara una consulta SQL para insertar los datos de asistencia en la base de datos.
    $sql_insert = "INSERT INTO asistencias (ciclo_electivo, nombre_carrera, anio_carrera, denominacion_materia, nombre_personal, dni_estudiante, fecha, tipo_asistencia) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);

    // Si hay un error al preparar la consulta, lanza una excepción.
    if (!$stmt_insert) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }

    // Recorre el array de asistencias y ejecuta la consulta para cada estudiante.
    foreach ($asistencias as $dni_estudiante => $tipo_asistencia) {
        // Vincula los datos del formulario con la consulta.
        $stmt_insert->bind_param("ssssssss", $ciclo_electivo, $carrera, $anio_carrera, $materia, $personal, $dni_estudiante, $fecha, $tipo_asistencia);
        
        // Ejecuta la consulta. Si falla, lanza una excepción.
        if (!$stmt_insert->execute()) {
            throw new Exception("Error al insertar asistencia: " . $stmt_insert->error);
        }
    }

    // Si todo sale bien, confirma (hace "commit") la transacción.
    $conn->commit();
    echo "Asistencias registradas exitosamente";

} catch (Exception $e) {
    // Si algo falla, deshace todo lo que se haya hecho hasta el momento (rollback).
    $conn->rollback();
    echo "Error: " . $e->getMessage();
} finally {
    // Cierra la conexión con la base de datos.
    $conn->close();
}

// Si no hubo errores, redirige al usuario a la página de asistencias después de 2 segundos.
if (empty($errores)) {
    header("refresh:2; url=asistencias.php");
    exit;
} 

?>
