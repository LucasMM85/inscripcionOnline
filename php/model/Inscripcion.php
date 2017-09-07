<?php

namespace model;


class Inscripcion implements \JsonSerializable
{
    private $idInscripcion;
    private $persona;

    /**
     * @return mixed
     */
    public function getIdInscripcion()
    {
        return $this->idInscripcion;
    }

    /**
     * @param mixed $idInscripcion
     * @return Inscripcion
     */
    public function setIdInscripcion($idInscripcion)
    {
        $this->idInscripcion = $idInscripcion;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * @param mixed $persona
     * @return Inscripcion
     */
    public function setPersona($persona)
    {
        $this->persona = $persona;
        return $this;
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}