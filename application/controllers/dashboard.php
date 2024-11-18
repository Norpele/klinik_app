<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Proteksi agar hanya bisa diakses jika sudah login
       

        // Memuat model m_dashboard
        $this->load->model('m_dashboard');
    }

	public function index() {
        // Mendapatkan data dari model
        $data['jumlah_jenis_barang'] = $this->m_dashboard->get_jumlah_jenis_barang();
        $data['total_pengeluaran'] = $this->m_dashboard->get_total_pengeluaran();

        $data['title'] = 'Dashboard';
        $data['js'] = 'dashboard';
        if (!$this->session->userdata('nama_pengguna')) {
            redirect('regAcc'); // Redirect ke halaman login
        }else{
            $this->load->view('header_ds', $data);
        $this->load->view('main/v_index.php', $data); // Kirim data ke view
        $this->load->view('footer', $data);
    }
    }

    public function cekTransaksi(){
        $id_user = $this->session->userdata('id_user');
        $sql = "SELECT * FROM pemesanan WHERE pesan_status = 1 AND pesan_id_user = $id_user";
        $get_transaksi = $this->db->query($sql)->num_rows();
        $res['salam'] = $get_transaksi;
        echo json_encode($res);
    }

}
?>
