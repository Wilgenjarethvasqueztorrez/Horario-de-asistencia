<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Registrar Asistencia</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">  
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />  
    <link rel="stylesheet" href="../../src/css/styles.css" />
</head>
<body class="bg-light">  
    
    <div class="container" style="max-width: 650px;">  
        
        <div class="form-card-container">
            <h1 class="form-title-custom text-center mb-4">📝 Registrar Asistencia</h1>  
            
            <form action="../../CRUD/Asistencia/insertarAsistencia.php" method="post">  
                
                <div class="mb-3">
                    <label class="form-label-custom">Empleado</label>  
                    <select id="select2" class="form-select form-control-custom" name="EmpleadoId" required>  
                        <option selected disabled value="">-- Seleccionar empleado --</option>  
                        <?php  
                        include ("../../Config/Conexion.php");  
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
                </div>
      
                <div class="mb-3">  
                    <label class="form-label-custom">Fecha</label>  
                    <input type="date" class="form-control form-control-custom" name="Fecha" value="<?php echo date('Y-m-d'); ?>" required>  
                </div>  
      
                <div class="mb-3">  
                    <label class="form-label-custom">Hora de Entrada</label>  
                    <input type="time" class="form-control form-control-custom" name="HoraEntrada" id="horaEntrada" required>  
                </div>  
      
                <div class="mb-3">  
                    <label class="form-label-custom">Hora de Salida</label>  
                    <input type="time" class="form-control form-control-custom" name="HoraSalida" id="horaSalida">  
                </div>  
      
                <div class="mb-4">  
                    <label class="form-label-custom">Total de Horas</label>  
                    <input type="text" class="form-control form-control-custom" name="TotalHoras" id="totalHoras" readonly>  
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
      
                <div class="d-flex justify-content-center gap-3">  
                    <button type="submit" class="btn-submit-custom">
                        <i class="bi bi-check-circle-fill me-1"></i> Registrar
                    </button>  
                    <a href="../../pages/asistencia.php" class="btn-cancel-custom text-decoration-none d-flex align-items-center justify-content-center">
                        <i class="bi bi-x-circle-fill me-1"></i> 
                        Cancelar
                    </a>
                </div>  
            </form>  
        </div>

    </div>  

    <?php include('../../src/includes/Dependencias/Flatpickr.php'); ?> 
    <?php include('../../src/includes/Dependencias/Select2.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>