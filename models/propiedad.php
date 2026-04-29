<?php

namespace Model;

class propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';
    protected static $columnasDB =['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones',
                                'wc', 'estacionamiento', 'creado', 'vendedores_id'  ];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento; 
    public $creado;
    public $vendedores_id;


    public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->titulo = $args['titulo'] ?? '';
            $this->precio = $args['precio'] ?? '';
            $this->imagen = $args['imagen'] ?? '';
            $this->descripcion = $args['descripcion'] ?? '';
            $this->habitaciones = $args['habitaciones'] ?? '';
            $this->wc = $args['wc'] ?? '';
            $this->estacionamiento = $args['estacionamiento'] ?? '';
            $this->creado = date('Y/m/d');
            $this->vendedores_id = $args['vendedores_id'] ?? '';
        }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        }
        
        if(!$this->imagen ) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }

        if( strlen($this->descripcion) < 50 ){
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$this->habitaciones){
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }

        if(!$this->wc){
            self::$errores[] = "El numero de baños es obligatorio";
        }

        if(!$this->estacionamiento){
            self::$errores[] = "El numero de estacionamientos es obligatorio";
        }

        if(!$this->vendedores_id){
            self::$errores[] = "Elige un vendedor";
        }

        return self::$errores;
    }


}