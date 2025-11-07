<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Registrar Asistencia</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
</head>  
<body>  
    <h1 class="bg-primary p-2 text-white text-center">Registrar Asistencia</h1>  
    <div class="container">  
        <form action="../CRUD/insertarAsistencia.php" method="post">  
            <!-- Seleccionar empleado -->  
            <label for="">Empleado</label>  
            <select class="form-select mb-3" name="EmpleadoId" required>  
                <option selected disabled>--Seleccionar empleado--</option>  
                <?php  
                include ("../Config/Conexion.php");  
                $sql = $conexion->query("SELECT empleados.id,   
                                                usuarios.nombre,   
                                                usuarios.apellido,   
                                                roles.nombre as rol_nombre     
                                         FROM empleados  
                                         INNER JOIN usuarios ON empleados.empleado_id = usuarios.id  
                                         INNER JOIN roles ON empleados.rol_id = roles.id     
                                         WHERE empleados.activo = 1     
                                         ORDER BY usuarios.nombre ASC");  
                while ($resultado = $sql->fetch_assoc()) {  
                    echo "<option value='".$resultado['id']."'>".$resultado['nombre']." ".$resultado['apellido']." - ".$resultado['rol_nombre']."</option>";  
                }  
                ?>  
            </select>  
  
            <!-- Fecha -->  
            <div class="mb-3">  
                <label class="form-label">Fecha</label>  
                <input type="date" class="form-control" name="Fecha" value="<?php echo date('Y-m-d'); ?>" required>  
            </div>  
  
            <!-- Hora de entrada -->  
            <div class="mb-3">  
                <label class="form-label">Hora de Entrada</label>  
                <input type="time" class="form-control" name="HoraEntrada" id="horaEntrada" required>  
            </div>  
  
            <!-- Hora de salida -->  
            <div class="mb-3">  
                <label class="form-label">Hora de Salida</label>  
                <input type="time" class="form-control" name="HoraSalida" id="horaSalida">  
            </div>  
  
            <!-- Total de horas (calculado automáticamente) -->  
            <div class="mb-3">  
                <label class="form-label">Total de Horas</label>  
                <input type="text" class="form-control" name="TotalHoras" id="totalHoras" readonly>  
            </div>  
  
            <script>  
                function calcularHoras() {  
                    const entrada = document.getElementById("horaEntrada").value;  
                    const salida = document.getElementById("horaSalida").value;  
  
                    if (entrada && salida) {  
                        const [hEntrada, mEntrada] = entrada.split(":").map(Number);  
                        const [hSalida, mSalida] = salida.split(":").map(Number);  
  
                        const entradaMin = hEntrada * 60 + mEntrada;  
                        const salidaMin = hSalida * 60 + mSalida;  
  
                        let totalMin = salidaMin - entradaMin;  
                        if (totalMin < 0) totalMin += 24 * 60; // Soporte para turnos nocturnos  
  
                        const horas = Math.floor(totalMin / 60);  
                        const minutos = totalMin % 60;  
                            
                        // Formato decimal para la base de datos  
                        const totalDecimal = (horas + minutos / 60).toFixed(2);  
                        document.getElementById("totalHoras").value = totalDecimal;  
                    }  
                }  
  
                document.addEventListener("DOMContentLoaded", function() {  
                    document.getElementById("horaEntrada").addEventListener("change", calcularHoras);  
                    document.getElementById("horaSalida").addEventListener("change", calcularHoras);  
                });  
            </script>  
  
            <!-- Botones -->  
            <div class="text-center">  
                <button type="submit" class="btn btn-primary">Registrar</button>  
                <a href="../asistencia.php" class="btn btn-dark">Cancelar</a>  
            </div>  
        </form>  
    </div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>