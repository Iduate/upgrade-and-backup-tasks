<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lab extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('lab_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model');
        $this->load->model('laboratorist/laboratorist_model');
        $this->load->model('accountant/accountant_model');
        $this->load->model('receptionist/receptionist_model');
        $this->load->model('finance/finance_model');
        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Nurse', 'Laboratorist', 'Doctor', 'Patient', 'Record_Officer'))) {
            redirect('home/permission');
        }
    } 

    public function index() {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        if ($this->ion_auth->in_group(array('Receptionist'))) {
            redirect('lab/lab1');
        }

        $id = $this->input->get('id');
        $rid = $this->input->get('rid');


        if (!empty($id)) {
            $lab_details = $this->lab_model->getLabById($id);
            if ($lab_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        if (!empty($rid)) {
            $request_detials = $this->lab_model->getRequestById($rid);
            if ($request_detials->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $data['settings'] = $this->settings_model->getSettings();
        $data['labs'] = $this->lab_model->getLab();

        if (!empty($id)) {
            $data['lab_single'] = $this->lab_model->getLabById($id);
            $data['patients'] = $this->patient_model->getPatientById($data['lab_single']->patient);
            $data['doctors'] = $this->doctor_model->getDoctorById($data['lab_single']->doctor);
        }

        if (!empty($rid)) {
            $data['request'] = $this->lab_model->getRequestById($rid);
            $data['rp'] = $this->patient_model->getPatientById($data['request']->patient_id);
            $data['rp_doc'] = $this->doctor_model->getDoctorById($data['request']->doctor);
        }

        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();


        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('lab', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function testList() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        // $data['test_category']=$this->lab_model->getLabTestCategory();


        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('test_list', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function lab() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $id = $this->input->get('id');

        if (!empty($id)) {
            $lab_details = $this->lab_model->getLabById($id);
            if ($lab_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();

        $data['settings'] = $this->settings_model->getSettings();
        $data['labs'] = $this->lab_model->getLab();

        if (!empty($id)) {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_lab_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('lab', $data);
            $this->load->view('home/footer'); // just the header file
        }
    }

    public function lab1() {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $id = $this->input->get('id');

        $data['settings'] = $this->settings_model->getSettings();
        $data['labs'] = $this->lab_model->getLab();

        if (!empty($id)) {
            $data['lab_single'] = $this->lab_model->getLabById($id);
        }

        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('lab_1', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addLabView() {
        $data = array();


        $id = $this->input->get('id');

        if (!empty($id)) {
            $data['lab'] = $this->lab_model->getLabById($id);
            $data['patients'] = $this->patient_model->getPatientById($data['lab_single']->patient);
            $data['doctors'] = $this->doctor_model->getDoctorById($data['lab_single']->doctor);
        }

        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $data['test_category']=$this->lab_model->getLabTestCategory();
        // $data['patients'] = $this->patient_model->getPatient();
        // $data['doctors'] = $this->doctor_model->getDoctor();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_lab_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addLab() {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        
        $rid = $this->input->post('rid');

        $report = $this->input->post('report');

        $patient = $this->input->post('patient');

        $redirect = $this->input->post('redirect');

        $p_name = $this->input->post('p_name');
        $p_email = $this->input->post('p_email');
        if (empty($p_email)) {
            $p_email = $p_name . '-' . rand(1, 1000) . '-' . $p_name . '-' . rand(1, 1000) . '@example.com';
        }
        if (!empty($p_name)) {
            $password = $p_name . '-' . rand(1, 100000000);
        }
        $p_phone = $this->input->post('p_phone');
        $p_age = $this->input->post('p_age');
        $p_gender = $this->input->post('p_gender');
        $add_date = date('m/d/y');


        $patient_id = rand(10000, 1000000);



        $d_name = $this->input->post('d_name');
        $d_email = $this->input->post('d_email');
        if (empty($d_email)) {
            $d_email = $d_name . '-' . rand(1, 1000) . '-' . $d_name . '-' . rand(1, 1000) . '@example.com';
        }
        if (!empty($d_name)) {
            $password = $d_name . '-' . rand(1, 100000000);
        }
        $d_phone = $this->input->post('d_phone');

        $doctor = $this->input->post('doctor');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        } else {
            $date = time();
        }
        $date_string = date('d-m-y', $date);
        $discount = $this->input->post('discount');
        $amount_received = $this->input->post('amount_received');
        $user = $this->ion_auth->get_user_id();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Category Field
        // $this->form_validation->set_rules('category_amount[]', 'Category', 'min_length[1]|max_length[100]');
        // Validating Price Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('discount', 'Discount', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('lab/addLabView');
        } else {
            if (!empty($p_name)) {

                $data_p = array(
                    'patient_id' => $patient_id,
                    'name' => $p_name,
                    'email' => $p_email,
                    'phone' => $p_phone,
                    'sex' => $p_gender,
                    'age' => $p_age,
                    'add_date' => $add_date,
                    'how_added' => 'from_pos'
                );
                $username = $this->input->post('p_name');
        // Adding New Patient
                if ($this->ion_auth->email_check($p_email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $p_email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $p_email))->row()->id;
                    $this->patient_model->insertPatient($data_p);
                    $patient_user_id = $this->db->get_where('patient', array('email' => $p_email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->patient_model->updatePatient($patient_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                }
        //    }
            }

            if (!empty($d_name)) {

                $limit = $this->doctor_model->getLimit();
                if ($limit <= 0) {
                    $this->session->set_flashdata('feedback', lang('doctor_limit_exceed'));
                    redirect('doctor');
                }

                $data_d = array(
                    'name' => $d_name,
                    'email' => $d_email,
                    'phone' => $d_phone,
                );
                $username = $this->input->post('d_name');
            // Adding New Patient
                if ($this->ion_auth->email_check($d_email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                } else {
                    $dfgg = 4;
                    $this->ion_auth->register($username, $password, $d_email, $dfgg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $d_email))->row()->id;
                    $this->doctor_model->insertDoctor($data_d);
                    $doctor_user_id = $this->db->get_where('doctor', array('email' => $d_email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->doctor_model->updateDoctor($doctor_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                }
            }


            if ($patient == 'add_new') {
                $patient = $patient_user_id;
            }

            if ($doctor == 'add_new') {
                $doctor = $doctor_user_id;
            }

            if (!empty($patient)) {
                $patient_details = $this->patient_model->getPatientById($patient);
                $patient_name = $patient_details->name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
            } else {
                $patient_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }

            if (!empty($doctor)) {
                $doctor_details = $this->doctor_model->getDoctorById($doctor);
                $doctor_name = $doctor_details->name;
            } else {
                $doctor_name = 0;
            }

            $data = array();

            if (empty($id)) {
                $data = array(
                    // 'category_name' => $category_name,
                    'patient' => $patient,
                    'title' => $title,
                    'doctor' => $doctor,
                    'date' => $date,
		            'report' => $report,
                    'user' => $user,
                    'patient_name' => $patient_name,
                    'patient_phone' => $patient_phone,
                    'patient_address' => $patient_address,
                    'doctor_name' => $doctor_name,
                    'date_string' => $date_string
                );


                $this->lab_model->insertLab($data);
                $inserted_id = $this->db->insert_id();
                
                if(!empty($rid)){
                    $this->lab_model->modifyRequest($rid,$inserted_id);
                }

                $this->session->set_flashdata('feedback', lang('added'));
                redirect($redirect);
            } else {
                $data = array(
                    //   'category_name' => $category_name,
                    'report' => $report,
                    'patient' => $patient,
                    'doctor' => $doctor,
                    'user' => $user,
                    'patient_name' => $patient_details->name,
                    'patient_phone' => $patient_details->phone,
                    'patient_address' => $patient_details->address,
                    'doctor_name' => $doctor_details->name,
                );
                $this->lab_model->updateLab($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
                redirect($redirect);
            }
        }
    }

    function editLab() {
        if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist', 'Nurse', 'Patient'))) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['categories'] = $this->lab_model->getLabCategory();
            $data['patients'] = $this->patient_model->getPatient();
            $data['doctors'] = $this->doctor_model->getDoctor();
            $id = $this->input->get('id');
            $data['lab'] = $this->lab_model->getLabById($id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_lab_view', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function delete() {
        if ($this->ion_auth->in_group(array('admin', 'Laboratorist'))) {
            $id = $this->input->get('id');

            $lab_details = $this->lab_model->getLabById($id);
            if ($lab_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }

            $this->lab_model->deleteLab($id);
            $this->session->set_flashdata('feedback', lang('deleted'));
            redirect('lab/lab');
        } else {
            redirect('home/permission');
        }
    }

    //work on the request lab test view
    public function requestTest(){
        if (!$this->ion_auth->in_group(array('Doctor'))) {
            redirect('home/permission');
        }
        $data = array();


        $id = $this->input->get('id');
        $Userid = $this->ion_auth->get_user_id();
        $data['doctor']=$this->doctor_model->getDoctorByIonUserId($Userid);
        $data['lab_tests']=$this->lab_model->getLabTest();
        $data['test_category']=$this->lab_model->getLabTestCategory();

        if (!empty($id)) {
            $data['lab'] = $this->lab_model->getLabById($id);
            $data['patients'] = $this->patient_model->getPatientById($data['lab_single']->patient);
            $data['doctors'] = $this->doctor_model->getDoctorById($data['lab_single']->doctor);
        }

        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $data['requests'] = $this->lab_model->getRequests($data['doctor']->id);
        $data['requestGroup'] = $this->lab_model->getRequestGroup($data['doctor']->id);
        // $data['patients'] = $this->patient_model->getPatient();
        // $data['doctors'] = $this->doctor_model->getDoctor();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('request_test_view', $data);
        $this->load->view('home/footer'); // just the header file
    }



















    

    //add new lab test type
    public function addfList(){
        $file_path="./uploads/lab.csv";
        $i=0;
        $e=1;
        if (($open = fopen($file_path, "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {  
                if ($i<1){
                    $i++;
                    print_r($data);
                    continue;
                } 
                //Array ( [0] => Test Name [1] => Type Of Specimen 
                //[2] => Service Group Name 
                //[3] => Service Sub Group Name [4] => Unit Charge ) 
                $test_name = $data[0];
                $test_price = $data[4];
                $test_cat = $data[3];
                $specimen = $data[1];
                if($data[2] == "Radiology"){
                    continue;
                }
                $lab_id="lab".$this->lab_model->addNewLabTest($test_name,$test_cat,$test_price,$specimen);
                $data = array('category' => $test_name,
                    'description' => "",
                    'type' => "others",
                    'c_price' => $test_price,
                    'd_commission' => "",
                    'operation_id'=>$lab_id
                );
                $this->finance_model->insertPaymentCategory($data);
                echo "Added $e ::::::::::::: $test_name<br/><br/>";

            }
        }else{
            echo "fail";
            die();
        }
        return;
    }











































































    //add new lab test type
    public function addList(){
        if (!$this->ion_auth->in_group(array('Laboratorist'))) {
            redirect('home/permission');
        }
        $test_name = $this->input->post('test_name');
        $test_price = preg_replace('#[^0-9]#','',$this->input->post('test_price'));
        $test_cat = $this->input->post('cat');
        $specimen = $this->input->post('specimen');
        if($test_cat == "add_new"){
            $test_cat = $this->input->post('cat_name');
            // if($test_cat ==""){
            //     $data[]
            // }
        }
        $lab_id="lab".$this->lab_model->addNewLabTest($test_name,$test_cat,$test_price,$specimen);
        $data = array('category' => $test_name,
                'description' => "",
                'type' => "others",
                'c_price' => $test_price,
                'd_commission' => "",
                'operation_id'=>$lab_id
            );
        $this->finance_model->insertPaymentCategory($data);
        $this->session->set_flashdata('feedback', "Added");
        redirect('lab/testList');
    }

    public function requestList(){
        if (!$this->ion_auth->in_group(array('Laboratorist','admin'))) {
            redirect('home/permission');
        }
        $data = array();

        $data['requestGroup'] = $this->lab_model->getAllRequestGroup();
        $data['requests'] = $this->lab_model->getLabRequest();
        // $data['patients'] = $this->patient_model->getPatient();
        // $data['doctors'] = $this->doctor_model->getDoctor();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('request_list', $data);
        $this->load->view('home/footer'); // just the header file
    }


    //add request
    public function addRequest() {
        if (!$this->ion_auth->in_group(array('Doctor'))) {
            redirect('home/permission');
        }
        $Userid = $this->ion_auth->get_user_id();
        $id = $this->input->post('id');

        $report = $this->input->post('report');

        $patient = $this->input->post('patient');

        $redirect = $this->input->post('redirect');

        $tests=$this->input->post('test');

        if(empty($tests) || empty($patient)){
            $this->session->set_flashdata('feedback', "Failed");
            redirect('lab/requestTest');
        }
        $time=time();

        if (!empty($patient)) {
            $patient_details = $this->patient_model->getPatientById($patient);
            $patient_name = $patient_details->name;
            $patient_phone = $patient_details->phone;
            $patient_address = $patient_details->address;
        } else {
            $patient_name = 0;
            $patient_phone = 0;
            $patient_address = 0;
        }
        $category_name=array();
        unset($category_name);
        $amount=0;
        foreach($tests as $test){
            //add each of the request to database
            $data=array();
            $data=array(
                "hospital_id"=>$this->session->userdata('hospital_id'),
                "doctor"=>$this->doctor_model->getDoctorByIonUserId($Userid)->id,
                "patient_id"=>$patient,
                "test"=>$test,
                "status"=>"0",
                "date" => $time
            );
            $this->lab_model->insertTest($data);
            $lTest=$this->lab_model->getTestByName($test);
            //adding the price
            if($lTest != null){
                $current_item = $this->finance_model->getPaymentCategoryByOperation('lab'.$lTest->id);
                if($patient_details->patient_type != "Private Patient") {
                    $hmo_id=$patient_details->insurance_id;
                    $hmo=$this->finance_model->getHMOCategoryPrice($hmo_id,$current_item->id);
                    if($hmo != null){
                        $price=$hmo->price;
                    }else{
                        $price=$current_item->c_price;
                    }
                }else{
                    $price=$current_item->c_price;
                }

                $category_price = $price;
                $category_type = $current_item->type;
                $qty = 1;
                $key=$current_item->id;
                unset($cat_and_price);
                $cat_and_price[] = $key . '*' . $category_price . '*' . $category_type . '*' . $qty;
                if($category_name !=""  && $category_name != null){
                    $category_name .= ",".implode(',', $cat_and_price);
                }else{
                    $category_name = implode(',', $cat_and_price);
                }
                //add the bill 
                $amount+=$price;
            }
        }
        
        $data = array(
            'category_name' => $category_name,
            'patient' => $patient,
            'date' => time(),
            'amount' => $amount,
            'doctor' => $this->doctor_model->getDoctorByIonUserId($Userid)->id,
            'discount' => '0',
            'flat_discount' => '0',
            'gross_total' => $amount,
            'status' => 'unpaid',
            'hospital_amount' => $amount,
            'doctor_amount' => '0',
            'user' => $this->ion_auth->get_user_id(),
            'patient_name' => $patient_name,
            'patient_phone' => $patient_phone,
            'patient_address' => $patient_address,
            'doctor_name' => "",
            'date_string' => date('d-m-Y',time()),
            'remarks' => ""
        );


        $this->finance_model->insertPayment($data);

        $this->session->set_flashdata('feedback', "Requested");
        redirect('lab/requestTest');

    }

    public function template() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['templates'] = $this->lab_model->getTemplate();

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('template', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addTemplateView() {
        $data = array();
        $id = $this->input->get('id');
        if (!empty($id)) {
            $data['template'] = $this->lab_model->getTemplateById($id);
        }

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_template', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getTemplateByIdByJason() {
        $id = $this->input->get('id');
        $data['template'] = $this->lab_model->getTemplateById($id);
        echo json_encode($data);
    }

    public function addTemplate() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $template = $this->input->post('template');
        $user = $this->ion_auth->get_user_id();


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('report', 'Report', 'trim|min_length[1]|max_length[10000]|xss_clean');
// Validating Price Field
        $this->form_validation->set_rules('user', 'User', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('lab/addTemplate');
        } else {
            $data = array();
            if (empty($id)) {
                $data = array(
                    'name' => $name,
                    'template' => $template,
                    'user' => $user,
                );
                $this->lab_model->insertTemplate($data);
                $inserted_id = $this->db->insert_id();
                $this->session->set_flashdata('feedback', lang('added'));
                redirect("lab/addTemplateView?id=" . "$inserted_id");
            } else {
                $data = array(
                    'name' => $name,
                    'template' => $template,
                    'user' => $user,
                );
                $this->lab_model->updateTemplate($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
                redirect("lab/addTemplateView?id=" . "$id");
            }
        }
    }

    function editTemplate() {
        if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist', 'Nurse', 'Patient'))) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $id = $this->input->get('id');
            $data['template'] = $this->lab_model->getTemplateById($id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('add_template', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function deleteTemplate() {
        $id = $this->input->get('id');
        $this->lab_model->deleteTemplate($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('lab/template');
    }

    public function labCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->lab_model->getLabCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('lab_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addLabCategoryView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_lab_category');
        $this->load->view('home/footer'); // just the header file
    }

    public function addLabCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');
        $reference = $this->input->post('reference_value');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
// Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
// Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('reference_value', 'Reference Value', 'trim|required|min_length[1]|max_length[1000]|xss_clean');
// Validating Description Field
        $this->form_validation->set_rules('type', 'Type', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', lang('vaidation_error'));
                redirect('lab/editLabCategory?id=' . $id);
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_lab_category', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description,
                'reference_value' => $reference,
            );
            if (empty($id)) {
                $this->lab_model->insertLabCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->lab_model->updateLabCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('lab/labCategory');
        }
    }

    function editLabCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['category'] = $this->lab_model->getLabCategoryById($id);

        if (!empty($data['category']->hospital_id)) {
            if ($data['category']->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_lab_category', $data);
                $this->load->view('home/footer'); // just the footer file
            }
        } else {
            redirect('home/permission');
        }
    }

    function deleteLabCategory() {
        $id = $this->input->get('id');
        $data['category'] = $this->lab_model->getLabCategoryById($id);
        if ($data['category']->hospital_id != $this->session->userdata('hospital_id')) {
            redirect('home/permission');
        }
        $this->lab_model->deleteLabCategory($id);
        redirect('lab/labCategory');
    }

    function invoice() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getLabById($id);

        if ($data['lab']->hospital_id != $this->session->userdata('hospital_id')) {
            $this->load->view('home/permission');
        }

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('invoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function patientLabHistory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $patient = $this->input->get('patient');
        if (empty($patient)) {
            $patient = $this->input->post('patient');
        }

        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        if (!empty($date_from)) {
            $data['labs'] = $this->lab_model->getLabByPatientIdByDate($patient, $date_from, $date_to);
            $data['deposits'] = $this->lab_model->getDepositByPatientIdByDate($patient, $date_from, $date_to);
        } else {
            $data['labs'] = $this->lab_model->getLabByPatientId($patient);
            $data['pharmacy_labs'] = $this->pharmacy_model->getLabByPatientId($patient);
            $data['ot_labs'] = $this->lab_model->getOtLabByPatientId($patient);
            $data['deposits'] = $this->lab_model->getDepositByPatientId($patient);
        }



        $data['patient'] = $this->patient_model->getPatientByid($patient);
        $data['settings'] = $this->settings_model->getSettings();



        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('patient_deposit', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function financialReport() {
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }
        $data = array();
        $data['lab_categories'] = $this->lab_model->getLabCategory();
        $data['expense_categories'] = $this->lab_model->getExpenseCategory();


// if(empty($date_from)&&empty($date_to)) {
//    $data['labs']=$this->lab_model->get_lab();
//     $data['ot_labs']=$this->lab_model->get_ot_lab();
//     $data['expenses']=$this->lab_model->get_expense();
// }
// else{

        $data['labs'] = $this->lab_model->getLabByDate($date_from, $date_to);
        $data['ot_labs'] = $this->lab_model->getOtLabByDate($date_from, $date_to);
        $data['deposits'] = $this->lab_model->getDepositsByDate($date_from, $date_to);
        $data['expenses'] = $this->lab_model->getExpenseByDate($date_from, $date_to);
// } 
        $data['from'] = $this->input->post('date_from');
        $data['to'] = $this->input->post('date_to');
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('financial_report', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    

    public function getAllLab() {
        // Search term
                $searchTerm = $this->input->post('searchTerm');
        
        // Get users
                $response = $this->lab_model->getLabInfo($searchTerm);
        
                echo json_encode($response);
    }

    

    public function getAllRadio() {
        // Search term
                $searchTerm = $this->input->post('searchTerm');
        
        // Get users
                $response = $this->lab_model->getRadioInfo($searchTerm);
        
                echo json_encode($response);
    }

    function getLab() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabBysearch($search);
            } else {
                $data['labs'] = $this->lab_model->getLab();
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabByLimitBySearch($limit, $start, $search);
            } else {
                $data['labs'] = $this->lab_model->getLabByLimit($limit, $start);
            }
        }
        //  $data['labs'] = $this->lab_model->getLab();

        foreach ($data['labs'] as $lab) {
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-xs editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-xs invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-xs delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }


            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $lab->id,
                $lab->title,
                $patient_details,
                $date,
                $options1 . ' ' . $options2 . ' ' . $options3,
                    // $options2 . ' ' . $options3
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('lab')->num_rows(),
                "recordsFiltered" => $this->db->get('lab')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    

    function getLabTests() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabTestBysearch($search);
            } else {
                $data['labs'] = $this->lab_model->getLabTest();
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabTestByLimitBySearch($limit, $start, $search);
            } else {
                $data['labs'] = $this->lab_model->getLabTestByLimit($limit, $start);
            }
        }
        //  $data['labs'] = $this->lab_model->getLab();

        foreach ($data['labs'] as $lab) {
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-xs editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-xs invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-xs delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }
            
            $info[] = array(
                $lab->name,
                $lab->category,
                $lab->price,
                $lab->specimen,
                $options1 . ' ' . $options2 . ' ' . $options3,
                    // $options2 . ' ' . $options3
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('lab_test')->num_rows(),
                "recordsFiltered" => $this->db->get('lab_test')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function getLabByJason(){
        $id=$this->input->get("id");
        $data['lab']=$this->lab_model->getLabById($id);
        $data['laboratorist']=$this->ion_auth->user($data['lab']->user)->row()->username;
        echo json_encode($data);
    }

    function getPatientLab() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $p_id=$this->input->post('id');

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getPatientLabBysearch($p_id,$search);
            } else {
                $data['labs'] = $this->lab_model->getPatientLab($p_id);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getPatientLabByLimitBySearch($p_id,$limit, $start, $search);
            } else {
                $data['labs'] = $this->lab_model->getPatientLabByLimit($p_id,$limit, $start);
            }
        }
        //  $data['labs'] = $this->lab_model->getLab();

        foreach ($data['labs'] as $lab) {
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor'))) {
                $options1 = ' <a class="btn btn-info btn-xs editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2='<a type="button" class="btn btn-info btn-xs btn_width detailsbutton" title="View Report" data-toggle = "modal" data-id="' . $lab->id . '"><i class="fa fa-file"> </i> </a>';
            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-xs delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }
            $options1 = '';
            $options3 = '';

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }


            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $lab->id,
                // $p_id,
                $patient_details,
                $date,
                $options1 . ' ' . $options2 . ' ' . $options3,
                    // $options2 . ' ' . $options3
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('lab')->num_rows(),
                "recordsFiltered" => $this->db->get('lab')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    public function myLab() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data['templates'] = $this->lab_model->getTemplate();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->lab_model->getLabCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();

        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('my_lab', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getMyLab() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabBysearch($search);
            } else {
                $data['labs'] = $this->lab_model->getLab();
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getLabByLimitBySearch($limit, $start, $search);
            } else {
                $data['labs'] = $this->lab_model->getLabByLimit($limit, $start);
            }
        }

        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_user_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_user_id)->id;
        }

        foreach ($data['labs'] as $lab) {
            if ($patient_id == $lab->patient) {
                $date = date('d-m-y', $lab->date);

                $options2 = '<a class="btn btn-xs invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';

                $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
                if (!empty($doctor_info)) {
                    $doctor = $doctor_info->name;
                } else {
                    if (!empty($lab->doctor_name)) {
                        $doctor = $lab->doctor_name;
                    } else {
                        $doctor = ' ';
                    }
                }


                $patient_info = $this->patient_model->getPatientById($lab->patient);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = ' ';
                }
                $info[] = array(
                    $lab->id,
                    $patient_details,
                    $date,
                    $options2,
                        // $options2 . ' ' . $options3
                );
            }
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('lab')->num_rows(),
                "recordsFiltered" => $this->db->get('lab')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }


    ///radiology starts here
    public function operations(){
        $data=array();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('operations', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function addRadiology(){
        if (!$this->ion_auth->in_group(array('Radiologist','admin'))) {
            redirect('home/permission');
        }
        $test_name = $this->input->post('name');
        $test_price = preg_replace('#[^0-9]#','',$this->input->post('price'));
        $lab_id="radio".$this->lab_model->addNewRadiology($test_name,$test_price);
        $data = array('category' => $test_name,
                'description' => "",
                'type' => "others",
                'c_price' => $test_price,
                'd_commission' => "",
                'operation_id'=>$lab_id
            );
        $this->finance_model->insertPaymentCategory($data);
        $this->session->set_flashdata('feedback', "Added");
        redirect('lab/RadiologyList');
    }

    public function addR(){
        $file_path="./uploads/radio.csv";
        $i=0;
        $e=1;
        if (($open = fopen($file_path, "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {  
                $test_name = $data[0];
                $test_price = $data[1];
                $lab_id="radio".$this->lab_model->addNewRadiology($test_name,$test_price);
                $data = array('category' => $test_name,
                        'description' => "",
                        'type' => "others",
                        'c_price' => $test_price,
                        'd_commission' => "",
                        'operation_id'=>$lab_id
                    );
                $this->finance_model->insertPaymentCategory($data);
            }
        }else{
            echo "fail";
            die();
        }
        return;
    }

    public function rad_requests(){
        if (!$this->ion_auth->in_group(array('Radiologist','admin'))) {
            redirect('home/permission');
        }
        $data = array();

        $data['requests'] = $this->lab_model->getRadRequests();
        // $data['patients'] = $this->patient_model->getPatient();
        // $data['doctors'] = $this->doctor_model->getDoctor();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('rad_request', $data);
        $this->load->view('home/footer'); // just the header file
    }

    

    function addRad() {
        if (!$this->ion_auth->in_group(array('Radiologist','admin'))) {
            redirect("home/permission");
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['patients'] = $this->patient_model->getPatient();
        $data['medical_histories'] = $this->patient_model->getMedicalHistory();
        $data['vitals'] = $this->patient_model->getHospitalVitals();
        $data['operations'] = $this->patient_model->getAllOperations();
        $data["radiology"]=$this->lab_model->getAllRadiology();
        if($this->input->get("rid") != null){
            $r=$this->lab_model->getRadRequestById($this->input->get("rid"));
            $p=$this->patient_model->getPatientById($r->patient_id);
            $d=array(
                'name'=>$p->name,
                'id'=>$p->id,
                'xray'=>$this->lab_model->getRadiologyById($r->xray)->name

            );
            $data['request']=$d;
        }
        $id=$this->input->get("id");
        if (!empty($id)) {
            $data['rad_details'] = $this->lab_model->getRadReportById($id);
            if ($data['rad_details']->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
            $data['patients'] = $this->patient_model->getPatientById($data['rad_details']->patient_id);
            // print_r($data['patients']);
            // die();
        }
        $consult_dept="";
        
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('rad_manager', $data);
        $this->load->view('home/footer'); // just the footer file
    }
    

    function addRadReport() {
        $id = $this->input->post('id');
        $historyId=$id;
        $patient_id = $this->input->post('patient_id');

        $date = $this->input->post('date');

        $title = $this->input->post('title');

        $doctor_id="";

        

        if (!empty($date)) {
            $date = strtotime($date);
        } else {
            $date = time();
        }

        $description = $this->input->post('description');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $redirect = $this->input->post('redirect');
        if (empty($redirect)) {
            $redirect = 'patient/medicalHistory?id=' . $patient_id;
        }

        // Validating Name Field
        $this->form_validation->set_rules('date', 'Date', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Title Field
        $this->form_validation->set_rules('title', 'Title', 'trim|min_length[1]|max_length[100]|xss_clean');

        // Validating Password Field

        $this->form_validation->set_rules('description', 'Description', 'trim|min_length[5]|max_length[10000]|xss_clean');
        //add medical history here

        if (!empty($patient_id)) {
            $patient_details = $this->patient_model->getPatientById($patient_id);
            $patient_name = $patient_details->name;
            $patient_phone = $patient_details->phone;
            $patient_address = $patient_details->address;
        } else {
            $patient_name = 0;
            $patient_phone = 0;
            $patient_address = 0;
        }
        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor_id=$doctor_ion_id;
        }else{
            redirect("home/permission");
        }
        //$error = array('error' => $this->upload->display_errors());
        $data = array();
        $data = array(
            'patient_id' => $patient_id,
            'date' => $date,
            'title' => $title,
            'description' => $description,
            'doctor_id' => $doctor_id,
            'patient_name' => $patient_name,
            'patient_phone' => $patient_phone,
            'patient_address' => $patient_address
        );

        if (empty($id)) {     // Adding New history
            $id=$this->lab_model->insertRadioHistory($data);
            $this->session->set_flashdata('feedback', lang('added'));
        } else { // Updating history
            $this->lab_model->updateRadioHistory($id, $data);
            $this->session->set_flashdata('feedback', lang('updated'));
        }

        
        //working on the film upload
        $sCount=$this->input->post("sCount");
        for($i=0; $i<$sCount; $i++){
            $e=$i+1;
            $n="imgname_".$e;
            $f="img_".$e;
            $name=$this->input->post($n);

            $file_name = $_FILES[$f]['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = time().$file_name;
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "10000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "10000",
                'max_width' => "10000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload($f)) {
                $path = $this->upload->data();
                $val = "uploads/" . $path['file_name'];
            }
            $data=array();
            if($val==null){
                $val="";
            }
            $data=array(
                'report_id' => $id,
                'image' => $val,
                'date' => time()
            );
            $g=$this->lab_model->insertRadioImage($data);

        }
        // Loading View
        redirect("lab/RadiologyReport");
    }

    

    public function RadiologyReport() {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        if ($this->ion_auth->in_group(array('Receptionist'))) {
            // redirect('lab/lab1');
        }

        $data['settings'] = $this->settings_model->getSettings();
        $data['labs'] = $this->lab_model->getLab();


        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('radiology_report', $data);
        $this->load->view('home/footer'); // just the header file
    }

    

    function getRadiology() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getRadReportBySearch($search);
            } else {
                $data['labs'] = $this->lab_model->getRadReport();
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getRadReportByLimitBySearch($limit, $start, $search);
            } else {
                $data['labs'] = $this->lab_model->getRadReportByLimit($limit, $start);
            }
        }
        //  $data['labs'] = $this->lab_model->getLab();

        foreach ($data['labs'] as $lab) {
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('Radiologist'))) {
                $options1 = ' <a class="btn btn-info btn-xs editbutton" title="' . lang('edit') . '" href="lab/addRad?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-xs invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/radInvoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-xs delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }
            $options3 = '';

            $doctor_info = $this->doctor_model->getDoctorByIonUserId($lab->doctor_id);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }


            $patient_info = $this->patient_model->getPatientById($lab->patient_id);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $date,
                $patient_details,
                $lab->title,
                $doctor,
                $options1 . ' ' . $options2 . ' ' . $options3,
                    // $options2 . ' ' . $options3
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('lab')->num_rows(),
                "recordsFiltered" => $this->db->get('lab')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }
        echo json_encode($output);
    }


    function radInvoice() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getRadReportById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('rad_invoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }


    function radImageInvoice() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['lab'] = $this->lab_model->getRadReportById($id);
        $data['images'] = $this->lab_model->getRadReportImagesById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('rad_image_invoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function getPatientRadiology() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $id=$this->input->post("id");

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getPatientRadReportBySearch($id,$search);
            } else {
                $data['labs'] = $this->lab_model->getPatientRadReport($id);
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getPatientRadReportByLimitBySearch($id,$limit, $start, $search);
            } else {
                $data['labs'] = $this->lab_model->getPatientRadReportByLimit($id,$limit, $start);
            }
        }
        //  $data['labs'] = $this->lab_model->getLab();

        foreach ($data['labs'] as $lab) {
            $date = date('d-m-y', $lab->date);

            $options3 = ' <a type="button" class="btn btn-info btn-xs btn_width detailsbutton xrayview" title="View Report" data-toggle = "modal" data-id="' . $lab->id . '"><i class="fa fa-file"> </i> </a>';

            $doctor_info = $this->doctor_model->getDoctorByIonUserId($lab->doctor_id);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }


            $patient_info = $this->patient_model->getPatientById($lab->patient_id);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            $info[] = array(
                $date,
                $patient_details,
                $lab->title,
                $doctor,
                $options3,
                    // $options2 . ' ' . $options3
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('lab')->num_rows(),
                "recordsFiltered" => $this->db->get('lab')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }
        echo json_encode($output);
    }

    function getRadioByJason(){
        $id = $this->input->get('id');
        $data['lab'] = $this->lab_model->getRadReportById($id);
        $data['images'] = $this->lab_model->getRadReportImagesById($id);
        echo json_encode($data);
    }

    function updateRadRequestName(){
        //get all the request
        $reqs=$this->lab_model->getLabRequest();
        //loop through the request
        foreach($reqs as $req){
            //get the doctor and patient name
            $patient_name=$this->patient_model->getPatientById($req ->patient_id)->name;
            $doctor_name=$this->doctor_model->getDoctorById($req->doctor)->name;
            $data = array();
            $data = array(
                'patient_name' => $patient_name,
                'doctor_name' => $doctor_name,
            );
            $this->lab_model->updateLabRequest($req->id,$data);
        }

            
        
        //update list using the id
    }


    function getRadiologyRequest() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        // $start=0;
        // $limit=-1;
        // $search="";

        if ($limit == -1) {
            if (!empty($search)) {
                $data['requests'] = $this->lab_model->getRadRequestBySearch($search);
            } else {
                $data['requests'] = $this->lab_model->getRadRequest();
            }
        } else {
            if (!empty($search)) {
                $data['requests'] = $this->lab_model->getRadRequestByLimitBySearch($limit, $start, $search);
            } else {
                $data['requests'] = $this->lab_model->getRadRequestByLimit($limit, $start);
            }
        }
        //  $data['labs'] = $this->lab_model->getLab();

        foreach ($data['requests'] as $request) {
            if($request->status =="0"){
                $pen= "<div class='pend'></div>";
            }else{
                $pen= "<div class='done'></div>";
            }
            if ($this->ion_auth->in_group(array('admin', 'Radiologist'))) {
                if($request->status =="0"){
                    $options3 = '<a class="btn btn-info btn-xs" href="lab/addRad?rid=' . $request->id . '">Add</a>';
                }else{
                    $options3 ="<div class='done'></div>";
                }
            } else {
                $options3 = '';
            }
            if(!empty($this->lab_model->getRadiologyById($request->xray))){
                $xray=$this->lab_model->getRadiologyById($request->xray)->name;
            }else{
                $xray="empty";
            }

            $info[] = array(
                $pen." ".date('d/m/y',$request->date),
                $this->patient_model->getPatientById($request ->patient_id)->name,
                $xray,
                $this->doctor_model->getDoctorById($request->doctor)->name,
                $options3,
                    // $options2 . ' ' . $options3
            );
        }


        if (!empty($data['requests'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('rad_request')->num_rows(),
                "recordsFiltered" => $this->db->get('rad_request')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }
        echo json_encode($output);
    }
    function getPatientRadiologyRequest() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $id = $this->input->post('id');
        // $start=0;
        // $limit=-1;
        // $search="";

        if ($limit == -1) {
            if (!empty($search)) {
                $data['requests'] = $this->lab_model->getPatientRadRequestBySearch($id,$search);
            } else {
                $data['requests'] = $this->lab_model->getPatientRadRequest($id);
            }
        } else {
            if (!empty($search)) {
                $data['requests'] = $this->lab_model->getPatientRadRequestByLimitBySearch($id,$limit, $start, $search);
            } else {
                $data['requests'] = $this->lab_model->getPatientRadRequestByLimit($id,$limit, $start);
            }
        }
        //  $data['labs'] = $this->lab_model->getLab();

        foreach ($data['requests'] as $request) {
            if($request->status =="0"){
                $pen= "<div class='pend'></div>";
            }else{
                $pen= "<div class='done'></div>";
            }
            if ($this->ion_auth->in_group(array('admin', 'Radiologist'))) {
                if($request->status =="0"){
                    $options3 = '<a class="btn btn-info btn-xs" href="lab/addRad?rid=' . $request->id . '">Add</a>';
                }else{
                    $options3 ="<div class='done'></div>";
                }
            } else {
                $options3 = '';
            }
            if(!empty($this->lab_model->getRadiologyById($request->xray))){
                $xray=$this->lab_model->getRadiologyById($request->xray)->name;
            }else{
                $xray="empty";
            }

            $info[] = array(
                $pen." ".date('d/m/y',$request->date),
                $this->patient_model->getPatientById($request ->patient_id)->name,
                $xray,
                $this->doctor_model->getDoctorById($request->doctor)->name,
                $options3,
                    // $options2 . ' ' . $options3
            );
        }


        if (!empty($data['requests'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('rad_request')->num_rows(),
                "recordsFiltered" => $this->db->get('rad_request')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }
        echo json_encode($output);
    }

    function getLabRequest() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        // $start=0;
        // $limit=-1;
        // $search="";

        if ($limit == -1) {
            if (!empty($search)) {
                $data['requests'] = $this->lab_model->getLabRequestBySearch($search);
            } else {
                $data['requests'] = $this->lab_model->getLabRequest();
            }
        } else {
            if (!empty($search)) {
                $data['requests'] = $this->lab_model->getLabRequestByLimitBySearch($limit, $start, $search);
            } else {
                $data['requests'] = $this->lab_model->getLabRequestByLimit($limit, $start);
            }
        }
        //  $data['labs'] = $this->lab_model->getLab();

        foreach ($data['requests'] as $request) {
            if($request->status =="0"){
                $pen= "<div class='pend'></div>";
            }else{
                $pen= "<div class='done'></div>";
            }
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist'))) {
                if($request->status =="0"){
                    $options3 = '<a class="btn btn-info btn-xs" href="lab?rid=' . $request->id . '">Add</a>';
                }else{
                    $options3 ="<div class='done'></div>";
                }
            } else {
                $options3 = '';
            }
            if(!empty($this->lab_model->getTestById($request->test))){
                $test=$this->lab_model->getTestById($request->test)->name;
            }else{
                $test="empty";
            }

            $info[] = array(
                $pen." ".date('d/m/y',$request->date),
                $this->patient_model->getPatientById($request ->patient_id)->name,
                $test,
                $this->doctor_model->getDoctorById($request->doctor)->name,
                $options3,
                    // $options2 . ' ' . $options3
            );
        }


        if (!empty($data['requests'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('rad_request')->num_rows(),
                "recordsFiltered" => $this->db->get('rad_request')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }
        echo json_encode($output);
    }

    function getPatientLabRequest() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $id=$this->input->post("id");
        // $start=0;
        // $limit=-1;
        // $search="";

        if ($limit == -1) {
            if (!empty($search)) {
                $data['requests'] = $this->lab_model->getPatientLabRequestBySearch($id,$search);
            } else {
                $data['requests'] = $this->lab_model->getPatientLabRequest($id);
            }
        } else {
            if (!empty($search)) {
                $data['requests'] = $this->lab_model->getPatientLabRequestByLimitBySearch($id,$limit, $start, $search);
            } else {
                $data['requests'] = $this->lab_model->getPatientLabRequestByLimit($id, $limit, $start);
            }
        }
        //  $data['labs'] = $this->lab_model->getLab();

        foreach ($data['requests'] as $request) {
            if($request->status =="0"){
                $pen= "<div class='pend'></div>";
            }else{
                $pen= "<div class='done'></div>";
            }
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist'))) {
                if($request->status =="0"){
                    $options3 = '<a class="btn btn-info btn-xs" href="lab?rid=' . $request->id . '">Add</a>';
                }else{
                    $options3 ="<div class='done'></div>";
                }
            } else {
                $options3 = '';
            }
            if(!empty($this->lab_model->getTestById($request->test))){
                $test=$this->lab_model->getTestById($request->test)->name;
            }else{
                $test="empty";
            }

            $info[] = array(
                $pen." ".date('d/m/y',$request->date),
                $this->patient_model->getPatientById($request ->patient_id)->name,
                $test,
                $this->doctor_model->getDoctorById($request->doctor)->name,
                $options3,
                    // $options2 . ' ' . $options3
            );
        }


        if (!empty($data['requests'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('rad_request')->num_rows(),
                "recordsFiltered" => $this->db->get('rad_request')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }
        echo json_encode($output);
    }

    //radiology test list
    public function RadiologyList() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('radiology_list', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getRadioTests() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getRadioTestBysearch($search);
            } else {
                $data['labs'] = $this->lab_model->getRadioTest();
            }
        } else {
            if (!empty($search)) {
                $data['labs'] = $this->lab_model->getRadioTestByLimitBySearch($limit, $start, $search);
            } else {
                $data['labs'] = $this->lab_model->getRadioTestByLimit($limit, $start);
            }
        }
        //  $data['labs'] = $this->lab_model->getLab();

        foreach ($data['labs'] as $lab) {
            $date = date('d-m-y', $lab->date);
            if ($this->ion_auth->in_group(array('admin', 'Laboratorist', 'Doctor','Radiologist'))) {
                $options1 = ' <a class="btn btn-info btn-xs editbutton" title="' . lang('edit') . '" href="lab?id=' . $lab->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';
            } else {
                $options1 = '';
            }

            $options2 = '<a class="btn btn-xs invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) {
                $options3 = '<a class="btn btn-info btn-xs delete_button" title="' . lang('delete') . '" href="lab/delete?id=' . $lab->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i>' . lang('') . '</a>';
            } else {
                $options3 = '';
            }
            
            $info[] = array(
                $lab->name,
                $lab->price,
                // $lab->price,
                // $lab->specimen,
                // $options1 . ' ' . $options2 . ' ' . $options3,
                    // $options2 . ' ' . $options3
            );
        }


        if (!empty($data['labs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('lab_test')->num_rows(),
                "recordsFiltered" => $this->db->get('lab_test')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function xrayReport() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Pharmacist','Nurse'))) {
            // redirect('home/permission');
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('xray_record', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getxrayReport(){
        $dateFrom=$this->input->get("dateFrom");
        $dateTo=$this->input->get("dateTo");
        $_24=60*60*24;
        if (empty($dateFrom)) {
            $s=date("n/j/Y",time());
            $e=date("n/j/Y",time());
            $st=strtotime($s);
            $end=strtotime($e)+$_24;
        }else{
            $st=strtotime($dateFrom);
            $end=strtotime($dateTo)+$_24;
        }
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        // $limit=-1;

        if(empty($this->input->get("insurance")) && empty($this->input->get("sponsor"))){
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['lists'] = $this->lab_model->getXrayReportBySearch($st,$end,$search);
                } else {
                    $data['lists'] = $this->lab_model->getXrayReport($st,$end);
                }
            } else {
                if (!empty($search)) {
                    $data['lists'] = $this->lab_model->getXrayReportByLimitBySearch($st,$end,$limit, $start, $search);
                    
                } else {
                    $data['lists'] = $this->lab_model->getXrayReportByLimit($st,$end,$limit, $start);
                    
                }
            }
            $recordFiltered=count($this->lab_model->getXrayReport($st,$end));
        }else{
            $data['lists'] = $this->lab_model->getXrayReport($st,$end);
            $recordFiltered=0;
        }
        $i = 0;
        foreach ($data['lists'] as $lab) {
            //$i = $i + 1;
            $date = date('d-m-y', $lab->date);

            $options3 = ' <a type="button" class="btn btn-info btn-xs btn_width detailsbutton xrayview" title="View Report" data-toggle = "modal" data-id="' . $lab->id . '"><i class="fa fa-file"> </i> </a>';

            $doctor_info = $this->doctor_model->getDoctorByIonUserId($lab->doctor_id);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }


            $patient_info = $this->patient_model->getPatientById($lab->patient_id);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            if($patient_info->insurance_sponsor != null){
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $patient_info->insurance_sponsor))->row();
                $sponsor=$sp->name;
                $hmo = $this->db->get_where('hmo', array('id' => $patient_info->insurance_id))->row();
                $insurance=$hmo->name;
            }else{
                $insurance=$patient_info->patient_type;
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $patient_info->insurance_id))->row();
                $sponsor=$sp->name;
            }

            //work on insurance filter here
            if(!empty($this->input->get("insurance"))){
                if($this->input->get("insurance") =="private"){
                    $recordFiltered++;
                    if($insurance != "PRIVATE CLIENT" && $patient_info->patient_type != "Private Patient"){
                        // $insurance="hellow world";
                        continue;
                    }
                }else{
                    $in=$this->db->get_where('hmo', array('id' => $this->input->get("insurance")))->row();
                    if($insurance != $in->name){
                        continue;
                    }else{
                        $recordFiltered++;
                    }
                }
                if ($limit != -1) {
                    $limit=$limit+$start;
                    $vi=$recordFiltered < $start;
                    if($recordFiltered >=$limit){
                        continue;
                    }
                    if($vi){
                        continue;
                    }
                }
                
            }

            //work on sponsor here
            if(!empty($this->input->get("sponsor"))){
                $in=$this->db->get_where('hmo_sponsor', array('id' => $this->input->get("sponsor")))->row();
                if($sponsor != $in->name){
                    continue;
                }else{
                    $recordFiltered++;
                }
                if ($limit != -1) {
                    $limit=$limit+$start;
                    $vi=$recordFiltered < $start;
                    if($recordFiltered >=$limit){
                        continue;
                    }
                    if($vi){
                        continue;
                    }
                }
                
            }


            $info[] = array(
                $date,
                $patient_details,
                $lab->title,
                $doctor,
                $insurance,
                $sponsor,
                    // $options2 . ' ' . $options3
            );
            $i = $i + 1;
        }
        

        if ($recordFiltered >0) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $recordFiltered,
                "recordsFiltered" => $recordFiltered,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }


    function labReport() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Pharmacist','Nurse'))) {
            // redirect('home/permission');
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('lab_record', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getLabReport(){
        $dateFrom=$this->input->get("dateFrom");
        $dateTo=$this->input->get("dateTo");
        $_24=60*60*24;
        if (empty($dateFrom)) {
            $s=date("n/j/Y",time());
            $e=date("n/j/Y",time());
            $st=strtotime($s);
            $end=strtotime($e)+$_24;
        }else{
            $st=strtotime($dateFrom);
            $end=strtotime($dateTo)+$_24;
        }
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        // $limit=-1;

        if(empty($this->input->get("insurance")) && empty($this->input->get("sponsor"))){
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['lists'] = $this->lab_model->getLabReportBySearch($st,$end,$search);
                } else {
                    $data['lists'] = $this->lab_model->getLabReport($st,$end);
                }
            } else {
                if (!empty($search)) {
                    $data['lists'] = $this->lab_model->getLabReportByLimitBySearch($st,$end,$limit, $start, $search);
                    
                } else {
                    $data['lists'] = $this->lab_model->getLabReportByLimit($st,$end,$limit, $start);
                    
                }
            }
            $recordFiltered=count($this->lab_model->getLabReport($st,$end));
        }else{
            $data['lists'] = $this->lab_model->getLabReport($st,$end);
            $recordFiltered=0;
        }
        $i = 0;
        foreach ($data['lists'] as $lab) {
            //$i = $i + 1;
            $date = date('d-m-y', $lab->date);

            $options3 = ' <a type="button" class="btn btn-info btn-xs btn_width detailsbutton xrayview" title="View Report" data-toggle = "modal" data-id="' . $lab->id . '"><i class="fa fa-file"> </i> </a>';

            $doctor_info = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_info)) {
                $doctor = $doctor_info->name;
            } else {
                if (!empty($lab->doctor_name)) {
                    $doctor = $lab->doctor_name;
                } else {
                    $doctor = ' ';
                }
            }


            $patient_info = $this->patient_model->getPatientById($lab->patient);
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            if($patient_info->insurance_sponsor != null){
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $patient_info->insurance_sponsor))->row();
                $sponsor=$sp->name;
                $hmo = $this->db->get_where('hmo', array('id' => $patient_info->insurance_id))->row();
                $insurance=$hmo->name;
            }else{
                $insurance=$patient_info->patient_type;
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $patient_info->insurance_id))->row();
                $sponsor=$sp->name;
            }

            //work on insurance filter here
            if(!empty($this->input->get("insurance"))){
                if($this->input->get("insurance") =="private"){
                    $recordFiltered++;
                    if($insurance != "PRIVATE CLIENT" && $patient_info->patient_type != "Private Patient"){
                        // $insurance="hellow world";
                        continue;
                    }
                }else{
                    $in=$this->db->get_where('hmo', array('id' => $this->input->get("insurance")))->row();
                    if($insurance != $in->name){
                        continue;
                    }else{
                        $recordFiltered++;
                    }
                }
                if ($limit != -1) {
                    $limit=$limit+$start;
                    $vi=$recordFiltered < $start;
                    if($recordFiltered >=$limit){
                        continue;
                    }
                    if($vi){
                        continue;
                    }
                }
                
            }

            //work on sponsor here
            if(!empty($this->input->get("sponsor"))){
                $in=$this->db->get_where('hmo_sponsor', array('id' => $this->input->get("sponsor")))->row();
                if($sponsor != $in->name){
                    continue;
                }else{
                    $recordFiltered++;
                }
                if ($limit != -1) {
                    $limit=$limit+$start;
                    $vi=$recordFiltered < $start;
                    if($recordFiltered >=$limit){
                        continue;
                    }
                    if($vi){
                        continue;
                    }
                }
                
            }
            
            $test=$lab->title;
            if(empty($test)){
                $test=$lab->report;
            }


            $info[] = array(
                $date,
                $patient_details,
                $test,
                $doctor,
                $insurance,
                $sponsor,
                    // $options2 . ' ' . $options3
            );
            $i = $i + 1;
        }
        

        if ($recordFiltered >0) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $recordFiltered,
                "recordsFiltered" => $recordFiltered,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }


}

/* End of file lab.php */
/* Location: ./application/modules/lab/controllers/lab.php */