<?php

namespace App\Controller;

use App\Model\Review;

class ReviewController extends BaseController
{
    private readonly ?Review $_Review;

    private function getReviewModel(): Review
    {
        if (!isset($this->_Review)) {
            $this->_Review = new Review();
        }
        return $this->_Review;
    }

    public function Create()
    {
        $device_id = $this->getParam('device_id');
        if (!isset($device_id)) {
            require __DIR__ . '/../View/insert-device-id.php';
            return;
        }

        $questionId = $this->getParam('question_id');
        $rating = $this->getParam('rating');
        $text = $this->getParam('text');

        try {
            $this->getReviewModel()->create($device_id, $questionId, $rating, $text);
            header('Location: /question?previous=' . $questionId . '&device_id=' . $device_id);
        } catch (\Exception $exception) {
            throw new \Exception('Erro ao criar feedback, Por favor informe o responsavel pelo dispositivo!');
        }
    }
}
