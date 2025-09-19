<?php
require("classes/estudiante.class.php");
$Estudiante = new  Estudiante();

$resultado = $Estudiante->obtenerEstudiantes();

header("Content-type: Application/json");
echo(json_encode($resultado));
?>