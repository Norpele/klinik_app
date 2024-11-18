<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	public function __construct() {
        parent::__construct();
        // Load the model
        $this->load->model(array('m_produk','m_penjualan','m_kategori'));
        $this->load->helper(array('form', 'url')); 
        $this->load->helper('breadcrumbs');
    }
	

	public function index()
	{
        $data['title'] = 'Manajemen Penjualan';
        $data['penjualan'] = $this->m_penjualan->load_tabel_penjualan();
        $data['js'] = 'penjualan';

        $this->load->view('header_ds.php',$data);
		$this->load->view('penjualan/v_penjualan',$data);
        $this->load->view('footer',$data);
	}

    public function load_data() {
        $data['penjualan'] = $this->m_penjualan->load_tabel_penjualan();
        echo json_encode($data);
    } 

    public function create() {
        $barang = $this->input->post('txbarang');
        $harga = $this->input->post('txharga');

            $sql = "INSERT INTO penjualan (nama_barang , set_harga) VALUES 
            ('{$barang}','{$harga}')";
            $exc = $this->db->query($sql);

            if ($exc) {
                $res['status'] = 'success';
                $res['msg'] = "Simpan data {$barang} berhasil";

            } else {
                $res['status'] = 'error';
                $res['msg'] = "Simpan data {$barang} gagal";
            }
        
        echo json_encode($res);
    }

    public function load_barang(){
        $res['load_barang'] = $this->m_produk->get_produk_data2();
        echo json_encode($res);
    }

    public function load_kategori(){
        $res['load_barang'] = $this->m_kategori->get_kategori_data();
        echo json_encode($res);
    }

    public function edit_table()
    {
        $id = $this->input->post('id');
        $sql = $this->db->query("SELECT * FROM penjualan WHERE id_penjualan = ?", array($id));
        $result = $sql->row_array();
        if ($result > 0) {
            $res['status'] = 'ok';
            $res['data'] = $result;
            $res['msg'] = "nama barang sudah ada";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "barang tidak ditemukan";
        }
        echo json_encode($res);
    }

    public function update_data()
    {
        $id = $this->input->post('id');      
        $txbarang = $this->input->post('txbarang');
        $txharga = $this->input->post('txharga');

        $this->db->where('id_penjualan', $id);
        $update_data = array(
            'nama_barang' => $txbarang,
            'set_harga' => $txharga,
        );

        if ($this->db->update('penjualan', $update_data)) {
            $res['status'] = 'success';
            $res['msg'] = "Data berhasil diperbarui";
        } else {
            $res['status'] = 'error';
            $res['msg'] = "Gagal memperbarui data";
        }
        echo json_encode($res);
    
    }
    
}
