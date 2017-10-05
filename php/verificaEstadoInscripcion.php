<?php

use model\EstadoInscripcion;

require_once("db/funcionesDb.php");
require_once("inscripcionUtils.php");
require_once("model/EstadoInscripcion.php");

$idconcurso = 9;

$query = "SELECT * FROM conc.spc_inscripcion_activa('".$idconcurso."')";

$consulta = asignarTurno($query);
$jsonResponse = null;
$estadoInscripcion = new EstadoInscripcion();
if($consulta['activo'][1] == 0){
    $estadoInscripcion->setIsActivo(false);
    $estadoInscripcion->setMensaje($consulta['mensaje'][1]);
    $jsonResponse = json_encode($estadoInscripcion);
} else {
    $estadoInscripcion->setIsActivo(true);
    $jsonResponse = json_encode($estadoInscripcion);
}

header('Content-Type: application/json');
echo $jsonResponse;