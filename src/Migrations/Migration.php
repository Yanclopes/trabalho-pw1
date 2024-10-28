<?php
namespace App\Migrations;

use PDO;
use PDOException;

abstract class Migration
{
    protected $pdo;
    protected $name;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    protected function exec($sql){
        try {
            $this->pdo->exec($sql);
            echo "Migration $this->name executada com sucesso!\n";
        } catch (PDOException $e) {
            echo "Erro ao executar migration $this->name:" .$e->getMessage()."\n";
        }
    }

    abstract function up();
    abstract function down();
}
