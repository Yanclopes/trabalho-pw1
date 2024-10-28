<?php

$routes = [
    'GET'=>[
        '/question' => 'QuestionController@getNextQuestion',
        '/device/validate' => 'DeviceController@validateDevice',
        '/login' => 'LoginController@login',
        '/admin/user' => 'UserController@list',
        '/admin/question' => 'QuestionController@list',
        '/change-password' => 'UserController@changePassword',
    ],
    'POST' => [
        '/review/create' => 'ReviewController@Create',
        '/user/create' => 'UserController@create',
        '/login' => 'LoginController@login',
        '/change-password' => 'UserController@changePassword',
        '/question/{id}/status' => 'QuestionController@status',
    ],
];
