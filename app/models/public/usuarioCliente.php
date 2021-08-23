<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class usuarioCliente extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $nombrecliente = null;
    private $apellidocliente = null;
    private $telefonocliente = null;
    private $duicliente = null;
    private $direccioncliente = null;
    private $correocliente = null;
    private $usuariocliente = null;
    private $clavecliente = null;
    private $fotocliente = null;
    private $iddepartamento = null;

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombreCliente($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->nombrecliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidoCliente($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->apellidocliente = $value;
            return true;
        } else {
            return false;
        }
    }
    
    public function setTelefonoCliente($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefonocliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDuiCliente($value)
    {
        if ($this->validateDUI($value)) {
            $this->duicliente = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setDireccionCliente($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->direccioncliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreoCliente($value)
    {
        if ($this->validateEmail($value, 1, 50)) {
            $this->correocliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setUsuarioCliente($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->usuariocliente = $value;
            return true;
        } else {
            return false;
        }
    }
    
    public function setClaveCliente($value)
    {
        if ($this->validatePassword($value, 1, 50)) {
            $this->clavecliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFotoCliente($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->fotocliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIDepartamento($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->iddepartamento = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreCliente()
    {
        return $this->nombrecliente;
    }

    public function getApellidoCliente()
    {
        return $this->apellidocliente;
    }

    public function getTelefonoCliente()
    {
        return $this->telefonocliente;
    }

    public function getDuiCliente()
    {
        return $this->duicliente;
    }

    public function getDireccionCliente()
    {
        return $this->direccioncliente;
    }

    public function getCorreoCliente()
    {
        return $this->correocliente;
    }

    public function getUsuarioCliente()
    {
        return $this->usuariocliente;
    }

    public function getClaveCliente()
    {
        return $this->clavecliente;
    }

    public function getFotoCliente()
    {
        return $this->fotocliente;
    }

    public function getIDepartamento()
    {
        return $this->iddepartamento;
    }     
    
    /*
    *   Métodos para gestionar la cuenta del usuario.
    */                                                                    
    public function checkUser($usuariocliente)
    {
        $sql = 'SELECT idcliente, correocliente FROM cliente WHERE usuariocliente = ?';
        $params = array($usuariocliente);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['idcliente'];
            $this->correoempleado = $data['correocliente'];
            $this->usuariocliente = $usuariocliente;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        
        $sql = 'SELECT clavecliente FROM cliente WHERE idcliente = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($password, $data['clavecliente'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        $hash = password_hash($this->clavecliente, PASSWORD_DEFAULT);
        $sql = 'UPDATE cliente SET clavecliente = ? WHERE idcliente = ?';
        $params = array($hash, $_SESSION['idcliente']);
        return Database::executeRow($sql, $params);
    }

    
    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO cliente (nombrecliente,apellidocliente,correocliente,duicliente,direccioncliente,telefonocliente,usuariocliente,clavecliente,iddepartamento)
        VALUES (? ,?, ?, ?, ?, ?, ?,?,?)';
        $params = array($this->nombres, $this->apellidos,$this->correocliente, $this->duicliente,$this->direccioncliente, $this->telefonocliente,$this->usuariocliente,$hash,$this->iddepartamento);
        return Database::executeRow($sql, $params); 
    }

    public function readProfile()
    {
        $sql = 'SELECT idcliente, nombrecliente, apellidocliente, telefonocliente, duicliente, direccioncliente, correocliente, usuariocliente, clavecliente, iddepartamento, idestadocliente
                FROM cliente 
                WHERE idcliente = ?'
                ;
        $params = array($_SESSION['idcliente']);
        return Database::getRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE cliente 
                SET nombrecliente=?,apellidocliente=?,telefonocliente=?,duicliente=?,direccioncliente=?,correocliente=?,usuariocliente=?,clavecliente=?,fotocliente=?,iddepartamento=?,idestadocliente=?
                WHERE idcliente = ?';
        $params = array($this->nombrecliente, $this->apellidocliente, $this->telefonocliente,$this->duicliente,$this->direccioncliente,$this->correocliente,$this->usuariocliente,$this->clavecliente,$this->fotocliente,$this->iddepartamento,$this->idestadocliente, $_SESSION['idcliente']);
        return Database::executeRow($sql, $params);
    }
    
    public function readAll()
    {
        $sql = 'SELECT idcliente, nombrecliente, apellidocliente, telefonocliente, duicliente, direccioncliente, correocliente, usuariocliente, clavecliente, fotocliente, iddepartamento, idestadocliente
                FROM cliente 
                ORDER BY idcliente';
        $params = null;
        return Database::getRows($sql, $params);
    }
}
