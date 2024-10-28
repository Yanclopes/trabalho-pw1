<?php

namespace App\Migrations;

use App;

class create_reviews_table extends Migration{

    protected $name = 'create_reviews_table';
    public function up(): void
    {
        $this->exec("
            CREATE TABLE reviews (
                review_id SERIAL PRIMARY KEY,
                question_id INT NOT NULL,
                device_id INT NOT NULL,
                review_response INT NOT NULL,
                review_feedback_text TEXT,
                review_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                FOREIGN KEY (question_id) REFERENCES questions(question_id),
                FOREIGN KEY (device_id) REFERENCES devices(device_id)
             );
        ");
    }

    public function down(): void
    {
        $this->exec("DROP TABLE IF EXISTS reviews;");
    }
}
