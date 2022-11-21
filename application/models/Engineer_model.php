<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Engineer_model extends CI_Model
{

    // ----------------------------------------- DEVICE --------------------------------------------------------------
    public function getDevice()
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
        $this->db->delete('device', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createDevice($data)
    {
        $this->db->insert('device', $data);
    }


    // ---------------------------------------------------------------------------------------- MRD _l ---------------------------------------------------------
    public function getMrd_l()
    {
        $this->db->order_by("id", "asc");
        return $this->db->get('mrd_laminating')->result_array();
    }
    public function updateMrd_l($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('mrd_laminating', $data);
    }
    public function deleteMrd_l($id = null)
    {
        $this->db->delete('mrd_laminating', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createMrd_l($data)
    {
        $this->db->insert('mrd_laminating', $data);
    }
    // ---------------------------------------------------------------------------------------- MRD _eck ---------------------------------------------------------
    public function getMrd_eck()
    {
        $this->db->order_by("id", "asc");
        return $this->db->get('mrd_eck')->result_array();
    }
    public function updateMrd_eck($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('mrd_eck', $data);
    }
    public function deleteMrd_eck($id = null)
    {
        $this->db->delete('mrd_eck', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createMrd_eck($data)
    {
        $this->db->insert('mrd_eck', $data);
    }

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
