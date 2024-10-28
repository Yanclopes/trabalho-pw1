<?php

namespace App\Migrations;

use App;

class create_users_table extends Migration{

    protected $name = 'create_users_table';
    public function up(): void
    {
        $this->exec("
            CREATE TABLE users (
                user_id SERIAL PRIMARY KEY,
                user_name VARCHAR(100) NOT NULL,
                user_email VARCHAR(150) NOT NULL UNIQUE,
                user_password VARCHAR(255) NOT NULL,
                user_is_admin BOOLEAN DEFAULT FALSE,
                user_force_change_password BOOLEAN DEFAULT TRUE,
                user_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");
    }

    public function down(): void
    {
        $this->exec("DROP TABLE IF EXISTS users;");
    }
}
