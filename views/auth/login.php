    <main class="contenedor seccion contenido-centrado">
        <h1 data-cy="login-header">Iniciar Sesion</h1>

        <?php foreach($errores as $error): ?>
            <div data-cy="login-alerta" class="alerta error">  
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>

        <form data-cy="login-form" class="formulario" method="POST" action="/login">

            <fieldset>
                <legend>Email y contraseñ</legend>

                <label for="email">E-mail </label>
                <input type="mail" name="email" id="email" placeholder="Tu E-mail" >
                <label for="password">Password </label>
                <input type="password" name="password" id="password">

            </fieldset>

            <input type="submit" value="Login" class="boton boton-verde">
        </form>
    </main>