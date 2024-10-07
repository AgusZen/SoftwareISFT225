<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Metadato para que la página sea responsiva en dispositivos móviles. -->
    <title>Asistencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <?php
    // Crea la conexión
    require('./conexion.php'); // Incluye el archivo de la conexión a la base de datos
    include "header.php"; // Incluye el archivo del header principal

    function obtenerDatos($conn, $sql) {
        $result = $conn->query($sql);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("Error en la consulta SQL: " . $conn->error);
        }
    }

    try {
        if (!$conn) {
            throw new Exception("Error en la conexión a la base de datos");
        }

        $carreras = obtenerDatos($conn, "SELECT nombre_carrera FROM CARRERA");
        $cursadas = obtenerDatos($conn, "SELECT anio FROM CURSADA");
        $materias = obtenerDatos($conn, "SELECT id_materia, denominacion_materia FROM MATERIA");
        $docentes = obtenerDatos($conn, "SELECT id_docente, nombre_apellido FROM DOCENTE");
        $estudiantes = obtenerDatos($conn, "SELECT dni_estudiante, nombres FROM ESTUDIANTES");

    } catch (Exception $e) {
        $mensaje = $e->getMessage();
        echo "<div class='alert alert-danger'>$mensaje</div>";
    } finally {
        $conn->close(); // Cierra la conexión siempre
    }

    // Asegurarse de que las variables ocultas están definidas
    $id_docente = isset($id_docente) ? htmlspecialchars($id_docente) : '';
    $nombre_apellido = isset($nombre_apellido) ? htmlspecialchars($nombre_apellido) : '';
    $id_materia = isset($id_materia) ? htmlspecialchars($id_materia) : '';
    $denominacion_materia = isset($denominacion_materia) ? htmlspecialchars($denominacion_materia) : '';
    ?>

    <main>
        <div class="d-flex flex-nowrap sidebar-height"> 
            <?php include "sidebar.php"; ?> <!-- Muestra la barra lateral -->
            <div class="col-9 offset-3 bg-light-subtle pt-5"> 
                <div class="d-block p-3 m-4 h-100">
                    <h2 class="card-footer-text mt-2 mb-5 p-2">Asistencias</h2>

                    <!-- Mensajes de error o éxito -->
                    <?php if (isset($mensaje)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($mensaje); ?></div>
                    <?php endif; ?>

                    <form action="procesar_asistencia.php" method="post" class="needs-validation" novalidate> <!-- Añadido validación Bootstrap -->

                        <div class="mb-3">
                            <label for="ciclo_lectivo" class="form-label">Ciclo Lectivo</label>
                            <input type="text" class="form-control" id="ciclo_lectivo" name="ciclo_lectivo" required readonly>
                            <div class="invalid-feedback">
                                Por favor, ingrese el ciclo lectivo.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="carrera" class="form-label">Carrera</label>
                            <select class="form-select" name="carrera" id="carrera" required>
                                <option value="">Seleccione una carrera</option>
                                <?php foreach ($carreras as $carrera): ?>
                                    <option value="<?php echo htmlspecialchars($carrera['nombre_carrera']); ?>">
                                        <?php echo htmlspecialchars($carrera['nombre_carrera']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, seleccione una carrera.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="curso" class="form-label">Curso</label>
                            <select class="form-select" name="curso" id="curso" required>
                                <option value="">Seleccione un curso</option>
                                <?php foreach ($cursadas as $cursada): ?>
                                    <option value="<?php echo htmlspecialchars($cursada['anio']); ?>">
                                        <?php echo htmlspecialchars($cursada['anio']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, seleccione un curso.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="materia" class="form-label">Materia</label>
                            <select class="form-select" name="materia" id="materia" required>
                                <option value="">Seleccione una materia</option>
                                <?php foreach ($materias as $materia): ?>
                                    <option value="<?php echo htmlspecialchars($materia['id_materia']); ?>">
                                        <?php echo htmlspecialchars($materia['denominacion_materia']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, seleccione una materia.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="profesor" class="form-label">Profesor</label>
                            <select class="form-select" name="docente" id="profesor" required>
                                <option value="">Seleccione un profesor</option>
                                <?php foreach ($docentes as $docente): ?>
                                    <option value="<?php echo htmlspecialchars($docente['id_docente']); ?>">
                                        <?php echo htmlspecialchars($docente['nombre_apellido']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, seleccione un profesor.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                            <div class="invalid-feedback">
                                Por favor, seleccione una fecha.
                            </div>
                        </div>

                        <!-- Campos ocultos -->
                        <input type="hidden" name="id_docente" value="<?php echo $id_docente; ?>">
                        <input type="hidden" name="nombre_apellido" value="<?php echo $nombre_apellido; ?>">
                        <input type="hidden" name="id_materia" value="<?php echo $id_materia; ?>">
                        <input type="hidden" name="denominacion_materia" value="<?php echo $denominacion_materia; ?>">

                        <!-- Tabla de Estudiantes -->
                        <div class="mb-3">
                            <label for="estudiantes" class="form-label">Estudiantes</label>

                            <!-- Botones para marcar todos -->
                            <div class="d-flex justify-content-end mb-2 gap-2">
                                <button type="button" id="marcar-todos-presentes" class="btn btn-sm btn-outline-success">Presentes (T)</button>
                                <button type="button" id="marcar-todos-ausentes" class="btn btn-sm btn-outline-danger">Ausentes (T)</button>
                                <button type="button" id="marcar-todos-tarde" class="btn btn-sm btn-outline-warning">Tardes (T)</button>
                            </div> 

                            <table class="table table-bordered table-hover table-responsive d-none" id="tabla-estudiantes">
                                <thead class="table-light">
                                    <tr>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Presente</th>
                                        <th>Ausente</th>
                                        <th>Tarde</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-estudiantes-body">
                                    <?php foreach ($estudiantes as $estudiante): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($estudiante['dni_estudiante']); ?></td>
                                            <td><?php echo htmlspecialchars($estudiante['nombres']); ?></td>
                                            <td class="text-center">
                                                <input type="radio" name="asistencia[<?php echo htmlspecialchars($estudiante['dni_estudiante']); ?>]" value="presente" required>
                                            </td>
                                            <td class="text-center">
                                                <input type="radio" name="asistencia[<?php echo htmlspecialchars($estudiante['dni_estudiante']); ?>]" value="ausente">
                                            </td>
                                            <td class="text-center">
                                                <input type="radio" name="asistencia[<?php echo htmlspecialchars($estudiante['dni_estudiante']); ?>]" value="tarde">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar Asistencia</button> <!-- Enviar formulario -->
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Librerías -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-oP9ZBPtW4NG/O8EihkQBEI2gL3V8fEr6ioJPxB3frSSAt0tSTblZw3D6tds6dU8B" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9IbYyI2ZzyuT3iNUy0XtcmM8l9F4Y5du2vs7X6CRl2H5Yk4Z8/J" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        // Cacheo de elementos del DOM
        const cicloLectivoInput = document.getElementById("ciclo_lectivo");
        const selectMateria = document.getElementById("materia");
        const tablaEstudiantes = document.getElementById("tabla-estudiantes");
        const tablaEstudiantesBody = document.getElementById("tabla-estudiantes-body");
        const btnMarcarTodosPresentes = document.getElementById("marcar-todos-presentes");
        const btnMarcarTodosAusentes = document.getElementById("marcar-todos-ausentes");
        const btnMarcarTodosTarde = document.getElementById("marcar-todos-tarde");

        // Establecer el ciclo lectivo automáticamente
        const establecerCicloLectivo = () => {
            const fecha = new Date();
            const year = fecha.getFullYear();
            cicloLectivoInput.value = `${year} - ${year + 1}`;
        };

        // Función para ocultar la tabla
        const ocultarTablaEstudiantes = () => {
            tablaEstudiantes.classList.add('d-none'); // Añadir clase d-none para ocultar la tabla
        };

        // Función para mostrar la tabla
        const mostrarTablaEstudiantes = () => {
            tablaEstudiantes.classList.remove('d-none'); // Quitar clase d-none para mostrar la tabla
        };

        // Función para crear una fila de estudiante usando Template Literals
        const crearFilaEstudiante = (est) => {
            return `
                <tr>
                    <td>${est.dni_estudiante}</td>
                    <td>${est.nombres}</td>
                    <td class="text-center">
                        <input type="radio" name="asistencia[${est.dni_estudiante}]" value="presente" id="presente_${est.dni_estudiante}" required>
                        <label for="presente_${est.dni_estudiante}">Presente</label>
                    </td>
                    <td class="text-center">
                        <input type="radio" name="asistencia[${est.dni_estudiante}]" value="ausente" id="ausente_${est.dni_estudiante}">
                        <label for="ausente_${est.dni_estudiante}">Ausente</label>
                    </td>
                    <td class="text-center">
                        <input type="radio" name="asistencia[${est.dni_estudiante}]" value="tarde" id="tarde_${est.dni_estudiante}">
                        <label for="tarde_${est.dni_estudiante}">Tarde</label>
                    </td>
                </tr>
            `;
        };

        // Modificar las funciones que cargan estudiantes
        const cargarEstudiantes = (materiaSeleccionada) => {
            const estudiantes = <?php echo json_encode($estudiantes); ?>;

            limpiarTablaEstudiantes();

            if (estudiantes.length === 0) {
                tablaEstudiantesBody.innerHTML = "<tr><td colspan='5' class='text-center'>No se encontraron estudiantes.</td></tr>";
                ocultarTablaEstudiantes();
                return;
            }

            mostrarTablaEstudiantes(); // Mostrar la tabla si hay estudiantes

            const filasHTML = estudiantes.map(est => crearFilaEstudiante(est)).join('');
            tablaEstudiantesBody.innerHTML = filasHTML;
        };

        const limpiarTablaEstudiantes = () => {
            tablaEstudiantesBody.innerHTML = "";
            ocultarTablaEstudiantes(); // Ocultar la tabla cuando esté vacía
        };

        // Función para marcar todos los estudiantes
        const marcarTodos = (tipo) => {
            const radios = tablaEstudiantesBody.querySelectorAll(`input[type="radio"][value="${tipo}"]`);
            radios.forEach(radio => {
                radio.checked = true;
            });
        };

        // Asignar eventos a los botones
        btnMarcarTodosPresentes.addEventListener("click", () => marcarTodos('presente'));
        btnMarcarTodosAusentes.addEventListener("click", () => marcarTodos('ausente'));
        btnMarcarTodosTarde.addEventListener("click", () => marcarTodos('tarde'));

        // Asignar evento al cambio de materia
        selectMateria.addEventListener("change", (e) => {
            const materiaSeleccionada = e.target.value;
            if (materiaSeleccionada) {
                cargarEstudiantes(materiaSeleccionada);
            } else {
                limpiarTablaEstudiantes();
            }
        });

        // Inicializar ciclo lectivo
        establecerCicloLectivo();

        // Ocultar la tabla de estudiantes al inicio
        ocultarTablaEstudiantes();
    });
    </script>

</body>
</html>
