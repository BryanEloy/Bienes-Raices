<?php

define('TEMPLATES_URL',__DIR__.'/templates');
define('FUNCIONES_URL',__DIR__.'funciones.php');  
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT']. '/imagenes/');  


function incluirTemplate( string $nombre, $inicio=false ){
    include TEMPLATES_URL."/${nombre}.php";
}

//Sanitizar entradas
function sanitizar($entrada){
    $res= htmlspecialchars($entrada);
    return $res;
}

//Validar contenido
function validarContenido($tipo){
    $tipos= ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

function mostrarNotificacion($alerta){
    $mensaje='';

    switch($alerta){
        case 1:
            $mensaje= 'Creado correctamente';
        break;
        case 2:
            $mensaje= 'Actualizado correctamente';
        break;
        case 3:
            $mensaje= 'Eliminado correctamente';
        break;

        default:
            $mensaje= false;
            break;
    }
    return $mensaje;
}