<?php

namespace serve\app\controllers;

class Index
{
    public function index()
    {
        echo viewtpl("index", ["title" => "Hello World 2313"]);
    }
}
