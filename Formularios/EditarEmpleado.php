<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Editar Empleado</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
</head>  
<body>  
    <h1 class="bg-primary p-2 text-white text-center">Editar Empleado</h1>  
    <div class="container">  
        <?php  
        include ('../Config/Conexion.php');  
        $sql = "SELECT * FROM empleados WHERE id = " . $_GET['Id'];  
        $resultado = $conexion->query($sql);  
        $row = $resultado->fetch_assoc();  
        ?>  
          
        <form action="../CRUD/editarEmpleado.php" method="post">  
            <input type="hidden" name="Id" value="<?php echo $row['id']; ?>">  
  
            <!-- Seleccionar usuario -->  
            <label for="">Usuario del Sistema</label>  
            <select class="form-select mb-3" name="UsuarioId" required>  
                <?php  
                $sqlUsuarios = $conexion->query("SELECT id, nombre, apellido, correo, rol_sistema FROM usuarios WHERE rol_sistema = 'Empleado'  ORDER BY nombre ASC");  
                while ($usuario = $sqlUsuarios->fetch_assoc()) {  
                    $selected = ($row['empleado_id'] == $usuario['id']) ? "selected" : "";  
                    echo "<option value='".$usuario['id']."' $selected>"  
                         .$usuario['nombre']." ".$usuario['apellido']  
                         ." (".$usuario['rol_sistema'].") - ".$usuario['correo']."</option>";  
                }  
                ?>  
            </select>  
  
            <!-- Seleccionar rol laboral -->  
            <label for="">Rol Laboral</label>  
            <select class="form-select mb-3" name="RolId" required>  
                <?php  
                $sqlRoles = $conexion->query("SELECT roles.id, roles.nombre, roles.descripcion, horarios.nombre as horario_nombre   
                                              FROM roles   
                                              LEFT JOIN horarios ON roles.horario_id = horarios.id   
                                              ORDER BY roles.nombre");  
                while ($rol = $sqlRoles->fetch_assoc()) {  
                    $selected = ($row['rol_id'] == $rol['id']) ? "selected" : "";  
                    $descripcion = $rol['descripcion'] ? " - " . $rol['descripcion'] : "";  
                    $horario = $rol['horario_nombre'] ? " [" . $rol['horario_nombre'] . "]" : "";  
                    echo "<option value='".$rol['id']."' $selected>".$rol['nombre'].$descripcion.$horario."</option>";  
                }  
                ?>  
            </select>  
  
            <!-- Estado activo -->  
            <label for="">Estado</label>  
            <select class="form-select mb-3" name="Activo" required>  
                <option value="1" <?php echo ($row['activo'] == 1) ? "selected" : ""; ?>>Activo</option>  
                <option value="0" <?php echo ($row['activo'] == 0) ? "selected" : ""; ?>>Inactivo</option>  
            </select>  
  
            <!-- Botones -->  
            <div class="text-center">  
                <button type="submit" class="btn btn-primary">Actualizar</button>  
                <a href="../empleado.php" class="btn btn-dark">Cancelar</a>  
            </div>  
        </form>  
    </div>  
</body>  
</html>