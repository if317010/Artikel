<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('M_Admin');
    }

    public function index(){
        $data['admin'] = $this->db->get_where('_users', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('admin/index');
    }

    public function getData(){
        $results = $this->M_Admin->getDataArtikel();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result){
            $row = array();
            $row[] = ++$no;
            $row[] = $result->judul_artikel;
            $row[] = $result->isi_artikel;
            $row[] = $result->thumbnail_artikel;
            $row[] = $result->tag_artikel;
            $row[] = $result->kategori_artikel;
            $row[] = '
                <a href="#" class="btn btn-success btn-sm" onClick="byid('. "'". $result->id . "','edit'" .' )">Edit</a>
                <a href="#" class="btn btn-danger btn-sm" onClick="byid('. "'". $result->id . "','delete'" .' )">Hapus</a>
            ';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Admin->count_all_data(),
            "recordsFiltered" => $this->M_Admin->filter_data(),
            "data" => $data,
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function add(){
    	var_dump($this->input->post('judul'));
    	var_dump($_FILES['file']['thumbnail']);
    	die();
        // $this->_validation();

        $thumbnail = $_FILES['file'];

        if($thumbnail=''){

        }else{
            $config['upload_path']          = './assets/foto';
            $config['allowed_types']        = 'gif|jpg|png';

            $this->load->library('upload',$config);
            if(!$this->upload->do_upload('thumbnail')){
                echo "Gagal"; die();
            }else{
                $thumbnail = $this->upload->data('file_name');
            }
        }

        $data = [
            'judul_artikel' => htmlspecialchars($this->input->post('judul')),
            'isi_artikel' => htmlspecialchars($this->input->post('isi_artikel')),
            'thumbnail_artikel' => $thumbnail,
            'tag_artikel' => htmlspecialchars($this->input->post('tag')),
            'kategori_artikel' => htmlspecialchars($this->input->post('kategori')),

        ];

        if($this->M_Admin->create($data) > 0){
            $message['status'] = 'success';
        }else {
            $message['status'] = 'failed';
        };

        var_dump($data);
        die;

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function byid($id){
        $data = $this->M_Admin->getdataById($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function update(){
        $data = [
            'judul_artikel' => htmlspecialchars($this->input->post('judul')),
            'isi_artikel' => htmlspecialchars($this->input->post('isi_artikel')),
            'thumbnail_artikel' => htmlspecialchars($this->input->post('thumbnail')),
            'tag_artikel' => htmlspecialchars($this->input->post('tag')),
            'kategori_artikel' => htmlspecialchars($this->input->post('kategori')),
            
        ];

        if($this->M_Admin->update(array('id' => $this->input->post('id')),$data) > 0){
            $message['status'] = 'success';
        }else {
            $message['status'] = 'failed';
        };

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    public function delete($id){
        if($this->M_Admin->delete($id) > 0){
            $message['status'] = 'success';
        }else {
            $message['status'] = 'failed';
        };

        $this->output->set_content_type('application/json')->set_output(json_encode($message));
    }

    // private function _validation(){
    //     $data = array();
    //     $data['error_string'] = array();
    //     $data['inputerror'] = array();
    //     $data['status'] = true;

    //     if($this->input->post('judul') == ''){
    //         $data['inputerror'][] = 'judul';
    //         $data['error_string'][] = 'Data tidak boleh kosong';
    //         $data['status'] = false;
    //     }
    //     if($this->input->post('isi') == ''){
    //         $data['inputerror'][] = 'isi';
    //         $data['error_string'][] = 'Data tidak boleh kosong';
    //         $data['status'][] = false;
    //     }
    //     if($this->input->post('thumbnail') == ''){
    //         $data['inputerror'][] = 'thumbnail';
    //         $data['error_string'][] = 'Data tidak boleh kosong';
    //         $data['status'][] = false;
    //     }
    //     if($this->input->post('tag') == ''){
    //         $data['inputerror'][] = 'tag';
    //         $data['error_string'][] = 'Data tidak boleh kosong';
    //         $data['status'][] = false;
    //     }
    //     if($this->input->post('kategori') == ''){
    //         $data['inputerror'][] = 'kategori';
    //         $data['error_string'][] = 'Data tidak boleh kosong';
    //         $data['status'][] = false;
    //     }

    //     if($data['status'] == false){
    //         echo json_encode($data);
    //         exit(); 
    //     }
    // } 
}
