<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    public function cari()
    {   
        $key = $this->input->get('key');
        $query = "
        SELECT `spp`.* , `siswa`.* 
        FROM `siswa`
        JOIN `spp` 
        ON `spp`.`siswa_id` = `siswa`.`id` 
        WHERE `siswa`.`id` LIKE '%$key%' OR `siswa`.`nis` LIKE '%$key%'
        ORDER BY `spp`.`jatuhtempo` ASC
         ";
         
        return $this->db->query($query)->result_array();
        // return $this->db->get_where('spp', ['siswa_id' => $nis])->result_array();
    }

    public function cariSiswa()
    {
        $key = $this->input->get('key');
        $query = "
        SELECT `siswa`.*, `wali_kelas`.`kelas` 
        FROM `siswa`
        JOIN `wali_kelas` 
        ON `siswa`.`kelas_id` = `wali_kelas`.`id` 
        WHERE `siswa`.`id` LIKE '%$key%' OR `siswa`.`nis` LIKE '%$key%'
         ";
         
        return $this->db->query($query)->row_array();
    }

    public function laporan($tgl1, $tgl2)
    {
        $query = "
                    SELECT `spp`.*, `siswa`.*, `wali_kelas`.`kelas`
                    FROM `spp`
                    JOIN `siswa`
                    ON `spp`.`siswa_id` = `siswa`.`id`
                    JOIN `wali_kelas`
                    ON `siswa`.`kelas_id` = `wali_kelas`.`id`
                    WHERE `tglbayar`
                    BETWEEN '$tgl1' AND '$tgl2'
                    ORDER BY nobayar ASC
                ";
        return $this->db->query($query)->result_array();
    }

    public function bayar($nis,$act,$id)
    {
        if($act == 'bayar') {

            $idspp = $id;
            $nis = $nis;

            // membuat no pembayaran
            $today = date("ymd");
            $query = "
                    SELECT max(`nobayar`) 
                    AS last
                    FROM spp
                    WHERE nobayar LIKE '$today%'
                ";
            $data = $this->db->query($query)->row_array();
            $lastnobayar = $data['last'];
            $lastnourut = substr($lastnobayar, 6, 4);
            $nextnourut = $lastnourut + 1; 
            $nextnobayar = $today . sprintf("%04s", $nextnourut);

            // tanggal bayar
            $tglbayar = date("Y-m-d");

            // id admin
            $admin = $this->session->userdata('name');

            $this->db->set('nobayar', $nextnobayar);
            $this->db->set('tglbayar', $tglbayar);
            $this->db->set('ket', 'LUNAS');
            $this->db->set('petugas_id', $admin);
            $this->db->where('id_spp', $idspp);
            $this->db->update('spp');
        } else if ($act == 'batal') {
            $idspp = $id;
            $nis = $nis;

            $this->db->set('nobayar', null);
            $this->db->set('tglbayar', null);
            $this->db->set('ket', null);
            $this->db->set('petugas_id', null);
            $this->db->where('id_spp', $idspp);
            $this->db->update('spp');
        } 
    }

    public function riwayat($nama)
    {   
        $query = "
            SELECT `spp`.*, `siswa`.*, `user`.`name`
            FROM `spp`
            JOIN `siswa`
            ON `spp`.`siswa_id` = `siswa`.`id`
            JOIN `user`
            ON `siswa`.`nama` = `user`.`name`
            WHERE `user`.`name` = '$nama' 
            AND `spp`.`ket` = 'LUNAS'
            ORDER BY `spp`.`jatuhtempo` ASC
        ";

        return $this->db->query($query)->result_array();
    }

    public function cariRiwayat()
    {   
        $nama = $this->input->get('key');

        $query = "
            SELECT `spp`.*, `siswa`.*, `user`.`name`
            FROM `spp`
            JOIN `siswa`
            ON `spp`.`siswa_id` = `siswa`.`id`
            JOIN `user`
            ON `siswa`.`nama` = `user`.`name`
            WHERE `user`.`name` LIKE '%$nama%' 
            AND `spp`.`ket` = 'LUNAS'
            ORDER BY `spp`.`jatuhtempo` ASC
        ";

        return $this->db->query($query)->result_array();
    }

    public function slipSiswa($nis)
    {
        $query = "
        SELECT `siswa`.*, `wali_kelas`.`kelas` 
        FROM `siswa`
        JOIN `wali_kelas` 
        ON `siswa`.`kelas_id` = `wali_kelas`.`id` 
        WHERE `siswa`.`nis` = '$nis'
         ";
         
        return $this->db->query($query)->row_array();
    }

    public function slip($id)
    {   
        // $query = "
        //             SELECT `spp`.*, `siswa`.*, `wali_kelas`.`kelas`, `wali_kelas`.`id`
        //             FROM `spp`
        //             JOIN `siswa`
        //             ON `spp`.`siswa_id` = `siswa`.`id`
        //             JOIN `wali_kelas`
        //             ON `siswa`.`kelas_id` = `wali_kelas`.`id`
        //             WHERE `spp`.`id_spp` = '$id' 
        //             AND `siswa`.`nis` = '$nis'
        //         ";
        // return $this->db->query($query)->result_array();
        return $this->db->get_where('spp', ['id_spp' => $id])->result_array();
    }


}