<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class antrian extends CI_Controller {

    public function __construct() {
         parent::__construct();
         $this->load->model(array('m_antrian','m_pasien','m_poli'));
     }

	public function index() { 
 
        $data['title'] = 'Antrian';
        $data['js'] = 'antrian';
      
        $this->load->view('header_ds', $data);
        $this->load->view('view_antrian/v_antrian.php', $data); 
        $this->load->view('footer',$data);
    
    }

    public function get_data_nama_pasien(){
        $res['data_pasien'] = $this->m_antrian->get_pasien_data_antrian();
        echo json_encode($res);
    }
    public function get_data_poli(){
        $res['data_poli'] = $this->m_poli->get_poli_data();
        echo json_encode($res);
    }
    public function get_antrian_data() {
        $id_poli = $this->input->post('id_poli');   
        $data_antrian = $this->m_antrian->get_data_antrian($id_poli);
    
        echo json_encode(['data_antrian' => $data_antrian]);
    }

    public function update_antrian() {
        $id_pasien = $this->input->post('id_pasien');
        $nomor_antrian = $this->input->post('nomor_antrian');
        $status = $this->input->post('status_antri');
        if ($this->m_antrian->update_status($id_pasien,$nomor_antrian, $status)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
       

    public function simpanDataAntrian() {
        $txnama_pasien = $this->input->post('txnama_pasien');
        $poli = $this->input->post('txpoli');
        $tanggal = $this->input->post('txtanggal');
    
        $query = $this->db->query("SELECT COUNT(*) as count FROM antrian WHERE Pasien_id = '{$txnama_pasien}' AND Poli_id = '{$poli}' AND status_antri IN (1,2)");
        $result = $query->row();
    
        if ($result->count > 0) {
            $patientNameQuery = "SELECT nama_pasien FROM pasien WHERE id_Pasien = '{$txnama_pasien}'";
            $patientName = $this->db->query($patientNameQuery)->row()->nama_pasien;
    
            $res['status'] = 'error';
            $res['msg'] = "{$patientName} sudah terdaftar dalam antrian.";
        } else {
            $nomor_antrian = $this->m_antrian->get_next_nomor_antrian($poli); 
            $sql = "INSERT INTO antrian (Pasien_id, Poli_id, nomor_antrian, tanggal, status_antri) VALUES 
                    ('{$txnama_pasien}', '{$poli}', '{$nomor_antrian}', '{$tanggal}', 1)";
            $exc = $this->db->query($sql);
    
            if ($exc) {
                $patientNameQuery = "SELECT nama_pasien FROM pasien WHERE id_Pasien = '{$txnama_pasien}'";
                $patientName = $this->db->query($patientNameQuery)->row()->nama_pasien;
    
                $res['status'] = 'success';
                $res['msg'] = "{$patientName} berhasil ditambahkan ke antrian.";
            } else {
                $res['status'] = 'error';
                $res['msg'] = "Antrian gagal ditambahkan.";
            }
        }
    
        echo json_encode($res);
    }
    
}
?>
