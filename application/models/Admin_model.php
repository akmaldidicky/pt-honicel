<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    // ----------------------------------------- user --------------------------------------------------------------
    public function getALL_user()
    {
        return $this->db->query("SELECT user.id as id, user.user_name as user_name, role.nama_role as nama_role, user.password as password, user.time_created as time_created FROM user
        JOIN role ON role.id = user.role")->result_array();
    }
    public function get_user($id)
    {

        return $this->db->get_where('user', ['id' => $id])->result_array();
    }
    public function getRole()
    {
        return $this->db->get('role')->result_array();
    }
    public function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
    public function deleteUser($id = null)
    {
        $this->db->delete('user', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createUser($data)
    {
        $this->db->insert('user', $data);
    }
    // ----------------------------------------- warehouse --------------------------------------------------------------

    public function getALL_warehouse()
    {
        return $this->db->query("SELECT*FROM warehouse WHERE aktivasi=0")->result_array();
    }
    public function get_warehouse($code_item = false)
    {
        return $this->db->query("SELECT*FROM warehouse WHERE code_item= '$code_item'")->result_array();
    }
    public function getALL_warehouse_row()
    {
        return $this->db->query("SELECT*FROM warehouse WHERE aktivasi=0")->num_rows();
    }
    public function get_tahun($tahun = null)
    {
        return $this->db->query("SELECT*FROM warehouse WHERE year(tanggal_po) = '$tahun' AND aktivasi= '0' ")->result_array();
    }
    public function get_tanggal($tgl = null, $bulan = null, $tahun = null)
    {
        return $this->db->query("SELECT*FROM warehouse WHERE day(tanggal_po) = '$tgl' AND month(tanggal_po) = '$bulan'AND year(tanggal_po) = '$tahun'  AND aktivasi= '0' ")->result_array();
    }
    public function get_bulan($bulan = null, $tahun = null)
    {
        return $this->db->query("SELECT*FROM warehouse WHERE month(tanggal_po) = '$bulan' AND year(tanggal_po) = '$tahun' AND aktivasi= '0' ")->result_array();
    }
    public function update_warehouse($code_item, $data)
    {
        $this->db->where('code_item', $code_item);
        $this->db->update('warehouse', $data);
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
    public function createDevice($data)
    {
        $this->db->insert('device', $data);
    }


    // ---------------------------------------------------------------------------------------- POK ---------------------------------------------------------
    public function get_pok($id)
    {

        return $this->db->get_where('user', ['id' => $id])->result_array();
    }
    public function updatepok($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
    public function deletepok($id = null)
    {
        $this->db->delete('user', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createpok($coba)
    {
        foreach ($coba as $d => $v) {
            $this->db->query("insert into warehouse(code_item,jenis_barang,tipe,code_po,supplier,panjang,qrcode,aktivasi,tanggal_po) values ('" . $v['code_item'] . "','" . $v['jenis_barang'] . "','" . $v['tipe'] . "','" . $v['code_po'] . "','" . $v['supplier'] . "','" . $v['panjang'] . "' ,'" . $v['qrcode'] . "','" . $v['aktivasi'] . "','" . $v['tanggal_po'] . "')");
        }
    }
    // ---------------------------------------------------------------------------------------- pol ---------------------------------------------------------
    public function get_pol($id)
    {

        return $this->db->get_where('user', ['id' => $id])->result_array();
    }
    public function updatepol($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
    public function deletepol($id = null)
    {
        $this->db->delete('user', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createpol($coba)
    {
        foreach ($coba as $d => $v) {
            $this->db->query("insert into warehouse(code_item,jenis_barang,tipe,code_po,supplier,berat,qrcode,aktivasi,tanggal_po) values ('" . $v['code_item'] . "','" . $v['jenis_barang'] . "','" . $v['tipe'] . "','" . $v['code_po'] . "','" . $v['supplier'] . "','" . $v['berat'] . "' ,'" . $v['qrcode'] . "','" . $v['aktivasi'] . "','" . $v['tanggal_po'] . "')");
        }
    }
    public function createWO($coba)
    {
        $this->db->insert('workorder', $coba);
        return $this->db->affected_rows();
    }
    public function createWOL($coba)
    {
        $this->db->insert('wo_lam', $coba);
        return $this->db->affected_rows();
    }
    // ---------------------------------------------------------------------------------------- WO ---------------------------------------------------------

    public function wo_artikel()
    {
        $art1 = $this->db->query("SELECT item_code FROM mrd_eck where master=1")->result_array();
        $art2 = $this->db->query("SELECT item_code FROM mrd_laminating where master=1")->result_array();
        $data = array_merge($art1, $art2);
        return $data;
    }
    public function wo_bahan()
    {
        $art1 = $this->db->query("SELECT * FROM tipe_item where kategori='KERTAS'")->result_array();
        return $art1;
    }
    public function wo_customer()
    {
        $data = $this->db->get('data_customer')->result_array();
        return $data;
    }

    public function banyak_wo($bulan, $tahun)
    {
        $data = $this->db->query("SELECT MONTH(tanggal) FROM workorder WHERE MONTH(tanggal)=$bulan AND YEAR(tanggal)=20" . $tahun . " ")->num_rows();
        return $data;
    }
    public function banyak_woL($bulan, $tahun)
    {
        $data = $this->db->query("SELECT MONTH(created_at) FROM wo_lam WHERE MONTH(created_at)=$bulan AND YEAR(created_at)=20" . $tahun . " ")->num_rows();
        return $data;
    }

    public function wo_mrd($coba)
    {
        $this->db->insert('workorder', $coba);
        return $this->db->affected_rows();
    }

    // ------------------------------------------------------------------------------ Jaryawan ---------------------------------------------------------

    public function insert_krywn($data)
    {
        $this->db->insert('data_karyawan', $data);
        return $this->db->affected_rows();
    }
}
