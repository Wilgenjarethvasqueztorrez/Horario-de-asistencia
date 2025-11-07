<?php  
include("../Config/Conexion.php");  
  
// Recibir datos del formulario  
$nombre = $_POST['NombreUsuario'];  
$apellido = $_POST['ApellidoUsuario'];  
$correo = $_POST['CorreoUsuario'];  
$rol_sistema = $_POST['RolSistema'];  
  
// Insertar en tabla usuarios  
$sql = "INSERT INTO usuarios (nombre, apellido, correo, rol_sistema)     
        VALUES ('$nombre', '$apellido', '$correo', '$rol_sistema')";  
  
if (mysqli_query($conexion, $sql)) {  
    header("location:../index.php");  
} else {  
    echo "Error al insertar usuario: " . mysqli_error($conexion);  
}  

