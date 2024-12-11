<?php
class M_barang extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_barang($data) {
        return $this->db->insert('barang', $data);
    }

    public function get_barang_data($kategori = null) {
        $this->db->select('barang.*, penjualan.set_harga, kategori.kategoriBarang kat');
        $this->db->from('barang');
        $this->db->join('penjualan', 'barang.namaBarang = penjualan.nama_barang', 'left');
        $this->db->join('kategori', 'barang.kategori_barang = kategori.id_kategori');
    
        // Jika kategori dipilih, tambahkan filter
        if ($kategori) {
            $this->db->where('kategori.kategoriBarang', $kategori);
        }
    
        $this->db->order_by('barang.id_barang', 'desc');
        return $this->db->get()->result_array();
    }


        public function search_barang($keyword) {
            $this->db->like('nama_barang', $keyword);
            $query = $this->db->get('penjualan');
            return $query->result_array();
        }
    
    
    public function get_kategori_data() {
        $sql = "SELECT * FROM kategori order by id_kategori desc;";
        $query = $this->db->query($sql);
            return $query->result();
    }
    

    public function kategori($id_kategori){
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->where('id_kategori', $id_kategori);
        
        return $this->db->get()->row();
    }
    public function delete_data($id) {
        $sql = "UPDATE barang WHERE id_barang = '$id'";
        return $this->db->query($sql, array($id));
    }

    public function find($id)
    {
        $result = $this->db->where('id_barang', $id)->limit(1)->get('barang');
        if($result->num_rows()>0){
            return $result->row();
        }else{
            return array();
        }
    }
    public function check_stock($id) {
        $this->db->select('stockBarang');  // Mengambil field stok
        $this->db->from('barang');
        $this->db->where('id_barang', $id);
        $result = $this->db->get();
    
        if ($result->num_rows() > 0) {
            return $result->row()->stockBarang;  // Pastikan field yang diambil benar
        } else {
            return 0;
        }
    }
    

    public function find_harga($id){
        $sql = "SELECT * FROM `barang` JOIN `penjualan` on nama_barang = namaBarang  WHERE id_barang = '{$id}'";
        $result = $this->db->query($sql);
        if($result->num_rows()>0){
            return $result->row();
        }else{
            return array();
        }
    }

    
}
?>
