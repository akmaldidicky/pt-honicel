<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tracking_model extends CI_Model
{

    // ----------------------------------------- WAREHOUSE --------------------------------------------------------------
    public function getALL_warehouse()
    {
        $this->db->where("aktivasi", "1");
        return $this->db->get('warehouse')->result_array();
    }
    public function getCode_warehouse($code)
    {
        return $this->db->get_where('warehouse', ['code_item' => $code])->result_array();
    }
    public function getTracking($code)
    {
        return $this->db->get_where('tracking', ['code' => $code])->result_array();
    }
    public function get_tahun($tahun = null)
    {
        return $this->db->query("SELECT*FROM warehouse WHERE year(tanggal_aktivasi) = '$tahun'")->result_array();
    }
    public function get_tanggal($tgl = null, $bulan = null, $tahun = null)
    {
        return $this->db->query("SELECT*FROM warehouse WHERE day(tanggal_aktivasi) = '$tgl' AND month(tanggal_aktivasi) = '$bulan'AND year(tanggal_aktivasi) = '$tahun'")->result_array();
    }
    public function get_bulan($bulan = null, $tahun = null)
    {
        return $this->db->query("SELECT*FROM warehouse WHERE month(tanggal_aktivasi) = '$bulan' AND year(tanggal_aktivasi) = '$tahun'")->result_array();
    }
    public function updateAktivasi($code_item, $data)
    {
        $this->db->where('code_item', $code_item);
        $this->db->update('warehouse', $data);
    }
    public function deleteDevice($id = null)
    {
        $this->db->delete('device', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createTracking($data2)
    {
        $this->db->insert('tracking', $data2);
    }


    // ---------------------------------------------------------------------------------------- MRD _l ---------------------------------------------------------


    // ------------------------------------------------------------------------------ Menu ---------------------------------------------------------
    public function getMenu()
    {
        return $this->db->query("SELECT user_sub_menu.id as id, user_sub_menu.title as title,user_sub_menu.url as url, user_sub_menu.icon as icon, 
        user_sub_menu.is_active as is_active, user_menu.menu as menu FROM user_sub_menu 
        JOIN user_menu ON user_menu.id=user_sub_menu.menu_id")->result_array();
    }
    public function updateMenu($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
    }
    public function deleteMenu($id = null)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createMenu($data)
    {
        $this->db->insert('user_sub_menu', $data);
    }
}
