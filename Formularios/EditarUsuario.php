<!doctype html>  
<html lang="es">  
<head>  
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Editar Usuario del Sistema</title>  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
</head>  
<body>  
  <h1 class="bg-primary p-2 text-white text-center">Editar Usuario</h1>  
  <br>  
  <form class="container" action="../CRUD/editarUsuario.php" method="post">  
    <?php  
    include ('../Config/Conexion.php');  
      
    // Obtener datos del usuario  
    $sql = "SELECT id, nombre, apellido, correo, rol_sistema   
            FROM usuarios   
            WHERE id = " . $_GET['Id'];  
    $resultado = $conexion->query($sql);  
    $row = $resultado->fetch_assoc();  
    ?>  
      
    <input type="hidden" class="form-control" name="Id" value="<?php echo $row['id']; ?>">  
      
    <!-- Nombre -->  
    <div class="mb-3">  
      <label class="form-label">Nombre</label>  
      <input type="text" class="form-control" name="NombreUsuario" value="<?php echo $row['nombre']; ?>" required>  
    </div>  
      
    <!-- Apellido -->  
    <div class="mb-3">  
      <label class="form-label">Apellido</label>  
      <input type="text" class="form-control" name="ApellidoUsuario" value="<?php echo $row['apellido']; ?>" required>  
    </div>  
      
    <!-- Correo -->  
    <div class="mb-3">  
      <label class="form-label">Correo Electrónico</label>  
      <input type="email" class="form-control" name="CorreoUsuario" value="<?php echo $row['correo']; ?>" required>  
    </div>  
      
    <!-- Rol del Sistema -->  
    <label for="">Rol del Sistema</label>  
    <select class="form-select mb-3" name="RolSistema" required>  
      <option disabled>--Seleccionar rol del sistema--</option>  
      <option value="Administrador" <?php echo ($row['rol_sistema'] == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>  
      <option value="Oficina" <?php echo ($row['rol_sistema'] == 'Oficina') ? 'selected' : ''; ?>>Oficina</option> 
      <option value="Empleado" <?php echo ($row['rol_sistema'] == 'Empleado') ? 'selected' : ''; ?>>Empleado</option>  
    </select>  
      
    <!-- Botones -->  
    <div class="text-center">  
      <button type="submit" class="btn btn-primary">Actualizar</button>  
      <a href="../index.php" class="btn btn-dark">Cancelar</a>  
    </div>  
  </form>  
</body>  
</html>
