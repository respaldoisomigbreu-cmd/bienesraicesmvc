<main class="contenedor seccion">
        <h2>Actualizar Vendedor(a)</h2>

        <a href="/admin" class="boton boton-verde"> Volver</a>

        <?php foreach ($errores as $error): ?>
        
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST"  >

            <?php include 'formulario.php' ?>

            <input type="submit" value="Guardar Cambios" class="boton boton-verde">

        </form>

    </main>