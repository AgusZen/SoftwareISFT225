<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Asistencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/estudiantes.css">
</head>
<body>
    <?php
    include "variablesPath.php"; // Define rutas de acceso
    require(rutas::$pathConection); // Ruta de la conexión a la base de datos

    // Función que recibe una conexión y una consulta SQL, la ejecuta y devuelve resultados como vector
    function traerDatos($conn, $sql) {
        $result = $conn->query($sql); // Ejecuta la consulta
        if ($result == true) { // Verifica 
            return $result->fetch_all(MYSQLI_ASSOC); // Devuelve resultados como vector
        } else { // Si hay problema, lanza mensaje de error
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }
    }

    try { // Estructura de manejo de errores
        if (!$conn) { // Si la conexión no se establece
            throw new Exception("Error en la conexión a la base de datos");
        }
        // Obtención de datos provenientes de las respectivas tablas a través de la función "traerDatos"
        $ciclos = traerDatos($conn, "SELECT id_ciclo_electivo, nombre_ciclo FROM ciclo_electivo");
        $carreras = traerDatos($conn, "SELECT nombre_carrera FROM CARRERA");
        $materias = traerDatos($conn, "SELECT denominacion_materia FROM MATERIA");
        $docentes = traerDatos($conn, "SELECT nombre_personal FROM PERSONAL");
        $estudiantes = traerDatos($conn, "SELECT dni_estudiante, nombre, apellido FROM ESTUDIANTES");

    } catch (Exception $e) {
        $mensaje = $e->getMessage(); // Obtiene el mensaje de error y lo muestra con Bootstrap
        echo "<div class='alert alert-danger'>$mensaje</div>";
    } finally { // Cierra la conexión
        $conn->close();
    }

    include(rutas::$pathNuevoHeader); // Ruta que muestra el header de la página
    ?>

