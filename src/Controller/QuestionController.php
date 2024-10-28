<?php

namespace App\Controller;

use App\Model\Question;
class QuestionController extends BaseController
{
    private readonly ?Question $_Question;
    private function getQuestionModel(): Question
    {
        if(!isset($this->_Question)){
            $this->_Question = new Question();
        }
        return $this->_Question;
    }

    public function status($param){
        try {
            $question = $this->getQuestionModel()->getQuestionById($param[0]);
            $this->getQuestionModel()->update($question['question_id'], $question['question_text'], $question['question_status'] == 'ativa' ? 'inativa' : 'ativa');
            header('location: /admin/question');
        }catch (\Exception $e){
            throw new \Exception('Erro ao atualizar status do id: '.$param[0]);
        }
    }

//    public function Create()
//    {
//        $questionId = $this->getParam('question_id');
//        $rating = $this->getParam('rating');
//        $questions = $this->getQuestionModel()->getNextQuestion($questionId);
//        require __DIR__ . '/../View/question.php';
//    }

    public function list(): void
    {
        if ($this->forceChangePassword()) {
            header("Location:/change-password");
            exit();
        }
        $questions = $this->getQuestionModel()->read();
        require_once __DIR__."/../View/admin-question.php";
    }

    public function getNextQuestion(): void
    {
        $device_id = $this->getParam('device_id');
        if(!isset($device_id)){
            require __DIR__ . '/../View/insert-device-id.php';
            return;
        }
        $previous = $this->getParam('previous');
        $questions = $this->getQuestionModel()->getNextQuestion($previous);
        require __DIR__ . '/../View/question.php';
    }
}