<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
	 	parent::__construct();
	 	$this->load->library('form_validation');
	}

	public function index()
	{	
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');


		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('templates/auth-header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth-footer');
		} else {
			$this->_login();
		}

	}

	private function _login()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		
		// user ada
		if ($user) {
		  // jika user active
		   if ($user['is_active'] == 1) {
				// cek password
		   		if (password_verify($pass, $user['password'])) {
		   			// lengkap semua
		   			$data = [
						'name' => $user['name'],
		   				'email' => $user['email'],
		   				'role_id' => $user['role_id']
		   			];
					   $this->session->set_userdata($data);
					   redirect('user');
		   			// if ($user['role_id'] == 1) {
		   			// 	redirect('admin');
		   			// } else {
		   			// 	redirect('user');
		   			// }
		   		} else {
		   		// password salah
	   			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				 Password salah!
				</div>');
				redirect('auth');
		   		}
		 	} else {
		 	// email belum aktif
	 		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			 Email belum diaktifkan!
			</div>');
			redirect('auth');
		 	}
		} else {
		// user tidak ada
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			 Email belum terdaftar!
			</div>');
		redirect('auth');
		}
	}

	public function register()
	{	
		$this->form_validation->set_rules('nis', 'NIS', 'required|numeric');
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
				'required' => 'Password empty!',
				'matches' => 'Password dont match!',
				'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');

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
			$data['title'] = 'Register';
			$data['kelas'] = $this->db->get('wali_kelas')->result_array();
			$this->load->view('templates/auth-header', $data);
			$this->load->view('auth/registration',$data);
			$this->load->view('templates/auth-footer');
		} else {
			$biaya = $this->input->post('biaya');
			$awaltempo = $this->input->post('tempo');
			$datadiri = [
				'nis' => htmlspecialchars($this->input->post('nis', true)),
				'nama' => htmlspecialchars($this->input->post('name', true)),
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

				$email = $this->input->post('email', true);
				$data = [
					'name' => htmlspecialchars($this->input->post('name', true)),
					'email' => htmlspecialchars($email),
					'image' => 'default.jpg',
					'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'role_id' => 3,
					'is_active' => 0,
					'date_created' => time()
				];
	
				// siapkan token
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];
	
				$this->db->insert('user', $data);
				$this->db->insert('user_token', $user_token);
	
				$this->_sendEmail($token, 'verify');
	
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					 Selamat! akunmu telah dibuat. Segera aktifkan akunnya
					</div>');
				redirect('auth');

			}
		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'tubagusgf29@gmail.com',
			'smtp_pass' => 'otakugamer',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('tubagusgf29@gmail.com', 'Tubagus Gusti Fauzy');
		$this->email->to($this->input->post('email'));
		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Klik link ini untuk verifikasi akun mu <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifkan</a>. Setelah 24 jam link akan kadaluwarsa');
		} else if($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Klik link ini untuk reset password mu <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->db->delete('user_token', ['email' => $email]);
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
					Aktivasi akun berhasil! Silahkan login.
					</div>');
					redirect('auth');
				} else {
				$this->db->delete('user', ['email' => $email]);
				$this->db->delete('user_token', ['email' => $email]);

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Aktivasi akun gagal! Token kadaluwarsa.
				</div>');
				redirect('auth');
				}
			} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Aktivasi akun gagal! Token salah.
			</div>');
			redirect('auth');
			}
		} else {
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Aktivasi akun gagal! Email salah.
		</div>');
		redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				 Anda telah keluar
				</div>');
		redirect('auth');
	}

	public function blocked()
	{	
		$this->load->view('auth/404');
	}

	public function forgotPassword()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Forgot Password';
			$this->load->view('templates/auth-header', $data);
			$this->load->view('auth/forgot-password');
			$this->load->view('templates/auth-footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1]);

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Silahkan cek email anda untuk reset password!
			</div>');
			redirect('auth/forgotpassword');
			} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Email belum terdaftar atau terverifikasi!
			</div>');
			redirect('auth/forgotpassword');
			}
		}
	}

	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			Reset password gagal! Token salah.
			</div>');
			redirect('auth/forgotpassword');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
				Reset password gagal! Email salah.
			</div>');
			redirect('auth/forgotpassword');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}
		
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password1]');
		$this->form_validation->set_rules('password1', 'Repeat Password', 'required|trim|min_length[3]|matches[password]');
			if ($this->form_validation->run() == false) {
				$data['title'] = 'Change Password';
				$this->load->view('templates/auth-header', $data);
				$this->load->view('auth/change-password');
				$this->load->view('templates/auth-footer');
			} else {
				$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				$email = $this->session->userdata('reset_email');

				$this->db->set('password', $password);
				$this->db->where('email', $email);
				$this->db->update('user');

				$this->db->delete('user_token', ['email' => $email]);
				$this->session->unset_userdata('reset_email');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Reset password berhasil! Silahkan login.
				</div>');
				redirect('auth');
			}
			
	}
}