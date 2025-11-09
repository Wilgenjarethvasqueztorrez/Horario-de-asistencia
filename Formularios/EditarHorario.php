
<!doctype html>  
<html lang="es">  
  <head>  
   <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Editar horario</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
  </head>  
<body>  
 <h1 class="bg-primary p-2 text-white text-center">Editar Horario</h1>  
 <br>  
 <form class="container" action="../CRUD/editarHorario.php" method="post">  
  <?php  
   include ('../Config/Conexion.php');  
   $sql = "SELECT * FROM horarios WHERE id = " . $_GET['Id'];  
   $resultado = $conexion->query($sql);  
   $row = $resultado->fetch_assoc();  
  ?>  
  <input type="hidden" class="form-control" name="Id" value="<?php echo $row['id']; ?>">  
  
  <!-- Nombre del horario -->  
  <div class="mb-3">  
    <label class="form-label">Nombre del Horario</label>  
    <input type="text" class="form-control" name="Nombre" value="<?php echo $row['nombre']; ?>" required>  
  </div>  
  
  <!-- Tipo de horario -->  
  <div class="mb-3">  
    <label class="form-label">Tipo de Horario</label>  
    <select class="form-select" name="Tipo" id="tipoHorario" required>  
      <option value="Fijo" <?php echo ($row['tipo'] == 'Fijo') ? 'selected' : ''; ?>>Fijo</option>  
      <option value="Flexible" <?php echo ($row['tipo'] == 'Flexible') ? 'selected' : ''; ?>>Flexible</option>  
    </select>  
  </div>  
  
  <!-- Hora inicio -->  
  <div class="mb-3" id="horaInicioDiv" style="display:<?php echo ($row['tipo'] == 'Fijo') ? 'block' : 'none'; ?>;">  
    <label class="form-label">Hora de Inicio</label>  
    <input type="time" class="form-control" name="HoraInicio" id="horaInicio" value="<?php echo $row['hora_inicio']; ?>">  
  </div>  
  
  <!-- Hora fin -->  
  <div class="mb-3" id="horaFinDiv" style="display:<?php echo ($row['tipo'] == 'Fijo') ? 'block' : 'none'; ?>;">  
    <label class="form-label">Hora de Fin</label>  
    <input type="time" class="form-control" name="HoraFin" id="horaFin" value="<?php echo $row['hora_fin']; ?>">  
  </div>  
  
  <!-- Horas mínimas -->  
  <div class="mb-3">  
    <label class="form-label">Horas Mínimas Requeridas</label>  
    <input type="number" class="form-control" name="HorasMinimas" step="0.5" min="0" max="24" value="<?php echo $row['horas_minimas']; ?>" required>  
  </div>  
  
  <!-- Botones -->  
  <div class="text-center">  
   <button type="submit" class="btn btn-primary">Actualizar</button>  
   <a href="../horario.php" class="btn btn-dark">Cancelar</a> 
  </div>
 
 </form>
</body>
