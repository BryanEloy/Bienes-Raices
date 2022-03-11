<?php

    namespace Model;

    class ActiveRecord{
        protected static $db;
        protected static $columnasDB= [];
        protected static $tabla= '';
        //Errores
        protected static $errores= [];       

        public static function setDB($DB){
            self::$db = $DB;
        }

        //Guarda la informacion en la DB
        public function guardar(){
            if( !is_null($this->id) ){
                //Actualizar en case de existir un id de propieadad
                return $this->actualizar();
            }else{
                //Crear nuevo registro
                return $this->crear();
            }
        }

        //cREA UN NUEVO REGISTRO
        public function crear(){

            $atributos= $this->sanitizar();
            
            //Crear el query para la insercion
            $query="INSERT INTO ". static::$tabla ." (";
            $query .= join(', ', array_keys($atributos) );
            $query .= " ) VALUES ( '";
            $query .= join("', '", array_values($atributos) );
            $query .= " ') ";

            //Insertar en base de datos
            $res= self::$db->query($query);
            return $res;
        }

        //Actualiza un registro
        public function actualizar(){
            $atributos= $this->sanitizar();

            $valores=[];
            foreach( $atributos as $key=> $value){
                $valores[]= "{$key}='${value}'";
            }

            $query= "UPDATE ". static::$tabla. " SET ";
            $query .= join(', ', $valores);
            $query .= " WHERE id= '". self::$db->escape_string($this->id). "' "; 
            $query .= " LIMIT 1 ";

            //Actualizar en base de datos
            $res= self::$db->query($query);
            return $res;
        }

        //Elimina un registro
        public function eliminar(){
            //Eliminar informacion de la base de datos
            $query= "DELETE FROM ". static::$tabla. " WHERE id = ".self::$db->escape_string($this->id)." LIMIT 1";
            $res= self::$db->query($query);

            if($res ) $this->eliminarImagen();   
            return $res;
        }

        //Retorna un arrgelo con la infromacion que se guardara
        public function atributos(){
            $atributos= [];
            foreach(static::$columnasDB as $columna){
                if($columna === 'id') continue;
                $atributos[$columna]= $this->$columna;
            }
            return $atributos;
        }

        //Sanitiza los datos que se insertaran en la base de datos
        public function sanitizar(){
            $atributos= $this->atributos();
            $sanitizado= [];

            foreach( $atributos as $key=> $value){
                $sanitizado[$key]= self::$db->escape_string($value);
            }

            return $sanitizado;
        }

        //Subir la imagen al server
        public function setImagen($imagen){
            //EN caso de estar editando y existir una imagen previa la elimina
            if( !is_null($this->id) ){
                $this->eliminarImagen();
            }

            if($imagen) $this->imagen= $imagen;
        }

        //Eliminar la imagen subida al server
        public function eliminarImagen(){
            if(isset($this->imagen)){
                if( file_exists(CARPETA_IMAGENES. $this->imagen) ){
                    unlink(CARPETA_IMAGENES. $this->imagen);
                }  
            }
            
        }

        //Retorna los errores 
        public static function getErrores(){
            return static::$errores;
        }

        //Validar la informacion
        public function validar(){
            static::$errores= [];
            return static::$errores;
        }

        //Lista todas  las propiedades
        public static function getAll(){
            //Escribir el query
            $query= "SELECT * FROM ". static::$tabla;

            $res= self::consultarDB($query);
            return $res;
        }

        //Obtine una cantidad determinada de registros
        public static function get($cantidad){
            $query= "SELECT * FROM ". static::$tabla. " LIMIT ".$cantidad;
            $res= self::consultarDB($query);
            return $res;
        }

        //Busca un registro especifico
        public static function find($id){
            //Consultar datos de la propiedad
            $query= "SELECT * FROM ". static::$tabla. " WHERE id= ${id}";
            
            $res= self::consultarDB($query);

            return array_shift( $res );
        }

        public static function consultarDB($query){
            //Consultar la BD
            $res= self::$db->query($query);

            //Iterar en los resultados
            $array= [];
            while($registro = $res->fetch_assoc() ){
                $array[]= static::crearObjeto($registro);
            } 

            //Liberar memoria
            $res->free();

            //Retorna los resultados
            return $array;
        }   
    
        //Crea un objeto con los valores de un arreglo
        public static function crearObjeto($registro){
            //Crea una copia de la clase con el constructor
            $objeto= new static;

            foreach($registro as $key=> $value){
                if(property_exists( $objeto, $key ) ){
                    $objeto->$key= $value;
                }
            }
            return $objeto;
        }

        public function sincronizar($args=[]){
            foreach( $args as $key=> $value){
                if( property_exists( $this, $key) && !is_null($value) ){
                  $this->$key= $value;  
                } 
            }
            
        }
    }
?>