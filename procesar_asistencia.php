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

// Variable para contar asistencias guardadas
$asistencias_guardadas = 0;
$errores = [];

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
                $tipo_asistencia = $value; 

                // Guarda la asistencia en la base de datos
                $sql_insert = "INSERT INTO ASISTENCIAS (ciclo_lectivo, carrera, fecha, id_docente, nombre_apellido, tipo_asistencia, id_materia, denominacion_materia, nombres, dni_estudiante) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                
                if ($stmt_insert) {
                    $stmt_insert->bind_param('ssssssssss', $ciclo_lectivo, $carrera, $fecha, $id_docente, $nombre_apellido, $tipo_asistencia, $id_materia, $denominacion_materia, $nombres, $dni_estudiante);

                    // Ejecuta la inserción
                    if ($stmt_insert->execute()) {
                        $asistencias_guardadas++;
                    } else {
                        $errores[] = "Error al guardar la asistencia para el estudiante $nombres (DNI: $dni_estudiante). Error: " . $stmt_insert->error;
                    }
                } else {
                    $errores[] = "Error al preparar la consulta de inserción. Error: " . $conn->error;
                }
            } else {
                $errores[] = "No se encontró el estudiante (DNI: $dni_estudiante).<br>";
            }
        } else {
            $errores[] = "Error al preparar la consulta de selección del estudiante. Error: " . $conn->error;
        }
    }
}

// Cierra la conexión
$conn->close();

// Muestra un solo mensaje si se guardaron asistencias
if ($asistencias_guardadas > 0) {
    echo "Se guardaron $asistencias_guardadas asistencias correctamente.<br>";
}

// Muestra errores, si los hay
foreach ($errores as $error) {
    echo $error . "<br>";

} else {

    // Redirige a la página de asistencias después de 2 segundos
header("refresh:2; url=http://localhost/Sistema/asistencias.php");
exit; // Detiene la ejecución del script

}
?>
