    <main class="contenedor seccion contenido-centrado contenedor_anuncio_1">
        <h1><?php echo $propiedad->titulo; ?></h1>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="<?php echo $propiedad->titulo ?? 'Propiedad'; ?>">

        <div class="resumen-propiedad">

            <p class="precio"><?php echo $propiedad->precio; ?></p>
                    
            <ul class="iconos-caracteristicas ">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
            </ul>
            <p>
                <?php echo $propiedad->descripcion; ?> 
            </p>                

        </div> 
    </main>