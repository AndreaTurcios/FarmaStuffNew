<?php

class orden extends Validator
{
    private $id = null;
    private $fecha = null;
    private $fechar = null;
    private $imagen = null;
    private $imagenf = null;
    private $imagenr = null;
    private $precio = null;
    private $estado = null;
    private $cliente = null;
    private $repartidor = null;

                                                         
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this-> id = $value;
            return true;
        } else {
            return false;
        }
    }                                            
    public function setfecha($value)
    {
        if ($this->validateDate($value)) {
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setfechar($value)
    {
        if ($this->validateDate($value)) {
            $this->fechar = $value;
            return true;
        } else {
            return false;
        }
    }
    
    public function setprecio($value)
    {
        if ($this->validateMoney($value)) {
            $this->precio = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setclientenombre($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cliente = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setclienteapellido($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cliente = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setclienteusuario($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cliente = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdrepartidor($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->repartidor = $value;
            return true;
        } else {
            return false;
        }
    }


    public function getid(){
        return $this->id;
    }  
    public function getfecha(){
        return $this->fecha;
    }
    public function getfechar(){
        return $this->fechar;
    } 
    public function getprecio(){
        return $this ->precio;
    }
    public function getclientenombre(){
        return $this ->clienten;
    }
    public function getclienteapellido(){
        return $this -> clientea;
    }
   
    public function getclienteusuario(){
        return $this ->clienteu;
    }

    public function getrepartidor(){
        return $this ->repartidor;
    }
    
    public function readAll()
    {
        $sql = 'SELECT idOrden, fechaEnvio, fechaRecibo, costoEnvio, nombreCliente, apellidocliente, usuariocliente,  nombreEncargado 
        FROM Orden 
        INNER JOIN Cliente USING (idcliente)
        INNER JOIN repartidor USING (idrepartidor)
        ORDER BY idOrden';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function  searchRows($value)
    {
        $sql = 'SELECT idOrden, fechaEnvio, fechaRecibo, costoEnvio, nombreCliente, apellidocliente, usuariocliente,  nombreEncargado 
        FROM Orden 
        INNER JOIN  Cliente USING (idcliente)
        INNER JOIN repartidor USING (idrepartidor)
		WHERE nombreCliente ILIKE ? OR nombreEncargado  ILIKE ? 
        ORDER BY idOrden';
        $params = array("%$value%","%$value%");
        return Database::getRows($sql, $params);
    }
     Public function readOne()
     {
        $sql = 'SELECT idOrden, fechaEnvio, fechaRecibo, costoEnvio, nombreCliente, duicliente ,correocliente, telefonocliente, direccioncliente,apellidocliente, usuariocliente, nombreEncargado
        FROM Orden                             
        INNER JOIN  Cliente USING (idcliente)
        INNER JOIN repartidor USING (idrepartidor)
        WHERE idOrden =?';                                     
        $params = array($this->id);
        return Database::getRow($sql, $params);
     } 

    public function deleteRow()
    {
        $sql = 'DELETE FROM Orden
                WHERE idOrden = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }


    public function readClienteDetalle()
    {
        $sql = 'SELECT nombrecliente, apellidocliente,telefonocliente, duicliente, 
                       fechaenvio, fecharecibo, costoenvio, Preciototal, precioporunidad, 
                       nombreproducto, codigoproducto, nombrecompania, nombreencargado
                From DetalleOrden od 
                Inner Join Orden ro on ro.idorden = od.idorden
                Inner Join repartidor re on re.idrepartidor = ro.idrepartidor
                Inner Join cliente cl on cl.idcliente = ro.idcliente
                Inner Join productoproveedor pp on pp.idproveedorproducto = od.idproveedorproducto
                Inner Join productos pr on pr.idproducto = pp.idproducto
                Where ro.idorden= ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }


}
