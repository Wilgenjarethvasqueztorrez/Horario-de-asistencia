<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Agregar Usuario del Sistema</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
</head>  
<body>  
    <h1 class="bg-primary p-2 text-white text-center">Agregar Usuario</h1>  
    <div class="container">  
        <form action="../CRUD/insertarUsuario.php" method="post">  
              
            <!-- Nombre -->  
            <div class="mb-3">  
                <label class="form-label">Nombre</label>  
                <input type="text" class="form-control" name="NombreUsuario" required>  
            </div>  
              
            <!-- Apellido -->  
            <div class="mb-3">  
                <label class="form-label">Apellido</label>  
                <input type="text" class="form-control" name="ApellidoUsuario" required>  
            </div>  
              
            <!-- Correo -->  
            <div class="mb-3">  
                <label class="form-label">Correo Electrónico</label>  
                <input type="email" class="form-control" name="CorreoUsuario" required>  
            </div>  
              
            <!-- Rol del Sistema -->  
            <label for="">Rol del Sistema</label>  
            <select class="form-select mb-3" name="RolSistema" required>  
                <option selected disabled>--Seleccionar rol del sistema--</option>  
                <option value="Administrador">Administrador</option>  
                <option value="Oficina">Oficina</option>  
                <option value="Empleado">Empleado</option>  
            </select>  
              
            <!-- Botones -->  
            <div class="text-center">  
                <button type="submit" class="btn btn-primary">Registrar</button>  
                <a href="../index.php" class="btn btn-dark">Cancelar</a>  
            </div>  
        </form>  
    </div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>
