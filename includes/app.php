<?php 

require __DIR__ . '/../vendor/autoload.php';

// 1. Inicializar Dotenv para cargar las variables de $_ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

// 2. Ahora que $_ENV tiene datos, cargamos los archivos que los usan
require "funciones.php";
require "database.php";

// 3. Conectarnos a la base de datos
$db = conectarDB();

use Model\ActiveRecord;
ActiveRecord::setDB($db);
