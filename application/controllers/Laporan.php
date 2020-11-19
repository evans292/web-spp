<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
	{
		parent::__construct();	
		is_logged_in();
        $this->load->model('User_model', 'User');
        $this->load->model('Guru_model', 'Guru');
        $this->load->model('Transaksi_model', 'Transaksi');
	}

    public function index()
    {
        $data['title'] = 'Ekspor Laporan';
		$data['user'] = $this->User->showUserById();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar', $data);
		$this->load->view('laporan/index', $data);
		$this->load->view('templates/footer');
    }

    public function guru()
    {
        $data['title'] = 'Laporan Data Guru';
        $data['guru'] = $this->Guru->showAllGuru();
		$this->load->view('templates/header', $data);
        $this->load->view('laporan/guru', $data);
        $this->load->view('templates/footer', $data);
    }

    public function siswa()
    {
        $data['title'] = 'Laporan Data Siswa';
        $data['siswa'] = $this->Guru->showAllSiswa();
		$this->load->view('templates/header', $data);
        $this->load->view('laporan/siswa', $data);
        $this->load->view('templates/footer', $data);
    }

    public function pembayaran()
    {   
        $tgl1 = $this->input->get('tgl1');
        $tgl2 = $this->input->get('tgl2');

        $data['title'] = 'Laporan Pembayaran';
        $data['spp'] = $this->Transaksi->laporan($tgl1, $tgl2);
		$this->load->view('templates/header', $data);
        $this->load->view('laporan/spp', $data);
        $this->load->view('templates/footer', $data);
    }

}