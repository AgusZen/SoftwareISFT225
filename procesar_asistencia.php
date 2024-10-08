<?php

/* Debugging: Verificar los datos que llegan a través del formulario
echo "<pre>";
print_r($_POST); // Muestra todo lo que llega por el formulario
echo "</pre>"; */

// Conexión a la base de datos
require('./conexion.php');

// Asignar variables
$ciclo_lectivo = $_POST['ciclo_lectivo'];
$carrera = $_POST['carrera'];
$fecha = $_POST['fecha'];
$id_docente = $_POST['docente'];
$nombre_apellido = $_POST['nombre_apellido'];
$id_materia = $_POST['materia'];
$denominacion_materia = $_POST['denominacion_materia'];
$asistencias = $_POST['asistencia']; // Este es un arreglo

// Inicializar contadores y errores
$asistencias_guardadas = 0;
$errores = [];

// Iniciar transacción
$conn->begin_transaction();

try {
    // Preparar la sentencia para obtener el nombre del estudiante
    $sql_estudiante = "SELECT nombres FROM ESTUDIANTES WHERE dni_estudiante = ?";
    $stmt_estudiante = $conn->prepare($sql_estudiante);
    if (!$stmt_estudiante) {
        throw new Exception("Error al preparar la consulta de selección del estudiante: " . $conn->error);
    }

    // Preparar la sentencia de inserción
    $sql_insert = "INSERT INTO ASISTENCIAS (ciclo_lectivo, carrera, fecha, id_docente, nombre_apellido, tipo_asistencia, id_materia, denominacion_materia, nombres, dni_estudiante) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    if (!$stmt_insert) {
        throw new Exception("Error al preparar la consulta de inserción: " . $conn->error);
    }

    // Iterar sobre las asistencias
    foreach ($asistencias as $dni_estudiante => $tipo_asistencia) {
        // Validar el tipo de asistencia
        $tipos_validos = ['Presente', 'Ausente', 'Tarde'];
        if (!in_array($tipo_asistencia, $tipos_validos)) {
            $errores[] = "Tipo de asistencia inválido para el estudiante con DNI $dni_estudiante.";
            continue;
        }

        // Obtener el nombre del estudiante
        $stmt_estudiante->bind_param('s', $dni_estudiante);
        $stmt_estudiante->execute();
        $result_estudiante = $stmt_estudiante->get_result();
        $estudiante = $result_estudiante->fetch_assoc();

        if ($estudiante) {
            $nombres = $estudiante['nombres'];
            
            // Vincular parámetros e insertar la asistencia
            $stmt_insert->bind_param(
                'sssississi',
                $ciclo_lectivo,
                $carrera,
                $fecha,
                $id_docente,
                $nombre_apellido,
                $tipo_asistencia,
                $id_materia,
                $denominacion_materia,
                $nombres,
                $dni_estudiante
            );

            if ($stmt_insert->execute()) {
                $asistencias_guardadas++;
            } else {
                $errores[] = "Error al guardar la asistencia para el estudiante $nombres (DNI: $dni_estudiante). Error: " . $stmt_insert->error;
            }
        } else {
            $errores[] = "No se encontró el estudiante con DNI: $dni_estudiante.";
        }
    }

    // Verificar si hubo errores
    if (count($errores) > 0) {
        // Revertir la transacción si hubo errores
        $conn->rollback();
        foreach ($errores as $error) {
            echo "<div class='alert alert-danger'>" . $error . "</div>";
        }
    } else {
        // Confirmar la transacción si todo fue exitoso
        $conn->commit();
        echo "<div class='alert alert-success'>Se guardaron $asistencias_guardadas asistencias correctamente.</div>";
    }

} catch (Exception $e) {
    // Revertir la transacción en caso de excepción
    $conn->rollback();
    echo "Se produjo un error: " . $e->getMessage();
}

// Cerrar las sentencias y la conexión
$stmt_estudiante->close();
$stmt_insert->close();
$conn->close();

// Redirigir si no hay errores
if (empty($errores)) {
    header("refresh:2; url=asistencias.php");
    exit;
}
?>
