<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos. Es clase hija de Validator.
*/
class usuario extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $nombreempleado = null;
    private $apellidoempleado = null;
    private $telefonoempleado = null;
    private $direccionempleado = null;
    private $correoempleado = null;
    private $estadoempleado = null;
    private $usuario = null;
    private $clave = null;
    private $idtipoempleado = null;

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombreEmpleado($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->nombreempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidoEmpleado($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->apellidoempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTelefonoEmpleado($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefonoempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDireccionEmpleado($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->direccionempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreoEmpleado($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->correoempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstadoEmpleado($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->estadoempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setUsuario($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->usuario = $value;
            return true;
        } else {
            return false;
        }
    }
    
    public function setClave($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIDTipoEmpleado($value)
    {
        if ($this->validateBoolean($value)) {
            $this->idtipoempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreEmpleado()
    {
        return $this->nombreempleado;
    }

    public function getApellidoEmpleado()
    {
        return $this->apellidoempleado;
    }

    public function getTelefonoEmpleado()
    {
        return $this->telefonoempleado;
    }

    public function getDireccionEmpleado()
    {
        return $this->direccionempleado;
    }

    public function getCorreoEmpleado()
    {
        return $this->correoempleado;
    }

    public function getEstadoEmpleado()
    {
        return $this->estadoempleado;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getIDTipoEmpleado()
    {
        return $this->idtipoempleado;
    }                 
    /*
    *   Métodos para gestionar la cuenta del usuario.
    */                                                                    
    public function checkUser($usuario)
    {
        $sql = 'SELECT idempleado, correoempleado, idtipoempleado FROM empleado WHERE usuario = ?';
        $params = array($usuario);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['idempleado'];
            $this->correoempleado = $data['correoempleado'];
            $this->idtipoempleado  = $data['idtipoempleado'];
            $this->usuario = $usuario;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($clave)
    {
        $sql = 'SELECT clave FROM empleado WHERE idempleado = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($clave, $data['clave'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE empleado SET clave = ? WHERE idempleado = ?';
        $params = array($hash, $_SESSION['idempleado']);
        return Database::executeRow($sql, $params);
    }

    public function readProfile()
    {
        $sql = 'SELECT idempleado,nombreempleado,apellidoempleado,telefonoempleado,direccionempleado,correoempleado,estadoempleado,usuario,clave,idtipoempleado
                FROM empleado 
                WHERE idempleado = ?'
                ;
        $params = array($_SESSION['idempleado']);
        return Database::getRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE empleado 
                SET nombreempleado=?,apellidoempleado=?,telefonoempleado=?,direccionempleado=?,correoempleado=?,estadoempleado=?,usuario=?,clave=?,idtipoempleado=?
                WHERE idempleado = ?';
        $params = array($this->nombreempleado, $this->apellidoempleado, $this->telefonoempleado,$this->direccionempleado,$this->correoempleado,$this->estadoempleado,$this->usuario,$this->clave,$this->idtipoempleado, $_SESSION['idempleado']);
        return Database::executeRow($sql, $params);
    }
    
    public function readAll()
    {
        $sql = 'SELECT idempleado,nombreempleado,apellidoempleado,telefonoempleado,direccionempleado,correoempleado,estadoempleado,usuario,clave,idtipoempleado
                FROM empleado 
                ORDER BY idempleado';
        $params = null;
        return Database::getRows($sql, $params);
    }
}