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
    private $correo = null;
    private $estadoempleado = null;
    private $usuario = null;
    private $clave = null;
    private $idtipoempleado = null;
    private $fecha = null;
    private $browser = null;
    private $os = null;
    private $codigoos = null;
    private $codigo = null;

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


    public function setCorreo($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->correo = $value;
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
        if ($this->validatePassword($value, 1, 50)) {
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

    public function setFecha($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setBrowser($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->browser = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setOs($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->os = $value;
            return true;
        } else {
            return false;
        }
    }



    public function setCodigoo($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->codigoos = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setCodigo($value)
    {
        if ($this->validateString($value,1,55)) {
            $this->codigo = $value;
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

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getBrowser()
    {
        return $this->browser;
    }

    public function getOs()
    {
        return $this->os;
    }

    public function getCodigoo()
    {
        return $this->codigoos;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }


    public function getCorreo()
    {
        return $this->correo;
    }

    /*
    *   Métodos para gestionar la cuenta del usuario.
    */    
    
    
    public function createRowHistorial()
    {       
        $sql = 'INSERT INTO HistorialSesionesPrivadas (usuarioh, browserh, sisoperativo, fecharegistro)
        VALUES (?,?,?,?)';
        $params = array($this->usuario, $this->browser, $this->os , $this->fecha);
        return Database::executeRow($sql, $params);
    }

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

    public function verificacion($usuario)
    {
        $sql = 'SELECT correoempleado WHERE usuario = ?';
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

    public function updatePassword()
    { $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE empleado 
        SET clave=?
        WHERE idempleado = ?';
        $params = array($hash,$this->id);
        return Database::executeRow($sql, $params);
    }
    
    public function changePassword()
    {
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE empleado SET clave = ? WHERE idempleado = ?';
        $params = array($hash, $this->id);
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

    public function searchRows($value)
    {
        $sql = "SELECT idempleado, nombreempleado, apellidoempleado, correoempleado ,usuario                            
                FROM empleado                 
                WHERE correoempleado ILIKE ? ";
        $params = array("%$value%");
        return Database::getRow($sql, $params);
    }

    public function saveCodigo()
    {       
        $sql = 'INSERT into codigorecuperacion (codigo, correodestinatario) values (? , ?)';
        $params = array($this->codigo, $this->correo);
        return Database::executeRow($sql, $params);
    }

    public function verificarCodigo()
    {
        $sql = "SELECT correodestinatario , codigo
                from codigorecuperacion 
                Where codigo = ?
                and codigo=(Select codigo from codigorecuperacion Where idrecuperacion=(Select max(idrecuperacion) from codigorecuperacion )) ";
        $params = array($this->codigo);
        return Database::getRow($sql, $params);
    }

    public function verificarUsuario()
    {
        $sql = "SELECT usuario from empleado Where clave != ?";
        $params = array($this->clave);
        return Database::getRow($sql, $params);
    }

    public function verificarClaves()
    {
        $sql = "SELECT clave from empleado Where clave != ?";
        $params = array($this->clave);
        return Database::getRow($sql, $params);
    }    

    public function updateCodigo()
    {   
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE empleado Set clave = ? Where correoempleado = (Select correodestinatario from codigorecuperacion Where idrecuperacion = (Select max(idrecuperacion) From codigorecuperacion ))';
        $params = array($hash);
        return Database::executeRow($sql, $params);
    }

    public function GuardarCodigoValidacion()
    {       
        $sql = 'INSERT Into VerificarSesiones (codigo, idusuario) values ( ? , ? )';
        $params = array($this->codigoos, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function readCodigoSesiones()
    {
        $sql = 'SELECT codigo From VerificarSesiones Where codigo = ?  And idvalidar = (Select Max(idvalidar) From VerificarSesiones )';
        $params = array($this->codigoos);
        return Database::getRow($sql, $params);
    } 
    

}
