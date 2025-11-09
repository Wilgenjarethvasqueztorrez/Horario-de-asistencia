<!doctype html>  
<html lang="es">  
  <head>  
   <meta charset="UTF-8">  
   <meta name="viewport" content="width=device-width, initial-scale=1">  
   <title>Editar Rol</title>  
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
  </head>  
<body>  
 <h1 class="bg-primary p-2 text-white text-center">Editar Rol</h1>  
 <br>  
 <form class="container" action="../CRUD/editarRol.php" method="post">  
  <?php  
   include ('../Config/Conexion.php');  
   $sql = "SELECT * FROM roles WHERE id = " . $_GET['Id'];  
   $resultado = $conexion->query($sql);  
   $row = $resultado->fetch_assoc();  
  ?>  
  <input type="hidden" class="form-control" name="Id" value="<?php echo $row['id']; ?>">  
  
  <!-- Nombre del rol -->  
  <div class="mb-3">  
    <label class="form-label">Nombre del Rol</label>  
    <input type="text" class="form-control" name="Nombre" value="<?php echo $row['nombre']; ?>" required>  
  </div>  
  
  <!-- Descripción -->  
  <div class="mb-3">  
    <label class="form-label">Descripción</label>  
    <textarea class="form-control" name="Descripcion" rows="3"><?php echo $row['descripcion']; ?></textarea>  
  </div>  
  
  <!-- Horario asignado -->  
  <label for="">Horario Asignado</label>  
  <select class="form-select mb-3" name="HorarioId">  
    <option value="">--Sin horario asignado--</option>  
    <?php  
      $sqlHorario = $conexion->query("SELECT id, nombre, tipo FROM horarios ORDER BY nombre");  
      while ($horario = $sqlHorario->fetch_assoc()) {  
        $selected = ($row['horario_id'] == $horario['id']) ? "selected" : "";  
        echo "<option value='".$horario['id']."' $selected>".$horario['nombre']." (".$horario['tipo'].")</option>";  
      }  
    ?>  
  </select>  
  
  <!-- Botones -->  
  <div class="text-center">  
    <button type="submit" class="btn btn-primary">Actualizar</button>  
    <a href="../rol.php" class="btn btn-dark">Cancelar</a>  
  </div>  
 </form>  
</body>  
</html>