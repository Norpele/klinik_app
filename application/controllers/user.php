<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('m_barang', 'm_penjualan');
    }

    public function index() {
        $id_kategori = $this->input->get('kategori'); 
        $data['barang'] = $this->m_barang->get_barang_data($id_kategori); 
        // $data['barang'] = $this->m_barang->get_barang_data();
        $data['js'] = 'user';
        
        // Memuat view dan mengirimkan data barang
        $this->load->view('header_user');
        $this->load->view('user/v_user', $data);
        $this->load->view('footer',$data);
    }

    public function load_kategori() {
        $kategori = $this->m_barang->get_kategori_data();
        echo json_encode(['load_kategori' => $kategori]);
    }

    public function search_barang() {
        $keyword = $this->input->get('keyword');
        $this->load->model('m_barang'); 
        $result = $this->m_barang->search_barang($keyword);
        echo json_encode(['result' => $result]);
    } 
    
    public function add_to_cart($id) {
        $barang = $this->m_barang->find_harga($id);  // Mengambil data barang termasuk harga
        $stock = $this->m_barang->check_stock($id);  // Mengambil stok barang dari database
    
        // Cek jumlah barang dalam keranjang
        $cart_item = $this->cart->contents();
        $current_qty = 0;
    
        foreach ($cart_item as $item) {
            if ($item['id'] == $barang->id_barang) {
                $current_qty = $item['qty'];
                break;
            }
        }
    
        // Jika jumlah yang ingin ditambahkan melebihi stok, arahkan kembali dengan pesan kesalahan
        if ($current_qty + 1 > $stock) {
            $this->session->set_flashdata('error', 'Jumlah yang ingin ditambahkan melebihi stok tersedia.');
            redirect('user');
            return;
        }
    
        $data = array(
            'id' => $barang->id_barang,
            'qty' => 1,
            'price' => $barang->set_harga,
            'name' => $barang->namaBarang,
            'stockBarang' => $stock  // Menambahkan stok barang ke dalam array
        );
    
        $this->cart->insert($data);  // Menambahkan item ke keranjang
        redirect('user');
    }
    
}
