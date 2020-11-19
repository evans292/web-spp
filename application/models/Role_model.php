<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model {

    public function showAllRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function showRoleById($role_id)
    {
        return $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    }

    public function hapusRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
    }

    public function tambahRole()
    {
       $this->db->insert('user_role', ['role' => $this->input->post('role')]);
    }

    public function editRole()
    {
        $this->db->set('role', $this->input->post('role'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_role');
    }

}