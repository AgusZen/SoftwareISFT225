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


    // Consultas a la base de datos
    $sql = "SELECT nombre_carrera FROM CARRERA"; // Selección
    $result = $conn->query($sql); // Ejecución

    if ($result) { // Validación
        if ($result->num_rows > 0) {
            $carreras = $result->fetch_all(MYSQLI_ASSOC); // Si la consulta es exitosa y devuelve filas, almacena los resultados en $carreras como un arreglo asociativo.
        } else {
            $mensaje = "No se encontraron registros de carreras"; // Si no se encuentran registros, asigna un mensaje de error y establece $carreras como un arreglo vacío.
            $carreras = [];
        }
    } else {
        $mensaje = "Error en la consulta SQL: " . $conn->error; // En caso de error en la consulta, captura el error y establece $carreras como vacío.
        $carreras = [];
    }


    $sql = "SELECT anio FROM CURSADA";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $cursadas = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $mensaje = "No se encontraron registros de años";
            $cursadas = [];
        }
    } else {
        $mensaje = "Error en la consulta SQL: " . $conn->error;
        $cursadas = [];
    }


    $sql = "SELECT id_materia, denominacion_materia FROM MATERIA";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $materias = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $mensaje = "No se encontraron registros de materias";
            $materias = [];
        }
    } else {
        $mensaje = "Error en la consulta SQL: " . $conn->error;
        $materias = [];
    }


    $sql = "SELECT id_docente, nombre_apellido FROM DOCENTE";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $docentes = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $mensaje = "No se encontraron registros de docentes";
            $docentes = [];
        }
    } else {
        $mensaje = "Error en la consulta SQL: " . $conn->error;
        $docentes = [];
    }


    $sql = "SELECT dni_estudiante, nombres FROM ESTUDIANTES";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $estudiante = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $mensaje = "No se encontraron registros de estudiantes";
            $estudiante = [];
        }
    } else {
        $mensaje = "Error en la consulta SQL: " . $conn->error;
        $estudiante = [];
    }

    $conn->close(); // Cierra la conexión
    ?>

    <main>
        <div class="d-flex flex-nowrap sidebar-height"> 
            <?php include "sidebar.php"; ?> <!-- Muestra la barra lateral -->
            <div class="col-9 offset-3 bg-light-subtle pt-5"> 
                <div class="d-block p-3 m-4 h-100">
                    <h2 class="card-footer-text mt-2 mb-5 p-2">Asistencias</h2>

                    <form action="procesar_asistencia.php" method="post"> <!-- Define un formulario que enviará datos a procesar_asistencia.php utilizando el método POST. -->

                        <div class="form-group mb-3">
                            <label for="ciclo_lectivo">Ciclo Lectivo</label> <!-- Etiqueta que hace referencia al campo -->
                            <input type="text" class="form-control" id="ciclo_lectivo" name="ciclo_lectivo" required readonly> <!-- "required" = obligatorio, "readonly" = completado automáticamente con JS-->
                        </div>

                        <div class="form-group mb-3">
                            <label for="carrera">Carrera</label> 
                            <select class="form-control" name="carrera" id="carrera" required>
                                <option value="">Seleccione una carrera</option> <!-- Primera opción vacía con texto sugerido-->
                                <?php foreach ($carreras as $carrera): ?>
                                    <option value="<?= $carrera['nombre_carrera']; ?>"><?= $carrera['nombre_carrera']; ?></option> <!-- Opciones dinámicas con PHP que vienen de la BD -->
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="curso">Curso</label>
                            <select class="form-control" name="curso" id="curso" required>
                                <option value="">Seleccione un curso</option>
                                <?php foreach ($cursadas as $cursada): ?>
                                    <option value="<?= $cursada['anio']; ?>"><?= $cursada['anio']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="materia">Materia</label>
                            <select class="form-control" name="materia" id="materia" required>
                                <option value="">Seleccione una materia</option>
                                <?php foreach ($materias as $materia): ?>
                                    <option value="<?= $materia['id_materia']; ?>"><?= $materia['denominacion_materia']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="profesor">Profesor</label>
                            <select class="form-control" name="docente" id="profesor" required>
                                <option value="">Seleccione un profesor</option>
                                <?php foreach ($docentes as $docente): ?>
                                    <option value="<?= $docente['id_docente']; ?>"><?= $docente['nombre_apellido']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required> <!-- "date" para hacer uso de un calendario -->
                        </div>

                        <!-- Campos ocultos -->
                        <!-- Envían datos adicionales que el usuario no puede ver -->
                        <input type="hidden" name="id_docente" value="<?= $id_docente; ?>">
                        <input type="hidden" name="nombre_apellido" value="<?= $nombre_apellido; ?>">
                        <input type="hidden" name="id_materia" value="<?= $id_materia; ?>">
                        <input type="hidden" name="denominacion_materia" value="<?= $denominacion_materia; ?>">                     

                        <!-- Tabla de Estudiantes -->
                        <div class="form-group mb-3">
                            <label for="estudiantes">Estudiantes</label>

                        <!-- Botones para marcar todos -->
                        <div class="d-flex justify-content-end mb-2" style="gap: 110px;">
                            <button type="button" id="marcar-todos-presentes" class="btn btn-sm rounded mx-2 btn-custom" style="color: black; border-color: black;">Presentes (T)</button>
                            <button type="button" id="marcar-todos-ausentes" class="btn btn-sm rounded mx-2 btn-custom" style="color: black; border-color: black;">Ausentes (T)</button>
                            <button type="button" id="marcar-todos-tarde" class="btn btn-sm rounded mx-2 btn-custom" style="color: black; border-color: black;">Tardes (T)</button>
                        </div> 

                        <div/>
                            <table class="table table-bordered"> <!-- Tabla alterada con Bootstrap -->
                                <thead> <!-- Encabezado de la tabla con las siguientes columnas-->
                                    <tr>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Presente</th>
                                        <th>Ausente</th>
                                        <th>Tarde</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-estudiantes"> <!-- Cuerpo de la tabla -->
                                    <!-- Acá se cargan los datos a través de JavaScript -->
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar Asistencia</button> <!-- Enviar formulario, con estética Bootstrap -->

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
    document.addEventListener("DOMContentLoaded", function() { // El script se ejecuta después de que se cargue todo el documento, para evitar errores de acceso
        // Coloca automáticamente el año actual
        const fecha = new Date(); // Crea
        const year = fecha.getFullYear(); // Obtiene
        document.getElementById("ciclo_lectivo").value = year; // Asigna

        // Manejo de cambio de materia y carga de estudiantes
        const selectMateria = document.getElementById("materia"); // Referencia a elemento "select" con ID Materia
        const tablaEstudiantes = document.getElementById("tabla-estudiantes"); // Referencia al cuerpo de la tabla estudiantes

        selectMateria.addEventListener("change", function() { // Código a ejecutar cuando cambia la materia seleccionada
            const materiaSeleccionada = this.value; // "this.value" obtiene el valor de la opción seleccionada, en este caso la materia (selectMateria)

            // SIMULACIÓN DE CARGA DE ESTUDIANTE
            const estudiantes = <?php echo json_encode($estudiante); ?>; // Esta línea es una simulación, por ende no se filtran los estudiantes. Hay que agregar una lógica adicional una vez actualizada la BD 

            // Limpia la tabla antes de agregar nuevos datos
            tablaEstudiantes.innerHTML = "";

            estudiantes.forEach(est => { // Recorre cada objeto de estudiante en el vector "estudiantes"
                // Crea una fila para cada estudiante
                const row = document.createElement("tr");

                // Crea columnas para el DNI y Nombre
                const cellDNI = document.createElement("td");
                cellDNI.textContent = est.dni_estudiante;

                const cellNombre = document.createElement("td");
                cellNombre.textContent = est.nombres;

                // Crea columna Presente
                const cellPresente = document.createElement("td");
                const inputPresente = document.createElement("input");
                inputPresente.type = "checkbox"; // Define el tipo de entrada como un checkbox.
                inputPresente.name = `asistencia_${est.dni_estudiante}`; // Usa un nombre dinámico basado en el DNI del estudiante para identificar la asistencia de cada uno de forma única
                inputPresente.value = "presente"; // Define el valor que se enviará al servidor cuando el checkbox esté marcado
                inputPresente.id = `presente_${est.dni_estudiante}`; // Asigna un identificador único a cada checkbox para asociarlo con su etiqueta (label).
                const labelPresente = document.createElement("label");
                labelPresente.htmlFor = inputPresente.id;
                labelPresente.textContent = "Presente";
                cellPresente.appendChild(inputPresente);
                cellPresente.appendChild(labelPresente);

                // Crea columna Ausente
                const cellAusente = document.createElement("td");
                const inputAusente = document.createElement("input");
                inputAusente.type = "checkbox";
                inputAusente.name = `asistencia_${est.dni_estudiante}`;
                inputAusente.value = "ausente";
                inputAusente.id = `ausente_${est.dni_estudiante}`;
                const labelAusente = document.createElement("label");
                labelAusente.htmlFor = inputAusente.id;
                labelAusente.textContent = "Ausente";
                cellAusente.appendChild(inputAusente);
                cellAusente.appendChild(labelAusente);

                // Crea columna Tarde
                const cellTarde = document.createElement("td");
                const inputTarde = document.createElement("input");
                inputTarde.type = "checkbox";
                inputTarde.name = `asistencia_${est.dni_estudiante}`;
                inputTarde.value = "tarde";
                inputTarde.id = `tarde_${est.dni_estudiante}`;
                const labelTarde = document.createElement("label");
                labelTarde.htmlFor = inputTarde.id;
                labelTarde.textContent = "Tarde";
                cellTarde.appendChild(inputTarde);
                cellTarde.appendChild(labelTarde);

                // "Event listener" para que sólo una opción sea seleccionada por estudiante
                inputPresente.addEventListener("change", function() { // Si se marca como presente, automáticamente desmarca "Ausente" y "Tarde". Lo mismo con las líneas siguientes
                    if (this.checked) {
                        inputAusente.checked = false;
                        inputTarde.checked = false;
                    }
                });

                inputAusente.addEventListener("change", function() {
                    if (this.checked) {
                        inputPresente.checked = false;
                        inputTarde.checked = false;
                    }
                });

                inputTarde.addEventListener("change", function() {
                    if (this.checked) {
                        inputPresente.checked = false;
                        inputAusente.checked = false;
                    }
                });

                // Agrega columnas a la fila
                row.appendChild(cellDNI);
                row.appendChild(cellNombre);
                row.appendChild(cellPresente);
                row.appendChild(cellAusente);
                row.appendChild(cellTarde);

                // Agrega la fila a la tabla
                tablaEstudiantes.appendChild(row);
            });
        });

        // Funcionalidad para los botones de "marcar todos"
        // Referencias a los botones
        const btnMarcarTodosPresentes = document.getElementById("marcar-todos-presentes");
        const btnMarcarTodosAusentes = document.getElementById("marcar-todos-ausentes");
        const btnMarcarTodosTarde = document.getElementById("marcar-todos-tarde");

        // Función para marcar todos los estudiantes
        function marcarTodos(tipo) { // "tipo" indica qué tipo de asistencia se debe marcar para todos los estudiantes
            const filas = tablaEstudiantes.getElementsByTagName("tr"); // obtiene una colección de todas las filas dentro de la tabla de estudiantes

            for (let fila of filas) { // Recorre cada fila individualmente
                const checkboxPresente = fila.querySelector(`input[value="presente"]`); // Busca el checkbox con el valor definido
                const checkboxAusente = fila.querySelector(`input[value="ausente"]`);
                const checkboxTarde = fila.querySelector(`input[value="tarde"]`);

                if (checkboxPresente && checkboxAusente && checkboxTarde) { // Asegura que todos los checkbox existen antes de su uso
                    // Desmarca todas las opciones para mantener integridad de selección única
                    checkboxPresente.checked = false;
                    checkboxAusente.checked = false;
                    checkboxTarde.checked = false;

                    // Marca la opción seleccionada
                    if (tipo === 'presente') {
                        checkboxPresente.checked = true;
                    } else if (tipo === 'ausente') {
                        checkboxAusente.checked = true;
                    } else if (tipo === 'tarde') {
                        checkboxTarde.checked = true;
                    }
                }
            }
        }

        // Asignar eventos a los botones. Al hacer click, ejecuta la función "marcar todos" según la asistencia seleccionada
        btnMarcarTodosPresentes.addEventListener("click", function() {
            marcarTodos('presente');
        });

        btnMarcarTodosAusentes.addEventListener("click", function() {
            marcarTodos('ausente');
        });

        btnMarcarTodosTarde.addEventListener("click", function() {
            marcarTodos('tarde');
        });
    });

</script>

</body>
</html>