<?php
/**
 * Created by PhpStorm.
 * User: Lucas Mussi
 * Date: 5/10/2017
 * Time: 11:26
 */

namespace model;


class EstadoInscripcion implements \JsonSerializable
{
    private $isActivo;
    private $mensaje;

    /**
     * @return mixed
     */
    public function getisActivo()
    {
        return $this->isActivo;
    }

    /**
     * @param mixed $isActivo
     * @return EstadoInscripcion
     */
    public function setIsActivo($isActivo)
    {
        $this->isActivo = $isActivo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @param mixed $mensaje
     * @return EstadoInscripcion
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
        return $this;
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}