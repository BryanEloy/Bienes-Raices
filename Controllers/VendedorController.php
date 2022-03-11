<?php

    namespace Controllers;

    use MVC\Router;
    use Model\Vendedor;

    class VendedorController{

        public static function crear(Router $router){
            
            $errores= Vendedor::getErrores();
            $vendedor= new Vendedor();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                //Crear instancia de vendedor
                $vendedor= new Vendedor( $_POST['vendedor'] );
                //Validar que no haya campos vacios
                $errores= $vendedor->validar();
        
                if(empty($errores) ){
                    $res= $vendedor->guardar();
                    if($res) header('Location: /admin?res=1');
                }
            }

            $router->render('vendedores/crear', [
                'vendedor' => $vendedor,
                'errores' => $errores
            ]);
        }

        public static function actualizar(Router $router){

            $id= $_GET['id'];
            $id= filter_var($id, FILTER_VALIDATE_INT);
            //Validar el id
            if(!$id) header('Location: /admin');

            $errores= Vendedor::getErrores();
            $vendedor= Vendedor::find($id);

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                //Asignar las entradas a los atributos de propiedad
                $args= $_POST['vendedor'];
                $vendedor->sincronizar($args);
        
                $errores= $vendedor->validar;
                 //Comprobar que no existan errores
                 if( empty($errores) ){
        
                    //Actualizar en la base de datos
                    $result= $vendedor->guardar();
                    if($result) header('Location: /admin?res=2');
                }
            }

            $router->render('vendedores/actualizar', [
                'vendedor' => $vendedor,
                'errores' => $errores
            ]);
        }

        public static function eliminar(){

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                $id= $_POST['id'];
                $id= filter_var($id, FILTER_VALIDATE_INT);
                //Validar el id
                if(!$id) header('Location: /admin');

                //vALIDAR CONTENIDO A ELIMINAR
                $tipo= $_POST['tipo'];

                if( validarContenido($tipo) ){
                    $vendedor= Vendedor::find($id);
                    $res= $vendedor->eliminar(); 

                    if($res){
                       header('Location: /admin?res=3'); 
                    }else echo "Este vendedor no se puede eliminar por qu etoiene propiedades agregadas";
                }

            }
        }

    }

?>