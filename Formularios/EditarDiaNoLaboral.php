<!doctype html>  
<html lang="es">  
<head>  
   <meta charset="UTF-8">  
   <meta name="viewport" content="width=device-width, initial-scale=1">  
   <title>Editar Día No Laboral</title>  
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
</head>  
<body>  
 <h1 class="bg-primary p-2 text-white text-center">Editar Día No Laboral</h1>  
 <br>  
 <form class="container" action="../CRUD/editarDiaNoLaboral.php" method="post">  
  <?php  
   include ('../Config/Conexion.php');  
   $sql = "SELECT dias_no_laborales.*,   
                  usuarios.nombre,   
                  usuarios.apellido  
           FROM dias_no_laborales  
           LEFT JOIN empleados ON dias_no_laborales.empleado_id = empleados.id  
           LEFT JOIN usuarios ON empleados.empleado_id = usuarios.id  
           WHERE dias_no_laborales.id = " . $_GET['Id'];  
   $resultado = $conexion->query($sql);  
   $row = $resultado->fetch_assoc();  
  ?>  
  <input type="hidden" class="form-control" name="Id" value="<?php echo $row['id']; ?>">  
    
  <!-- Tipo de día no laboral (solo lectura) -->  
  <div class="mb-3">  
    <label class="form-label">Tipo</label>  
    <input type="text" class="form-control" value="<?php echo $row['motivo']; ?>" readonly>  
    <input type="hidden" name="Motivo" value="<?php echo $row['motivo']; ?>">  
  </div>  
  
  <!-- Información del empleado (solo para vacaciones) -->  
  <?php if ($row['motivo'] == 'Vacaciones' && $row['empleado_id']) { ?>  
  <div class="mb-3">  
    <label class="form-label">Empleado</label>  
    <input type="text" class="form-control" value="<?php echo $row['nombre'] . ' ' . $row['apellido']; ?>" readonly>  
    <input type="hidden" name="EmpleadoId" value="<?php echo $row['empleado_id']; ?>">  
  </div>  
  <?php } else { ?>  
    <input type="hidden" name="EmpleadoId" value="">  
  <?php } ?>  
  
  <!-- Fecha de inicio -->  
  <div class="mb-3">  
    <label class="form-label">Fecha de Inicio</label>  
    <input type="date" class="form-control" name="FechaInicio" value="<?php echo $row['fecha_inicio']; ?>" required>  
  </div>  
  
  <!-- Fecha de fin -->  
  <div class="mb-3">  
    <label class="form-label">Fecha de Fin</label>  
    <input type="date" class="form-control" name="FechaFin" value="<?php echo $row['fecha_fin']; ?>" required>  
  </div>  
  
  <!-- Descripción -->  
  <div class="mb-3">  
    <label class="form-label">Descripción</label>  
    <input type="text" class="form-control" name="Descripcion" value="<?php echo $row['descripcion']; ?>" placeholder="Ej: Día del Trabajador, Vacaciones anuales">  
  </div>  
  
  <!-- Botones -->  
  <div class="text-center">  
    <button type="submit" class="btn btn-primary">Actualizar</button>  
    <a href="../dia_no_laboral.php" class="btn btn-dark">Cancelar</a>  
  </div>  
 </form>  
</body>  
</html>