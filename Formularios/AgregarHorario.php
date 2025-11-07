<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Agregar Horario</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">  
</head>  
<body>  
    <h1 class="bg-primary p-2 text-white text-center">Agregar Horario</h1>  
    <div class="container">  
        <form action="../CRUD/insertarHorario.php" method="post">  
            <!-- Nombre del horario -->  
            <div class="mb-3">  
                <label class="form-label">Nombre del Horario</label>  
                <input type="text" class="form-control" name="Nombre" placeholder="Ej: Turno Mañana" required>  
            </div>  
  
            <!-- Tipo de horario -->  
            <div class="mb-3">  
                <label class="form-label">Tipo de Horario</label>  
                <select class="form-select" name="Tipo" id="tipoHorario" required>  
                    <option value="" selected disabled>--Seleccionar tipo--</option>  
                    <option value="Fijo">Fijo</option>  
                    <option value="Flexible">Flexible</option>  
                </select>  
            </div>  
  
            <!-- Hora inicio (solo para tipo Fijo) -->  
            <div class="mb-3" id="horaInicioDiv" style="display:none;">  
                <label class="form-label">Hora de Inicio</label>  
                <input type="time" class="form-control" name="HoraInicio" id="horaInicio">  
            </div>  
  
            <!-- Hora fin (solo para tipo Fijo) -->  
            <div class="mb-3" id="horaFinDiv" style="display:none;">  
                <label class="form-label">Hora de Fin</label>  
                <input type="time" class="form-control" name="HoraFin" id="horaFin">  
            </div>  
  
            <!-- Horas mínimas -->  
            <div class="mb-3">  
                <label class="form-label">Horas Mínimas Requeridas</label>  
                <input type="number" class="form-control" name="HorasMinimas" step="0.5" min="0" max="24" value="8.00" required>  
            </div>  
  
            <!-- Botones -->  
            <div class="text-center">  
                <button type="submit" class="btn btn-primary">Registrar</button>  
                <a href="../horario.php" class="btn btn-dark">Cancelar</a>  
            </div>  
        </form>  
    </div>  
  
    <script>  
        // Mostrar o ocultar campos de hora según el tipo de horario
        document.getElementById('tipoHorario').addEventListener('change', function() {  
            const tipo = this.value;  
            const horaInicioDiv = document.getElementById('horaInicioDiv');  
            const horaFinDiv = document.getElementById('horaFinDiv');  
            const horaInicio = document.getElementById('horaInicio');  
            const horaFin = document.getElementById('horaFin');  
  
            if (tipo === 'Fijo') {  
                horaInicioDiv.style.display = 'block';  
                horaFinDiv.style.display = 'block';  
                horaInicio.required = true;  
                horaFin.required = true;  
            } else {  
                horaInicioDiv.style.display = 'none';  
                horaFinDiv.style.display = 'none';  
                horaInicio.required = false;  
                horaFin.required = false;  
                horaInicio.value = '';  
                horaFin.value = '';  
            }  
        });  
    </script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>