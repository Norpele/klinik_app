<?php
class M_dashboard extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk menghitung jumlah jenis barang berdasarkan nama_barang yang unik
    public function get_jumlah_jenis_barang() {
        $this->db->select('COUNT(DISTINCT namaBarang) as total_barang');
        $query = $this->db->get('barang');
        return $query->row()->total_barang; // Mengembalikan hasil jumlah jenis barang
    }

    public function get_total_pengeluaran() {
        $this->db->select('SUM(totalHarga) as total_pengeluaran');
        $query = $this->db->get('barang');
        return $query->row()->total_pengeluaran; 
    }
    public function get_total_pendapatan() {
        $this->db->select('SUM(total_harga) as total_pendapatan');
        $query = $this->db->get('pemesanan_detail');  
        return $query->row()->total_pendapatan; 
    }
    
    
    
    
    
}
?>
