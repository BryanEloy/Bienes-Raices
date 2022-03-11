        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="propiedad[titulo]" value="<?php echo sanitizar( $propiedad->titulo); ?>" placeholder="Titulo Propiedad">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="propiedad[precio]"value="<?php echo $propiedad->precio; ?>" placeholder="$$">

            <label for="imagen">Imagen:</label>
            <input type="file"  id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="propiedad[descripcion]" ><?php echo sanitizar($propiedad->descripcion); ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion de lapropiedad</legend>

            <label for="habitaciones">Num. de habitaciones:</label>
            <input type="number" id="habitaciones" name="propiedad[habitaciones]" value="<?php echo $propiedad->habitaciones; ?>" placeholder="1" min="1">

            <label for="wc">Baños:</label>
            <input type="number" name="propiedad[wc]" id="wc" placeholder="1" value="<?php echo $propiedad->wc; ?>" min="1">

            <label for="estacionamiento">Estacionamientos:</label>
            <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" value="<?php echo $propiedad->estacionamiento; ?>" min="0">
        </fieldset>

        <fieldset>
            <legend>Vendedor:</legend>

            <select name="propiedad[vendedorId]" id="vendedor" >
                <option selected value="">--Seleccionar--</option>

                <?php foreach($vendedores as $vendedor) {?>; 
                    <option <?php echo $propiedad->vendedorId=== $vendedor->id ? 'selected ' : ''; ?>
                             value="<?php echo sanitizar($vendedor->id) ?>" > 
                        <?php echo sanitizar($vendedor->nombre). " ". sanitizar($vendedor->apellido) ?>
                    </option>
                <?php } ?>

            </select>

        </fieldset>