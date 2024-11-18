<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_pemesan');
    }

	public function index() {
        $data['transactions'] = $this->m_pemesan->getTransaksi();

        $data['title'] = 'History';
        $data['js'] = 'history';

        $this->load->view('header_user', $data);
        $this->load->view('history_user/v_history', $data); 
        $this->load->view('footer', $data);
    }

    public function upload_photo() {
        $config['upload_path']   = './uploads/'; 
        $config['allowed_types'] = 'gif|jpg|png'; 
        $config['max_size']      = 2048; 
        $config['encrypt_name']  = TRUE; 
    
        $this->load->library('upload', $config);
    
        if (!$this->upload->do_upload('tximg')) {
            $error = $this->upload->display_errors();
            echo json_encode(array('status' => 'error', 'msg' => $error));
        } else {
            $data = $this->upload->data();
            $file_name = $data['file_name']; 
            $pesan_id = $this->input->post('pesan_id'); 
    
            $save_data = array(
                'bukti_pembayaran' => $file_name,
                'pesan_status' => 2
            );
    
            $result = $this->m_pemesan->update_status($pesan_id, $save_data);
            
            if ($result) {
                echo json_encode(array('status' => 'success', 'msg' => 'Barang berhasil ditambahkan.'));
            } else {
                echo json_encode(array('status' => 'error', 'msg' => 'Gagal menyimpan data barang.'));
            }
        }
    }

    public function update_status(){
        $pesan_id = $this->input->post('pesan_id');

        $save_status = array(
            'pesan_status' => 3
        );

        $result = $this->m_pemesan->update_status($pesan_id,$save_status);

        if ($result) {
            echo json_encode(array('status' => 'success', 'msg' => 'Selesai'));
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'Gagal'));
        }
    }

    
    

}
?>
