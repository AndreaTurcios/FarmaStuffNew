<?php

class orden extends Validator
{
    private $id = null;
    private $id_detalle =null;
    private $fecha = null;
    private $fechar = null;
    private $precio = null;
    private $producto = null;
    private $estado = null;
    private $cantidad =null;
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
    public function setId_detalle($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this-> id_detalle = $value;
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
    public function setIdrepartidor($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->repartidor = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setCantidad($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setProducto($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->producto = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setEstado($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getid(){
        return $this->id;
    } 
    public function getid_cliente(){
        return $this->id_cliente;
    } 
    
    
    public function startOrder()
    {
        $this->estado = 0;
        $envio =  '0.99';
        $hola = 1;
        $sql = 'SELECT idorden
                FROM orden
                WHERE estadoorden = ? AND idcliente = ?';
        $params = array($this->estado, $_SESSION['idcliente']);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['idorden'];
            return true;
        } else {
            $sql = 'INSERT INTO orden(fechaenvio,fecharecibo,estadoorden, idcliente,costoenvio,idrepartidor)
                    VALUES(current_date,current_date,?, ?,?,?)';
            $params = array($this->estado,$_SESSION['idcliente'],$envio,$hola);
            // Se obtiene el ultimo valor insertado en la llave primaria de la tabla pedidos.
            if ($this->id = Database::getLastRow($sql, $params)) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function createDetail()
    {
        // Se realiza una subconsulta para obtener el precio del producto.
        $sql = 'INSERT INTO detalleorden(idproveedorproducto, cantidad, idorden)
        VALUES(?, ?, ?)';
        $params = array( $this->producto, $this->cantidad, $this->id);
        return Database::executeRow($sql, $params);
    }
    public function readOrderDetail()
    {
        $sql = 'SELECT iddetalleorden, nombreproducto, detalleorden.precioproducto, detalleorden.cantidad
        FROM orden 
        INNER JOIN detalleorden USING(idorden)
        INNER JOIN productoproveedor USING(idproveedorproducto)
        INNER JOIN productos USING(idproducto)
        WHERE idorden = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
    public function finishOrder()
    {
        // Se establece la zona horaria local para obtener la fecha del servidor.
        date_default_timezone_set('America/El_Salvador');
        $date = date('Y-m-d');
        $this->estado = 1;
        $sql = 'UPDATE orden
                SET estadoorden = ?, fecharecibo = ?, fechaenvio= ?
                WHERE idorden = ?';
        $params = array($this->estado, $date,$date, $_SESSION['idorden']);
        return Database::executeRow($sql, $params);
    }
    public function updateDetail()
    {
       
        $sql = 'UPDATE detalleorden
                SET cantidad = ?
                WHERE iddetalleorden = ? AND idorden = ?';
        $params = array($this->cantidad, $this->id_detalle, $_SESSION['idorden']);
        return Database::executeRow($sql, $params);
    }

    // Método para eliminar un producto que se encuentra en el carrito de compras.
    public function deleteDetail()
    {
        
        $sql = 'DELETE FROM detalleorden
                WHERE iddetalleorden = ? AND idorden = ?';
        $params = array($this->id_detalle, $_SESSION['idorden']);
        return Database::executeRow($sql, $params);
    }
      /*  nombreproducto,    INNER JOIN productos USING(idproducto)*/
  /*  public function readAll()
    {
        $sql = 'SELECT 
        pr.nombreproducto
        ,pp.idproducto
        ,e.cantidad
        ,e.precioproducto
        ,p.fechacreacion
        ,p.costoenvio
        ,e.preciototal
        ,p.idcliente
        ,p.idorden
   from orden p
   inner join detalleorden e on e.idorden = p.idorden
   inner join productoproveedor pp on pp.idproveedorproducto = e.idproveedorproducto
   inner join productos pr on pr.idproducto = pp.idproducto';
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
        $sql = 'SELECT 
        pr.nombreproducto
        ,pp.idproducto
        ,e.cantidad
        ,e.precioproducto
        ,p.fechacreacion
        ,p.costoenvio
        ,e.preciototal
        ,p.idcliente
        ,p.idorden
   from orden p
   inner join detalleorden e on e.idorden = p.idorden 
   inner join productoproveedor pp on pp.idproveedorproducto = e.idproveedorproducto
   inner join productos pr on pr.idproducto = pp.idproducto
   where p.idorden=?';                                     
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
*/
}
