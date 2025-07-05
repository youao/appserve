<?php

namespace serve\admin\controllers\sys;

class DbTable
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
