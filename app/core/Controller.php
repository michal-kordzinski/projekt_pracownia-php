<?php

abstract class Controller
{
    //zwraca model
    protected function getModel($model) :object 
    {
        require_once('../app/models/' . $model . '.php');
        return new $model();
    }
    //zwraca widok
    protected function getView($view, $data = [])
    {
        require_once('../app/views/' . $view . '.php');
    }
}