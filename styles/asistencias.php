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
    include "variablesPath.php";
    require(rutas::$pathConection);

    $sql_ciclos = "SELECT id_ciclo_electivo, nombre_ciclo FROM ciclo_electivo";
    $stmt_ciclos = $conn->prepare($sql_ciclos);
    $stmt_ciclos->execute();
    $result_ciclos = $stmt_ciclos->get_result();

    function traerDatos($conn, $sql) {
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
        $carreras = traerDatos($conn, "SELECT nombre_carrera FROM CARRERA");
        $materias = traerDatos($conn, "SELECT denominacion_materia FROM MATERIA");
        $docentes = traerDatos($conn, "SELECT nombre_personal FROM PERSONAL");
        $estudiantes = traerDatos($conn, "SELECT dni_estudiante, nombre, apellido FROM ESTUDIANTES");

    } catch (Exception $e) {
        $mensaje = $e->getMessage();
        echo "<div class='alert alert-danger'>$mensaje</div>";
    } finally {
        $conn->close();
    }

    include(rutas::$pathNuevoHeader);
    
    ?>

    <main>
    <?php $mensaje = ''; // Se define la variable "mensaje". ?>

        <form class="d-block p-3 m-4 h-100 formulario" name="formulario" method="POST" action="procesar_asistencia.php" class="needs-validation" novalidate>
            <h2 class="card-footer-text mt-2 mb-4 p-2">Asistencias</h2>
            <div class='filas'>    
                <div class="fila">
                    <div class="columna">
                        <label for="nombre_ciclo" class="form-label">Ciclo Lectivo</label>
                        <select id="nombre_ciclo" name="nombre_ciclo" class="form-select" required>
                            <option hidden>Seleccione un ciclo electivo</option>
                            <?php while ($row = $result_ciclos->fetch_assoc()): ?>
                                <option value="<?= $row['nombre_ciclo'] ?>"><?= $row['nombre_ciclo'] ?></option>
                            <?php endwhile; ?>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione un ciclo electivo.
                        </div>
                    </div> 

                    <div class="columna">
                        <label for="carrera" class="form-label">Carrera</label>
                        <select class="form-select" name="nombre_carrera" id="nombre_carrera" required>
                            <option hidden>Seleccione una carrera</option> 
                            <?php foreach ($carreras as $carrera): ?>
                                <option value="<?php echo ($carrera['nombre_carrera']); ?>">
                                    <?php echo ($carrera['nombre_carrera']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, seleccione una carrera.
                        </div>
                    </div>
                </div>
            </div>
            <div class='filas'>
                <div class="fila">
                    <div class="columna">
                        <label for="anio_carrera" class="form-label">Seleccionar Año:</label>
                        <select id="anio_carrera" name="anio_carrera" class="form-select">
                            <option hidden>Seleccione un año</option>
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
                            <option hidden>Seleccione una materia</option>
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
            <div class='filas'>
                <div class="fila">
                    <div class="columna">
                        <label for="personal" class="form-label">Profesor</label>
                        <select class="form-select" name="personal" id="personal" required>
                            <option hidden>Seleccione un profesor</option>
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
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
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
                    if (count($estudiantes) > 0) {
                        foreach ($estudiantes as $estudiante): ?>
                            <tr>        
                                <td><?php echo ($estudiante['dni_estudiante']); ?></td> 
                                <td><?php echo ($estudiante['nombre']); ?></td> 
                                <td><?php echo ($estudiante['apellido']); ?></td> 
                                <td class="text-center">
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
    document.addEventListener("DOMContentLoaded", () => { // El script se ejecuta una vez que todo el contenido del DOM fue cargado
        // Cacheo de elementos del DOM. (Almacena referencias a elementos específicos para usarlos sin tener que buscarlos todo el tiempo)
        const cicloLectivoInput = document.getElementById("ciclo_lectivo");
        const selectMateria = document.getElementById("materia");
        const tablaEstudiantes = document.getElementById("tabla-estudiantes");
        const tablaEstudiantesBody = document.getElementById("tabla-estudiantes-body");
        const btnMarcarTodosPresentes = document.getElementById("marcar-todos-presentes");
        const btnMarcarTodosAusentes = document.getElementById("marcar-todos-ausentes");
        const btnMarcarTodosTarde = document.getElementById("marcar-todos-tarde");

        /* Establecer el ciclo lectivo automáticamente
        const establecerCicloLectivo = () => {
            const fecha = new Date(); // Obtiene la fecha
            const year = fecha.getFullYear(); // Extrae el año
            cicloLectivoInput.value = `${year}`; // Asigna el valor
        }; */

        // Función para ocultar la tabla. Añade la clase "d-none"
        const ocultarTablaEstudiantes = () => {
            tablaEstudiantes.classList.add('d-none'); // Añadir clase d-none para ocultar la tabla
        };

        // Función para mostrar la tabla. Borra la clase "d-none"
        const mostrarTablaEstudiantes = () => {
            tablaEstudiantes.classList.remove('d-none'); // Quitar clase d-none para mostrar la tabla
        };


        // Función para crear una fila de estudiante usando Template Literals
        const crearFilaEstudiante = (est) => { // "est" contiene los datos del estudiante
            return `
                <tr>
                    <td>${est.dni_estudiante}</td>
                    <td>${est.nombre}</td>
                    <td>${est.apellido}</td>
                    <td class="text-center">
                        <input type="radio" name="asistencia[${est.dni_estudiante}]" value="Presente" id="presente_${est.dni_estudiante}" required>
                        <label for="presente_${est.dni_estudiante}">Presente</label>
                    </td>
                    <td class="text-center">
                        <input type="radio" name="asistencia[${est.dni_estudiante}]" value="Ausente" id="ausente_${est.dni_estudiante}">
                        <label for="ausente_${est.dni_estudiante}">Ausente</label>
                    </td>
                    <td class="text-center">
                        <input type="radio" name="asistencia[${est.dni_estudiante}]" value="Tarde" id="tarde_${est.dni_estudiante}">
                        <label for="tarde_${est.dni_estudiante}">Tarde</label>
                    </td>
                </tr>
            `;
        };

        // Modificar las funciones que cargan estudiantes
        const cargarEstudiantes = (materiaSeleccionada) => {
            const estudiantes = <?php echo json_encode($estudiantes); ?>;

            limpiarTablaEstudiantes(); // Limpia contenido previo de la tabla

            if (estudiantes.length === 0) { // Si no hay estudiantes, hay mensaje de que no se encontraron y oculta la tabla
                tablaEstudiantesBody.innerHTML = "<tr><td colspan='5' class='text-center'>No se encontraron estudiantes.</td></tr>";
                ocultarTablaEstudiantes();
                return;
            }

            mostrarTablaEstudiantes(); // Mostrar la tabla si hay estudiantes

            const filasHTML = estudiantes.map(est => crearFilaEstudiante(est)).join(''); // Crea una cadena HTML con las filas de los estudiantes
            tablaEstudiantesBody.innerHTML = filasHTML; // Inserta las filas en el cuerpo de la tabla
        };

        const limpiarTablaEstudiantes = () => {
            tablaEstudiantesBody.innerHTML = ""; // Elimina el contenido HTML de la tabla
            ocultarTablaEstudiantes(); // Oculta la tabla cuando esté vacía
        };

        // Función para marcar todos los estudiantes
        const marcarTodos = (tipo) => {
            const radios = tablaEstudiantesBody.querySelectorAll(`input[type="radio"][value="${tipo}"]`); // Selecciona todos los botones de radio que tienen el valor especificado "tipo"
            radios.forEach(radio => { // Itera sobre cada radio seleccionado y lo marca
                radio.checked = true;
            });
        };

        // Asignar eventos a los botones. Cuando se hace "click" en alún botón se llama a "marcarTodos" con su respectivo argumento
        btnMarcarTodosPresentes.addEventListener("click", () => marcarTodos('Presente'));
        btnMarcarTodosAusentes.addEventListener("click", () => marcarTodos('Ausente'));
        btnMarcarTodosTarde.addEventListener("click", () => marcarTodos('Tarde'));

        // Asignar evento al cambio de materia
        selectMateria.addEventListener("change", (e) => {
            const materiaSeleccionada = e.target.value; // Obtiene el valor de la materia seleccionada
            if (materiaSeleccionada) { //Si se selecciona una materia, llama a los estudiantes
                cargarEstudiantes(materiaSeleccionada);
            } else {
                limpiarTablaEstudiantes(); // Si no hy materia seleccionada, limpia y esconde la tabla
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