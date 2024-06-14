<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lab_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    } 

    function insertLab($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('lab', $data2);
    }

    function getLab() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getLabBySearch($search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getLabByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getLabByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
        
    } 


    function getPatientLab($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getPatientLabBySearch($id,$search) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getPatientLabByLimit($id,$limit, $start) {
        $this->db->where('patient', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getPatientLabByLimitBySearch($id, $limit, $start, $search) {
        $this->db->where('patient', $id);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
        
    } 



    function getLabById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('lab');
        return $query->row();
    }

    function getLabByPatientId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getLabByPatientIdByDate($id, $date_from, $date_to) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getLabByUserId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('user', $id);
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getOtLabByPatientId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('ot_lab');
        return $query->result();
    }

    function getLabByPatientIdByStatus($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient', $id);
        $this->db->where('status', 'unpaid');
        $query = $this->db->get('lab');
        return $query->result();
    }

  
    function updateLab($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('lab', $data);
    }


    function insertLabCategory($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('lab_category', $data2);
    }

    function getLabCategory() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('lab_category');
        return $query->result();
    }

    function getLabCategoryById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('lab_category');
        return $query->row();
    }


    function updateLabCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('lab_category', $data);
    }

    function deleteLab($id) {
        $this->db->where('id', $id);
        $this->db->delete('lab');
    }

    function deleteLabCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('lab_category');
    }

    function getLabByDoctor($doctor) {
        $this->db->select('*');
        $this->db->from('lab');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('doctor', $doctor);
        $query = $this->db->get();
        return $query->result();
    }

    function getLabTest(){
        $type=0;
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query=$this->db->get('lab_test');
        return $query->result();
    }

    function getLabTestCategory(){
        $this->db->select('category');
        $this->db->from('lab_test');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->group_by('category');
        $query=$this->db->get();
        return $query->result();
    }

    function addNewLabTest($data,$cat,$price) {
        $data1 = array('name' =>$data,'category' =>$cat, 'price'=> $price, 'hospital_id' =>$this->session->userdata('hospital_id'));
        $this->db->insert('lab_test', $data1);
        return $this->db->insert_id();
    }

    function getTestByName($name) {
        $this->db->where('name',$name);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query=$this->db->get('lab_test');
        return $query->row();
    }

    function getTestById($id) {
        $this->db->where('id',$id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query=$this->db->get('lab_test');
        return $query->row();
    }

    function getLabByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('lab');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getLabByDoctorDate($doctor, $date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('lab');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('doctor', $doctor);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

 
    function getLabByUserIdByDate($user, $date_from, $date_to) {
        $this->db->order_by('id', 'desc');
        $this->db->select('*');
        $this->db->from('lab');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('user', $user);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }
    
     function insertTemplate($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('template', $data2);
    }

    function getTemplate() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('template');
        return $query->result();
    }
    
      function updateTemplate($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('template', $data);
    }
    
    function getTemplateById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('template');
        return $query->row();
    }
    
     function deletetemplate($id) {
        $this->db->where('id', $id);
        $this->db->delete('template');
    }

    function insertTest($data) {
        $this->db->insert('lab_request', $data);
    }

    function getRequests($id){
        $this->db->where("doctor",$id);
        $query = $this->db->get('lab_request');
        return $query->result();
    }

    function getRequestGroup($id){
        $this->db->where("doctor",$id);
        $this->db->group_by("date");
        $this->db->order_by("date","DESC");
        $query = $this->db->get('lab_request');
        return $query->result();
    }

    function getNewRequest(){
        $h=$this->session->userdata('hospital_id');
        $this->db->where('id', $h);
        $query = $this->db->get('hospital');
        $lc= $query->row()->request_check;
        if($lc ==""){
            $lc="1";
        }
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('date >', $lc);
        $query = $this->db->get('lab_request');
        return $query->num_rows();
    }

    function getLabRequest(){
        $h=$this->session->userdata('hospital_id');
        
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('lab_request');

        
        $this->db->where('id', $h);
        $data=array("request_check"=>time());
        $this->db->update('hospital', $data);

        return $query->result();
    }

    function getAllRequestGroup(){
        $h=$this->session->userdata('hospital_id');
        $this->db->where("hospital_id",$h);
        $this->db->group_by("date");
        $this->db->order_by("date","DESC");
        $query = $this->db->get('lab_request');
        return $query->result();
    }

    function getRequestById($id){
        
        $this->db->where('id', $id);
        $query = $this->db->get('lab_request');

        return $query->row();
    }

    function modifyRequest($rid,$test_id){
        
        $this->db->where('id', $rid);
        $data=array("request_id"=>$rid,"test_id"=>$test_id,"date"=>time());
        $this->db->insert('request_link', $data);

        $this->db->where('id', $rid);
        $data=array("status"=>"1");
        $this->db->update('lab_request', $data);
    }

    function getRequestLink($id){
        
        $this->db->where('request_id', $id);
        $query = $this->db->get('request_link');

        return $query->row();
    }


}
