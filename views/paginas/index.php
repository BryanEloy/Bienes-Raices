    <main class="contenedor seccion">
        <h2 data-cy="header-nosotros">Mas sobre nosotros</h2>

        <?php include 'iconos.php'; ?>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en venta</h2> 
        <?php
            include 'listado.php'; 
        ?>
        <div class="ver-todas">
            <a class="boton-verde" href="/propiedades" data-cy="propiedad-todas">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto" data-cy="imagen-contacto">
        <h2>Encuentra la Casa de tus Sueños</h2>
        <p>Ingresa tu informacion de contacto para recibir atencion de un asesor</p>
        <a href="/contacto" class="boton-amarillo">Contacto</a>
    </section>

    <div class="contenedor seccion seccion-inferior">   
        <section class="blog" data-cy="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>14/02/2022</span> por: <span>Admin</span> </p>
                        <p>Consejos para construir una terraza en tu casa</p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guia para ñla decoracion de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>14/02/2022</span> por: <span>Admin</span> </p>
                        <p>Maximiza el espacio de tu hogar con estilo</p>
                    </a>
                </div>
            </article>

        </section>

        <section class="testimoniales" data-cy="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus suscipit consequatur doloremque alias enim obcaecati in neque dicta quas exercitationem, ullam, saepe ipsa eum dolorem fugit amet autem omnis itaque!
                </blockquote>
                <p>- Algun sujeto</p>
            </div>
        </section>
    </div>