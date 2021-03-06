<?php
class Empleados extends Validator{
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
    private $codigo = null;
    

    /*
    public function generarCodigoRecu($longitudCodigo){
        //creamos la variable codigo
        $codigo = "";
        //caracteres a ser utilizados
        $caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $max=strlen($caracteres)-1;
        for($i=0;$i < $longitudCodigo;$i++)
        {
            $codigo.=$caracteres[rand(0,$max)];
        }
        return $codigo;
    }

    public function enviarCorreo($correo, $codigo){
        $mail = new PHPMailer(true);
        try {
            // Configuracion SMTP
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $mail->isSMTP();                                              
            $mail->Host  = 'smtp.gmail.com';                     
            $mail->SMTPAuth  = true;                                       
            $mail->Username  = 'farmastuffsv@gmail.com';                 
            $mail->Password  = 'jdcsiulxrqwyyqod';	// Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port  = 587;
            $mail->setFrom("farmastuffsv@gmail.com", "FarmaStuff"); 
            $mail->addAddress($correo);  
            $mail->isHTML(true);
            $mail->Subject = 'Código para confirmar usuario';
            $mail->Body = 'Estimado cliente, ' .$correo .'gracias por preferirnos. 
                        Por este medio le enviamos el codígo de verificación para continuar con el proceso de verificación de usuario
                        El cual es:<b>'.$codigo.'!</b>';
            $mail->send();
        } catch (Exception $e) {
            $this->$correoError = "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
    */

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    

    public function setCodigo($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->codigo = $value;
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
        if ($this->validateEmail($value)) {
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
        if ($this->validateNaturalNumber($value)) {
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

    

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function autenticacion()
    {
        $sql = 'UPDATE empleado set codigo = ? where idempleado = ?';
        $params = array($this->codigo, $this->id);
        return Database::getRows($sql, $params);
    }

    public function searchRows($value)
    {
        $sql = 'SELECT idempleado, nombreempleado,apellidoempleado,telefonoempleado,direccionempleado,correoempleado,estadoempleado,usuario,tipoempleado
                FROM empleado 
                INNER JOIN tipoempleado USING (idtipoempleado)
                WHERE nombreempleado ILIKE ? OR apellidoempleado ILIKE ? 
                ORDER BY nombreempleado';
        $params = array("%$value%","%$value%");
        return Database::getRows($sql, $params);
    }

    
    public function estadoEmpleadoR()
    {
        $sql ='SELECT estadoempleado, COUNT(nombreempleado) as cantidad
        From empleado 
        Group by estadoempleado';
        $params = null;
        return Database::getRows($sql, $params);

    }

    public function readReport()
    {
        $sql = 'SELECT em.nombreempleado,em.apellidoempleado,em.usuario,te.tipoempleado, em.correoempleado, em.telefonoempleado
        FROM empleado em  
        INNER JOIN tipoempleado te USING(idtipoempleado)
        WHERE idempleado = ?';
         $params = array($this->id);
         return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO empleado (nombreempleado,apellidoempleado,telefonoempleado,direccionempleado,correoempleado,estadoempleado,usuario,clave,idtipoempleado)
        VALUES (? ,?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombreempleado, $this->apellidoempleado, $this->telefonoempleado,$this->direccionempleado,$this->correoempleado,$this->estadoempleado,$this->usuario, $hash,$this->idtipoempleado);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT idempleado,nombreempleado,apellidoempleado,telefonoempleado,direccionempleado,correoempleado,estadoempleado,usuario,tipoempleado
                FROM empleado 
				INNER JOIN tipoempleado USING (idtipoempleado)
                ORDER BY idempleado';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT idempleado,nombreempleado,apellidoempleado,telefonoempleado,direccionempleado,correoempleado,estadoempleado,usuario,clave,idtipoempleado
                FROM empleado 
                WHERE idempleado = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    { $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE empleado 
                SET nombreempleado=?,apellidoempleado=?,telefonoempleado=?,direccionempleado=?,correoempleado=?,estadoempleado=?,usuario=?,clave=?,idtipoempleado=?
                WHERE idempleado = ?';
        $params = array($this->nombreempleado, $this->apellidoempleado, $this->telefonoempleado,$this->direccionempleado,$this->correoempleado,$this->estadoempleado,$this->usuario,$hash,$this->idtipoempleado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function updatePassword()
    { $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE empleado 
        SET clave=?
        WHERE idempleado = ?';
        $params = array($hash,$this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM empleado
                WHERE idempleado = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

	    public function checkUserD($usuario)
    {
        $sql = 'SELECT idempleado, correoempleado, idtipoempleado, TO_CHAR(fecharegistro + INTERVAL \'90 days\', \'yyyy-mm-dd\' AS dia_contra)
         FROM empleado
        WHERE usuario = ?';
        $params = array($usuario);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['idempleado'];
            $this->correoempleado = $data['correoempleado'];
            $this->idtipoempleado  = $data['idtipoempleado'];
            $this->fecha = $data['dia_contra'];
            $this->usuario = $usuario;
            return true;
        } else {
            return false;
        }
    }

    public function changePasswordD()
    {
        //Se coloca la zona horaria local ya que en esta parte se quiere obtener la hora del servidor
        date_default_timezone_set('America/El_Salvador');
        //Y se obtiene esa fecha para que en el campo se actualice fecharegistro
        $fecha = date('Y-m-d');

        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = 'UPDATE empleado SET clave = ? , fecharegistro = ? WHERE idempleado = 7';
        $params = array($hash, $fecha, $this->id);
        return Database::executeRow($sql, $params);
    }
	
}
