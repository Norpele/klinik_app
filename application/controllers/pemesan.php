<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_pemesan'));
    }

    public function index()
    {
        $data['pembeli'] = $this->m_pemesan->get_pemesan();
        $data['js'] = 'pembeli';
        $this->load->view('header_ds');
        $this->load->view('pemesan/v_pembeli', $data);
        $this->load->view('footer', $data);
    }

    public function load_data() {
        $data['pembeli'] = $this->m_pemesan->get_pemesan();
        echo json_encode($data);
    }

    public function update_status() {
        $pesan_id = $this->input->post('pesan_id');
        $status = $this->input->post('status'); 
        if ($this->m_pemesan->update_pesan_status($pesan_id, $status)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function sql(){
        $jelas = "SELECT pemesanan.*, sum(total_harga) total FROM `pemesanan` 
        JOIN pemesanan_detail on pesandet_pesan_id = pesan_id 
        WHERE pesan_id_user = 12
        AND pesan_status = 1
        GROUP BY pesan_id;";
    }



    
}