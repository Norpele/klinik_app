<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

      
       

        // Memuat model m_dashboard
        $this->load->model('m_dashboard');
    }

	public function index() {    
        $data['title'] = 'Dashboard';
        $data['js'] = 'dashboard';
      
        $this->load->view('header_ds', $data);
        $this->load->view('main/v_index.php', $data); 
        $this->load->view('footer', $data);
    
    }

}
?>
