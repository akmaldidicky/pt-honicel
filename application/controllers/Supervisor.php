<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Supervisor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Oee_model', 'oee');
        is_logged_in();
    }

    public function index()
    {
        header('Refresh: 0.5');
        $kemarin = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
        // $wo=$this
        $lam = $this->db->get_where('data_sensor', ['chip_id' => '2462610'])->result_array();
        $eck = $this->db->get_where('data_sensor', ['chip_id' => '2473940'])->result_array();
        $siku = $this->db->get_where('data_sensor', ['chip_id' => '5783528'])->result_array();
        $mesinlam = ['cross cutter', 'conveyor 1', 'side cutting', 'oven 1', 'oven 2', 'conveyor 2', 'glue section', 'expander 1', 'expander 2', 'input feeding motor'];
        $mesineck = ['motor pompa lem pipa 1', 'motor pompa lem pipa 2', 'motor pompa lem pipa 3', 'motor pompa lem pipa 4', 'motor pompa lem pipa 5', 'motor pompa lem pipa 6', 'motor pompa lem pipa 7', 'conveyor 1', 'cutting ', 'output motor'];
        $mesinsiku = ['motor 1', 'motor 2', 'motor 3', 'motor 4', 'cutting section'];
        $x = 1;
        foreach ($lam as $v) {
            if ($v['nilai'] == 0) {
                $status = 'OFF';
            } else {
                $status = 'ON';
            }
            $laminating[] = [
                'mesin' => $mesinlam[$x - 1],
                'status'  => $status
            ];
            $x++;
        }
        $y = 1;
        foreach ($eck as $v) {
            if ($v['nilai'] == 0) {
                $status = 'OFF';
            } else {
                $status = 'ON';
            }
            $eck2[] = [
                'mesin' => $mesineck[$y - 1],
                'status' => $status
            ];
            $y++;
        }
        $z = 1;
        foreach ($siku as $v) {
            if ($v['nilai'] == 0) {
                $status = 'OFF';
            } else {
                $status = 'ON';
            }
            $siku2[] = [
                'mesin' => $mesinsiku[$z - 1],
                'status' => $status
            ];
            $z++;
        }
        $all = $this->oee->getalleck();
        $old = $this->oee->getkemarineck($kemarin);
        $alll = $this->oee->getalllam();
        $oldl = $this->oee->getkemarinlam($kemarin);
        $data = [
            'title' => 'Monitoring',
            'user' => $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array(),
            'laminating' => $laminating,
            'eck' => $eck2,
            'siku' => $siku2,
            'all' => $all,
            'all' => $all,
            'old' => $old,
            'alll' => $alll,
            'oldl' => $oldl
        ];

        $this->load->view('templates/header', $data);

        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('supervisor/monitoring', $data);
        $this->load->view('templates/footer');
    }
    public function control()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Control Device';
        $data['buzzer'] = $this->db->get('control')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('supervisor/control', $data);
        $this->load->view('templates/footer');
    }

    public function mqtt()
    {
        $chip_id = $this->input->post('chip_id');
        $pesan = $this->input->post('pesan');
        // $topic = 'Buzzer/' . $chip_id;

        $data = [
            'nilai' => $pesan
        ];
        // ---------------------------------------------
        $this->oee->updateControl($chip_id, $data);
        if ($pesan == 0) {
            $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil Mematikan Alarm.">');
        } else {
            $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil Menyalakan Alarm.">');
        }
        sleep(3);
        redirect(base_url('supervisor/control'));
    }

    public function coba()
    {
        $code_wo = 'cobacoba';
        $kategori = $this->input->post('kategori');
        $detail = $this->input->post('detail');
        $waktu_awal = $this->input->post('waktu_awal');
        $waktu_akhir = $this->input->post('waktu_akhir');
        $downtime = [];
        $x = 0;
        // print_r($detail);
        // die;
        foreach ($detail as $d => $v) :
            $time11 = date_create($waktu_awal[$x]);
            $time22 = date_create($waktu_akhir[$x]);

            $time = date_diff($time11, $time22);

            $hasil = ($time->h * 60) + ($time->i * 1);
            $downtime[] = [
                'code_wo' => $code_wo,
                'kategori' => $kategori[$x],
                'detail' => $v,
                'waktu' => $hasil
            ];
            $x++;
        endforeach;
        // print_r($downtime);
        // die;
        $cek = $this->user->downtime($downtime);
        if ($cek > 0) {

            echo ('berhasil');
        } else {
            echo ('coba lagi');
        }
    }

    public function export()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Export Data';
        // $data['active'] = $this->user->getALL_warehouse();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('supervisor/export', $data);
        $this->load->view('templates/footer');
    }

    public function oee_eck()
    {

        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['oee'] = $this->db->query("SELECT workorder.ava as av,workorder.tanggal,oee.*,workorder.article,workorder.code_wo,workorder.shift,workorder.waktu_mulai,workorder.waktu_akhir,workorder.no_po,workorder.mesin,workorder.cell_size,workorder.paper_width,workorder.thickness,workorder.kg_layer,workorder.pemakaian_kertas,workorder.pemakaian_lem,workorder.output_pieces,workorder.output_kg,workorder.berat_buangan_lem,workorder.berat_buangan_kertas FROM oee INNER JOIN workorder ON oee.code_wo=workorder.code_wo;")->result_array();
        $data['all'] = $this->db->query("SELECT AVG(ava) as ava, AVG(pe) as pe, AVG(yield) as yield, AVG(oee) as oee FROM oee")->row_array();
        // var_dump($data['all']);
        // die;

        $this->load->view('supervisor/oee_eck', $data);
    }

    public function oee_lam()
    {

        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['oee'] = $this->db->query("SELECT wo_lam.ava as av,wo_lam.created_at,oee.*,wo_lam.article,wo_lam.code_wo,wo_lam.shift,wo_lam.kg_board,wo_lam.waktu_mulai,wo_lam.waktu_akhir,wo_lam.no_po,wo_lam.speed_mesin,wo_lam.top_layer,wo_lam.cell_size,wo_lam.board_size,wo_lam.thickness,wo_lam.pemakaian_kertas,wo_lam.pemakaian_lem,wo_lam.hc_layer,wo_lam.hc_kg,wo_lam.total_produksi,wo_lam.total_produksi_kg,wo_lam.berat_palet_kg,wo_lam.berat_bs,wo_lam.standart_tarikan,wo_lam.actual_tarikan FROM oee INNER JOIN wo_lam ON oee.code_wo=wo_lam.code_wo;")->result_array();
        $data['all'] = $this->db->query("SELECT AVG(ava) as ava, AVG(pe) as pe, AVG(yield) as yield, AVG(oee) as oee FROM oee WHERE mesin='LAM'")->row_array();
        // var_dump($data['all']);
        // die;

        $this->load->view('supervisor/oee_lam', $data);
    }

    public function cek()
    {

        $lam = $this->db->get_where('data_sensor', ['chip_id' => '2462610'])->result_array();
        $eck = $this->db->get_where('data_sensor', ['chip_id' => '2473940'])->result_array();
        $x = 1;
        foreach ($lam as $v) {
            if ($v['nilai'] == 0) {
                $status = 'OFF';
            } else {
                $status = 'ON';
            }
            $laminating[] = [
                'Mesin ' . $x => $status
            ];
            $x++;
        }
        $y = 1;
        foreach ($eck as $v) {
            if ($v['nilai'] == 0) {
                $status = 'OFF';
            } else {
                $status = 'ON';
            }
            $eck2[] = [
                'Mesin ' . $y => $status
            ];
            $y++;
        }
        print_r($laminating);
        print_r($eck2);
        die;
    }
}
