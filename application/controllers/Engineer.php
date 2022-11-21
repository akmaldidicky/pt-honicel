<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Engineer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Engineer_model', 'engineer');
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Device';
        $data['device'] = $this->engineer->getdevice();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('engineer/device', $data);
        $this->load->view('templates/footer');
    }
    // ------------------------------------------------------------------ Device ------------------------------------------------------------//
    // public function device()
    // {
    //     $data['title'] = 'My Device';
    //     // $id_user = $this->session->userdata('id');
    //     // $email = $this->session->userdata('email');
    //     $data['device'] = $this->engineer->getdevice();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('engineer/device', $data);
    //     $this->load->view('templates/footer');
    // }
    public function tambah_device()
    {

        // $random = rand(100, 999);
        $waktu = date("H:i:sa");
        // $key_device = md5($random . $waktu);
        $this->form_validation->set_rules('chipid', 'Chipid', 'required|trim');
        $this->form_validation->set_rules('namadevice', 'Nama_device', 'required|trim');
        // $this->form_validation->set_rules('namaheader', 'Nama_header', 'required|trim');
        if ($this->form_validation->run() == false) {

            redirect('engineer');
        } else {

            $data = [
                // 'key_device' => $key_device,
                'chip_id' => htmlspecialchars($this->input->post('chipid', true)),
                'nama_device' => htmlspecialchars($this->input->post('namadevice', true))

            ];

            $this->engineer->createDevice($data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Device telah ditambahkan!!</div>');
            redirect('engineer');
        }
    }
    public function edit_device($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['device'] = $this->db->get_where('device', ['id' => $id])->result_array();

        $this->form_validation->set_rules('chipid', 'Chipid', 'required|trim');
        $this->form_validation->set_rules('namadevice', 'Nama_device', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Device';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('engineer/editdevice', $data, $id);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'chip_id' => htmlspecialchars($this->input->post('chipid', true)),
                'nama_device' => htmlspecialchars($this->input->post('namadevice', true))

            ];
            $this->engineer->updatedevice($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Device berhasil diubah!!</div>');
            redirect('engineer');
        }
    }
    public function hapus_device($id)
    {
        $this->engineer->deletedevice($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Device telah dihapus!!</div>');
        redirect('engineer');
    }
    // ----------------------------------------------------------------------------MENU -----------------------------------------------------------
    public function menu()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $data['title'] = 'SubMenu Management';
        $data['menu'] = $this->engineer->getmenu();
        $data['menu2'] = $this->db->get('user_menu')->result_array();
        // $data['device'] = $this->engineer->getdevice();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('engineer/menu', $data);
        $this->load->view('templates/footer');
    }
    public function tambah_menu()
    {
        $this->form_validation->set_rules('title', 'title', 'required|trim');
        $this->form_validation->set_rules('nama_menu', 'nama_menu', 'required|trim');
        $this->form_validation->set_rules('url', 'url', 'required|trim');
        $this->form_validation->set_rules('icon', 'icon', 'required|trim');
        if ($this->form_validation->run() == false) {

            redirect('engineer/menu');
        } else {

            $data = [
                // 'key_device' => $key_device,
                'menu_id' => htmlspecialchars($this->input->post('nama_menu', true)),
                'title' => htmlspecialchars($this->input->post('title', true)),
                'url' => htmlspecialchars($this->input->post('url', true)),
                'icon' => htmlspecialchars($this->input->post('icon', true)),
                'is_active' => htmlspecialchars($this->input->post('active', true))

            ];

            $this->engineer->createmenu($data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Device telah ditambahkan!!</div>');
            redirect('engineer/menu');
        }
    }
    public function edit_menu($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['menu'] = $this->engineer->db->get_where('user_sub_menu', ['id' => $id])->result_array();
        $data['menu2'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'title', 'required|trim');
        $this->form_validation->set_rules('nama_menu', 'nama_menu', 'required|trim');
        $this->form_validation->set_rules('url', 'url', 'required|trim');
        $this->form_validation->set_rules('icon', 'icon', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('engineer/edit_menu', $data, $id);
            $this->load->view('templates/footer');
        } else {
            $data = [
                // 'key_device' => $key_device,
                'menu_id' => htmlspecialchars($this->input->post('nama_menu', true)),
                'title' => htmlspecialchars($this->input->post('title', true)),
                'url' => htmlspecialchars($this->input->post('url', true)),
                'icon' => htmlspecialchars($this->input->post('icon', true)),
                'is_active' => htmlspecialchars($this->input->post('active', true))

            ];
            $this->engineer->updatemenu($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu berhasil diubah!!</div>');
            redirect('engineer/menu');
        }
    }
    public function hapus_menu($id)
    {
        $this->engineer->deletemenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menu telah dihapus!!</div>');
        redirect('engineer/menu');
    }
    // ------------------------------------------------------------- Master Raw Data Laminating -----------------------------------------------------------------------
    public function mrd_laminating()
    {
        $data['title'] = 'Master Raw Data Laminating';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['mrd_laminating'] = $this->db->get_where('mrd_laminating', ['master' => 1])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('engineer/mrd_laminating', $data);
        $this->load->view('templates/footer');
    }
    public function edit_mrd_l($id)
    {

        $data['mrd_l'] = $this->db->get_where('mrd_laminating', ['id' => $id])->result_array();
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $this->form_validation->set_rules('item_code', 'item_code', 'required|trim');
        $this->form_validation->set_rules('tebal', 'tebal', 'required|trim');
        $this->form_validation->set_rules('cell_size', 'cell_size', 'required|trim');
        $this->form_validation->set_rules('panjang', 'panjang', 'required|trim');
        $this->form_validation->set_rules('lebar', 'lebar', 'required|trim');
        $this->form_validation->set_rules('board/pallet', 'board/pallet', 'required|trim');
        $this->form_validation->set_rules('waktu', 'waktu', 'required|trim');
        $this->form_validation->set_rules('menit', 'menit', 'required|trim');
        $this->form_validation->set_rules('min/board', 'min/board', 'required|trim');
        $this->form_validation->set_rules('speed', 'speed', 'required|trim');
        $this->form_validation->set_rules('weight/pallet', 'weight/pallet', 'required|trim');
        $this->form_validation->set_rules('kg/board', 'kg/board', 'required|trim');
        $this->form_validation->set_rules('pulling_std', 'pulling_std', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Device';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('engineer/edit_mrd_l', $data, $id);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'item_code' => htmlspecialchars($this->input->post('item_code', true)),
                'tebal' => htmlspecialchars($this->input->post('tebal', true)),
                'cell_size' => htmlspecialchars($this->input->post('cell_size', true)),
                'panjang' => htmlspecialchars($this->input->post('panjang', true)),
                'lebar' => htmlspecialchars($this->input->post('lebar', true)),
                'board/pallet' => htmlspecialchars($this->input->post('board/pallet', true)),
                'waktu' => htmlspecialchars($this->input->post('waktu', true)),
                'menit' => htmlspecialchars($this->input->post('menit', true)),
                'min/board' => htmlspecialchars($this->input->post('min/board', true)),
                'speed' => htmlspecialchars($this->input->post('speed', true)),
                'weight/pallet' => htmlspecialchars($this->input->post('weight/pallet', true)),
                'kg/board' => htmlspecialchars($this->input->post('kg/board', true)),
                'pulling_std' => htmlspecialchars($this->input->post('pulling_std', true))

            ];
            $this->engineer->updatemrd_l($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">MRD berhasil diubah!!</div>');
            redirect('engineer/mrd_laminating');
        }
    }
    public function tambah_mrd_l()
    {

        $this->form_validation->set_rules('tebal', 'tebal', 'required|trim');
        $this->form_validation->set_rules('cell_size', 'cell_size', 'required|trim');
        $this->form_validation->set_rules('panjang', 'panjang', 'required|trim');
        $this->form_validation->set_rules('lebar', 'lebar', 'required|trim');
        $this->form_validation->set_rules('board/pallet', 'board/pallet', 'required|trim');
        $this->form_validation->set_rules('waktu', 'waktu', 'required|trim');
        $this->form_validation->set_rules('menit', 'menit', 'required|trim');
        $this->form_validation->set_rules('min/board', 'min/board', 'required|trim');
        $this->form_validation->set_rules('speed', 'speed', 'required|trim');
        $this->form_validation->set_rules('weight/pallet', 'weight/pallet', 'required|trim');
        $this->form_validation->set_rules('kg/board', 'kg/board', 'required|trim');
        $this->form_validation->set_rules('pulling_std', 'pulling_std', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('engineer/mrd_laminating');
        } else {
            $this->form_validation->set_rules('item_code', 'item_code', 'required|trim|is_unique[mrd_laminating.item_code]', [
                'is_unique' => 'Item Code ini sudah terdaftar!'
            ]);
            if ($this->form_validation->run() == false) {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Header ini telah terdaftar (ganti yang lain)!!</div>');
                redirect('engineer/mrd_laminating');
            } else {
                $data = [
                    'item_code' => htmlspecialchars($this->input->post('item_code', true)),
                    'tebal' => htmlspecialchars($this->input->post('tebal', true)),
                    'cell_size' => htmlspecialchars($this->input->post('cell_size', true)),
                    'panjang' => htmlspecialchars($this->input->post('panjang', true)),
                    'lebar' => htmlspecialchars($this->input->post('lebar', true)),
                    'board/pallet' => htmlspecialchars($this->input->post('board/pallet', true)),
                    'waktu' => htmlspecialchars($this->input->post('waktu', true)),
                    'menit' => htmlspecialchars($this->input->post('menit', true)),
                    'min/board' => htmlspecialchars($this->input->post('min/board', true)),
                    'speed' => htmlspecialchars($this->input->post('speed', true)),
                    'weight/pallet' => htmlspecialchars($this->input->post('weight/pallet', true)),
                    'kg/board' => htmlspecialchars($this->input->post('kg/board', true)),
                    'pulling_std' => htmlspecialchars($this->input->post('pulling_std', true)),
                    'master' => 1

                ];
                $this->engineer->createmrd_l($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">MRD berhasil diubah!!</div>');
                redirect('engineer/mrd_laminating');
            }
        }
    }
    public function hapus_mrd_l($id)
    {
        $this->engineer->deleteMrd_l($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Device telah dihapus!!</div>');
        redirect('engineer/mrd_laminating');
    }


    // ------------------------------------------------------------------------ Master RAW DATA ECK ------------------------------------------------//
    public function mrd_eck()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Master Raw Data ECK';
        $data['mrd_eck'] = $this->db->get_where('mrd_eck', ['master' => 1])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('engineer/mrd_eck', $data);
        $this->load->view('templates/footer');
    }
    public function edit_mrd_eck($id)
    {
        $data['mrd_eck'] = $this->db->get_where('mrd_eck', ['id' => $id])->result_array();
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $this->form_validation->set_rules('item_code', 'item_code', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = '';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('engineer/edit_mrd_eck', $data, $id);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'item_code' => htmlspecialchars($this->input->post('item_code', true)),
                'cell_size' => htmlspecialchars($this->input->post('cell_size', true)),
                'width' => htmlspecialchars($this->input->post('width', true)),
                'tebal' => htmlspecialchars($this->input->post('tebal', true)),
                'layer/pallet' => htmlspecialchars($this->input->post('layer/pallet', true)),
                'durasi' => htmlspecialchars($this->input->post('durasi', true)),
                'menit' => htmlspecialchars($this->input->post('menit', true)),
                'min/layer' => htmlspecialchars($this->input->post('min/layer', true)),
                'speed' => htmlspecialchars($this->input->post('speed', true)),
                'total_weight' => htmlspecialchars($this->input->post('total_weight', true)),
                'kg/layer' => htmlspecialchars($this->input->post('kg/layer', true))

            ];
            $this->engineer->updatemrd_eck($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">MRD berhasil diubah!!</div>');
            redirect('engineer/mrd_eck');
        }
    }
    public function tambah_mrd_eck()
    {

        $this->form_validation->set_rules('tebal', 'tebal', 'required|trim');
        $this->form_validation->set_rules('cell_size', 'cell_size', 'required|trim');
        $this->form_validation->set_rules('layer/pallet', 'layer/pallet', 'required|trim');
        $this->form_validation->set_rules('durasi', 'durasi', 'required|trim');
        $this->form_validation->set_rules('menit', 'menit', 'required|trim');
        $this->form_validation->set_rules('min/layer', 'min/layer', 'required|trim');
        $this->form_validation->set_rules('speed', 'speed', 'required|trim');
        $this->form_validation->set_rules('total_weight', 'total_weight', 'required|trim');
        $this->form_validation->set_rules('kg/layer', 'kg/layer', 'required|trim');

        if ($this->form_validation->run() == false) {
            redirect('engineer/mrd_eck');
        } else {
            $this->form_validation->set_rules('item_code', 'item_code', 'required|trim|is_unique[mrd_eck.item_code]', [
                'is_unique' => 'Item Code ini sudah terdaftar!'
            ]);
            if ($this->form_validation->run() == false) {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Header ini telah terdaftar (ganti yang lain)!!</div>');
                redirect('engineer/mrd_eck');
            } else {
                $data = [
                    'item_code' => htmlspecialchars($this->input->post('item_code', true)),
                    'cell_size' => htmlspecialchars($this->input->post('cell_size', true)),
                    'width' => htmlspecialchars($this->input->post('width', true)),
                    'tebal' => htmlspecialchars($this->input->post('tebal', true)),
                    'layer/pallet' => htmlspecialchars($this->input->post('layer/pallet', true)),
                    'durasi' => htmlspecialchars($this->input->post('durasi', true)),
                    'menit' => htmlspecialchars($this->input->post('menit', true)),
                    'min/layer' => htmlspecialchars($this->input->post('min/layer', true)),
                    'speed' => htmlspecialchars($this->input->post('speed', true)),
                    'total_weight' => htmlspecialchars($this->input->post('total_weight', true)),
                    'kg/layer' => htmlspecialchars($this->input->post('kg/layer', true)),
                    'master' => 1
                ];
                $this->engineer->createmrd_eck($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">MRD berhasil ditambahkan!!</div>');
                redirect('engineer/mrd_eck');
            }
        }
    }
    public function hapus_mrd_eck($id)
    {
        $this->engineer->deleteMrd_eck($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Device telah dihapus!!</div>');
        redirect('engineer/mrd_eck');
    }
}
