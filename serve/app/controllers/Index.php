<?php

namespace serve\app\controllers;

class Index
{
    public function index()
    {
        tpl([
            'title' => 'hello',
            'content' => [
                [
                    'path' => "header",
                    'data' => [
                        'title' => 'home123'
                    ]
                ],
                [
                    'path' => "index",
                    'data' => [
                        'title' => 'home'
                    ]
                ]
            ]
        ]);
    }
}
