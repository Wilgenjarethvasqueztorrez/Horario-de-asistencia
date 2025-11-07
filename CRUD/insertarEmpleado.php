<?php  
include("../Config/Conexion.php");  
  
$usuario_id = $_POST['UsuarioId'];  
$rol_id = $_POST['RolId'];  
$activo = $_POST['Activo'];  
  
$sql = "INSERT INTO empleados (empleado_id, rol_id, activo)   
        VALUES ($usuario_id, $rol_id, $activo)";  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../empleado.php");  
} else {  
    echo "Empleado no insertado: " . mysqli_error($conexion);  
}  
