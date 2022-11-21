<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    public function getAll()
    {
        return $this->db->get("data_customer")->result_array();
    }
}
