<?php
//globalne
define('URL', 'http://localhost/projekt_pracownia_php/serwis/public/');
//startowanie sesji 
session_start();
//ładowarka klas - TODO jezeli bedzie czas - przebudowa na obiekt
spl_autoload_register(function($class){
    require_once('core/' . $class . '.php');
});