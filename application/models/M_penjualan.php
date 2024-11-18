<?php
class M_penjualan extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
        public function load_tabel_penjualan(){
            $sql = "SELECT * FROM penjualan
        JOIN barang on namaBarang = nama_barang
        ORDER BY id_penjualan DESC"; 
        $query = $this->db->query($sql);
        return $query->result();
        }
        
        
}
?>
