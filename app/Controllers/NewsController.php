<?php

namespace App\Controllers;

use Matrix\Controller;
use Matrix\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = new News();

        $this->view->render('news/index', [
            'news' => $news->all()
        ]);
    }
    
    public function show($id)
    {
        $news = new News();

        $this->view->render('news/show', [
            'news' => $news->find($id)
        ]);
        
    }
}