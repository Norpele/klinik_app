<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_dashboard');
    }

	public function index() { 
        $data['total_poli'] = $this->m_dashboard->total_poli();   
        $data['title'] = 'Dashboard';
        $data['js'] = 'dashboard';
      
        $this->load->view('header_ds', $data);
        $this->load->view('main/v_index.php', $data); 
        $this->load->view('footer', $data);
    
    }

}
?>
