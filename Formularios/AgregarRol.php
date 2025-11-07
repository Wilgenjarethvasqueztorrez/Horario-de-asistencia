<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Agregar Rol</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
</head>  
<body>  
    <h1 class="bg-primary p-2 text-white text-center">Agregar Rol</h1>  
    <div class="container">  
        <form action="../CRUD/insertarRol.php" method="post">  
            <!-- Nombre del rol -->  
            <div class="mb-3">  
                <label class="form-label">Nombre del Rol</label>  
                <input type="text" class="form-control" name="Nombre" placeholder="Ej: Contador" required>  
            </div>  
  
            <!-- Descripción -->  
            <div class="mb-3">  
                <label class="form-label">Descripción</label>  
                <textarea class="form-control" name="Descripcion" rows="3" placeholder="Descripción del rol (opcional)"></textarea>  
            </div>  
  
            <!-- Horario asignado -->  
            <label for="">Horario Asignado</label>  
            <select class="form-select mb-3" name="HorarioId">  
                <option value="" selected>--Sin horario asignado--</option>  
                <?php  
                include ("../Config/Conexion.php");  
                $sql = $conexion->query("SELECT id, nombre, tipo FROM horarios ORDER BY nombre");  
                while ($resultado = $sql->fetch_assoc()) {  
                    echo "<option value='".$resultado['id']."'>".$resultado['nombre']." (".$resultado['tipo'].")</option>";  
                }  
                ?>  
            </select>  
  
            <!-- Botones -->  
            <div class="text-center">  
                <button type="submit" class="btn btn-primary">Registrar</button>  
                <a href="../rol.php" class="btn btn-dark">Cancelar</a>  
            </div>  
        </form>  
    </div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>