<main>
    <!-- Formulario para registrar la asistencia de los estudiantes -->
    <form class="d-block p-3 m-4 h-100 formulario" name="formulario" method="POST" action="procesar_asistencia.php" novalidate>
        <h2 class="card-footer-text mt-2 mb-4 p-2">Asistencias</h2>

        <div class="filas"> <!-- Requerimiento para buena función de las clases de abajo -->
            <div class="fila"> <!-- Un campo al lado del otro -->
                <div class="columna"> <!-- Un campo arriba de otro -->
                    <label for="nombre_ciclo" class="form-label">Ciclo Lectivo</label> <!-- Etiqueta para el campo -->
                    <select id="nombre_ciclo" name="nombre_ciclo" class="form-select" required> <!-- Lista desplegable para el campo e identificadores -->
                        <option hidden value="">Seleccione un ciclo lectivo</option>
                        <?php foreach ($ciclos as $ciclo): ?>
                            <option value="<?php echo ($ciclo['nombre_ciclo']); ?>">
                                <?php echo ($ciclo['nombre_ciclo']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un ciclo.
                    </div>
                </div>

                <div class="columna"> <!-- Un campo arriba de otro -->
                    <label for="nombre_carrera" class="form-label">Carrera</label> <!-- Etiqueta para el campo -->
                    <select class="form-select" name="nombre_carrera" id="nombre_carrera" required> <!-- Lista desplegable para el campo e identificadores -->
                        <option hidden value="">Seleccione una carrera</option>
                        <?php foreach ($carreras as $carrera): ?> <!-- Itera sobre el vector "carreras" obtenido de la base de datos y crea una opción por cada carrera -->
                            <option value="<?php echo ($carrera['nombre_carrera']); ?>"> <!-- Valor de la opción -->
                                <?php echo ($carrera['nombre_carrera']); ?> <!-- Texto que muestra -->
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione una carrera.
                    </div>
                </div>
            </div>
        </div>

        <div class="filas">
            <div class="fila">
                <div class="columna">
                    <label for="anio_carrera" class="form-label">Año</label>
                    <select id="anio_carrera" name="anio_carrera" class="form-select" required>
                        <option hidden value="">Seleccione un año</option>
                        <option value="1">Año 1</option>
                        <option value="2">Año 2</option>
                        <option value="3">Año 3</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un curso.
                    </div>
                </div>

                <div class="columna">
                    <label for="materia" class="form-label">Materia</label>
                    <select class="form-select" name="materia" id="materia" required>
                        <option hidden value="">Seleccione una materia</option>
                        <?php foreach ($materias as $materia): ?>
                            <option value="<?php echo ($materia['denominacion_materia']); ?>">
                                <?php echo ($materia['denominacion_materia']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione una materia.
                    </div>
                </div>
            </div>
        </div>

        <div class="filas">
            <div class="fila">
                <div class="columna">
                    <label for="personal" class="form-label">Profesor</label>
                    <select class="form-select" name="personal" id="personal" required>
                        <option hidden value="">Seleccione un profesor</option>
                        <?php foreach ($docentes as $personal): ?>
                            <option value="<?php echo ($personal['nombre_personal']); ?>">
                                <?php echo ($personal['nombre_personal']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un profesor.
                    </div>
                </div>

                <div class="columna">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required> <!-- Selecciona fecha a través de calendario -->
                    <div class="invalid-feedback">
                        Por favor, seleccione una fecha.
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Estudiantes -->
        <div class="mb-3">
            <label for="estudiantes" class="form-label">Estudiantes</label>

            <!-- Botones para "marcar todos" con estilización -->
            <div class="d-flex justify-content-end mb-2 gap-2">
                <button type="button" id="marcar-todos-presentes" class="btn btn-sm btn-outline-success">Presentes(T)</button>
                <button type="button" id="marcar-todos-ausentes" class="btn btn-sm btn-outline-danger">Ausentes(T)</button>
                <button type="button" id="marcar-todos-tarde" class="btn btn-sm btn-outline-warning">Tardes(T)</button>
            </div>

            <table class="table table-bordered table-hover table-responsive d-none" id="tabla-estudiantes">
                <thead class="table-light">
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Presente</th>
                        <th>Ausente</th>
                        <th>Tarde</th>
                    </tr>
                </thead>
                <tbody id="tabla-estudiantes-body">
                    <?php
                    if (count($estudiantes) > 0) { // Verifica si existen estudiantes
                        foreach ($estudiantes as $estudiante): ?> <!-- Itera sobre cada estudiante para crear una fila -->
                            <tr>
                                <td><?php echo ($estudiante['dni_estudiante']); ?></td> <!-- Muestra DNI -->
                                <td><?php echo ($estudiante['nombre']); ?></td> <!-- Muestra nombre -->
                                <td><?php echo ($estudiante['apellido']); ?></td> <!-- Muestra apellido -->
                                <td class="text-center"> <!-- Opciones para marcar presente, ausente o tarde -->
                                    <input type="radio" name="asistencia[<?php echo ($estudiante['dni_estudiante']); ?>]" value="Presente" required>
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="asistencia[<?php echo ($estudiante['dni_estudiante']); ?>]" value="Ausente">
                                </td>
                                <td class="text-center">
                                    <input type="radio" name="asistencia[<?php echo ($estudiante['dni_estudiante']); ?>]" value="Tarde">
                                </td>
                            </tr>
                        <?php endforeach;
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No se encontraron estudiantes.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
    </form>
</main>

    <!-- Librerías -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-oP9ZBPtW4NG/O8EihkQBEI2gL3V8fEr6ioJPxB3frSSAt0tSTblZw3D6tds6dU8B" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9IbYyI2ZzyuT3iNUy0XtcmM8l9F4Y5du2vs7X6CRl2H5Yk4Z8/J" crossorigin="anonymous"></script>

    <script>
    document.addEventListener("DOMContentLoaded", () => {  // Ejecuta el código cuando todo el DOM esté completamente cargado
    // Cacheo de elementos del DOM para facilitar su uso sin buscarlos cada vez
    const selectMateria = document.getElementById("materia"); 
    const tablaEstudiantes = document.getElementById("tabla-estudiantes");
    const tablaEstudiantesBody = document.getElementById("tabla-estudiantes-body");
    const btnMarcarTodosPresentes = document.getElementById("marcar-todos-presentes");
    const btnMarcarTodosAusentes = document.getElementById("marcar-todos-ausentes");
    const btnMarcarTodosTarde = document.getElementById("marcar-todos-tarde");
    const form = document.querySelector('form'); // Referencia al formulario para validación

        // Validación del formulario con Bootstrap al enviarse
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) { // Verifica si el formulario es válido
                event.preventDefault();  // Evita el envío del formulario si no es válido
                event.stopPropagation(); // Detiene la propagación del evento
            }
            form.classList.add('was-validated'); // Añade clase de validación de Bootstrap para mostrar mensajes
        });

        // Función para mostrar u ocultar la tabla de estudiantes
        const VisibilidadTabla = (mostrar) => {
            tablaEstudiantes.classList.toggle('d-none', !mostrar); // Añade o quita la clase d-none para mostrar u ocultar la tabla
        };

        // Función que construye el HTML de cada fila de estudiante, con opciones de asistencia (dinamismo)
        const construirFilaHTML = ({ dni_estudiante, nombre, apellido }) => `
            <tr>
                <td>${dni_estudiante}</td> <!-- Mostrar DNI del estudiante -->
                <td>${nombre}</td> <!-- Mostrar nombre del estudiante -->
                <td>${apellido}</td> <!-- Mostrar apellido del estudiante -->
                <td class="text-center">
                    <input type="radio" name="asistencia[${dni_estudiante}]" value="Presente" id="presente_${dni_estudiante}" required> <!-- Radio de asistencia Presente -->
                    <label for="presente_${dni_estudiante}">Presente</label>
                </td>
                <td class="text-center">
                    <input type="radio" name="asistencia[${dni_estudiante}]" value="Ausente" id="ausente_${dni_estudiante}"> <!-- Radio de asistencia Ausente -->
                    <label for="ausente_${dni_estudiante}">Ausente</label>
                </td>
                <td class="text-center">
                    <input type="radio" name="asistencia[${dni_estudiante}]" value="Tarde" id="tarde_${dni_estudiante}"> <!-- Radio de asistencia Tarde -->
                    <label for="tarde_${dni_estudiante}">Tarde</label>
                </td>
            </tr>`;

        // Carga de estudiantes según la materia seleccionada
        const cargarEstudiantes = (materiaSeleccionada) => {
            const estudiantes = <?php echo json_encode($estudiantes); ?>; // Obtiene datos de estudiantes desde la base de datos
            tablaEstudiantesBody.innerHTML = estudiantes.length > 0 // Verifica si hay estudiantes para mostrar
                ? estudiantes.map(construirFilaHTML).join('') // Si hay estudiantes, construye filas con sus datos
                : "<tr><td colspan='5' class='text-center'>No se encontraron estudiantes.</td></tr>"; // Mensaje si no hay estudiantes
            VisibilidadTabla(estudiantes.length > 0); // Mostrar u ocultar la tabla según haya o no estudiantes
        };

        // Función para limpiar la tabla de estudiantes
        const limpiarTablaEstudiantes = () => {
            tablaEstudiantesBody.innerHTML = ""; // Elimina el contenido de la tabla
            VisibilidadTabla(false); // Oculta la tabla después de limpiarla
        };

        // Función para marcar todos los estudiantes con un tipo de asistencia específico (Presente, Ausente, Tarde)
        const marcarTodos = (tipo) => {
            const radios = tablaEstudiantesBody.querySelectorAll(`input[type="radio"][value="${tipo}"]`); // Seleccionar todos los radios que coincidan con el tipo
            radios.forEach(radio => radio.checked = true); // Marcar cada radio seleccionado
        };

        // Asigna eventos a los botones para marcar todos los estudiantes con el tipo seleccionado
        btnMarcarTodosPresentes.addEventListener("click", () => marcarTodos('Presente'));
        btnMarcarTodosAusentes.addEventListener("click", () => marcarTodos('Ausente'));
        btnMarcarTodosTarde.addEventListener("click", () => marcarTodos('Tarde'));

        // Evento para el cambio de materia en el selector
        selectMateria.addEventListener("change", (e) => {
            const materiaSeleccionada = e.target.value; // Obtener el valor de la materia seleccionada
            materiaSeleccionada ? cargarEstudiantes(materiaSeleccionada) : limpiarTablaEstudiantes(); // Cargar estudiantes o limpiar la tabla
        });
    });

    </script>
</body>
</html>