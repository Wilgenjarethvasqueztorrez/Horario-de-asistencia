<?php
  // Credenciales de la base de datos local
  // $host = "localhost";
  // $user = "root";
  // $pass = "wilgen12345";
  // $db = "control_asistencia_completa_2";

  // Credenciales de la base de datos remota en infinityfree
  $host = "sql112.infinityfree.com";
  $user = "rif0_40373614";
  $pass = "uu626Ffw8LFU74";
  $db = "if0_40373614_control_asistencia_completa_2";

  $conexion =new mysqli($host,$user,$pass,$db);

  if (!$conexion) {
    echo 'Conexion fallida';
  }