<?php
// Proteger la página  
require("../Config/verificarSesion.php");

// Solo administradores pueden ver esta página  
verificarRol(['Administrador']);
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
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
    <!--DataTables Botones-->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>src/css/styles.css">
</head>

<body>

    <?php include(BASE_PATH . "src/includes/Componentes/sidebar.php"); ?>

    <main class="container mt-4 content-wrapper">
        <?php include(BASE_PATH . "src/includes/Componentes/userbar.php"); ?>

        <h1 class="titulo-modulo p-3 text-white text-center rounded mb-4">👥 GESTIÓN DE USUARIOS DEL SISTEMA</h1>

        <div class="text-end mb-3">
            <a href="<?php echo BASE_URL; ?>Formularios/Usuario/AgregarUsuario.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Agregar Usuario
            </a>
        </div>

        <div class="table-container">
            <table id="tabla" class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Correo</th>
                        <th>Rol del Sistema</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require(BASE_PATH . "Config/Conexion.php");

                    $sql = $conexion->query("SELECT id, nombre, apellido, correo, rol_sistema  
                                   FROM usuarios  
                                   ORDER BY nombre ASC");

                    while ($resultado = $sql->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <strong><?php echo $resultado['nombre'] . ' ' . $resultado['apellido']; ?></strong>
                        </td>
                        <td><?php echo $resultado['correo']; ?></td>
                        <td>
                            <?php
                                $badge_class = '';
                                switch ($resultado['rol_sistema']) {
                                    case 'Administrador':
                                        $badge_class = 'bg-danger';
                                        break;
                                    case 'Oficina':
                                        $badge_class = 'bg-warning text-dark';
                                        break;
                                    case 'Empleado':
                                        $badge_class = 'bg-info';
                                        break;
                                }
                                echo "<span class='badge $badge_class'>" . $resultado['rol_sistema'] . "</span>";
                                ?>
                        </td>
                        <td class="acciones">
                            <a href="<?php echo BASE_URL; ?>Formularios/Usuario/EditarUsuario.php?Id=<?php echo $resultado['id']; ?>"
                                class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <a href="<?php echo BASE_URL; ?>CRUD/Usuario/eliminarUsuario.php?Id=<?php echo $resultado['id']; ?>"
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