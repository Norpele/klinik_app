<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
         parent::__construct();
         $this->load->model(array('m_dashboard'));
     }

	public function index() { 
        $data['total_poli'] = $this->m_dashboard->get_total_poli();
        $data['total_pasien_data'] = $this->m_dashboard->get_total_data_pasien();
        $data['total_pasien_hari_ini'] = $this->m_dashboard->get_total_data_antrian();    
        $data['title'] = 'Dashboard';
        $data['js'] = 'dashboard';
      
        $this->load->view('header_ds', $data);
        $this->load->view('main/v_index.php', $data); 
        $this->load->view('footer',$data);
    
    }

}
?>
