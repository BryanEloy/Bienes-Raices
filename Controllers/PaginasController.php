<?php

    namespace Controllers;

    use MVC\Router;
    use Model\Propiedad;
    use PHPMailer\PHPMailer\PHPMailer;


    class PaginasController{

        public static function index(Router $router){

            $propiedades= Propiedad::getAll();

            $router->render('paginas/index', [
                'propiedades'=> $propiedades,
                'inicio'=> true
            ]);
        }

        public static function nosotros(Router $router){
            
            $router->render('paginas/nosotros' );
        }

        public static function propiedades(Router $router){

            $propiedades= Propiedad::getAll();
            $router->render('paginas/propiedades', [
                'propiedades'=> $propiedades,
            ]);
        }

        public static function propiedad(Router $router){

            //Validar el id de la url
            $id= $_GET['id'];
            $id= filter_var($id, FILTER_VALIDATE_INT);
            if(!$id) header('Location: /admin');

            $propiedad= Propiedad::find($id);

            $router->render('paginas/propiedad', [
                'propiedad'=> $propiedad,
            ]);
        }

        public static function blog(Router $router){
            $router->render('paginas/blog' );
        }

        public static function entrada(Router $router){
            $router->render('paginas/entrada' );
        }
        
        public static function contacto(Router $router){
            $alerta= null;
            if( $_SERVER['REQUEST_METHOD'] === 'POST'){

                $msg= $_POST['contacto'];

                $mail= new PHPMailer();

                //Configurar SMTP
                $mail->isSMTP();
                $mail->Host= 'smtp.mailtrap.io';
                $mail->SMTPAuth= true;
                $mail->Username= '5f26ea295a49b5';
                $mail->Password= '59529446216113';
                $mail->SMTPSecure= 'tls';
                $mail->Port= 2525;

                //Configurar la informacion del mail
                $mail->setFrom('admin@admin.com');
                $mail->addAddress('admin@admin.com', 'BienesRaices');
                $mail->Subject= 'Tienes un Nuevo';

                //Habilitar HTML
                $mail->isHTML(true);
                $mail->CharSet= 'UTF-8';

                //Definir el contenido
                $contenido = '<html>';
                $contenido .= '<p>Tienes un nuevo Mensaje</p>';
                $contenido .= '<p>Nombre: '. $msg['nombre']. '</p>';

                if($msg['contacto'] === 'telefono'){
                    $contenido .= 'Elijio ser contactado via telefonica';
                    $contenido .= '<p>Telefono: '. $msg['telefono']. '</p>';
                    $contenido .= '<p>Fecha: '. $msg['fecha']. '</p>';
                    $contenido .= '<p>Hora: '. $msg['hora']. '</p>';
                }else{
                    $contenido .= 'Elijio ser contactado via email';
                    $contenido .= '<p>Email: '. $msg['email']. '</p>';
                }

                $contenido .= '<p>Mensaje: '. $msg['mensaje']. '</p>';
                $contenido .= '<p>Vende o Compra: '. $msg['tipo']. '</p>';
                $contenido .= '<p>Precio o Presupuesto: $'. $msg['precio']. '</p>';
                $contenido .= '</html>';

                $mail->Body= $contenido;
                $mail->AltBody= 'Esto es un texto alternativo';

                //Enviar el mail
                if( $mail->send() ){
                    $alerta= "Mensaje enviado Correctamente";

                }else {$alerta= "No se pudpo enviar el mensaje"; }
            }

            $router->render('paginas/contacto',[
                'mensaje'=> $alerta
            ] );
        }

    }

?>