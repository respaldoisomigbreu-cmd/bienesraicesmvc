<?php

namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {

    public static function index(Router $router) {

        $propiedades = Propiedad::get(3);               //obtener solo 3 propiedades para mostrar en el index
        $inicio = true;                                  //variable para mostrar el banner solo en el index

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);

    }
    public static function nosotros(Router $router) {
        $router->render('paginas/nosotros', []);                //renderizar la vista de nosotros, el segundo argumento es un arreglo con los datos que se quieren pasar a la vista
    }

    public static function propiedades(Router $router) {
    
        $propiedades = Propiedad::all();               //obtener todas las propiedades para mostrar en la vista de propiedades

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {
    
    $id = validarORedireccionar('/propiedades');     //validar que el id sea un numero valido, si no lo es redireccionar a propiedades

        $propiedad = Propiedad::find($id);              //buscar la propiedad por su id


        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
        
    }
    public static function blog( Router $router) {
        $router->render('paginas/blog', []);
    }
    public static function entrada(Router $router) {
        $router->render('paginas/entrada', []);


        $router->render('paginas/entrada', []);
    }
    public static function contacto(Router $router) {

        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];

            //crear una instacia de phpMailer
            $mail = new PHPMailer();

            // configuar SMTP para enviar el correo
            $mail->isSMTP();                                        //indicar que se va a usar SMTP para enviar el correo
            $mail->Host = 'sandbox.smtp.mailtrap.io';               //indicar el host de SMTP para enviar el correo
            $mail->SMTPAuth = true;                                 //indicar que se va a usar autenticacion para enviar el correo
            $mail->Username = 'ca57719d577345';                     //indicar el username de SMTP para enviar el correo
            $mail->Password = '1cc0d7e807140b';                     //indicar el password de SMTP para enviar el correo                     
            $mail->SMTPSecure = 'tls';                              //indicar el tipo de encriptacion para enviar el correo   
            $mail->Port = 2525;                                     //indicar el puerto de SMTP para enviar el correo
            $mail->AuthType = 'LOGIN';                             //indicar el tipo de autenticacion para enviar el correo    

            //configurar el contenido del correo
            $mail->setFrom('admin@bienesraices.com');              //indicar el correo de origen del correo
            $mail->addAddress('admin@bienesraices.com', 'Brines Raices');  //indicar el correo de destino del correo
            $mail->Subject = 'Tienes un nuevo mensaje';           //indicar el asunto del correo

            //habilitar HTML en el correo
            $mail->isHTML(true);    
            $mail->CharSet = 'UTF-8';                               //indicar el charset del correo 


            //crear el contenido del correo
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . '</p>';

            //enviar d3e forma copndicional el email o el telefono
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligió ser contactado por teléfono</p>';
                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha de contacto: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . '</p>';

            } else {
                $contenido .= '<p>Eligió ser contactado por email</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }




            $contenido .= '</html>';

            $mail->Body = $contenido;                                //indicar el contenido del correo
            $mail->AltBody = 'esto es texto alternativo sin HTML';   //indicar el contenido alternativo del correo para clientes de correo que no soportan HTML

            // $mail->SMTPDebug = 2; // Habilitar el modo de depuración SMTP (0 = deshabilitado, 1 = mensajes del cliente, 2 = mensajes del cliente y del servidor)    
            
                 //       debuguear($respuestas);

            //enviar el correo
            if($mail->send()) {
                $mensaje = "Correo enviado correctamente";
            } else {
                $mensaje = "Error al enviar el correo: " . $mail->ErrorInfo;
            }
        
        }


        $router->render('paginas/contacto', [   
            'mensaje' => $mensaje

        ]);
    }
}
