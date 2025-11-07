<?php  
include("../Config/Conexion.php");  
  
$motivo = $_POST['Motivo'];  
$empleado_id = isset($_POST['EmpleadoId']) && $_POST['EmpleadoId'] != '' ? $_POST['EmpleadoId'] : NULL;  
$fecha_inicio = $_POST['FechaInicio'];  
$fecha_fin = $_POST['FechaFin'];  
$descripcion = isset($_POST['Descripcion']) && $_POST['Descripcion'] != '' ? "'".$_POST['Descripcion']."'" : "NULL";  
  
// Construir query con manejo de NULL para empleado_id  
if ($empleado_id === NULL) {  
    $sql = "INSERT INTO dias_no_laborales (empleado_id, motivo, fecha_inicio, fecha_fin, descripcion)   
            VALUES (NULL, '$motivo', '$fecha_inicio', '$fecha_fin', $descripcion)";  
} else {  
    $sql = "INSERT INTO dias_no_laborales (empleado_id, motivo, fecha_inicio, fecha_fin, descripcion)   
            VALUES ($empleado_id, '$motivo', '$fecha_inicio', '$fecha_fin', $descripcion)";  
}  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../dia_no_laboral.php");  
} else {  
    echo "Día no laboral no insertado: " . mysqli_error($conexion);  
}  
