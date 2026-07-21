<?php
session_start();

// Si ya está logueado, redirigir según rol  
if (isset($_SESSION['usuario_id'])) {
    if ($_SESSION['usuario_rol'] == 'Administrador') {
        header("location:../../index.php");
    } elseif ($_SESSION['usuario_rol'] == 'Oficina') {
        header("location:../../pages/empleado.php");
    } else {  // Empleado  
        header("location:../../pages/perfil_empleado.php");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../src/css/styles.css">
</head>

<body class="body-login">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-container text-center px-3">

            <div class="mb-4">
                <div class="brand-logo">
                    <img src="../../src/images/logo-uml.png" alt="Logo UML">
                </div>
                <h1 class="brand-title mb-0">Universidad Martín</h1>
                <h1 class="brand-title mb-1" style="color: #ffffff; font-weight: 900;">Lutero</h1>
                <p class="brand-subtitle">Sistema de gestion de asistencia de personal UML</p>
            </div>

            <h2 class="portal-title mb-3">SIGEAP-UML</h2>
            <p class="portal-desc mb-5">Acceso exclusivo para personal docente y administrativo de la Universidad Martín Lutero.</p>

            <div class="card shadow-lg text-start">
                <div class="card-body p-4 p-md-5">
                    <h3 class="text-center mb-4 text-white fs-4">
                        <i class="bi bi-person-circle"></i> Iniciar Sesión
                    </h3>

                    <?php
                    // Mostrar mensaje de error si existe  
                    if (isset($_GET['error'])) {
                        echo '<div class="alert alert-danger" role="alert">';
                        if ($_GET['error'] == 'credenciales') {
                            echo 'Correo o contraseña incorrectos';
                        } elseif ($_GET['error'] == 'sesion') {
                            echo 'Debe iniciar sesión para acceder';
                        } elseif ($_GET['error'] == 'no_autorizado') {  
                            echo 'Tu cuenta de Google no está registrada en el sistema';  
                        } elseif ($_GET['error'] == 'google') {  
                            echo 'No se pudo completar el inicio de sesión con Google';  
                        }
                        echo '</div>';
                    }
                    ?>

                    <form action="../../CRUD/Login/validarLogin.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" name="Correo" placeholder="usuario@ejemplo.com" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" name="Password" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-login btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i> Ingresar
                            </button>
                        </div>

                        <div class="d-grid mt-3">
                            <a href="../../CRUD/Login/googleLogin.php" class="btn btn-light btn-lg">
                                <i class="bi bi-google"></i> Iniciar sesión con Google
                            </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>