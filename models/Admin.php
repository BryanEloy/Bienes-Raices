<?php

    namespace Model;

    class Admin extends ActiveRecord{

        //Base de datos
        protected static $tabla= 'usuarios';    
        protected static $columnasDB= [ 'id', 'email', 'password' ];

        public $id;
        public $email;
        public $password;

        public function __construct($args= [])
        {
            $this->id = $args['id'] ?? null;
            $this->email = $args['email'] ?? '';
            $this->password = $args['password'] ?? '';
        }

        public function validar(){

            if(!$this->email || !$this->password ) self::$errores[]= "Usuario/contraseña obligatorios";

            return self::$errores;
        }

        public function exist(){
            $query= "SELECT * FROM ". self::$tabla. " WHERE email = '". $this->email. "' LIMIT 1";

            $res= self::$db->query($query);

            if(!$res->num_rows){
                self::$errores[]= 'El usuario ingresado no existe';
                return;
            }

            return $res;
        }

        public function comprobarPassword($res){
            $usuario= $res->fetch_object();

            $autenticado= password_verify($this->password, $usuario->password);

            if(!$autenticado) self::$errores[]= 'Contraseña invalida';

            return $autenticado;
        }

        public function autenticar(){

            session_start();

            $_SESSION['usuario']= $this->email;
            $_SESSION['login']= true;

            header('Location: /admin');
        }

    }

?>