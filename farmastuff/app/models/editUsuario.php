<?php

class edit extends Validator
{
    private $id= null;
    private $comentarios = null;
    private $idCliente = null;
    private $calificacion=null;
    private $idProducto = null;

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setComentario($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->comentario = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdCliente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->Cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCalificacion($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->calificacion = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdProducto($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->IdProducto = $value;
            return true;
        } else {
            return false;
        }
    }


    public function getId()
    {
        return $this->id;
    }

    public function getComentario()
    {
        return $this->Comentario;
    }

    public function getIdCliente()
    {
        return $this->Cliente;
    }

    public function getCalificacion()
    {
        return $this->calificacion;
    }

    public function getIdProducto()
    {
        return $this->IdProducto;
    }
    
    public function readAll()
    {
        $sql = 'SELECT idvaloracion, comentario, nombrecliente, estrellas, nombreproducto, estadovaloracion
        FROM valoraciones vl
		Inner join productoproveedor pp on pp.idproveedorproducto = vl.idproducto
        Inner join productos pr on pr.idproducto = pp.idproducto
        Inner join Cliente cl on  cl.idcliente = vl.idcliente
        Inner join estadovaloracion ev on ev.idestadovaloracion = vl.idestadovaloracion
       ORDER BY idvaloracion';
        $params = null;
        return Database::getRows($sql, $params);
    }


    public function readOne()
    {
        $sql = 'SELECT idvaloracion, comentario, nombrecliente, estrellas, nombreproducto, estadovaloracion, usuariocliente
        FROM valoraciones vl
		Inner join productoproveedor pp on pp.idproveedorproducto = vl.idproducto
        Inner join productos pr on pr.idproducto = pp.idproducto
        Inner join Cliente cl on  cl.idcliente = vl.idcliente
        Inner join estadovaloracion ev on ev.idestadovaloracion = vl.idestadovaloracion
        WHERE idvaloracion = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function  searchRows($value)
    {
        $sql = 'SELECT idvaloracion, comentarios, nombrecliente, calificacion, nombreproducto, estadovaloracion
        FROM valoraciones vl
		Inner join productoproveedor pp on pp.idproveedorproducto = vl.idproducto
        Inner join productos pr on pr.idproducto = pp.idproducto
        Inner join Cliente cl on  cl.idcliente = vl.idcliente
        Inner join estadovaloracion ev on ev.idestadovaloracion = vl.idestadovaloracion
        WHERE nombreproducto  ILIKE ? OR nombrecliente ILIKE ? 
       ORDER BY idvaloracion';
        $params = array("%$value%","%$value%");
        return Database::getRows($sql, $params);
    }                                     

    public function ocultar()
    {
        $sql = 'UPDATE valoraciones SET idestadovaloracion=2 Where idvaloracion=?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function mostrar()
    {
        $sql = 'UPDATE valoraciones SET idestadovaloracion=1 Where idvaloracion=?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function readReport()
    {
        $sql = 'SELECT usuariocliente,idvaloracion, comentario, nombrecliente, estrellas, nombreproducto, estadovaloracion
        FROM valoraciones vl
		Inner join productoproveedor pp on pp.idproveedorproducto = vl.idproducto
        Inner join productos pr on pr.idproducto = pp.idproducto
        Inner join Cliente cl on  cl.idcliente = vl.idcliente
        Inner join estadovaloracion ev on ev.idestadovaloracion = vl.idestadovaloracion
        WHERE idvaloracion = ?';
         $params = array($this->id);
         return Database::getRows($sql, $params);
    }

    public function valoracionesGrafica()
    {
        $sql = 'SELECT nombreproducto, COUNT(estrellas) as cantidad
        From valoraciones 
        Inner join productos USING(idproducto)
        Inner join productoproveedor USING(idproducto)
        Group by nombreproducto        
        limit 10';
        $params = null;
        return Database::getRows($sql, $params);
    }
}
