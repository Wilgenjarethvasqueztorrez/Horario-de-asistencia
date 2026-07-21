<?php
// Proteger la página    
require("../../Config/verificarSesion.php");
require("../../Config/Conexion.php");

// Obtener el empleado_id del usuario actual  
$usuario_id = $_SESSION['usuario_id'];
$sql_empleado = $conexion->query("SELECT empleados.id,   
                                         usuarios.nombre,   
                                         usuarios.apellido,  
                                         roles.nombre as rol_nombre,  
                                         horarios.nombre as horario_nombre,  
                                         horarios.tipo as horario_tipo,  
                                         horarios.horas_minimas  
                                  FROM empleados  
                                  INNER JOIN usuarios ON empleados.empleado_id = usuarios.id  
                                  INNER JOIN roles ON empleados.rol_id = roles.id  
                                  LEFT JOIN horarios ON roles.horario_id = horarios.id  
                                  WHERE usuarios.id = $usuario_id");
$empleado = $sql_empleado->fetch_assoc();
$empleado_id = $empleado['id'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enviar Solicitud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../src/css/styles.css?v=2.5" />
</head>

<body class="bg-light">

    <div class="container" style="max-width: 650px;">
        
        <div class="form-card-container shadow-sm">
            <h1 class="form-title-custom text-center mb-4">📨 Enviar Solicitud</h1>
            
            <form action="../../CRUD/Solicitud/insertarSolicitud.php" method="post">
                
                <div class="mb-3">
                    <label class="form-label-custom">Empleado Solicitante</label>
                    <input type="text" class="form-control form-control-custom" 
                           value="<?php echo htmlspecialchars($empleado['nombre'] . ' ' . $empleado['apellido'], ENT_QUOTES, 'UTF-8'); ?>" 
                           disabled>
                </div>

                <input type="hidden" name="EmpleadoId" value="<?php echo $empleado_id; ?>">

                <div class="mb-4">
                    <label class="form-label-custom">Descripción de la Solicitud</label>
                    <textarea class="form-control form-control-custom" name="DescripcionSolicitud" rows="4" 
                              placeholder="Ej: Solicito vacaciones por el siguiente motivo..." required></textarea>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn-submit-custom">
                        <i class="bi bi-send-fill me-1"></i> Enviar Solicitud
                    </button>
                    <a href="../../pages/perfil_empleado.php" class="btn-cancel-custom text-decoration-none d-flex align-items-center justify-content-center">
                        <i class="bi bi-x-circle-fill me-1"></i> 
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

    </div>

    <?php include('../../src/includes/Dependencias/Flatpickr.php'); ?>
    <?php include('../../src/includes/Dependencias/Select2.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>