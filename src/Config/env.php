<?php

$envFilePath = __DIR__ . '/../../.env';

if (file_exists($envFilePath)) {
    $envFileContent = file_get_contents($envFilePath);
    $envLines = explode("\n", $envFileContent);
    foreach ($envLines as $line) {
        if (!empty($line) && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
} else {
    die('.env file not found.');
}

