<?php
class M_register extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_user($data)
    {
        return $this->db->insert('user', $data);
    }

    public function is_email_exist($email)
{
    $this->db->where('email', $email);
    $query = $this->db->get('user'); 

    return $query->num_rows() > 0;
}

}