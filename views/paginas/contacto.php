    <main class="contenedor seccion">
        <h2 data-cy="contacto-header">Contacto</h2>

        <?php
            if($mensaje){?>
                <p class='alerta exito'> <?php echo $mensaje ?>  </p>;
            <?php } ?>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
        </picture>

        <h2 data-cy="formContacto-header">Llene el Formulario de Contacto</h2>

        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion personal</legend>

                <label for="nombre">Nombre </label>
                <input data-cy="input-nombre" type="text" id="nombre" placeholder="Tu Nombre" name="contacto[nombre]" required>
                <label for="mensaje">Mensaje </label>
                <textarea data-cy="input-mensaje" id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propied</legend>
                <label for="opciones">Vende o Compra</label>
                <select data-cy="input-opciones" id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>--Seleccione--</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto</label>
                <input data-cy="input-precio" type="number" id="presupuesto" placeholder="$$" name="contacto[precio]" required>
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser contactado?</p>
                <div class="form-contacto">
                    <label for="contactar-tel">Telefono</label>
                    <input type="radio" value="telefono" id="contactar-tel" name="contacto[contacto]" required>

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
                </div>

                <div id="contacto"></div>
                
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>
