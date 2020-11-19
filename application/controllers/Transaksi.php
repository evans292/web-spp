<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		is_logged_in();
		$this->load->model('User_model', 'User');
		$this->load->model('Transaksi_model', 'Transaksi');
		$this->load->model('Guru_model', 'Guru');
	}

	public function index()
	{	
		$data['title'] = 'Entri Transaksi';
		$data['user'] =  $this->User->showUserById();
		$data['siswa'] = $this->Transaksi->cariSiswa();
		$data['spp'] = $this->Transaksi->cari();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar', $data);
		$this->load->view('transaksi/index', $data);
		$this->load->view('templates/footer');
	}

	public function bayar($nis, $act, $id)
	{	
		$this->Transaksi->bayar($nis, $act, $id);
		if ($act == 'bayar') {
			$this->session->set_flashdata('message', 'Bayar spp');
		} else if ($act == 'batal') {
			$this->session->set_flashdata('message', 'Pembatalan bayar');
		} 
		redirect("transaksi?key=$nis&cari=");
	}

	public function slip($nis, $id)
	{
		$data['title'] = 'Slip Transaksi';
		$data['slip'] = $this->Transaksi->slipSiswa($nis);
		$data['spp'] = $this->Transaksi->slip($id);

		$this->load->view('templates/header', $data);
		$this->load->view('laporan/slip', $data);
		$this->load->view('templates/footer');
	}

	public function siswa()
	{
		$data['title'] = 'Data Siswa';
        $data['user'] = $this->User->showUserById();
		$data['siswa'] = $this->Guru->showAllSiswa();
		$data['kelas'] = $this->Guru->showWaliKelas();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('data/siswa', $data);
        $this->load->view('templates/footer');
	}

	public function riwayat()
	{	
		$data['title'] = 'Riwayat Pembayaran';
		$data['user'] =  $this->User->showUserById();
		$data['spp'] = $this->Transaksi->cariRiwayat();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar', $data);
		$this->load->view('transaksi/riwayat', $data);
		$this->load->view('templates/footer');
	}

}