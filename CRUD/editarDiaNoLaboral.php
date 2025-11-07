<?php  
include("../Config/Conexion.php");  
  
$id = $_POST['Id'];  
$motivo = $_POST['Motivo'];  
$empleado_id = isset($_POST['EmpleadoId']) && $_POST['EmpleadoId'] != '' ? $_POST['EmpleadoId'] : NULL;  
$fecha_inicio = $_POST['FechaInicio'];  
$fecha_fin = $_POST['FechaFin'];  
$descripcion = isset($_POST['Descripcion']) && $_POST['Descripcion'] != '' ? "'".$_POST['Descripcion']."'" : "NULL";  
  
// Construir query con manejo de NULL  
if ($empleado_id === NULL) {  
    $sql = "UPDATE dias_no_laborales   
            SET empleado_id=NULL, motivo='$motivo', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', descripcion=$descripcion   
            WHERE id=$id";  
} else {  
    $sql = "UPDATE dias_no_laborales   
            SET empleado_id=$empleado_id, motivo='$motivo', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', descripcion=$descripcion   
            WHERE id=$id";  
}  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../dia_no_laboral.php");  
} else {  
    echo "Día no laboral no actualizado: " . mysqli_error($conexion);  
}