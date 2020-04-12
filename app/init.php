<?php
//globalne
define('URL', 'http://localhost/projekt_pracownia_php/serwis/public/');
//Dane do bazki
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'projekt_pracownia_php');
define('DB_CHARSET', 'utf8');
//startowanie sesji 
session_start();
//ładowarka klas - TODO jezeli bedzie czas - przebudowa na obiekt
spl_autoload_register(function($class){
    require_once('core/' . $class . '.php');
});