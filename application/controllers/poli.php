<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poli extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
        $data['title'] = 'manajemen supplier';
        $data['poli'] = $this->m_poli->get_poli_data();
        $data['js'] = 'poli';
        $this->load->view('header_ds.php');
		$this->load->view('poli/v_poli.php');
		$this->load->view('footer',$data);
	}

    public function load_data() {
        $data['poli'] = $this->m_poli->get_poli_data();
        echo json_encode($data);
    }

    public function create() {
        $txpoli = $this->input->post('txpoli');
            $sql = "INSERT INTO poli (name_poli) VALUES 
            ('{$txpoli}')";
            $exc = $this->db->query($sql);

            if ($exc) {
                $res['status'] = 'success';
                $res['msg'] = "Simpan data supplier berhasil";

            } else {
                $res['status'] = 'error';
                $res['msg'] = "Simpan data supplier gagal";
            }
        
        echo json_encode($res);
    
}
}
