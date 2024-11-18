<?php
class M_produk extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_produk($data)
    {
        return $this->db->insert('barang', $data);
    }

    public function get_produk_data()
    {
        $sql = "SELECT * FROM barang
        JOIN kategori on id_kategori = kategori_barang
        ORDER BY id_barang ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_barang_with_kategori() {
        $this->db->select('barang.*, kategori.nama_kategori');
        $this->db->from('barang');
        $this->db->join('kategori', 'barang.kategori_barang = kategori.id_kategori', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function get_produk_data2()
    {
        $sql = "SELECT * FROM barang
        JOIN kategori on id_kategori = kategori_barang
        left join penjualan on nama_barang = namaBarang
        where isnull(id_penjualan)
        ORDER BY id_barang ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    // Di dalam model m_barang
    public function get_barang_by_kategori($kategori_id)
    {
        $this->db->where('kategori_barang', $kategori_id);
        $query = $this->db->get('barang');
        return $query->result();
    }


    public function get_produk_by_id($id)
    {
        $this->db->where('id_barang', $id);
        $query = $this->db->get('barang');
        return $query->row(); // Fetch a single row
    }

    public function update_produk($id, $data)
    {
        $this->db->where('id_barang', $id);
        return $this->db->update('barang', $data);
    }

    public function get_selected_suppliers($id_barang)
    {
        $this->db->select('id_supplier');
        $this->db->from('barangdetail');
        $this->db->where('id_barang', $id_barang);
        $result = $this->db->get()->result_array();

        return array_column($result, 'id_supplier');
    }


    public function delete_table($id)
    {
        $this->db->where('id_barang', $id);
        if ($this->db->delete('barang')) {
            return true;
        } else {
            return false;
        }
    }
}
