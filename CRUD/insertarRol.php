<?php  
include("../Config/Conexion.php");  
  
// Recibir datos del formulario  
$nombre = $_POST['Nombre'];  
$descripcion = isset($_POST['Descripcion']) && $_POST['Descripcion'] != '' ? $_POST['Descripcion'] : NULL;  
$horario_id = isset($_POST['HorarioId']) && $_POST['HorarioId'] != '' ? $_POST['HorarioId'] : NULL;  
  
// Insertar en la base de datos  
if ($horario_id === NULL) {  
    $sql = "INSERT INTO roles (nombre, descripcion, horario_id)   
            VALUES ('$nombre', " . ($descripcion ? "'$descripcion'" : "NULL") . ", NULL)";  
} else {  
    $sql = "INSERT INTO roles (nombre, descripcion, horario_id)   
            VALUES ('$nombre', " . ($descripcion ? "'$descripcion'" : "NULL") . ", $horario_id)";  
}  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../rol.php");  
} else {  
    echo "Rol no insertado: " . mysqli_error($conexion);  
}  