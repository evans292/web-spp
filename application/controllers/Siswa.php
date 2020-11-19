<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Transaksi_model', 'Transaksi');
	}

	public function index()
	{	
		$nama = $this->session->userdata('name');

		$data['title'] = 'Riwayat Pembayaran';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['spp'] = $this->Transaksi->riwayat($nama);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar', $data);
		$this->load->view('siswa/index', $data);
		$this->load->view('templates/footer');
	}

}