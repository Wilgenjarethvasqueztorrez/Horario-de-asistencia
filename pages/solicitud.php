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
    <title>Solicitudes</title>
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

        <h1 class="titulo-modulo-calendario p-3 text-white text-center rounded mb-4">🔔 LISTADO DE SOLICITUDES</h1>

        <div class="table-container">
            <table id="tabla" class="table table-hover">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Rol</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require(BASE_PATH . "Config/Conexion.php");

                    $sql = $conexion->query("SELECT solicitudes.*,   
                                                           usuarios.nombre,   
                                                           usuarios.apellido,  
                                                           roles.nombre as rol_nombre  
                                                    FROM solicitudes  
                                                    INNER JOIN empleados ON solicitudes.empleado_id = empleados.id  
                                                    INNER JOIN usuarios ON empleados.empleado_id = usuarios.id  
                                                    INNER JOIN roles ON empleados.rol_id = roles.id   
                                                    ORDER BY solicitudes.descripcion DESC");

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
                            <td><?php echo $resultado['descripcion']; ?></td>

                            <td>
                                <?php
                                $estado = $resultado['estado'];
                                $clase = '';

                                switch ($estado) {
                                    case 'Pendiente':
                                        $clase = 'bg-warning text-dark';
                                        break;
                                    case 'Aprobada':
                                        $clase = 'bg-success';
                                        break;
                                    case 'Rechazada':
                                        $clase = 'bg-danger';
                                        break;
                                }
                                ?>
                                <span class="badge <?php echo $clase; ?>">
                                    <?php echo ucfirst($estado); ?>
                                </span>
                            </td>


                            <td class="acciones">
                                <a href="<?php echo BASE_URL; ?>Formularios/Solicitud/EditarSolicitud.php?Id=<?php echo $resultado['id']; ?>"
                                class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="<?php echo BASE_URL; ?>CRUD/Solicitud/eliminarSolicitud.php?Id=<?php echo $resultado['id']; ?>"
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