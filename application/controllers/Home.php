<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Home_model', 'home');
        // if (!$this->session->userdata('email')) {
        //     redirect('auth');
        // }
    }

    public function index()
    {
        //$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = '';
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer');
    }
    public function device()
    {
        $data['title'] = 'My Device';
        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $data['device'] = $this->home->getdevice($id_user);
        $this->load->view('templates/header', $data);
        $this->load->view('home/device', $data);
        $this->load->view('templates/footer');
    }
    public function hapusdevice($id, $chip_id)
    {
        $this->home->deletedevice($id);
        $this->home->deletedevice_key($chip_id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Device telah dihapus!!</div>');
        redirect('home/device');
    }
    public function hapus_data()
    {
        $key_device = $this->input->post('keydevice');
        $waktuawal = $this->input->post('waktuawal');
        $waktuakhir = $this->input->post('waktuakhir');

        $this->home->deleteData($key_device, $waktuawal, $waktuakhir);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil hapus data!</div>');
        redirect('home/data_filter');
    }
    public function tambahdevice()
    {
        //$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $random = rand(100, 999);
        $waktu = date("H:i:sa");
        $key_device = md5($random . $waktu);
        $this->form_validation->set_rules('chipid', 'Chipid', 'required|trim');
        $this->form_validation->set_rules('namadevice', 'Nama_device', 'required|trim');
        $this->form_validation->set_rules('namaheader', 'Nama_header', 'required|trim');
        if ($this->form_validation->run() == false) {

            redirect('home/device');
        } else {

            $data = [
                'key_device' => $key_device,
                'id_user' => $id_user,
                'chip_id' => htmlspecialchars($this->input->post('chipid', true)),
                'nama_device' => htmlspecialchars($this->input->post('namadevice', true)),
                'nama_header' => htmlspecialchars($this->input->post('namaheader', true))

            ];
            $data2 = [
                'key_device' => $key_device,
                'id_user' => $id_user,
                'chip_id' => htmlspecialchars($this->input->post('chipid', true))

            ];
            $this->home->createDevice_key($data2);
            $this->home->createDevice($data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Device telah ditambahkan!!</div>');
            redirect('home/device');
        }
    }
    public function edit($id)
    {
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $data['header'] = $this->home->getvariable($id_user);
        $data['head'] = $this->db->get_where('variable', ['id' => $id])->result_array();
        //$data['header'] = $this->db->get_where('header', ['id_user' => $this->session->userdata('id')])->result_array();

        $this->form_validation->set_rules('namaheader', 'Nama_header', 'required|trim');
        $this->form_validation->set_rules('variabel', 'Variabel', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Header';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/edit', $data, $id);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'variabel' => htmlspecialchars($this->input->post('variabel', true))

            ];
            $this->home->updatevariabel($id, $data);
            // $this->db->where('id', $id);
            // $this->db->update('header', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Header berhasil diubah!!</div>');
            redirect('home/mydevice');
        }
    }
    public function editdevice($id)
    {
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);
        $this->db->where('is_deleted', 0);
        $data['device'] = $this->db->get_where('device', ['id' => $id])->result_array();

        $this->form_validation->set_rules('chipid', 'Chipid', 'required|trim');
        $this->form_validation->set_rules('namadevice', 'Nama_device', 'required|trim');
        $this->form_validation->set_rules('namaheader', 'Nama_header', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Device';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('home/editdevice', $data, $id);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'chip_id' => htmlspecialchars($this->input->post('chipid', true)),
                'nama_device' => htmlspecialchars($this->input->post('namadevice', true)),
                'nama_header' => htmlspecialchars($this->input->post('namaheader', true))

            ];
            $this->home->updatedevice($id, $data);
            // $this->db->where('id', $id);
            // $this->db->update('device', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Device berhasil diubah!!</div>');
            redirect('home/device');
        }
    }

    public function export()
    {

        $id_user = $this->session->userdata('id');
        $email = $this->session->userdata('email');
        $data['user'] = $this->home->getUser($email);

        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $key_device = $this->input->post('keydevice_export');
        $nama_header = $this->input->post('header_export');
        $waktu_awal = $this->input->post('waktuawal_export');
        $waktu_akhir = $this->input->post('waktuakhir_export');
        $urutan = $this->input->post('urutan_export');

        $alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

        //  HEADER----------> VARIABLE
        $nama_device =  $this->db->query("SELECT*FROM device WHERE key_device='$key_device';")->row_array();
        $nama_device2 = $nama_device['nama_device'];
        $header = $this->db->query("SELECT data.code_header as code, variable.variabel as variabel FROM data
        JOIN variable ON variable.code=data.code_header
        WHERE data.key_device ='$key_device' AND data.is_deleted=0 AND data.time_add between '$waktu_awal' AND '$waktu_akhir' AND variable.nama_header = '$nama_header'
        GROUP by code_header;")->result_array();
        $nilai = $this->db->query("CALL data_keydevice('$key_device','$urutan',' $waktu_awal','$waktu_akhir');")->result_array();
        // ----------------------===========================--------------------------------------------
        //  EXPORT EXCEL
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        //set column dimension to auto size

        // $kolom = 2;

        // $sheet->setCellValue('A1', 'No');
        // $sheet->setCellValue('B1', 'TIME_ADD');
        // foreach ($header as $h) {
        //     $sheet->setCellValue($alphabet['3'] . '1', 'A');
        //     $kolom++;
        // }
        $i = 3;
        $sheet->setCellValue('A1', $nama_device2);
        $sheet->setCellValue('A2', 'No');
        $sheet->setCellValue('B2', 'Time_add');
        foreach ($header as $h) {
            $sheet->setCellValueByColumnAndRow($i, 1, $h['variabel']);
            $i++;
        }

        $baris = 3;
        $nomer = 1;
        foreach ($nilai as $n) :
            $kolom2 = 2;

            $sheet->setCellValue('A' . $baris, $nomer);
            $sheet->setCellValue('B' . $baris, $n['time_add']);
            foreach ($header as $h) :
                $sheet->setCellValue($alphabet[$kolom2] . $baris,  $n['data_' . $h['code']]);
                $kolom2++;
            endforeach;
            $nomer++;
            $baris++;
        endforeach;
        for ($a = 'A'; $a !=  $spreadsheet->getActiveSheet()->getHighestColumn(); $a++) {
            $spreadsheet->getActiveSheet()->getColumnDimension($a)->setAutoSize(TRUE);
        }
        $date = date('d M Y');
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Mestakung ' . $date . ' (' . $nama_device2 . ').xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        redirect('home/data_filter');
    }
}
