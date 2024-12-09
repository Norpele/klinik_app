<?php
class m_poli extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_poli($data)
    {
        return $this->db->insert('supplier', $data);
    }

    public function get_poli_data()
    {
        $sql = "SELECT * FROM poli order by id_poli desc;";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_all_supplier()
    {
        return $this->db->get('supplier')->result();
    }


    public function delete_table($id)
    {
        $this->db->where('id_poli', $id);
        if ($this->db->delete('poli')) {
            return true;
        } else {
            return false;
        }
    }
}
