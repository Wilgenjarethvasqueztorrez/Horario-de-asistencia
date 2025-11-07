<?php  
include("../Config/Conexion.php");  
  
// Recibir el ID de la asistenca a eliminar  
$id = $_GET['Id'];  
  
// Eliminar la asistencia de la base de datos  
$sql = "DELETE FROM asistencias WHERE id=$id";  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../asistencia.php");  
} else {  
    echo "Asistencia no eliminado: " . mysqli_error($conexion);  
}  