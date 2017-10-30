<?php

function formatoFecha($fecha){
    if($fecha != null){
        return date("d/m/Y", strtotime($fecha));
    }
    return null;
}

function getSiNo($valor){
    if(strcmp($valor, "0") == 0){
        $texto = "NO";
    } else {
        $texto = "SI";
    }
    return $texto;
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
    } else if(strcmp($especialidadInicial, "cirujano") === 0){
        $especialidad = "MÉDICO CIRUJANO";
    } else if(strcmp($especialidadInicial, "legista") === 0){
        $especialidad = "MÉDICO LEGISTA";
    } else if(strcmp($especialidadInicial, "bioquimico") === 0){
        $especialidad = "BIOQUIMICO";
    } else if(strcmp($especialidadInicial, "licgenetica") === 0){
        $especialidad = "LICENCIADO EN GENÉTICA";
    } else if(strcmp($especialidadInicial, "anatomopat") === 0) {
        $especialidad = "MEDICO ANATOMÍA PATOLÓGICA";
    }
    return $especialidad;
}