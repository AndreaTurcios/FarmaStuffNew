<?php

class Estado extends Validator 
{
   private $id=null;
   private $estado=null;

   

    public function readClienteEstado()
    {
        $sql ='';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    public function readAll()
    {
        $sql ='SELECT idestadocliente, estado 
               FROM estadoCliente
               ORDER BY estado DESC';
        $params = null;
        return Database::getRows($sql, $params);

    }


    public function CantidadEstadoCliente()
    {
        $sql ='SELECT estado, COUNT(idcliente) as Cantidad
               From cliente
               Inner join estadocliente USING(idestadocliente)
               Group by estado';
        $params = null;
        return Database::getRows($sql, $params);

    }



}