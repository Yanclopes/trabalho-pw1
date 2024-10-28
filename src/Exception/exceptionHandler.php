<?php
function exceptionHandler($exception) {
    error_log($exception->getMessage());
    require_once __DIR__.'/../View/error.php';
    exit();
}