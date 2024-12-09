<?php
class M_supplier extends CI_Model
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

    public function get_supplier_data()
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
        $this->db->where('id_supplier', $id);
        if ($this->db->delete('supplier')) {
            return true;
        } else {
            return false;
        }
    }
}
