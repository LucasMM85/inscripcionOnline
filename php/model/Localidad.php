<?php

namespace model;


class Localidad implements \JsonSerializable
{
    private $idLocalidad;
    private $nombreLocalidad;

    /**
     * @return mixed
     */
    public function getIdLocalidad()
    {
        return $this->idLocalidad;
    }

    /**
     * @param mixed $idLocalidad
     * @return Localidad
     */
    public function setIdLocalidad($idLocalidad)
    {
        $this->idLocalidad = $idLocalidad;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombreLocalidad()
    {
        return $this->nombreLocalidad;
    }

    /**
     * @param mixed $nombreLocalidad
     * @return Localidad
     */
    public function setNombreLocalidad($nombreLocalidad)
    {
        $this->nombreLocalidad = $nombreLocalidad;
        return $this;
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}