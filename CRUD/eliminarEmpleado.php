<?php

include ("../Config/Conexion.php");

$Id = $_GET['Id'];
$sql = "DELETE FROM empleados WHERE id=".$Id."";

$query = mysqli_query($conexion,$sql);

if ($query === TRUE) {
   header("location: ../empleado.php");
}