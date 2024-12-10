<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model(array('m_pasien'));
    } 
	public function index()
	{
        $data['title'] = 'manajemen pasien';
        // $data['poli'] = $this->m_pasien->get_poli_data();
        $data['js'] = 'poli';

        $this->load->view('header_ds.php',$data);
		$this->load->view('view_pasien/v_pasien.php');
		$this->load->view('footer',$data);
	}

    public function load_data() {
        $data['pasien'] = $this->m_pasien->get_pasien_data();
        echo json_encode($data);
    }

    public function noPasien() {
        $sql = "SELECT IFNULL(
            (
                SELECT CONCAT('PSN/', 
                              DATE_FORMAT(DATE(NOW()), '%m%y'), '/', 
                              LPAD(RIGHT(no_khusus, 3) + 1, 3, '0'))
                FROM pasien
                WHERE no_khusus LIKE CONCAT('PSN/', 
                                            DATE_FORMAT(DATE(NOW()), '%m%y'), '/%')
                      AND DATE_FORMAT(tanggal_daftar, '%Y%m') = DATE_FORMAT(DATE(NOW()), '%Y%m')
                ORDER BY RIGHT(no_khusus, 3) DESC 
                LIMIT 1
            ),
            (
                SELECT CONCAT('PSN/', 
                              DATE_FORMAT(DATE(NOW()), '%m%y'), '/001')
            )
        ) AS no_khusus";
    
        $no_khusus = $this->db->query($sql)->row()->no_khusus;
        return $no_khusus;
    }    
    
    public function edit_poli(){
        $id = $this->input->post('id');
        $sql = $this->db->query("SELECT * FROM poli WHERE id_poli = ?", array($id));
        $result = $sql->row_array();
        if ($result > 0) {
            $res['status'] = 'ok';
            $res['data'] = $result;
            $res['msg'] = "Data poli sudah ada";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "poli tidak ditemukan";
        }
        echo json_encode($res);
    }
    public function delete_table()
    {
        if ($this->m_poli->delete_table($this->input->post("id"))) {
            $res['status'] = 'success';
            $res['msg'] = 'Data Berhasil dihapus';
        } else {
            $res['status'] = 'error';
            $res['msg'] = 'Data Gagagl dihapus';
        }
        echo json_encode($res);
    }

    public function update_data()
    {
        $id = $this->input->post('id');      
        $txpoli = $this->input->post('txpoli');

        $this->db->where('id_poli', $id);
        $update_data = array(
            'name_poli' => $txpoli,
        );

        if ($this->db->update('poli', $update_data)) {
            $res['status'] = 'success';
            $res['msg'] = "Data berhasil diperbarui";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Gagal memperbarui data";
        }
        echo json_encode($res);
    }

    }
