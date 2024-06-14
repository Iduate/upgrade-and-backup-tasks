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

    public function isPatientCheckedIn($id){
        $this->db->where("patient_id",$id);
        $this->db->order_by('id','desc');
        $query=$this->db->get('check_in');
        $row=$query->row();

        $id2=$row->id;
        if($id2 ==null){
            return false;
        }
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

    public function checkoutPatient($data){
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('check_out', $data2);
    }

    public function checkinPatient($data){
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('check_in', $data2);
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
                $v="";
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

}
