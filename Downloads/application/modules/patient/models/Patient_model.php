<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPatient($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('patient', $data2);
    }

    function insertSymptom($data){
        $this->db->insert('medical_history_symptom', $data);
    }

    function addSymptom($data){
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('symptom', $data2);
    }

    function insertPatientAllergy($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('allergy', $data2);
    }

    public function updatePatientAllergy($id, $data){
        $this->db->where('id', $id);
        $this->db->update('allergy', $data);
    }

    function getPatient() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getGeneralPatient() {
        $type="walkin";
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("type != '$type'");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient');
        return $query->result();
    }

    

    function getTodayPatient() {
        $type="walkin";
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('c_patient');
        return $query->result();
    }

    function getTodayPatientBySearch($search) {
        $this->db->order_by('id', 'desc');
        $type="walkin";
        $query = $this->db->select('*')
                ->from('c_patient')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    

    function getTodayPatientByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('c_patient');
        return $query->result();
    }

    function getTodayPatientByLimitBySearch($limit, $start, $search) {
        $type="walkin";
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('c_patient')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getWalkinPatient() {
        $type="walkin";
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("type = '$type'");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getPatientNote($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('bedside_note');
        return $query->result();
    }

    function getPatientNoteBySearch($patient, $search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('bedside_note')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('patient_id', $patient)
                ->where("(id LIKE '%" . $search . "%' OR date LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getPatientNoteByLimit($id,$limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('bedside_note');
        return $query->result();
    }

    function getPatientNoteByLimitBySearch($id,$limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('bedside_note')
                ->where('patient_id', $id)
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR date LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getCaseSymptoms($history_id){
        $this->db->where('history_id', $history_id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('medical_history_symptom');
        return $query->result();
    }

    function getSymptom() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('symptom');
        return $query->result();
    }

    function getLimit() {
        $current = $this->db->get_where('patient', array('hospital_id' => $this->session->userdata('hospital_id')))->num_rows();
        $limit = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row()->p_limit;
        if (!is_numeric($limit)) {
            $limit = 0;
        }
        return $limit - $current;
    }

    function getPatientBySearch($search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('patient')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getGeneralPatientBySearch($search) {
        $this->db->order_by('id', 'desc');
        $type="walkin";
        $query = $this->db->select('*')
                ->from('patient')
                ->where("type != '$type'")
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getWalkinPatientBySearch($search) {
        $this->db->order_by('id', 'desc');
        $type="walkin";
        $query = $this->db->select('*')
                ->from('patient')
                ->where("type = '$type'")
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getSymptomBySearch($search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('symptom')
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getConsultationBySearch($id,$search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('consultation')
                ->where('doctor', $id)
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getConsultation($id) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('consultation')
                ->where('doctor', $id)
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->get();
        ;
        return $query->result();
    }

    function getPatientByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getGeneralPatientByLimit($limit, $start) {
        $type="walkin";
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("type != '$type'");
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getWalkinPatientByLimit($limit, $start) {
        $type="walkin";
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("type = '$type'");
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getSymptomByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('symptom');
        return $query->result();
    }

    function getPatientByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('patient')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getGeneralPatientByLimitBySearch($limit, $start, $search) {
        $type="walkin";
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('patient')
                ->where("type != '$type'")
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getWalkinPatientByLimitBySearch($limit, $start, $search) {
        $type="walkin";
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('patient')
                ->where("type = '$type'")
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getSymptomByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('symptom')
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getPatientById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    }

    

    function getPatientByMr($mr) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('mr_no', $mr);
        $query = $this->db->get('patient');
        // if($query->num_rows() ==0){
        //     return false;
        // }
        // return true;
        return $query->row();
    }

    function getSymptomById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('symptom');
        return $query->row();
    }

    function getVitalsById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('vitals');
        return $query->row();
    }

    function getBedsideMed($id) {
        $this->db->where('note_id', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('bedside_medicine');
        return $query->result();
    }

    function getTodayVitalsById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient_id', $id);
        $gone=((Date('G')+1) * 60 * 60)+((Date('i')+1) * 60);
        $today=time()-$gone;
        $this->db->where('time >', $today);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('vitals');
        return $query->row();
    }

    function getNoteById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('bedside_note');
        return $query->row();
    }

    public function addVitalColumn($data){
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('h_vitals', $data2);
    }

    public function deleteVitalColumn($id){
        $this->db->where('id', $id);
        $this->db->delete('h_vitals');
    }

    public function getHospitalVitals(){
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id');
        $query = $this->db->get('h_vitals');
        return $query->result();
    }

    public function getVitalRow($id){
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('h_vitals');
        return $query->row();
    }

    public function updateVitalColumn($id, $data){
        $this->db->where('id', $id);
        $this->db->update('h_vitals', $data);
    }

    public function merge_patient($p1,$p2){
        $this->db->query("UPDATE allergy SET patient_id='$p1' WHERE patient_id='$p2'");
        $this->db->query("UPDATE alloted_bed SET patient='$p1' WHERE patient='$p2'");
        $this->db->query("UPDATE appointment SET patient='$p1' WHERE patient='$p2'");
        $this->db->query("UPDATE bedside_note SET patient_id='$p1' WHERE patient_id='$p2'");
        $this->db->query("UPDATE check_in SET patient_id='$p1' WHERE patient_id='$p2'");
        $this->db->query("UPDATE consultation SET patient_id='$p1' WHERE patient_id='$p2'");
        $this->db->query("UPDATE lab_request SET patient_id='$p1' WHERE patient_id='$p2'");
        $this->db->query("UPDATE medical_history SET patient_id='$p1' WHERE patient_id='$p2'");
        $this->db->query("UPDATE patient_deposit SET patient='$p1' WHERE patient='$p2'");
        $this->db->query("UPDATE patient_material SET patient='$p1' WHERE patient='$p2'");
        $this->db->query("UPDATE payment SET patient='$p1' WHERE patient='$p2'");
        $this->db->query("UPDATE prescription SET patient='$p1' WHERE patient='$p2'");
        $this->db->query("UPDATE radio_history SET patient_id='$p1' WHERE patient_id='$p2'");
        $this->db->query("UPDATE rad_request SET patient_id='$p1' WHERE patient_id='$p2'");
        $this->db->query("UPDATE vitals SET patient_id='$p1' WHERE patient_id='$p2'");
        $this->db->query("UPDATE vitals_appointment SET patient_id='$p1' WHERE patient_id='$p2'");
    }

    public function addVitalAppointment($data){
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('vitals_appointment', $data2);
    }


    public function isPatientCheckedIn($id){
        $this->db->where("patient_id",$id);
        $this->db->order_by('id','desc');
        $query=$this->db->get('check_in');
        $row=$query->row();

        if(is_null($row)){
            return false;
        }
        $id2=$row->id;
        // echo $id; die();
        $this->db->where("check_in_id",$id2);
        $query2=$this->db->get("check_out");
        // return $query2->num_rows();
        if($query2->num_rows() ==0){
            return true;
        }
        return false;

    }

    public function getCheckInId($id){
        $this->db->where("patient_id",$id);
        $this->db->order_by('id','desc');
        $query=$this->db->get('check_in');
        $row=$query->row();

        return $row->id;
    }

    public function checkoutPatient($data,$id){
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('check_out', $data2);
        $this->db->where('patient', $id);
        $this->db->delete('c_patient');
    }

    public function checkinPatient($data,$d){
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('check_in', $data2);
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($d, $data1);
        $this->db->insert('c_patient', $data2);
    }

    public function vitalsBy($vitals_by){
        switch(substr($vitals_by,0,1)){
            case "N":
                //nurse
                $this->load->model('nurse/nurse_model');
                $v=substr($vitals_by,1);
                $v=$this->nurse_model->getNurseByIonId(substr($vitals_by,1))->name;
            break;
            case "R":
                //nurse
                $this->load->model('receptionist/receptionist_model');
                $v=$this->receptionist_model->getReceptionistByIonUserId(substr($vitals_by,1))->name;
            break;
            case "D":
                //nurse
                $this->load->model('doctor/doctor_model');
                $v=$this->doctor_model->getDoctorByIonUserId(substr($vitals_by,1))->name;
            break;
            case "P":
                //nurse
                $this->load->model('doctor/Pharmacist_model');
                $v=$this->Pharmacist_model->getPharmacistByIonUserId(substr($vitals_by,1))->name;
            break;
            case "A":
                //nurse
                $this->load->model('doctor/Accountant_model');
                $v=$this->doctor_model->getAccountantByIonUserId(substr($vitals_by,1))->name;
            break;
            default:
                $this->db->where('id', $vitals_by);
                $query = $this->db->get('users');
                $v=$query->row()->username;
            break;
            
        }
        return $v;
    }

    function getAllVitalsById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('vitals');
        return $query->result();
    }

    function insertPatientVitals($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('vitals', $data2);
        return $this->db->insert_id();
    }

    function addConsultation($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('consultation', $data2);
        return $this->db->insert_id();
    }

    function insertNote($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('bedside_note', $data2);
        return $this->db->insert_id();
    }

    function insertNoteMed($data) {
        $this->db->insert('bedside_medicine', $data);
    }

    function insertCustomVitals($data) {
        $this->db->insert('custom_vitals', $data);
    }

    function getAllCVitalsById($id){
        $this->db->where('patient_id', $id);
        $query = $this->db->get('custom_vitals');
        return $query->result();

    }

    function getCustomVitals($id){
        $this->db->where('vital_id', $id);
        $query = $this->db->get('custom_vitals');
        return $query->result();
    }

    function updatePatientVitals($id, $data) {
        $this->db->where('patient_id', $id);
        $this->db->update('vitals', $data);
    }

    function getPatientByIonUserId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    }

    function getPatientByEmail($email) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('email', $email);
        $query = $this->db->get('patient');
        return $query->row();
    }

    function updatePatient($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('patient', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient');
    }

    function insertMedicalHistory($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('medical_history', $data2);
        return $this->db->insert_id();
    }

    function insertMedicalHistoryForm($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('medical_history_form', $data2);
        return $this->db->insert_id();
    }

    function getMedicalHistoryByPatientId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient_id', $id);
        $query = $this->db->get('medical_history');
        return $query->result();
    }
    

    function getMedicalHistoryByCheckin($id,$doctor) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('checkin_id', $id);
        $this->db->where('doctor_id', $doctor);
        $query = $this->db->get('medical_history');
        return $query->row();
    }

    function checkIfHistoryExist($form_id,$history_id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('form_id', $form_id);
        $this->db->where('history_id', $history_id);
        $query = $this->db->get('medical_history_form');
        return $query->num_rows()>0;
    }

    function getMedicalHistoryForm($form_id,$history_id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('history_id', $history_id);
        $this->db->where('form_id', $form_id);
        $query = $this->db->get('medical_history_form');
        return $query->row();
    }

    function getMedicalHistory() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getMedicalHistoryBySearch($search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('medical_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getMedicalHistoryByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getMedicalHistoryByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('medical_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getMedicalHistoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medical_history');
        return $query->row();
    }

    function updateMedicalHistory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medical_history', $data);
    }

    function updateMedicalHistoryForm($history_id, $form_id, $data) {
        $this->db->where('history_id', $history_id);
        $this->db->where('form_id', $form_id);
        $this->db->update('medical_history_form', $data);
    }

    function getPatientMedicalHistory($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getPatientMedicalHistoryBySearch($id,$search) {
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $sDate=strtotime($search);
        //TODO: ADD UP SEARCH WITH DATE
        $query = $this->db->select('*')
                ->from('medical_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR title LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getPatientMedicalHistoryByLimit($id,$limit, $start) {
        $this->db->where('patient_id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getPatientMedicalHistoryByLimitBySearch($id,$limit, $start, $search) {
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('medical_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR title LIKE '%" . $search . "%' OR description LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function insertDiagnosticReport($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('diagnostic_report', $data2);
    }

    function updateDiagnosticReport($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('diagnostic_report', $data);
    }

    function updateSymptom($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('symptom', $data);
    }

    function getDiagnosticReport() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('diagnostic_report');
        return $query->result();
    }

    function getDiagnosticReportById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('diagnostic_report');
        return $query->row();
    }

    function getDiagnosticReportByInvoiceId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('invoice', $id);
        $query = $this->db->get('diagnostic_report');
        return $query->row();
    }

    function getDiagnosticReportByPatientId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient', $id);
        $query = $this->db->get('diagnostic_report');
        return $query->result();
    }

    function insertPatientMaterial($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('patient_material', $data2);
    }

    function getPatientMaterial() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function getDocumentBySearch($search) {       
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('patient_material')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%' OR title LIKE '%" . $search . "%' OR datestring LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();            
    }

    function getDocumentByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function getDocumentByLimitBySearch($limit, $start, $search) {               
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('patient_material')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%' OR title LIKE '%" . $search . "%' OR datestring LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();       
    }

    function getAllOperations(){
        $this->db->order_by('name', 'asc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query=$this->db->get('operations');
        return $query->result();
    }


    function getPatientMaterialById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('patient_material');
        return $query->row();
    }

    function getPatientMaterialByPatientId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient', $id);
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function deletePatientMaterial($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_material');
    }

    function deleteMedicalHistory($id) {
        $this->db->where('id', $id);
        $this->db->delete('medical_history');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getDueBalanceByPatientId($patient) {
        $query = $this->db->get_where('payment', array('patient' => $patient))->result();
        $deposits = $this->db->get_where('patient_deposit', array('patient' => $patient))->result();
        $balance = array();
        $deposit_balance = array();
        foreach ($query as $gross) {
            $balance[] = $gross->gross_total;
        }
        $balance = array_sum($balance);


        foreach ($deposits as $deposit) {
            $deposit_balance[] = $deposit->deposited_amount;
        }
        $deposit_balance = array_sum($deposit_balance);



        $bill_balance = $balance;

        return $due_balance = $bill_balance - $deposit_balance;
    }

    function getPatientInfo($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(10);
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }

    function getSymptomInfo($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('symptom');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->limit(10);
            $fetched_records = $this->db->get('symptom');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['name'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }

    function getPatientinfoWithAddNewOption($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(10);
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        $data[] = array("id" => 'add_new', "text" => lang('add_new'));
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }
    
    function getOperationInfo($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('operations');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(10);
            $fetched_records = $this->db->get('operations');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }

    

    function getAllergyById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('allergy');
        return $query->row();
    }

    function getPatientAllergy($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('allergy');
        return $query->result();
    }

    function getPatientAllergyBySearch($patient, $search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('allergy')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('patient_id', $patient)
                ->where("(id LIKE '%" . $search . "%' OR onset LIKE '%" . $search . "%' OR severity LIKE '%" . $search . "%' OR type LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getPatientAllergyByLimit($id,$limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient_id', $id);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('allergy');
        return $query->result();
    }

    function getPatientAllergyByLimitBySearch($id,$limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('allergy')
                ->where('patient_id', $id)
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR onset LIKE '%" . $search . "%' OR severity LIKE '%" . $search . "%' OR type LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getOnePatientMaterial($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function getOnePatientMaterialBySearch($id, $search) {       
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('patient_material')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('patient', $id)
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%' OR title LIKE '%" . $search . "%' OR datestring LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();            
    }

    function getOnePatientMaterialByLimit($id, $limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient', $id);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function getOnePatientMaterialByLimitBySearch($id, $limit, $start, $search) {               
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('patient_material')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('patient', $id)
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%' OR patient_phone LIKE '%" . $search . "%' OR patient_address LIKE '%" . $search . "%' OR title LIKE '%" . $search . "%' OR datestring LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();       
    }


    function getBirthday($d) {
        //get all the prescription id from the sales
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        // $this->db->where("birthdate LIKE '%$d'");
        // $this->db->order_by('name', 'asc');
        // $query = $this->db->get('patient');
        $query = $this->db->select('*')
                ->from('patient')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(birthdate LIKE '%" . $d . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getBirthdayByLimit($d, $limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
            ->from('patient')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("(birthdate LIKE '%" . $d . "%')", NULL, FALSE)
            ->get();
        return $query->result();
    }


    function getConsultationReport($st,$end,$doctor) {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        if($doctor != -1){
            $this->db->where('doctor_id', $doctor);
        }
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getConsultationReportSearch($st, $end,$doctor, $search) {
        $this->db->order_by('date', 'desc');
        if($doctor != -1){
            $query = $this->db->select('*')
                ->from('medical_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("date BETWEEN $st AND $end")
                ->where('doctor_id', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        }else{
            $query = $this->db->select('*')
                ->from('medical_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("date BETWEEN $st AND $end")
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        }
        return $query->result();
    }

    function getConsultationReportByLimit($st, $end,$doctor, $limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        if($doctor != -1){
            $this->db->where('doctor_id', $doctor);
        }
        $this->db->order_by('date', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getConsultationReportByLimitBySearch($st, $end,$doctor, $limit, $start, $search) {
        $this->db->order_by('date', 'desc');
        $this->db->limit($limit, $start);
        if($doctor != -1){
            $query = $this->db->select('*')
                ->from('medical_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("date BETWEEN $st AND $end")
                ->where('doctor_id', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        }else{
            $query = $this->db->select('*')
                ->from('medical_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("date BETWEEN $st AND $end")
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        }
        return $query->result();
    }

    function getConsultationReportBySearch($st, $end,$doctor,$search) {
        $this->db->order_by('date', 'desc');
        if($doctor != -1){
            $query = $this->db->select('*')
                ->from('medical_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("date BETWEEN $st AND $end")
                ->where('doctor_id', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        }else{
            $query = $this->db->select('*')
                ->from('medical_history')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("date BETWEEN $st AND $end")
                ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        }
        return $query->result();
    }


    function getTotalConsultationReport($st, $end,$doctor) {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        if($doctor != -1){
            $this->db->where('doctor_id', $doctor);
        }
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('medical_history');
        return $query->num_rows();
    }

    function getRegistrationReportBySearch($st, $end,$search) {
        $this->db->order_by('date', 'desc');
        $query = $this->db->select('*')
            ->from('patient')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("registration_time BETWEEN $st AND $end")
            ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        return $query->result();
    }


    function getRegistrationReport($st,$end) {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("registration_time BETWEEN $st AND $end");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getRegistrationReportByLimitBySearch($st, $end, $limit, $start, $search) {
        $this->db->order_by('date', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
            ->from('patient')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("registration_time BETWEEN $st AND $end")
            ->where("(id LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        
        return $query->result();
    }

    function getRegistrationReportByLimit($st, $end, $limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("registration_time BETWEEN $st AND $end");
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient');
        return $query->result();
    }


    function getTotalRegistrationReport($st, $end) {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("registration_time BETWEEN $st AND $end");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient');
        return $query->num_rows();
    }

    function getAllotment() {
        $time=time();
        $this->db->where("discharge >",$time);
        $this->db->or_where("discharge","none");
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('alloted_bed');
        return $query->result();
    }

    function getBedAllotmentBySearch($search) {
        $time=time();
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('alloted_bed')
                ->where("discharge >",$time)
                ->or_where("discharge","none")
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR bed_id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getBedAllotmentByLimit($limit, $start) {
        $time=time();
        $this->db->where("discharge >",$time);
        $this->db->or_where("discharge","none");
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('alloted_bed');
        return $query->result();
    }

    function getBedAllotmentByLimitBySearch($limit, $start, $search) {
        $time=time();
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('alloted_bed')
                ->where("discharge >",$time)
                ->or_where("discharge","none")
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR bed_id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }


}
