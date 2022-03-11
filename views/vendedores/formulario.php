<fieldset>

    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" value="<?php echo sanitizar( $vendedor->nombre); ?>" placeholder="Nombre Vendedor(a)">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" value="<?php echo sanitizar( $vendedor->apellido); ?>" placeholder="Apellido">

</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>

    <label for="telefono">Telefono:</label>
    <input type="number" id="telefono" name="vendedor[telefono]" value="<?php echo sanitizar( $vendedor->telefono); ?>" placeholder="Telefono">

</fieldset>