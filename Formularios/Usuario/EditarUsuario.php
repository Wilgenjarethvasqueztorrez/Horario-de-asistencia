<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Editar Usuario del Sistema</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../src/css/styles.css" />  
</head>  
<body class="bg-light">  
      
    <div class="container" style="max-width: 650px;">  
        
        <div class="form-card-container">
            <h1 class="form-title-custom text-center mb-4">📝 Editar Usuario</h1> 
            
            <form action="../../CRUD/Usuario/editarUsuario.php" method="post">  
                <?php
                include('../../Config/Conexion.php');

                // Obtener datos del usuario  
                $sql = "SELECT id, nombre, apellido, correo, rol_sistema   
                    FROM usuarios   
                    WHERE id = " . $_GET['Id'];
                $resultado = $conexion->query($sql);
                $row = $resultado->fetch_assoc();
                ?>

                <input type="hidden" name="Id" value="<?php echo $row['id']; ?>">

                <div class="mb-3">  
                    <label class="form-label-custom">Nombre</label>  
                    <input type="text" class="form-control form-control-custom" name="NombreUsuario" value="<?php echo $row['nombre']; ?>" required>  
                </div>  
                  
                <div class="mb-3">  
                    <label class="form-label-custom">Apellido</label>  
                    <input type="text" class="form-control form-control-custom" name="ApellidoUsuario" value="<?php echo $row['apellido']; ?>" required>  
                </div>  
                  
                <div class="mb-3">  
                    <label class="form-label-custom">Correo Electrónico</label>  
                    <input type="email" class="form-control form-control-custom" name="CorreoUsuario" value="<?php echo $row['correo']; ?>" required>  
                </div>  
                  
                <div class="mb-4">
                    <label class="form-label-custom">Rol del Sistema</label>  
                    <select class="form-select form-control-custom" name="RolSistema" required>  
                        <option disabled>-- Seleccionar rol del sistema --</option>  
                        <option value="Administrador" <?php echo ($row['rol_sistema'] == 'Administrador') ? 'selected' : ''; ?>>👨‍💼 Administrador</option>  
                        <option value="Oficina" <?php echo ($row['rol_sistema'] == 'Oficina') ? 'selected' : ''; ?>>💼 Oficina</option>  
                        <option value="Empleado" <?php echo ($row['rol_sistema'] == 'Empleado') ? 'selected' : ''; ?>>👷‍♂️ Empleado</option>  
                    </select>  
                </div>
                  
                <div class="d-flex justify-content-center gap-3">  
                    <button type="submit" class="btn-submit-custom">
                        <i class="bi bi-arrow-clockwise me-1"></i> Actualizar
                    </button>  
                    <a href="../../pages/usuario.php" class="btn-cancel-custom text-decoration-none d-flex align-items-center justify-content-center">
                        <i class="bi bi-x-circle-fill me-1"></i> 
                        Cancelar
                    </a>
                </div>  
            </form>  
        </div>

    </div>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>