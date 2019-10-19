<?php

namespace App\Controllers;

use Matrix\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->view->render('default/index', [
            'title' => 'this is title for index'
        ]);
    }
}