<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function register() {
        $this->load->view('register');
    }

    public function register_action() {
        $data = [
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'name' => $this->input->post('name'),
            'user_role' => '2'
        ];
        $user_data = [
            'address' => $this->input->post('address'),
            'phone' => $this->input->post('phone'),
            'designation' => $this->input->post('designation')
        ];
        if ($this->User_model->register($data,$user_data)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function login() {
        $this->load->view('login');
    }

    public function login_action() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->User_model->login($email, $password);
        if ($user) {
            $this->session->set_userdata('user_id', $user->id);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function reset_password() {
        $this->load->view('reset_password');
    }

    public function reset_password_action() {
        $email = $this->input->post('email');
        $new_password = $this->input->post('new_password');
        $this->User_model->reset_password($email, $new_password);
        echo json_encode(['status' => 'success']);
    }

    public function profile() {
        $email = $_GET['email'];
        $password = $_GET['password'];
        $details = $this->User_model->get_user_details($email, $password);
        $this->session->set_userdata('user_detail_list', $details);
        $arrCount = count($details);
        if($details && $arrCount>1){
            $data['details'] = $details; 
            $this->load->view('admin_panel',$data);
        }else{
            $data['details'] = $details; 
            $this->load->view('profile',$data);
        }
    }

    
}
