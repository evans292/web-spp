<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('User_model');
		$this->load->model('Role_model');
		$this->load->model('Menu_model');
		$this->load->model('Guru_model');
	}

	public function index()
	{	
		$data['title'] = 'Dashboard';
		$data['user'] = $this->User_model->showUserById();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function role()
	{	
		$data['title'] = 'Role';
		$data['user'] = $this->User_model->showUserById();
		$data['role'] = $this->Role_model->showAllRole();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
	}

	public function roleAccess($role_id)
	{	
		$data['title'] = 'Role';
		$data['user'] = $this->User_model->showUserById();
		$data['role'] = $this->Role_model->showRoleById($role_id);

		$this->db->where ('id !=', 1);
		$data['menu'] = $this->Menu_model->showAllMenu();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function hapusRole($id)
	{
		$this->Role_model->hapusRole($id);
		$this->session->set_flashdata('message', 'Hapus role');
        redirect('admin/role');
	}

	public function tambahRole()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->User_model->showUserById();
		$data['role'] = $this->Role_model->showAllRole();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Role_model->tambahRole();
			$this->session->set_flashdata('message', 'Tambah role');
          	redirect('admin/role');
		}
		
	}

	public function editRole()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->User_model->showUserById();
		$data['role'] = $this->Role_model->showAllRole();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Role_model->editRole();
			$this->session->set_flashdata('message', 'Edit role');
          	redirect('admin/role');
		}
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);
		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}
		
		$this->session->set_flashdata('message', 'Edit akses');
	}

	public function utama()
	{	
		$data['title'] = 'Data';
		$data['user'] = $this->User_model->showUserById();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar', $data);
		$this->load->view('data/index', $data);
		$this->load->view('templates/footer');
	}

    public function guru()
    {
        $data['title'] = 'Data Guru';
        $data['user'] = $this->User_model->showUserById();
        $data['guru'] = $this->Guru_model->showAllGuru();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('data/guru', $data);
        $this->load->view('templates/footer');
    }

    public function tambahGuru()
    {
        $data['title'] = 'Data Guru';
        $data['user'] = $this->User_model->showUserById();
        $data['guru'] = $this->Guru_model->showAllGuru();

        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('data/guru', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Guru_model->tambahGuru();
            $this->session->set_flashdata('message', 'Tambah guru');
            redirect('admin/guru'); 
        }
    }

    public function hapusGuru($id)
    {   
        $this->Guru_model->hapusGuru($id);
        $this->session->set_flashdata('message', 'Hapus guru');
        redirect('admin/guru'); 
    }

    public function editGuru()
    {
        $data['title'] = 'Data Guru';
        $data['user'] = $this->User_model->showUserById();
        $data['guru'] = $this->Guru_model->showAllGuru();

        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('data/guru', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Guru_model->editGuru();
            $this->session->set_flashdata('message', 'Edit guru');
            redirect('admin/guru'); 
        }
    }

    public function waliKelas()
    {
        $data['title'] = 'Data Wali Kelas';
        $data['user'] = $this->User_model->showUserById();
        $data['guru'] = $this->Guru_model->showAllGuru();
        $data['wali'] = $this->Guru_model->showWaliKelas();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('data/walikelas', $data);
        $this->load->view('templates/footer');
    }

    public function tambahWali()
    {
        $data['title'] = 'Data Wali Kelas';
        $data['user'] = $this->User_model->showUserById();
        $data['guru'] = $this->Guru_model->showAllGuru();
        $data['wali'] = $this->Guru_model->showWaliKelas();

        $this->form_validation->set_rules('nama', 'Nama', 'required'); 

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('data/walikelas', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Guru_model->tambahWali();
            $this->session->set_flashdata('message', 'Tambah Wali Kelas');
            redirect('admin/walikelas'); 
        }
    }

    public function editWali()
    {
        $data['title'] = 'Data Wali Kelas';
        $data['user'] = $this->User_model->showUserById();
        $data['guru'] = $this->Guru_model->showAllGuru();
        $data['wali'] = $this->Guru_model->showWaliKelas();

        $this->form_validation->set_rules('nama', 'Nama', 'required'); 

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('data/walikelas', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Guru_model->editWali();
            $this->session->set_flashdata('message', 'Edit Wali Kelas');
            redirect('admin/walikelas'); 
        }
	}
	
	public function siswa()
	{
		$data['title'] = 'Data Siswa';
        $data['user'] = $this->User_model->showUserById();
		$data['siswa'] = $this->Guru_model->showAllSiswa();
		$data['kelas'] = $this->Guru_model->showWaliKelas();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('data/siswa', $data);
        $this->load->view('templates/footer');
	}

	public function tambahSiswa()
	{	
		$this->form_validation->set_rules('nis', 'NIS', 'required|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');

		$bulanIndo = [
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'
		]; 

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Data Siswa';
			$data['user'] = $this->User_model->showUserById();
			$data['siswa'] = $this->Guru_model->showAllSiswa();
			$data['kelas'] = $this->Guru_model->showWaliKelas();
	
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('templates/topbar');
			$this->load->view('data/siswa', $data);
			$this->load->view('templates/footer');
		} else {
			$biaya = $this->input->post('biaya');
			$awaltempo = $this->input->post('tempo');
			$datadiri = [
				'nis' => htmlspecialchars($this->input->post('nis', true)),
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'kelas_id' => htmlspecialchars($this->input->post('kelas_id', true)),
				'tahunajaran' => htmlspecialchars($this->input->post('tahun', true)),
				'biaya' => htmlspecialchars($this->input->post('biaya', true))
			];
			$siswa = $this->db->insert('siswa', $datadiri);
			if ($siswa) {
				// ambil data siswa terakhir
				$query = "
					SELECT `id`, `nis`
					FROM `siswa`
					ORDER BY `id` DESC
					LIMIT 1
				";
				$ids = $this->db->query($query)->row_array();
				$idsiswa = $ids['id'];
				$nis = $ids['nis'];

				// membuat tagihan (12 bulan dimulai dari 2017 dan menyimpan tagihan di tabel spp)
				for ($i=0; $i < 12 ; $i++) { 
					// membuat tanggal jatuh temponya setiap tanggal 10
					$jatuhtempo = date("Y-m-d", strtotime("+$i month", strtotime($awaltempo)));

					$bulan = $bulanIndo[date('m', strtotime($jatuhtempo))] . " " . date('Y', strtotime($jatuhtempo));
					
					$result = [
						'nis_siswa' => $nis,
						'siswa_id' => $idsiswa,
						'jatuhtempo' => $jatuhtempo,
						'bulan' => $bulan,
						'jumlah' => $biaya
					];
					$this->db->insert('spp', $result);
				}
				$this->session->set_flashdata('message', 'Tambah Siswa');
            	redirect('admin/siswa'); 
			}
		}
	}

	public function editSiswa()
	{
		$this->form_validation->set_rules('nis', 'NIS', 'required|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Data Siswa';
			$data['user'] = $this->User_model->showUserById();
			$data['siswa'] = $this->Guru_model->showAllSiswa();
			$data['kelas'] = $this->Guru_model->showWaliKelas();
	
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('templates/topbar');
			$this->load->view('data/siswa', $data);
			$this->load->view('templates/footer');
	} else {
		$this->Guru_model->editSiswa();
		$this->session->set_flashdata('message', 'Edit Siswa');
		redirect('admin/siswa'); 
		}
	}

	public function hapusSiswa($id)
	{
		$this->Guru_model->hapusSiswa($id);
		$this->session->set_flashdata('message', 'Hapus Siswa');
		redirect('admin/siswa'); 
	}
}
