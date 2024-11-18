<?php
class M_login extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function check_login($username, $password) {
        $this->db->where('username', $username);
        // $query = $this->db->get('admin');

        $this->db->where('username', $username);
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            $admin = $query->row();
            if ($password === $admin->password) {
                $data = $query->row_array();
                return $data;
            } else {
                return 0;
            }
        }
        else {
            return 0;
        }
    }

}
?>
