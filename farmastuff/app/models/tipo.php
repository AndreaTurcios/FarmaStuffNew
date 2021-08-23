<?php
/*
*	Clase para manejar la tabla categorias de la base de datos. Es clase hija de Validator.
*/
class Tipo extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $estrellas = null;
    private $nombre = null;
    private $usuario = null;
    private $imagen = null;
    private $descripcion = null;
    private $ruta = '../../../resources/img/categorias/'; 

    /*
    *   Métodos para validar y asignar valores de los atributos.
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

    public function setEstrellas($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->estrellas = $value;
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

    public function setImagen($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->imagen = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }

    public function setDescripcion($value)
    {
        if ($value) {
            if ($this->validateString($value, 1, 250)) {
                $this->descripcion = $value;
                return true;
            } else {
                return false;
            }
        } else {
            $this->descripcion = null;
            return true;
        }
    }

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getEstrellas()
    {
        return $this->estrellas;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    /*
    *   Métodos para realizar las operaciones de busqueda.
    */

    public function readAll()
    {
        $sql = 'SELECT idtipoproducto, tipoproducto, descripciontipo, fototipo
                FROM tipoproducto
                ORDER BY tipoproducto';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT idtipoproducto, tipoproducto, descripciontipo, fototipo
                FROM tipoproducto
                WHERE idtipoproducto = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function searchProductosCategoria($value)
    {
        $sql = 'SELECT tipoproducto,  idproveedorproducto, descripcionproducto , fotoproducto, nombreproducto, descripcionproducto, precioporunidad, idtipoproducto
                FROM productoproveedor
                INNER JOIN productos USING(idproducto)
                INNER JOIN tipoproducto USING(idtipoproducto) 
                WHERE nombreproducto ILIKE ? 
                AND idestadoproducto=1
                ORDER BY nombreproducto';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function readProductosCategoria()
    {
        $sql = 'SELECT tipoproducto,  idproveedorproducto, fotoproducto, nombreproducto, descripcionproducto, precioporunidad, idtipoproducto
                FROM productoproveedor
                INNER JOIN productos USING(idproducto)
                INNER JOIN tipoproducto USING(idtipoproducto) 
                WHERE idtipoproducto=?
                AND idestadoproducto=1
                ORDER BY nombreproducto';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }


    public function readProductosAll()
    {
        $sql = 'SELECT tipoproducto,  idproveedorproducto, fotoproducto, nombreproducto, descripcionproducto, precioporunidad, idtipoproducto
                FROM productoproveedor
                INNER JOIN productos USING(idproducto)
                INNER JOIN tipoproducto USING(idtipoproducto) 
                WHERE idestadoproducto=1
                ORDER BY nombreproducto';
        $params = null;
        return Database::getRows($sql, $params);
    }


    public function createRow1()
    {
        $sql = 'INSERT INTO Valoraciones (estrellas,idcliente ,idproducto)
                VALUES (?,(SELECT idcliente FROM cliente WHERE usuariocliente=?),?)';
        $params = array($this->estrellas,$this->usuario,$this->id);
        return Database::executeRow($sql, $params);
    }

}
