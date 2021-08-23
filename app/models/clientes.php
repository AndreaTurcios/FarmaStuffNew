<?php 

class Clientes extends Validator {

    private $id = null;
    private $nombres = null; 
    private $apellidos = null;
    private $telefono = null;  
    private $dui = null;
    private $direccion = null;
    private $correo = null;    
    private $departamento = null;
    private $estado = null; 

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        } 
    }

    public function setNombres($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombres = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidos($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellidos = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTelefono($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefono = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDUI($value)
    {
        if ($this->validateDUI($value)) {
            $this->dui = $value;
            return true;
        } else {
            return false;
        }
    }

    // public function setNacimiento($value)
    // {
    //     if ($this->validateDate($value)) {
    //         $this->nacimiento = $value;
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function setDireccion($value)
    {
        if ($this->validateString($value, 1, 200)) {
            $this->direccion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClave($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDepartamento($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->estado = $value;
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

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getDUI()
    {
        return $this->dui;
    }

    public function getNacimiento()
    {
        return $this->nacimiento;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    // public function getClave()
    // {
    //     return $this->clave;
    // }

    public function getDepartamento()
    {
        return $this->estado;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        // $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO cliente (nombrecliente,apellidocliente,telefonocliente,duicliente,direccioncliente,correocliente,idestadocliente)
        VALUES (? ,?, ?, ?, ?, ?, ?)';
        $params = array($this->nombres, $this->apellidos, $this->telefono,$this->dui, $this->direccion, $this->correo,$this->estado);
        return Database::executeRow($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = 'SELECT idcliente, nombrecliente, apellidocliente, telefonocliente, duicliente, direccioncliente, correocliente, estado
                FROM cliente cl
                INNER JOIN estadocliente ec on ec.idestadocliente = cl.idestadocliente
                WHERE nombrecliente ILIKE ? OR apellidocliente ILIKE ? OR duicliente ILIKE ?
                ORDER BY nombrecliente';
        $params = array("%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }


    public function readAll()
    {
        $sql = 'SELECT idcliente,nombrecliente,apellidocliente,telefonocliente,duicliente,direccioncliente,correocliente,estado,usuariocliente
                FROM cliente cl
                INNER JOIN estadocliente ec ON ec.idestadocliente = cl.idestadocliente
                ORDER BY apellidocliente';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT idcliente,nombrecliente,apellidocliente,telefonocliente,duicliente,direccioncliente,correocliente,idestadocliente,usuariocliente
                FROM cliente
                INNER JOIN estadocliente USING(idestadocliente)
                WHERE idcliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function readOneReport()
    {
        $sql = 'SELECT idcliente,nombrecliente,apellidocliente,telefonocliente,duicliente,direccioncliente,correocliente,idestadocliente,usuariocliente
                FROM cliente
                INNER JOIN estadocliente USING(idestadocliente)
                WHERE idcliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function readOneOrder()
    {
        $sql = 'SELECT idcliente,nombrecliente , duicliente ,  fechaenvio, fecharecibo, nombreproducto , fotoproducto ,preciototal, costoenvio ,cantidad 
                FROM orden
                INNER JOIN cliente USING (idcliente)
                INNER JOIN detalleorden USING(idorden)
                INNER JOIN productoproveedor USING(idproveedorproducto)
                INNER JOIN productos USING(idproducto)
                WHERE idcliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }


    public function searchOneOrder($value)
    {
        $sql = 'SELECT idcliente,nombrecliente, duicliente , fechaenvio, fecharecibo, nombreproducto , fotoproducto ,preciototal, costoenvio ,cantidad 
                FROM orden
                INNER JOIN cliente USING (idcliente)
                INNER JOIN detalleorden USING(idorden)
                INNER JOIN productoproveedor USING(idproveedorproducto)
                INNER JOIN productos USING(idproducto)                
                WHERE duicliente ILIKE ?';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE cliente 
                SET idestadocliente = ?
                WHERE idcliente = ?';
        $params = array($this->estado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM cliente
                WHERE idcliente = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function readClienteOrden()
    {
        $sql = 'SELECT idcliente,  nombrecliente , apellidocliente , telefonocliente, direccioncliente, duicliente, fechaenvio, fecharecibo, costoenvio, nombreencargado, nombrecompania
                FROM Orden 
                INNER JOIN cliente USING(idcliente)
                INNER JOIN repartidor USING(idrepartidor)
                WHERE idcliente = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    public function readOrdenFinal()
    {
        $sql = 'SELECT nombreproducto, descripcionproducto, precioproducto , preciototal,codigoproducto,nombrecliente, cantidad
        FROM detalleorden od
        Inner join productoproveedor USING(idproveedorproducto)
        Inner join productos USING(idproducto)
        Inner join orden USING(idorden)
        Inner join cliente USING(idcliente)
        WHERE idorden=(Select max(idorden) from orden)';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOneFinal()
    {
        $sql = 'SELECT idorden,idcliente,nombreencargado,nombrecompania, telefonocompania,nombrecliente,apellidocliente,duicliente,direccioncliente,telefonocliente,fechaenvio,fecharecibo, preciototal
        FROM cliente
        Inner join orden USING(idcliente)
        Inner join detalleorden USING(idorden)
        Inner join repartidor USING(idrepartidor)
        WHERE idorden=(Select max(idorden) from orden)';
        $params = null;
        return Database::getRow($sql, $params);
    }

    public function readTotalFinal()
    {
        $sql = 'SELECT  Sum(preciototal) as Totalpago
        FROM detalleorden od
        Inner join productoproveedor USING(idproveedorproducto)
        Inner join productos USING(idproducto)
        Inner join orden USING(idorden)
        Inner join cliente USING(idcliente)
        WHERE idorden=(Select max(idorden) from orden)
        ';
        $params = null;
        return Database::getRow($sql, $params);
    }

}
?>