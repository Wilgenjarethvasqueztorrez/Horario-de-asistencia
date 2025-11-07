<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Agregar Empleado</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
<body>  
    <h1 class="bg-primary p-2 text-white text-center">Agregar Empleado</h1>  
    <div class="container">  
        <form action="../CRUD/insertarEmpleado.php" method="post">  
            <!-- Seleccionar usuario -->  
            <label for="">Usuario del Sistema</label>  
            <select class="form-select mb-3" name="UsuarioId" required>  
                <option selected disabled>--Seleccionar usuario--</option>  
                <?php  
                include ("../Config/Conexion.php");  
                $sql = $conexion->query("SELECT id, nombre, apellido, correo, rol_sistema   
                                         FROM usuarios  WHERE rol_sistema = 'Empleado' 
                                         ORDER BY nombre ASC");  
                while ($resultado = $sql->fetch_assoc()) {  
                    echo "<option value='".$resultado['id']."'>"  
                         .$resultado['nombre']." ".$resultado['apellido']  
                         ." (".$resultado['rol_sistema'].") - ".$resultado['correo']."</option>";  
                }  
                ?>  
            </select>  
  
            <!-- Seleccionar rol laboral -->  
            <label for="">Rol Laboral</label>  
            <select class="form-select mb-3" name="RolId" required>  
                <option selected disabled>--Seleccionar rol laboral--</option>  
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
  
            <!-- Estado activo -->  
            <label for="">Estado</label>  
            <select class="form-select mb-3" name="Activo" required>  
                <option value="1" selected>Activo</option>  
                <option value="0">Inactivo</option>  
            </select>  
  
            <!-- Botones -->  
            <div class="text-center">  
                <button type="submit" class="btn btn-primary">Registrar</button>  
                <a href="../empleado.php" class="btn btn-dark">Cancelar</a>  
            </div>  
        </form>  
    </div>  
</body>  
</html>