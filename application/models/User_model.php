<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    // ----------------------------------------- WAREHOUSE --------------------------------------------------------------
    public function getALL_warehouse()
    {
        $this->db->where("aktivasi", "1");
        return $this->db->get('warehouse')->result_array();
    }
    public function getnum_item()
    {
        $this->db->where("aktivasi", "1");
        return $this->db->get('warehouse')->num_rows();
    }
    public function getnum_kertas()
    {
        $this->db->where("aktivasi", "1");
        return $this->db->get_where('warehouse', ['jenis_barang' => 'KERTAS'])->num_rows();
    }
    public function getnum_lem()
    {
        $this->db->where("aktivasi", "1");
        return $this->db->get_where('warehouse', ['jenis_barang' => 'LEM'])->num_rows();
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
        return $this->db->affected_rows();
    }
    public function updateData($data2)
    {
        foreach ($data2 as $d => $v) {
            $this->db->query("UPDATE warehouse SET panjang = '" . $v['panjang'] . "', berat = '" . $v['berat'] . "' WHERE code_item = '" . $v['code_item'] . "'");
        }
        return $this->db->affected_rows();
    }
    public function deleteDevice($id = null)
    {
        $this->db->delete('device', ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function createTracking($bahanTL)
    {
        $this->db->insert('tracking', $bahanTL);
        return $this->db->affected_rows();
    }
    public function createTracking2($tracking)
    {
        $this->db->insert('tracking', $tracking);
    }
    public function createtrackingwh($data2)
    {
        $this->db->insert('tracking', $data2);
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

    // --------------------------------------------------------------------------------- WORK ORDER ----------------------------------------------------------------


    public function updateWO($code_wo, $data)
    {
        $this->db->where('code_wo', $code_wo);
        $this->db->update('workorder', $data);
        return $this->db->affected_rows();
    }
    public function updateWOL($code_wo, $data)
    {
        $this->db->where('code_wo', $code_wo);
        $this->db->update('wo_lam', $data);
        return $this->db->affected_rows();
    }
    public function createbahan_wo($data2)
    {

        foreach ($data2 as $d => $v) {
            $this->db->query("insert into bahan_wo (code_wo, code_item, kategori) values ('" . $v['code_wo'] . "','" . $v['code_item'] . "','" . $v['kategori'] . "')");
        }
        return $this->db->affected_rows();
    }
    public function createtracking3($bahanT)
    {

        foreach ($bahanT as $d => $v) {
            $this->db->query("insert into tracking (code, tempat, status) values ('" . $v['code'] . "','" . $v['tempat'] . "','" . $v['status'] . "')");
        }
        return $this->db->affected_rows();
    }
    public function createlem_wo($data3)
    {

        $this->db->insert('bahan_wo', $data3);
        return $this->db->affected_rows();
    }
    // ------------------------------------------------------ ABSENSI -------------------------------------------------------
    public function create_absen($data)
    {

        $this->db->insert('absensi', $data);
        return $this->db->affected_rows();
    }
    public function update_absen($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('absensi', $data);
        return $this->db->affected_rows();
    }

    // -------------------------------------- DOWN TIME ---------------------------------------------------------------------------
    public function downtime($downtime)
    {
        foreach ($downtime as $d) {
            $this->db->query("INSERT INTO downtime (code_wo, kategori, detail,waktu) VALUES ('" . $d['code_wo'] . "', '" . $d['kategori'] . "','" . $d['detail'] . "','" . $d['waktu'] . "')");
        }
        return $this->db->affected_rows();
    }





    // ---------------------------------------------- OEE ECK ------------------------------------------------
    public function getAva($code_wo = false)
    {
        if ($code_wo) {

            $dt_plan = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE code_wo=$code_wo AND kategori = 'Plan Downtime'")->result_array();
            $dt_lose = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE code_wo=$code_wo AND kategori = 'Downtime Losses'")->result_array();
            $a = $this->db->get_where('workorder', ['code_wo' => $code_wo])->row_array();
            $p = $dt_plan['0']['waktu'];
            $l = $dt_lose['0']['waktu'];
            $load_t = $a['ava'] - $p;
            $ava = ($load_t - $l) / $load_t;
            return $ava;
        } else {
            return "tidak ada produksi";
        }
    }
    public function getPE($code_wo = false)
    {
        if ($code_wo) {

            $dt_plan = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE code_wo=$code_wo AND kategori = 'Plan Downtime'")->result_array();
            $dt_lose = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE code_wo=$code_wo AND kategori = 'Downtime Losses'")->result_array();
            $a = $this->db->get_where('workorder', ['code_wo' => $code_wo])->row_array();
            $p = $dt_plan['0']['waktu'];
            $l = $dt_lose['0']['waktu'];
            $load_t = $a['ava'] - $p;

            $op_time = $load_t - $l;
            if ($load_t != 0) {
                $pe = (($a['output_pieces'] * $a['ideal_cycle_time']) / $op_time);
                return $pe;
            } else {
                return "tidak ada produksi";
            }
        }
    }
    public function getYield($code_wo = false)
    {
        $a = $this->db->get_where('workorder', ['code_wo' => $code_wo])->row_array();
        $yield = $a['output_kg'] / ($a['pemakaian_lem'] + $a['pemakaian_kertas']);
        return $yield;
    }

    // ---------------------------------------------- OEE LAM ------------------------------------------------
    public function getAvaL($code_wo = false)
    {
        if ($code_wo) {

            $dt_plan = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE code_wo= '$code_wo' AND kategori = 'Plan Downtime'")->result_array();
            $dt_lose = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE code_wo= '$code_wo' AND kategori = 'Downtime Losses'")->result_array();
            $a = $this->db->get_where('wo_lam', ['code_wo' => $code_wo])->row_array();
            $p = $dt_plan['0']['waktu'];
            $l = $dt_lose['0']['waktu'];
            $load_t = $a['ava'] - $p;
            $ava = ($load_t - $l) / $load_t;
            return $ava;
        } else {
            return "tidak ada produksi";
        }
    }
    public function getPEL($code_wo = false)
    {
        if ($code_wo) {

            $dt_plan = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE code_wo= '$code_wo' AND kategori = 'Plan Downtime'")->result_array();
            $dt_lose = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE code_wo= '$code_wo' AND kategori = 'Downtime Losses'")->result_array();
            $a = $this->db->get_where('wo_lam', ['code_wo' => $code_wo])->row_array();
            $p = $dt_plan['0']['waktu'];
            $l = $dt_lose['0']['waktu'];
            $load_t = $a['ava'] - $p;

            $op_time = $load_t - $l;
            if ($load_t != 0) {
                $pe = (($a['total_produksi'] * $a['ideal_cycle_time']) / $op_time);
                return $pe;
            } else {
                return "tidak ada produksi";
            }
        }
    }
    public function getYieldL($code_wo = false)
    {
        $a = $this->db->get_where('wo_lam', ['code_wo' => $code_wo])->row_array();
        $yield = $a['total_produksi_kg'] / ($a['hc_kg'] + $a['pemakaian_kertas'] + $a['pemakaian_lem']);
        return $yield;
    }
}
