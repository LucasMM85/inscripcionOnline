<?php

namespace model;


class Persona implements \JsonSerializable
{
    private $apellido;
    private $nombre;
    private $documento;
    private $cuil;
    private $sexo;
    private $fechanac;
    private $domicilio;
    private $localidad;
    private $codpostal;
    private $telfijo;
    private $telcelular;
    private $email;
    private $tituloUniversitario;
    private $fechaTituloUniversitario;
    private $fechaTituloEspecialidad;
    private $sancion;
    private $antecedentes;

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     * @return Persona
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     * @return Persona
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param mixed $documento
     * @return Persona
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCuil()
    {
        return $this->cuil;
    }

    /**
     * @param mixed $cuil
     * @return Persona
     */
    public function setCuil($cuil)
    {
        $this->cuil = $cuil;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     * @return Persona
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechanac()
    {
        return $this->fechanac;
    }

    /**
     * @param mixed $fechanac
     * @return Persona
     */
    public function setFechanac($fechanac)
    {
        $this->fechanac = $fechanac;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * @param mixed $domicilio
     * @return Persona
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * @param mixed $localidad
     * @return Persona
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodpostal()
    {
        return $this->codpostal;
    }

    /**
     * @param mixed $codpostal
     * @return Persona
     */
    public function setCodpostal($codpostal)
    {
        $this->codpostal = $codpostal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelfijo()
    {
        return $this->telfijo;
    }

    /**
     * @param mixed $telfijo
     * @return Persona
     */
    public function setTelfijo($telfijo)
    {
        $this->telfijo = $telfijo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTelcelular()
    {
        return $this->telcelular;
    }

    /**
     * @param mixed $telcelular
     * @return Persona
     */
    public function setTelcelular($telcelular)
    {
        $this->telcelular = $telcelular;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Persona
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTituloUniversitario()
    {
        return $this->tituloUniversitario;
    }

    /**
     * @param mixed $tituloUniversitario
     * @return Persona
     */
    public function setTituloUniversitario($tituloUniversitario)
    {
        $this->tituloUniversitario = $tituloUniversitario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechaTituloUniversitario()
    {
        return $this->fechaTituloUniversitario;
    }

    /**
     * @param mixed $fechaTituloUniversitario
     * @return Persona
     */
    public function setFechaTituloUniversitario($fechaTituloUniversitario)
    {
        $this->fechaTituloUniversitario = $fechaTituloUniversitario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFechaTituloEspecialidad()
    {
        return $this->fechaTituloEspecialidad;
    }

    /**
     * @param mixed $fechaTituloEspecialidad
     * @return Persona
     */
    public function setFechaTituloEspecialidad($fechaTituloEspecialidad)
    {
        $this->fechaTituloEspecialidad = $fechaTituloEspecialidad;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSancion()
    {
        return $this->sancion;
    }

    /**
     * @param mixed $sancion
     * @return Persona
     */
    public function setSancion($sancion)
    {
        $this->sancion = $sancion;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAntecedentes()
    {
        return $this->antecedentes;
    }

    /**
     * @param mixed $antecedentes
     * @return Persona
     */
    public function setAntecedentes($antecedentes)
    {
        $this->antecedentes = $antecedentes;
        return $this;
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}