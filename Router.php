<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }    
    
    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }
    
    public function comprobarRutas() {
    session_start();
    $auth = $_SESSION['login'] ?? null;

    $rutasProtegidas = [
        '/admin',
        '/propiedades/crear', 
        '/propiedades/actualizar', 
        '/propiedades/eliminar',
        '/vendedores/crear', 
        '/vendedores/actualizar', 
        '/vendedores/eliminar'
    ];

    // Obtener la URL actual de forma más limpia
    // $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?: '/';
    $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
    $metodo = $_SERVER['REQUEST_METHOD'];

    if ($metodo === 'GET') {
        $fn = $this->rutasGET[$urlActual] ?? null;
    } else {
        $fn = $this->rutasPOST[$urlActual] ?? null;
    }

    // Proteger las rutas
    if (in_array($urlActual, $rutasProtegidas) && !$auth) {
        header('Location: /');
        exit; // Es mejor usar exit después de un redirect
    }

    if ($fn) {
        call_user_func($fn, $this);
    } else {
        // Podrías renderizar una vista de 404 personalizada aquí
        echo "Página No Encontrada (404)";
    }
}

    // public function comprobarRutas(){

    //     session_start();
        
    //     $auth = $_SESSION['login'] ?? null;

    //     //arreglo de rutas protegidas, para usuarios autenticados
    //     $rutasProtegidas = ['/admin',
    //                         '/propiedades/crear', 
    //                         '/propiedades/actualizar', 
    //                         '/propiedades/eliminar', 
    //                         '/vendedores/crear', 
    //                         '/vendedores/actualizar', 
    //                         '/vendedores/eliminar'];



    //     $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/'; // strtok es para separar la url de los parametros, el ?? es para asignar un valor por defecto en caso de que no exista
    //     $urlLimpia = parse_url($urlActual, PHP_URL_PATH); 
    //     $metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        
    //     if($metodo === 'GET'){
    //         $fn = $this->rutasGET[$urlLimpia] ?? null;
    //     } else {
    //         $fn = $this->rutasPOST[$urlLimpia] ?? null;
    //     }

    //     //proteger las rutas
    //     if(in_array($urlLimpia, $rutasProtegidas) && !$auth){
    //         header('Location: /');
    //         return;
    //     }
        
    //     if($fn){
    //         call_user_func($fn, $this);
    //     } else {
    //         echo "Página no encontrada";
    //     }
    // }

    //muestra una vista
    public function render($view, $datos = []) {

            foreach($datos as $key => $value){
                $$key = $value; //Variable variable
            }

        ob_start(); //Almacena en memoria lo que se imprime
        include_once __DIR__ ."/views/" . $view . ".php";

        $contenido = ob_get_clean(); //Limpia el buffer y lo asigna a una   variable
        include_once __DIR__ . "/views/layout.php";
    }


}