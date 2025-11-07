<?php  
include("../Config/Conexion.php");  
  
// Recibir datos del formulario  
$empleado_id = $_POST['EmpleadoId'];  
$fecha = $_POST['Fecha'];  
$hora_entrada = $_POST['HoraEntrada'];  
$hora_salida = isset($_POST['HoraSalida']) && $_POST['HoraSalida'] != '' ? $_POST['HoraSalida'] : NULL;  
$total_horas = isset($_POST['TotalHoras']) && $_POST['TotalHoras'] != '' ? $_POST['TotalHoras'] : 0.00;  
  
// Insertar en la base de datos  
if ($hora_salida === NULL) {  
    $sql = "INSERT INTO asistencias (empleado_id, fecha, hora_entrada, hora_salida, total_horas)   
            VALUES ($empleado_id, '$fecha', '$hora_entrada', NULL, 0.00)";  
} else {  
    $sql = "INSERT INTO asistencias (empleado_id, fecha, hora_entrada, hora_salida, total_horas)   
            VALUES ($empleado_id, '$fecha', '$hora_entrada', '$hora_salida', $total_horas)";  
}  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../asistencia.php");  
} else {  
    echo "Asistencia no registrada: " . mysqli_error($conexion);  
}  
