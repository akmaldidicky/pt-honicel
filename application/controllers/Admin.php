<?php
defined('BASEPATH') or exit('No direct script access allowed');
// date_default_timezone_set("Asia/Jakarta");

//require('./application/third_party/phpoffice/vendor/autoload.php');

use Complex\Functions;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include "vendor/phpqrcode/qrlib.php";
include "vendor/fpdf/fpdf.php";

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('User_model', 'user');
        $this->load->model('Customer_model', 'cstm');
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index_admin', $data);
        $this->load->view('templates/footer');
    }
    public function register()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['user2'] = $this->admin->getALL_user();
        $data['role'] = $this->admin->getRole();
        $this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[user.user_name]', [
            'is_unique' => 'This User has already registered!'
        ]);
        $this->form_validation->set_rules('pwd1', 'Password', 'required|trim|min_length[5]|matches[pwd2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('pwd2', 'Password', 'required|trim|matches[pwd1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Manage Account';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/mu');
            $this->load->view('templates/footer');
        } else {
            $role1 = $this->input->post('role');
            $data = [
                'user_name' => htmlspecialchars($this->input->post('username', true)),
                'password' => htmlspecialchars($this->input->post('pwd1', true)),
                'role' => $role1
            ];
            $insert = $this->db->insert('user', $data);
            sleep(2);
            $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil menambah akun.">');
            redirect('admin/register');
        }
    }
    public function edit_user($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['role'] = $this->db->get('role')->result_array();
        $data['user2'] = $this->admin->get_user($id);
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('pwd1', 'Password', 'required|trim|min_length[5]', [
            'min_length' => 'Password too short!'
        ]);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Manage Account';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_user');
            $this->load->view('templates/footer');
        } else {
            $role1 = $this->input->post('role');
            $data = [
                'user_name' => htmlspecialchars($this->input->post('username', true)),
                'password' => htmlspecialchars($this->input->post('pwd1', true)),
                'role' => $role1
            ];
            $this->admin->updateUser($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! your account has been updated.</div>');
            redirect('admin/register');
        }
    }
    public function hapus_user($id)
    {
        $this->admin->deleteUser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         your account has been deleted.</div>');
        redirect('admin/register');
    }
    // ------------------------------------------- Purchase Order --------------------------------------------
    public function po()
    {
        $this->form_validation->set_rules('tanggal', 'tanggal');
        $this->input->post('tanggal');
        $tgl = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $data['active_row'] = $this->admin->getALL_warehouse_row();

        if (!$tahun) {
            $data['title'] = 'Purchase Order';
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['active'] = $this->admin->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/po');
            $this->load->view('templates/footer');
        } else {
            if ($bulan) {
                if ($tgl) {
                    $data['title'] = 'Purchase Order';
                    $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                    $data['active'] = $this->admin->get_tanggal($tgl, $bulan, $tahun);
                    $this->load->view('templates/header', $data);
                    $this->load->view('templates/sidebar');
                    $this->load->view('templates/topbar', $data);
                    $this->load->view('admin/po');
                    $this->load->view('templates/footer');
                } else {
                    $data['title'] = 'Purchase Order';
                    $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                    $data['active'] = $this->admin->get_bulan($bulan, $tahun);
                    $this->load->view('templates/header', $data);
                    $this->load->view('templates/sidebar');
                    $this->load->view('templates/topbar', $data);
                    $this->load->view('admin/po');
                    $this->load->view('templates/footer');
                }
            } else {
                $data['title'] = 'Purchase Order';
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['active'] = $this->admin->get_tahun($tahun);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/po');
                $this->load->view('templates/footer');
            }
        }
    }
    public function detailpo($code_po)
    {
        $data['title'] = 'Purchase Order';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['active'] = $this->db->query("SELECT * FROM warehouse WHERE code_po ='$code_po'")->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detailpo');
        $this->load->view('templates/footer');
    }
    public function pok()
    {

        $po2 = $this->input->post('po2');
        $data['po'] = $this->input->post('po');
        $data['tanggal'] = $this->input->post('tanggal');
        $data['supplier'] = $this->input->post('supplier');
        $data['tipe'] = $this->input->post('tipe');
        $data['item'] = $this->db->get('tipe_item')->result_array();


        $data['tipe_item'] = $this->db->get_where('tipe_item', ['kategori' => "KERTAS"])->result_array();

        if (!$po2) {
            $this->form_validation->set_rules('po', 'Nomor PO', 'required|trim');
            $this->form_validation->set_rules('tanggal', 'Tanggal PO', 'required|trim');
            $this->form_validation->set_rules('supplier', 'Supplier', 'required|trim');
            if ($this->form_validation->run() == false) {
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['title'] = 'Purchase Order Kertas';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/pok2');
                $this->load->view('templates/footer');
            } else {
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['title'] = 'Purchase Order';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/pok2');
                $this->load->view('templates/footer');
            }
        } else {
            $this->form_validation->set_rules('total', 'total', 'required');
            if ($this->form_validation->run() == true) {


                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['title'] = 'Purchase Order';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/pok2');
                $this->load->view('templates/footer');
            } else {

                $no_po = $this->input->post('po2');
                $tanggal = $this->input->post('tanggal2');
                $tipeee = $this->input->post('tipee');
                $tipee = str_replace(' ', '', $tipeee);
                $totalitem = $this->input->post('total');
                $c = array_combine($tipee, $totalitem);
                $x = 0;
                foreach ($c as $type_paper => $values) :
                    for ($i = 0; $i < $values; $i++) {
                        $x++;
                        $no_item = str_pad($x, 3, "0", STR_PAD_LEFT);
                        # code...
                        $code_item = $type_paper . "-" . $no_item . "-" . $no_po;
                        $tempdir = "assets/img/qrcode/";        // Nama folder untuk pemyimpanan file qrcode
                        if (!file_exists($tempdir))        //jika folder belum ada, maka buat
                            mkdir($tempdir);
                        // berikut adalah parameter qr code

                        $datafix = $code_item;
                        $namafile        = $type_paper . "-" . $no_item . "-" . date('dMY-His') . ".png";
                        $quality        = "H"; // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
                        $ukuran            = 10; // 1 adalah yang terkecil, 10 paling besar
                        $padding        = 1;

                        QRCode::png($datafix, $tempdir . $namafile, $quality, $ukuran, $padding);
                        $coba[] = [
                            'code_item' => $code_item,
                            'jenis_barang' => 'KERTAS',
                            'tipe' => $type_paper,
                            'code_po' => htmlspecialchars($this->input->post('po2', true)),
                            'supplier' => htmlspecialchars($this->input->post('supplier2', true)),
                            'panjang' => '5000',
                            'qrcode' => $namafile,
                            'aktivasi' => 0,
                            'tanggal_po' => $tanggal
                        ];
                    }
                endforeach;
                $this->admin->createpok($coba);
                $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button><input type="hidden" id="pesan_alert" value="Berhasil membuat QRCode Item.">');
                redirect('admin/po');
            }
        }
    }
    public function pol()
    {

        $po2 = $this->input->post('po2');
        $data['po'] = $this->input->post('po');
        $data['tanggal'] = $this->input->post('tanggal');
        $data['supplier'] = $this->input->post('supplier');
        $data['tipe'] = $this->input->post('tipe');

        $data['item'] = $this->db->get('tipe_item')->result_array();
        // $ad = $this->db->get('tipe_item')->result_array();
        // print_r($ad);
        // die;


        $data['tipe_item'] = $this->db->get_where('tipe_item', ['kategori' => "LEM"])->result_array();

        if (!$po2) {
            $this->form_validation->set_rules('po', 'Nomor PO', 'required|trim');
            $this->form_validation->set_rules('tanggal', 'Tanggal PO', 'required|trim');
            $this->form_validation->set_rules('supplier', 'Supplier', 'required|trim');
            if ($this->form_validation->run() == false) {
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['title'] = 'Purchase Order';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/pol2');
                $this->load->view('templates/footer');
            } else {
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['title'] = 'Purchase Order Kertas';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/pol2');
                $this->load->view('templates/footer');
            }
        } else {
            $this->form_validation->set_rules('total', 'total', 'required');
            if ($this->form_validation->run() == true) {

                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['title'] = 'Purchase Order';
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/pol2');
                $this->load->view('templates/footer');
            } else {

                $no_po = $this->input->post('po2');
                $tanggal = $this->input->post('tanggal2');
                $tipeee = $this->input->post('tipee');
                $tipee = str_replace(' ', '', $tipeee);
                $totalitem = $this->input->post('total');
                $c = array_combine($tipee, $totalitem);
                $x = 0;
                foreach ($c as $type_paper => $values) :
                    for ($i = 0; $i < $values; $i++) {
                        $x++;
                        $no_item = str_pad($x, 3, "0", STR_PAD_LEFT);
                        # code...
                        $code_item = $type_paper . "-" . $no_item . "-" . $no_po;
                        $tempdir = "assets/img/qrcode/";        // Nama folder untuk pemyimpanan file qrcode
                        if (!file_exists($tempdir))        //jika folder belum ada, maka buat
                            mkdir($tempdir);
                        // berikut adalah parameter qr code

                        $datafix = $code_item;
                        $namafile        = $type_paper . "-" . $no_item . "-" . date('dMY-His') . ".png";
                        $quality        = "H"; // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
                        $ukuran            = 10; // 1 adalah yang terkecil, 10 paling besar
                        $padding        = 1;

                        QRCode::png($datafix, $tempdir . $namafile, $quality, $ukuran, $padding);
                        $coba[] = [
                            'code_item' => $code_item,
                            'jenis_barang' => 'LEM',
                            'tipe' => $type_paper,
                            'code_po' => htmlspecialchars($this->input->post('po2', true)),
                            'supplier' => htmlspecialchars($this->input->post('supplier2', true)),
                            'berat' => '1000',
                            'qrcode' => $namafile,
                            'aktivasi' => 0,
                            'tanggal_po' => $tanggal
                        ];
                    }
                endforeach;
                // var_dump($coba);
                // die;
                $this->admin->createpol($coba);

                $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button><input type="hidden" id="pesan_alert" value="Berhasil membuat QRCode Item.">');
                redirect('admin/po');
            }
        }
    }

    public function customer()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Customer';
        $data['customer'] = $this->db->get('data_customer')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar',);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/customer', $data);
        $this->load->view('templates/footer');
    }

    //  -------------------------------------------------WAROHOUSE----------------------------------------------------------------
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
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/warehouse', $data);
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
    public function edit_warehouse($code_item)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['isi'] = $this->admin->get_warehouse($code_item);
        $this->form_validation->set_rules('jb', 'jb', 'required|trim');
        $this->form_validation->set_rules('nopo', 'Nomor PO', 'required|trim');
        $this->form_validation->set_rules('supplier', 'supplier', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Manage Account';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_warehouse');
            $this->load->view('templates/footer');
        } else {
            $data = [
                'jenis_barang' => htmlspecialchars($this->input->post('jb', true)),
                'tipe' => htmlspecialchars($this->input->post('tipe', true)),
                'code_po' => htmlspecialchars($this->input->post('nopo', true)),
                'supplier' => htmlspecialchars($this->input->post('supplier', true)),
                'lebar' => $this->input->post('lebar'),
                'panjang' => $this->input->post('panjang'),
                'berat' => $this->input->post('berat')
            ];
            $this->admin->update_warehouse($code_item, $data);
            $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil Update Item.">');
            redirect('admin/warehouse');
        }
    }
    // ------------------------------------------------- Work Order ----------------------------------------------


    public function wo()
    {
        $this->form_validation->set_rules('po', 'po', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('customer', 'customer', 'required');
        $this->form_validation->set_rules('qty', 'qty', 'required');
        $this->form_validation->set_rules('cell_size', 'cell_size', 'required');
        $this->form_validation->set_rules('lebar_kertas', 'lebar_kertas', 'required');
        $this->form_validation->set_rules('tebal_kertas', 'tebal_kertas', 'required');
        $data['wo'] = $this->db->get('workorder')->result_array();
        $data['artikel'] = $this->admin->wo_artikel();
        $data['customer'] = $this->admin->wo_customer();

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Work Order';
            // $data['active'] = $this->user->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/wo', $data);
            $this->load->view('templates/footer');
        } else {
            $mesin = $this->input->post('mesin');
            $no_po = $this->input->post('po');
            $tanggal = $this->input->post('tanggal');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $customer = $this->input->post('customer');
            $cell_size = $this->input->post('cell_size');
            $paper_width = $this->input->post('lebar_kertas');
            $thickness = $this->input->post('tebal_kertas');
            $article = (($paper_width * 10 + $cell_size) * 1000) + ($thickness * 10);
            $getmrd = $this->db->get_where('mrd_eck', ['item_code' => $article])->row_array();
            $ideal = $getmrd['min/layer'];
            $kg = $getmrd['kg/layer'];
            $x = $this->admin->banyak_wo($bulan, $tahun);
            $coba = $tahun + 2000 . '-' . $bulan . '-' . $tanggal . '' . date(' H:i:s');
            $sequence = $x + 1;
            $no_item = str_pad($sequence, 3, "0", STR_PAD_LEFT);
            // $no_item = str_pad($x, 3, "0", STR_PAD_LEFT);
            # code...
            $no_wo = $tahun . "" . $bulan . "" . $no_item;
            $tempdir = "assets/img/qrcode/wo/";        // Nama folder untuk pemyimpanan file qrcode
            if (!file_exists($tempdir))        //jika folder belum ada, maka buat
                mkdir($tempdir);
            // berikut adalah parameter qr code

            $datafix = $no_wo;
            $namafile        = $no_wo . ".png";
            $quality        = "H"; // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
            $ukuran            = 10; // 1 adalah yang terkecil, 10 paling besar
            $padding        = 1;

            QRCode::png($datafix, $tempdir . $namafile, $quality, $ukuran, $padding);
            $coba = [
                'code_wo' => $no_wo,
                'no_po' => $no_po,
                'mesin' => $mesin,
                'customer' => $customer,
                'article' => $article,
                'cell_size' => $this->input->post('cell_size'),
                'paper_width' => $this->input->post('lebar_kertas'),
                'thickness' => $this->input->post('tebal_kertas'),
                'qty' => $this->input->post('qty'),
                'ideal_cycle_time' => $ideal,
                'kg_layer' => $kg,
                'tanggal' =>  $tahun . '-' . $bulan . '-' . $tanggal . '' . date(' H:i:s'),
                'qrcode' => $namafile
            ];
            $tracking = [
                'code' => $no_wo,
                'tempat' => 'Admin',
                'status' => 'Menunggu Proses Produksi'
            ];


            $this->admin->createwo($coba);
            $this->user->createTracking2($tracking);
            sleep(2);
            $this->session->set_flashdata('message2', '<div class="alert alert-success" role="alert">
            Congratulation! your Work Order Order has been created.</div>');
            redirect('admin/wo');
        }
    }
    public function wolam()
    {
        $this->form_validation->set_rules('po', 'po', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('customer', 'customer', 'required');
        $this->form_validation->set_rules('cell_size', 'cell_size', 'required');
        $this->form_validation->set_rules('top_layer', 'top_layer', 'required');
        $this->form_validation->set_rules('tebal_kertas', 'tebal_kertas', 'required');
        $this->form_validation->set_rules('lebar_kertas', 'lebar_kertas', 'required');
        $this->form_validation->set_rules('panjang', 'panjang', 'required');
        $this->form_validation->set_rules('lebar', 'lebar', 'required');
        $data['wo'] = $this->db->get('wo_lam')->result_array();
        $data['bahan'] = $this->admin->wo_bahan();
        $data['customer'] = $this->admin->wo_customer();

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Work Order';
            // $data['active'] = $this->user->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/wolam', $data);
            $this->load->view('templates/footer');
        } else {
            $mesin = $this->input->post('mesin');
            $no_po = $this->input->post('po');
            $tanggal = $this->input->post('tanggal');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $customer = $this->input->post('customer');
            $cell_size = $this->input->post('cell_size');
            $top_layer = $this->input->post('top_layer');
            $thickness = $this->input->post('tebal_kertas');
            $panjang = $this->input->post('panjang');
            $lebar = $this->input->post('lebar');
            $board_size = $panjang . $lebar;
            $article = ($thickness * 1000 + $cell_size) . $top_layer . $panjang . $lebar;
            $getmrd = $this->db->get_where('mrd_laminating', ['item_code' => $article])->row_array();
            $ideal = $getmrd['min/board'];
            $kg = $getmrd['kg/board'];
            $x = $this->admin->banyak_woL($bulan, $tahun);
            $coba = $tahun + 2000 . '-' . $bulan . '-' . $tanggal . '' . date(' H:i:s');
            $sequence = $x + 1;
            $no_item =  str_pad($sequence, 3, "0", STR_PAD_LEFT);
            // $no_item = str_pad($x, 3, "0", STR_PAD_LEFT);
            # code...
            $no_wo = 'L' . $tahun . "" . $bulan . "" . $no_item;
            $tempdir = "assets/img/qrcode/wo_lam/";        // Nama folder untuk pemyimpanan file qrcode
            if (!file_exists($tempdir))        //jika folder belum ada, maka buat
                mkdir($tempdir);
            // berikut adalah parameter qr code

            $datafix = $no_wo;
            $namafile        = $no_wo . ".png";
            $quality        = "H"; // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
            $ukuran            = 10; // 1 adalah yang terkecil, 10 paling besar
            $padding        = 1;

            QRCode::png($datafix, $tempdir . $namafile, $quality, $ukuran, $padding);
            $coba = [
                'code_wo' => $no_wo,
                'no_po' => $no_po,
                'customer' => $customer,
                'top_layer' => $top_layer,
                'cell_size' => $this->input->post('cell_size'),
                'thickness' => $this->input->post('tebal_kertas'),
                'board_size' => $board_size,
                'qty' => $this->input->post('qty'),
                'ideal_cycle_time' => $ideal,
                'article' => $article,
                'kg_board' => $kg,
                'qrcode' => $namafile,
                'created_at' =>  $tahun . '-' . $bulan . '-' . $tanggal . '' . date(' H:i:s'),
            ];
            $tracking = [
                'code' => $no_wo,
                'tempat' => 'Admin',
                'status' => 'Menunggu Proses Produksi'
            ];

            $this->admin->createWOL($coba);
            $this->user->createTracking2($tracking);
            sleep(2);
            $this->session->set_flashdata('message2', '<div class="alert alert-success" role="alert">
            Congratulation! your Work Order Order has been created.</div>');
            redirect('admin/woindex');
        }
    }
    public function woindex()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Work Order';
        // $data['active'] = $this->user->getALL_warehouse();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/woindex', $data);
        $this->load->view('templates/footer');
    }
    public function wopdf($code_wo)
    {

        $content = $this->db->get_where('workorder', ['code_wo' => $code_wo])->result_array();
        //Header
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->Header('pragma : public');
        $pdf->AddPage();

        //Gambar QR
        $pdf->Image('assets/img/logo-honicel.png', 7, 6, 18);

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
        $pdf->Rect(5, 33, 200, 90, 'D');
        $pdf->Line(5, 45, 205, 45);
        $pdf->Rect(169, 87, 36, 36, 'D');

        //Content
        foreach ($content as $c) :
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetXY(10, 39);
            $pdf->Cell(20, 1, 'WO#', 0, 0, 'L');
            $pdf->Cell(0, 1, $c['code_wo'] . '                             SUMMARY', 0, 0, 'L');
            $pdf->Cell(0, 1, '         Summary', 0, 0, 'L');
            $pdf->SetXY(10, 49);
            $pdf->Cell(40, 10, 'NO. PO', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['no_po'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'CUSTOMER', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['customer'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'CELL SIZE', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['cell_size'] . '  (mm)', 0, 1, 'L');
            $pdf->Cell(40, 10, 'PAPER WIDTH', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['paper_width'] . '  (mm)', 0, 1, 'L');
            $pdf->Cell(40, 10, 'THICKNESS', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['thickness'] . '  (mm)', 0, 1, 'L');
            $pdf->Cell(40, 10, 'ARTICLE#', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['article'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'QTY', 0, 0, 'L');
            $pdf->Cell(0, 10, ':' . $c['qty'], 0, 1, 'L');
            $pdf->Image(base_url('assets/img/qrcode/wo/') . $c['qrcode'], 172, 89, 29);
        endforeach;
        $pdf->AddPage();

        //Gambar QR
        $pdf->Image('assets/img/logo-honicel.png', 7, 6, 18);

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
        $pdf->Rect(5, 33, 200, 90, 'D');
        $pdf->Line(5, 45, 205, 45);
        $pdf->Rect(169, 87, 36, 36, 'D');

        //Content
        foreach ($content as $c) :
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetXY(10, 39);
            $pdf->Cell(20, 1, 'WO#', 0, 0, 'L');
            $pdf->Cell(0, 1, $c['code_wo'], 0, 0, 'L');
            $pdf->SetXY(10, 49);
            $pdf->Cell(40, 10, 'NO. PO', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['no_po'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'CUSTOMER', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['customer'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'CELL SIZE', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['cell_size'] . '  (mm)', 0, 1, 'L');
            $pdf->Cell(40, 10, 'PAPER WIDTH', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['paper_width'] . '  (mm)', 0, 1, 'L');
            $pdf->Cell(40, 10, 'THICKNESS', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['thickness'] . '  (mm)', 0, 1, 'L');
            $pdf->Cell(40, 10, 'ARTICLE#', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['article'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'QTY', 0, 0, 'L');
            $pdf->Cell(0, 10, ':', 0, 1, 'L');
            $pdf->Image(base_url('assets/img/qrcode/wo/') . $c['qrcode'], 172, 89, 29);
        endforeach;
        // Line break
        $pdf->Output();
    }
    public function wopdfl($code_wo)
    {
        $content = $this->db->get_where('wo_lam', ['code_wo' => $code_wo])->result_array();
        //Header
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        //Gambar QR
        $pdf->Image('assets/img/logo-honicel.png', 7, 6, 18);

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
        $pdf->Rect(5, 33, 200, 90, 'D');
        $pdf->Line(5, 45, 205, 45);
        $pdf->Rect(169, 87, 36, 36, 'D');

        //Content
        foreach ($content as $c) :
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetXY(10, 39);
            $pdf->Cell(20, 1, 'WO#', 0, 0, 'L');
            $pdf->Cell(0, 1, $c['code_wo'] . '                             SUMMARY', 0, 0, 'L');
            $pdf->Cell(0, 1, '         Summary', 0, 0, 'L');
            $pdf->SetXY(10, 49);
            $pdf->Cell(40, 5, 'NO. PO', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['no_po'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'CUSTOMER', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['customer'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'CELL SIZE', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['cell_size'] . '  (mm)', 0, 1, 'L');
            $pdf->Cell(40, 10, 'BOARD SIZE', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['board_size'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'PAPER TYPE', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['top_layer'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'THICKNESS', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['thickness'] . '  (mm)', 0, 1, 'L');
            $pdf->Cell(40, 10, 'ARTICLE#', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['article'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'QTY', 0, 0, 'L');
            $pdf->Cell(0, 10, ':' . $c['qty'], 0, 1, 'L');
            $pdf->Image(base_url('assets/img/qrcode/wo_lam/') . $c['qrcode'], 172, 89, 29);
        endforeach;
        $pdf->AddPage();

        //Gambar QR
        $pdf->Image('assets/img/logo-honicel.png', 7, 6, 18);

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
        $pdf->Rect(5, 33, 200, 90, 'D');
        $pdf->Line(5, 45, 205, 45);
        $pdf->Rect(169, 87, 36, 36, 'D');

        //Content
        foreach ($content as $c) :
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetXY(10, 39);
            $pdf->Cell(20, 1, 'WO#', 0, 0, 'L');
            $pdf->Cell(0, 1, $c['code_wo'], 0, 0, 'L');
            $pdf->SetXY(10, 49);
            $pdf->Cell(40, 10, 'NO. PO', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['no_po'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'CUSTOMER', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['customer'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'CELL SIZE', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['cell_size'] . '  (mm)', 0, 1, 'L');
            $pdf->Cell(40, 10, 'BOARD SIZE', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['board_size'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'PAPER TYPE', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['top_layer'] . '  (mm)', 0, 1, 'L');
            $pdf->Cell(40, 10, 'THICKNESS', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['thickness'] . '  (mm)', 0, 1, 'L');
            $pdf->Cell(40, 10, 'ARTICLE#', 0, 0, 'L');
            $pdf->Cell(0, 10, ': ' . $c['article'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'QTY', 0, 0, 'L');
            $pdf->Cell(0, 10, ':', 0, 1, 'L');
            $pdf->Image(base_url('assets/img/qrcode/wo_lam/') . $c['qrcode'], 172, 89, 29);
        endforeach;
        // Line break
        $pdf->Output();
    }
    public function wopdfll($code_wo)
    {
        $content = $this->db->get_where('wo_lam', ['code_wo' => $code_wo])->result_array();
        //Header
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();

        //Gambar QR
        $pdf->Image('assets/img/logo-honicel.png', 7, 6, 18);

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
        $pdf->Rect(5, 33, 200, 90, 'D');
        $pdf->Line(5, 45, 205, 45);
        $pdf->Rect(169, 87, 36, 36, 'D');

        //Content
        foreach ($content as $c) :
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(10, 39);
            $pdf->Cell(20, 1, 'WO#', 0, 0, 'L');
            $pdf->Cell(0, 1, $c['code_wo'], 0, 0, 'L');
            $pdf->SetXY(10, 49);
            $pdf->Cell(40, 5, 'NO. PO', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['no_po'], 0, 1, 'L');
            $pdf->Cell(40, 25, 'CUSTOMER', 0, 0, 'L');
            $pdf->Cell(0, 25, ': ' . $c['customer'], 0, 1, 'L');
            $pdf->Cell(40, 20, 'ARTICLE#', 0, 0, 'L');
            $pdf->Cell(0, 20, ': ' . $c['article'], 0, 1, 'L');
            $pdf->Cell(40, 10, 'QTY', 0, 0, 'L');
            $pdf->Cell(0, 10, ':', 0, 1, 'L');
            $pdf->Image(base_url('assets/img/qrcode/wo_lam/') . $c['qrcode'], 172, 89, 29);
        endforeach;
        // Line break
        $pdf->Output();
    }
    //  -------------------------------------------------ABSENSI----------------------------------------------------------------
    public function absen_masuk()
    {
        $absen = $this->input->post('kode');
        if ($absen) {

            $this->form_validation->set_rules('id_karyawan', 'id_karyawan', 'required');
            if ($this->form_validation->run() == false) {
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['title'] = 'Absensi';
                $data['form'] = 'Masuk';
                // $data['active'] = $this->user->getALL_warehouse();
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/absen_masuk', $data);
                $this->load->view('templates/footer');
            } else {
                $id = $this->input->post('id_karyawan');
                $data = [
                    'id_karyawan' => $id,
                    'jam_masuk' =>  date('Y-m-d H:i:s')

                ];
                $status = $this->user->create_absen($data);
                if ($status) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
Absen Berhasil.</div>');
                    redirect('admin/absen_masuk');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Absen GAGAL!.</div>');
                    redirect('admin/absen_masuk');
                }
            }
        } else {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Absensi';
            $data['form'] = 'Masuk';
            // $data['active'] = $this->user->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/absen_masuk', $data);
            $this->load->view('templates/footer');
        }
    }
    public function absen_pulang()
    {
        $absen = $this->input->post('kode');
        if ($absen) {

            $this->form_validation->set_rules('id_karyawan', 'id_karyawan', 'required');
            if ($this->form_validation->run() == false) {
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
                $data['title'] = 'Absensi';
                $data['form'] = 'Pulang';
                // $data['active'] = $this->user->getALL_warehouse();
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('admin/absen_pulang', $data);
                $this->load->view('templates/footer');
            } else {
                $id_karyawan = $this->input->post('id_karyawan');

                $data = [
                    'jam_pulang' =>  date('Y-m-d H:i:s')

                ];

                $get_data_id = $this->db->query("SELECT*FROM absensi where id_karyawan='$id_karyawan' ORDER BY id DESC;")->row_array();
                $id = $get_data_id['id'];
                // echo ($id);
                // die;

                $this->user->update_absen($id, $data);

                $jam_masuk = $this->db->query("SELECT hour(jam_masuk) as jam FROM absensi WHERE id = '$id' ")->row_array();
                $menit_masuk = $this->db->query("SELECT minute(jam_masuk) as menit FROM absensi WHERE id = '$id' ")->row_array();
                $jam_pulang = $this->db->query("SELECT hour(jam_pulang) as jam FROM absensi WHERE id = '$id' ")->row_array();
                $menit_pulang = $this->db->query("SELECT minute(jam_pulang) as menit FROM absensi WHERE id = '$id' ")->row_array();
                $waktu_masuk = ($jam_masuk['jam'] * 60) + $menit_masuk['menit'];
                $waktu_pulang = ($jam_pulang['jam'] * 60) + $menit_pulang['menit'];
                $waktu_kerja = $waktu_pulang - $waktu_masuk;
                $data = [
                    'lama_kerja' =>  $waktu_kerja

                ];
                $status2 = $this->user->update_absen($id, $data);
                if ($status2) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Absen Berhasil.</div>');
                    redirect('admin/absen_pulang');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Absen GAGAL!.</div>');
                    redirect('admin/absen_pulang');
                }
            }
        } else {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['title'] = 'Absensi';
            $data['form'] = 'Pulang';
            // $data['active'] = $this->user->getALL_warehouse();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/absen_pulang', $data);
            $this->load->view('templates/footer');
        }
    }
    public function absensi()
    {

        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Absensi';
        $data['form'] = '';
        // $data['active'] = $this->user->getALL_warehouse();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/absensi', $data);
        $this->load->view('templates/footer');
    }

    public function printabsen($id = false)
    {

        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['absen'] = $this->db->query("SELECT * FROM absensi JOIN data_karyawan ON data_karyawan.id_karyawan=absensi.id_karyawan WHERE data_karyawan.id=$id")->result_array();
        $data['nama'] = $this->db->query("SELECT nama_karyawan FROM data_karyawan WHERE id=$id")->row_array();
        //var_dump($data['absen']);
        //die;

        $this->load->view('admin/printabsen', $data);
    }


    // -------------------------------------------------- Export QRCode PDF--------------------------
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
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(74, 38);
            $pdf->Cell(30, 5, 'ID', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['code_item'], 0, 2, 'L');
            $pdf->SetXY(74, 50);
            $pdf->Cell(30, 5, 'NAME', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['tipe'], 0, 2, 'L');
            $pdf->SetXY(74, 70);
            $pdf->Cell(30, 5, 'LENGTH', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['panjang'] . '  m', 0, 2, 'L');
            $pdf->SetXY(74, 85);
            $pdf->Cell(30, 5, 'WEIGHT', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['berat'] . '  kg', 0, 2, 'L');
            //Gambar QR
            $pdf->Image(base_url('assets/img/qrcode/') . $c['qrcode'], 12, 40, 52);
        endforeach;
        // Line break
        $pdf->Output();
    }
    public function pdfkrywn($id_karyawan)
    {
        $content = $this->db->get_where('data_karyawan', ['id_karyawan' => $id_karyawan])->result_array();
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
            $pdf->SetFont('Arial', 'B', 16);
            // $pdf->SetXY(74, 85);
            // $pdf->Cell(30, 5, 'ID', 0, 0, 'L');
            // $pdf->Cell(0, 5, ': ', 0, 2, 'L');
            // $pdf->Cell(0, 5, ': ' . $c['nama_karyawan'], 0, 2, 'L');
            $pdf->SetXY(74, 38);
            $pdf->Cell(30, 5, 'NAMA', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['nama_karyawan'], 0, 2, 'L');
            $pdf->SetXY(74, 60);
            $pdf->Cell(30, 5, 'JABATAN', 0, 0, 'L');
            $pdf->Cell(0, 5, ': ' . $c['jabatan'], 0, 2, 'L');
            $pdf->SetXY(74, 80);
            $pdf->Cell(30, 5, 'ID', 0, 0, 'L');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 5, ':  ' . $c['id_karyawan'], 0, 2, 'L');
            //Gambar QR
            $pdf->Image(base_url('assets/img/qrcode/krywn/') . $c['qrcode'], 12, 40, 52);
        endforeach;
        // Line break
        $pdf->Output();
    }

    // --------------------------------------------------SURAT JALAN ---------------------------------
    public function suratjalan()
    {

        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Surat Jalan';
        $this->form_validation->set_rules('no_su', 'nomor surat', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('customer', 'customer', 'required');
        $this->form_validation->set_rules('no_order', 'nomor order', 'required');
        $this->form_validation->set_rules('no_po', 'no po', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $data['wo'] = $this->db->get('wo_lam')->result_array();
        $data['bahan'] = $this->admin->wo_bahan();
        $data['customer'] = $this->admin->wo_customer();

        if ($this->form_validation->run() == false) {

            $data['customer'] = $this->cstm->getAll();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/suratjalan', $data);
            $this->load->view('templates/footer');
        } else {
            $pdf = new FPDF('P', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->Image('assets/img/logo-honicel.png', 6, 6, 18);
            //Gambar QR
            $pdf->Image('assets/img/logo-honicel.png', 170, 195, 26);
            // Arial bold 15
            $pdf->SetFont('Arial', 'B', 15);
            // Move to the right
            $pdf->SetX(30);
            // Title
            $pdf->Cell(1, 0, 'PT. HONICEL INDONESIA');
            // Arial bold 12
            $pdf->SetFont('Arial', '', 11);
            // Addres & Contact
            $pdf->SetX(30);
            $pdf->Cell(1, 10, 'JL. RAYA MAUK KM.7 KAWASAN INDUSTRI MEKAR JAYA NO. 99 HJ');
            $pdf->SetX(30);
            $pdf->Cell(1, 20, 'RT.007 RW.002 MEKAR JAYA SEPATAN');
            $pdf->SetX(30);
            $pdf->Cell(1, 30, 'Tlp: 0821-1255-5 / Fax:');
            //Boerder conten
            $pdf->SetLineWidth(0.6);
            $pdf->Rect(5, 33, 200, 250, 'D');
            //Font content
            $pdf->SetFont('Arial', 'B', 15);
            //Content
            $pdf->Cell(142, 60, 'SURAT JALAN', 0, 0, 'C');
            //Date
            $tanggal = date("d M Y", strtotime($this->input->post('tanggal')));

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(5, 60, 'Tangerang, ' . $tanggal, 0, 0, 'C');
            // Arial bold 12
            $pdf->SetFont('Arial', '', 10);
            // identification
            $pdf->SetX(10);
            $pdf->Cell(1, 75, 'Surat Jalan');
            $pdf->SetX(38);
            $pdf->Cell(1, 75, ':   ' . $this->input->post('no_su'),);
            $pdf->SetX(10);
            $pdf->Cell(1, 85, 'No. Mobil');
            $pdf->SetX(38);
            $pdf->Cell(1, 85, ':');
            $pdf->SetX(10);
            $pdf->Cell(1, 95, 'No. Order Lgn');
            $pdf->SetX(38);
            $pdf->Cell(1, 95, ':   ' . $this->input->post('no_order'),);
            $pdf->SetX(10);
            $pdf->Cell(1, 105, 'PO NO');
            $pdf->SetX(38);
            $pdf->Cell(1, 105, ':   ' . $this->input->post('no_po'),);

            $pdf->SetX(120);
            $pdf->Cell(1, 75, 'Langganan');
            $pdf->SetX(140);
            $pdf->Cell(1, 75, ':   ' . $this->input->post('customer'),);
            $pdf->SetX(120);
            $pdf->Cell(1, 85, 'Alamat');
            $pdf->SetX(140);
            // $pdf->MultiCell(200, 40, ':   ' . $this->input->post('alamat'),);
            $pdf->Cell(1, 85, ':   ' . $this->input->post('alamat'),);
            $pdf->SetX(120);
            $pdf->Cell(1, 105, 'Telepon');
            $pdf->SetX(140);
            $pdf->Cell(1, 105, ':   ' . $this->input->post('telepon'),);
            $pdf->SetX(170);
            $pdf->Cell(1, 105, '/Fax');
            $pdf->SetX(178);
            $pdf->Cell(1, 105, ':   ' . $this->input->post('fax'),);
            $pdf->SetX(120);
            $pdf->Cell(1, 115, 'Up');
            $pdf->SetX(140);
            $pdf->Cell(1, 115, ':');

            //Table
            //Border
            $pdf->Line(5, 80, 205, 80);
            $pdf->Line(5, 87, 205, 87);
            $pdf->Line(5, 190, 205, 190);
            $pdf->Line(13, 80, 13, 190);
            $pdf->Line(125, 80, 125, 190);
            $pdf->Line(145, 80, 145, 190);
            $pdf->Line(170, 80, 170, 190);

            //Body Table
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetX(5);
            $pdf->Cell(8, 148, 'No', 0, 0, 'C');
            $pdf->Cell(112, 148, 'Nama Barang', 0, 0, 'C');
            $pdf->Cell(20, 148, 'Unit', 0, 0, 'C');
            $pdf->Cell(25, 148, 'Total', 0, 0, 'C');
            $pdf->Cell(35, 148, 'Total Pallet', 0, 0, 'C');

            $pdf->SetFont('Arial', '', 12);
            $pegawai = $this->db->get('user')->result_array();
            $baris = 160;
            $x = 0;
            $nama = $this->input->post('nama_barang');
            $unit = $this->input->post('unit');
            $total = $this->input->post('total');
            $total_palet = $this->input->post('total_palet');
            foreach ($nama as $n) :
                $pdf->SetX(5);
                $pdf->Cell(8, $baris, $x + 1, 0, 0, 'C');
                $pdf->Cell(112, $baris, $n, 0, 0, 'L');
                $pdf->Cell(20, $baris, $unit[$x], 0, 0, 'C');
                $pdf->Cell(25, $baris, $total[$x], 0, 0, 'C');
                $pdf->Cell(35, $baris, $total_palet[$x], 0, 0, 'C');
                $x++;
                $baris += 10;
            endforeach;
            //End of Table

            //Footer
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 195);
            $pdf->Cell(1, 1, 'Catatan :');
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(28, 195);
            $pdf->Cell(10, 1, 'BARANG YANG SUDAH DI LUAR PT HONICEL INDONESIA ');
            $pdf->SetXY(28, 200);
            $pdf->Cell(10, 1, 'SUDAH BUKAN MENJADI TANGGUNG JAWAB KAMI.');
            $pdf->SetXY(28, 210);
            $pdf->Cell(10, 1, 'JIKA CUSTOMER ATAU SUPIR EKSPEDISI YANG ');
            $pdf->SetXY(28, 215);
            $pdf->Cell(10, 1, 'MENGAMBIL BARANG TELAH MENANDATANGANI SURAT');
            $pdf->SetXY(28, 220);
            $pdf->Cell(10, 1, 'JALAN INI, MAKABERARTI BARANG DALAM KEADAAN');
            $pdf->SetXY(28, 225);
            $pdf->Cell(10, 1, 'BAIK DAN TIDAK ADA KERUSAKAN APAPUN.');

            //Mark
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetXY(28, 245);
            $pdf->Cell(20, 0, 'Diterima Oleh', 0, 1, 'C');
            $pdf->SetXY(28, 250);
            $pdf->Cell(20, 0, 'Customer/Pengemudi', 0, 1, 'C');
            $pdf->SetXY(168, 245);
            $pdf->Cell(20, 0, 'Hormat Kami,', 0, 1, 'C');
            $pdf->SetXY(168, 250);
            $pdf->Cell(20, 0, 'PT Honicel Indonesia', 0, 1, 'C');
            $pdf->SetXY(28, 267);
            $pdf->Cell(20, 0, '(_______________________)', 0, 1, 'C');
            $pdf->SetXY(168, 267);
            $pdf->Cell(20, 0, '(_______________________)', 0, 1, 'C');
            $pdf->SetXY(5, 275);
            $pdf->Cell(50, 0, 'Note : - Putih (Kembali)', 0, 0, 'C');
            $pdf->Cell(50, 0, '- Merah (Customer)', 0, 0, 'C');
            $pdf->Cell(50, 0, '- Kuning (Security)', 0, 0, 'C');
            $pdf->Cell(50, 0, '- Biru/Hijau (Arsip)', 0, 0, 'C');


            // Line break
            $pdf->Output();
        }
    }


    public function pdfsuratjalan()
    {
        // require('fpdf.php');

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->Image('assets/img/logo-honicel.png', 6, 6, 18);
        //Gambar QR
        $pdf->Image('assets/img/logo-honicel.png', 170, 195, 26);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        $pdf->SetX(30);
        // Title
        $pdf->Cell(1, 0, 'PT. HONICEL INDONESIA');
        // Arial bold 12
        $pdf->SetFont('Arial', '', 11);
        // Addres & Contact
        $pdf->SetX(30);
        $pdf->Cell(1, 10, 'JL. RAYA MAUK KM.7 KAWASAN INDUSTRI MEKAR JAYA NO. 99 HJ');
        $pdf->SetX(30);
        $pdf->Cell(1, 20, 'RT.007 RW.002 MEKAR JAYA SEPATAN');
        $pdf->SetX(30);
        $pdf->Cell(1, 30, 'Tlp: 0821-1255-5 / Fax:');
        //Boerder conten
        $pdf->SetLineWidth(0.6);
        $pdf->Rect(5, 33, 200, 250, 'D');
        //Font content
        $pdf->SetFont('Arial', 'B', 15);
        //Content
        $pdf->Cell(142, 60, 'SURAT JALAN', 0, 0, 'C');
        //Date
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(5, 60, 'Tangerang, 22 September 2022', 0, 0, 'C');
        // Arial bold 12
        $pdf->SetFont('Arial', '', 10);
        // identification
        $pdf->SetX(10);
        $pdf->Cell(1, 75, 'Surat Jalan');
        $pdf->SetX(38);
        $pdf->Cell(1, 75, ':');
        $pdf->SetX(10);
        $pdf->Cell(1, 85, 'No. Mobil');
        $pdf->SetX(38);
        $pdf->Cell(1, 85, ':');
        $pdf->SetX(10);
        $pdf->Cell(1, 95, 'No. Order Lgn');
        $pdf->SetX(38);
        $pdf->Cell(1, 95, ':');
        $pdf->SetX(10);
        $pdf->Cell(1, 105, 'PO NO');
        $pdf->SetX(38);
        $pdf->Cell(1, 105, ':');

        $pdf->SetX(120);
        $pdf->Cell(1, 75, 'Langganan');
        $pdf->SetX(140);
        $pdf->Cell(1, 75, ':');
        $pdf->SetX(120);
        $pdf->Cell(1, 85, 'Alamat');
        $pdf->SetX(140);
        $pdf->Cell(1, 85, ':');
        $pdf->SetX(120);
        $pdf->Cell(1, 105, 'Telepon');
        $pdf->SetX(140);
        $pdf->Cell(1, 105, ':');
        $pdf->SetX(170);
        $pdf->Cell(1, 105, '/Fax');
        $pdf->SetX(178);
        $pdf->Cell(1, 105, ':');
        $pdf->SetX(120);
        $pdf->Cell(1, 115, 'Up');
        $pdf->SetX(140);
        $pdf->Cell(1, 115, ':');

        //Table
        //Border
        $pdf->Line(5, 80, 205, 80);
        $pdf->Line(5, 87, 205, 87);
        $pdf->Line(5, 190, 205, 190);
        $pdf->Line(13, 80, 13, 190);
        $pdf->Line(125, 80, 125, 190);
        $pdf->Line(145, 80, 145, 190);
        $pdf->Line(170, 80, 170, 190);

        //Body Table
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetX(5);
        $pdf->Cell(8, 148, 'No', 0, 0, 'C');
        $pdf->Cell(112, 148, 'Nama Barang', 0, 0, 'C');
        $pdf->Cell(20, 148, 'Unit', 0, 0, 'C');
        $pdf->Cell(25, 148, 'Total', 0, 0, 'C');
        $pdf->Cell(35, 148, 'Total Pallet', 0, 0, 'C');

        $pdf->SetFont('Arial', '', 12);
        $pegawai = $this->db->get('user')->result_array();
        $no = 1;
        $baris = 160;
        foreach ($pegawai as $coba) :
            $pdf->SetX(5);
            $pdf->Cell(8, $baris, $no, 0, 0, 'C');
            $pdf->Cell(112, $baris, $coba['user_name'], 0, 0, 'L');
            $pdf->Cell(20, $baris, $coba['password'], 0, 0, 'C');
            $pdf->Cell(25, $baris, $coba['role'], 0, 0, 'C');
            $pdf->Cell(35, $baris, $coba['role'], 0, 0, 'C');
            $no++;
            $baris += 10;
        endforeach;
        //End of Table

        //Footer
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(10, 195);
        $pdf->Cell(1, 1, 'Catatan :');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(28, 195);
        $pdf->Cell(10, 1, 'BARANG YANG SUDAH DI LUAR PT HONICEL INDONESIA ');
        $pdf->SetXY(28, 200);
        $pdf->Cell(10, 1, 'SUDAH BUKAN MENJADI TANGGUNG JAWAB KAMI.');
        $pdf->SetXY(28, 210);
        $pdf->Cell(10, 1, 'JIKA CUSTOMER ATAU SUPIR EKSPEDISI YANG ');
        $pdf->SetXY(28, 215);
        $pdf->Cell(10, 1, 'MENGAMBIL BARANG TELAH MENANDATANGANI SURAT');
        $pdf->SetXY(28, 220);
        $pdf->Cell(10, 1, 'JALAN INI, MAKABERARTI BARANG DALAM KEADAAN');
        $pdf->SetXY(28, 225);
        $pdf->Cell(10, 1, 'BAIK DAN TIDAK ADA KERUSAKAN APAPUN.');

        //Mark
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(28, 245);
        $pdf->Cell(20, 0, 'Diterima Oleh', 0, 1, 'C');
        $pdf->SetXY(28, 250);
        $pdf->Cell(20, 0, 'Customer/Pengemudi', 0, 1, 'C');
        $pdf->SetXY(168, 245);
        $pdf->Cell(20, 0, 'Hormat Kami,', 0, 1, 'C');
        $pdf->SetXY(168, 250);
        $pdf->Cell(20, 0, 'PT Honicel Indonesia', 0, 1, 'C');
        $pdf->SetXY(28, 267);
        $pdf->Cell(20, 0, '(_______________________)', 0, 1, 'C');
        $pdf->SetXY(168, 267);
        $pdf->Cell(20, 0, '(_______________________)', 0, 1, 'C');
        $pdf->SetXY(5, 275);
        $pdf->Cell(50, 0, 'Note : - Putih (Kembali)', 0, 0, 'C');
        $pdf->Cell(50, 0, '- Merah (Customer)', 0, 0, 'C');
        $pdf->Cell(50, 0, '- Kuning (Security)', 0, 0, 'C');
        $pdf->Cell(50, 0, '- Biru/Hijau (Arsip)', 0, 0, 'C');


        // Line break
        $pdf->Output();
    }
    public function fpdf()
    {
        // require('fpdf.php');
        // file_get_contents('as');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('assets/img/logo-honicel.png', 10, 6, 13);
        // Arial bold 15
        $pdf->SetFont('Arial', 'B', 15);
        // Move to the right
        $pdf->Cell(80);
        // Title
        $pdf->Cell(30, 10, 'Title', 1, 0, 'C');
        // Line break
        $pdf->Ln(20);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Hello World!');
        $pdf->Output();
    }

    // ------------------------------------------- Generate QR Code --------------------------------------------
    public function qrcode()
    {
        $tempdir = "assets/img/qrcode";        // Nama folder untuk pemyimpanan file qrcode
        $data = [
            'user_name' => 'dicky akmaldi'
        ];
        // berikut adalah parameter qr code

        $datafix = $data;
        $namafile        = "qrcode-137.png";
        $quality        = "H"; // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
        $ukuran            = 10; // 1 adalah yang terkecil, 10 paling besar
        $padding        = 1;

        QRCode::png($datafix, $tempdir . $namafile, $quality, $ukuran, $padding);
    }
    // -------------------------------------------- KARYAWAN ----------------------------------
    public function karyawan()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Karyawan';
        $data['form'] = '';
        // $data['active'] = $this->user->getALL_warehouse();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/karyawan', $data);
        $this->load->view('templates/footer');
    }
    public function tambah_karyawan()
    {
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $id_karyawan = md5(date('h:i:s'));
        $this->form_validation->set_rules('nama', 'nama', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required|trim');
        $tempdir = "assets/img/qrcode/krywn/";        // Nama folder untuk pemyimpanan file qrcode
        if (!file_exists($tempdir))        //jika folder belum ada, maka buat
            mkdir($tempdir);
        // berikut adalah parameter qr code

        $datafix = $id_karyawan;
        $namafile        = $id_karyawan . ".png";
        $quality        = "H"; // ini ada 4 pilihan yaitu L (Low), M(Medium), Q(Good), H(High)
        $ukuran            = 10; // 1 adalah yang terkecil, 10 paling besar
        $padding        = 1;

        QRCode::png($datafix, $tempdir . $namafile, $quality, $ukuran, $padding);

        $data = [
            'id_karyawan' => $id_karyawan,
            'nama_karyawan' => $nama,
            'jabatan' => $jabatan,
            'qrcode' => $namafile,
            'created_at' => date('Y-m-d h:i:s'),
        ];
        $tambah = $this->admin->insert_krywn($data);
        if ($tambah > 0) {
            $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil menambah Karyawan.">');
            redirect('admin/listkrywn');
        } else {
            $this->session->set_flashdata('message', '<button onclick="failed()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Gagal menambah Karyawan.">');
            redirect('admin/listkrywn');
        }
    }
    public function tambah_cst()
    {
        $get = $this->db->get('data_customer')->num_rows();
        $nama = $this->input->post('name');
        $addres = $this->input->post('addres');
        $no_item =  str_pad($get + 1, 3, "0", STR_PAD_LEFT);
        $id = 'CST-' . $no_item;
        $this->form_validation->set_rules('name', 'name', 'required|trim');
        $this->form_validation->set_rules('addres', 'alamat', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<button onclick="failed()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Gagal menambah Customer. Inputan nama dan alamat harus terisi.">');
            redirect('admin/customer');
        }
        $data = [
            'id' => $id,
            'nama_customer' => $nama,
            'alamat' => $addres,
        ];
        $tambah = $this->db->insert('data_customer', $data);
        if ($tambah > 0) {
            $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil menambah Customer.">');
            redirect('admin/customer');
        } else {
            $this->session->set_flashdata('message', '<button onclick="failed()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Gagal menambah Customer.">');
            redirect('admin/customer');
        }
    }
    public function listkrywn()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Karyawan';
        $data['krywn'] = $this->db->get('data_karyawan')->result_array();
        // $data['active'] = $this->user->getALL_warehouse();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/listkrywn', $data);
        $this->load->view('templates/footer');
    }

    public function rekapdata()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Karyawan';
        $data['krywn'] = $this->db->get('data_karyawan')->result_array();
        // $data['active'] = $this->user->getALL_warehouse();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/rekapdata', $data);
        $this->load->view('templates/footer');
    }

    // ---------------------------- DELETE ----------------------------------
    public function hapus($menu = false, $id = false)
    {
        // var_dump($id);
        // die;
        if ($menu == "akun") {
            $delete = $this->admin->deleteUser($id);
            $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil menghapus akun.">');
            redirect('admin/register');
        }
        if ($menu == "krywn") {
            $delete = $this->db->delete('data_karyawan', ['id' => $id]);
            $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil menghapus akun.">');
            redirect('admin/listkrywn');
        }
        if ($menu == "cst") {
            $delete = $this->db->delete('data_customer', ['id' => $id]);
            $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil menghapus Customer.">');
            redirect('admin/customer');
        }
        if ($menu == "warehouse") {
            $delete = $this->db->delete('warehouse', ['code_item' => $id]);
            $this->session->set_flashdata('message', '<button onclick="success()" class="alert" hidden>Show Snackbar</button>  <input type="hidden" id="pesan_alert" value="Berhasil menghapus Item.">');
            redirect('admin/warehouse');
        }
    }
}
