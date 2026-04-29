<?php

namespace Controllers;
use MVC\Router;
// use Model\Propiedad;
use Model\Vendedor ;
// use Intervention\Image\Drivers\Gd\Driver;
// use Intervention\Image\ImageManager as Image;

class VendedoresController {
    public static function crear(Router $router) {

        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //crear una nueva instancia
        $vendedor = new Vendedor($_POST['vendedor']);
    //validar que no haya campos vacios
        $errores = $vendedor->validar();
    //revisar que el arreglo de errores este vacio
        if(empty($errores)){
            $vendedor->guardar();
        }
    }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }
    public static function actualizar(Router $router) {
        
        $errores = Vendedor::getErrores();              //validar que sea un id valido
        $id = validarORedireccionar('/admin');          //obtener los datos del vendedor

        $vendedor = Vendedor::find($id);        //ejecutar el codigo despues de que el usuario envia el formulario  

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //asignar los atributos
        $args = $_POST['vendedor'];
        $args['id'] = $id;

        //sincronizar objeto en memoria con lo que el usuario escribio
        $vendedor->sincronizar($args);
                
    //validacion
        $errores = $vendedor->validar();

    //revisar que el arreglo de errores este vacio
        if(empty($errores)){
            $vendedor->guardar();
        }
    }


        $router->render('vendedores/actualizar',[
            'errores' => $errores,
            'vendedor' => $vendedor


        ]);

    }    
    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['id'];                              //validar que sea un id valido
            $id = filter_var($id, FILTER_VALIDATE_INT);     

            if($id){
                $tipo = $_POST['tipo'];                     //validar el tipo de contenido
                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);            //buscar el registro a eliminar
                    $vendedor->eliminar();                      //eliminar el registro
                }
            }
        }

    }
}