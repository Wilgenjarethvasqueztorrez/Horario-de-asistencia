<!DOCTYPE html>  
<html lang="es">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Agregar Horario</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../src/css/styles.css?v=1.9" />  
</head>  
<body class="bg-light">  
    
    <div class="container" style="max-width: 650px;">  
        
        <div class="form-card-container">
            <h1 class="form-title-custom text-center mb-4">📅 Agregar Nuevo Horario</h1>  
            
            <form action="../../CRUD/Horario/insertarHorario.php" method="post">  
                
                <div class="mb-3">  
                    <label class="form-label-custom">Nombre del Horario</label>  
                    <input type="text" class="form-control form-control-custom" name="Nombre" placeholder="Ej: Turno Mañana" required>  
                </div>  
      
                <div class="mb-3">  
                    <label class="form-label-custom">Tipo de Horario</label>  
                    <select class="form-select form-control-custom" name="Tipo" id="tipoHorario" required>  
                        <option value="" selected disabled>-- Seleccionar tipo --</option>  
                        <option value="Fijo">🔒 Fijo</option>  
                        <option value="Flexible">🔓 Flexible</option>  
                    </select> 
                </div>  
      
                <div class="mb-3 d-none" id="horaInicioDiv">  
                    <label class="form-label-custom">Hora de Inicio</label>  
                    <input type="time" class="form-control form-control-custom" name="HoraInicio" id="horaInicio">  
                </div>  
      
                <div class="mb-3 d-none" id="horaFinDiv">  
                    <label class="form-label-custom">Hora de Fin</label>  
                    <input type="time" class="form-control form-control-custom" name="HoraFin" id="horaFin">  
                </div>  
      
                <div class="mb-4">  
                    <label class="form-label-custom">Horas Mínimas Requeridas</label>  
                    <input type="number" class="form-control form-control-custom" name="HorasMinimas" step="0.5" min="0" max="24" value="8.00" required>  
                </div>  
      
                <div class="d-flex justify-content-center gap-3">  
                    <button type="submit" class="btn-submit-custom">
                        <i class="bi bi-check-circle-fill me-1"></i> Registrar
                    </button>  
                    <a href="../../pages/horario.php" class="btn-cancel-custom text-decoration-none d-flex align-items-center justify-content-center">
                        <i class="bi bi-x-circle-fill me-1"></i> 
                        Cancelar
                    </a>
                </div>  
            </form>  
        </div>

    </div>  
  
    <script>  
        document.getElementById('tipoHorario').addEventListener('change', function() {  
            const tipo = this.value;  
            const horaInicioDiv = document.getElementById('horaInicioDiv');  
            const horaFinDiv = document.getElementById('horaFinDiv');  
            const horaInicio = document.getElementById('horaInicio');  
            const horaFin = document.getElementById('horaFin');  
  
            if (tipo === 'Fijo') {  
                horaInicioDiv.classList.remove('d-none');  
                horaFinDiv.classList.remove('d-none');  
                horaInicio.required = true;  
                horaFin.required = true;  
            } else {  
                horaInicioDiv.classList.add('d-none');  
                horaFinDiv.classList.add('d-none');  
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