<?php
/**
 * User: Lucas Mussi
 * Date: 10/5/2017
 * Time: 07:56
 */

namespace model;


class ErrorInscripcion implements \JsonSerializable {

    private $errorType;
    private $errorMessage;

    /**
     * @return mixed
     */
    public function getErrorType()
    {
        return $this->errorType;
    }

    /**
     * @param mixed $errorType
     * @return ErrorInscripcion
     */
    public function setErrorType($errorType)
    {
        $this->errorType = $errorType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $errorMessage
     * @return ErrorInscripcion
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }


    function jsonSerialize()
    {
        return get_object_vars($this);
    }

}