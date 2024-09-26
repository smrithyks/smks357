<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_questions() {
        return $this->db->get('questions')->result();
    }

    public function get_answers($question_id) {
        return $this->db->where('question_id', $question_id)->get('answers')->result();
    }

    public function save_user_answer($data) {
        return $this->db->insert('user_answers', $data);
    }

    public function save_quiz_result($data) {
        return $this->db->insert('quiz_results', $data);
    }
}
