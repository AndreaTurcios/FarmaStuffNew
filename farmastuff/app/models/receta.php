<?php

class recetas extends Validator{
    private $id = null;
    private $fechaenvio = null;
    private $fecharecibo = null;
    private $fotoreceta=null;
    private $fotofrentecarnet =null;
    private $fotoreversocarnet = null;
    private $costoenvio = null;
    private $estadoorden=null;
    private $idcliente=null;
    private $idrepartidor = null;
    private $ruta = '../../../resources/img/';


    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this-> id = $value;
            return true;
        } else {
            return false;
        }
    }    
    public function setFechaenvio($value)
    {
        if ($this->validateDate($value)) {
            $this->fechaenvio = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setFecharecibo($value)
    {
        if ($this->validateDate($value)) {
            $this->fecharecibo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setFotoreceta($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->fotoreceta = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }
    public function setFotofrentecarnet($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->fotofrentecarnet = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }
    public function setFotoreversocarnet($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->fotoreversocarnet = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }
    public function setCostoenvio($value)
    {
        if ($this->validateMoney($value)) {
            $this->costoenvio = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setEstadoorden($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->estadoorden = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdcliente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idcliente = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdrepartidor($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idrepartidor = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getId()
    {
        return $this->id;
    }
    public function getFechaenvio()
    {
        return $this->fechaenvio;
    }
    public function getFecharecibo()
    {
        return $this->fecharecibo;
    }
    public function getFotoreceta()
    {
        return $this->fotoreceta;
    }
    public function getFotofrentecarnet()
    {
        return $this->fotofrentecarnet;
    }
    public function getFotoreversocarnet()
    {
        return $this->fotoreversocarnet;
    }
    public function getCostoenvio()
    {
        return $this->costoenvio;
    }
    public function getEstadoorden()
    {
        return $this->estadoorden;
    }
    public function getIdcliente()
    {
        return $this->idcliente;
    }
    public function getIdrepartidor()
    {
        return $this->idrepartidor;
    }
    public function getRuta()
    {
        return $this->ruta;
    }
    public function createRow()
 {
    $hash =  null;
    $hola = null;
    $ostia =  '0.99';
    $estado ='1';
    $cliente= '1';
    $repartidor='1';
    $sql = 'INSERT INTO orden (fechaenvio, fecharecibo, fotoreceta, fotofrentecarnet, fotoreversocarnet, costoenvio, estadoorden, idcliente, idrepartidor)
    VALUES (current_date,current_date,?,?,?,?,?,?,?)';
    $params = array($this->fotoreceta,$hash, $hola, $ostia, $estado,$cliente, $repartidor);
    return Database::executeRow($sql, $params);
}
public function createRows()
{

   $ostia =  '0.99';
   $estado ='1';
   $cliente= '1';
   $repartidor='1';
   $sql = 'INSERT INTO orden (fechaenvio, fecharecibo, fotoreceta, fotofrentecarnet, fotoreversocarnet, costoenvio, estadoorden, idcliente, idrepartidor)
   VALUES (current_date,current_date,?,?,?,?,?,?,?)';
   $params = array($this->fotoreceta,$this->fotofrentecarnet, $this->fotoreversocarnet, $ostia, $estado,$cliente, $repartidor);
   return Database::executeRow($sql, $params);
}
}
