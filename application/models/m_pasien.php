<?php
class m_pasien extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_pasien_data()
    {
        $sql = "SELECT * FROM pasien order by id_pasien desc;";
        $query = $this->db->query($sql);
        return $query->result();
    }
}
