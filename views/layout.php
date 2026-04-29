<?php 
if(!isset($_SESSION)){
    session_start();
}
$auth = $_SESSION['login'] ?? false;

if(!isset($inicio)){
    $inicio = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>

    <header class="header <?php echo $inicio ? 'inicio' : '' ;?>">
        <div class="contenedor contenido-header">
            <div class="barra">

                <img class="img-logo" src="/build/img/logo.svg" alt=" Logo de Bienes Raices">
                
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Boton Dark Mode">
                    <nav class="navegacion">
                        <a href="/">Inicio</a>
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth) : ?>
                            <a href="/logout">Cerrar Secion</a>
                        <?php endif; ?>
                    </nav>
                    
                </div>
            </div> <!-- .barra -->

            <?php 
                if($inicio){
                    echo "<h1>Ventas de Casas y Departamentos de Lujo </h1>";
                }
            ?>

        </div>
    </header>


        <?php echo $contenido;   ?>



    
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
                <nav class="navegacion">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/propiedades">Anuncios</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                </nav>
        </div>
        <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?>&copy; <br> Miguel Abreu
        </p>

    </footer>

    <script src="../build/js/bundle.min.js"></script>
</body>
</html>