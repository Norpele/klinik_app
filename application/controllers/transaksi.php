<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_pemesanan'); 
	}
	

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function transactionDetail($transaction)
{
    $data['transaksi'] = $this->m_pemesanan->getTransaksiByTransaksi($transaction);

    $data['transaksi_detail'] = $this->m_pemesanan->getTransaksiByTransaksiId($transaction);

    $data['js'] = 'pembeli';

    $this->load->view('header_user');
    $this->load->view('history_detail/v_history_detail', $data);
    $this->load->view('footer', $data);
}
}
