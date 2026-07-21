<?php  
session_start();  
require("../../Config/googleConfig.php");  
include("../../Config/Conexion.php");  
  
if (!isset($_GET['code'])) {  
    header("location: ../../Formularios/Login/login.php?error=google");  
    exit();  
}  
  
// 1. Intercambiar el "code" por un access_token  
$ch = curl_init('https://oauth2.googleapis.com/token');  
curl_setopt_array($ch, [  
    CURLOPT_RETURNTRANSFER => true,  
    CURLOPT_POST => true,  
    CURLOPT_POSTFIELDS => http_build_query([  
        'code'          => $_GET['code'],  
        'client_id'     => GOOGLE_CLIENT_ID,  
        'client_secret' => GOOGLE_CLIENT_SECRET,  
        'redirect_uri'  => GOOGLE_REDIRECT_URI,  
        'grant_type'    => 'authorization_code'  
    ])  
]);  
$tokenData = json_decode(curl_exec($ch), true);  
curl_close($ch);  
  
if (!isset($tokenData['access_token'])) {  
    header("location: ../../Formularios/Login/login.php?error=google");  
    exit();  
}  
  
// 2. Obtener los datos del usuario (correo + foto)  
$ch = curl_init('https://www.googleapis.com/oauth2/v3/userinfo');  
curl_setopt_array($ch, [  
    CURLOPT_RETURNTRANSFER => true,  
    CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $tokenData['access_token']]  
]);  
$userInfo = json_decode(curl_exec($ch), true);  
curl_close($ch);  
  
if (empty($userInfo['email']) || empty($userInfo['email_verified'])) {  
    header("location: ../../Formularios/Login/login.php?error=google");  
    exit();  
}  
  
$correo = $userInfo['email'];  
$foto   = $userInfo['picture'] ?? null;  
  
// 3. Buscar el correo en la tabla usuarios  
$sql = "SELECT id, nombre, apellido, correo, rol_sistema  
        FROM usuarios  
        WHERE correo = ?";  
$stmt = $conexion->prepare($sql);  
$stmt->bind_param("s", $correo);  
$stmt->execute();  
$resultado = $stmt->get_result();  
  
if ($resultado->num_rows === 0) {  
    header("location: ../../Formularios/Login/login.php?error=no_autorizado");  
    exit();  
}  
  
$usuario = $resultado->fetch_assoc();  
  
// 4. Crear la sesión (mismas variables + método google + foto)  
$_SESSION['usuario_id']       = $usuario['id'];  
$_SESSION['usuario_nombre']   = $usuario['nombre'];  
$_SESSION['usuario_apellido'] = $usuario['apellido'];  
$_SESSION['usuario_correo']   = $usuario['correo'];  
$_SESSION['usuario_rol']      = $usuario['rol_sistema'];  
$_SESSION['login_metodo']     = 'google';   // <-- login con Google  
$_SESSION['usuario_foto']     = $foto;       // URL de la foto de Google  
  
// 5. Redirigir según rol  
if ($usuario['rol_sistema'] == 'Administrador') {  
    header("location:../../index.php");  
} elseif ($usuario['rol_sistema'] == 'Oficina') {  
    header("location: ../../pages/empleado.php");  
} else { // Empleado -> registrar asistencia del día  
    date_default_timezone_set('America/Mexico_City');  
    $usuario_id = $usuario['id'];  
    $sqlEmpleado = "SELECT id FROM empleados WHERE empleado_id = ? AND activo = 1 LIMIT 1";  
    $stmtEmp = $conexion->prepare($sqlEmpleado);  
    $stmtEmp->bind_param("i", $usuario_id);  
    $stmtEmp->execute();  
    $resEmp = $stmtEmp->get_result();  
  
    if ($resEmp->num_rows > 0) {  
        $empleado_id = $resEmp->fetch_assoc()['id'];  
        $fechaHoy = date('Y-m-d');  
        $sqlCheck = "SELECT id FROM asistencias WHERE empleado_id = ? AND fecha = ? LIMIT 1";  
        $stmtCheck = $conexion->prepare($sqlCheck);  
        $stmtCheck->bind_param("is", $empleado_id, $fechaHoy);  
        $stmtCheck->execute();  
        if ($stmtCheck->get_result()->num_rows == 0) {  
            $horaEntrada = date('H:i:s');  
            $sqlInsert = "INSERT INTO asistencias (empleado_id, fecha, hora_entrada) VALUES (?, ?, ?)";  
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