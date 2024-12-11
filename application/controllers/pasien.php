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
        $data['js'] = 'pasien';

        $this->load->view('header_ds.php',$data);
		$this->load->view('view_pasien/v_pasien.php');
		$this->load->view('footer',$data);
	}

    public function load_data() {
        $data['pasien'] = $this->m_pasien->get_pasien_data();
        echo json_encode($data);
    }

    public function simpanDataPasien() {
        $txnama = $this->input->post('nama_pasien');
        $txumur = $this->input->post('umur');
        $txno_unik = $this->noPasien();
        $txjenis_kelamin = $this->input->post('jenis_kelamin');
        $txtanggal_pendaftaran = $this->input->post('tanggal_pendaftaran');
        $txalamat = $this->input->post('alamat');
        $txbpjs = $this->input->post('bpjs');

            $sql = "INSERT INTO pasien (nama_pasien, umur, no_unik_pasien, alamat, jenis_kelamin, tanggal_pendaftaran, bpjs, status_antri) VALUES 
            ('{$txnama}','{$txumur}','{$txno_unik}','{$txalamat}','{$txjenis_kelamin}','{$txtanggal_pendaftaran}','{$txbpjs}', 0)";
            $exc = $this->db->query($sql);

            if ($exc) {
                $res['status'] = 'success';
                $res['msg'] = "Simpan data pasien berhasil";

            } else {
                $res['status'] = 'error';
                $res['msg'] = "Simpan data pasien gagal";
            }
        
        echo json_encode($res);
    }

    public function edit_data_pasien(){
        $id = $this->input->post('id');
        $sql = $this->db->query("SELECT * FROM pasien WHERE id_pasien = ?", array($id));
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

    public function update_data_pasien()
{
    $id_pasien = $this->input->post('id');
    $this->db->where('id_pasien', $id_pasien);
    $data =array(
        'nama_pasien'        => $this->input->post('nama_pasien'),
        'umur'               => $this->input->post('umur'),
        'alamat'             => $this->input->post('alamat'),
        'jenis_kelamin'      => $this->input->post('jenis_kelamin'),
        'tanggal_pendaftaran'=> $this->input->post('tanggal_pendaftaran'),
        'bpjs'               => $this->input->post('bpjs')
    );

    if ($this->db->update('pasien', $data)) {
        $res['status'] = 'success';
        $res['msg'] = "Data berhasil diperbarui";
    } else {
        $res['status'] = 'error';
        $res['msg'] = "Gagal memperbarui data";
    }
    echo json_encode($res);
}
    public function delete_table()
    {
        $this->db->where('id_pasien', $this->input->post("id"));
        if ($this->db->delete('pasien')) {
            $res['status'] = 'success';
            $res['msg'] = 'Data Berhasil dihapus';
        } else {
            $res['status'] = 'error';
            $res['msg'] = 'Data Gagagl dihapus';
        }
        echo json_encode($res);
    }

    public function noPasien() {
        $sql = "SELECT IFNULL(
            (
                SELECT CONCAT('PSN/', 
                              DATE_FORMAT(DATE(NOW()), '%m%y'), '/', 
                              LPAD(RIGHT(no_unik_pasien, 3) + 1, 3, '0'))
                FROM pasien
                WHERE no_unik_pasien LIKE CONCAT('PSN/', 
                                            DATE_FORMAT(DATE(NOW()), '%m%y'), '/%')
                      AND DATE_FORMAT(tanggal_pendaftaran, '%Y%m') = DATE_FORMAT(DATE(NOW()), '%Y%m')
                ORDER BY RIGHT(no_unik_pasien, 3) DESC 
                LIMIT 1
            ),
            (
                SELECT CONCAT('PSN/', 
                              DATE_FORMAT(DATE(NOW()), '%m%y'), '/001')
            )
        ) AS no_unik_pasien";
    
        $no_khusus = $this->db->query($sql)->row()->no_unik_pasien;
        return $no_khusus;
    }    

    }
