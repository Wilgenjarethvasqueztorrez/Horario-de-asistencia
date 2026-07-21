<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Día No Laboral</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../src/css/styles.css?v=2.2" />
</head>

<body class="bg-light">

    <div class="container" style="max-width: 650px;">
        
        <div class="form-card-container">
            <h1 class="form-title-custom text-center mb-4">📅 Agregar Día No Laboral</h1>
            
            <form action="../../CRUD/DiaNoLaboral/insertarDiaNoLaboral.php" method="post">
                
                <div class="mb-3">
                    <label class="form-label-custom">Tipo de Registro</label>
                    <select class="form-select form-control-custom" name="Motivo" id="motivo" required onchange="toggleEmpleadoField()">
                        <option selected disabled value="">-- Seleccionar tipo --</option>
                        <option value="Feriado">🏛️ Feriado (Aplica a todos)</option>
                        <option value="Vacaciones">🏖️ Vacaciones (Empleado específico)</option>
                    </select>
                </div>

                <div id="empleadoField" class="mb-3 d-none">
                    <label class="form-label-custom">Empleado</label>
                    <select id="select2-empleado" class="form-select form-control-custom" name="EmpleadoId">
                        <option selected disabled value="">-- Seleccionar empleado --</option>
                        <?php
                        include("../../Config/Conexion.php");
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
                            echo "<option value='" . $resultado['id'] . "'>" . $resultado['nombre'] . " " . $resultado['apellido'] . " - " . $resultado['rol_nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Fecha de Inicio</label>
                    <input type="date" class="form-control form-control-custom" name="FechaInicio" required>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Fecha de Fin</label>
                    <input type="date" class="form-control form-control-custom" name="FechaFin" required>
                </div>

                <div class="mb-4">
                    <label class="form-label-custom">Descripción</label>
                    <input type="text" class="form-control form-control-custom" name="Descripcion" placeholder="Ej: Día del Trabajador, Vacaciones anuales">
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn-submit-custom">
                        <i class="bi bi-check-circle-fill me-1"></i> Registrar
                    </button>
                    <a href="../../pages/dia_no_laboral.php" class="btn-cancel-custom text-decoration-none d-flex align-items-center justify-content-center">
                        <i class="bi bi-x-circle-fill me-1"></i> 
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

    </div>

    <script>
        function toggleEmpleadoField() {
            const motivo = document.getElementById('motivo').value;
            const empleadoField = document.getElementById('empleadoField');
            const empleadoSelect = document.getElementById('select2-empleado');

            if (motivo === 'Vacaciones') {
                empleadoField.classList.remove('d-none');
                empleadoSelect.required = true;
            } else {
                empleadoField.classList.add('d-none');
                empleadoSelect.required = false;
                empleadoSelect.value = '';
                // Forzar actualización visual si se usa Select2 en cascada
                if (typeof jQuery !== 'undefined' && jQuery(empleadoSelect).data('select2')) {
                    jQuery(empleadoSelect).val('').trigger('change');
                }
            }
        }
    </script>

    <?php include('../../src/includes/Dependencias/Flatpickr.php'); ?>

    <?php include('../../src/includes/Dependencias/Select2.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>