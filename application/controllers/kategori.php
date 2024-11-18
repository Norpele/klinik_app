<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the model
        $this->load->model(array('m_kategori'));
        $this->load->helper(array('form', 'url')); 
        $this->load->helper('breadcrumbs');
    }

   
    public function index() {
        $data['title'] = 'manajemen kategori';
        $data['kategori'] = $this->m_kategori->get_kategori_data();
        $data['js'] = 'kategori';

        $this->load->view('header_ds',$data);
        $this->load->view('kategori/v_kategori',$data);
        $this->load->view('footer', $data);
    }

    public function load_data() {
        $data['kategori'] = $this->m_kategori->get_kategori_data();
        echo json_encode($data);
    }

    public function create() {
        $kategori = $this->input->post('txkategori');

            $sql = "INSERT INTO kategori (kategoriBarang) VALUES 
            ('{$kategori}')";
            $exc = $this->db->query($sql);

            if ($exc) {
                $res['status'] = 'success';
                $res['msg'] = "Simpan data {$kategori} berhasil";

            } else {
                $res['status'] = 'error';
                $res['msg'] = "Simpan data {$kategori} gagal";
            }
        
        echo json_encode($res);
    
}

public function edit_table()
    {
        $id = $this->input->post('id');
        $sql = $this->db->query("SELECT * FROM kategori WHERE id_kategori = ?", array($id));
        $result = $sql->row_array();
        if ($result > 0) {
            $res['status'] = 'ok';
            $res['data'] = $result;
            $res['msg'] = "Data {$id} sudah ada";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Code tidak ditemukan";
        }
        echo json_encode($res);
    }
    
    public function update_data()
    {
        $id = $this->input->post('id');
        $kategori = $this->input->post('txkategori');

        $this->db->where('id_kategori', $id);
        $update_data = array(
            'kategoriBarang' => $kategori,
        );

        if ($this->db->update('kategori', $update_data)) {
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
        if ($this->m_kategori->delete_table($this->input->post("id"))) {
            $res['status'] = 'success';
            $res['msg'] = 'Data Berhasil dihapus';
        } else {
            $res['status'] = 'error';
            $res['msg'] = 'Data Gagagl dihapus';
        }
        echo json_encode($res);
    }
}
