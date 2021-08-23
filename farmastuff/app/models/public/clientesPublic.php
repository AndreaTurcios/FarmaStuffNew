<?php 

class Clientes extends Validator {

    private $id = null;
    private $nombres = null;
    private $apellidos = null;
    private $telefono = null;
    private $dui = null;
    private $direccion = null;
    private $correo = null;    
    private $usuario = null;    
    private $clave = null;
    private $departamento = null;

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

    public function setUsuario($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->usuario = $value;
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
            $this->departamento = $value;
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

     public function getClave()
     {
         return $this->clave;
     }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $nulo = 1;
  
        $sql = 'INSERT INTO cliente (nombrecliente,apellidocliente,telefonocliente,duicliente,direccioncliente,correocliente,usuariocliente,clavecliente,idestadocliente)
        VALUES (? ,?, ?, ?, ?, ?, ?,?,?)';
        $params = array($this->nombres, $this->apellidos, $this->telefono,$this->dui, $this->direccion, $this->correo,$this->usuario,$hash,$nulo);
        return Database::executeRow($sql, $params);
    }
    Public function readAll()
    {
         $sql = 'SELECT iddepartamento, departamento
                 FROM departamento';
        $params = null;
        return Database::getRows($sql, $params);
    }
    Public function readAllOrder()
    {
         $sql = 'SELECT iddepartamento, departamento
                 FROM departamento';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne(){
         $sql = 'SELECT iddepartamento
         FROM cliente
          WHERE idcliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);

    }
    
}
?>