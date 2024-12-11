<?php
class m_antrian extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_total_poli() {
        $this->db->select('COUNT(DISTINCT name_poli) as total_poli');
        $query = $this->db->get('poli');
        return $query->row()->total_poli;
    } 
    public function get_total_data_antrian(){
        $this->db->select('COUNT(DISTINCT nama_pasien) as total_pasien_data');
        $query = $this->db->get('pasien');
        return $query->row()->total_pasien_data;
    } 
}
?>
