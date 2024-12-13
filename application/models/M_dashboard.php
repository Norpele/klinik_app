<?php
class m_dashboard extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_total_poli() {
        $this->db->select('COUNT(DISTINCT name_poli) as total_poli');
        $query = $this->db->get('poli');
        return $query->row()->total_poli;
    } 
    public function get_total_data_pasien(){
        $this->db->select('COUNT(DISTINCT nama_pasien) as total_pasien_data');
        $query = $this->db->get('pasien');
        return $query->row()->total_pasien_data;
    }
    
    public function get_total_data_antrian() {
        $this->db->select_max('tanggal');
        $query_max = $this->db->get('antrian')->row();
        $tanggal_terbaru = $query_max->tanggal;
    
        $this->db->select('COUNT(DISTINCT pasien.nama_pasien) as total_pasien_data');
        $this->db->from('antrian');
        $this->db->join('pasien', 'antrian.Pasien_id = pasien.id_pasien');
        $this->db->where('antrian.tanggal', $tanggal_terbaru);
        $this->db->where_in('antrian.status_antri', [1, 2]);
        $query = $this->db->get();
    
        return $query->row()->total_pasien_data ?? 0;
    }
    
}
?>
