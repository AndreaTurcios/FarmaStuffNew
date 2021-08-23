<?php

class tipoEmpleado extends Validator{
    private $id=null;
    private $tipoempleado = null;

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setTipoEmpleado($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->tipoempleado = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getId()
    {
        return $this->id;
    }

    public function getTipoEmpleado()
    {
        return $this->tipoempleado;
    }
    public function nose()
    {
        $sql = '';
        $params = null;
     return Database::getRows($sql, $params); 
    }

    public function readAll()
    {
        $sql = 'SELECT idtipoempleado, tipoempleado
                FROM tipoEmpleado';
        $params = null;
        return Database::getRows($sql, $params);
    }


}
