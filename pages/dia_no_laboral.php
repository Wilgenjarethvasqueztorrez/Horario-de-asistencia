<?php
// Proteger la página  
require("../Config/verificarSesion.php");

// Solo administradores pueden ver esta página  
verificarRol(['Administrador', 'Oficina']);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Días No Laborales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--Dependencias-->
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- CSS de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <!-- jQuery (requerido por DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- NUEVAS: DataTables Responsive -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>src/css/styles.css">
</head>

<body>

    <?php include(BASE_PATH . "src/includes/Componentes/sidebar.php"); ?>

    <main class="container mt-4 mb-5">
        <?php include(BASE_PATH . "src/includes/Componentes/userbar.php"); ?>

        <h1 class="titulo-modulo-calendario p-3 text-white text-center rounded mb-4">📅 GESTIÓN DE DÍAS NO LABORALES</h1>

        <div class="text-end mb-3">
            <a href="<?php echo BASE_URL; ?>Formularios/DiaNoLaboral/AgregarDiaNoLaboral.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Agregar Día No Laboral
            </a>
        </div>

        <!-- Tablas para separar Feriados y Vacaciones -->
        <ul class="nav nav-tabs mb-0 border-bottom-0" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="feriados-tab" data-bs-toggle="tab" data-bs-target="#feriados" type="button" role="tab">
                    🏛️ Feriados Institucionales
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="vacaciones-tab" data-bs-toggle="tab" data-bs-target="#vacaciones" type="button" role="tab">
                    🏖️ Vacaciones de Empleados
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Tabla de Feriados -->
            <div class="tab-pane fade show active" id="feriados" role="tabpanel">
                <div class="table-container">
                    <table id="tabla" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Días</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require(BASE_PATH . "Config/Conexion.php");
                            $sqlFeriados = $conexion->query("SELECT * FROM dias_no_laborales   
                                                  WHERE motivo = 'Feriado'   
                                                  ORDER BY fecha_inicio ASC");
                            while ($feriado = $sqlFeriados->fetch_assoc()) {
                                $dias = (strtotime($feriado['fecha_fin']) - strtotime($feriado['fecha_inicio'])) / 86400 + 1;
                            ?>
                            <tr>
                                <td><?php echo date('d/m/Y', strtotime($feriado['fecha_inicio'])); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($feriado['fecha_fin'])); ?></td>
                                <td><span class="badge bg-info"><?php echo $dias; ?> día(s)</span></td>
                                <td><?php echo $feriado['descripcion'] ? $feriado['descripcion'] : '<span class="text-muted">Sin descripción</span>'; ?>
                                </td>
                                <td class="acciones">
                                    <a href="<?php echo BASE_URL; ?>Formularios/DiaNoLaboral/EditarDiaNoLaboral.php?Id=<?php echo $feriado['id']; ?>"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>CRUD/DiaNoLaboral/eliminarDiaNoLaboral.php?Id=<?php echo $feriado['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="event.preventDefault(); confirmarEliminacion(this.href)">
                                        <i class="bi bi-trash3"></i> Eliminar
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="vacaciones" role="tabpanel">
                <!-- Tabla de vacaciones -->
                <div class="table-container">
                    <table id="tabla-vacaciones" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Rol</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Días</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sqlVacaciones = $conexion->query("SELECT dias_no_laborales.*,   
                                                           usuarios.nombre,   
                                                           usuarios.apellido,  
                                                           roles.nombre as rol_nombre  
                                                    FROM dias_no_laborales  
                                                    INNER JOIN empleados ON dias_no_laborales.empleado_id = empleados.id  
                                                    INNER JOIN usuarios ON empleados.empleado_id = usuarios.id  
                                                    INNER JOIN roles ON empleados.rol_id = roles.id  
                                                    WHERE dias_no_laborales.motivo = 'Vacaciones'  
                                                    ORDER BY dias_no_laborales.fecha_inicio DESC");
                            while ($vacacion = $sqlVacaciones->fetch_assoc()) {
                                $dias = (strtotime($vacacion['fecha_fin']) - strtotime($vacacion['fecha_inicio'])) / 86400 + 1;
                            ?>
                            <tr>
                                <td>
                                    <div class="nombre-apellido">
                                        <span><strong><?php echo $vacacion['nombre']; ?></strong></span>
                                        <span><?php echo $vacacion['apellido']; ?></span>
                                    </div>
                                </td>
                                <td><?php echo $vacacion['rol_nombre']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($vacacion['fecha_inicio'])); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($vacacion['fecha_fin'])); ?></td>
                                <td><span class="badge bg-primary"><?php echo $dias; ?> día(s)</span></td>
                                <td><?php echo $vacacion['descripcion'] ? $vacacion['descripcion'] : '<span class="text-muted">Sin descripción</span>'; ?>
                                </td>
                                <td class="acciones">
                                    <a href="<?php echo BASE_URL; ?>Formularios/DiaNoLaboral/EditarDiaNoLaboral.php?Id=<?php echo $vacacion['id']; ?>"
                                        class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>CRUD/DiaNoLaboral/eliminarDiaNoLaboral.php?Id=<?php echo $vacacion['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="event.preventDefault(); confirmarEliminacion(this.href)">
                                        <i class="bi bi-trash3"></i> Eliminar
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Inicializar DataTables -->
    <?php include(BASE_PATH . "src/includes/Dependencias/datatables.php"); ?>

    <!-- Inicializar SweetAlert2 -->
    <?php include(BASE_PATH . "src/includes/Dependencias/sweetalert.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>