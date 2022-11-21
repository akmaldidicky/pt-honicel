<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Sensor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Sensor_model', 'sensor');
    }
    public function index()
    {
        if (isset($_POST['nilai'])) {
            $chip_id = $this->input->post('chip_id');
            $mesin = $this->input->post('mesin');
            $nilai = $this->input->post('nilai');
            $data = [
                'chip_id' => $chip_id,
                'mesin' => $mesin,
                'nilai' => $nilai,
                'created_at' => date("Y-m-d H:i:sa")
            ];
            $this->sensor->createnilai($data);
        } else {
            echo "wrong variabel";
        }
    }
}
