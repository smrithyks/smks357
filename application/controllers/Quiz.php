<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Quiz_model');
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('page1');
    }

    public function questions($question_number = 1) {
        $questions = $this->Quiz_model->get_questions();
        $current_question = $questions[$question_number - 1];
        $answers = $this->Quiz_model->get_answers($current_question->id);
        $data = [
            'question' => $current_question,
            'answers' => $answers,
            'question_number' => $question_number,
            'total_questions' => count($questions)
        ];
        $this->load->view('page2', $data);
    }

    public function submit_answer() {
        $data = [
            'quiz_result_id' => $this->input->post('quiz_result_id'),
            'question_id' => $this->input->post('question_id'),
            'selected_answer_id' => $this->input->post('selected_answer_id')
        ];
        $this->Quiz_model->save_user_answer($data);
        // Determine if there are more questions
        $total_questions = $this->input->post('total_questions');
        if ($this->input->post('question_number') < $total_questions) {
            redirect('quiz/questions/' . ($this->input->post('question_number') + 1));
        } else {
            redirect('quiz/review_answers');
        }
    }

    public function review_answers() {
        // Load all answers for review
        $this->load->view('review_answers');
    }

    public function result() {
        // Calculate score and display results
        $this->load->view('result');
    }
}
