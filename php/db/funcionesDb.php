<?php
/**
 * Created by PhpStorm.
 * User: corvu
 * Date: 8/5/2017
 * Time: 11:23
 */

function parametros_conexion_pg(){

    $usuario='sa';
    $clave='1';
    $nombredb='cuestionario';
    $puerto='5437';
    $host='127.0.0.1';
    $cadena_con="host=".$host." port=".$puerto." dbname=".$nombredb." user=".$usuario." password=".$clave."";

    return $cadena_con;
}

function asignarTurno($consulta){
    ini_set('display_errors',1);
    $cadenaconexion = parametros_conexion_pg();
    $conexion = pg_connect($cadenaconexion);

    $query=$consulta;
    $rs1 = pg_query($conexion, $query);
    $numCampos = pg_num_fields($rs1);
    $numReg = pg_num_rows($rs1);

    $orden=1;
    $retorno['cantregistros'][0]=0;
    if ($numReg>0){
        $retorno['cantregistros'][0]=$numReg;
        $retorno['cantcolumnas'][0]=$numCampos;

        for ($c=0;$c<$numCampos;$c++){
            $retorno[0][$c]=pg_field_name($rs1,$c); //incorporación de los nombres de campos en la fila0 del array
        }
        while ($orden<=$numReg){
            $arr1=pg_fetch_array($rs1,$orden-1,PGSQL_BOTH);//array de la fila $orden (el array inicia en 0 y los registros se inicializan en 1

            for($c=0;$c<$numCampos;$c++){
                $retorno[$c][$orden]=$arr1[$c]; //valores de registros referenciados por nros de columna y nro de fila
                $retorno[pg_field_name($rs1,$c)][$orden]=$arr1[$c]; //valores de registros referenciados por nombres de columna y nros de fila
            }
            $orden++;
        };
    };

    $rs1 = pg_send_query($conexion, $query);
    $result=pg_get_result($conexion);
    if (pg_result_status($result)==7){
        $retorno['cantregistros'][0]=0;
        $retorno['cantcolumnas'][0]=0;
        $retorno['errmsg'][0]=pg_last_error($conexion);
        $retorno['error'][0]=1;
        $retorno['comsql'][0]=$consulta;
    };
    if (pg_result_status($result)==0){
        $retorno['errmsg'][0]='consulta vacía';
        $retorno['error'][0]=0;
        $retorno['comsql'][0]=$consulta;
    };
    if (pg_result_status($result)==2){
        $retorno['errmsg'][0]='no hay registros';
        $retorno['error'][0]=0;
        $retorno['comsql'][0]=$consulta;
    };

    return $retorno;
}

function valor_nulo ($valor_evaluado,$valor_siesnulo){
    if ($valor_evaluado == NULL){
        return $valor_siesnulo;
    } else {
        return $valor_evaluado;
    }
}