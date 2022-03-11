<?php

    namespace Model;

    class Vendedor extends ActiveRecord{

        protected static $columnasDB= ['id', 'nombre', 'apellido', 'telefono'];
        protected static $tabla= 'vendedores';
        
        public $id;
        public $nombre;
        public $apellido;
        public $telefono;

        public function __construct( $args= []){

            $this->id= $args['id'] ?? null;
            $this->nombre= $args['nombre'] ?? '';
            $this->apellido= $args['apellido'] ?? '';
            $this->telefono= $args['telefono'] ?? '';
        }

        public function validar(){
            if(! $this->nombre) self::$errores[]= "El nombre es requerido";

            if(! $this->apellido) self::$errores[]= "El apellido es requerido";

            if(! $this->telefono) self::$errores[]= "El telefono es requerido";

            if(!preg_match('/[0-9]{10}/', $this->telefono) ) self::$errores[]= "El formato del telefono es incorrecto";

            return self::$errores;
        }
    }

?>