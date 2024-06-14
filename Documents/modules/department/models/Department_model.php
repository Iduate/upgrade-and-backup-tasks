<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertDepartment($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('department', $data2);
    }

    function getDepartment() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('department');
        return $query->result();
    }

    function getDepartmentById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('department');
        return $query->row();
    }

    function getDepartmentByName($name) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('name', $name);
        $query = $this->db->get('department');
        return $query->row();
    }

    function getDepartmentCaseForms($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('dept_id', $id);
        $query = $this->db->get('form');
        return $query->result();
    }

    function getGroupCount($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('dept_id', $id);
        $query = $this->db->get('form');
        return $query->num_rows();
    }

    function getDepartmentCaseForm($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('dept_id', $id);
        $query = $this->db->get('form');
        return $query->row();
    }

    function getDepartmentCaseFormByID($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('form');
        return $query->row();
    }

    function InsertCaseForm($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('form', $data2);
        return $this->db->insert_id();

    }

    function updateCaseFormById($id, $data) {
        $hospital=$this->session->userdata('hospital_id');
        $this->db->where('hospital_id', $hospital);
        $this->db->where('id', $id);
        $this->db->update('form', $data);
    }

    function updateCaseFormByDept($id, $data) {
        $hospital=$this->session->userdata('hospital_id');
        $this->db->where('hospital_id', $hospital);
        $this->db->where('dept_id', $id);
        $this->db->update('form', $data);
    }

    function updateDepartment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('department', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('department');
    }

}
