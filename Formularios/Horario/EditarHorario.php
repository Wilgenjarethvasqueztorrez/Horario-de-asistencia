<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Horario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../src/css/styles.css?v=2.0" />
</head>

<body class="bg-light">

    <div class="container" style="max-width: 650px;">
        
        <div class="form-card-container">
            <h1 class="form-title-custom text-center mb-4">✏️ Editar Horario</h1>
            
            <form action="../../CRUD/Horario/editarHorario.php" method="post">
                <?php
                include('../../Config/Conexion.php');
                $sql = "SELECT * FROM horarios WHERE id = " . $_GET['Id'];
                $resultado = $conexion->query($sql);
                $row = $resultado->fetch_assoc();
                
                // Determinar la clase de visibilidad inicial basada en el tipo de horario
                $esFijo = ($row['tipo'] == 'Fijo');
                $visibilidadClase = $esFijo ? '' : 'd-none';
                $requiredAtributo = $esFijo ? 'required' : '';
                ?>
                <input type="hidden" name="Id" value="<?php echo $row['id']; ?>">

                <div class="mb-3">
                    <label class="form-label-custom">Nombre del Horario</label>
                    <input type="text" class="form-control form-control-custom" name="Nombre" value="<?php echo $row['nombre']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Tipo de Horario</label>
                    <select class="form-select form-control-custom" name="Tipo" id="tipoHorario" required>
                        <option value="Fijo" <?php echo ($row['tipo'] == 'Fijo') ? 'selected' : ''; ?>>🔒 Fijo</option>
                        <option value="Flexible" <?php echo ($row['tipo'] == 'Flexible') ? 'selected' : ''; ?>>🔓 Flexible</option>
                    </select>
                </div>

                <div class="mb-3 <?php echo $visibilidadClase; ?>" id="horaInicioDiv">
                    <label class="form-label-custom">Hora de Inicio</label>
                    <input type="time" class="form-control form-control-custom" name="HoraInicio" id="horaInicio" value="<?php echo $row['hora_inicio']; ?>" <?php echo $requiredAtributo; ?>>
                </div>

                <div class="mb-3 <?php echo $visibilidadClase; ?>" id="horaFinDiv">
                    <label class="form-label-custom">Hora de Fin</label>
                    <input type="time" class="form-control form-control-custom" name="HoraFin" id="horaFin" value="<?php echo $row['hora_fin']; ?>" <?php echo $requiredAtributo; ?>>
                </div>

                <div class="mb-4">
                    <label class="form-label-custom">Horas Mínimas Requeridas</label>
                    <input type="number" class="form-control form-control-custom" name="HorasMinimas" step="0.5" min="0" max="24" value="<?php echo $row['horas_minimas']; ?>" required>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn-submit-custom">
                        <i class="bi bi-arrow-clockwise me-1"></i> Actualizar
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