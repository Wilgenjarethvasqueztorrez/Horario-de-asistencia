<?php

include ("../Config/Conexion.php");

$Id = $_GET['Id'];
$sql = "DELETE FROM horarios WHERE id=".$Id."";

$query = mysqli_query($conexion,$sql);

if ($query === TRUE) {
   header("location: ../horario.php");
} else {
   echo "Horario no eliminado" . mysqli_error($conexion);
}
