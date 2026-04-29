<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor ;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;



class PropiedadControllers {
    public static function index(Router $router) {

    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();
    $resultado = $_GET['resultado'] ?? null;         //muestra mensaje condicional

        $router->render('propiedades/admin',[
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router) {

        $propiedad = new Propiedad();           //instancia vacia para el formulario
        $vendedores = Vendedor::all();          //consultar para obtener los vendedores
        $errores = Propiedad::getErrores();     //arreglos con mensajes de errores


    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        // crear una vueva instancia
        $propiedad = new Propiedad($_POST['propiedad']);


        //generar nombre unico a las imagnes
        $nombreImagen = md5( uniqid( rand(), true ) ). ".jpg";
        
        //setear la imagen
        //realizar un resize a la imagen con intervencion...
        if($_FILES['propiedad']['tmp_name']['imagen']){

            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);

            // $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600); 
            $propiedad-> setImagen($nombreImagen);

        }
        $errores = $propiedad->validar();

        if(empty($errores)){
            /**SUBIDA DE ARCHIVOS */
            // crear carpeta

            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }

            //guardar imagen en el servidor
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);

        $propiedad->guardar();

        }

    }
        
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        
    $id =validarORedireccionar('/admin');

    $propiedad = Propiedad::find($id);           //consultar pára obtener la propieda mediante el ID
    $vendedores = Vendedor::all();              //consultar para obtener los vendedores 
    $errores = Propiedad::getErrores();     //arreglos con mensajes de errores

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //asignar atributos
    $args = $_POST['propiedad'];


    $propiedad->sincronizar($args);

    //validacion
    $errores = $propiedad->validar();

    //generar nombre unico a las imagnes
    $nombreImagen = md5( uniqid( rand(), true ) ). ".jpg";

    //subida de archivos
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
            $propiedad->setImagen($nombreImagen);

        }
        if(empty($errores)){
            //almacenar imagen
            if($_FILES['propiedad']['tmp_name']['imagen']){

                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }

            $propiedad->guardar();
        }
    }


    $router->render('propiedades/actualizar', [
        'propiedad' => $propiedad,
        'vendedores' => $vendedores,
        'errores' => $errores
    ]);
    }


    public static function eliminar() {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $id = $_POST['id'];
        $id =filter_var($id, FILTER_VALIDATE_INT);
            
            if($id){            //valida el tipo de contenido que se va a eliminar
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
                
            }
        }
    }
}