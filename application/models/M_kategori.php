<?php
class M_kategori extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        
    }

    public function insert_kategori($data) {
        return $this->db->insert('kategori', $data);
    }

    public function get_kategori_data() {
        $sql = "SELECT * FROM kategori order by id_kategori desc;";
        $query = $this->db->query($sql);
            return $query->result();
    }
    
    public function delete_table($id)
    {
        $this->db->where('id_kategori', $id);
        if ($this->db->delete('kategori')) {
            return true;
        } else {
            return false;
        }
    }
}
?>