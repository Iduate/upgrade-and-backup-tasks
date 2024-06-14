<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accountant_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertAccountant($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('accountant', $data2);
    }

    function getAccountant() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('accountant');
        return $query->result();
    }

    function getAccountantById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('accountant');
        return $query->row();
    }

    function updateAccountant($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('accountant', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('accountant');
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

    function getAccountantByIonUserId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('accountant');
        return $query->row();
    }


    //////////////////////////
    function getRecordOfficer() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('record_officer');
        return $query->result();
    }

    function insertRecordOfficer($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('record_officer', $data2);
    }

    function getRecordOfficerById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('record_officer');
        return $query->row();
    }

    function updateRecordOfficer($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('record_officer', $data);
    }

    function deleteRecordOfficer($id) {
        $this->db->where('id', $id);
        $this->db->delete('record_officer');
    }

    function updateRecordOfficerIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getRecordOfficerByIonUserId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('record_officer');
        return $query->row();
    }

    function getCheckinHistory($start, $end){
        $this->db->where("date BETWEEN $start AND $end");
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('check_in');
        return $query->result();
    }

    function getCheckinHistoryByLimit($st, $end, $limit, $start){
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->limit($limit, $start);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('check_in');
        return $query->result();
    }
    function getTotalCheckinHistory($start, $end){
        $this->db->where("date BETWEEN $start AND $end");
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('check_in');
        return $query->num_rows();
    }

    function getConsultation($start,$end,$patient){
        $this->db->where("date BETWEEN $start AND $end");
        $this->db->where('patient_id', $patient);
        $query = $this->db->get('consultation');
        return $query->row();
    }

    function getConsultationByCase($start,$end,$patient){
        $this->db->where("date BETWEEN $start AND $end");
        // $this->db->where('patient_id', $patient);
        $query = $this->db->get('medical_history');
        return $query->row();
    }

    function getAccountReport($st,$end) {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->where("amount_received IS NOT NULL");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('payment');
        return $query->result();
    }

    function getAccountReportBySearch($st, $end,$search) {
        $this->db->order_by('date', 'desc');
        $query = $this->db->select('*')
            ->from('payment')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("date BETWEEN $st AND $end")
            ->where("amount_received IS NOT NULL")
            ->where("(amount LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        return $query->result();
    }

    function getAccountReportByLimitBySearch($st, $end, $limit, $start, $search) {
        $this->db->order_by('date', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
            ->from('payment')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("date BETWEEN $st AND $end")
            ->where("amount_received IS NOT NULL")
            ->where("(amount LIKE '%" . $search . "%' OR patient_name LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        
        return $query->result();
    }

    function getAccountReportByLimit($st, $end, $limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->where("amount_received IS NOT NULL");
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('payment');
        return $query->result();
    }


    function getTotalAccountReport($st, $end) {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->where("amount_received IS NOT NULL");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('lab');
        return $query->num_rows();
    }

}
