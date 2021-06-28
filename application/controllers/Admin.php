<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('M_Admin');
        $this->load->library('form_validation');
        $this->load->library('upload');
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
                // $config['upload_path']          = './assets/images/';
                // $config['allowed_types']        = 'gif|jpg|png|jpeg';
                // $config['max_size']             = 10000;
                // $config['max_width']            = 10000;
                // $config['max_height']           = 10000;

                // $this->load->library('upload', $config);

                // if (! $this->upload->do_upload('thumbnail_artikel'))
                // {
                //     echo "Gagal Upload";
                // }else{

                //     $gambar = $this->upload->data();
                //     $gambar = $gambar['file_name'];
                //     $judul = $this->input->post('judul',TRUE);
                //     $isi_artikel = $this->input->post('isi_artikel',TRUE);
                //     $tag = $this->input->post('tag',TRUE);
                //     $kategori = $this->input->post('kategori',TRUE);

                //     $data = array(
                //         'judul_artikel' => $judul,
                //         'isi_artikel' => $isi_artikel,
                //         'thumbnail_artikel' => $gambar,
                //         'tag_artikel' => $tag,
                //         'kategori_artikel' => $kategori
                //     );

                    $data = [
                        'judul_artikel' => htmlspecialchars($this->input->post('judul')),
                        'isi_artikel' => htmlspecialchars($this->input->post('isi_artikel')),
                        'thumbnail_artikel' => htmlspecialchars($this->input->post('thumbnail_artikel')),
                        'tag_artikel' => htmlspecialchars($this->input->post('tag')),
                        'kategori_artikel' => htmlspecialchars($this->input->post('kategori')),
            
                    ];

                    if($this->M_Admin->create($data) > 0){
                        $message['status'] = 'success';
                    }else {
                        $message['status'] = 'failed';
                    };
                    $this->output->set_content_type('application/json')->set_output(json_encode($message));
                // }



    }

    public function byid($id){
        $data = $this->M_Admin->getdataById($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function update(){
        $data = [
            'judul_artikel' => htmlspecialchars($this->input->post('judul')),
            'isi_artikel' => htmlspecialchars($this->input->post('isi_artikel')),
            'thumbnail_artikel' => htmlspecialchars($this->input->post('thumbnail_artikel')),
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

}
