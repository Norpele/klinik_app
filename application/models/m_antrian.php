<?php
class m_antrian extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_data_antrian($id_poli = null) {
        $sql = "SELECT * FROM antrian
                JOIN pasien ON antrian.Pasien_id = pasien.id_pasien
                JOIN poli ON antrian.Poli_id = poli.id_poli
                WHERE antrian.status_antri IN (1, 2, 3)";
    
        if ($id_poli) {
            $sql .= " AND antrian.Poli_id = ?";
            $query = $this->db->query($sql, [$id_poli]);
        } else {
            $sql .= " ORDER BY antrian.id_antrian DESC";
            $query = $this->db->query($sql);
        }
    
        return $query->result();
    }

    public function update_status($id_pasien, $nomor_antrian, $status_antri) {

        $this->db->where('Pasien_id', $id_pasien);
        $this->db->where('nomor_antrian', $nomor_antrian);
        $this->db->update('antrian', ['status_antri' => $status_antri]);
    
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false; 
    }
    
    public function cek_antrian_aktif($id_pasien) {
        $this->db->where('Pasien_id', $id_pasien);
        $this->db->where_in('status_antri', [1, 2]); 
        $query = $this->db->get('antrian');
        return $query->num_rows() > 0;
    }
    
    public function get_next_nomor_antrian($poli) {
        $this->db->select('COALESCE(MAX(nomor_antrian) + 1, 1) as nomor_antrian');
        $this->db->from('antrian');
        $this->db->where('Poli_id', $poli);
        $this->db->where('tanggal', date('Y-m-d')); 
        $query = $this->db->get();
    
        return $query->row()->nomor_antrian;
    }

    public function get_pasien_data_antrian() {
        $sql = "SELECT * FROM pasien ORDER BY id_pasien";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_nomor_unik_pasien($id_pasien) { 
        $this->db->select('no_unik_pasien'); 
        $this->db->from('pasien');
        $this->db->where('id_pasien', $id_pasien); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) { 
        return $query->row()->no_unik_pasien; 
    } else { 
        return false; 
    } 
}   
    
}
?>
