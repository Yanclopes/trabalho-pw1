<?php

namespace App\Migrations;

use App;

class create_questions_table extends Migration{

    protected $name = 'create_questions_table';
    public function up(): void
    {
        $this->exec("
        CREATE TABLE questions (
            question_id SERIAL PRIMARY KEY,
            question_text TEXT NOT NULL,
            question_status VARCHAR(10) CHECK (question_status IN ('ativa', 'inativa'))
        );
        ");
    }

    public function down(): void
    {
        $this->exec("DROP TABLE IF EXISTS questions;");
    }
}
