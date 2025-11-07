<?php  
include("../Config/Conexion.php");  
  
$id = $_POST['Id'];  
$usuario_id = $_POST['UsuarioId'];  
$rol_id = $_POST['RolId'];  
$activo = $_POST['Activo'];  
  
$sql = "UPDATE empleados   
        SET empleado_id=$usuario_id, rol_id=$rol_id, activo=$activo   
        WHERE id=$id";  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../empleado.php");  
} else {  
    echo "Empleado no actualizado: " . mysqli_error($conexion);  
}  
