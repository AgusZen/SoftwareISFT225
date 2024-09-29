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
$asistencias_guardadas = 0; // Contador que aumenta cuando se guardan las asistencias
$errores = []; // Vector que almacena los mensajes de error

// Procesa la asistencia de los estudiantes
foreach ($_POST as $key => $value) { // Recorre las clave-valor enviadas desde el formulario. Busca claves que empiecen con "asistencia_"
    if (strpos($key, 'asistencia_') !== false) { // Verifica si la clave contiene "asistencia_"
        // Extraer el DNI del estudiante desde el campo 'asistencia'
        $dni_estudiante = str_replace('asistencia_', '', $key);
        
        // Obtiene el nombre del estudiante usando el DNI
        $sql_estudiante = "SELECT nombres FROM ESTUDIANTES WHERE dni_estudiante = ?";
        $stmt_estudiante = $conn->prepare($sql_estudiante); // Prepara la consulta para evitar inyecciones SQL
        
        if ($stmt_estudiante) {
            $stmt_estudiante->bind_param('s', $dni_estudiante); // Vincula el parámetro de la consulta con el valor del DNI del estudiante.
            $stmt_estudiante->execute(); // Ejecuta la consulta
            $result_estudiante = $stmt_estudiante->get_result(); // Obtiene el resultado de la consulta
            $estudiante = $result_estudiante->fetch_assoc(); // Obtiene una fila del resultasdo como un vector asociatio
            
            // Verifica si existe el estudiante
            if ($estudiante) {
                $nombres = $estudiante['nombres'];
                $tipo_asistencia = $value; 

                // Guarda la asistencia en la base de datos
                $sql_insert = "INSERT INTO ASISTENCIAS (ciclo_lectivo, carrera, fecha, id_docente, nombre_apellido, tipo_asistencia, id_materia, denominacion_materia, nombres, dni_estudiante) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; // Consulta que inserta filas en la tabla "SISTENCIAS" con los datos proporcionados
                $stmt_insert = $conn->prepare($sql_insert);
                
                if ($stmt_insert) {
                    // Vincula los parámetros con los valores correspondientes. Las "s" indican que se trata de un string, las "i" un entero (revisar si se debe retornar todo a S)
                    $stmt_insert->bind_param('sssississi', $ciclo_lectivo, $carrera, $fecha, $id_docente, $nombre_apellido, $tipo_asistencia, $id_materia, $denominacion_materia, $nombres, $dni_estudiante); 

                    // Ejecuta la inserción en la base de datos
                    if ($stmt_insert->execute()) {
                        $asistencias_guardadas++; // Si hay éxito incrementa el contador
                    } else { // Si no hay éxito guarda un mensaje en el vector
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
}

if (empty($errores)) {
// Redirige a la página de asistencias después de 2 segundos
header("refresh:2; url=http://localhost/Sistema/asistencias.php");
exit; // Detiene la ejecución del script
}

?>
