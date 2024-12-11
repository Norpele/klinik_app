<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class antrian extends CI_Controller {

    public function __construct() {
         parent::__construct();
         $this->load->model(array('m_antrian'));
     }

	public function index() { 
        $data['total_poli'] = $this->m_->get_total_poli();
        $data['total_antrian_data'] = $this->m_antrian->get_total_data_antrian();   
        $data['title'] = 'Antrian';
        $data['js'] = 'antrian';
      
        $this->load->view('header_ds', $data);
        $this->load->view('view_antrian/v_antrian.php', $data); 
        $this->load->view('footer',$data);
    
    }

}
?>
