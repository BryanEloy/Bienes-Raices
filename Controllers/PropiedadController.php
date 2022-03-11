<?php

    namespace Controllers;

    use MVC\Router;
    use Model\Propiedad;
    use Model\Vendedor;
    use Intervention\Image\ImageManagerStatic as image;

    class PropiedadController {

        public static function index(Router $router){

            $propiedades= Propiedad::getAll();
            $vendedores= Vendedor::getAll();
            //mUESTRA MENSAJE CONDICIONAL
            $success= $_GET['res'] ?? null;

            $router->render("propiedades/admin",[
                'propiedades' => $propiedades,
                'success' => $success,
                'vendedores' => $vendedores
            ]);
        }

        public static function crear(Router $router){

            $vendedores= Vendedor::getAll();
            $errores= Propiedad::getErrores();
            $propiedad= new Propiedad;

            if( $_SERVER['REQUEST_METHOD']==='POST'){

                //Instancear una Propiedad
                $propiedad= new Propiedad($_POST['propiedad']);

                //Generar un id unico
                $nameImg= md5( uniqid( rand(), true ) ).".jpg";

                //Realiza un resize de la imagen
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image= Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $propiedad->setImagen($nameImg);
                }
        
                $errores= $propiedad->validar();

                //Comprobar que no existan errores
                if( empty($errores) ){
                
                    //Crrear la carpeta en el server
                    if( !is_dir(CARPETA_IMAGENES) ) mkdir(CARPETA_IMAGENES);
                    //Subir la imagen al server
                    $image->save(CARPETA_IMAGENES.$nameImg);
                    //Gaurdar en la base de datso
                    $res= $propiedad->guardar();

                    if($res) header('Location: /admin?res=1');
                    
                }
            }

            $router->render("propiedades/crear",[
                'propiedad'=> $propiedad,
                'vendedores'=> $vendedores,
                'errores'=> $errores
            ]);
        }

        public static function actualizar(Router $router){
            //Validar el id de la url
            $id= $_GET['id'];
            $id= filter_var($id, FILTER_VALIDATE_INT);

            if(!$id) header('Location: /admin');
            
            $vendedores= Vendedor::getAll();
            $errores= Propiedad::getErrores();
            $propiedad= Propiedad::find($id);

            //Metodo post para actualizar
            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                //Asignar las entradas a los atributos de propiedad
                $args= $_POST['propiedad'];
                $propiedad->sincronizar($args);
        
                //Generar un id unico para la imagen
                $nameImg= md5( uniqid( rand(), true ) ).".jpg";
                //Validacion subida de archivos
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image= Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $propiedad->setImagen($nameImg);
                    $image->save(CARPETA_IMAGENES.$nameImg);
                }
        
                $errores= $propiedad->validar();
        
                //Comprobar que no existan errores
                if( empty($errores) ){
        
                    //Actualizar en la base de datos
                    $result= $propiedad->guardar();
                    if($result) header('Location: /admin?res=2');
                }
            }

            //Metodo get para mostrar vista
            $router->render('/propiedades/actualizar', [
                'propiedad'=>$propiedad,
                'vendedores'=> $vendedores,
                'errores'=> $errores
            ]);
        }

        public static function eliminar(){

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                //Validar el id
                $id= $_POST['id'];
                $id= filter_var($id, FILTER_VALIDATE_INT);
        
                if($id){
                    $tipo= $_POST['tipo'];
                    //Validar el registro 
                    if( validarContenido($tipo) ){
                            $propiedad= Propiedad::find($id);
                            $res= $propiedad->eliminar();
                            if($res) header('location: /admin?res=3');
                    }
                        
                }    
            }
        }
    }
?>