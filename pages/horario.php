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
    <title>Horarios</title>
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

        <h1 class="titulo-modulo-horarios p-3 text-white text-center rounded mb-4">📋 LISTADO DE HORARIOS</h1>

        <div class="text-end mb-3">
            <a href="<?php echo BASE_URL; ?>Formularios/Horario/AgregarHorario.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Agregar Horario
            </a>
        </div>

        <div class="table-container">
            <table id="tabla" class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Horario</th>
                        <th>Horas Mínimas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require(BASE_PATH . "Config/Conexion.php");
                    $sql = $conexion->query("SELECT * FROM horarios ORDER BY nombre ASC");
                    while ($resultado = $sql->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><strong><?php echo $resultado['nombre']; ?></strong></td>
                            <td>
                                <?php
                                if ($resultado['tipo'] == 'Fijo') {
                                    echo "<span class='badge-horario-fijo'><i class='bi bi-lock-fill me-1'></i>Fijo</span>";
                                } else {
                                    echo "<span class='badge-horario-flexible'><i class='bi bi-unlock-fill me-1'></i>Flexible</span>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($resultado['hora_inicio'] && $resultado['hora_fin']) {
                                    echo date('h:i A', strtotime($resultado['hora_inicio'])) . " - " . date('h:i A', strtotime($resultado['hora_fin']));
                                } else {
                                    echo "<span class='text-dark'>Horario flexible</span>";
                                }
                                ?>
                            </td>
                            <td><?php echo $resultado['horas_minimas']; ?> horas</td>
                            <td class="acciones">
                                <a href="<?php echo BASE_URL; ?>Formularios/Horario/EditarHorario.php?Id=<?php echo $resultado['id']; ?>"
                                    class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="<?php echo BASE_URL; ?>CRUD/Horario/eliminarHorario.php?Id=<?php echo $resultado['id']; ?>"
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