<?php
class m_poli extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_poli_data()
    {
        $sql = "SELECT * FROM poli order by id_poli desc;";
        $query = $this->db->query($sql);
        return $query->result();
    }
}
