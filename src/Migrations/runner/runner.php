<?php

require_once __DIR__ . '/../../../vendor/autoload.php'; // Ajuste o caminho conforme necessário
require_once __DIR__."/../../Config/env.php";

// Conecte-se ao banco de dados PostgreSQL
try{
$pdo = new PDO('pgsql:host=' . $_ENV['DATABASE_LOCALHOST'] . ';dbname=' . $_ENV['DATABASE_NAME'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage() . "\n";
    exit(1);
}
// Verifica se a classe e o método foram passados como argumentos
if ($argc < 3) {
    echo "Uso: php runner.php <Classe> <Método>\n";
    exit(1);
}

$className = $argv[1];
$methodName = $argv[2];

// Verifica se a classe existe
$classFullName = 'App\\Migrations\\' . $className;
if (!class_exists($classFullName)) {
    echo "Classe '{$classFullName}' não encontrada.\n";
    exit(1);
}

// Cria uma instância da classe
$classInstance = new $classFullName($pdo);

// Verifica se o método existe na classe
if (!method_exists($classInstance, $methodName)) {
    echo "Método '{$methodName}' não encontrado na classe '{$className}'.\n";
    exit(1);
}

// Executa o método
try {
    $classInstance->$methodName();
} catch (Exception $e) {
    echo "Erro ao executar o método: " . $e->getMessage() . "\n";
}
