<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oee_model extends CI_Model
{

    // ----------------------------------------- user --------------------------------------------------------------
    public function getAva($kemarin = false)
    {
        if ($kemarin) {

            $dt_plan = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE created_at=$kemarin AND kategori = 'Plan Downtime'")->result_array();
            $dt_lose = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE created_at=$kemarin AND kategori = 'Downtime Losses'")->result_array();
            $a = $this->db->query("SELECT SUM(ava) as ava,  SUM(output_pieces) as output_pieces, SUM(output_kg) as output_kg, SUM(pemakaian_lem) as pemakaian_lem, SUM(pemakaian_kertas) as pemakaian_kertas FROM workorder WHERE tanggal = $kemarin")->row_array();
            $p = $dt_plan['0']['waktu'];
            $l = $dt_lose['0']['waktu'];
            $load_t = $a['ava'] - $p;
            if ($load_t != 0) {
                $ava = ceil((($load_t - $l) / $load_t) * 100);
                return $ava;
            } else {
                return "tidak ada produksi";
            }
        } else {

            $dt_plan = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE kategori = 'Plan Downtime'")->result_array();
            $dt_lose = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE kategori = 'Downtime Losses'")->result_array();
            $a = $this->db->query("SELECT SUM(ava) as ava,  SUM(output_pieces) as output_pieces, SUM(output_kg) as output_kg, SUM(pemakaian_lem) as pemakaian_lem, SUM(pemakaian_kertas) as pemakaian_kertas FROM workorder")->row_array();
            $p = $dt_plan['0']['waktu'];
            $l = $dt_lose['0']['waktu'];
            $load_t = $a['ava'] - $p;
            return $ava = ceil((($load_t - $l) / $load_t) * 100);
        }
    }
    public function getPE($kemarin = false)
    {
        if ($kemarin) {

            $dt_plan = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE created_at=$kemarin AND kategori = 'Plan Downtime'")->result_array();
            $dt_lose = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE created_at=$kemarin AND kategori = 'Downtime Losses'")->result_array();
            $a = $this->db->query("SELECT SUM(ava) as ava,  SUM(output_pieces) as output_pieces, SUM(output_kg) as output_kg, SUM(pemakaian_lem) as pemakaian_lem, SUM(pemakaian_kertas) as pemakaian_kertas FROM workorder WHERE tanggal = $kemarin")->row_array();
            $p = $dt_plan['0']['waktu'];
            $l = $dt_lose['0']['waktu'];
            $load_t = $a['ava'] - $p;

            $op_time = $load_t - $l;
            $pcs = $this->db->query("SELECT * FROM mrd_eck where item_code='10021170'")->row_array();
            if ($load_t != 0) {
                return $pe = ceil((($a['output_pieces'] * $pcs['min/layer']) / $op_time) * 100);
            } else {
                return "tidak ada produksi";
            }
        } else {

            $dt_plan = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE kategori = 'Plan Downtime'")->result_array();
            $dt_lose = $this->db->query("SELECT SUM(waktu) as waktu FROM downtime WHERE kategori = 'Downtime Losses'")->result_array();
            $a = $this->db->query("SELECT SUM(ava) as ava,  SUM(output_pieces) as output_pieces, SUM(output_kg) as output_kg, SUM(pemakaian_lem) as pemakaian_lem, SUM(pemakaian_kertas) as pemakaian_kertas FROM workorder")->row_array();
            $p = $dt_plan['0']['waktu'];
            $l = $dt_lose['0']['waktu'];
            $load_t = $a['ava'] - $p;

            $op_time = $load_t - $l;
            $pcs = $this->db->query("SELECT * FROM mrd_eck where item_code='10021170'")->row_array();
            return $pe = ceil((($a['output_pieces'] * $pcs['min/layer']) / $op_time) * 100);
        }
    }
    public function getYield($kemarin = false)
    {
        if ($kemarin) {

            $a = $this->db->query("SELECT SUM(ava) as ava,  SUM(output_pieces) as output_pieces, SUM(output_kg) as output_kg, SUM(pemakaian_lem) as pemakaian_lem, SUM(pemakaian_kertas) as pemakaian_kertas FROM workorder WHERE tanggal = $kemarin")->row_array();

            if (($a['pemakaian_lem'] + $a['pemakaian_kertas']) > 0) {

                return $yield = ceil($a['output_kg'] / ($a['pemakaian_lem'] + $a['pemakaian_kertas']) * 100);
            } else {
                return "tidak ada produksi";
            }
        } else {

            $a = $this->db->query("SELECT SUM(ava) as ava,  SUM(output_pieces) as output_pieces, SUM(output_kg) as output_kg, SUM(pemakaian_lem) as pemakaian_lem, SUM(pemakaian_kertas) as pemakaian_kertas FROM workorder")->row_array();

            return $yield = ceil($a['output_kg'] / ($a['pemakaian_lem'] + $a['pemakaian_kertas']) * 100);
        }
    }
    public function insert_OEE($data_oee)
    {
        $this->db->insert('oee', $data_oee);
    }

    public function getalleck()
    {
        $data = $this->db->query("SELECT AVG(ava) as ava, AVG(pe) as pe, AVG(yield) as yield, AVG(oee) as oee FROM oee WHERE mesin='ECK'")->result_array();
        return $data;
    }
    public function getkemarineck($kemarin = false)
    {
        $data = $this->db->query("SELECT AVG(ava) as ava, AVG(pe) as pe, AVG(yield) as yield, AVG(oee) as oee FROM oee WHERE created_at = $kemarin AND mesin='ECK'")->result_array();
        return $data;
    }
    public function getalllam()
    {
        $data = $this->db->query("SELECT AVG(ava) as ava, AVG(pe) as pe, AVG(yield) as yield, AVG(oee) as oee FROM oee WHERE mesin='LAM'")->result_array();
        return $data;
    }
    public function getkemarinlam($kemarin = false)
    {
        $data = $this->db->query("SELECT AVG(ava) as ava, AVG(pe) as pe, AVG(yield) as yield, AVG(oee) as oee FROM oee WHERE created_at = $kemarin AND mesin='LAM'")->result_array();
        return $data;
    }


    public function updateControl($chip_id, $data)
    {
        $this->db->where('chip_id', $chip_id);
        $this->db->update('control', $data);
    }
}
