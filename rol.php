<!doctype html>  
<html lang="es">  
<head>  
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Roles</title>  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">  
  <link rel="stylesheet" href="src/css/styles.css">  
</head>  
<body>  
  
  <?php include('src/includes/sidebar.php'); ?>  

  <main class="container mt-4">  
    <h1 class="bg-info p-3 text-white text-center rounded">📋 LISTADO DE ROLES</h1>  
  
    <div class="text-end mb-3">  
      <a href="Formularios/AgregarRol.php" class="btn btn-success">  
        <i class="bi bi-plus-circle"></i> Agregar Rol  
      </a>  
    </div>  
  
    <div class="table-container">  
      <table class="table table-hover">  
        <thead>  
          <tr>  
            <th>Nombre</th>  
            <th>Descripción</th>  
            <th>Horario Asignado</th>  
            <th>Acciones</th>  
          </tr>  
        </thead>  
        <tbody>  
          <?php  
            require("Config/Conexion.php");  
            $sql = $conexion->query("SELECT roles.*, horarios.nombre as horario_nombre, horarios.tipo as horario_tipo  
                                     FROM roles   
                                     LEFT JOIN horarios ON roles.horario_id = horarios.id   
                                     ORDER BY roles.nombre ASC");  
            while ($resultado = $sql->fetch_assoc()) {  
          ?>  
          <tr>  
            <td><strong><?php echo $resultado['nombre']; ?></strong></td>  
            <td><?php echo $resultado['descripcion'] ? $resultado['descripcion'] : '<span class="text-muted">Sin descripción</span>'; ?></td>  
            <td>  
              <?php   
              if ($resultado['horario_nombre']) {  
                echo $resultado['horario_nombre'] . " (" . $resultado['horario_tipo'] . ")";  
              } else {  
                echo "<span class='text-muted'>Sin horario asignado</span>";  
              }  
              ?>  
            </td>  
            <td class="acciones">  
              <a href="Formularios/EditarRol.php?Id=<?php echo $resultado['id']; ?>" class="btn btn-warning btn-sm">  
                <i class="bi bi-pencil"></i> Editar  
              </a>  
              <a href="CRUD/eliminarRol.php?Id=<?php echo $resultado['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este rol? Los usuarios con este rol quedarán sin rol asignado.')">  
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
