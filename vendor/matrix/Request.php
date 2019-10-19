<?php

namespace Matrix;

class Request
{

    public function getMethod()
    {
        return filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    }

    public function get($param)
    {
        if(!empty(filter_input(INPUT_POST, $param))){
            return filter_input(INPUT_POST, $param);
        }else{
            return filter_input(INPUT_GET, $param);
        }
    }

    public function all()
    {

        $postData = filter_input_array(INPUT_POST);
        $getData = filter_input_array(INPUT_GET);
        
        return array_merge($postData, $getData);
    }
}