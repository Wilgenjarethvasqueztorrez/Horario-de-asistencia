<?php
// Proteger la página    
require("../../Config/verificarSesion.php");
// Verificar que solo roles con permisos de gestión puedan acceder
verificarRol(['Administrador', 'Oficina']);

include('../../Config/Conexion.php');  

// Obtener datos del empleado de forma segura
$id = intval($_GET['Id']);
$sql = "SELECT * FROM empleados WHERE id = $id";  
$resultado = $conexion->query($sql);  
$row = $resultado->fetch_assoc();  
?>
<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Editar Empleado</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />  
    <link rel="stylesheet" href="../../src/css/styles.css?v=3.1" />
</head>  
<body class="bg-light">  

    <div class="container" style="max-width: 650px;">  
          
        <div class="form-card-container shadow-sm">
            <h1 class="form-title-custom text-center mb-4">👤 Editar Ficha de Empleado</h1>

            <form action="../../CRUD/Empleado/editarEmpleado.php" method="post">  
                <input type="hidden" name="Id" value="<?php echo $row['id']; ?>">  
      
                <div class="mb-3">
                    <label class="form-label-custom">Usuario del Sistema vinculado</label>  
                    <select id="select2" class="form-select form-control-custom" name="UsuarioId" required>  
                        <?php  
                        $sqlUsuarios = $conexion->query("SELECT id, nombre, apellido, correo, rol_sistema FROM usuarios WHERE rol_sistema = 'Empleado' ORDER BY nombre ASC");  
                        while ($usuario = $sqlUsuarios->fetch_assoc()) {  
                            $selected = ($row['empleado_id'] == $usuario['id']) ? "selected" : "";  
                            echo "<option value='".$usuario['id']."' $selected>"  
                                 .htmlspecialchars($usuario['nombre']." ".$usuario['apellido']." (".$usuario['rol_sistema'].") — ".$usuario['correo'], ENT_QUOTES, 'UTF-8')."</option>";  
                        }  
                        ?>  
                    </select>  
                </div>
      
                <div class="mb-3">
                    <label class="form-label-custom">Rol Laboral y Horario</label>  
                    <select id="select2-rol" class="form-select form-control-custom" name="RolId" required>  
                        <?php  
                        $sqlRoles = $conexion->query("SELECT roles.id, roles.nombre, roles.descripcion, horarios.nombre as horario_nombre   
                                                      FROM roles   
                                                      LEFT JOIN horarios ON roles.horario_id = horarios.id   
                                                      ORDER BY roles.nombre");  
                        while ($rol = $sqlRoles->fetch_assoc()) {  
                            $selected = ($row['rol_id'] == $rol['id']) ? "selected" : "";  
                            $descripcion = $rol['descripcion'] ? " - " . $rol['descripcion'] : "";  
                            $horario = $rol['horario_nombre'] ? " [" . $rol['horario_nombre'] . "]" : "";  
                            echo "<option value='".$rol['id']."' $selected>".htmlspecialchars($rol['nombre'].$descripcion.$horario, ENT_QUOTES, 'UTF-8')."</option>";  
                        }  
                        ?>  
                    </select>  
                </div>
      
                <div class="mb-4">
                    <label class="form-label-custom">Estado Operativo</label>  
                    <select class="form-select form-control-custom" name="Activo" required>  
                        <option value="1" <?php echo ($row['activo'] == 1) ? "selected" : ""; ?>>🟢 Activo</option>  
                        <option value="0" <?php echo ($row['activo'] == 0) ? "selected" : ""; ?>>🔴 Inactivo</option>  
                    </select>  
                </div>
      
                <div class="d-flex justify-content-center gap-3">  
                    <button type="submit" class="btn-submit-custom">
                        <i class="bi bi-arrow-clockwise me-1"></i> Actualizar
                    </button>  
                    <a href="../../pages/empleado.php" class="btn-cancel-custom text-decoration-none d-flex align-items-center justify-content-center">
                        <i class="bi bi-x-circle-fill me-1"></i> 
                        Cancelar
                    </a>
                </div>  
            </form>  
        </div>
    </div>  

    <?php include('../../src/includes/Dependencias/Select2.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>  
</html>