<?php
session_start();
include("../../Config/Conexion.php");

$correo = $_POST['Correo'];
$password = $_POST['Password'];

// Usar prepared statements para prevenir inyección SQL  
$sql = "SELECT id, nombre, apellido, correo, rol_sistema, password     
        FROM usuarios     
        WHERE correo = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    // Verificar si el usuario tiene contraseña establecida    
    if ($usuario['password'] === NULL || $usuario['password'] === '') {
        // Usuario sin contraseña - redirigir a establecer contraseña    
        $_SESSION['temp_usuario_id'] = $usuario['id'];
        header("location: ../../Formularios/Login/establecerPassword.php");
        exit();
    }

    // Verificar contraseña    
    if (password_verify($password, $usuario['password'])) {
        // Contraseña correcta - Crear sesión    
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_apellido'] = $usuario['apellido'];
        $_SESSION['usuario_correo'] = $usuario['correo'];
        $_SESSION['usuario_rol'] = $usuario['rol_sistema'];
        $_SESSION['login_metodo'] = 'local'; // <-- login con correo y contraseña  

        if ($usuario['rol_sistema'] == 'Administrador') {
            header("location:../../index.php");
        } elseif ($usuario['rol_sistema'] == 'Oficina') {
            header("location: ../../pages/empleado.php");
        } else {  // Empleado    
            // Asegurar zona horaria correcta
            date_default_timezone_set('America/Mexico_City'); // o 'America/Managua'

            // 1. Obtener id del empleado
            $usuario_id = $usuario['id'];
            $sqlEmpleado = "SELECT id FROM empleados WHERE empleado_id = ? AND activo = 1 LIMIT 1";
            $stmtEmp = $conexion->prepare($sqlEmpleado);
            $stmtEmp->bind_param("i", $usuario_id);
            $stmtEmp->execute();
            $resEmp = $stmtEmp->get_result();

            if ($resEmp->num_rows > 0) {
                $empleado = $resEmp->fetch_assoc();
                $empleado_id = $empleado['id'];

                // 2. Verificar si ya existe asistencia para hoy
                $fechaHoy = date('Y-m-d');
                $sqlCheck = "SELECT id FROM asistencias WHERE empleado_id = ? AND fecha = ? LIMIT 1";
                $stmtCheck = $conexion->prepare($sqlCheck);
                $stmtCheck->bind_param("is", $empleado_id, $fechaHoy);
                $stmtCheck->execute();
                $resCheck = $stmtCheck->get_result();

                if ($resCheck->num_rows == 0) {
                    // No existe → registrar entrada con hora local exacta
                    $horaEntrada = date('H:i:s');
                    $sqlInsert = "INSERT INTO asistencias (empleado_id, fecha, hora_entrada) 
                      VALUES (?, ?, ?)";
                    $stmtInsert = $conexion->prepare($sqlInsert);
                    $stmtInsert->bind_param("iss", $empleado_id, $fechaHoy, $horaEntrada);
                    $stmtInsert->execute();
                    $stmtInsert->close();
                }
                $stmtCheck->close();
            }
            $stmtEmp->close();
            header("location: ../../pages/perfil_empleado.php");
        }
        exit();
    } else {
        header("location:../../Formularios/Login/login.php?error=credenciales");
        exit();
    }
} else {
    header("location:../../Formularios/Login/login.php?error=credenciales");
    exit();
}

// Cerrar el statement  
$stmt->close();
