<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getSum($field, $table) {
        $this->db->select_sum($field);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function getOperations(){
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('operations');
        return $query->result();
    }

    public function addOperation($data){
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $query=$this->db->insert('operations', $data2);
        return $this->db->insert_id();
    }

    public function getOperationById($id){
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('operations');
        return $query->row();
    }

    public function updateOperation($id,$data){
        $this->db->where('id', $id);
        $this->db->update('operations', $data);
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('operations');
    }

    public function getTutorials($group){
        $this->db->where('category', $group);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tutorials');
        return $query->result();
    }

}
