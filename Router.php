<?php
    namespace MVC;

    class  Router{

        public $rutasGET= [];
        public $rutasPOST= [];

        public function get($url, $fn){
            $this->rutasGET[$url]= $fn;
        }

        public function post($url, $fn){
            $this->rutasPOST[$url]= $fn;
        }

        public function comprobarRutas(){

            //Verificar que el usuario este logueado
            session_start();
            $auth= $_SESSION['login'] ?? null;
            //Arreglo para proteger las rutas
            $rutas_protegidas= ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar',
                                '/vendedores/crear', '/vendedores/crear', '/vendedores/crear' ];

            $urlActual= $_SERVER['REQUEST_URI'] === '' 
                                                ? '/' 
                                                : $_SERVER['REQUEST_URI']; 
            $metodo= $_SERVER['REQUEST_METHOD'];

            if( $metodo === 'GET' ){
               $fn= $this->rutasGET[$urlActual] ?? null;

            }else $fn= $this->rutasPOST[$urlActual] ?? null; 

            //Proteger las rutas
            if( in_array($urlActual, $rutas_protegidas) && !$auth ) header('Location: /');

            if($fn){
                call_user_func($fn, $this);
            }
            else echo "Pagina no encontrada";
        }

        //Muestra una vista
        public function render($view, $datos=[] ){

            //Iteramos en los datos para guardarlos en variables
            foreach($datos as $key=> $value){
                $$key= $value;
            }

            //Iniciamos el almacenamiento en memoria
            ob_start();
            //Incluimos la vista en el almacenamiento
            include __DIR__ . "/views/$view.php";
            //Limpeamos el almacenamiento y lo guardamos en contenido
            $contenido= ob_get_clean();
            //Incluimos el contenido en el layout
            include __DIR__ . "/views/layout.php";
        }
    }
?>