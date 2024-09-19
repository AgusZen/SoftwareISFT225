<?php
require('./conexion.php'); // Asegúrate de que este archivo contiene la conexión a la base de datos

// Verifica que los datos hayan sido enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera los datos del formulario
    $ciclo_lectivo = $_POST['ciclo_lectivo'];
    $carrera = $_POST['carrera'];
    $curso = $_POST['curso'];
    $materia = $_POST['materia'];
    $docente = $_POST['docente'];
    $fecha = $_POST['fecha'];

    // Lista de estudiantes, se iterarán para registrar su asistencia
    foreach ($_POST['estudiantes'] as $dni_estudiante => $asistencia) {
        // Asumiendo que cada estudiante tiene su asistencia marcada con "presente", "ausente" o "tarde"
        $estado_asistencia = $asistencia;

        // Preparar la consulta para insertar la asistencia
        $sql = "INSERT INTO ASISTENCIA (fecha, id_docente, tipo_asistencia, id_materia, id_estudiante)
                VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Asignar los valores a los placeholders
            $stmt->bind_param('sssss', $fecha, $docente, $estado_asistencia, $materia, $dni_estudiante);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Asistencia registrada correctamente para el estudiante con DNI: $dni_estudiante<br>";
            } else {
                echo "Error al registrar asistencia: " . $stmt->error;
            }

            // Cerrar la consulta preparada
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "No se recibieron datos del formulario.";
}
?>
