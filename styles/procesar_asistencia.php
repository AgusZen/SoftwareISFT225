<?php
session_start(); // Inicia la sesión al inicio del archivo

require('./conexion.php');

// Recibir los datos del formulario
$ciclo_electivo = $_POST['nombre_ciclo'];
$carrera = $_POST['nombre_carrera'];
$anio_carrera = $_POST['anio_carrera'];
$materia = $_POST['materia'];
$fecha = $_POST['fecha'];
$personal = $_POST['personal'];
$asistencias = $_POST['asistencia']; // Asegúrate de que esto sea un array

$conn->begin_transaction();

try {
    $sql_insert = "INSERT INTO asistencias (ciclo_electivo, nombre_carrera, anio_carrera, denominacion_materia, nombre_personal, dni_estudiante, fecha, tipo_asistencia) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);

    if (!$stmt_insert) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }

    // Bindeo de parámetros y ejecución de la consulta para cada estudiante
    foreach ($asistencias as $dni_estudiante => $tipo_asistencia) {
        // Aquí suponemos que $dni_estudiante es el identificador del estudiante y $tipo_asistencia es el tipo de asistencia
        $stmt_insert->bind_param("ssssssss", $ciclo_electivo, $carrera, $anio_carrera, $materia, $personal, $dni_estudiante, $fecha, $tipo_asistencia);
        if (!$stmt_insert->execute()) {
            throw new Exception("Error al insertar asistencia: " . $stmt_insert->error);
        }
    }

    // Commit de la transacción si todo salió bien
    $conn->commit();
    echo "Asistencias registradas exitosamente";

} catch (Exception $e) {
    // En caso de error, rollback de la transacción
    $conn->rollback();
    echo "Error: " . $e->getMessage();
} finally {
    $conn->close();
}
?>