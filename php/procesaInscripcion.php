<?php
/**
 * User: Lucas Mussi
 * Date: 8/5/2017
 * Time: 07:18
 */

use model\ErrorInscripcion;
use model\Inscripcion;
use model\Persona;

require_once("model/Inscripcion.php");
require_once("model/Persona.php");
require_once("model/ErrorInscripcion.php");
require_once("db/funcionesDb.php");
require_once("inscripcionUtils.php");

if(empty($_POST)){
    $postdata = json_decode(file_get_contents("php://input"),true);
    $_POST = $postdata;
}


$idConcurso = 11;
$persona = new Persona();
$persona->setApellido($_POST['apellido']);
$persona->setNombre($_POST['nombre']);
$persona->setDocumento($_POST['dni']);
$persona->setCuil($_POST['cuil']);
$persona->setSexo($_POST['sexo']);
$persona->setFechanac($_POST['fechanac']);
$persona->setDomicilio($_POST['domicilio']);
$persona->setLocalidad($_POST['localidad']);
$persona->setCodpostal($_POST['cpostal']);
$persona->setTelfijo($_POST['telfijo']);
$persona->setTelcelular($_POST['telcelular']);
$persona->setEmail($_POST['email']);
$persona->setTituloEducativo($_POST['titulo']);
$persona->setFechaTituloEducativo($_POST['fechaTitulo']);
$persona->setUniversidad($_POST['universidad']);
$persona->setMaestranza($_POST['maestranza']);

$query = "select * from conc.spc_inscribe('".$persona->getApellido()."'::pub.apellidos,
                                          '".$persona->getNombre()."'::pub.nombres,
                                          '".$persona->getDocumento()."'::pub.documento,
                                          '".$persona->getCuil()."'::pub.cuit,
                                          '".$persona->getEmail()."'::pub.sqlvarchar100,
                                          '".$persona->getSexo()."'::pub.sexo,
                                          '".$persona->getDomicilio()."'::pub.domicilio,
                                          '".$persona->getFechanac()."'::pub.sqldate,
                                          '".$persona->getLocalidad()."'::geo.idlocalidad,
                                          '".$persona->getCodpostal()."'::pub.sqlvarchar20,
                                          '".$persona->getTelfijo()."'::pub.sqlvarchar20,
                                          '".$persona->getTelcelular()."'::pub.sqlvarchar20,
                                          '".$persona->getTituloEducativo()."'::pub.idTituloEducativo,
                                          '".valor_nulo($persona->getFechaTituloEducativo(), "null")."'::pub.sqldate,
                                          '".$idConcurso."'::conc.idconcurso,
                                          '".$persona->getUniversidad()."'::pub.sqlvarchar20,
                                          ".valor_nulo($persona->getMaestranza(), "null")."::pub.sino)";

$consulta = asignarTurno($query);

$jsonResponse = null;
if($consulta["error"][0] == 0 && $consulta["cantregistros"][0] != 0){
    $inscripcion = new Inscripcion();
    $inscripcion->setPersona($persona);
    $inscripcion->setIdInscripcion($consulta['idinscripcion'][1]);
    $status = ',"status":'.$consulta["error"][0];
    $jsonResponse = json_encode($inscripcion);
    $jsonResponse = substr_replace($jsonResponse, $status, strlen($jsonResponse)-1, 0);
} else if ($consulta["error"][0] == 1 && strcmp(!$consulta["errmsg"][0],"")){
    $errorMessage = new ErrorInscripcion();
    $errorMessage->setErrorType(1);
    $mensaje = substr($consulta["errmsg"][0], 0, strpos($consulta["errmsg"][0], "CONTEXT"));
    $errorMessage->setErrorMessage($mensaje);
    $jsonResponse = json_encode($errorMessage);
} else if ($consulta["error"][0] == 1){
    $errorMessage = new ErrorInscripcion();
    $errorMessage->setErrorType(1);
    $mensaje = $consulta["errmsg"][0];
    $errorMessage->setErrorMessage($mensaje);
    $jsonResponse = json_encode($errorMessage);
} else {
    $mensaje = "Ocurrió un error al consultar la base de datos.";
    $errorMessage = new ErrorInscripcion();
    $errorMessage->setErrorType(1);
    $errorMessage->setErrorMessage($mensaje);
    $jsonResponse = json_encode($errorMessage);
}
header('Content-Type: application/json');
echo $jsonResponse;
