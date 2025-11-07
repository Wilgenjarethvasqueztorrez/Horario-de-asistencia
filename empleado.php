<!doctype html>  
<html lang="es">  
<head>  
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Gestión de Empleados</title>  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">  
  <link rel="stylesheet" href="src/css/styles.css">  
</head>  
<body>  
    
  <?php include('src/includes/sidebar.php'); ?>  

  <main class="container mt-4">  
    <h1 class="bg-info p-3 text-white text-center rounded">👷 GESTIÓN DE EMPLEADOS</h1>  
    
    <div class="text-end mb-3">  
      <a href="Formularios/AgregarEmpleado.php" class="btn btn-success">  
        <i class="bi bi-plus-circle"></i> Agregar Empleado  
      </a>  
      <a href="Formularios/RegistrarAsistencia.php" class="btn btn-primary">  
        <i class="bi bi-clock"></i> Registrar Asistencia  
      </a>  
    </div>  
    
    <div class="table-container">  
      <table class="table table-hover">  
        <thead>  
          <tr>  
            <th>Nombre</th>  
            <th>Rol Laboral</th>  
            <th>Horario Asignado</th>  
            <th>Estado</th>  
            <th>Acciones</th>  
          </tr>  
        </thead>  
        <tbody>  
          <?php  
          require("Config/Conexion.php");  
  
          $sql = $conexion->query("SELECT empleados.id,  
                                          usuarios.nombre,  
                                          usuarios.apellido,  
                                          roles.nombre as rol_nombre,  
                                          horarios.nombre as horario_nombre,  
                                          horarios.tipo as horario_tipo,  
                                          empleados.activo  
                                   FROM empleados  
                                   INNER JOIN usuarios ON empleados.empleado_id = usuarios.id  
                                   INNER JOIN roles ON empleados.rol_id = roles.id  
                                   LEFT JOIN horarios ON roles.horario_id = horarios.id  
                                   ORDER BY usuarios.nombre ASC");  
  
          while ($resultado = $sql->fetch_assoc()) {  
          ?>  
            <tr>  
              <td>  
                <div class="nombre-apellido">  
                  <span><strong><?php echo $resultado['nombre']; ?></strong></span>  
                  <span><?php echo $resultado['apellido']; ?></span>  
                </div>  
              </td>  
              <td><?php echo $resultado['rol_nombre']; ?></td>  
              <td>  
                <?php   
                if ($resultado['horario_nombre']) {  
                  echo $resultado['horario_nombre'] . " (" . $resultado['horario_tipo'] . ")";  
                } else {  
                  echo "<span class='text-muted'>Sin horario asignado</span>";  
                }  
                ?>  
              </td>  
              <td>  
                <?php   
                if ($resultado['activo'] == 1) {  
                  echo "<span class='badge bg-success'>Activo</span>";  
                } else {  
                  echo "<span class='badge bg-secondary'>Inactivo</span>";  
                }  
                ?>  
              </td>  
              <td class="acciones">  
                <a href="Formularios/EditarEmpleado.php?Id=<?php echo $resultado['id']; ?>" class="btn btn-warning btn-sm">  
                  <i class="bi bi-pencil"></i> Editar  
                </a>  
                <a href="CRUD/eliminarEmpleado.php?Id=<?php echo $resultado['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este empleado?')">  
                  <i class="bi bi-trash3"></i> Eliminar  
                </a>  
                <a href="Formularios/VerAsistencias.php?Id=<?php echo $resultado['id']; ?>" class="btn btn-info btn-sm">  
                  <i class="bi bi-calendar-check"></i> Asistencias  
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