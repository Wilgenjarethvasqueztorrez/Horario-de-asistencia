<?php  
include("../Config/Conexion.php");  
  
// Recibir datos del formulario  
$id = $_POST['Id'];  
$nombre = $_POST['Nombre'];  
$tipo = $_POST['Tipo'];  
$hora_inicio = isset($_POST['HoraInicio']) && $_POST['HoraInicio'] != '' ? $_POST['HoraInicio'] : NULL;  
$hora_fin = isset($_POST['HoraFin']) && $_POST['HoraFin'] != '' ? $_POST['HoraFin'] : NULL;  
$horas_minimas = $_POST['HorasMinimas'];  
  
// Construir query según el tipo  
if ($tipo == 'Flexible') {  
    $sql = "UPDATE horarios   
            SET nombre='$nombre', hora_inicio=NULL, hora_fin=NULL, horas_minimas=$horas_minimas, tipo='$tipo'   
            WHERE id=$id";  
} else {  
    $sql = "UPDATE horarios   
            SET nombre='$nombre', hora_inicio='$hora_inicio', hora_fin='$hora_fin', horas_minimas=$horas_minimas, tipo='$tipo'   
            WHERE id=$id";  
}  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../horario.php");  
} else {  
    echo "Horario no actualizado: " . mysqli_error($conexion);  
}  





  
