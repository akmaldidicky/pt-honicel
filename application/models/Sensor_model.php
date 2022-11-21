<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sensor_model extends CI_Model
{
    public function createNilai($data)
    {
        $this->db->insert('data_sensor', $data);
        return $this->db->affected_rows();
    }
}
