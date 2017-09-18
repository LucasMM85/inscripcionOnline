<?php

use model\Inscripcion;
use model\Persona;
use model\ErrorInscripcion;

require_once("db/funcionesDb.php");
require_once("model/Inscripcion.php");
require_once("model/Persona.php");
require_once("model/ErrorInscripcion.php");
require_once("inscripcionUtils.php");

if(empty($_POST)){
    $postdata = json_decode(file_get_contents("php://input"),true);
    $_POST = $postdata;
}

$idConcurso = 8;
$documento = $_POST['documento'];
$sexo = $_POST['sexo'];

$query = "select * from conc.vw_constanciainscripcion where idconcurso=".$idConcurso." and documento=".$documento." and sexo='".$sexo."'";

$consulta = asignarTurno($query);

$jsonResponse = null;
if($consulta["error"][0] == 0 && $consulta["cantregistros"][0] != 0){
    $inscripcion = new Inscripcion();
    $inscripcion->setIdInscripcion($consulta['idinscripcion'][1]);
    //$apellido, $nombre, $documento, $cuil, $sexo, $fechanac, $domicilio, $localidad, $codpostal, $telfijo, $telcelular, $email, $tituloUniversitario, $fechaTituloUniversitario, $fechaTituloEspecialidad, $sancion, $antecedentes
    $persona = new Persona();
    $persona->setApellido($consulta['apellidos'][1]);
    $persona->setNombre($consulta['nombres'][1]);
    $persona->setDocumento($consulta['documento'][1]);
    $persona->setCuil($consulta['cuit'][1]);
    $persona->setSexo(getSexoLiteral($consulta['sexo'][1]));
    $persona->setFechanac(formatoFecha($consulta['fnacimiento'][1]));
    $persona->setDomicilio($consulta['domicilio'][1]);
    $persona->setLocalidad($consulta['localidad'][1]);
    $persona->setCodpostal($consulta['codpostal'][1]);
    $persona->setTelfijo($consulta['telfijo'][1]);
    $persona->setTelcelular($consulta['telcelular'][1]);
    $persona->setEmail($consulta['email'][1]);
    $persona->setTituloUniversitario(getEspecialidad($consulta['formacionprof'][1]));
    $persona->setFechaTituloUniversitario($consulta['fechatitulo'][1]);
    $persona->setFechaTituloEspecialidad(null);
    $persona->setSancion(getSiNo($consulta['sanciones'][1]));
    $persona->setAntecedentes(getSiNo($consulta['antecedentes'][1]));

    $inscripcion->setPersona($persona);
    $status = ',"status":'.$consulta["error"][0];
    $jsonResponse = json_encode($inscripcion);
    $jsonResponse = substr_replace($jsonResponse, $status, strlen($jsonResponse)-1, 0);
} else if ($consulta['cantregistros'][0] == 0){
    $errorMessage = new ErrorInscripcion();
    $errorMessage->setErrorType(1);
    $mensaje = "No se encontraron resultados";
    $errorMessage->setErrorMessage($mensaje);
    $jsonResponse = json_encode($errorMessage);
    $jsonResponse = addStatus($jsonResponse, 1);
}

header('Content-Type: application/json');
echo $jsonResponse;