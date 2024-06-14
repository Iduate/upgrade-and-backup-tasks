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
    function getLabTestBySearch($search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('lab_test')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR category LIKE '%" . $search . "%' OR specimen LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%'OR id LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getLabTestByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab_test');
        return $query->result();
    }

    function getLabTestByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab_test')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR category LIKE '%" . $search . "%' OR specimen LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%'OR id LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
        
    } 

    function getLabTestCategory(){
        $this->db->select('category');
        $this->db->from('lab_test');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query=$this->db->get();
        return $query->result();
    }

    function addNewLabTest($data,$cat,$price,$specimen) {
        $data1 = array('name' =>$data,'category' =>$cat, 'price'=> $price, 'specimen'=> $specimen, 'hospital_id' =>$this->session->userdata('hospital_id'));
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

    

    function getAllRequestGroup(){
        $h=$this->session->userdata('hospital_id');
        $this->db->where("hospital_id",$h);
        // $this->db->group_by("date");
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

    function getLabInfo($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR category like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('lab_test');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(10);
            $fetched_records = $this->db->get('lab_test');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }


    //radiology
    

    function addNewRadiology($data,$price) {
        $data1 = array('name' =>$data, 'price'=> $price, 'hospital_id' =>$this->session->userdata('hospital_id'));
        $this->db->insert('radiology', $data1);
        return $this->db->insert_id();
    }

    function getAllRadiology(){
        $this->db->where("hospital_id",$this->session->userdata("hospital_id"));
        $query=$this->db->get("radiology");
        return $query->result();
    }

    function insertRadTest($data){
        $this->db->insert('rad_request', $data);
    }

    function getRadiologyById($id) {
        $this->db->where('id',$id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query=$this->db->get('radiology');
        return $query->row();
    }

    function getRadRequests(){
        $h=$this->session->userdata('hospital_id');
        
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('rad_request');


        return $query->result();
    }

    function getRadRequestById($id){
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('rad_request');


        return $query->row();
    }

    

    function insertRadioHistory($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('radio_history', $data2);
        return $this->db->insert_id();
    }

    function updateRadioHistory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('radio_history', $data);
    }
    function updateRadRequest($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('rad_request', $data);
    }
    function updateLabRequest($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('lab_request', $data);
    }

    function insertRadioImage($data){
        $this->db->insert('radio_images', $data);
    }

    

    function updateRadioImage($report_id, $data) {
        $this->db->where('report_id', $report_id);
        $this->db->update('radio_images', $data);
    }

    

    function getRadReportById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('radio_history');
        return $query->row();
    }
    

    function getRadReport() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('radio_history');
        return $query->result();
    }

    

    function getRadReportBySearch($search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('radio_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR title LIKE '%" . $search . "%'OR doctor_id LIKE '%" . $search . "%'OR description LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    

    function getRadReportByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('radio_history');
        return $query->result();
    }

    function getRadReportByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('radio_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR title LIKE '%" . $search . "%'OR doctor_id LIKE '%" . $search . "%'OR description LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
        
    }

    function getRadReportImagesById($id){
        $this->db->where("report_id",$id);
        $query=$this->db->get("radio_images");
        return $query->result();
    }

    

    function getPatientRadReportBySearch($id,$search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('radio_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('patient_id', $id)
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR title LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getPatientRadReport($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('radio_history');
        return $query->result();
    }

    

    function getPatientRadReportByLimit($id,$limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('radio_history');
        return $query->result();
    }

    function getPatientRadReportByLimitBySearch($id,$limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('radio_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('patient_id', $id)
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR title LIKE '%" . $search . "%'OR doctor_name LIKE '%" . $search . "%'OR date_string LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
        
    }

    function getRadioInfo($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('radiology');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(10);
            $fetched_records = $this->db->get('radiology');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }


    function getRadRequest() { 
        $this->db->where('hospital_id', $this->session->userdata('hospital_id')); 
        $this->db->where("xray !=''");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('rad_request');
        return $query->result();
    }

    

    function getRadRequestBySearch($search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('rad_request')
                ->where('hospital_id', $this->session->userdata('hospital_id')) 
        	->where("xray !=''")
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR doctor_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    

    function getRadRequestByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id')); 
        $this->db->where("xray !=''");
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('rad_request');
        return $query->result();
    }

    function getRadRequestByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('rad_request')
                ->where('hospital_id', $this->session->userdata('hospital_id')) 
        	->where("xray !=''")
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR doctor_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
        
    }




    function getPatientRadRequest($id) { 
        $this->db->where('hospital_id', $this->session->userdata('hospital_id')); 
        $this->db->where('patient_id', $id); 
        $this->db->where("xray !=''");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('rad_request');
        return $query->result();
    }

    

    function getPatientRadRequestBySearch($id,$search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('rad_request')
                ->where('hospital_id', $this->session->userdata('hospital_id')) 
                ->where('patient_id', $id)
        	    ->where("xray !=''")
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR doctor_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    

    function getPatientRadRequestByLimit($id, $limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id')); 
        $this->db->where("xray !=''");
        $this->db->where('patient_id', $id); 
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('rad_request');
        return $query->result();
    }

    function getPatientRadRequestByLimitBySearch($id, $limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('rad_request')
                ->where('hospital_id', $this->session->userdata('hospital_id')) 
                ->where('patient_id', $id)
        	->where("xray !=''")
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR doctor_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
        
    }










    function getLabRequest(){
        $h=$this->session->userdata('hospital_id');
        
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('lab_request');
        $this->db->where("test !=''");

        
        $this->db->where('id', $h);
        $data=array("request_check"=>time());
        $this->db->update('hospital', $data);

        return $query->result();
    }
    function getLabRequestBySearch($search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('lab_request')
                ->where('hospital_id', $this->session->userdata('hospital_id')) 
        	    ->where("test !=''")
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR doctor_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    

    function getLabRequestByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id')); 
        $this->db->where("test !=''");
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab_request');
        return $query->result();
    }

    function getLabRequestByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab_request')
                ->where('hospital_id', $this->session->userdata('hospital_id')) 
        	    ->where("test !=''")
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR doctor_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
        
    }


    
    
    function getPatientLabRequestBySearch($id, $search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('lab_request')
                ->where('patient_id', $id)
                ->where('hospital_id', $this->session->userdata('hospital_id')) 
        	    ->where("test !=''")
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR doctor_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    

    function getPatientLabRequestByLimit($id, $limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id')); 
        $this->db->where("test !=''");
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab_request');
        return $query->result();
    }

    function getPatientLabRequestByLimitBySearch($id, $limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('lab_request')
                ->where('patient_id', $id)
                ->where('hospital_id', $this->session->userdata('hospital_id')) 
        	    ->where("test !=''")
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR doctor_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
        
    }



    function getPatientLabRequest($id){
        $h=$this->session->userdata('hospital_id');
        $this->db->where('patient_id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('lab_request');
        $this->db->where("test !=''");

        return $query->result();
    }
    
    




    function getRadioTest(){
        $type=0;
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query=$this->db->get('radiology');
        return $query->result();
    }
    function getRadioTestBySearch($search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('radiology')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR price LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }

    function getRadioTestByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('radiology');
        return $query->result();
    }

    function getRadioTestByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('radiology')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR price LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
        
    }

    function getXrayReport($st,$end) {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('radio_history');
        return $query->result();
    }

    function getXrayReportBySearch($st, $end,$search) {
        $this->db->order_by('date', 'desc');
        $query = $this->db->select('*')
            ->from('radio_history')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("date BETWEEN $st AND $end")
            ->where("(title LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        return $query->result();
    }

    function getXrayReportByLimitBySearch($st, $end, $limit, $start, $search) {
        $this->db->order_by('date', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
            ->from('radio_history')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("date BETWEEN $st AND $end")
            ->where("(title LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        
        return $query->result();
    }

    function getXrayReportByLimit($st, $end, $limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('radio_history');
        return $query->result();
    }


    function getTotalXrayReport($st, $end) {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('radio_history');
        return $query->num_rows();
    }


    function getLabReport($st,$end) {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('lab');
        return $query->result();
    }

    function getLabReportBySearch($st, $end,$search) {
        $this->db->order_by('date', 'desc');
        $query = $this->db->select('*')
            ->from('lab')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("date BETWEEN $st AND $end")
            ->where("(title LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        return $query->result();
    }

    function getLabReportByLimitBySearch($st, $end, $limit, $start, $search) {
        $this->db->order_by('date', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
            ->from('lab')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("date BETWEEN $st AND $end")
            ->where("(title LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        
        return $query->result();
    }

    function getLabReportByLimit($st, $end, $limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('lab');
        return $query->result();
    }


    function getTotalLabReport($st, $end) {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('lab');
        return $query->num_rows();
    }


}
