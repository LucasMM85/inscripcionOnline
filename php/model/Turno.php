<?php
/**
 * User: Lucas Mussi
 * Date: 8/5/2017
 * Time: 09:07
 */

namespace model;

class Turno implements \JsonSerializable
{
    private $_idTurno;
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_fechaTurno;
    private $_descripcionTurno;

    /**
     * Turno constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getIdTurno()
    {
        return $this->_idTurno;
    }/**
     * @param mixed $idTurno
     * @return Turno
     */
    public function setIdTurno($idTurno)
    {
        $this->_idTurno = $idTurno;
        return $this;
    }/**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->_nombre;
    }/**
     * @param mixed $nombre
     * @return Turno
     */
    public function setNombre($nombre)
    {
        $this->_nombre = $nombre;
        return $this;
    }/**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->_apellido;
    }/**
     * @param mixed $apellido
     * @return Turno
     */
    public function setApellido($apellido)
    {
        $this->_apellido = $apellido;
        return $this;
    }/**
     * @return mixed
     */
    public function getDni()
    {
        return $this->_dni;
    }/**
     * @param mixed $dni
     * @return Turno
     */
    public function setDni($dni)
    {
        $this->_dni = $dni;
        return $this;
    }/**
     * @return mixed
     */
    public function getFechaTurno()
    {
        return $this->_fechaTurno;
    }/**
     * @param mixed $fechaTurno
     * @return Turno
     */
    public function setFechaTurno($fechaTurno)
    {
        $this->_fechaTurno = $fechaTurno;
        return $this;
    }/**
     * @return mixed
     */
    public function getDescripcionTurno()
    {
        return $this->_descripcionTurno;
    }/**
     * @param mixed $descripcionTurno
     * @return Turno
     */
    public function setDescripcionTurno($descripcionTurno)
    {
        $this->_descripcionTurno = $descripcionTurno;
        return $this;
    }


    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}