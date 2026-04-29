<div class="contenedor-anuncios">

    <?php foreach( $propiedades as $propriedad) { ?>
    <div class="anuncio">
            <img class="anuncio_img" loading="lazy" src="/imagenes/<?php echo $propriedad->imagen; ?>" alt="anuncio">

        <div class="contenido-anuncio">
            <h3><?php echo $propriedad->titulo; ?></h3>
            <p class="anuncio_p"><?php echo $propriedad->descripcion; ?></p>
            <p class="precio"><?php echo $propriedad->precio; ?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propriedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propriedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propriedad->habitaciones; ?></p>
            </li>
        </ul>

            <a href="/propiedad?id=<?php echo $propriedad->id; ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div><!--.contenido-anuncio-->
    </div><!--anuncio-->

    <?php } ?>
</div> <!--.contenedor-anuncios-->



