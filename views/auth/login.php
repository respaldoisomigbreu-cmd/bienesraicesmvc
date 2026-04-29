    <main class="contenedor seccion contenido-centrado">
        <h2>Iniciar Sesión</h2>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>

            </div>

        <?php endforeach; ?>
        <form method="POST" class="formulario" action="/login">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu E-mail" id="email" require>

                <label for="password">Pasaword</label>
                <input type="password" name="password" placeholder="Tu password" id="password" require>

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>