<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{

    // ----------------------------------------- DEVICE --------------------------------------------------------------
    public function getDevice($id_user = null)
    {
        $this->db->order_by("id", "asc");
        return $this->db->get('device')->result_array();
    }
    public function updateDevice($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('device', $data);
    }
    public function deleteDevice($id = null)
    {
        $data = [
            'time_deleted' => date("Y-m-d H:i:sa"),
            'is_deleted' => 1

        ];

        $this->db->where('id', $id);
        $this->db->update('device', $data);
    }
    public function createDevice($data)
    {
        $this->db->insert('device', $data);
    }


    // ---------------------------------------------------------------------------------------- APLICATION _---------------------------------------------------------


    // ------------------------------------------------------------------------------ DATA ---------------------------------------------------------
    public function getData($key_device = null, $urutan = null, $waktu_awal = null, $waktu_akhir = null)
    {
        $query = $this->db->query("CALL data_keydevice('$key_device','$urutan',' $waktu_awal','$waktu_akhir');");
        $res   = $query->result_array();

        //add this two line 
        $query->next_result();
        $query->free_result();
        //end of new code

        return $res;
    }
    public function getBanyakdata($key_device = null, $urutan = null, $waktu_awal = null, $waktu_akhir = null)
    {
        $query = $this->db->query("CALL data_keydevice('$key_device','$urutan',' $waktu_awal','$waktu_akhir');");
        $res   = $query->num_rows();

        //add this two line 
        $query->next_result();
        $query->free_result();
        //end of new code

        return $res;
    }
    public function deleteData($key_device = null, $waktuawal = null, $waktuakhir = null)
    {
        $data = [
            'time_deleted' => date("Y-m-d H:i:sa"),
            'is_deleted' => 1

        ];
        $this->db->where("time_add BETWEEN '$waktuawal' AND '$waktuakhir'");
        $this->db->where('key_device', $key_device);
        $this->db->update('data', $data);
    }
}
