<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }


    public function index(){
        $this->form_validation->set_rules('username','Username','required|trim');
        $this->form_validation->set_rules('password','Password','required|trim');
        if($this->form_validation->run() === false){
            $data['title'] = 'Login User';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');

        }else{
            $this->_login();
        }
    }

    public function _login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('_users',['username' => $username])->row_array();

        if($user){
                if($password === $user['password']){
                    $data = [
                        'username' => $user['username'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('admin');
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password Salah</div>');
                    redirect('auth');
                }
        } else {
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Username Tidak Terdaftar</div>');
            redirect('auth');
        }

    }

    public function logout(){
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Thank You!</div>');
        redirect('auth');
    }
}