<?php  
include("../Config/Conexion.php");  
  
// Recibir datos del formulario  
$id = $_POST['Id'];  
$nombre = $_POST['Nombre'];  
$descripcion = isset($_POST['Descripcion']) && $_POST['Descripcion'] != '' ? $_POST['Descripcion'] : NULL;  
$horario_id = isset($_POST['HorarioId']) && $_POST['HorarioId'] != '' ? $_POST['HorarioId'] : NULL;  
  
// Actualizar en la base de datos  
$sql = "UPDATE roles   
        SET nombre='$nombre',   
            descripcion=" . ($descripcion ? "'$descripcion'" : "NULL") . ",   
            horario_id=" . ($horario_id ? $horario_id : "NULL") . "   
        WHERE id=$id";  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../rol.php");  
} else {  
    echo "Rol no actualizado: " . mysqli_error($conexion);  
}  
