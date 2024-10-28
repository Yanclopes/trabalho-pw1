<?php

namespace App\Controller;

class NotFoundController
{
    public function index()
    {
        http_response_code(404);
        echo "
        <html>
        <head>
            <title>Página Não Encontrada - 404</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f8f8f8;
                    color: #333;
                    text-align: center;
                    padding: 50px;
                }
                h1 {
                    font-size: 50px;
                }
                p {
                    font-size: 18px;
                }
                a {
                    text-decoration: none;
                    color: #007bff;
                }
                a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <h1>404 - Página Não Encontrada</h1>
            <p>Desculpe, a página que você está procurando não existe ou foi removida.</p>
        </body>
        </html>
        ";
    }
}
