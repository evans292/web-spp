<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index()
	{	
		$data['title'] = 'User Profile';
		$data['user'] = $this->User_model->showUserById();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{	
		$data['title'] = 'Edit Profil';
		$data['user'] = $this->User_model->showUserById();

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');

			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpeg|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['user']['image'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profile/'. $old_image);
					}
					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}
			
			$this->db->set('name', $nama);
			$this->db->where('email', $email);
			$this->db->update('user');
			$this->session->set_flashdata('message', 'Ubah profil');
			redirect('user');

		}
	}

	public function changePass()
	{	
		$data['title'] = 'Ubah Password';
		$data['user'] = $this->User_model->showUserById();
		$this->form_validation->set_rules('password1', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('password2', 'New Password', 'required|trim|min_length[3]|matches[password3]');
		$this->form_validation->set_rules('password3', 'Repeat Password', 'required|trim|min_length[3]|matches[password2]');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/changepass', $data);
			$this->load->view('templates/footer');
		} else {
			$current_pass = $this->input->post('password1');
			$new_pass = $this->input->post('password2');

			if (!password_verify($current_pass, $data['user']['password'])) {
			$this->session->set_flashdata('flash', 'Ubah password');
			redirect('user/changepass');
			} else {
				if ($current_pass == $new_pass) {
					$this->session->set_flashdata('flash', 'Ubah password');
					redirect('user/changepass');
				} else {
					// password ok
					$password_hash = password_hash($new_pass, PASSWORD_DEFAULT);
					$this->User_model->editPass($password_hash);

					$this->session->set_flashdata('message', 'Ubah password');
					redirect('user');
				}
			}
		}
		
	}


}