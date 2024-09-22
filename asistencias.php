<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ISFT 225</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <?php
    // Crea la conexión
    require('./conexion.php');
    include "header.php";


    // Consulta los datos
    $sql = "SELECT nombre_carrera FROM CARRERA";
    $result = $conn->query($sql);


    if ($result) {
        if ($result->num_rows > 0) {
            // Obtiene todos los datos de la consulta
            $carreras = $result->fetch_all(MYSQLI_ASSOC); // Obtiene todos los resultados en un array asociativo
        } else {
            $mensaje = "No se encontraron registros de carreras";
            $carreras = [];
        }
    } else {
        $mensaje = "Error en la consulta SQL: " . $conn->error;
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


    $sql = "SELECT denominacion_materia FROM MATERIA";
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


    $sql = "SELECT nombre_apellido FROM DOCENTE";
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

    $conn->close();
    ?>

    <main>
        <div class="d-flex flex-nowrap sidebar-height">
            <?php include "sidebar.php"; ?>
            <div class="col-9 offset-3 bg-light-subtle pt-5">
                <div class="d-block p-3 m-4 h-100">
                    <h2 class="card-footer-text mt-2 mb-5 p-2">Asistencias</h2>
                    <form action="procesar_asistencia.php" method="post">


                        <div class="form-group mb-3">
                            <label for="ciclo_lectivo">Ciclo Lectivo</label>
                            <input type="text" class="form-control" id="ciclo_lectivo" name="ciclo_lectivo" required readonly>
                        </div>


                        <div class="form-group mb-3">
                            <label for="carrera">Carrera</label>
                            <select class="form-control" name="carrera" id="carrera" required>
                                <option value="">Seleccione una carrera</option>
                                <?php foreach ($carreras as $carrera): ?>
                                    <option value="<?= $carrera['nombre_carrera']; ?>"><?= $carrera['nombre_carrera']; ?></option>
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
                                    <option value="<?= $materia['denominacion_materia']; ?>"><?= $materia['denominacion_materia']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group mb-3">
                            <label for="profesor">Profesor</label>
                            <select class="form-control" name="docente" id="profesor" required>
                                <option value="">Seleccione un profesor</option>
                                <?php foreach ($docentes as $docente): ?>
                                    <option value="<?= $docente['nombre_apellido']; ?>"><?= $docente['nombre_apellido']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group mb-3">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>


                        <!-- Tabla de Estudiantes -->
                        <div class="form-group mb-3">
                            <label for="estudiantes">Estudiantes</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>DNI</th>
                                        <th>Nombre</th>
                                        <th>Presente</th>
                                        <th>Ausente</th>
                                        <th>Tarde</th>
                                    </tr>
                                </thead>
                                <tbody id="tabla-estudiantes">
                                    <!-- Se cargan los datos de la tabla de Estudiantes a través de JavaScript -->
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
   
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-oP9ZBPtW4NG/O8EihkQBEI2gL3V8fEr6ioJPxB3frSSAt0tSTblZw3D6tds6dU8B" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9IbYyI2ZzyuT3iNUy0XtcmM8l9F4Y5du2vs7X6CRl2H5Yk4Z8/J" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script>
            // Script para Ciclo Lectivo
            document.addEventListener("DOMContentLoaded", function() {
            const fecha = new Date();
            const year = fecha.getFullYear();
            document.getElementById("ciclo_lectivo").value = year;
        });


        document.addEventListener("DOMContentLoaded", function() {
    const selectMateria = document.getElementById("materia");
    const tablaEstudiantes = document.getElementById("tabla-estudiantes");


    selectMateria.addEventListener("change", function() {
        const materiaSeleccionada = this.value;


        // Simula la carga de estudiantes según la materia seleccionada (investigar solicitud AJAX real)
        const estudiantes = <?php echo json_encode($estudiante); ?>;


        // Limpia la tabla antes de agregar nuevos datos
        tablaEstudiantes.innerHTML = "";


        estudiantes.forEach(est => {
            // Crea una fila para cada estudiante
            const row = document.createElement("tr");


            // Crea columnas para el DNI y Nombre
            const cellDNI = document.createElement("td");
            cellDNI.textContent = est.dni_estudiante;


            const cellNombre = document.createElement("td");
            cellNombre.textContent = est.nombres;


            // Columna Presente
            const cellPresente = document.createElement("td");
            const inputPresente = document.createElement("input");
            inputPresente.type = "checkbox";
            inputPresente.name = `asistencia_${est.dni_estudiante}`;
            inputPresente.value = "presente";
            inputPresente.id = `presente_${est.dni_estudiante}`;
            const labelPresente = document.createElement("label");
            labelPresente.htmlFor = inputPresente.id;
            labelPresente.textContent = "Presente";
            cellPresente.appendChild(inputPresente);
            cellPresente.appendChild(labelPresente);


            // Columna Ausente
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


            // Columna Tarde
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
            inputPresente.addEventListener("change", function() {
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
});
    </script>

</body>
</html>