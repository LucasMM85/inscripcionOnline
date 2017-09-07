<?php

use model\Inscripcion;
use model\Persona;
use model\ErrorInscripcion;

require_once("db/funcionesDb.php");
require_once("model/Inscripcion.php");
require_once("model/Persona.php");
require_once("model/ErrorInscripcion.php");

$idConcurso = 5;
$documento = $_POST['documento-verConstancia'];
$sexo = $_POST['sexo-verConstancia'];

$query = "select * from conc.vw_constanciainscripcion where idconcurso=".$idConcurso." and documento=".$documento." and sexo='".$sexo."'";

$consulta = asignarTurno($query);

$jsonResponse = null;
if($consulta["error"][0] == 0 && $consulta["cantregistros"][0] != 0){
    $inscripcion = new Inscripcion();
    $inscripcion->setIdInscripcion($consulta['idinscripcion'][1]);
    //$apellido, $nombre, $documento, $cuil, $sexo, $fechanac, $domicilio, $localidad, $codpostal, $telfijo, $telcelular, $email, $tituloUniversitario, $fechaTituloUniversitario, $fechaTituloEspecialidad, $sancion, $antecedentes
    $persona = new Persona( $consulta['apellidos'][1],
                            $consulta['nombres'][1],
                            $consulta['documento'][1],
                            $consulta['cuit'][1],
                            getSexoLiteral($consulta['sexo'][1]),
                            formatoFecha($consulta['fnacimiento'][1]),
                            $consulta['domicilio'][1],
                            $consulta['localidad'][1],
                            $consulta['codpostal'][1],
                            $consulta['telfijo'][1],
                            $consulta['telcelular'][1],
                            $consulta['email'][1],
                            getEspecialidad($consulta['formacionprof'][1]),
                            $consulta['fechatitulo'][1],
                            $consulta['fechaespecialidad'][1],
                            getSiNo($consulta['sanciones'][1]),
                            getSiNo($consulta['antecedentes'][1]));
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

function getSexoLiteral($sexoInicial){
    if(strcmp($sexoInicial, "M") === 0){
        $sexoLiteral = "MASCULINO";
    } else {
        $sexoLiteral = "FEMENINO";
    }
    return $sexoLiteral;
}

function getEspecialidad($especialidadInicial){
    if(strcmp($especialidadInicial, "pediatra") === 0){
        $especialidad = "MÉDICO PEDIATRA";
    } else if(strcmp($especialidadInicial, "cirpediatra") === 0){
        $especialidad = "MÉDICO CIRUJANO PEDIÁTRICO";
    } else if(strcmp($especialidadInicial, "traumatologo") === 0){
        $especialidad = "MÉDICO TRAUMATÓLOGO";
    }
    return $especialidad;
}

function getSiNo($valor){
    if(strcmp($valor, "0") == 0){
        $texto = "NO";
    } else {
        $texto = "SI";
    }
    return $texto;
}

function addStatus($jsonString, $status){
    $jsonString = rtrim($jsonString, '}');
    return $jsonString.',"status":'.$status.'}';
}

function formatoFecha($fecha){
    if($fecha != null){
        return date("d/m/Y", strtotime($fecha));
    }
    return null;
}

echo $jsonResponse;