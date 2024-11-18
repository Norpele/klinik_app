<?php
class m_pemesan extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_produk($data) {
        return $this->db->insert('pemesanan', $data);
    }

    public function update_status($pesan_id, $data) {
        
        $this->db->where('pesan_id', $pesan_id);
        return $this->db->update('pemesanan', $data);
    }

    public function get_pemesan()
    {
        $sql = "SELECT * FROM pemesanan order by pesan_id desc;";
        $query = $this->db->query($sql);
            return $query->result();
    }

    public function update_pesan_status($pesan_id, $status) {
        $this->db->where('pesan_id', $pesan_id);
        return $this->db->update('pemesanan', ['pesan_status' => $status]); 
    }
    public function getUserByEmail($email)
{
    return $this->db->where('email', $email)->get('user')->row();
}


public function getTransaksi()
{
    $id_user = $this->session->userdata('id_user');
    $this->db->where('pesan_id_user',$id_user); 
    $query = $this->db->get('pemesanan'); 

    return $query->result();
}

}
?>
