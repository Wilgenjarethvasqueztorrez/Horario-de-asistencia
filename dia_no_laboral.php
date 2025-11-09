<!doctype html>  
<html lang="es">  
<head>  
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <title>Días No Laborales</title>  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">  
  <link rel="stylesheet" href="src/css/styles.css">  
</head>  
<body>  
    
  <?php include('src/includes/sidebar.php'); ?>  

  <main class="container mt-4">  
    <h1 class="bg-info p-3 text-white text-center rounded">📅 GESTIÓN DE DÍAS NO LABORALES</h1>  
  
    <div class="text-end mb-3">  
      <a href="Formularios/AgregarDiaNoLaboral.php" class="btn btn-success">  
        <i class="bi bi-plus-circle"></i> Agregar Día No Laboral  
      </a>  
    </div>  
  
    <!-- Tabs para separar Feriados y Vacaciones -->  
    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">  
      <li class="nav-item" role="presentation">  
        <button class="nav-link active" id="feriados-tab" data-bs-toggle="tab" data-bs-target="#feriados" type="button">  
          🏛️ Feriados  
        </button>  
      </li>  
      <li class="nav-item" role="presentation">  
        <button class="nav-link" id="vacaciones-tab" data-bs-toggle="tab" data-bs-target="#vacaciones" type="button">  
          🏖️ Vacaciones  
        </button>  
      </li>  
    </ul>  
  
    <div class="tab-content" id="myTabContent">  
      <!-- Tab de Feriados -->  
      <div class="tab-pane fade show active" id="feriados" role="tabpanel">  
        <div class="table-container">  
          <table class="table table-hover">  
            <thead>  
              <tr>  
                <th>Fecha Inicio</th>  
                <th>Fecha Fin</th>  
                <th>Días</th>  
                <th>Descripción</th>  
                <th>Acciones</th>  
              </tr>  
            </thead>  
            <tbody>  
              <?php  
                require("Config/Conexion.php");  
                $sqlFeriados = $conexion->query("SELECT * FROM dias_no_laborales   
                                                  WHERE motivo = 'Feriado'   
                                                  ORDER BY fecha_inicio ASC");  
                while ($feriado = $sqlFeriados->fetch_assoc()) {  
                  $dias = (strtotime($feriado['fecha_fin']) - strtotime($feriado['fecha_inicio'])) / 86400 + 1;  
              ?>  
              <tr>  
                <td><?php echo date('d/m/Y', strtotime($feriado['fecha_inicio'])); ?></td>  
                <td><?php echo date('d/m/Y', strtotime($feriado['fecha_fin'])); ?></td>  
                <td><span class="badge bg-info"><?php echo $dias; ?> día(s)</span></td>  
                <td><?php echo $feriado['descripcion'] ? $feriado['descripcion'] : '<span class="text-muted">Sin descripción</span>'; ?></td>  
                <td class="acciones">  
                  <a href="Formularios/EditarDiaNoLaboral.php?Id=<?php echo $feriado['id']; ?>" class="btn btn-warning btn-sm">  
                    <i class="bi bi-pencil"></i> Editar  
                  </a>  
                  <a href="CRUD/eliminarDiaNoLaboral.php?Id=<?php echo $feriado['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este feriado?')">  
                    <i class="bi bi-trash3"></i> Eliminar  
                  </a>  
                </td>  
              </tr>  
              <?php } ?>  
            </tbody>  
          </table>  
        </div>  
      </div>  
  
      <div class="tab-pane fade" id="vacaciones" role="tabpanel">  
        <div class="table-container">  
          <table class="table table-hover">  
            <thead>  
              <tr>  
                <th>Empleado</th>  
                <th>Rol</th>  
                <th>Fecha Inicio</th>  
                <th>Fecha Fin</th>  
                <th>Días</th>  
                <th>Descripción</th>  
                <th>Acciones</th>  
              </tr>  
            </thead>  
            <tbody>  
              <?php  
                $sqlVacaciones = $conexion->query("SELECT dias_no_laborales.*,   
                                                           usuarios.nombre,   
                                                           usuarios.apellido,  
                                                           roles.nombre as rol_nombre  
                                                    FROM dias_no_laborales  
                                                    INNER JOIN empleados ON dias_no_laborales.empleado_id = empleados.id  
                                                    INNER JOIN usuarios ON empleados.empleado_id = usuarios.id  
                                                    INNER JOIN roles ON empleados.rol_id = roles.id  
                                                    WHERE dias_no_laborales.motivo = 'Vacaciones'  
                                                    ORDER BY dias_no_laborales.fecha_inicio DESC");  
                while ($vacacion = $sqlVacaciones->fetch_assoc()) {  
                  $dias = (strtotime($vacacion['fecha_fin']) - strtotime($vacacion['fecha_inicio'])) / 86400 + 1;  
              ?>  
              <tr>  
                <td>  
                  <div class="nombre-apellido">  
                    <span><strong><?php echo $vacacion['nombre']; ?></strong></span>  
                    <span><?php echo $vacacion['apellido']; ?></span>  
                  </div>  
                </td>  
                <td><?php echo $vacacion['rol_nombre']; ?></td>  
                <td><?php echo date('d/m/Y', strtotime($vacacion['fecha_inicio'])); ?></td>  
                <td><?php echo date('d/m/Y', strtotime($vacacion['fecha_fin'])); ?></td>  
                <td><span class="badge bg-primary"><?php echo $dias; ?> día(s)</span></td>  
                <td><?php echo $vacacion['descripcion'] ? $vacacion['descripcion'] : '<span class="text-muted">Sin descripción</span>'; ?></td>  
                <td class="acciones">  
                  <a href="Formularios/EditarDiaNoLaboral.php?Id=<?php echo $vacacion['id']; ?>" class="btn btn-warning btn-sm">  
                    <i class="bi bi-pencil"></i> Editar  
                  </a>  
                  <a href="CRUD/eliminarDiaNoLaboral.php?Id=<?php echo $vacacion['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta vacación?')">  
                    <i class="bi bi-trash3"></i> Eliminar  
                  </a>  
                </td>  
              </tr>  
              <?php } ?>  
            </tbody>  
          </table>  
        </div>  
      </div>  
    </div>  
  </main>  
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>
