<?php  
include("../Config/Conexion.php");  
  
// Recibir datos del formulario  
$id = $_POST['Id'];  
$nombre = $_POST['NombreUsuario'];  
$apellido = $_POST['ApellidoUsuario'];  
$correo = $_POST['CorreoUsuario'];  
$rol_sistema = $_POST['RolSistema'];  
  
// Actualizar solo la tabla usuarios  
$sql = "UPDATE usuarios   
        SET nombre='$nombre',   
            apellido='$apellido',   
            correo='$correo',   
            rol_sistema='$rol_sistema'   
        WHERE id=$id";  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../index.php");  
} else {  
    echo "Error al actualizar usuario: " . mysqli_error($conexion);  
}  

