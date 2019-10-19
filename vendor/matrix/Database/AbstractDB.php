<?php

namespace Matrix\Database;

abstract class AbstractDB
{
    public $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }
    
}