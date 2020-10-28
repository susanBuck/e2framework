<?php

namespace App\Controllers;

class Controller
{
    private $app;
    
    public function __construct($app)
    {
        $this->app = $app;
    }
}