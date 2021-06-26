<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Admin extends CI_Model {


    var $table = '_artikel';
    var $column_order = array('id','judul_artikel','isi_artikel','thumbnail_artikel','tag_artikel','kategori_artikel');
    var $order = array('id','judul_artikel','isi_artikel','thumbnail_artikel','tag_artikel','kategori_artikel');


    private function get_artikel(){
        $this->db->from($this->table);
        if(isset($_POST['search']['value'])){
            $this->db->like('judul_artikel',$_POST['search']['value']);
            $this->db->or_like('isi_artikel',$_POST['search']['value']);
            $this->db->or_like('thumbnail_artikel',$_POST['search']['value']);
            $this->db->or_like('tag_artikel',$_POST['search']['value']);
            $this->db->or_like('kategori_artikel',$_POST['search']['value']);
        }

        if(isset($_POST['order'])){
            $this->db->order_by($this->order[$_POST['order']['0']['column']],[$_POST['order']['0']['dir']]);
        }else{
            $this->db->order_by('id','ASC');
        }
    }


    public function getDataArtikel(){

        $this->get_artikel();
        if($_POST['length'] != -1){
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function filter_data(){
        $this->get_artikel();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_data(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function create($data){
        $this->db->insert('_artikel', $data);
        return $this->db->affected_rows();
    }

    public function getdataById($id){
        return $this->db->get_where($this->table,['id' => $id])->row(); 
    }

    public function update($where, $data){
        $this->db->update($this->table,$data,$where);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->delete($this->table, ['id' => $id]);
        return $this->db->affected_rows();
    }
}