<?php

namespace Matrix;

use Matrix\View;
use Matrix\Request;

class Controller
{
    protected $view;
    protected $request;

    public function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
    }
}