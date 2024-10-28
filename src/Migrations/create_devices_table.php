<?php

namespace App\Migrations;

use App;

class create_devices_table extends Migration{

    protected $name = 'create_devices_table';
    public function up(): void
    {
        $this->exec("
            CREATE TABLE devices (
                device_id SERIAL PRIMARY KEY,
                sector_id INT NOT NULL,
                device_name VARCHAR(255) NOT NULL,
                device_status VARCHAR(10) CHECK (device_status IN ('ativo', 'inativo')),
                FOREIGN KEY (sector_id) REFERENCES sectors(sector_id)
           );
        ");
    }

    public function down(): void
    {
        $this->exec("DROP TABLE IF EXISTS devices;");
    }
}
