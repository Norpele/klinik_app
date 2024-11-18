<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegAcc extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_register','m_dashboard'));
		$this->load->helper('form');
		$this->load->library('form_validation');

	}
	public function index()
	{
		//session_destroy();
		if($this->session->role == '' || empty($this->session->role)){
			$data['js'] = 'register';
			$this->load->view('header_auth');
			$this->load->view('register/v_register');
			$this->load->view('footer', $data);

		}elseif($this->session->role == 'admin') {
			$data['jumlah_jenis_barang'] = $this->m_dashboard->get_jumlah_jenis_barang();
			$data['total_pengeluaran'] = $this->m_dashboard->get_total_pengeluaran();
			$data['title'] = 'Dashboard';
			$data['js'] = 'dashboard';
	
			$this->load->view('header_ds', $data);
			$this->load->view('main/v_index.php', $data); // Kirim data ke view
			$this->load->view('footer', $data);

		}elseif($this->session->role == "user") {
			$id_kategori = $this->input->get('kategori'); 
            $data['barang'] = $this->m_barang->get_barang_data($id_kategori); 
			$data['title'] = 'user';
			$data['js'] = 'user';
	
			$this->load->view('header_user', $data);
			$this->load->view('user/v_user.php', $data); // Kirim data ke view
			$this->load->view('footer', $data);
		} 
	}

	public function add_account(){
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_domain');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

    if ($this->form_validation->run() === FALSE) {
        echo json_encode(['error' => validation_errors()]);
    } else {
        $data = [
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' =>$this->input->post('password'),
            'role' => 'user'
        ];

        $inserted = $this->m_register->insert_user($data);

        if ($inserted) {
            $user_id = $this->m_register->get_user_id_by_email($data['email']);
            $this->session->set_userdata([
                'id_user' => $user_id,
                'nama_pengguna' => $data['username'],
                'role' => 'user'
            ]);
            echo json_encode(['success' => 'Account created successfully!']);
        } else {
            echo json_encode(['error' => 'Failed to create account.']);
        }
    }
}

	public function check_email_exists($email)
	{
		if ($this->m_register->is_email_exist($email)) {
			$this->form_validation->set_message('check_email_exists', 'Email sudah terdaftar. Silakan gunakan email lain.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function check_email_domain($email)
	{
		$allowed_domains = ['gmail.com', 'apple.com'];
		$domain = substr(strrchr($email, "@"), 1);

		if (in_array($domain, $allowed_domains)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('check_email_domain', 'The email must be from gmail.com or apple.com');
			return FALSE;
		}
	}

	public function logout()
	{
		session_destroy();
		redirect(base_url());
	}
}
