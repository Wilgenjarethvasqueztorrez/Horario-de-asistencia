<?php  
include("../Config/Conexion.php");  
  
$id = $_GET['Id'];  
  
$sql = "DELETE FROM dias_no_laborales WHERE id=$id";  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../dia_no_laboral.php");  
} else {  
    echo "Día no laboral no eliminado: " . mysqli_error($conexion);  
}  