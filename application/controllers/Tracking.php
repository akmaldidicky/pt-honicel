<?php
defined('BASEPATH') or exit('No direct script access allowed');

//require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Tracking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Tracking_model', 'tracking');
        is_logged_in();
    }

    public function index()
    {

        $data['title'] = 'Tracking';
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('supervisor/index', $data);
        $this->load->view('templates/footer');
    }
    public function item($code_item = null)
    {

        if ($code_item) {

            $data['title'] = 'Tracking Item';
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['warehouse'] = $this->db->query("SELECT * FROM tracking where code = '$code_item' ORDER BY id DESC LIMIT 1;")->result_array();
            // $data['warehouse'] = $this->tracking->getCode_warehouse($code_item);
            $data['tracking'] = $this->tracking->getTracking($code_item);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('tracking/item', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Tracking Item';
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            // $data['warehouse'] = $this->tracking->getCode_warehouse($code_item);
            $data['tracking'] = $this->tracking->getTracking($code_item);
            $this->form_validation->set_rules('codewo', 'codewo', 'required|trim');
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('tracking/item', $data);
                $this->load->view('templates/footer');
            } else {
                $data['title'] = 'Tracking Item';
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

                $codewo = $this->input->post('codewo');
                $data['warehouse'] = $this->db->query("SELECT * FROM tracking where code = '$codewo' ORDER BY id DESC LIMIT 1;")->result_array();
                // $data['warehouse'] = $this->tracking->getCode_warehouse($codewo);
                $data['tracking'] = $this->tracking->getTracking($codewo);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('tracking/item', $data);
                $this->load->view('templates/footer');
            }
        }
    }
    public function wo($code_item = null)
    {

        if ($code_item) {

            $data['title'] = '';
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            $data['warehouse'] = $this->db->query("SELECT * FROM tracking where code = '$code_item' ORDER BY id DESC LIMIT 1;")->result_array();
            // $data['warehouse'] = $this->tracking->getCode_warehouse($code_item);
            $data['tracking'] = $this->tracking->getTracking($code_item);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('templates/topbar', $data);
            $this->load->view('tracking/wo', $data);
            $this->load->view('templates/footer');
        } else {
            $data['title'] = '';
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
            // $data['warehouse'] = $this->tracking->getCode_warehouse($code_item);
            $data['tracking'] = $this->tracking->getTracking($code_item);
            $this->form_validation->set_rules('codewo', 'codewo', 'required|trim');
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('tracking/wo', $data);
                $this->load->view('templates/footer');
            } else {
                $data['title'] = '';
                $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

                $codewo = $this->input->post('codewo');
                $data['warehouse'] = $this->db->query("SELECT * FROM tracking where code = '$codewo' ORDER BY id DESC LIMIT 1;")->result_array();
                // $data['warehouse'] = $this->tracking->getCode_warehouse($codewo);
                $data['tracking'] = $this->tracking->getTracking($codewo);
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('templates/topbar', $data);
                $this->load->view('tracking/wo', $data);
                $this->load->view('templates/footer');
            }
        }
    }
}
