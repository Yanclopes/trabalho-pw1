<?php

namespace App\Migrations;

use App;

class create_sectors_table extends Migration{

    protected $name = 'create_sectors_table';
    public function up(): void
    {
        $this->exec("
        CREATE TABLE sectors (
            sector_id SERIAL PRIMARY KEY,
            sector_name TEXT NOT NULL,
            sector_description TEXT
        );
        ");
    }

    public function down(): void
    {
        $this->exec("DROP TABLE IF EXISTS sectors;");
    }
}
