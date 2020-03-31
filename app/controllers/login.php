<?php

class Login extends Controller
{
    public function index($param = '')
    {
        $this->getView('login');
    }
}