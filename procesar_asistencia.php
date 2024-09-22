<?php
// Conexión a la base de datos
require('./conexion.php');

// Recibe los datos del formulario
$ciclo_lectivo = $_POST['ciclo_lectivo'];
$carrera = $_POST['carrera'];
$fecha = $_POST['fecha'];
$id_docente = $_POST['id_docente'];
$nombre_apellido = $_POST['nombre_apellido'];
$id_materia = $_POST['id_materia'];
$denominacion_materia = $_POST['denominacion_materia'];

// Procesa la asistencia de los estudiantes
foreach ($_POST as $key => $value) {
    if (strpos($key, 'asistencia_') !== false) {
        // Extraer el DNI del estudiante desde el campo 'asistencia'
        $dni_estudiante = str_replace('asistencia_', '', $key);
        
        // Obtener el nombre del estudiante usando el DNI
        $sql_estudiante = "SELECT nombres FROM ESTUDIANTES WHERE dni_estudiante = ?";
        $stmt_estudiante = $conn->prepare($sql_estudiante);
        
        if ($stmt_estudiante) {
            $stmt_estudiante->bind_param('s', $dni_estudiante);
            $stmt_estudiante->execute();
            $result_estudiante = $stmt_estudiante->get_result();
            $estudiante = $result_estudiante->fetch_assoc();
            
            // Verifica si se encontró el estudiante
            if ($estudiante) {
                $nombres = $estudiante['nombres'];

                // El valor de la asistencia (Presente, Ausente, Tarde)
                $tipo_asistencia = $value; 

                // Guardar la asistencia en la base de datos
                $sql_insert = "INSERT INTO ASISTENCIAS (ciclo_lectivo, carrera, fecha, id_docente, nombre_apellido, tipo_asistencia, id_materia, denominacion_materia, nombres, dni_estudiante) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                
                if ($stmt_insert) {
                    $stmt_insert->bind_param('ssssssssss', $ciclo_lectivo, $carrera, $fecha, $id_docente, $nombre_apellido, $tipo_asistencia, $id_materia, $denominacion_materia, $nombres, $dni_estudiante);

                    if ($stmt_insert->execute()) {
                        echo "Asistencias guardadas correctamente.<br>";
                    } else {
                        echo "Error al guardar la asistencia para el estudiante $nombres (DNI: $dni_estudiante). Error: " . $stmt_insert->error . "<br>";
                    }
                } else {
                    echo "Error al preparar la consulta de inserción. Error: " . $conn->error . "<br>";
                }
            } else {
                echo "No se encontró el estudiante $nombre (DNI: $dni_estudiante).<br>";
            }
        } else {
            echo "Error al preparar la consulta de selección del estudiante. Error: " . $conn->error . "<br>";
        }
    }
}

// Cierra la conexión
$conn->close();
?>