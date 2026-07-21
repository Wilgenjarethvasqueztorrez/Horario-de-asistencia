<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Rol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../src/css/styles.css?v=1.7" />
</head>

<body class="bg-light">

    <div class="container" style="max-width: 650px;">
        
        <div class="form-card-container">
            <h1 class="form-title-custom text-center mb-4">✏️ Editar Rol</h1>

            <form action="../../CRUD/Rol/editarRol.php" method="post">
                <?php
                include('../../Config/Conexion.php');
                $sql = "SELECT * FROM roles WHERE id = " . $_GET['Id'];
                $resultado = $conexion->query($sql);
                $row = $resultado->fetch_assoc();
                ?>
                <input type="hidden" name="Id" value="<?php echo $row['id']; ?>">

                <div class="mb-3">
                    <label class="form-label-custom">Nombre del Rol</label>
                    <input type="text" class="form-control form-control-custom" name="Nombre" value="<?php echo $row['nombre']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label-custom">Descripción</label>
                    <textarea class="form-control form-control-custom" name="Descripcion" rows="3"><?php echo $row['descripcion']; ?></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label-custom">Horario Asignado</label>
                    <select class="form-select form-control-custom" name="HorarioId">
                        <option value="">-- Sin horario asignado --</option>
                        <?php
                        $sqlHorario = $conexion->query("SELECT id, nombre, tipo FROM horarios ORDER BY nombre");
                        while ($horario = $sqlHorario->fetch_assoc()) {
                            $selected = ($row['horario_id'] == $horario['id']) ? "selected" : "";
                            echo "<option value='" . $horario['id'] . "' $selected>" . $horario['nombre'] . " (" . $horario['tipo'] . ")</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <button type="submit" class="btn-submit-custom">
                        <i class="bi bi-arrow-clockwise me-1"></i> Actualizar
                    </button>
                    <a href="../../pages/rol.php" class="btn-cancel-custom text-decoration-none d-flex align-items-center justify-content-center">
                        <i class="bi bi-x-circle-fill me-1"></i> 
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>