<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function showAllMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function tambah()
    {
        return $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
    }

    public function hapus($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);   
    }

    public function edit($id)
    {
        $this->db->set('menu', $this->input->post('menu'));
        $this->db->where('id', $id);
        $this->db->update('user_menu');
    }

    public function showAllSubmenu()
    {
        // return $this->db->get('user_sub_menu')->result_array();
        $query = "
            SELECT `user_sub_menu`.*, `user_menu`.`menu`
            FROM `user_sub_menu` JOIN `user_menu`
            ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
            ORDER BY `user_menu`.`id` ASC
        ";
        return $this->db->query($query)->result_array();
    }

    public function tambahSub()
    {
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('check')
        ];

        return $this->db->insert('user_sub_menu', $data);
    }

    public function hapusSub($id)
    {
        return $this->db->delete('user_sub_menu', ['id' => $id]);
    }

    public function editSub()
    {   
        $id = $this->input->post('id');
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('check')
        ];

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu');
    }



}