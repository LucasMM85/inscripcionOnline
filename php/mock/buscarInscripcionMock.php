<?php

use model\Inscripcion;
use model\Persona;
use model\ErrorInscripcion;

require_once("db/funcionesDb.php");
require_once("model/Inscripcion.php");
require_once("model/Persona.php");
require_once("model/ErrorInscripcion.php");

$idConcurso = 7;
$documento = null;
$sexo = null;
if(empty($_POST)){
    $postdata = json_decode(file_get_contents("php://input"),true);
    $sexo = $postdata['sexo'];
    $documento = $postdata['documento'];
} else {
    $documento = $_POST['documento'];
    $sexo = $_POST['sexo'];
}

$inscripcion = new Inscripcion();
$inscripcion->setIdInscripcion(123456);

$persona = new Persona();
$persona->setApellido("Mussi");
$persona->setNombre("Lucas");
$persona->setDocumento("31541236");
$persona->setCuil("20315412367");
$persona->setSexo(getSexoLiteral("M"));
$persona->setFechanac("06/05/1985");
$persona->setDomicilio("25 de Mayo 569 4 A");
$persona->setLocalidad("CAPITAL - SAN MIGUEL DE TUCUMAN");
$persona->setCodpostal("4000");
$persona->setTelfijo("03814977102");
$persona->setTelcelular("3816692894");
$persona->setEmail("lucasm.mussi@gmail.com");
$persona->setTituloUniversitario(getEspecialidad("cirujano"));
$persona->setFechaTituloUniversitario("13/03/03");
$persona->setFechaTituloEspecialidad(null);
$persona->setSancion("NO");
$persona->setAntecedentes("NO");

$inscripcion->setPersona($persona);
$status = ',"status":0';
$jsonResponse = json_encode($inscripcion);
$jsonResponse = substr_replace($jsonResponse, $status, strlen($jsonResponse)-1, 0);

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
    } else if(strcmp($especialidadInicial, "cirujano") === 0){
        $especialidad = "MÉDICO CIRUJANO";
    } else if(strcmp($especialidadInicial, "legista") === 0){
        $especialidad = "MÉDICO LEGISTA";
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
header('Content-Type: application/json');
echo $jsonResponse;