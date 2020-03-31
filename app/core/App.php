<?php

class App
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];
    public function __construct()
    {
        $url = $this->parseUrl();
        
        //sprawdza czy istnieje kontroller, jezeli tak to ustawia
        //jestesmy w app/public/index.php
        if (file_exists('../app/controllers/' . $url[0] .'.php')) { 
            $this->controller = $url[0];
            unset($url[0]);
        }
        //jezeli warunek sie nie spelnil, ustawia domyslnie kontroller - home
        require_once('../app/controllers/' . $this->controller . '.php');
        $this->controller = new $this->controller;
        //sprwdzenie czy istnieje metoda, jezeli tak -> przypisuje wlasciwosc
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        //przypisuje paramenty, badz pusta tablice w przypadku ich braku
        $this->params = $url ? array_values($url) : [];
        //wywołuje metode controlera z podanymi argumentami 
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    private function parseUrl() //output: string lub array
    {
        if(isset($_GET['url'])){
            //rozwiazanie $_GET dzieki .htaccess
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'),  FILTER_SANITIZE_URL));
        }
    }
}