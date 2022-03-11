<?php

    namespace Model;

    class Propiedad extends ActiveRecord{

        protected static $columnasDB= ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
        protected static $tabla= 'propiedades';     
        
        public $id;
        public $titulo;
        public $precio;
        public $imagen;
        public $descripcion;
        public $habitaciones;
        public $wc;
        public $estacionamiento;
        public $creado;
        public $vendedorId; 

        public function __construct( $args= []){

            $this->id= $args['id'] ?? null;
            $this->titulo= $args['titulo'] ?? '';
            $this->precio= $args['precio'] ?? '';
            $this->imagen= $args['imagen'] ?? '';
            $this->descripcion= $args['descripcion'] ?? '';
            $this->habitaciones= $args['habitaciones'] ?? '';
            $this->wc= $args['wc'] ?? '';
            $this->estacionamiento= $args['estacionamiento'] ?? '';
            $this->creado= date('Y/m/d');
            $this->vendedorId= $args['vendedorId'] ?? '';
        }

        //Validar la informacion
        public function validar(){

            //Validar que los campos tengan informacion
           if(! $this->titulo) self::$errores[]= "El titulo es requerido";

           if(! $this->precio) self::$errores[]= "El precio es requerido";

           if( strlen( $this->descripcion)<25) self::$errores[]= "La descripcion debe tener al menos 25 caracteres";

           if(! $this->habitaciones) self::$errores[]= "El numero de habitaciones es requerido";

           if(! $this->estacionamiento) self::$errores[]= "El numero de estacionamentos es requerido";

           if(! $this->wc) self::$errores[]= "El numero de bañoes es requerido";

           if(! $this->vendedorId) self::$errores[]= "El vendedor de la propiedad es requerido";
           
           if(! $this->imagen) self::$errores[]= "Imagen obligatoria";

           return self::$errores;
       }

    }

?>