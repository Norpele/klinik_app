<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the model
        $this->load->model(array('m_supplier'));
        $this->load->helper(array('form', 'url')); 
        $this->load->helper('breadcrumbs');
    }

   
    public function index() {
        $data['title'] = 'manajemen supplier';
        $data['supplier'] = $this->m_supplier->get_supplier_data();
        $data['js'] = 'supplier';

        $this->load->view('header_ds',$data);
        $this->load->view('supplier/v_supplier',$data);
        $this->load->view('footer', $data);
    }

    public function load_data() {
        $data['supplier'] = $this->m_supplier->get_supplier_data();
        echo json_encode($data);
    }

    public function create() {
        $txnama = $this->input->post('txnama');
        $txkontak = $this->input->post('txkontak');
        $txalamat = $this->input->post('txalamat');

            $sql = "INSERT INTO supplier (namaSupplier, kontak, alamat) VALUES 
            ('{$txnama}','{$txkontak}', '{$txalamat}')";
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

public function edit_table()
    {
        $id = $this->input->post('id');
        $sql = $this->db->query("SELECT * FROM supplier WHERE id_supplier = ?", array($id));
        $result = $sql->row_array();
        if ($result > 0) {
            $res['status'] = 'ok';
            $res['data'] = $result;
            $res['msg'] = "Data supplier sudah ada";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "supplier tidak ditemukan";
        }
        echo json_encode($res);
    }
    
    public function update_data()
    {
        $id = $this->input->post('id');      
        $txnama = $this->input->post('txnama');
        $txkontak = $this->input->post('txkontak');
        $txalamat = $this->input->post('txalamat');

        $this->db->where('id_supplier', $id);
        $update_data = array(
            'namaSupplier' => $txnama,
            'kontak' => $txkontak,
            'alamat' => $txalamat,
        );

        if ($this->db->update('supplier', $update_data)) {
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
        if ($this->m_supplier->delete_table($this->input->post("id"))) {
            $res['status'] = 'success';
            $res['msg'] = 'Data Berhasil dihapus';
        } else {
            $res['status'] = 'error';
            $res['msg'] = 'Data Gagagl dihapus';
        }
        echo json_encode($res);
    }
}
