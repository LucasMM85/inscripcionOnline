<?php

use model\Localidad;

require_once("funcionesDb.php");
require_once("../model/Localidad.php");


$handle = asignarTurno("SELECT idlocalidad,d.nombre || ' - ' || l.nombre as nombreloc 
											   from geo.t_localidades l 
											   inner join geo.t_departamentos d
											   on l.iddepartamento = d.iddepartamento 
											   order by d.nombre || ' - ' || l.nombre");

$localidades = array();

for($registro=1;$handle['cantregistros'][0]>=$registro;$registro++) {
    $idLocalidad = $handle['idlocalidad'][$registro];
    $nombreLocalidad = $handle['nombreloc'][$registro];
    $localidad = new Localidad();
    $localidad->setIdLocalidad($idLocalidad);
    $localidad->setNombreLocalidad($nombreLocalidad);
    array_push($localidades, $localidad);
}

header('Content-Type: application/json');
$jsonResponse = json_encode($localidades);
echo $jsonResponse;

