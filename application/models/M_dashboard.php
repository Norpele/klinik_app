<?php
class M_dashboard extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function total_poli() {
        $this->db->select('COUNT(DISTINCT name_poli) as total_poli');
        $query = $this->db->get('poli');
        return $query->row()->total_poli;
    }  
}
?>
