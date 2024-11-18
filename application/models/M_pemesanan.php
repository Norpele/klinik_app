<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pemesanan extends CI_Model {
    
    public function insertOrderDetail($data) {
        return $this->db->insert('pemesanan_detail', $data);
    }
    public function insertOrderPerson($data) {
        $this->db->insert('pemesanan', $data);
        return $this->db->insert_id('pemesanan');
    }

    public function getOrderById($order_id)
    {
        $this->db->where('pesan_id', $order_id);
        return $this->db->get('pemesanan')->row();
    }

    public function getOrderDetailsByOrderId($order_id)
    {
        $this->db->where('pesandet_pesan_id', $order_id);
        return $this->db->get('pemesanan_detail')->result();
    }
    public function getTransaksiByTransaksi($transaction)
    {
        $this->db->where('pesan_id', $transaction);
        return $this->db->get('pemesanan')->row();
    }

    public function getTransaksiByTransaksiId($pesan_detail_id)
{
    $this->db->where('pesandet_pesan_id', $pesan_detail_id);
    return $this->db->get('pemesanan_detail')->result(); 
}

    
}
