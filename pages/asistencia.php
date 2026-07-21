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
    <title>Gestión de Asistencias</title>
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

        <h1 class="titulo-gestion-asistencias p-3 text-white text-center rounded mb-4">📋 LISTADO DE ASISTENCIAS</h1>

        <div class="text-end mb-3">
            <a href="<?php echo BASE_URL; ?>Formularios/Asistencia/AgregarAsistencia.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Registrar Asistencia
            </a>
        </div>

        <div class="table-container">
            <table id="tabla" class="table table-hover">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Rol</th>
                        <th>Fecha</th>
                        <th>Hora Entrada</th>
                        <th>Hora Salida</th>
                        <th>Total Horas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require(BASE_PATH . "Config/Conexion.php");

                    $sql = $conexion->query("SELECT asistencias.*,     
                                          usuarios.nombre,     
                                          usuarios.apellido,  
                                          roles.nombre as rol_nombre    
                                   FROM asistencias     
                                   INNER JOIN empleados ON asistencias.empleado_id = empleados.id  
                                   INNER JOIN usuarios ON empleados.empleado_id = usuarios.id  
                                   INNER JOIN roles ON empleados.rol_id = roles.id    
                                   ORDER BY asistencias.fecha DESC, asistencias.hora_entrada DESC");

                    while ($resultado = $sql->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>
                                <div class="nombre-apellido">
                                    <span><strong><?php echo $resultado['nombre']; ?></strong></span>
                                    <span><?php echo $resultado['apellido']; ?></span>
                                </div>
                            </td>
                            <td><?php echo $resultado['rol_nombre']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($resultado['fecha'])); ?></td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <i class="bi bi-box-arrow-in-right text-success"></i>
                                    <?php echo date('h:i A', strtotime($resultado['hora_entrada'])); ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                if ($resultado['hora_salida']) {
                                    echo "<span class='badge bg-light text-dark border'>
                                            <i class='bi bi-box-arrow-left text-danger'></i> "
                                            . date('h:i A', strtotime($resultado['hora_salida'])) .
                                        "</span>";
                                } else {
                                    echo "<span class='text-dark badge bg-warning'><i class='bi bi-exclamation-triangle'></i> Sin registrar</span>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($resultado['total_horas'] > 0) {
                                    echo number_format($resultado['total_horas'], 2) . " hrs";
                                } else {
                                    echo "<span class='text-dark'>-</span>";
                                }
                                ?>
                            </td>
                            <td class="acciones">
                                <a href="<?php echo BASE_URL; ?>Formularios/Asistencia/EditarAsistencia.php?Id=<?php echo $resultado['id']; ?>"
                                    class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="<?php echo BASE_URL; ?>CRUD/Asistencia/eliminarAsistencia.php?Id=<?php echo $resultado['id']; ?>"
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
    </main>

    <!-- Inicializar DataTables -->
    <?php include(BASE_PATH . "src/includes/Dependencias/datatables.php"); ?>

    <!-- Inicializar SweetAlert2 -->
    <?php include(BASE_PATH . "src/includes/Dependencias/sweetalert.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>