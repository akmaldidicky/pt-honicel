<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Home_model', 'home');
    }
    public function index()
    {
        if ($this->session->userdata('role')) {
            switch ($this->session->userdata('role')) {
                case 1:
                    redirect('admin');
                    break;
                case 2:
                    redirect('supervisor');
                    break;
                case 3:
                    redirect('user');
                    break;
                case 4:
                    redirect('engineer');
                    break;
            }
        }
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('pwd', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        }

        //validasi sukses
        else {
            $this->_login();
        }
    }


    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('pwd');

        $user = $this->db->get_where('user', ['user_name' => $username])->row_array();
        $role = $user['role'];
        if ($user) {
            //usernya ada
            if ($password == $user['password']) {
                $data = [
                    'role' => $user['role'],
                    'id' => $user['id']
                ];
                switch ($role) {
                    case 1:
                        $this->session->set_userdata($data);
                        redirect('admin');
                        break;
                    case 2:
                        $this->session->set_userdata($data);
                        redirect('supervisor');
                        break;
                    case 3:
                        $this->session->set_userdata($data);
                        redirect('user');
                        break;
                    case 4:
                        $this->session->set_userdata($data);
                        redirect('engineer');
                        break;
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong Password.</div>');
                redirect('auth');
            }
        } else {
            //usernya tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            User name not registered!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
