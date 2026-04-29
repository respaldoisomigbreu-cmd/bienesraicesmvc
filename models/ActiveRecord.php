<?php

namespace Model;

/**
 * @property int $id
 * @property string $titulo
 * @property string $precio
 * @property string $imagen
 * @property string $descripcion
 * @property int $habitaciones
 * @property int $wc
 * @property int $estacionamiento
 * @property string $creado
 * @property int $vendedores_id
 */


class ActiveRecord {

       // Base de Dato
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];


    //errores
    protected static $errores = [];

        //definir la conexion a la base de datos
    public static function setDB($database) {
        self::$db = $database;
    }



    public function guardar(){
        if(!is_null($this->id)){
            //actualizar
            $this->actualizar();
        } else {
            //crear un nuevo registro
            $this->crear();
        }
    }

    public function crear() {

        //sanitizar los datos
            $atributos = $this->sanitizarAtributos();

            $query = " INSERT INTO " . static::$tabla . " ( ";
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES ('";
            $query .= join("', '", array_values($atributos));
            $query .= "') ";

        $resultado = self::$db->query($query);
        
        if($resultado){
                // redericcionar Usuario
            header('location: /admin?resultado=1');
        }
        // return $resultado;

    }
    public function actualizar(){
        //sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }

        $query = " UPDATE " .static::$tabla. " SET ";
        $query .= join(', ', $valores);                
        $query .= " WHERE id = '" .self::$db->escape_string($this->id). "' ";
        $query .=" LIMIT 1 ";

        $resultado = self::$db->query($query);
        
        if($resultado){
            //redericcionar Usuario
            header('location: /admin?resultado=2');
            }

        }

    public function eliminar(){
        $query = "DELETE FROM " . static::$tabla . " WHERE id = ". self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        
            if($resultado){
                $this->borrarImagen();
                header('location: /admin?resultado=3');
            }
    }

        // este va a iterar sobre cada atributo de la DB...
        //identificando y uniendo los datos..
    public function atributos(){
        $atributos = [];
        foreach( static::$columnasDB as $columna){
            if($columna === 'id' ) continue;
            $atributos[$columna] = $this->$columna;

        }
        return $atributos;

    }

        // ca a zanitizar da uno de los atributos.
    public function sanitizarAtributos(){
        $atributos = $this->atributos(); 
        $sanitizado = [];

        foreach ($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
    
    return $sanitizado;

    }

        //validacion
    public static function getErrores() {
        return static::$errores;
    }

    public function validar(){
        static::$errores = [];
        return static::$errores;
    }

    
    public function setImagen($imagen){
    // elimina la imagen previa
    if(!is_null($this->id) ){
        //comprobar si el archivo exixte
        $this->borrarImagen();
    }
    //asigna al atributode imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }
    public function borrarImagen(){

        //comprobar si el archivo exixte
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }


    //listar todas las registros..
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;

        $resultado =self::consultaSQL($query);
        
        return $resultado;
    }

    //obtiene determinado numero de registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado =self::consultaSQL($query);
        
        return $resultado;
    }


    //buscar un registro por id
    public static function find($id){
        $query = "SELECT * FROM ". static::$tabla . " WHERE id = $id";

        $resultado = self::consultaSQL($query);

        return array_shift($resultado);
    }


    public static function consultaSQL($query){
    // consultar la base de datos
    $resultado = self::$db->query($query);

    // iterar los resultados
    $array = [];
    while ($registro = $resultado->fetch_assoc()){
            $array [] = static::crearObjeto($registro);
            
    }
    //liberar la memoria
    $resultado->free();

    //retornar los resultados.
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;

    }

    //sincroniza el objeto en memoria con los cambios realizado por el usuario
    public function sincronizar( $args = [] ){
        foreach ($args as $key =>$value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }

}
