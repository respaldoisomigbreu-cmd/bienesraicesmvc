<?php

// El tipo de retorno correcto es mysqli
function conectarDB(): mysqli {
    $db = mysqli_connect(
        $_ENV['DB_HOST'], 
        $_ENV['DB_USER'], 
        $_ENV['DB_PASS'], 
        $_ENV['DB_NAME']
    ); 

    if (!$db) {
        echo "Error: No se pudo conectar a MySQL.";
        echo "Depuración error: " . mysqli_connect_error();
        exit;
    }

    return $db;
}
