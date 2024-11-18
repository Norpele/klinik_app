<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load the model
        $this->load->model(array('m_produk', 'm_kategori', 'm_supplier'));
        $this->load->helper(array('form', 'url')); 
        $this->load->helper('breadcrumbs');
        $this->load->library('session');
    }

   
    public function index() {
        $data['title'] = 'manajemen produk';
        $data['produk'] = $this->m_produk->get_produk_data();
        $data['js'] = 'produk';

        $this->load->view('header_ds',$data);
        $this->load->view('barang/v_barang', $data);
        $this->load->view('footer', $data);
    }

    public function load_data() {
        $data['produk'] = $this->m_produk->get_produk_data();
        echo json_encode($data);
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

            $namaBarang = $this->input->post('txnama');
            $deskripsiBarang = $this->input->post('txdeskripsi');
            $kategori = $this->input->post('txkategori');
            $hargaBarang = $this->input->post('txharga');
            $stockBarang = $this->input->post('txstock');
            $totalharga = $this->input->post('txtotal');

            $save_data = array(
                'namaBarang' => $namaBarang,
                'deskripsi' => $deskripsiBarang,
                'kategori_barang' => $kategori,
                'hargaBarang' => $hargaBarang,
                'stockBarang' => $stockBarang,
                'foto' => $file_name,
                'totalHarga' => $totalharga
            );

            $insert_id = $this->m_produk->insert_produk($save_data);
            
            if ($insert_id) {
                echo json_encode(array('status' => 'success', 'msg' => 'Barang berhasil ditambahkan.'));
            } else {
                echo json_encode(array('status' => 'error', 'msg' => 'Gagal menyimpan data barang.'));
            }
        }
    }

    public function edit_table()
    {
        $id = $this->input->post('id');
        $sql = $this->db->query("SELECT * FROM barang WHERE id_barang = ?", array($id));
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

    public function update_table() {
        $id = $this->input->post('id');
        $namaBarang = $this->input->post('txnama');
        $deskripsiBarang = $this->input->post('txdeskripsi');
        $kategori = $this->input->post('txkategori');
        $hargaBarang = $this->input->post('txharga');
        $stockBarang = $this->input->post('txstock');
        $totalharga = $this->input->post('txtotal');
        
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;
    
        $this->load->library('upload', $config);
    
        // Cek apakah ada gambar yang diunggah
        if ($this->upload->do_upload('tximg')) {
            // Hapus foto lama
            $barang = $this->m_produk->get_produk_by_id($id); // Ambil data barang berdasarkan ID
            if ($barang && !empty($barang->foto)) {
                $file_path = './uploads/' . $barang->foto;
                if (file_exists($file_path) && !is_dir($file_path)) {
                    unlink($file_path); // Hapus file foto lama
                }
            }
            
            // Simpan nama file baru
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
        } else {
            // Jika tidak ada foto baru, tetap gunakan foto lama
            $file_name = $this->input->post('foto_lama');
        }
    
        // Simpan data baru
        $update_data = array(
            'namaBarang' => $namaBarang,
            'deskripsi' => $deskripsiBarang,
            'kategori_barang' => $kategori,
            'hargaBarang' => $hargaBarang,
            'stockBarang' => $stockBarang,
            'foto' => $file_name,
            'totalHarga' => $totalharga
        );
    
        $result = $this->m_produk->update_produk($id, $update_data);
    
        if ($result) {
            echo json_encode(array('status' => 'success', 'msg' => 'Barang berhasil diupdate.'));
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'Gagal mengupdate barang.'));
        }
    }
    
    
	public function delete_table()
    {
        if ($this->m_produk->delete_table($this->input->post("id"))) {
            $res['status'] = 'success';
            $res['msg'] = 'Data Berhasil dihapus';
        } else {
            $res['status'] = 'error';
            $res['msg'] = 'Data Gagagl dihapus';
        }
        echo json_encode($res);
    }
    public function load_Kategori()
    {
        $res['data_kategori'] = $this->m_kategori->get_kategori_data();
        echo json_encode($res);
    }
    public function load_supplier()
    {
        $res['data_supplier'] = $this->m_supplier->get_supplier_data();
        echo json_encode($res);
    }

    public function get_suppliers() {
        $id_barang = $this->input->post('id_barang');
    
        // Dapatkan daftar semua supplier
        $this->load->model('m_supplier');
        $suppliers = $this->m_supplier->get_all_supplier();
    
        // Cek supplier mana saja yang sudah dipilih untuk produk ini
        $this->load->model('m_produk');
        $selected_suppliers = $this->m_produk->get_selected_suppliers($id_barang);
    
        // Tandai supplier yang sudah dipilih
        foreach ($suppliers as &$supplier) {
            $supplier->is_selected = in_array($supplier->id_supplier, $selected_suppliers);
        }
    
        // Kembalikan data dalam format JSON
        echo json_encode(['suppliers' => $suppliers]);
    }
    
    public function save_suppliers() {
        $id_barang = $this->input->post('id_barang');
        $suppliers = $this->input->post('suppliers'); // Array supplier yang dipilih
    
        // Hapus supplier lama
        $this->db->delete('barangdetail', ['id_barang' => $id_barang]);
    
        // Simpan supplier baru ke tabel barangdetail
        foreach ($suppliers as $id_supplier) {
            $data = [
                'id_barang' => $id_barang,
                'id_supplier' => $id_supplier
            ];
            $this->db->insert('barangdetail', $data);
        }
    
        // Kirim respon sukses
        echo json_encode(['success' => true]);
    }
    


}
