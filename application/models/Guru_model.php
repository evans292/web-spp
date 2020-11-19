<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model {

    public function showAllGuru()
    {
        return $this->db->get('guru')->result_array();
    }

    public function tambahGuru()
    {   
        return $this->db->insert('guru', ['nama' => $this->input->post('nama')]);
    }

    public function hapusGuru($id)
    {
        $this->db->delete('guru', ['id' => $id]);
    }

    public function editGuru()
    {      
        $this->db->set('nama', $this->input->post('nama'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('guru');
    }

    public function showWaliKelas()
    {
        $query = "
                    SELECT `wali_kelas`.`id`, `wali_kelas`.`kelas`, `guru`.`nama` 
                    FROM `wali_kelas` 
                    JOIN `guru`
                    ON `wali_kelas`.`id_guru` = `guru`.`id`
                    ORDER BY `wali_kelas`.`kelas` ASC
                ";
        return $this->db->query($query)->result_array();
    }

    public function tambahWali()
    {   
        $data = [
            'kelas' => $this->input->post('nama'),
            'id_guru' => $this->input->post('guru_id')
        ];
        $this->db->insert('wali_kelas', $data);
    }

    public function editWali()
    {   
        $data = [
            'kelas' => $this->input->post('nama'),
            'id_guru' => $this->input->post('guru_id')
        ];
        $this->db->set($data);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('wali_kelas');
    }

    public function showAllSiswa()
    {
        $query = "
            SELECT `siswa`.* , `wali_kelas`.`kelas` 
            FROM `siswa`
            JOIN `wali_kelas`
            ON `siswa`.`kelas_id` = `wali_kelas`.`id`
            ORDER BY `wali_kelas`.`kelas` ASC
        ";
        return $this->db->query($query)->result_array();
    }

    public function editSiswa()
    {
        $data = [
            'nis' => $this->input->post('nis'),
            'nama' => $this->input->post('nama'),
            'kelas_id' => $this->input->post('kelas_id'),
            'tahunajaran' => $this->input->post('tahun'),
            'biaya' => $this->input->post('biaya')
        ];

        $this->db->set($data);
        $this->db->where('nis', $this->input->post('nis'));
        $this->db->update('siswa');
    }

    public function hapusSiswa($id)
    {
        $this->db->delete('siswa', ['id' => $id]);
    }
}