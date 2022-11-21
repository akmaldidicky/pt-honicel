<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageMargins;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include "vendor/fpdf/fpdf.php";

include "vendor/phpqrcode/qrlib.php";

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('User_model', 'user');
        $this->load->model('Oee_model', 'oee');
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = '';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    // ------------------------------------------- WAREHOUSE ------------------------------------------------
    public function warehouse()
    {

        $this->form_validation->set_rules('tanggal', 'tanggal');
        $this->input->post('tanggal');
        $tgl = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        if (!$tahun) {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Warehouse';
            $data['active'] = $this->user->getALL_warehouse();
            $data['item'] = $this->user->getnum_item();
            $data['kertas'] = $this->user->getnum_kertas();
            $data['lem'] = $this->user->getnum_lem();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/warehouse', $data);
            $this->load->view('templates/footer');
        } else {
            if ($bulan) {
                if ($tgl) {
                    $data['title'] = 'Warehouse';
                    $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                    $data['active'] = $this->user->get_tanggal($tgl, $bulan, $tahun);
                    $this->load->view('templates/header', $data);
                    $this->load->view('templates/sidebar');
                    $this->load->view('templates/topbar', $data);
                    $this->load->view('user/warehouse');
                    $this->load->view('templates/footer');
                } else {
                    $data['title'] = 'Warehouse';
                    $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                    $data['active'] = $this->user->get_bulan($bulan, $tahun);
                    $this->load->view('templates/header', $data);
                    $this->load->view('templates/sidebar');
                    $this->load->view('templates/topbar', $data);
                    $this->load->view('user/warehouse');
                    $this->load->view('templates/footer');
                }
            } else {
                $data['title'] = 'Warehouse';
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['active'] = $this->user->get_tahun($tahun);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/warehouse');
                $this->load->view('templates/footer');
            }
        }
    }
    public function tambah_item()
    {
        $code_item = $this->input->post('code_item');
        // $panjang = $this->db->get_where('warehouse', ['code_item' => $code_item])->result_array();
        $berat = $this->input->post('berat');
        $faktor_x = $berat / 5000;
        $data = [
            'berat' => $berat,
            'faktor_x' => $faktor_x,
            'aktivasi' => 1,
            'tanggal_aktivasi' => date('Y-m-d H:i:s')

        ];
        $data2 = [
            'code' => $code_item,
            'tempat' => 'warehouse',
            'status' => 'item telah teraktivasi'
        ];

        $this->user->updateAktivasi($code_item, $data);
        $this->user->createtrackingwh($data2);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Item Berhasil ditambahkan ke Warehouse.</div>');
        redirect('user/warehouse');
    }
    public function tambahproduk()
    {
        $code_item = $this->input->post('code_item');
        $data2 = [
            'code' => $code_item,
            'tempat' => 'warehouse',
            'status' => 'Item tersimpan di warehouse'
        ];

        $this->user->createtrackingwh($data2);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Item Berhasil ditambahkan ke Warehouse.</div>');
        redirect('user/warehouse');
    }
    // ------------------------------------------------ MESIN ECK -----------------------------------
    public function mesin_eck()
    {
        $this->form_validation->set_rules('code', 'code', 'required|trim]');
        $code = $this->input->post('code');
        if (!$code) {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Mesin ECK';
            // $data['active'] = $this->user->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/eck', $data);
            $this->load->view('templates/footer');
        } else {

            $data2 = [
                'code' => $code,
                'tempat' => 'Mesin ECK',
                'status' => 'Dalam Proses Produksi'
            ];
            $this->user->createTracking($data2);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Scanning Berhasil !.</div>');
            redirect('user/mesin_eck');
        }
    }
    public function lapeck_awal()
    {

        $code = $this->input->post('code');
        $code2 = $this->input->post('nowo');
        $data['isi'] = $this->db->get_where('workorder', ['code_wo' => $code2])->result_array();
        if (!$code) {

            $this->form_validation->set_rules('operator', 'operator', 'required');
            $this->form_validation->set_rules('gsm', 'gsm', 'required');
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Mesin ECK';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/lapeck_awal', $data);
            $this->load->view('templates/footer');
        } else {
            $this->form_validation->set_rules('operator', 'operator', 'required');
            $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
            $this->form_validation->set_rules('gsm', 'gsm', 'required');

            if ($this->form_validation->run() == false) {
                # code...
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['title'] = 'Mesin ECK';
                // $data['active'] = $this->user->getALL_warehouse();
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/lapeck_awal', $data);
                $this->load->view('templates/footer');
            } else {
                $bahan = $this->input->post('bahan');
                $lem = $this->input->post('lem');
                $code_wo = $this->input->post('no_wo');
                $data2 = [];
                foreach ($bahan as $c => $values) :
                    $data2[] = [
                        'code_wo' => $code_wo,
                        'code_item' => $values,
                        'kategori' => 'KERTAS'
                    ];
                endforeach;
                $data = [
                    'operator' => htmlspecialchars($this->input->post('operator', true)),
                    'waktu_mulai' => htmlspecialchars($this->input->post('tanggal', true)),
                    'gsm' => htmlspecialchars($this->input->post('gsm', true))

                ];
                $data3 = [
                    'code_wo' => $code_wo,
                    'code_item' => $lem,
                    'kategori' => 'LEM'
                ];
                $tracking = [
                    'code' => $code_wo,
                    'tempat' => 'Mesin ECK',
                    'status' => 'Dalam Proses Produksi'
                ];
                $bahanT = [];
                foreach ($bahan as $c => $values) :
                    $bahanT[] = [
                        'code' => $values,
                        'tempat' => 'Mesin ECK',
                        'status' => 'Item Dalam Proses Produksi'
                    ];
                endforeach;
                $bahanTL = [
                    'code' => $lem,
                    'tempat' => 'Mesin ECK',
                    'status' => 'Dalam Proses Produksi'
                ];
                // $this->user->updateWO_eck($code_wo, $data);
                $berhasil = $this->user->updateWO($code_wo, $data);
                $berhasil2 = $this->user->createbahan_wo($data2);
                $berhasil3 = $this->user->createlem_wo($data3);
                $this->user->createtracking3($bahanT);
                $this->user->createtracking($bahanTL);
                $this->user->createTracking2($tracking);
                if ($berhasil > 0 && $berhasil2 > 0 && $berhasil3 > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                     Berhasil !</div>');
                    $this->session->set_flashdata('codewo', $code_wo);
                    redirect('user/lapeck_akhir');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                     Gagal !</div>');
                    redirect('user');
                }
            }
        }
    }
    public function lapeck_akhir()
    {
        $this->form_validation->set_rules('code', 'code', 'required|trim');
        $code = $this->input->post('code');
        $data['title'] = 'Mesin ECK';

        $code2 = $this->input->post('nowo');

        if (!$code) {
            $flashdata = $this->session->flashdata('codewo');
            if (!$flashdata) {

                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['isi'] = $this->db->get_where('workorder', ['code_wo' => $code2])->result_array();
                $this->db->where('kategori', 'KERTAS');
                $bahan = $this->db->get_where('bahan_wo', ['code_wo' => $code2])->result_array();
                $cek = [];
                    // print_r($bahan[0]);
                    // die;
                ;
                foreach ($bahan as $b) :
                    $r = $b['code_item'];
                    $bahan2 = $this->db->get_where('warehouse', ['code_item' => $r])->result_array();
                    foreach ($bahan2 as $b2) :
                        $cek[] = [
                            'code_item' => $b2['code_item'],
                            'berat' =>  $b2['berat'],
                            'panjang' => $b2['panjang'],
                            'faktor_x' =>  $b2['faktor_x']
                        ];
                    endforeach;
                endforeach;
                $data['isi2'] = $cek;
                // print_r($data['isi2']);
                // die;
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/lapeck_akhir', $data);
            } else {
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['isi'] = $this->db->get_where('workorder', ['code_wo' => $flashdata])->result_array();
                $this->db->where('kategori', 'KERTAS');
                $bahan = $this->db->get_where('bahan_wo', ['code_wo' => $flashdata])->result_array();
                $cek = [];
                foreach ($bahan as $b) :
                    $r = $b['code_item'];
                    $bahan2 = $this->db->get_where('warehouse', ['code_item' => $r])->result_array();
                    foreach ($bahan2 as $b2) :
                        $cek[] = [
                            'code_item' => $b2['code_item'],
                            'berat' =>  $b2['berat'],
                            'panjang' => $b2['panjang'],
                            'faktor_x' =>  $b2['faktor_x']
                        ];
                    endforeach;
                endforeach;
                $data['isi2'] = $cek;
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/lapeck_akhir', $data);
                $this->load->view('templates/footer');
            }
        } else {
            $this->form_validation->set_rules('shift', 'shift', 'required');
            $this->form_validation->set_rules('lebar_kertas', 'lebar_kertas', 'required');
            $this->form_validation->set_rules('speed_mesin', 'speed_mesin', 'required');
            $this->form_validation->set_rules('lebar_kertas', 'lebar_kertas', 'required');
            // $this->form_validation->set_rules('pemakaian_kertas', 'pemakaian_kertas', 'required');
            // $this->form_validation->set_rules('lem_terpakai', 'lem_terpakai', 'required');
            $this->form_validation->set_rules('output', 'output', 'required');
            $this->form_validation->set_rules('berat_buangan', 'berat_buangan', 'required');
            $this->form_validation->set_rules('masalah_produksi', 'masalah_produksi', 'required');
            $this->form_validation->set_rules('tanggal', 'tanggal', 'required');

            if ($this->form_validation->run() == false) {
                $code3 = $this->input->post('no_wo');
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['isi'] = $this->db->get_where('workorder', ['code_wo' => $code3])->result_array();
                $this->db->where('kategori', 'KERTAS');
                $bahan = $this->db->get_where('bahan_wo', ['code_wo' => $code3])->result_array();
                $cek = [];
                foreach ($bahan as $b) :
                    $r = $b['code_item'];
                    $bahan2 = $this->db->get_where('warehouse', ['code_item' => $r])->result_array();
                    foreach ($bahan2 as $b2) :
                        $cek[] = [
                            'code_item' => $b2['code_item'],
                            'berat' =>  $b2['berat'],
                            'panjang' => $b2['panjang'],
                            'faktor_x' =>  $b2['faktor_x']
                        ];
                    endforeach;
                endforeach;
                $data['isi2'] = $cek;
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/lapeck_akhir', $data);
                $this->load->view('templates/footer');
            } else {
                $sensor = $this->db->query("SELECT * FROM data_sensor WHERE chip_id='13628069' ORDER BY id DESC LIMIT 1")->row_array();
                $sensor_lem = $this->db->query("SELECT * FROM data_sensor WHERE chip_id='6504433' ORDER BY id DESC LIMIT 1")->row_array();
                $code_wo = $this->input->post('no_wo');
                $code_item = $this->input->post('code_item');
                $berat_awal = $this->input->post('berat_awal');
                $tanggal = $this->input->post('tanggal');
                // $pemakaian_kertas = $this->input->post('pemakaian_kertas');
                // $kertas_pakai = $this->input->post('kertas_pakai');
                $panjang = $this->input->post('panjang');
                $isi = $this->db->get_where('workorder', ['code_wo' => $code_wo])->row_array();
                $kertas_kg = ($sensor['nilai'] * $isi['gsm']) / 1000;
                // var_dump($sensor['nilai']);
                // var_dump($isi['gsm']);
                // var_dump($kertas_kg);
                // die;
                $things = [];
                $i = 0;
                foreach ($code_item as $c => $v) :
                    $things[] = [
                        'code_item' => $v,
                        'panjang' =>  $panjang[$i] - $sensor['nilai'], //pemakaian kertas di ganti dengan data dari device
                        'berat' => $berat_awal[$i] - $kertas_kg  // $kertapakai diganti dengan (nilai dari sensor * gsm)
                    ];
                    $i++;
                endforeach;
                // Tangkapan Data Downtime
                $kategori = $this->input->post('kategori');
                $detail = $this->input->post('detail');
                $waktu_awal = $this->input->post('waktu_awal');
                $waktu_akhir = $this->input->post('waktu_akhir');
                $downtime = [];
                $x = 0;
                foreach ($detail as $d => $v) :
                    $time11 = date_create($waktu_awal[$x]);
                    $time22 = date_create($waktu_akhir[$x]);

                    $time = date_diff($time11, $time22);
                    var_dump($time);
                    echo "<br>";
                    $hasil = ($time->h * 60) + ($time->i * 1);
                    if ($hasil != 0) {
                        $downtime[] = [
                            'code_wo' => $code_wo,
                            'kategori' => $kategori[$x],
                            'detail' => $v,
                            'waktu' => $hasil
                        ];
                    }
                    $x++;
                endforeach;
                print_r($downtime);
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo "<br>";
                // die;
                //Data untuk update tabel wo
                $data = [
                    'mesin' => 'ECK',
                    'shift' => htmlspecialchars($this->input->post('shift', true)),
                    'pemakaian_kertas' => $kertas_kg * 8,
                    'pemakaian_lem' => $sensor_lem['nilai'],
                    'output_pieces' => htmlspecialchars($this->input->post('output', true)),
                    'berat_buangan_lem' => htmlspecialchars($this->input->post('berat_buangan', true)),
                    'masalah_produksi' => htmlspecialchars($this->input->post('masalah_produksi', true)),
                    'waktu_akhir' => $tanggal
                ];
                // Menambahkan data ke tabel tracking
                $tracking = [
                    'code' => $code_wo,
                    'tempat' => 'Mesin ECK',
                    'status' => 'Work Order Telah Selesai Dikerjakan '
                ];

                $data2 = $things;
                $cek1 = $this->user->updateWO($code_wo, $data);
                $cek2 = $this->user->updateData($data2);
                $this->user->createTracking2($tracking);
                $this->user->downtime($downtime);
                sleep(1);
                $t_ava = $this->db->get_where('workorder', ['code_wo' => $code_wo])->row_array();
                $t_1 = date_create(date('H:i:s', strtotime($t_ava['waktu_mulai'])));
                $t_2 = date_create(date('H:i:s', strtotime($t_ava['waktu_akhir'])));
                $time = date_diff($t_1, $t_2);
                $ava = ($time->h * 60) + $time->i;
                $output_kg = $t_ava['kg_layer'] * $t_ava['output_pieces'];
                $data = [
                    'output_kg' => $output_kg,
                    'ava' => $ava
                ];
                $this->user->updateWO($code_wo, $data);
                sleep(1);
                // ----------------------------------------------------------OEE----------------------
                $ava_oee = $this->user->getAva($code_wo);
                $pe_oee = $this->user->getPE($code_wo);
                $yield_oee = $this->user->getYield($code_wo);
                $oee = $ava_oee * $pe_oee * $yield_oee;

                // var_dump($ava_oee);
                // echo "<br>";
                // var_dump($pe_oee);
                // echo "<br>";
                // var_dump($yield_oee);
                // echo "<br>";
                // var_dump($oee);
                // echo "<br>";

                // die;
                $data_oee = [
                    'code_wo' => $code_wo,
                    'mesin' => 'ECK',
                    'ava' => $ava_oee,
                    'pe' => $pe_oee,
                    'yield' => $yield_oee,
                    'oee' => $oee,
                ];
                $this->oee->insert_OEE($data_oee);
                if ($cek1 > 0) {
                    $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil Memasukan Data.">');
                    redirect('user/mesin_eck');
                } else {
                    $this->session->set_flashdata('message', '<button onclick="failed()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Gagal Memasukan Data.">');
                    redirect('user/mesin_eck');
                }
            }
        }
    }


    // -------------------------------------- MESIN LAMINATING ---------------------------------------------
    public function mesin_lam()
    {
        $this->form_validation->set_rules('code', 'code');

        $code = $this->input->post('code');
        if (!$code) {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Mesin Laminating';
            // $data['active'] = $this->user->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/lam', $data);
            $this->load->view('templates/footer');
        } else {

            $data2 = [
                'code' => $code,
                'tempat' => 'Mesin Laminating',
                'status' => 'Dalam Proses Produksi '
            ];
            $this->user->createtracking($data2);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Scanning Berhasil !.</div>');
            redirect('user/mesin_lam');
        }
    }
    public function laplam_awal()
    {

        $code = $this->input->post('code');
        $code2 = $this->input->post('nowo');
        $data['isi'] = $this->db->get_where('wo_lam', ['code_wo' => $code2])->result_array();
        // print_r($data['isi']);
        // die;
        if (!$code) {

            $this->form_validation->set_rules('operator', 'operator', 'required');
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Mesin Laminating';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/laplam_awal', $data);
            $this->load->view('templates/footer');
        } else {
            $this->form_validation->set_rules('operator', 'operator', 'required');
            $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
            // $this->form_validation->set_rules('bahan', 'bahan', 'required');
            $tanggal = $this->input->post('tanggal');
            if ($this->form_validation->run() == false) {
                # code...
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['title'] = 'Mesin Laminating';
                // $data['active'] = $this->user->getALL_warehouse();
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/laplam_awal', $data);
                $this->load->view('templates/footer');
            } else {
                $bahan = $this->input->post('bahan');
                $lem = $this->input->post('lem');
                $code_wo = $this->input->post('no_wo');
                $data2 = [];
                foreach ($bahan as $c => $values) :
                    $data2[] = [
                        'code_wo' => $code_wo,
                        'code_item' => $values,
                        'kategori' => 'KERTAS'
                    ];
                endforeach;
                $data = [
                    'operator' => htmlspecialchars($this->input->post('operator', true)),
                    'waktu_mulai' => $tanggal,
                    'gsm' => htmlspecialchars($this->input->post('gsm', true))
                ];
                $data3 = [
                    'code_wo' => $code_wo,
                    'code_item' => $lem,
                    'kategori' => 'LEM'
                ];
                $bahanT = [];
                foreach ($bahan as $c => $values) :
                    $bahanT[] = [
                        'code' => $values,
                        'tempat' => 'Mesin LAMINATING',
                        'status' => 'Item Dalam Proses Produksi'
                    ];
                endforeach;
                $bahanTL = [
                    'code' => $lem,
                    'tempat' => 'Mesin LAMINATING',
                    'status' => 'Dalam Proses Produksi'
                ];
                $this->user->createtracking3($bahanT);
                $this->user->createtracking($bahanTL);
                // $this->user->updateWO_lam($code_wo, $data);
                $berhasil = $this->user->updateWOL($code_wo, $data);
                $berhasil2 = $this->user->createbahan_wo($data2);
                $berhasil3 = $this->user->createlem_wo($data3);
                if ($berhasil > 0 && $berhasil2 > 0 && $berhasil3 > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                     Berhasil !</div>');
                    $this->session->set_flashdata('codewo', $code_wo);
                    redirect('user/laplam_akhir');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                     Gagal !</div>');
                    redirect('user');
                }
            }
        }
    }
    public function laplam_akhir()
    {
        $this->form_validation->set_rules('code', 'code', 'required|trim');
        $code = $this->input->post('code');
        $data['title'] = 'Mesin Laminating';

        $code2 = $this->input->post('nowo');
        if (!$code) {
            $flashdata = $this->session->flashdata('codewo');
            if (!$flashdata) {

                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['isi'] = $this->db->get_where('wo_lam', ['code_wo' => $code2])->result_array();
                $this->db->where('kategori', 'KERTAS');
                $bahan = $this->db->get_where('bahan_wo', ['code_wo' => $code2])->result_array();
                $cek = [];
                    // print_r($bahan[0]);
                    // die;
                ;
                foreach ($bahan as $b) :
                    $r = $b['code_item'];
                    $bahan2 = $this->db->get_where('warehouse', ['code_item' => $r])->result_array();
                    foreach ($bahan2 as $b2) :
                        $cek[] = [
                            'code_item' => $b2['code_item'],
                            'berat' =>  $b2['berat'],
                            'panjang' => $b2['panjang'],
                            'faktor_x' =>  $b2['faktor_x']
                        ];
                    endforeach;
                endforeach;
                $data['isi2'] = $cek;
                // print_r($data['isi2']);
                // die;
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/laplam', $data);
                $this->load->view('templates/footer');
            } else {
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['isi'] = $this->db->get_where('wo_lam', ['code_wo' => $flashdata])->result_array();
                $this->db->where('kategori', 'KERTAS');
                $bahan = $this->db->get_where('bahan_wo', ['code_wo' => $flashdata])->result_array();
                $cek = [];
                foreach ($bahan as $b) :
                    $r = $b['code_item'];
                    $bahan2 = $this->db->get_where('warehouse', ['code_item' => $r])->result_array();
                    foreach ($bahan2 as $b2) :
                        $cek[] = [
                            'code_item' => $b2['code_item'],
                            'berat' =>  $b2['berat'],
                            'panjang' => $b2['panjang'],
                            'faktor_x' =>  $b2['faktor_x']
                        ];
                    endforeach;
                endforeach;
                $data['isi2'] = $cek;
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/laplam', $data);
                $this->load->view('templates/footer');
            }
        } else {
            $this->form_validation->set_rules('shift', 'shift', 'required');
            $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
            $this->form_validation->set_rules('speed_mesin', 'speed_mesin', 'required');
            // $this->form_validation->set_rules('lebar_kertas', 'lebar_kertas', 'required');
            // $this->form_validation->set_rules('pemakaian_kertas', 'pemakaian_kertas', 'required');
            // $this->form_validation->set_rules('lem_terpakai', 'lem_terpakai', 'required');
            // $this->form_validation->set_rules('output', 'output', 'required');
            // $this->form_validation->set_rules('berat_buangan', 'berat_buangan', 'required');
            // $this->form_validation->set_rules('masalah_produksi', 'masalah_produksi', 'required');

            if ($this->form_validation->run() == false) {
                $code3 = $this->input->post('no_wo');
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['isi'] = $this->db->get_where('wo_lam', ['code_wo' => $code3])->result_array();
                $this->db->where('kategori', 'KERTAS');
                $bahan = $this->db->get_where('bahan_wo', ['code_wo' => $code3])->result_array();
                $cek = [];
                foreach ($bahan as $b) :
                    $r = $b['code_item'];
                    $bahan2 = $this->db->get_where('warehouse', ['code_item' => $r])->result_array();
                    foreach ($bahan2 as $b2) :
                        $cek[] = [
                            'code_item' => $b2['code_item'],
                            'berat' =>  $b2['berat'],
                            'panjang' => $b2['panjang'],
                            'faktor_x' =>  $b2['faktor_x']
                        ];
                    endforeach;
                endforeach;
                $this->db->where('kategori', 'LEM');
                $bahan2 = $this->db->get_where('bahan_wo', ['code_wo' => $code3])->result_array();
                $data['apaaja'] = $bahan2;
                $data['isi2'] = $cek;
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('user/laplam', $data);
                $this->load->view('templates/footer');
            } else {
                $sensor = $this->db->query("SELECT * FROM data_sensor WHERE chip_id='14375003' ORDER BY id DESC LIMIT 1")->row_array();
                $sensor_cut = $this->db->query("SELECT * FROM data_sensor WHERE chip_id='1706665' ORDER BY id DESC LIMIT 1")->row_array();
                $sensor_lem = $this->db->query("SELECT * FROM data_sensor WHERE chip_id='14213030' ORDER BY id DESC LIMIT 1")->row_array();
                $code_wo = $this->input->post('no_wo');
                $code_item = $this->input->post('code_item');
                $berat_awal = $this->input->post('berat_awal');
                $tanggal = $this->input->post('tanggal');
                // $pemakaian_kertas = $this->input->post('pemakaian_kertas');
                // $kertas_pakai = $this->input->post('kertas_pakai');
                $panjang = $this->input->post('panjang');
                $isi = $this->db->get_where('wo_lam', ['code_wo' => $code_wo])->row_array();
                $kertas_kg = ($sensor['nilai'] * $isi['gsm']) / 1000;
                $things = [];
                $i = 0;
                foreach ($code_item as $c => $v) :
                    $things[] = [
                        'code_item' => $v,
                        'panjang' =>  $panjang[$i] - $sensor['nilai'],
                        'berat' => $berat_awal[$i] - $kertas_kg
                    ];
                    $i++;
                endforeach;
                // Tangkapan Data Downtime
                $kategori = $this->input->post('kategori');
                $detail = $this->input->post('detail');
                $waktu_awal = $this->input->post('waktu_awal');
                $waktu_akhir = $this->input->post('waktu_akhir');
                $downtime = [];
                $x = 0;
                foreach ($detail as $d => $v) :
                    $time11 = date_create($waktu_awal[$x]);
                    $time22 = date_create($waktu_akhir[$x]);

                    $time = date_diff($time11, $time22);
                    var_dump($time);
                    echo "<br>";
                    $hasil = ($time->h * 60) + ($time->i * 1);
                    if ($hasil != 0) {
                        $downtime[] = [
                            'code_wo' => $code_wo,
                            'kategori' => $kategori[$x],
                            'detail' => $v,
                            'waktu' => $hasil
                        ];
                    }
                    $x++;
                endforeach;
                print_r($downtime);
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo "<br>";
                // die;
                //Data untuk update tabel wo
                $hcb_awal = $this->input->post('hcb_awal');
                $hcb_akhir = $this->input->post('hcb_akhir');
                $hcl_awal = $this->input->post('hcl_awal');
                $hcl_akhir = $this->input->post('hcl_akhir');

                $hc_kg = ($hcb_awal - $hcb_akhir);
                $hc_layer = ($hcl_awal - $hcl_akhir);
                $bs1 = $this->input->post('bs1');
                $bs2 = $this->input->post('bs2');
                $bs = $bs1 + $bs2;

                $data = [
                    'shift' => htmlspecialchars($this->input->post('shift', true)),
                    'speed_mesin' => htmlspecialchars($this->input->post('speed_mesin', true)),
                    'pemakaian_kertas' => $kertas_kg * 2,
                    'hc_kg' => $hc_kg,
                    'hc_layer' => $hc_layer,
                    'total_produksi' => htmlspecialchars($this->input->post('total_produksi', true)),
                    'berat_palet_kg' => htmlspecialchars($this->input->post('berat_palet', true)),
                    'berat_bs' => $bs,
                    'standart_tarikan' => htmlspecialchars($this->input->post('std_pull', true)),
                    'actual_tarikan' => htmlspecialchars($this->input->post('act_pull', true)),
                    'pemakaian_lem' => $sensor_lem['nilai'],
                    'masalah_produksi' => htmlspecialchars($this->input->post('masalah_produksi', true)),
                    'waktu_akhir' => $tanggal,
                    'tot_cut' => $sensor_cut['nilai']
                ];
                // Menambahkan data ke tabel tracking
                $tracking = [
                    'code' => $code_wo,
                    'tempat' => 'Mesin Laminating',
                    'status' => 'Work Order Telah Selesai Dikerjakan '
                ];

                // menambahkan data ke MRD ECK
                // $data3 = [
                //     'width' => 100,
                //     'menit' => 100,
                //     'speed' => 100
                // ];
                $data2 = $things;
                $cek1 = $this->user->updateWOL($code_wo, $data);
                $cek2 = $this->user->updateData($data2);
                $this->user->createTracking2($tracking);
                $this->user->downtime($downtime);
                sleep(1);
                $t_ava = $this->db->get_where('wo_lam', ['code_wo' => $code_wo])->row_array();
                $t_1 = date_create(date('H:i:s', strtotime($t_ava['waktu_mulai'])));
                $t_2 = date_create(date('H:i:s', strtotime($t_ava['waktu_akhir'])));
                $time = date_diff($t_1, $t_2);
                $ava = ($time->h * 60) + $time->i;
                $output_kg = $t_ava['kg_board'] * $t_ava['total_produksi'];
                $data = [
                    'total_produksi_kg' => $output_kg,
                    'ava' => $ava //$ava //nanti di ganti $ava
                ];
                $this->user->updateWOL($code_wo, $data);
                sleep(1);
                // ----------------------------------------------------------OEE----------------------
                $ava_oee = $this->user->getAvaL($code_wo);
                $pe_oee = $this->user->getPEL($code_wo);
                $yield_oee = $this->user->getYieldL($code_wo);
                $oee = $ava_oee * $pe_oee * $yield_oee;

                // var_dump($ava_oee);
                // echo "<br>";
                // var_dump($pe_oee);
                // echo "<br>";
                // var_dump($yield_oee);
                // echo "<br>";
                // var_dump($oee);
                // echo "<br>";

                // die;
                $data_oee = [
                    'code_wo' => $code_wo,
                    'mesin' => 'LAM',
                    'ava' => $ava_oee,
                    'pe' => $pe_oee,
                    'yield' => $yield_oee,
                    'oee' => $oee,
                ];
                $this->oee->insert_OEE($data_oee);
                if ($cek1 > 0) {
                    $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil Memasukan Data.">');
                    redirect('user/mesin_lam');
                } else {
                    $this->session->set_flashdata('message', '<button onclick="failed()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil Memasukan Data.">');
                    redirect('user/mesin_lam');
                }
            }
        }
    }
    // ------------------------------------------- MESIN SIKU -----------------------------------------------------
    public function mesin_siku()
    {
        $this->form_validation->set_rules('code', 'code');

        $code = $this->input->post('code');
        if (!$code) {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Mesin Siku';
            // $data['active'] = $this->user->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/siku', $data);
            $this->load->view('templates/footer');
        } else {

            $data2 = [
                'code' => $code,
                'tempat' => 'Mesin Siku',
                'status' => 'Dalam Proses Produksi '
            ];
            $this->user->createtracking($data2);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Scanning Berhasil !.</div>');
            redirect('user/mesin_eck');
        }
    }
    public function lapsiku_awal()
    {
        $this->form_validation->set_rules('code', 'code');

        $code = $this->input->post('code');
        if (!$code) {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Mesin Siku';
            // $data['active'] = $this->user->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/lapsiku_awal', $data);
            $this->load->view('templates/footer');
        } else {

            $data2 = [
                'code' => $code,
                'tempat' => 'Mesin Siku',
                'status' => 'Dalam Proses Produksi '
            ];
            $this->user->createtracking($data2);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Scanning Berhasil !.</div>');
            redirect('mesin_siku');
        }
    }
    public function lapsiku_akhir()
    {
        $this->form_validation->set_rules('code', 'code');

        $code = $this->input->post('code');
        if (!$code) {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Mesin Siku';
            // $data['active'] = $this->user->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/lapsiku_akhir', $data);
            $this->load->view('templates/footer');
        } else {

            $data2 = [
                'code' => $code,
                'tempat' => 'Mesin Siku',
                'status' => 'Dalam Proses Produksi '
            ];
            $this->user->createtracking($data2);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Scanning Berhasil !.</div>');
            redirect('user/mesin_eck');
        }
    }
    // ------------------------------------------------------- TITIK SETELAH POSDUKSI DILAKUKAN -----------------------------------------
    public function hasil_produksi()
    {
        $this->form_validation->set_rules('code', 'code');

        $code = $this->input->post('code');
        if (!$code) {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Hasil Produksi';
            // $data['active'] = $this->user->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/hasil_produksi', $data);
            $this->load->view('templates/footer');
        } else {

            $data2 = [
                'code' => $code,
                'tempat' => 'Warehouse',
                'status' => 'Produk Jadi'
            ];
            $insert = $this->user->createtracking($data2);
            if ($insert > 0) {
                $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>');
                redirect('user/hasil_produksi');
            } else {
                $this->session->set_flashdata('message', '<button onclick="failed()" class="alert" hidden>Show Snackbar</button>');
                redirect('user/hasil_produksi');
            }
        }
    }
    public function jadipdf()
    {
        // require('fpdf.php');

        //Header
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        //Gambar QR
        $pdf->Image('assets/img/logo-honicel.png', 178, 70.5, 23);

        //Content
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->SetXY(10, 43);
        $pdf->Cell(20, 1, 'CUSTOMER', 0, 1, 'L');
        $pdf->SetXY(35, 54);
        $pdf->Cell(0, 15, 'abcdefhsskh', 0, 1, 'L');
        $pdf->SetXY(58, 69);
        $pdf->Cell(0, 18, 'hadkahdue', 0, 2, 'L');
        $pdf->Cell(0, 8, 'bakbuiau', 0, 0, 'L');
        $pdf->SetXY(160, 43);
        $pdf->Cell(0, 1, 'bksgay', 0, 1, 'L');

        // Line break
        $pdf->Output();
    }

    public function itempdf($code_item)
    {
        $content = $this->db->get_where('warehouse', ['code_item' => $code_item])->result_array();
        //Header
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->Image('assets/img/logo-honicel.png', 8, 6, 20);

        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        $pdf->SetX(35);
        // Title
        $pdf->Cell(1, 0, 'PT. HONICEL INDONESIA');
        // Arial bold 12
        $pdf->SetFont('Arial', '', 11);
        // Addres & Contact
        $pdf->SetX(35);
        $pdf->Cell(1, 10, 'JL. RAYA MAUK KM.7 KAWASAN INDUSTRI MEKAR JAYA NO. 99 HJ');
        $pdf->SetX(35);
        $pdf->Cell(1, 20, 'RT.007 RW.002 MEKAR JAYA SEPATAN');
        $pdf->SetX(35);
        $pdf->Cell(1, 30, 'Tlp: 0821-1255-5 / Fax:');

        //Border
        $pdf->SetLineWidth(0.6);
        $pdf->Rect(6, 3, 198, 95, 'D');
        $pdf->Line(6, 35, 204, 35);
        $pdf->Rect(6, 35, 63, 63, 'D');

        //Content
        foreach ($content as $c) :
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(74, 38);
            $pdf->Cell(30, 5, 'ID', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['code_item'], 0, 2, 'L');
            $pdf->SetXY(74, 50);
            $pdf->Cell(30, 5, 'NAME', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['tipe'], 0, 2, 'L');
            $pdf->SetXY(74, 70);
            $pdf->Cell(30, 5, 'LENGTH', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['panjang'], 0, 2, 'L');
            $pdf->SetXY(74, 85);
            $pdf->Cell(30, 5, 'WEIGHT', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['berat'], 0, 2, 'L');
            //Gambar QR
            $pdf->Image(base_url('assets/img/qrcode/') . $c['qrcode'], 12, 40, 52);
        endforeach;
        // Line break
        $pdf->Output();
    }
    // ------------------------------------ TITIK DIMANA PRODUK AKAN KELUAR PABRIK -----------------------
    public function produk_keluar()
    {
        $this->form_validation->set_rules('code', 'code');

        $code = $this->input->post('code');
        if (!$code) {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Produk Keluar';
            // $data['active'] = $this->user->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/produk_keluar', $data);
            $this->load->view('templates/footer');
        } else {

            $data2 = [
                'code' => $code,
                'tempat' => 'Luar Pabrik',
                'status' => 'Produk Keluar'
            ];
            $insert = $this->user->createtracking($data2);
            if ($insert) {
                $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>');
                redirect('user/hasil_produksi');
            } else {
                $this->session->set_flashdata('message', '<button onclick="failed()" class="alert" hidden>Show Snackbar</button>');
                redirect('user/hasil_produksi');
            }
        }
    }




    public function coba()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Produk Keluar';
        $data['wo'] = $this->db->get('workorder')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/cobeform2', $data);
        $this->load->view('templates/footer');
    }
}
