<!doctype html>  
<html lang="es">  
<head>  
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Gestión de Asistencias</title>  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">  
  <link rel="stylesheet" href="src/css/styles.css">  
</head>  
<body>  
  
  <?php include('src/includes/sidebar.php'); ?>  

  <main class="container mt-4">  
    <h1 class="bg-info p-3 text-white text-center rounded">📋 LISTADO DE ASISTENCIAS</h1>  
  
    <div class="text-end mb-3">  
      <a href="Formularios/AgregarAsistencia.php" class="btn btn-success">  
        <i class="bi bi-plus-circle"></i> Registrar Asistencia  
      </a>  
    </div>  
  
    <div class="table-container">  
      <table class="table table-hover">  
        <thead>  
          <tr>  
            <th>Empleado</th>  
            <th>Rol</th>  
            <th>Fecha</th>  
            <th>Hora Entrada</th>  
            <th>Hora Salida</th>  
            <th>Total Horas</th>  
            <th>Acciones</th>  
          </tr>  
        </thead>  
        <tbody>  
          <?php  
          require("Config/Conexion.php");  
  
          $sql = $conexion->query("SELECT asistencias.*,     
                                          usuarios.nombre,     
                                          usuarios.apellido,  
                                          roles.nombre as rol_nombre    
                                   FROM asistencias     
                                   INNER JOIN empleados ON asistencias.empleado_id = empleados.id  
                                   INNER JOIN usuarios ON empleados.empleado_id = usuarios.id  
                                   INNER JOIN roles ON empleados.rol_id = roles.id    
                                   ORDER BY asistencias.fecha DESC, asistencias.hora_entrada DESC");  
  
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
              <td><?php echo date('d/m/Y', strtotime($resultado['fecha'])); ?></td>  
              <td><?php echo $resultado['hora_entrada']; ?></td>  
              <td>  
                <?php   
                if ($resultado['hora_salida']) {  
                  echo $resultado['hora_salida'];  
                } else {  
                  echo "<span class='badge bg-warning'>Sin registrar</span>";  
                }  
                ?>  
              </td>  
              <td>  
                <?php   
                if ($resultado['total_horas'] > 0) {  
                  echo number_format($resultado['total_horas'], 2) . " hrs";  
                } else {  
                  echo "<span class='text-muted'>-</span>";  
                }  
                ?>  
              </td>  
              <td class="acciones">  
                <a href="CRUD/eliminarAsistencia.php?Id=<?php echo $resultado['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este registro de asistencia?')">  
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