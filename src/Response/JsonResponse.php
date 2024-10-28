<?php

namespace App\Response;

class JsonResponse
{
    public static function Response(array $data, int $status = 200)
    {
        header('Content-Type: application/json', true, $status);
        echo json_encode($data);
        exit;
    }
}