<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function register($data,$user_data) {
        $this->db->insert('users', $data);
        $userid = $this->db->insert_id();
        $user_data = [
            'user_id' => $userid,
            'address' => $user_data['address'],
            'phone' => $user_data['phone'],
            'designation' => $user_data['designation']
        ];  
        return $this->db->insert('users_info', $user_data);
    }

    public function login($email, $password) {
        $this->db->where('email', $email);
        $user = $this->db->get('users')->row();
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }

    public function reset_password($email, $new_password) {
        return $this->db->update('users', ['password' => password_hash($new_password, PASSWORD_BCRYPT)], ['email' => $email]);
    }

    public function get_user_details($email,$password){
        $this->db->where('email', $email);
        $user = $this->db->get('users')->row();
        if ($user && password_verify($password, $user->password)) {
            if($user->user_role == '2'){
                $user_id = $user->id;
                $this->db->where('user_id', $user_id);
                $user_details = $this->db->get('users_info')->row();
                $details = [
                    'name' => $user->name,
                    'user_role' => $user->user_role,
                    'address' => $user_details->address,
                    'phone' => $user_details->phone,
                    'designation' => $user_details->designation
                ];
            }else{
                $this->db->select('users.*, users_info.*'); 
                $this->db->from('users');
                $this->db->join('users_info', 'users.id = users_info.user_id'); 
                $this->db->where('users.user_role', 2); 
                $details = $this->db->get()->result();
            }
            return $details;
        }
        return false;
    }

    public function get_all_users() {
        return $this->db->get('users')->result();$this->db->select('users.*, users_info.*'); 
        $this->db->from('users');
        $this->db->join('users_info', 'users.id = users_info.user_id'); 
        $details = $this->db->get()->result();
        return $details;
    }
}
