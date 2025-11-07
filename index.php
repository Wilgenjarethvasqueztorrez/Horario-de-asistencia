<!doctype html>  
<html lang="es">  
<head>  
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Gestión de Usuarios del Sistema</title>  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">  
  <link rel="stylesheet" href="src/css/styles.css">  
</head>  
<body>  

 <?php include('src/includes/sidebar.php'); ?>  

  <main class="container mt-4">  
    <h1 class="bg-primary p-3 text-white text-center rounded">👥 GESTIÓN DE USUARIOS DEL SISTEMA</h1>  
    
    <div class="text-end mb-3">  
      <a href="Formularios/AgregarUsuario.php" class="btn btn-success">  
        <i class="bi bi-plus-circle"></i> Agregar Usuario  
      </a>  
    </div>  
    
    <div class="table-container">  
      <table class="table table-hover">  
        <thead>  
          <tr>  
            <th>Nombre Completo</th>  
            <th>Correo</th>  
            <th>Rol del Sistema</th>  
            <th>Acciones</th>  
          </tr>  
        </thead>  
        <tbody>  
          <?php  
          require("Config/Conexion.php");  
  
          $sql = $conexion->query("SELECT id, nombre, apellido, correo, rol_sistema  
                                   FROM usuarios  
                                   ORDER BY nombre ASC");  
  
          while ($resultado = $sql->fetch_assoc()) {  
          ?>  
            <tr>  
              <td>  
                <strong><?php echo $resultado['nombre'] . ' ' . $resultado['apellido']; ?></strong>  
              </td>  
              <td><?php echo $resultado['correo']; ?></td>  
              <td>  
                <?php   
                $badge_class = '';  
                switch($resultado['rol_sistema']) {  
                  case 'Administrador':  
                    $badge_class = 'bg-danger';  
                    break;  
                  case 'Oficina':  
                    $badge_class = 'bg-warning text-dark';  
                    break;  
                  case 'Empleado':  
                    $badge_class = 'bg-info';  
                    break;  
                }  
                echo "<span class='badge $badge_class'>".$resultado['rol_sistema']."</span>";  
                ?>  
              </td>  
              <td class="acciones">  
                <a href="Formularios/EditarUsuario.php?Id=<?php echo $resultado['id']; ?>" class="btn btn-warning btn-sm">  
                  <i class="bi bi-pencil"></i> Editar  
                </a>  
                <a href="CRUD/eliminarUsuario.php?Id=<?php echo $resultado['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este usuario? Esto también eliminará su registro de empleado si existe.')">  
                  <i class="bi bi-trash3"></i> Eliminar  
                </a>  
              </td>  
            </tr>  
          <?php } ?>  
        </tbody>  
      </table>  
    </div>  
  </main>  
    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>
