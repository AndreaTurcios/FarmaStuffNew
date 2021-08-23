<?php 

class Productos extends Validator{

    private $id = null;
    private $nombre = null;
    private $precio = null;
    private $cantidad = null;
    private $existencia = null;
    private $descripcion = null;
    private $imagen = null;
    private $tipo = null;
    private $estado = null;
    private $proveedor = null;
    private $pais = null;
    private $revision = null;
    private $ruta = '../../../resources/img/productos/';

    private $idcliente = null;
    private $comentario = null;
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdcliente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idcliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombre($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPrecio($value)
    {
        if ($this->validateMoney($value)) {
            $this->precio = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setCantidad($value)
    {
        if ($this->validateString($value, 1, 250)) {
            $this->cantidad = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setExistencia($value)
    {
        if ($this->validateString($value, 1, 250)) {
            $this->existencia = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDescripcion($value)
    {
        if ($this->validateString($value, 1, 250)) {
            $this->descripcion = $value;
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

    public function setTipo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->tipo = $value;
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

    public function setProveedor($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->proveedor = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPais($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->pais = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setRevision($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->revision = $value;
            return true;
        } else {
            return false;
        }
    }

    // public function setIdcliente($value){
    // if ($this->validateNaturalNumber($value)) {
    //     $this->idcliente = $value;
    //     return true;
    // } else {
    //     return false;
    // }
    // }
    
    public function setComentario($value)
    {
        if ($this->validateString($value, 1, 50)) {
            $this->comentario = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getExistencia()
    {
        return $this->existencia;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getImagen()
    {
        return $this->imagen;
    }


    public function getTipo()
    {
        return $this->tipo;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }


    public function getPais()
    {
        return $this->pais;
    }

    public function getRevision()
    {
        return $this->revision;
    }


    public function getRuta()
    {
        return $this->ruta;
    }



    public function searchRows($value)
    {
        $sql = 'SELECT idproducto, nombreproducto, descripcionproducto
                FROM productos pr                                             
                WHERE nombreproducto ILIKE ? OR descripcionproducto ILIKE ?';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO productos (nombreproducto,descripcionproducto )
                VALUES (?, ?)';
        $params = array($this->nombre,$this->descripcion);
        return Database::executeRow($sql, $params);
    }


    public function createRowP()
    {
        $sql = 'INSERT INTO productoproveedor(idproducto,idproveedor,idpais,idestadoproducto,idtipoproducto,existencias,precioporunidad,cantidadporunidad,fotoproducto)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->id,$this->proveedor,$this->pais,$this->estado,$this->tipo,$this->existencia,$this->precio,$this->cantidad,$this->imagen);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT idproducto, nombreproducto, descripcionproducto
                FROM productos pr                                                                
                ORDER BY nombreproducto'; 
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOneShipper()
    {
        $sql = 'SELECT idproveedorproducto,idproducto ,nombreproducto , nombrecompania, representante, pais, existencias, precioporunidad, cantidadporunidad, codigoproducto, fotoproducto
                FROM productoproveedor
                INNER JOIN proveedor USING(idproveedor)
                INNER JOIN pais USING(idpais)
                INNER JOIN productos USING(idproducto)
                WHERE idproducto = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function readOneShipper1()
    {
        $sql = 'SELECT idproveedorproducto,idproducto ,nombreproducto , nombrecompania, representante, pais, existencias, precioporunidad, cantidadporunidad, codigoproducto, idproveedor, idpais, idestadoproducto, idtipoproducto, fotoproducto
                FROM productoproveedor
                INNER JOIN proveedor USING(idproveedor)
                INNER JOIN pais USING(idpais)
                INNER JOIN productos USING(idproducto)
                INNER JOIN estadoproducto USING(idestadoproducto)
                INNER JOIN tipoproducto USING(idtipoproducto)
                WHERE idproveedorproducto = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function readAllShipper()
    {
        $sql = 'SELECT idproveedorproducto,idproducto ,nombreproducto , nombrecompania, representante, pais, existencias, precioporunidad, cantidadporunidad, codigoproducto, fotoproducto
                FROM productoproveedor
                INNER JOIN proveedor USING(idproveedor)
                INNER JOIN pais USING(idpais)
                INNER JOIN productos USING(idproducto)';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function searchOneShipper($value)
    {
        $sql = 'SELECT idproveedorproducto,idproducto, nombreproducto , nombrecompania, representante, pais, existencias, precioporunidad, cantidadporunidad, codigoproducto, fotoproducto
                FROM productoproveedor
                INNER JOIN proveedor USING(idproveedor)
                INNER JOIN pais USING(idpais)
                INNER JOIN productos USING(idproducto)               
                WHERE nombreproducto ILIKE ?';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }
    public function ExistenciaProductos()
    {
        $sql ='SELECT nombreproducto, COUNT(existencias) as cantidad
        From productoproveedor
        Inner join productos USING(idproducto)
        Group by nombreproducto
        order by cantidad desc
        limit 10';
        $params = null;
        return Database::getRows($sql, $params);

    }

    public function readReport()
    {
        $sql = 'SELECT idproducto, nombreproducto, descripcionproducto, nombrecompania, existencias
        FROM productos 
        Inner join productoproveedor USING(idproducto)
        Inner join proveedor USING(idproveedor)
        WHERE idproducto = ?';
         $params = array($this->id);
         return Database::getRows($sql, $params);
    }

    public function readAllRevision()
    {
        $sql = 'SELECT idproveedorproducto, nombreproducto, precioporunidad, existencias, cantidadporunidad, descripcionproducto, fotoproducto, estadoproducto, tipoproducto ,nombrecompania , pais, codigoproducto ,idestadoproducto
                FROM productoproveedor  
                INNER JOIN productos USING(idproducto)
                INNER JOIN estadoproducto USING(idestadoproducto)
                INNER JOIN tipoproducto USING(idtipoproducto)
                INNER JOIN proveedor USING(idproveedor)
                INNER JOIN pais USING(idpais)        
                WHERE idestadoproducto= 2
                ORDER BY nombreproducto';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOneRev()
    {
        $sql = 'SELECT idproveedorproducto, nombreproducto, precioporunidad, existencias, cantidadporunidad, descripcionproducto, fotoproducto, estadoproducto, tipoproducto ,nombrecompania , pais , codigoproducto ,idestadoproducto
                FROM productoproveedor  
                INNER JOIN productos USING(idproducto)
                INNER JOIN estadoproducto USING(idestadoproducto)
                INNER JOIN tipoproducto USING(idtipoproducto)
                INNER JOIN proveedor USING(idproveedor)
                INNER JOIN pais USING(idpais)                
                WHERE idproveedorproducto = ?
                ORDER BY nombreproducto';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function readTipoProducto()
    {
        $sql = 'SELECT tipoproducto, COUNT(idproducto) as Cantidad      
        From productoproveedor
        Inner join tipoproducto USING(idtipoproducto)
        Inner join productos USING(idproducto)
        group by tipoproducto;';
        $params = null;
        return Database::getRows($sql, $params);
    }
    


    public function readAllESTADO()
    {
        $sql = 'SELECT idestadoproducto, estadoproducto
                FROM estadoproducto';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readAllTIPO()
    {
        $sql = 'SELECT idtipoproducto, tipoproducto 
                FROM tipoproducto';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readAllPROVEEDOR()
    {
        $sql = 'SELECT idproveedor, nombrecompania
                FROM proveedor';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readAllPAIS()
    {
        $sql = 'SELECT idpais, pais
                FROM pais';
        $params = null;
        return Database::getRows($sql, $params);
    }


    public function readOne()
    {
        $sql = 'SELECT idproducto, nombreproducto, descripcionproducto                       
                 FROM productos
                WHERE idproducto = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function ReadDetail(){
        $sql='SELECT tipoproducto, idproducto , idproveedorproducto, fotoproducto, nombreproducto, descripcionproducto, precioporunidad, idtipoproducto
                        FROM productoproveedor
                        INNER JOIN productos USING(idproducto)
                        INNER JOIN tipoproducto USING(idtipoproducto) 
                        WHERE idproveedorproducto=?';
        $params = array($this->id);
        return Database::getRow($sql,$params);
    }


    public function updateRow()
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        //($this->imagen) ? $this->deleteFile($this->getRuta(), $current_image) : $this->imagen = $current_image;
        $sql = 'UPDATE productos
                SET    nombreproducto = ?, descripcionproducto = ?
                WHERE idproducto = ?';
        $params = array($this->nombre, $this->descripcion, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function updateRowShipper()
    {        
        $sql = 'UPDATE productoproveedor 
                SET  idpais=?, idtipoproducto=?,precioporunidad=?, cantidadporunidad=? 
                WHERE idproveedorproducto=?';
        $params = array($this->pais, $this->tipo, $this->precio, $this->cantidad,$this->id);
        return Database::executeRow($sql, $params);
    }

    public function updateRev()
    {        
        $sql = 'UPDATE productoproveedor SET idestadoproducto = ?, existencias = ? WHERE idproveedorproducto= ?';
        $params = array($this->estado, $this->existencia, $this->id);
        return Database::executeRow($sql, $params);
    }


    public function deleteRow()
    {
        $sql = 'DELETE FROM productos
                WHERE idproducto = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }


    Public function Comentarios()
    {
        $sql = 'SELECT idcliente FROM detalleorden
        INNER JOIN orden USING (idorden)
        WHERE idproveedorproducto = ? AND idcliente = ?';
        $params = array($this->id, $_SESSION['idcliente']);
        if ($data=Database::getRow($sql, $params))
        {
            $this->idcliente=$data['idcliente']; 
            return true;
        }else{ 
            return false;
        }
        
    }
    public function createComentarios(){ 
        $sql='INSERT INTO valoraciones(comentario,idCliente,idproducto)
        VALUES(?,?,?)';
         $params=array($this->comentario,$_SESSION['idcliente'],$this->id);
         return Database::executeRow($sql,$params);
    }
   


}