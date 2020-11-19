<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model');
        $this->load->model('Menu_model');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->User_model->showUserById();
        $data['menu'] = $this->Menu_model->showAllMenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {   
        $data['title'] = 'Menu Management';
        $data['user'] = $this->User_model->showUserById();
        $data['menu'] = $this->Menu_model->showAllMenu();
        
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Menu_model->tambah();
            $this->session->set_flashdata('message', 'Tambah menu');
            redirect('menu'); 
        }
    }

    public function hapus($id)
    {
        $this->Menu_model->hapus($id);
        $this->session->set_flashdata('message', 'Hapus menu');
        redirect('menu');
    }

    public function edit()
    {   
        $data['title'] = 'Menu Management';
        $data['user'] = $this->User_model->showUserById();
        $data['menu'] = $this->Menu_model->showAllMenu();
    
        $id = $this->input->post('id');
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Menu_model->edit($id);
            $this->session->set_flashdata('message', 'Edit menu');
            redirect('menu'); 
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->User_model->showUserById();
        $data['menu'] = $this->Menu_model->showAllMenu();
        $data['submenu'] = $this->Menu_model->showAllSubmenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/footer');
    }

    public function tambahsub()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->User_model->showUserById();
        $data['menu'] = $this->Menu_model->showAllMenu();
        $data['submenu'] = $this->Menu_model->showAllSubmenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer'); 
        } else {
            $this->Menu_model->tambahSub();
            $this->session->set_flashdata('message', 'Tambah submenu');
            redirect('menu/submenu'); 
        } 
    }

    public function hapusSub($id) 
    {
        $this->Menu_model->hapusSub($id);
        $this->session->set_flashdata('message', 'Hapus submenu');
        redirect('menu/submenu'); 
    }

    public function editSub()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->User_model->showUserById();
        $data['menu'] = $this->Menu_model->showAllMenu();
        $data['submenu'] = $this->Menu_model->showAllSubmenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar');
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer'); 
        } else {
            $this->Menu_model->editSub();
            $this->session->set_flashdata('message', 'Edit submenu');
            redirect('menu/submenu'); 
        } 
    }



}