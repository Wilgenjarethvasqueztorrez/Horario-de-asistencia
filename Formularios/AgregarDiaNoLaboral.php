<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Agregar Día No Laboral</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
</head>  
<body>  
    <h1 class="bg-primary p-2 text-white text-center">Agregar Día No Laboral</h1>  
    <div class="container">  
        <form action="../CRUD/insertarDiaNoLaboral.php" method="post">  
            <!-- Tipo de día no laboral -->  
            <label for="">Tipo</label>  
            <select class="form-select mb-3" name="Motivo" id="motivo" required onchange="toggleEmpleadoField()">  
                <option selected disabled>--Seleccionar tipo--</option>  
                <option value="Feriado">Feriado (Aplica a todos)</option>  
                <option value="Vacaciones">Vacaciones (Empleado específico)</option>  
            </select>  
  
            <!-- Seleccionar empleado (solo para vacaciones) -->  
            <div id="empleadoField" style="display: none;">  
                <label for="">Empleado</label>  
                <select class="form-select mb-3" name="EmpleadoId">  
                    <option selected disabled>--Seleccionar empleado--</option>  
                    <?php  
                    include ("../Config/Conexion.php");  
                    $sql = $conexion->query("SELECT empleados.id,   
                                                    usuarios.nombre,   
                                                    usuarios.apellido,   
                                                    roles.nombre as rol_nombre     
                                             FROM empleados  
                                             INNER JOIN usuarios ON empleados.empleado_id = usuarios.id  
                                             INNER JOIN roles ON empleados.rol_id = roles.id     
                                             WHERE empleados.activo = 1     
                                             ORDER BY usuarios.nombre ASC");  
                    while ($resultado = $sql->fetch_assoc()) {  
                        echo "<option value='".$resultado['id']."'>".$resultado['nombre']." ".$resultado['apellido']." - ".$resultado['rol_nombre']."</option>";  
                    }  
                    ?>  
                </select>  
            </div>  
  
            <!-- Fecha de inicio -->  
            <div class="mb-3">  
                <label class="form-label">Fecha de Inicio</label>  
                <input type="date" class="form-control" name="FechaInicio" required>  
            </div>  
  
            <!-- Fecha de fin -->  
            <div class="mb-3">  
                <label class="form-label">Fecha de Fin</label>  
                <input type="date" class="form-control" name="FechaFin" required>  
            </div>  
  
            <!-- Descripción -->  
            <div class="mb-3">  
                <label class="form-label">Descripción</label>  
                <input type="text" class="form-control" name="Descripcion" placeholder="Ej: Día del Trabajador, Vacaciones anuales">  
            </div>  
  
            <!-- Botones -->  
            <div class="text-center">  
                <button type="submit" class="btn btn-primary">Registrar</button>  
                <a href="../dia_no_laboral.php" class="btn btn-dark">Cancelar</a>  
            </div>  
        </form>  
    </div>  
  
    <script>  
        // Mostrar o ocultar el campo de empleado según el tipo de dia no laboral seleccionado
        function toggleEmpleadoField() {  
            const motivo = document.getElementById('motivo').value;  
            const empleadoField = document.getElementById('empleadoField');  
            const empleadoSelect = empleadoField.querySelector('select');  
              
            if (motivo === 'Vacaciones') {  
                empleadoField.style.display = 'block';  
                empleadoSelect.required = true;  
            } else {  
                empleadoField.style.display = 'none';  
                empleadoSelect.required = false;  
                empleadoSelect.value = '';  
            }  
        }  
    </script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>