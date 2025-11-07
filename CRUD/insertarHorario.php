<?php  
include("../Config/Conexion.php");  
  
// Recibir datos del formulario  
$nombre = $_POST['Nombre'];  
$tipo = $_POST['Tipo'];  
$hora_inicio = isset($_POST['HoraInicio']) && $_POST['HoraInicio'] != '' ? $_POST['HoraInicio'] : NULL;  
$hora_fin = isset($_POST['HoraFin']) && $_POST['HoraFin'] != '' ? $_POST['HoraFin'] : NULL;  
$horas_minimas = $_POST['HorasMinimas'];  
  
// Construir query según el tipo  
if ($tipo == 'Flexible') {  
    $sql = "INSERT INTO horarios (nombre, hora_inicio, hora_fin, horas_minimas, tipo)   
            VALUES ('$nombre', NULL, NULL, $horas_minimas, '$tipo')";  
} else {  
    $sql = "INSERT INTO horarios (nombre, hora_inicio, hora_fin, horas_minimas, tipo)   
            VALUES ('$nombre', '$hora_inicio', '$hora_fin', $horas_minimas, '$tipo')";  
}  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../horario.php");  
} else {  
    echo "Horario no insertado: " . mysqli_error($conexion);  
}  



