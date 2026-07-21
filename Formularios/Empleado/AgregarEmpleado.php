<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Agregar Empleado</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />  
    <link rel="stylesheet" href="../../src/css/styles.css" />
</head>
<body class="bg-light">  
    
    <div class="container" style="max-width: 650px;">  
        
        <div class="form-card-container">
             <h1 class="form-title-custom text-center mb-4">👷 Agregar Empleado</h1>  
            
            <form action="../../CRUD/Empleado/insertarEmpleado.php" method="post">  
                
                <div class="mb-3">
                    <label class="form-label-custom">Usuario del Sistema</label>  
                    <select id="select2" class="form-select form-control-custom" name="UsuarioId" required>  
                        <option selected disabled value="">-- Seleccionar usuario --</option>  
                        <?php  
                        include ("../../Config/Conexion.php");  
                        $sql = $conexion->query("SELECT id, nombre, apellido, correo, rol_sistema   
                                                 FROM usuarios WHERE rol_sistema = 'Empleado' 
                                                 ORDER BY nombre ASC");  
                        while ($resultado = $sql->fetch_assoc()) {  
                            echo "<option value='".$resultado['id']."'>"  
                                 .$resultado['nombre']." ".$resultado['apellido']  
                                 ." (".$resultado['rol_sistema'].") - ".$resultado['correo']."</option>";  
                        }  
                        ?>  
                    </select>  
                </div>
      
                <div class="mb-3">
                    <label class="form-label-custom">Rol Laboral</label>  
                    <select id="select2-rol" class="form-select form-control-custom" name="RolId" required>  
                        <option selected disabled value="">-- Seleccionar rol laboral --</option>  
                        <?php  
                        $sqlRol = $conexion->query("SELECT roles.id, roles.nombre, roles.descripcion, horarios.nombre as horario_nombre   
                                                    FROM roles   
                                                    LEFT JOIN horarios ON roles.horario_id = horarios.id   
                                                    ORDER BY roles.nombre");  
                        while ($rol = $sqlRol->fetch_assoc()) {  
                            $descripcion = $rol['descripcion'] ? " - " . $rol['descripcion'] : "";  
                            $horario = $rol['horario_nombre'] ? " [" . $rol['horario_nombre'] . "]" : "";  
                            echo "<option value='".$rol['id']."'>".$rol['nombre'].$descripcion.$horario."</option>";  
                        }  
                        ?>  
                    </select>  
                </div>
      
                <div class="mb-4">
                    <label class="form-label-custom">Estado</label>  
                    <select class="form-select form-control-custom" name="Activo" required>  
                        <option value="1" selected>🟢 Activo</option>  
                        <option value="0">🔴 Inactivo</option>  
                    </select>  
                </div>
      
                <div class="d-flex justify-content-center gap-3">  
                    <button type="submit" class="btn-submit-custom">
                        <i class="bi bi-check-circle-fill me-1"></i> Registrar
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
</body>  
</html>