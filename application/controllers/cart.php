<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model(array('m_barang', 'm_pemesanan', 'm_pemesan'));
    }

    public function index()
    {
        $data['cart_items'] = $this->cart->contents();
        $data['js'] = 'cart';
        $this->load->view('header_user');
        $this->load->view('cart/v_cart', $data);
        $this->load->view('footer', $data);
    }

    public function remove($rowid)
    {
        $this->cart->remove($rowid);
        redirect('cart');
    }

    public function update()
    {
        $cart_info = $_POST['cart'];
        foreach ($cart_info as $item) {
            $this->cart->update(array(
                'rowid' => $item['rowid'],
                'qty'   => $item['qty']
            ));
        }
        redirect('cart');
    }

    public function saveOrder()
{
    $transaction_date = $this->input->post('transaction_date');
    $username = $this->input->post('username');
    $email = $this->input->post('email');
    $shipping_address = $this->input->post('shipping_address');

    $user = $this->m_pemesan->getUserByEmail($email);
    
    if ($user) {
        $pesan_id_user = $user->id_user;

        $order_data = [
            'tanggal' => $transaction_date,
            'pesan_id_user' => $pesan_id_user,
            'username' => $username,
            'email' => $email,
            'alamat' => $shipping_address,
            'no_transaksi' => $this->noTransaksi(),
            'pesan_status' => 0,
        ];

        // Simpan data order
        $order_id = $this->m_pemesanan->insertOrderPerson($order_data);

        // Jika order berhasil disimpan, lanjutkan ke detail pemesanan
        if ($order_id) {
            // Ambil data array dari cart
            $product_id = $this->input->post('product_id');
            $product_names = $this->input->post('product_name');
            $quantities = $this->input->post('qty');
            $subtotals = $this->input->post('subtotal');
            
            // Simpan setiap item cart ke dalam tabel pemesanan_detail
            for ($i = 0; $i < count($product_names); $i++) {
                $data = [
                    'pesandet_id_barang' => $product_id[$i],
                    'pesandet_pesan_id' => $order_id,
                    'produk' => $product_names[$i],
                    'jumlah_barang' => $quantities[$i],
                    'total_harga' => $subtotals[$i],
                ];

                $this->m_pemesanan->insertOrderDetail($data);

                // Kurangi stok barang
                $this->reduceStock($product_id[$i], $quantities[$i]);
            }

            $this->session->set_flashdata('message', 'Order berhasil disimpan!');
            redirect('cart/transactionDetail/' . $order_id); // Redirect ke halaman detail transaksi
        } else {
            $this->session->set_flashdata('message', 'Gagal menyimpan order.');
            redirect('cart');
        }
    } else {
        $this->session->set_flashdata('message', 'User tidak ditemukan.');
        redirect('cart');
    }
}


    public function reduceStock($product_name, $quantity)
{
    // Ambil stok barang saat ini berdasarkan nama barang
    $this->db->where('namaBarang', $product_name);
    $barang = $this->db->get('barang')->row();

    if ($barang) {
        $new_stock = $barang->stockBarang - $quantity; //mengurangi stock

        if ($new_stock < 0) {
            $new_stock = 0; // Hindari stok negatif
        }

        // Update stok barang di database
        $this->db->where('id_barang', $barang->id_barang);
        $this->db->update('barang', ['stockBarang' => $new_stock]);
    }
}

 public function noTransaksi(){
    $sql = "SELECT IFNULL(
        (
                SELECT 	concat('TRX/', 
                                DATE_FORMAT( date(now()) ,'%m%y'),'/',
                                RIGHT(concat('000',RIGHT(no_transaksi,3)+1),3))
                FROM pemesanan
                WHERE no_transaksi like concat('TRX/',
                                DATE_FORMAT( date(now()) ,'%m%y'),'/','%')
                                AND DATE_FORMAT(tanggal  ,'%Y%m')=DATE_FORMAT( date(now()) ,'%Y%m')
                ORDER BY RIGHT(no_transaksi,3) DESC LIMIT 1
        ),
        (
                SELECT	concat('TRX/',
                                DATE_FORMAT(date(now()) ,'%m%y'),'/001')
                
        )
        ) no_trans";

    $no_trans = $this->db->query($sql)->row()->no_trans;
    return $no_trans;
 }

 public function transactionDetail($order_id)
{
    $data['order'] = $this->m_pemesanan->getOrderById($order_id);

    $data['order_details'] = $this->m_pemesanan->getOrderDetailsByOrderId($order_id);

    $data['js'] = 'pembeli';
    
    $this->load->view('header_user');
    $this->load->view('transaction/v_transaction', $data);
    $this->load->view('footer', $data);
}

//ongkir

function get_api($link, $method, $data=null){
    $ch = curl_init();
    // Set the URL
    curl_setopt($ch, CURLOPT_URL, $link);

    // Set headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));

    // Set POST method
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    // Set POST data
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Return response instead of outputting it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Optional: Disable SSL verification for localhost testing (not recommended for production)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // Set timeout to 30 seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        $res = 'Error: ' . curl_error($ch);
    } else {
        // Get HTTP status code and response
        $res = $response;
    }

    // Close the cURL session
    curl_close($ch);

    return (object) json_decode($res,true);
}

function list_provinsi(){
    $link = "https://info.my.id/api/list_provinsi";
    $res = $this->get_api($link, 'POST');
    echo json_encode($res);
}

function list_kota(){
    $link = "https://info.my.id/api/list_kota";
            $post= json_encode([
        "prov" => $this->input->post('prov')
    ]);
    $res = $this->get_api($link, 'POST', $post);
    echo json_encode($res);
}

function list_kecamatan(){
    $link = "https://info.my.id/api/list_kecamatan";
            $post= json_encode([
        "kota" => $this->input->post('kota')
    ]);
    $res = $this->get_api($link, 'POST', $post);
    echo json_encode($res);
}

function cek_ongkir(){
    $link = "https://info.my.id/api/cek_ongkir";
            $post= json_encode([
        "kec_asal" => 6162,  //$this->input->post('kec_asal'),
        "kec_tujuan" => $this->input->post('kec_tujuan'),
        "kurir" => $this->input->post('kurir')
    ]);
    $res = $this->get_api($link, 'POST', $post);
    echo json_encode($res);
}



}
