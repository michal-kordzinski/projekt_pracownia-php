<?php

class Home extends Controller
{
    public function index($param = '')
    {
        $user = $this->getModel('User');
        $user->name = $param;
        $this->getView('index', ['name' => $user->name]);
    }
}