<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->helper(array('form', 'url')); 
        $this->load->helper('breadcrumbs');
    }

   
    public function index() {
        $data['title'] = 'login';
        $data['js'] = 'login';

        $this->load->view('header_auth',$data);
        $this->load->view('login/v_login');
        $this->load->view('footer', $data);
    }
    

    public function cek_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $result = $this->m_login->check_login($username, $password);

        if ($result !== 0) {
            $arr['username'] = $username;
            $arr['email'] = $result['email'];
            $arr['id_user'] = $result['id_user'];
            $arr['role'] = $result['role'];
            $this->session->set_userdata($arr);

            if($result['role'] === 'admin'){
                echo json_encode(['success' => true, 'message' => 'Login berhasil','redirect' => 'dashboard']);
            }else if($result['role'] === 'user'){
                echo json_encode(['success' => true, 'message' => 'Login berhasil', 'redirect' => 'user']);
            }            
        } else {
            echo json_encode(['success' => false, 'message' => 'Username atau password salah']);
        }
    }

    public function logout()
	{
		session_destroy();
		redirect(base_url());
	}

    public function settings() {
        $data['title'] = 'Pengaturan Akun';
        $data['js'] = 'settings_account';
    
        $username = $this->session->userdata('username');
        $email = $this->session->userdata('email');
    
        $data['username'] = $username;
        $data['email'] = $email;
    
        $this->load->view('header_user', $data);
        $this->load->view('user/v_pengaturan', $data);
        $this->load->view('footer', $data);
    }
}