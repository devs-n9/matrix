<?php

namespace Matrix;

class View
{
    public $template = 'layouts/app';
    public $content = '';
    public $data  = [];

    public function render($path, $data = [])
    {
        $this->data = $data;

        if(!empty($data)){
            extract($data);
        }
        
        $this->content = APP . "/Views/{$path}.php";

        if (is_null($this->template)) {
            $path = $this->content;
        } else {
            $path = APP . "/Views/{$this->template}.php";
        }

        if (file_exists($path)) {
            require $path;
        }
    }

    public function getContent()
    {   
        if(is_array($this->data)){
            extract($this->data);
        }
        
        include_once $this->content;
    }
}