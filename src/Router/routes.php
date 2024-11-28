<?php

$routes = [
    'GET'=>[
        '/question' => 'QuestionController@getNextQuestion',
        '/device/validate' => 'DeviceController@validateDevice',
        '/login' => 'LoginController@login',
        '/admin/user' => 'UserController@list',
        '/admin/question' => 'QuestionController@list',
        '/change-password' => 'UserController@changePassword',
        '/device' => 'DeviceController@selectDevice',
        '/admin/sector' => 'SectorController@list',
        '/admin/device' => 'DeviceController@list',
    ],
    'POST' => [
        '/review/create' => 'ReviewController@Create',
        '/user/create' => 'UserController@create',
        '/login' => 'LoginController@login',
        '/change-password' => 'UserController@changePassword',
        '/question/{id}/status' => 'QuestionController@status',
        '/sector/create' => 'SectorController@create',
        '/device/create' => 'DeviceController@create',
    ],
];
