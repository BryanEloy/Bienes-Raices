<?php 
    //Verificar si hay una sesion activa
    if( !isset($_SESSION) ) session_start();
    $auth= $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>

    <header class="header <?php echo $inicio ?'inicio' :''?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logo empresa">
                </a>
                
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>
                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" class="dark-mode-boton">
                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth): ?>
                            <a href="logout.php">Cerrar Sesion</a>
                        <?php endif; ?>
                    </nav>   
                </div>
                
            </div>
            <?php if($inicio) echo "<h1>Venta de Casas y Departamentos Exclusivos de lujo</h1>" ?>
        </div>
    </header>