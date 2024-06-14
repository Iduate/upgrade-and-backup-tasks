<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prescription_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPrescription($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('prescription', $data2);
    }

    function getPrescription() {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', "0");
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('prescription');
        return $query->result();
    }

    function getPrescriptionById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('prescription'); 
        return $query->row();
    }

    function getPrescriptionByPatientId($patient_id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $patient_id);
        $query = $this->db->get('prescription');
        return $query->result();
    }

    function getPrescriptionByDoctorId($doctor_id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $this->db->where('doctor', $doctor_id);
        $query = $this->db->get('prescription');
        return $query->result();
    }

    function updatePrescription($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('prescription', $data);
    }

    function deletePrescription($id) {
        $this->db->where('id', $id);
        $this->db->delete('prescription');
    }

    function getPrescriptionBySearch($search) {
        $this->db->order_by('date', 'desc');
        $query = $this->db->select('*')
                ->from('prescription')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('status','0')
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        
        return $query->result();
    }

    function getTotalDispensed(){
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('pharmacy_payment')->result();
        $list=array();
        foreach($query as $r){
            if($r->prescription_id ===null)
                continue;
            array_push($list,$r->prescription_id);
        }
        $feederslist=join("','",$list);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("id IN ('$feederslist')");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('prescription');
        return $query->num_rows();
    }

    function getTotalPrescription(){
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('pharmacy_payment')->result();
        $list=array();
        foreach($query as $r){
            if($r->prescription_id ===null)
                continue;
            array_push($list,$r->prescription_id);
        }
        $feederslist=join("','",$list);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("id NOT IN ('$feederslist')");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('prescription');
        return $query->num_rows();
    }

    function getPrescriptionByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status','0');
        $this->db->order_by('date', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('prescription');
        return $query->result();
    }

    function getPrescriptionByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('date', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('prescription')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('status','0')
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getPrescriptionByDoctor($doctor_id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('doctor', $doctor_id);
        $query = $this->db->get('prescription');
        return $query->result();
    }

    function getPrescriptionBySearchByDoctor($doctor, $search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('prescription')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getPrescriptionByLimitByDoctor($doctor, $limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('doctor', $doctor);
        $this->db->limit($limit, $start);
        $query = $this->db->get('prescription');
        return $query->result();
    }

    function getPrescriptionByLimitBySearchByDoctor($doctor, $limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('prescription')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('doctor', $doctor)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getDispensedPrescription() {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('pharmacy_payment')->result();
        $list=array();
        foreach($query as $r){
            if($r->prescription_id ===null)
                continue;
            array_push($list,$r->prescription_id);
        }
        $feederslist=join("','",$list);
        // echo $feederslist; die();
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("id IN ('$feederslist')");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('prescription');
        return $query->result();
    }

    function getDispensedPrescriptionBySearch($search) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('pharmacy_payment')->result();
        $list=array();
        foreach($query as $r){
            if($r->prescription_id ===null)
                continue;
            array_push($list,$r->prescription_id);
        }
        $feederslist=join("','",$list);
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('prescription')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("id IN ('$feederslist')")
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getDispensedPrescriptionByLimit($limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('pharmacy_payment')->result();
        $list=array();
        foreach($query as $r){
            if($r->prescription_id ===null)
                continue;
            array_push($list,$r->prescription_id);
        }
        $feederslist=join("','",$list);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("id IN ('$feederslist')");
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('prescription');
        return $query->result();
    }

    function getDispensedPrescriptionByLimitBySearch($limit, $start, $search) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('pharmacy_payment')->result();
        $list=array();
        foreach($query as $r){
            if($r->prescription_id ===null)
                continue;
            array_push($list,$r->prescription_id);
        }
        $feederslist=join("','",$list);
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('prescription')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("id IN ('$feederslist')")
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }


    function getPrescriptionByPatient($patient) {
        $this->db->order_by('id', 'desc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient', $patient);
        $query = $this->db->get('prescription');
        return $query->result();
    }

    function getPrescriptionBySearchByPatient($patient, $search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('prescription')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('patient', $patient)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getPrescriptionByLimitByPatient($patient, $limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('patient', $patient);
        $this->db->limit($limit, $start);
        $query = $this->db->get('prescription');
        return $query->result();
    }

    function getPrescriptionByLimitBySearchByPatient($patient, $limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('prescription')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where('patient', $patient)
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }



    function getPharmacyReport($st,$end) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->order_by('date', 'desc');
        $query = $this->db->get('pharmacy_payment');
        return $query->result();
    }

    function getPharmacyReportByLimit($st, $end, $limit, $start) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->order_by('date', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('pharmacy_payment');
        return $query->result();
    }

    function getAllPharmacyReport($st,$end) {
        //get all the prescription id from the sales
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("date BETWEEN $st AND $end");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('pharmacy_payment');
        return $query->result();
    }

}
