<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('patient_model');
        $this->load->model('donor/donor_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('department/department_model');
        $this->load->model('bed/bed_model');
        $this->load->model('lab/lab_model');
        $this->load->model('finance/finance_model');
        $this->load->model('finance/pharmacy_model');
        $this->load->model('sms/sms_model');
        $this->load->module('sms');
        $this->load->model('prescription/prescription_model');
        $this->load->model('medicine/medicine_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('nurse/nurse_model');
        $this->load->module('paypal');
        if (!$this->ion_auth->in_group(array('admin','Record_Officer', 'Nurse', 'Patient', 'Doctor', 'Laboratorist', 'Accountant', 'Receptionist','Pharmacist'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        $data['departments']=$this->department_model->getDepartment();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings(); 
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('patient', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function walkinPatient() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        $data['departments']=$this->department_model->getDepartment();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings(); 
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('walkin', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function calendar() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('calendar', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        $data = array();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }



























    public function addfNew() {
        $file_path="./uploads/upload3.csv";
        $i=0;
        $e=1;
        if (($open = fopen($file_path, "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {  
                if ($i<2){
                    $i++;
                    continue;
                } 
                // Array ( [0] => MR No. [1] => Patient Title [2] => Patient Name [3] => Age 
                // [4] => Gender [5] => Date of Birth [6] => Mobile No. [7] => Address 
                // [8] => Email Id [9] => Occupation [10] => First Visit Date [11] => Last Visit Date 
                // [12] => Genotype [13] => Next of Kin Relation [14] => Current Patient Category ) 

                
                //check if the patient has already been registered
                $mr_no = $data[0];
                if($this->patient_model->getPatientByMr($mr_no)){
                    continue;
                }
                //run registration
                $title = $data[1];
                if(strtoupper(substr($title,0,3)) == "MR." || strtoupper(substr($title,0,3)) == "MRS"){
                    $rel="Married";
                }else{
                    $rel="Single";
                }
                $name = $data[2];
                $password = "12345";
                $sms = $this->input->post('sms');
                $doctor = "";
                $address = $data[7];
                $phone = $data[6];
                $sex = $data[4];
                $birthdate = str_replace("/","-",$data[5]);
                $bloodgroup = "";
                $patient_id = "";
                $birth_place = "";
                $marital = $rel;
                $occupation = $data[9];
                $id_no = " ";
                $patient_type = $data[14];
                $kin = "";
                $kin_phone = " ";
                $kin_address = " ";
                $kin_email = " ";
                $insurance = "";
                $policy_no = "";
                $genotype = $data[12];
                $kin_relationship = "";
                $insurance_plan = "";
                $insurance_group = "";
                $last_visit=$data[11];
                $modified_by="";
                $add_date = str_replace("-","/",$data[10]);
                $email=time().$e."@xerdocshms.com";
                if ($this->ion_auth->in_group(array('Patient'))) {
                    redirect('home/permission');
                }
                $id = $this->input->post('id');
                if (empty($patient_id)) {
                    $patient_id = rand(10000, 1000000);
                }
                if ((empty($id))) {
                    $registration_time = time();
                } else {
                    $registration_time = $this->patient_model->getPatientById($id)->registration_time;
                }

                if (empty($id)) {
                    $limit = $this->patient_model->getLimit();
                    if ($limit <= 0) {
                        $this->session->set_flashdata('feedback', lang('patient_limit_exceed'));
                        redirect('patient');
                    }
                }
                if (!empty($id)) {
                    $this->session->set_flashdata('feedback', lang('validation_error'));
                    redirect("patient/editPatient?id=$id");
                } else {
                    $data = array();
                    $data['setval'] = 'setval';
                    $data['doctors'] = $this->doctor_model->getDoctor();
                    $data['groups'] = $this->donor_model->getBloodBank();
                }
                $data = array();
                $data = array(
                    'title' => $title,
                    'patient_id' => $patient_id,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'doctor' => $doctor,
                    'phone' => $phone,
                    'sex' => $sex,
                    'birthdate' => $birthdate,
                    'bloodgroup' => $bloodgroup,
                    'add_date' => $add_date,
                    'registration_time' => $registration_time,
                    'birth_place' => $birth_place,
                    'marital_status' => $marital,
                    'occupation' => $occupation,
                    'id_no' => $id_no,
                    'patient_type' => $patient_type,
                    'insurance_id' => $insurance,
                    'policy_no' => $policy_no,
                    'kin' => $kin,
                    'kin_phone' => $kin_phone,
                    'kin_address' => $kin_address,
                    'kin_email' => $kin_email,
                    'kin_relationship' => $kin_relationship,
                    'genotype' => $genotype,
                    'mr_no' => $mr_no,
                    'insurance_plan' => $insurance_plan,
                    'insurance_group' => $insurance_group,
                    'last_visit' => $last_visit,
                    'modified_by' => $modified_by,
                    'start_date' =>'',
                    'end_date' =>''
                );
    
                $username = $name;
    
                if (empty($id)) {     // Adding New Patient
                    if ($this->ion_auth->email_check($email)) {
                        echo "email address already exists <br/><br/>";
                        die();
                    } else {
                        $dfg = 5;
                        $this->ion_auth->register($username, $password, $email, $dfg);
                        $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                        $this->patient_model->insertPatient($data);
                        $patient_user_id = $this->db->get_where('patient', array('email' => $email))->row()->id;
                        $id_info = array('ion_user_id' => $ion_user_id);
                        $this->patient_model->updatePatient($patient_user_id, $id_info);
                        $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                        
                        
    
    
    
                    echo "Added $e :::::::::::: $name-----$mr_no<br/><br/>";
                    // break;
                    $e++;
                    }
                    //    }
                } else { // Updating Patient
                    echo "patient already added";
                    break;
                    // $ion_user_id = $this->db->get_where('patient', array('id' => $id))->row()->ion_user_id;
                    // if (empty($password)) {
                    //     $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                    // } else {
                    //     $password = $this->ion_auth_model->hash_password($password);
                    // }
                    // $this->patient_model->updateIonUser($username, $email, $password, $ion_user_id);
                    // $this->patient_model->updatePatient($id, $data);
                    // $this->session->set_flashdata('feedback', lang('updated'));
                }
            }
            fclose($open);
        }
        return;





        

        
    }














    function emr2(){
        $dir    = 'uploads/exist';
        $i=0;
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($file = readdir($dh)) !== false){
                    if($i<2){
                        $i++;
                        continue;
                    }
                    unlink("uploads/unnamed/$file");










                }
                echo "<br/><br/>DONE";
                closedir($dh);
            }
          }else{
              echo "is not dir";
          }
    }

























    function emr(){
        $dir    = 'uploads/unnamed';
        $i=0;
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($file = readdir($dh)) !== false){
                    if($i<2){
                        $i++;
                        continue;
                    }
                    $index=strpos($file,"-");
                    $bindex=strripos($file,"(");
                    $mr_no=substr($file,0,$index);
                    
                    $p=$this->patient_model->getPatientByMr($mr_no);
                    $title=substr($file,($index+1), ($bindex - ($index+3)));
                    $patient_id = $p->id;
                    $img_url = "uploads/$file";
                    $d=substr($file,($bindex+1),10);
                    $date=strtotime($d);
                    $patient_name = $p->name;
                    $patient_phone = $p->phone;
                    $patient_address = $p->address;
    
    
    
                    $data = array();
                    $data = array(
                        'date' => $date,
                        'title' => $title,
                        'url' => $img_url,
                        'patient' => $patient_id,
                        'patient_name' => $patient_name,
                        'patient_address' => $patient_address,
                        'patient_phone' => $patient_phone,
                        'date_string' => date('d-m-y', $date),
                    );
                    $this->patient_model->insertPatientMaterial($data);
                    echo "$file ------ added<br/>";










                }
                echo "<br/><br/>DONE";
                closedir($dh);
            }
          }else{
              echo "is not dir";
          }
    }








    public function addNew() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $id = $this->input->post('id');


        if (empty($id)) {
            $limit = $this->patient_model->getLimit();
            if ($limit <= 0) {
                $this->session->set_flashdata('feedback', lang('patient_limit_exceed'));
                redirect('patient');
            }
        }


        $redirect = $this->input->get('redirect');
        if (empty($redirect)) {
            $redirect = $this->input->post('redirect');
        }
        $title = $this->input->post('title');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $sms = $this->input->post('sms');
        $doctor = $this->input->post('doctor');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
        $birthdate = $this->input->post('birthdate');
        $bloodgroup = $this->input->post('bloodgroup');
        $patient_id = $this->input->post('p_id');
        $birth_place = $this->input->post('birth_place');
        $marital = $this->input->post('marital');
        $occupation = $this->input->post('occupation');
        $id_no = $this->input->post('id_no');
        $patient_type = $this->input->post('patient_type');
        $kin = $this->input->post('kin');
        $kin_phone = $this->input->post('kin_phone');
        $kin_address = $this->input->post('kin_address');
        $kin_email = $this->input->post('kin_email');
        $insurance = $this->input->post('insurance');
        $policy_no = $this->input->post('policy_no');
        $genotype = $this->input->post('genotype');
        $kin_relationship = $this->input->post('kin_relationship');
        $insurance_plan = $this->input->post('insurance_plan');
        $sponsor = $this->input->post('sponsor');
        $religion = $this->input->post('religion');
        $image = $this->input->post('image');
        $type = $this->input->post('type');
        if (empty($patient_id)) {
            $patient_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('m/d/y');
            $registration_time = time();
        } else {
            $add_date = $this->patient_model->getPatientById($id)->add_date;
            $registration_time = $this->patient_model->getPatientById($id)->registration_time;
        }


        $email = $this->input->post('email');
        $modified_by=$this->ion_auth->get_user_id();





        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            // $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        // $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Doctor Field
        //   $this->form_validation->set_rules('doctor', 'Doctor', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|min_length[2]|max_length[50]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('sex', 'Sex', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'trim|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('bloodgroup', 'Blood Group', 'trim|min_length[1]|max_length[10]|xss_clean');
        
        //validating the birth place
        $this->form_validation->set_rules('birth_place', 'Place of Birth', 'trim|min_length[2]|max_length[100]|xss_clean');
        //validating the marital status
        $this->form_validation->set_rules('marital', 'Marital Status', 'trim|min_length[2]|max_length[100]|xss_clean');
        //validating the occupation
        $this->form_validation->set_rules('occupation', 'Occupation', 'trim|min_length[2]|max_length[100]|xss_clean');
        //validating the id Number
        $this->form_validation->set_rules('id_no', 'Service / ID No', 'trim|min_length[2]|max_length[100]|xss_clean');
        //validating the patient type
        $this->form_validation->set_rules('patient_type', 'Patient Type', 'trim|min_length[2]|max_length[100]|xss_clean');
        //validating the kin
        $this->form_validation->set_rules('kin', 'Next of Kin', 'trim|min_length[2]|max_length[100]|xss_clean');
        //validating the kin phone
        $this->form_validation->set_rules('kin_phone', 'Next of Kin Phone No', 'trim|min_length[2]|max_length[100]|xss_clean');
        //validating the kin address
        $this->form_validation->set_rules('kin_address', 'Next of Kin Phone Address', 'trim|min_length[2]|max_length[100]|xss_clean');
        //validating the kin email
        $this->form_validation->set_rules('kin_email', 'Next of Kin email', 'trim|min_length[2]|max_length[100]|xss_clean');
        

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', lang('validation_error'));
                redirect("patient/editPatient?id=$id");
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['doctors'] = $this->doctor_model->getDoctor();
                $data['groups'] = $this->donor_model->getBloodBank();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            if($image==""){
                $file_name = $_FILES['img_url']['name'];
                $file_name_pieces = explode('_', $file_name);
                $new_file_name = '';
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
                if ($this->upload->do_upload('img_url')) {
                    $path = $this->upload->data();
                    $img_url = "uploads/" . $path['file_name'];
                }else{
                    $img_url="";
                }
            }else{
                if(substr($image,0,6)=="upload"){
                    $img_url="$image";
                }else{
                    $img_url="uploads/$image";
                }
            }
            $data = array();
            $data = array(
                'title' => $title,
                'patient_id' => $patient_id,
                'img_url' => $img_url,
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'doctor' => $doctor,
                'phone' => $phone,
                'sex' => $sex,
                'religion' => $religion,
                'birthdate' => $birthdate,
                'bloodgroup' => $bloodgroup,
                'add_date' => $add_date,
                'registration_time' => $registration_time,
                'birth_place' => $birth_place,
                'marital_status' => $marital,
                'occupation' => $occupation,
                'id_no' => $id_no,
                'patient_type' => $patient_type,
                'insurance_id' => $insurance,
                'policy_no' => $policy_no,
                'kin' => $kin,
                'kin_phone' => $kin_phone,
                'kin_address' => $kin_address,
                'kin_email' => $kin_email,
                'kin_relationship' => $kin_relationship,
                'genotype' => $genotype,
                'insurance_plan' => $insurance_plan,
                'insurance_sponsor' => $sponsor,
                'modified_by' => $modified_by,
                'type' =>$type,
                'start_date' =>'',
                'end_date' =>''
            );
            
            

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Patient
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('patient/addNewView');
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->patient_model->insertPatient($data);
                    $patient_user_id = $this->db->get_where('patient', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->patient_model->updatePatient($patient_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                    //sms
                    $set['settings'] = $this->settings_model->getSettings();
                    $autosms = $this->sms_model->getAutoSmsByType('patient');
                    $message = $autosms->message;
                    $to = $phone;
                    $name1 = explode(' ', $name);
                    if (!isset($name1[1])) {
                        $name1[1] = null;
                    }
                    $data1 = array(
                        'firstname' => $name1[0],
                        'lastname' => $name1[1],
                        'name' => $name,
                        'doctor' => $doctor,
                        'company' => $set['settings']->system_vendor
                    );
                      if (!empty($sms)) {
                    // $this->sms->sendSmsDuringPatientRegistration($patient_user_id);
                    if ($autosms->status == 'Active') {
                        $messageprint = $this->parser->parse_string($message, $data1);
                        $data2[] = array($to => $messageprint);
                        $this->sms->sendSms($to, $message, $data2);
                    }
                    //end
                     }
                    //email

                    $autoemail = $this->email_model->getAutoEmailByType('patient');
                    if ($autoemail->status == 'Active') {
                        $emailSettings = $this->email_model->getEmailSettings();
                        $message1 = $autoemail->message;
                        $messageprint1 = $this->parser->parse_string($message1, $data1);
                        $this->email->from($emailSettings->admin_email);
                        $this->email->to($email);
                        $this->email->subject('Appointment confirmation');
                        $this->email->message($messageprint1);
                        $this->email->send();
                    }

                    //end



                    $this->session->set_flashdata('feedback', lang('added'));
                }
                //    }
            } else { // Updating Patient
                $ion_user_id = $this->db->get_where('patient', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->patient_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->patient_model->updatePatient($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            if (!empty($redirect)) {
                redirect($redirect);
            } else {
                redirect('patient');
            }
        }
    }

    function editPatient() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPatientByJason() {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['doctor'] = $this->doctor_model->getDoctorById($data['patient']->doctor);
        $data['hmo']=array();
        if($data['patient']->patient_type!="Private Patient"){
            $data['hmo']=$this->finance_model->getHMOById($data['patient']->insurance_id);
            $data['sponsor']=$this->finance_model->getSponsorById($data['patient']->insurance_sponsor);
        }
        echo json_encode($data);
    }

    function res($status,$msg){
        $data=array("status"=>$status,"msg"=>$msg);
        return $data;
    }

    function mergePatient(){
        $p1=$this->patient_model->getPatientById($this->input->get("p1"));
        $p2=$this->patient_model->getPatientById($this->input->get("p2"));
        if($p1->sex != $p2->sex){
            echo json_encode($this->res(false,"Patient gender don't match"));
            die();
        }
        if($p1->birthdate != $p2->birthdate){
            echo json_encode($this->res(false,"Patient birthdate don't match"));
            die();
        }
        if($p1->policy_no != $p2->policy_no){
            echo json_encode($this->res(false,"Patient policy number don't match"));
            die();
        }
        if($p1->id == $p2->id){
            echo json_encode($this->res(false,"Please choose different profiles"));
            die();
        }
        //change p2 id to p1
        $merge=$this->patient_model->merge_patient($p1->id,$p2->id);
        $this->patient_model->delete($p2->id);
        echo json_encode($this->res(true,"Success"));
        die();
    }

    function editSymptomByJason() {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getSymptomById($id);
        echo json_encode($data);
    }

    function getPatientByJason() {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);

        $doctor = $data['patient']->doctor;
        $data['doctor'] = $this->doctor_model->getDoctorById($doctor);

        if (!empty($data['patient']->birthdate)) {
            $birthDate = strtotime($data['patient']->birthdate);
            $birthDate = date('m/d/Y', $birthDate);
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
            $data['age'] = $age . ' Year(s)';
        }

        $data['hmo']=array();
        if($data['patient']->patient_type!="Private Patient"){
            $data['hmo']=$this->finance_model->getHMOById($data['patient']->insurance_id);
        }

        echo json_encode($data);
    }

    public function add_vitals() {
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }
        $data['vitals'] = $this->patient_model->getHospitalVitals();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_vitals', $data);
        $this->load->view('home/footer'); // just the header file
    }

    

    public function addVitalColumn(){
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }

        $name=$this->input->post("name");
        if(trim(strlen($name)) < 1 ){
            redirect('patient/add_vitals');
        }

        $data=array();
        $data=array(
            'name'=>$name
        );

        $this->patient_model->addVitalColumn($data);
        $this->session->set_flashdata('feedback', lang('added'));
        redirect('patient/add_vitals');
    }

    public function editVitalName(){
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }

        $name=$this->input->post("name");
        $id=$this->input->post("id");
        $id=preg_replace('#[^0-9]#','',$id);
        $name=preg_replace('#[^0-9a-zA-Z -_]#','',$name);

        //confirm that the admin has the right to delete the or edit the form
        $vital_row=$this->patient_model->getVitalRow($id);
        if($vital_row->hospital_id != $this->session->userdata('hospital_id')){
            $this->session->set_flashdata('feedback', lang('No Permission'));            
            redirect('patient/add_vitals');
        }
        
        //update the database

        $data=array();
        $data=array(
            'name'=>$name
        );

        $this->patient_model->updateVitalColumn($id, $data);
        $this->session->set_flashdata('feedback', lang('Updated'));
        redirect('patient/add_vitals');

    }

    public function deletevitalRow(){
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }

        $id=$this->input->get("id");
        $id=preg_replace('#[^0-9]#','',$id);

        //confirm that the admin has the right to delete the or edit the form
        $vital_row=$this->patient_model->getVitalRow($id);
        if($vital_row->hospital_id != $this->session->userdata('hospital_id')){
            $this->session->set_flashdata('feedback', lang('No Permission'));            
            redirect('patient/add_vitals');
        }

        $this->patient_model->deleteVitalColumn($id);
        $this->session->set_flashdata('feedback', lang('Deleted'));
        redirect('patient/add_vitals');

    }


    function consultation(){
        $id = $this->input->post('id');
        $doctor = $this->input->post('doctor');
        $dept = $this->input->post('department');
        $period = $this->input->post('period');
        $Userid = $this->ion_auth->get_user_id(); //Receptionist
        if ($this->ion_auth->in_group(array('Receptionist'))) {
            $sent_by="R".$Userid;
        }else if($this->ion_auth->in_group(array('Nurse'))){
            $sent_by="N".$Userid;
        }else if($this->ion_auth->in_group(array('admin'))){
            $sent_by=$Userid;
        }else{
            redirect('home/permission');
        }
        $patient_details = $this->patient_model->getPatientById($id);
        $patient_name = $patient_details->name;
        $patient_phone = $patient_details->phone;
        $patient_address = $patient_details->address;
    

        $data = array(); 
            $data = array(
                'doctor' => $doctor,
                'patient_id' => $id,
                'dept' => $dept,
                'sent_by' => $sent_by,
                'checkin_id'=>$this->patient_model->getCheckInId($id),
                'date' => time()
            );
        $c_id=$this->patient_model->addConsultation($data);
        //add the payment
        if($period == "first"){
            $c_id=$this->department_model->getDepartmentById($dept)->first_visit;
        }else{
            $c_id=$this->department_model->getDepartmentById($dept)->follow_up;
        }
        $current_item = $this->finance_model->getPaymentCategoryById($c_id);
        //check if this patient is a hmo patient and get their price
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
        $cat_and_price[] = $key . '*' . $category_price . '*' . $category_type . '*' . $qty;
        $category_name = implode(',', $cat_and_price);
        //add the bill 
        $data=array();
        $data = array(
            'category_name' => $category_name,
            'patient' => $id,
            'date' => time(),
            'amount' => $category_price,
            'doctor' => $doctor,
            'discount' => '0',
            'flat_discount' => '0',
            'gross_total' => $category_price,
            'status' => 'unpaid',
            'hospital_amount' => $category_price,
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
        $this->session->set_flashdata('feedback', "Sent");
        redirect('patient');
    }

    function upload(){
        if( isset($_FILES['gfile']) and !$_FILES['gfile']['error'] ){
            $name="IMG".time().".jpg";
            //$name=$file.".mp3";
            $file="uploads/".$name;
            //open the file
            $fp=fopen($file,'a');
            $fileContent = file_get_contents($_FILES['gfile']['tmp_name']);

            // dfdfadf
            fwrite($fp,$fileContent);
            fclose($fp);
            // file_put_contents( "uploads/image.png", file_get_contents($_FILES['avatar']['tmp_name']) );
            echo "ok|$name";
        }else{
            echo "no file";
        }
    }

    function PatientVitalsandConsultation(){
        $id = $this->input->post('id');
        $Userid = $this->ion_auth->get_user_id(); //Receptionist
        if ($this->ion_auth->in_group(array('Receptionist'))) {
            $sent_by="R".$Userid;
        }else if($this->ion_auth->in_group(array('Nurse'))){
            $sent_by="N".$Userid;
        }else if($this->ion_auth->in_group(array('admin'))){
            $sent_by=$Userid;
        }else{
            redirect('home/permission');
        }

        $data = array(); 
            $data = array(
                'nurse' => "",
                'patient_id' => $id,
                'sent_by' => $sent_by,
                'date' => time()
            );
        $this->patient_model->addVitalAppointment($data);
        $this->consultation();
        
        //send for consultation
    }

    function scheduleVital(){
        $id = $this->input->post('id');
        $nurse = $this->input->post('nurse');
        $Userid = $this->ion_auth->get_user_id(); //Receptionist
        if ($this->ion_auth->in_group(array('Receptionist'))) {
            $sent_by="R".$Userid;
        }else if($this->ion_auth->in_group(array('Nurse'))){
            $sent_by="N".$Userid;
        }else{
            redirect('home/permission');
        }
        $patient_details = $this->patient_model->getPatientById($id);
        $patient_name = $patient_details->name;
        $patient_phone = $patient_details->phone;
        $patient_address = $patient_details->address;
    

        $data = array(); 
            $data = array(
                'nurse' => $nurse,
                'patient_id' => $id,
                'sent_by' => $sent_by,
                'date' => time()
            );
        $c_id=$this->patient_model->addVitalAppointment($data);
       $this->session->set_flashdata('feedback', "Sent");
        redirect('patient');
    }

    function viewConsultation(){
        $data=array();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('consultation', $data);
        $this->load->view('home/footer'); // just the header file
    }


    function getVitalsByJson() {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);

        $doctor = $data['patient']->doctor;
        $data['vitals'] = $this->patient_model->getTodayVitalsById($id);
        if($data['vitals'] == null){
            $vitals=array();
            $vitals=array(
                'height'=>"",
                'weight'=>"",
                'bp' =>"",
                'pulse'=>"", 
                'patient_id'=>"",
                'temperature'=>"",
                'respiration'=>"",
                'date'=>time()
            );
            $data['vitals']=$vitals;
            $data['vitals_by']="Nobody";
            $data['date']="No Record";
            $data['cvitals']=array(
                'id'=>"",
                'vital_id'=>"",
                'form_id' =>"",
                'data' =>""
            );
        }else{
            $vitals_by = $data['vitals']->vitals_by;
            $data['date']=date("d M, Y", $data['vitals']->time);
            $data['vitals_by']=$this->patient_model->vitalsBy($vitals_by);
            $vi_id= $data['vitals']->id;
            $data['cvitals']=$this->patient_model->getCustomVitals($vi_id);
            if($data['cvitals']==null){
                $data['cvitals']=array(
                    'id'=>"",
                    'vital_id'=>"",
                    'form_id' =>"",
                    'data' =>""
                );
            }
        }
        echo json_encode($data);
    }

    function getNoteByJson() {
        $id = $this->input->get('id');

        $data['note'] = $this->patient_model->getNoteById($id);
        
        $vitals_by = $data['note']->taken_by;
        $data['date']=date("d - M, Y", $data['note']->date);
        $data['taken_by']=$this->patient_model->vitalsBy($vitals_by);
        $data['med']=$this->patient_model->getBedsideMed($id);
        echo json_encode($data);
    }

    
    
    public function vitals() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        $data['vitals'] = $this->patient_model->getHospitalVitals();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('vitals', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function birthdays() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        $data=array();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('birthday', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addVitals() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $id = $this->input->post('id');


        $redirect = $this->input->get('redirect');
        if (empty($redirect)) {
            $redirect = $this->input->post('redirect');
        }
        $height = $this->input->post('Height');
        $weight = $this->input->post('Weight');
        $bp = $this->input->post('BP');
        $pulse = $this->input->post('Pulse');
        $temperature = $this->input->post('Temperature');
        $respiration = $this->input->post('Respiration');
        $patient_id = $this->input->post('p_id');
        if (empty($id)) {
            $this->session->set_flashdata('feedback', 'No id specified');
            redirect("patient/vitals");
        }
        $add_date = date('m/d/y');
        $registration_time = time();


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('height', 'Height', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('weight', 'Weight', 'trim|min_length[3]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('bp', 'BP', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Doctor Field
        //   $this->form_validation->set_rules('doctor', 'Doctor', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('pulse', 'Pulse', 'trim|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('temperature', 'Temperature', 'trim|min_length[2]|max_length[50]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('respiration', 'Respiration', 'trim|min_length[2]|max_length[100]|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', lang('validation_error'));
                redirect("patient/vitals");
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['doctors'] = $this->doctor_model->getDoctor();
                $data['groups'] = $this->donor_model->getBloodBank();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('vitals', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $Userid = $this->ion_auth->get_user_id(); //Receptionist
            if ($this->ion_auth->in_group(array('Receptionist'))) {
                $vitals_adder="R".$Userid;
            }else if($this->ion_auth->in_group(array('Nurse'))){
                $vitals_adder="N".$Userid;
            }else if($this->ion_auth->in_group(array('Doctor'))){
                $vitals_adder="D".$Userid;
            }else{
                redirect('home/permission');
            }
        

            $data = array(); 
                $data = array(
                    'patient_id' => $id,
                    'height' => $height,
                    'weight' => $weight,
                    'bp' => $bp,
                    'pulse' => $pulse,
                    'temperature' => $temperature,
                    'respiration' => $respiration,
                    'vitals_by' => $vitals_adder,
                    'date' => $add_date,
                    'time' => $registration_time
                );

           
            $v_id=$this->patient_model->insertPatientVitals($data);

            //check if the hospital have any custom vital
            $c=$this->patient_model->getHospitalVitals();
            foreach($c as $vital){
                $key="v".$vital->id;
                $val = $this->input->post($key);
                $data=array();
                $data=array(
                    'vital_id'=>$v_id,
                    'form_id'=>$vital->id,
                    'patient_id' => $id,
                    'data'=>$val
                );
                $this->patient_model->insertCustomVitals($data);
            }
            $this->session->set_flashdata('feedback', lang('added'));

            redirect('patient/vitals');
        }
    }

    function patientDetails() {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function vitalsAppointment() {
        $data = array();
        if (!$this->ion_auth->in_group(array('Nurse'))) {
            redirect('home/permission');
        }
        $data['vitals'] = $this->patient_model->getHospitalVitals();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('vitals_appointment', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function report() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('diagnostic_report_details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addDiagnosticReport() {
        $id = $this->input->post('id');
        $invoice = $this->input->post('invoice');
        $patient = $this->input->post('patient');
        $report = $this->input->post('report');

        $date = time();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        // Validating Name Field
        $this->form_validation->set_rules('invoice', 'Invoice', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field

        $this->form_validation->set_rules('report', 'Report', 'trim|min_length[1]|max_length[10000]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', lang('validation_error'));
            redirect('patient/report?id=' . $invoice);
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'invoice' => $invoice,
                'date' => $date,
                'report' => $report
            );

            if (empty($id)) {     // Adding New department
                $this->patient_model->insertDiagnosticReport($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating department
                $this->patient_model->updateDiagnosticReport($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('patient/report?id=' . $invoice);
        }
    }

    function patientPayments() {
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('patient_payments', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function symptom(){
        $data=array();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('symptom', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function addSymptom(){
        $name=$this->input->post("name");
        $description=$this->input->post("description");
        if (!$this->ion_auth->in_group(array('admin','Doctor'))) {
            redirect('home/permission');
        }
        $data=array();
        $data=array(
            'name'=>$name,
            'description'=>$description,
            'ion_user_id'=>$this->ion_auth->get_user_id()
        );

        $this->patient_model->addSymptom($data);
        $this->session->set_flashdata('feedback', lang('added'));
        redirect('patient/symptom');
    }

    

    function editSymptom(){
        $name=$this->input->post("name");
        $description=$this->input->post("description");
        $id=$this->input->post("id");
        if (!$this->ion_auth->in_group(array('admin','Doctor'))) {
            redirect('home/permission');
        }
        $data=array();
        $data=array(
            'name'=>$name,
            'description'=>$description,
            'ion_user_id'=>$this->ion_auth->get_user_id()
        );

        $this->patient_model->updateSymptom($id,$data);
        $this->session->set_flashdata('feedback', lang('updated'));
        redirect('patient/symptom');
    }

    function caseList() {
        $data['settings'] = $this->settings_model->getSettings();
        $data['patients'] = $this->patient_model->getPatient();
        $data['medical_histories'] = $this->patient_model->getMedicalHistory();
        $data['vitals'] = $this->patient_model->getHospitalVitals();
        $data['operations'] = $this->patient_model->getAllOperations();
        if($this->input->get("consult") != null){
            $p=$this->patient_model->getPatientById($this->input->get("consult"));
            $d=array(
                'name'=>$p->name,
                'id'=>$p->id
            );
            $data['consult']=$d;
        }
        
        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $dept=$this->doctor_model->getDoctorByIonUserId($doctor_ion_id)->department;
            $dept_id=$this->department_model->getDepartmentByName($dept)->id;
            $data['forms'] = $this->department_model->getDepartmentCaseForms($dept_id);
            $groups=array();
            foreach($data['forms'] as $form){
                if($form->type == "group"){
                    $dId="f".$form->id;
                    $groups["f".$form->id]=$this->department_model->getDepartmentCaseForms($dId);
                }
            }
            $data['groups']=$groups;

        }
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('case_list', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function caseManager() {
        if (!$this->ion_auth->in_group(array('Doctor'))) {
            redirect("home/permission");
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['patients'] = $this->patient_model->getPatient();
        $data['medical_histories'] = $this->patient_model->getMedicalHistory();
        $data['vitals'] = $this->patient_model->getHospitalVitals();
        $data['operations'] = $this->patient_model->getAllOperations();
        $data["radiology"]=$this->lab_model->getAllRadiology();
        if($this->input->get("consult") != null){
            $p=$this->patient_model->getPatientById($this->input->get("consult"));
            $d=array(
                'name'=>$p->name,
                'id'=>$p->id
            );
            $data['consult']=$d;
        }
        $consult_dept="";
        
        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $dept=explode("|",$this->doctor_model->getDoctorByIonUserId($doctor_ion_id)->department);
            $data['depts']=$dept;
            $consult_dept=$dept[0];
            if($this->input->get("dept")){
                $consult_dept=$this->input->get("dept");
            }
            $data['forms'] = $this->department_model->getDepartmentCaseForms($consult_dept);
            $groups=array();
            foreach($data['forms'] as $form){
                if($form->type == "group"){
                    $dId="f".$form->id;
                    $groups["f".$form->id]=$this->department_model->getDepartmentCaseForms($dId);
                }
            }
            $data['groups']=$groups;

        }
        $data['consult_dept']=$consult_dept;
        $data['lab_tests']=$this->lab_model->getLabTest();
        $data['test_category']=$this->lab_model->getLabTestCategory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('case_manager', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    

    function documents() {
        $data['patients'] = $this->patient_model->getPatient();
        $data['files'] = $this->patient_model->getPatientMaterial();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('documents', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function myCaseList() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['medical_histories'] = $this->patient_model->getMedicalHistoryByPatientId($patient_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_case_list', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function myDocuments() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['files'] = $this->patient_model->getPatientMaterialByPatientId($patient_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_documents', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function myPrescription() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['doctors'] = $this->doctor_model->getDoctor();
            $data['prescriptions'] = $this->prescription_model->getPrescriptionByPatientId($patient_id);
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('my_prescription', $data);
            $this->load->view('home/footer'); // just the header file
        }
    }

    public function myPayment() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
            $data['settings'] = $this->settings_model->getSettings();
            $data['payments'] = $this->finance_model->getPaymentByPatientId($patient_id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('my_payment', $data);
            $this->load->view('home/footer'); // just the header file
        }
    }

    function myPaymentHistory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }


        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
        }
        $data['settings'] = $this->settings_model->getSettings();
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        if (!empty($date_from)) {
            $data['payments'] = $this->finance_model->getPaymentByPatientIdByDate($patient, $date_from, $date_to);
            $data['deposits'] = $this->finance_model->getDepositByPatientIdByDate($patient, $date_from, $date_to);
            $data['gateway'] = $this->finance_model->getGatewayByName($data['settings']->payment_gateway);
        } else {
            $data['payments'] = $this->finance_model->getPaymentByPatientId($patient);
            $data['pharmacy_payments'] = $this->pharmacy_model->getPaymentByPatientId($patient);
            $data['ot_payments'] = $this->finance_model->getOtPaymentByPatientId($patient);
            $data['deposits'] = $this->finance_model->getDepositByPatientId($patient);
            $data['gateway'] = $this->finance_model->getGatewayByName($data['settings']->payment_gateway);
        }



        $data['patient'] = $this->patient_model->getPatientByid($patient);
        $data['settings'] = $this->settings_model->getSettings();



        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('my_payments_history', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function deposit() {
        $id = $this->input->post('id');


        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
        } else {
            $this->session->set_flashdata('feedback', lang('undefined_patient_id'));
            redirect('patient/myPaymentsHistory');
        }



        $payment_id = $this->input->post('payment_id');
        $date = time();

        $deposited_amount = $this->input->post('deposited_amount');

        $deposit_type = $this->input->post('deposit_type');

        if ($deposit_type != 'Card') {
            $this->session->set_flashdata('feedback', lang('undefined_payment_type'));
            redirect('patient/myPaymentsHistory');
        }

        $user = $this->ion_auth->get_user_id();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
// Validating Patient Name Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');
// Validating Deposited Amount Field
        $this->form_validation->set_rules('deposited_amount', 'Deposited Amount', 'trim|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            redirect('patient/myPaymentsHistory');
        } else {
            $data = array();
            $data = array('patient' => $patient,
                'date' => $date,
                'payment_id' => $payment_id,
                'deposited_amount' => $deposited_amount,
                'deposit_type' => $deposit_type,
                'user' => $user
            );
            if (empty($id)) {
                if ($deposit_type == 'Card') {
                    $payment_details = $this->finance_model->getPaymentById($payment_id);
                    $gateway = $this->settings_model->getSettings()->payment_gateway;
                    if ($gateway == 'PayPal') {
                        $card_type = $this->input->post('card_type');
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv_number');

                        $all_details = array(
                            'patient' => $payment_details->patient,
                            'date' => $payment_details->date,
                            'amount' => $payment_details->amount,
                            'doctor' => $payment_details->doctor_name,
                            'discount' => $payment_details->discount,
                            'flat_discount' => $payment_details->flat_discount,
                            'gross_total' => $payment_details->gross_total,
                            'status' => 'unpaid',
                            'patient_name' => $payment_details->patient_name,
                            'patient_phone' => $payment_details->patient_phone,
                            'patient_address' => $payment_details->patient_address,
                            'deposited_amount' => $deposited_amount,
                            'payment_id' => $payment_details->id,
                            'card_type' => $card_type,
                            'card_number' => $card_number,
                            'expire_date' => $expire_date,
                            'cvv' => $cvv,
                            'from' => 'patient_payment_details',
                            'user' => $user,
                            'cardholdername' => $this->input->post('cardholder')
                        );
                        $this->paypal->paymentPaypal($all_details);
                    } elseif ($gateway == 'Paystack') {
                        $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m');
                        $amount_in_kobo = $deposited_amount;
                        $this->load->module('paystack');
                        $this->paystack->paystack_standard($amount_in_kobo, $ref, $patient, $payment_id, $user, '2');
                    }elseif ($gateway == 'Stripe') {
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv_number');
                        $token = $this->input->post('token');

                        $stripe = $this->db->get_where('paymentGateway', array('name =' => 'Stripe'))->row();
                        \Stripe\Stripe::setApiKey($stripe->secret);
                        $charge = \Stripe\Charge::create(array(
                                    "amount" => $deposited_amount * 100,
                                    "currency" => "usd",
                                    "source" => $token
                        ));
                        $chargeJson = $charge->jsonSerialize();
                         if ($chargeJson['status'] == 'succeeded') {
                            $data1 = array(
                                'date' => $date,
                                'patient' => $patient,
                                'payment_id' => $payment_id,
                                'deposited_amount' => $deposited_amount,
                                'gateway' => 'Stripe',
                                'user' => $user,
                                'hospital_id' => $this->session->userdata('hospital_id')
                            );
                            $this->finance_model->insertDeposit($data1);
                            $this->session->set_flashdata('feedback', lang('added'));
                        } else {
                            $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        }
                      //  redirect("finance/invoice?id=" . "$inserted_id");
                        redirect('patient/myPaymentHistory');
                    } elseif ($gateway == 'Pay U Money') {
                        redirect("payu/check?deposited_amount=" . "$deposited_amount" . '&payment_id=' . $payment_id);
                    } else {
                        $this->session->set_flashdata('feedback', lang('payment_failed_no_gateway_selected'));
                        redirect('patient/myPaymentHistory');
                    }
                } else {
                    $this->finance_model->insertDeposit($data);
                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else {
                $this->finance_model->updateDeposit($id, $data);

                $amount_received_id = $this->finance_model->getDepositById($id)->amount_received_id;
                if (!empty($amount_received_id)) {
                    $amount_received_payment_id = explode('.', $amount_received_id);
                    $payment_id = $amount_received_payment_id[0];
                    $data_amount_received = array('amount_received' => $deposited_amount);
                    $this->finance_model->updatePayment($amount_received_payment_id[0], $data_amount_received);
                }

                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('patient/myPaymentHistory');
        }
    }

    function myInvoice() {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('myInvoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }


    function addAllergy(){
        $id = $this->input->post('id');

        $patient_id = $this->input->post('p_id');

        $type = $this->input->post('type');

        $onset = $this->input->post('onset');

        $allergy=$this->input->post("allergy");

        $severity=$this->input->post("severity");

        $status=$this->input->post("status");

        $reaction=$this->input->post("reaction");

        $user_id = $this->ion_auth->get_user_id();

        $date=time();

        $data = array();
        $data = array(
            'patient_id' => $patient_id,
            'allergy' => $allergy,
            'type' => $type,
            'onset' => $onset,
            'severity' => $severity,
            'status' => $status,
            'reactions' => $reaction,
            'user_id' => $user_id,
            'date' => $date
        );

        if (empty($id)) {     // Adding New history
            $id=$this->patient_model->insertPatientAllergy($data);
            $this->session->set_flashdata('feedback', lang('added'));
        } else { // Updating history
            $this->patient_model->updatePatientAllergy($id, $data);
            $this->session->set_flashdata('feedback', lang('updated'));
        }

        redirect("patient/allergies?id=".$patient_id);

    }

    

    function getAllergies() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $patient_id=$this->input->post('id');
        

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientAllergyBySearch($patient_id,$search);
            } else {
                $data['patients'] = $this->patient_model->getPatientAllergy($patient_id);
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientAllergyByLimitBySearch($patient_id,$limit, $start, $search);
            } else {
                $data['patients'] = $this->patient_model->getPatientAllergyByLimit($patient_id,$limit, $start);
            }
        }
        
        $sn=1;
        foreach ($data['patients'] as $patient) {
            $p=$patient->id;
            $options1 = ' <a type="button" class="btn editbutton" title="Edit Note" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-edit"> </i> Edit</a>';
            
            

            $options2 = '<a class="btn inffo" title="View Allergy" style="color: #fff; background-color:#112233" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-info"></i>  View </a>';


                $info[] = array(
                    $sn,
                    $patient->allergy,
                    $patient->type,
                    $patient->severity,
                   $options2 ,
                        //  $options2
                );
                $sn++;

        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient')->num_rows(),
                "recordsFiltered" => $this->db->get('patient')->num_rows(),
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

    function getAllergyByJson() {
        $id = $this->input->get('id');
        $data['allergy'] = $this->patient_model->getAllergyById($id);
        
        $by = $data['allergy']->user_id;
        $data['date']=date("d - M, Y", $data['allergy']->date);
        $data['taken_by']=$this->ion_auth->user($by)->row()->username;
        echo json_encode($data);
    }

    function addMedicalHistory() {
        $id = $this->input->post('id');
        $historyId=$id;
        $patient_id = $this->input->post('patient_id');

        $date = $this->input->post('date');

        $title = $this->input->post('title');

        $operations=$this->input->post("operation");
        $department=$this->input->post("department");
        
        $doctor_id="";
        $tests=explode("|",$this->input->post('tests'));
        $rad_tests=explode("|",$this->input->post('rad_tests'));
        if(!$this->patient_model->isPatientCheckedIn($patient_id)){
            $this->session->set_flashdata('feedback', "Patient not Checked in");
            redirect('patient/medicalHistory?id=' . $patient_id);
            return;
        }
        $checkin_id=$this->patient_model->getCheckinId($patient_id);
        

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

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("patient/editMedicalHistory?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

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
            }
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'patient_id' => $patient_id,
                'checkin_id '=>$checkin_id,
                'date' => $date,
                'title' => $title,
                'description' => $description,
                'doctor_id' => $doctor_id,
                'department' => $department,
                'patient_name' => $patient_name,
                'patient_phone' => $patient_phone,
                'patient_address' => $patient_address
            );

            if (empty($id)) {     // Adding New history
                $id=$this->patient_model->insertMedicalHistory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating history
                $this->patient_model->updateMedicalHistory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }

            if ($this->ion_auth->in_group(array('Doctor'))) {
                $doctor_ion_id = $this->ion_auth->get_user_id();
                $doctor_id=$doctor_ion_id;
                $forms=$this->department_model->getDepartmentCaseForms($department);
                $count=1;
                $formNum=0;
                foreach ($forms as $form){
                    // print_r($form);
                    // echo "<br/><br/>";
                    $formname="form_".$formNum."_name";
                    $formid="form_".$formNum."_id";
                    $val=$this->input->post($formname);
                    $valId=$this->input->post($formid);
                    if($form->type == "group"){
                        $dId="f".$form->id;
                        $groups=$this->department_model->getDepartmentCaseForms($dId);
                        $gcount=0;
                        foreach($groups as $group){
                            $formname="form_".$formNum."_group_".$gcount."_name";
                            $formid="form_".$formNum."_group_".$gcount."_id";
                            $val=$this->input->post($formname);
                            $valId=$this->input->post($formid);
                            $g=$this->department_model->getDepartmentCaseFormByID($valId);
                            if($g->type=="date"){
                                if (!empty($val)) {
                                    $val = strtotime($val);
                                }
                            }else if($g->type=="image"){
                                $file_name = $_FILES[$formname]['name'];
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
                    
                                if ($this->upload->do_upload($formname)) {
                                    $path = $this->upload->data();
                                    $val = "uploads/" . $path['file_name'];
                                }
                            }
                            $data=array();
                            if($val==null){
                                $val="";
                            }
                            $data=array(
                                'history_id' => $id,
                                'form_id' => $valId,
                                'data' => $val
                            );
                            if(!empty($historyId)){
                                //update data
                                $g=$this->patient_model->updateMedicalHistoryForm($historyId,$valId,$data);
                            }else{
                                //add new record
                                $g=$this->patient_model->insertMedicalHistoryForm($data);
                            }
                            $gcount++;
                        }
                    }else{
                        if($form->type == "image"){

                            $file_name = $_FILES[$formname]['name'];
                            $file_name_pieces = explode('_', $file_name);
                            $new_file_name =  time().$file_name;
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
                
                            if ($this->upload->do_upload($formname)) {
                                $path = $this->upload->data();
                                $val = "uploads/" . $path['file_name'];
                            }

                        }
                        if($form->type=="date"){
                            if (!empty($val)) {
                                $val = strtotime($val);
                            }
                        }
                        $data=array();
                        if($val==null){
                            $val="";
                        }
                        $data=array(
                            'history_id' => $id,
                            'form_id' => $valId,
                            'data' => $val
                        );
                        
                            if(!empty($historyId)){
                                //update data
                                $g=$this->patient_model->updateMedicalHistoryForm($historyId,$valId,$data);
                            }else{
                                $g=$this->patient_model->insertMedicalHistoryForm($data);
                            }
                        
                    }
                    $formNum++;
                }
            }


            //working on the symptom
            $sCount=$this->input->post("sCount");
            for($i=0; $i<$sCount; $i++){
                $e=$i+1;
                $n="sym_".$e;
                $c="scon_".$e;
                $name=$this->input->post($n);
                $con=$this->input->post($c);
                $data=array();
                $data=array(
                    'history_id'=>$id,
                    'name'=>$name,
                    'level'=>$con
                );
                $this->patient_model->insertSymptom($data);
            }
            $redirect = "prescription/addPrescriptionView?cid=".$id;

            //working on the operation
            $this->load->model('home/home_model');
            // foreach( $operations as $operation){
            //     $opp=$this->home_model->getOperationById($operation);
            //     if($opp->id != null){
            //         $current_item = $this->finance_model->getPaymentCategoryByOperation($opp->id);
            //         if($patient_details->patient_type != "Private Patient") {
            //             $hmo_id=$patient_details->insurance_id;
            //             $hmo=$this->finance_model->getHMOCategoryPrice($hmo_id,$current_item->id);
            //             if($hmo != null){
            //                 $price=$hmo->price;
            //             }else{
            //                 $price=$current_item->c_price;
            //             }
                        
            //         }else{
            //             $price=$current_item->c_price;
            //         }
            //         $category_price = $price;
            //         $category_type = $current_item->type;
            //         $qty = 1;
            //         $key=$current_item->id;
            //         unset($cat_and_price);
            //         unset($category_name);
            //         $cat_and_price[] = $key . '*' . $category_price . '*' . $category_type . '*' . $qty;
            //         $category_name = implode(',', $cat_and_price);
            //         //add the bill 
            //         $data = array(
            //             'category_name' => $category_name,
            //             'patient' => $patient_id,
            //             'date' => time(),
            //             'amount' => $category_price,
            //             'doctor' => $doctor_id,
            //             'discount' => '0',
            //             'flat_discount' => '0',
            //             'gross_total' => $category_price,
            //             'status' => 'unpaid',
            //             'hospital_amount' => $category_price,
            //             'doctor_amount' => '0',
            //             'user' => $this->ion_auth->get_user_id(),
            //             'patient_name' => $patient_name,
            //             'patient_phone' => $patient_phone,
            //             'patient_address' => $patient_address,
            //             'doctor_name' => "",
            //             'date_string' => date('d-m-Y',time()),
            //             'remarks' => ""
            //         );
    
    
            //         $this->finance_model->insertPayment($data);
                    
            //         //send the patient


            //     }
            // }


            // Loading View
            redirect($redirect);
        }
    }

    //send operation
    function sendOperation(){
        $this->load->model('home/home_model');
        $patient_id=$this->input->post("pid");
        $operations=$this->input->post("operations");
        
        $patient_details = $this->patient_model->getPatientById($patient_id);
        $patient_name = $patient_details->name;
        $patient_phone = $patient_details->phone;
        $patient_address = $patient_details->address;
        $doctor_ion_id = $this->ion_auth->get_user_id();
        $doctor_id=$doctor_ion_id;
        $category_name=array();
        unset($category_name);

        foreach( $operations as $operation){
            $opp=$this->home_model->getOperationById($operation);
            if($opp->id != null){
                $current_item = $this->finance_model->getPaymentCategoryByOperation($opp->id);
                if($patient_details->patient_type != "Private Patient") {
                    $price=0;
                    
                }else{
                    $price=$current_item->c_price;
                }
                $category_price = $price;
                $category_type = $current_item->type;
                $qty = 1;
                $key=$current_item->id;
                unset($cat_and_price);
                $cat_and_price[] = $key . '*' . $category_price . '*' . $category_type . '*' . $qty;
                $category_name = implode(',', $cat_and_price);
                $Userid = $this->ion_auth->get_user_id();
                //add the bill 
                $data = array(
                    'category_name' => $category_name,
                    'patient' => $patient_id,
                    'date' => time(),
                    'amount' => $category_price,
                    'doctor' => $this->doctor_model->getDoctorByIonUserId($Userid)->id,
                    'discount' => '0',
                    'flat_discount' => '0',
                    'gross_total' => $category_price,
                    'status' => 'unpaid',
                    'hospital_amount' => $category_price,
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
                
                echo "ok";
                die();
            }
        }
    }

    //send operation
    function sendLabRequest(){
        $this->load->model('home/home_model');
        $patient_id=$this->input->post("pid");
        $tests=$this->input->post("tests");
        
        $patient_details = $this->patient_model->getPatientById($patient_id);
        $patient_name = $patient_details->name;
        $patient_phone = $patient_details->phone;
        $patient_address = $patient_details->address;
        $doctor_ion_id = $this->ion_auth->get_user_id();
        $doctor_id=$doctor_ion_id;
        $time=time();
        $amount=0;
        $category_name=array();
        foreach($tests as $test){
            //add each of the request to database
            $data=array();
            $Userid = $this->ion_auth->get_user_id();
            if($test==""){
                echo "Please reload the page";
                die();
            }
            $data=array(
                "hospital_id"=>$this->session->userdata('hospital_id'),
                "doctor"=>$this->doctor_model->getDoctorByIonUserId($Userid)->id,
                "patient_id"=>$patient_id,
                "test"=>$test,
                "status"=>"0",
                "date" => $time
            );
            $this->lab_model->insertTest($data);
            $lTest=$this->lab_model->getTestById($test);
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
            'patient' => $patient_id,
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
        echo "ok";
    }
    

    function sendRadRequest(){
        $patient_id=$this->input->post("pid");
        $scans=$this->input->post("scans");
        
        $patient_details = $this->patient_model->getPatientById($patient_id);
        $patient_name = $patient_details->name;
        $patient_phone = $patient_details->phone;
        $patient_address = $patient_details->address;
        $doctor_ion_id = $this->ion_auth->get_user_id();
        $doctor_id=$doctor_ion_id;
        $time=time();
        $amount=0;
        $category_name=array();
        

        foreach( $scans as $test){
            $data=array();
            $Userid = $this->ion_auth->get_user_id();
            if($test==""){
                echo "Please reload the page";
                die();
            }
            $data=array(
                "hospital_id"=>$this->session->userdata('hospital_id'),
                "doctor"=>$this->doctor_model->getDoctorByIonUserId($Userid)->id,
                "patient_id"=>$patient_id,
                "xray"=>$test,
                "status"=>"0",
                "date" => $time
            );
            $this->lab_model->insertRadTest($data);
            $lTest=$this->lab_model->getRadiologyById($test);
            //adding the price
            if($lTest != null){
                $current_item = $this->finance_model->getPaymentCategoryByOperation('radio'.$lTest->id);
                if($patient_details->patient_type != "Private Patient") {
                    $hmo_id=$patient_details->insurance_id;
                    $hmo=$this->finance_model->getHMOCategoryPrice($hmo_id,$current_item->id);
                    if($hmo != null){
                        $price=$hmo->price;
                    }else{
                        $price=$current_item->c_price;
                    }
                    $price=0;
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
            'patient' => $patient_id,
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
        echo "ok";
    }

    public function diagnosticReport() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        if ($this->ion_auth->in_group(array('Patient'))) {
            $current_user = $this->ion_auth->get_user_id();
            $patient_user_id = $this->patient_model->getPatientByIonUserId($current_user)->id;
            $data['payments'] = $this->finance_model->getPaymentByPatientId($patient_user_id);
        } else {
            $data['payments'] = $this->finance_model->getPayment();
        }

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('diagnostic_report', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function medicalHistory() { 
        $data = array();
        $id = $this->input->get('id');
        

        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
        }


        $patient_hospital_id = $this->patient_model->getPatientById($id)->hospital_id;
        if ($patient_hospital_id != $this->session->userdata('hospital_id')) {
            redirect('home/permission');
        }


        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['appointments'] = $this->appointment_model->getAppointmentByPatient($data['patient']->id);
        $data['patients'] = $this->patient_model->getPatient();
        $data['vitals'] = $this->patient_model->getAllVitalsById($id);
        $data['cvitals'] = $this->patient_model->getAllCVitalsById($id);
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['prescriptions'] = $this->prescription_model->getPrescriptionByPatientId($id);
        $data['labs'] = $this->lab_model->getLabByPatientId($id);
        $data['beds'] = $this->bed_model->getBedAllotmentsByPatientId($id);
        $data['vitalsGroup'] = $this->patient_model->getHospitalVitals();
        
        if (!$this->ion_auth->in_group(array('Patient'))) {
        $data['medical_histories'] = $this->patient_model->getMedicalHistoryByPatientId($id);
        }else{$data['medical_histories'] = array();}
        $data['patient_materials'] = $this->patient_model->getPatientMaterialByPatientId($id);



        foreach ($data['appointments'] as $appointment) {
            $doctor_details = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctor_details)) {
                $doctor_name = $doctor_details->name;
            } else {
                $doctor_name = '';
            }
            $timeline[$appointment->date + 1] = '<div class="panel-body profile-activity" >
                <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('appointment') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $appointment->date) . '</h5>
                                            <div class="activity terques">
                                                <span>
                                                    <i class="fa fa-stethoscope"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $appointment->date) . '</h4>
                                                            <p></p>
                                                            <i class=" fa fa-user-md"></i>
                                                                <h4>' . $doctor_name . '</h4>
                                                                    <p></p>
                                                                    <i class=" fa fa-clock-o"></i>
                                                                <p>' . $appointment->s_time . ' - ' . $appointment->e_time . '</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['prescriptions'] as $prescription) {
            $doctor_details = $this->doctor_model->getDoctorById($prescription->doctor);
            if (!empty($doctor_details)) {
                $doctor_name = $doctor_details->name;
            } else {
                $doctor_name = '';
            }
            $timeline[$prescription->date + 2] = '<div class="panel-body profile-activity" >
                                           <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('prescription') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $prescription->date) . '</h5>
                                            <div class="activity purple">
                                                <span>
                                                    <i class="fa fa-medkit"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $prescription->date) . '</h4>
                                                            <p></p>
                                                            <i class=" fa fa-user-md"></i>
                                                                <h4>' . $doctor_name . '</h4>
                                                                    <a class="btn btn-info btn-xs detailsbutton" title="View" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye"> View</i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['labs'] as $lab) {

            $doctor_details = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_details)) {
                $lab_doctor = $doctor_details->name;
            } else {
                $lab_doctor = '';
            }

            $timeline[$lab->date + 3] = '<div class="panel-body profile-activity" >
                                            <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('lab') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $lab->date) . '</h5>
                                            <div class="activity blue">
                                                <span>
                                                    <i class="fa fa-flask"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $lab->date) . '</h4>
                                                            <p></p>
                                                             <i class=" fa fa-user-md"></i>
                                                                <h4>' . $lab_doctor . '</h4>
                                                                    <a class="btn btn-xs invoicebutton" title="Lab" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file-text"></i>' . lang('report') . '</a>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['medical_histories'] as $medical_history) {
            $timeline[$medical_history->date + 4] = '<div class="panel-body profile-activity" >
                                            <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('case_history') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $medical_history->date) . '</h5>
                                            <div class="activity greenn">
                                                <span>
                                                    <i class="fa fa-file"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $medical_history->date) . '</h4>
                                                            <p></p>
                                                             <i class=" fa fa-note"></i> 
                                                                <p>' . $medical_history->description . '</p>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($data['patient_materials'] as $patient_material) {
            $timeline[$patient_material->date + 5] = '<div class="panel-body profile-activity" >
                                           <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('documents') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $patient_material->date) . '</h5>
                                            <div class="activity purplee">
                                                <span>
                                                    <i class="fa fa-file-o"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $patient_material->date) . ' <a class="pull-right" title="' . lang('download') . '"  href="' . $patient_material->url . '" download=""> <i class=" fa fa-download"></i> </a> </h4>
                                                                
                                                                 <h4>' . $patient_material->title . '</h4>
                                                            
                                                                
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }

        if (!empty($timeline)) {
            $data['timeline'] = $timeline;
        }
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('medical_history', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function getPatientBill(){
        $data=array();
        $id = $this->input->get('id');
        $patient=$this->patient_model->getPatientById($id);
        if($patient->patient_type == "Private Patient" || $patient->patient_type == "PRIVATE CLIENT"){
            if($this->finance_model->getPatientClear($patient->id)){
                echo json_encode($data);
                return;
            }
            //check for debt
            $debt=$this->patient_model->getDueBalanceByPatientId($patient->id);
            if($debt >0){
                $data['pay']="Please ask patient to clear the balance of N$debt with the accountant";
                echo json_encode($data);
                return;
            }
        }
        echo json_encode($data);
    }

    function editMedicalHistoryByJason() {
        $id = $this->input->get('id');
        $patient=$this->patient_model->getPatientById($id);
        if(!$this->patient_model->isPatientCheckedIn($patient->id)){
            $data['error']="Patient has not been checked in by the front desk";
            echo json_encode($data);
            return;
        }
        if($patient->patient_type == "Private Patient" || $patient->patient_type == "PRIVATE CLIENT"){
            //check for debt
            $debt=$this->patient_model->getDueBalanceByPatientId($patient->id);
            if(!$this->finance_model->getPatientClear($patient->id)){
                if($debt >0){
                    $data['pay']="Please ask patient to clear the balance of N$debt with the accountant";
                    echo json_encode($data);
                    return;
                }
            }
        }
        //check if patient is checkin
        $checkin_id=$this->patient_model->getCheckInId($patient->id);
        $doctor_ion_id=$this->ion_auth->get_user_id();
        $data['medical_history'] = $this->patient_model->getMedicalHistoryByCheckin($checkin_id,$doctor_ion_id);
        $data['patient'] = $this->patient_model->getPatientById($data['medical_history']->patient_id);
        
        $history_id=$data['medical_history']->id;
        if($data['medical_history']->department != ""){
            $doctor_ion_id=$data['medical_history']->doctor_id;
            $dept_id=$data['medical_history']->department;
            $data['forms']=$this->department_model->getDepartmentCaseForms($dept_id);
            $groups=array();
            $formData=array();
            // $formData= $this->patient_model->getMedicalHistoryForm($form_id,$history_id);
            
            foreach($data['forms'] as $form){
                if($form->type == "group"){
                    $dId="f".$form->id;
                    $groups[$form->id]=$this->department_model->getDepartmentCaseForms($dId);
                    foreach ($groups[$form->id] as $group){
                        $formData["fg".$group->id]=$this->patient_model->getMedicalHistoryForm($group->id,$history_id);
                    }
                }else{
                    $formData[$form->id]=$this->patient_model->getMedicalHistoryForm($form->id,$history_id);
                }
            }
            $data['formgroups']=$groups;
            $data['formData']=$formData;
        }
        echo json_encode($data);
    }

    function getCaseDetailsByJason() {
        $id = $this->input->get('id');
        $data['case'] = $this->patient_model->getMedicalHistoryById($id);
        $patient = $data['case']->patient_id;
        $data['patient'] = $this->patient_model->getPatientById($patient);
        $history_id=$data['case']->id;
        $data['doctor']="";
        if($data['case']->doctor_id != ""){
            $doctor_ion_id=$data['case']->doctor_id;
            $dept=$this->doctor_model->getDoctorByIonUserId($doctor_ion_id)->department;
            $doctor_name=$this->doctor_model->getDoctorByIonUserId($doctor_ion_id)->name;
            $dept_id=$this->department_model->getDepartmentByName($dept)->id;
            $data['forms']=$this->department_model->getDepartmentCaseForms($data['case']->department);
            $data['doctor']=$doctor_name;
            $groups=array();
            $formData=array();
            // $formData= $this->patient_model->getMedicalHistoryForm($form_id,$history_id);
            
            foreach($data['forms'] as $form){
                if($form->type == "group"){
                    $dId="f".$form->id;
                    $groups[$form->id]=$this->department_model->getDepartmentCaseForms($dId);
                    foreach ($groups[$form->id] as $group){
                        $formData["fg".$group->id]=$this->patient_model->getMedicalHistoryForm($group->id,$history_id);
                    }
                }else{
                    $formData[$form->id]=$this->patient_model->getMedicalHistoryForm($form->id,$history_id);
                }
            }
            $data['formgroups']=$groups;
            $data['formData']=$formData;
        }
        $data['symptoms']=$this->patient_model->getCaseSymptoms($history_id);
        echo json_encode($data);
    }

    function getPatientByAppointmentByDctorId($doctor_id) {
        $data = array();
        $appointments = $this->appointment_model->getAppointmentByDoctor($doctor_id);
        foreach ($appointments as $appointment) {
            $patient_exists = $this->patient_model->getPatientById($appointment->patient);
            if (!empty($patient_exists)) {
                $patients[] = $appointment->patient;
            }
        }

        if (!empty($patients)) {
            $patients = array_unique($patients);
        } else {
            $patients = '';
        }

        return $patients;
    }

    function patientMaterial() {
        $data = array();
        $id = $this->input->get('patient');
        $data['settings'] = $this->settings_model->getSettings();
        $data['patient'] = $this->patient_model->getPatientById($id);
        $data['patient_materials'] = $this->patient_model->getPatientMaterialByPatientId($id);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_material', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addPatientMaterial() {
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
        $date = time();
        $redirect = $this->input->post('redirect');

        if ($this->ion_auth->in_group(array('Patient'))) {
            if (empty($patient_id)) {
                $current_patient = $this->ion_auth->get_user_id();
                $patient_id = $this->patient_model->getPatientByIonUserId($current_patient)->id;
            }
        }


        if (empty($redirect)) {
            $redirect = "patient/medicalHistory?id=" . $patient_id;
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('feedback', lang('validation_error'));
            redirect($redirect);
        } else {

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






            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
	    $new_file_name=time().$new_file_name;
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "0", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "0",
                'max_width' => "0"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'url' => $img_url,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
		$this->patient_model->insertPatientMaterial($data);
            	$this->session->set_flashdata('feedback', lang('added'));
            } else {
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
                $this->session->set_flashdata('feedback', $this->upload->display_errors('<p>', '</p>'));
            }



            redirect($redirect);
        }
    }

    function deleteCaseHistory() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $case_history = $this->patient_model->getMedicalHistoryById($id);
        $this->patient_model->deleteMedicalHistory($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        if ($redirect == 'case') {
            redirect('patient/caseList');
        } else {
            redirect("patient/MedicalHistory?id=" . $case_history->patient_id);
        }
    }

    function deletePatientMaterial() {
        $id = $this->input->get('id');
        $redirect = $this->input->get('redirect');
        $patient_material = $this->patient_model->getPatientMaterialById($id);
        $path = $patient_material->url;
        if (!empty($path)) {
            unlink($path);
        }
        $this->patient_model->deletePatientMaterial($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        if ($redirect == 'documents') {
            redirect('patient/documents');
        } else {
            redirect("patient/MedicalHistory?id=" . $patient_material->patient);
        }
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');

        $patient_hospital_id = $this->patient_model->getPatientById($id)->hospital_id;
        if ($patient_hospital_id != $this->session->userdata('hospital_id')) {
            redirect('home/permission');
        }

        $user_data = $this->db->get_where('patient', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->patient_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('patient');
    }

    function getSymptom() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getSymptomBysearch($search);
            } else {
                $data['patients'] = $this->patient_model->getSymptom();
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getSymptomByLimitBySearch($limit, $start, $search);
            } else {
                $data['patients'] = $this->patient_model->getSymptomByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['patients'] as $symptom) {

            $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $symptom->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" data-id="' . $symptom->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            if ($this->ion_auth->in_group(array('admin','Doctor'))) {
                $info[] = array(
                    $symptom->id,
                    $symptom->name,
                    $symptom->description,
                    // $this->settings_model->getSettings()->currency . $this->patient_model->getDueBalanceByPatientId($patient->id),
                    $options1 . ' ' . $options2,
                        //  $options2
                );
            }
        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('symptom')->num_rows(),
                "recordsFiltered" => $this->db->get('symptom')->num_rows(),
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

    function today(){
        $data=array();
        if (!$this->ion_auth->in_group(array('admin', 'Accountant'))) {
            redirect('home/permission');
        }
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('today', $data);
        $this->load->view('home/footer'); // just the header file
    }
    

    function getPatient() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $check=false;
        // $start=0;
        // $limit=100;
        // $search;
        if( $this->input->get('checkin')=="1234"){
            $check=true;
        }

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getGeneralPatientBysearch($search);
            } else {
                $data['patients'] = $this->patient_model->getGeneralPatient();
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getGeneralPatientByLimitBySearch($limit, $start, $search);
            } else {
                $data['patients'] = $this->patient_model->getGeneralPatientByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['patients'] as $patient) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor','Record_Officer'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="patient/patientDetails?id=' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="patient/medicalHistory?id=' . $patient->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';

            $options4 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/patientPaymentHistory?patient=' . $patient->id . '"><i class="fa fa-money-bill-alt"></i> ' . lang('payment') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="patient/delete?id=' . $patient->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }
            if ($this->ion_auth->in_group(array('Receptionist','Record_Officer','admin'))) {
                $options4 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="patient/patientHistory?id=' . $patient->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';                
            }
            

            $options6 = ' <a type="button" class="btn detailsbutton inffo" title="' . lang('info') . '" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-info"> </i> ' . lang('info') . '</a>';


            if ($this->ion_auth->in_group('Doctor')) {
                $options7 = '<a class="btn green detailsbutton" title="' . lang('instant_meeting') . '" style="color: #fff;" href="meeting/instantLive?id=' . $patient->id . '" onclick="return confirm(\'Are you sure you want to start a live meeting with this patient? SMS and Email will be sent to the Patient.\');"><i class="fa fa-headphones"></i> ' . lang('start_live') . '</a>';
            } else {
                $options7 = '';
            }
            if ($this->ion_auth->in_group(array('Nurse', 'Receptionist','admin','Record_Officer'))) {
                $options8 = '<a class="btn checkout" style="background-color:#b10101; color:#fff"  data-id="' . $patient->id . '" title="Check out"> <i class="fa fa-user"></i> Check Out </a>';
                if(!$this->patient_model->isPatientCheckedIn($patient->id)){
                    $options8 = '<a class="btn checkin" style="background-color:#eedede"  data-id="' . $patient->id . '" title="Check in"> <i class="fa fa-user"></i> Check In </a>';
                    
                }
            }else{
                $options8='';
            }
            if ($this->ion_auth->in_group(array('Nurse'))) {
                $options9 = '<a class="btn consult" style="background-color:#fff033; color:#000"  data-id="' . $patient->id . '" title="Send for consultation"> <i class="fa fa-user"></i> Consult </a>';
                
            }else{
                $options9='';
            }
            if ($this->ion_auth->in_group(array('Nurse','Doctor','admin'))) {
                $options10 = '<a class="btn" style="background-color:#264336; color:#fff"  href="patient/bedside?id=' . $patient->id . '" title="Bedside Notes"> <i class="fa fa-note"></i> Bedside Notes </a>';
                $options11 = '<a class="btn" style="background-color:#122599; color:#fff"  href="patient/allergies?id=' . $patient->id . '" title="Allergies"> <i class="fa fa-note"></i> Allergies</a>';
            }else{
                $options10='';
                $options11='';
            }

            if(!$this->patient_model->isPatientCheckedIn($patient->id)){
                if($check){
                    continue;
                }
            }

            $p_type=array("Private Patient","BHIS","PRIVATE CLIENT");
            if(!in_array($patient->patient_type,$p_type)){
                $insurance=$this->finance_model->getSponsorById($patient->insurance_sponsor)->name;
                // $insurance="HMO Patient";
            }else{
                $insurance=$patient->patient_type;
            }


            if ($this->ion_auth->in_group(array('admin'))) {
                $info[] = array(
                    $patient->id,
                    $patient->name,
                    $patient->phone,
                    $insurance,
                    $this->settings_model->getSettings()->currency . $this->patient_model->getDueBalanceByPatientId($patient->id),
                    $options1 . ' ' . $options6 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5. ' ' . $options2
                    . ' ' . $options8. ' ' . $options7. ' ' . $options9. ' ' . $options10. ' ' . $options11,
                        //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Accountant', 'Receptionist','Record_Officer'))) {
                $info[] = array(
                    $patient->id,
                    $patient->name,
                    $patient->phone,
                    $insurance,
                    $this->settings_model->getSettings()->currency . $this->patient_model->getDueBalanceByPatientId($patient->id),
                    $options1 . ' ' . $options6 . ' ' . $options4. ' ' .$options8,
                        //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Laboratorist', 'Nurse', 'Doctor'))) {
                $info[] = array(
                    $patient->id,
                    $patient->name,
                    $patient->phone,
                    $insurance,
                    $options1 . ' ' . $options6 . ' ' . $options3. ' ' .$options8.' ' .$options9.' ' .$options10
                    .' ' .$options11,
                    //  $options2
                );
            }
        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient')->num_rows(),
                "recordsFiltered" => $this->db->get('patient')->num_rows(),
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

    function getToday() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getTodayPatientBysearch($search);
            } else {
                $data['patients'] = $this->patient_model->getTodayPatient();
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getTodayPatientByLimitBySearch($limit, $start, $search);
            } else {
                $data['patients'] = $this->patient_model->getTodayPatientByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['patients'] as $patient) {
            $options4 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/patientPaymentHistory?patient=' . $patient->id . '"><i class="fa fa-money-bill-alt"></i> ' . lang('payment') . '</a>';

                $info[] = array(
                    $patient->id,
                    $patient->name,
                    $patient->phone,
                    $this->settings_model->getSettings()->currency . $this->patient_model->getDueBalanceByPatientId($patient->id),
                    "insurance",
                    $options4 . ' ',
                );
        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient')->num_rows(),
                "recordsFiltered" => $this->db->get('patient')->num_rows(),
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

    function getWalkinPatient() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $check=false;
        if( $this->input->get('checkin')=="1234"){
            $check=true;
        }

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getWalkinPatientBysearch($search);
            } else {
                $data['patients'] = $this->patient_model->getWalkinPatient();
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getWalkinPatientByLimitBySearch($limit, $start, $search);
            } else {
                $data['patients'] = $this->patient_model->getWalkinPatientByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['patients'] as $patient) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor','Record_Officer'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="patient/patientDetails?id=' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="patient/medicalHistory?id=' . $patient->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';

            $options4 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/patientPaymentHistory?patient=' . $patient->id . '"><i class="fa fa-money-bill-alt"></i> ' . lang('payment') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="patient/delete?id=' . $patient->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }
            if ($this->ion_auth->in_group(array('Receptionist','Record_Officer','admin'))) {
                $options4 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="patient/patientHistory?id=' . $patient->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';                
            }
            

            $options6 = ' <a type="button" class="btn detailsbutton inffo" title="' . lang('info') . '" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-info"> </i> ' . lang('info') . '</a>';


            if ($this->ion_auth->in_group('Doctor')) {
                $options7 = '<a class="btn green detailsbutton" title="' . lang('instant_meeting') . '" style="color: #fff;" href="meeting/instantLive?id=' . $patient->id . '" onclick="return confirm(\'Are you sure you want to start a live meeting with this patient? SMS and Email will be sent to the Patient.\');"><i class="fa fa-headphones"></i> ' . lang('start_live') . '</a>';
            } else {
                $options7 = '';
            }
            if ($this->ion_auth->in_group(array('Nurse', 'Receptionist','admin','Record_Officer'))) {
                $options8 = '<a class="btn checkout" style="background-color:#b10101; color:#fff"  data-id="' . $patient->id . '" title="Check out"> <i class="fa fa-user"></i> Check Out </a>';
                if(!$this->patient_model->isPatientCheckedIn($patient->id)){
                    $options8 = '<a class="btn checkin" style="background-color:#eedede"  data-id="' . $patient->id . '" title="Check in"> <i class="fa fa-user"></i> Check In </a>';
                    
                }
            }else{
                $options8='';
            }
            if ($this->ion_auth->in_group(array('Nurse'))) {
                $options9 = '<a class="btn consult" style="background-color:#fff033; color:#000"  data-id="' . $patient->id . '" title="Send for consultation"> <i class="fa fa-user"></i> Consult </a>';
                
            }else{
                $options9='';
            }
            if ($this->ion_auth->in_group(array('Nurse','Doctor','admin'))) {
                $options10 = '<a class="btn" style="background-color:#264336; color:#fff"  href="patient/bedside?id=' . $patient->id . '" title="Bedside Notes"> <i class="fa fa-note"></i> Bedside Notes </a>';
                $options11 = '<a class="btn" style="background-color:#122599; color:#fff"  href="patient/allergies?id=' . $patient->id . '" title="Allergies"> <i class="fa fa-note"></i> Allergies</a>';
            }else{
                $options10='';
                $options11='';
            }

            if(!$this->patient_model->isPatientCheckedIn($patient->id)){
                if($check){
                    continue;
                }
            }


            if ($this->ion_auth->in_group(array('admin'))) {
                $info[] = array(
                    $patient->id,
                    $patient->name,
                    $patient->phone,
                    "insurance",
                    $this->settings_model->getSettings()->currency . $this->patient_model->getDueBalanceByPatientId($patient->id),
                    $options1 . ' ' . $options6 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5. ' ' . $options2
                    . ' ' . $options8. ' ' . $options7. ' ' . $options9. ' ' . $options10. ' ' . $options11,
                        //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Accountant', 'Receptionist','Record_Officer'))) {
                $info[] = array(
                    $patient->id,
                    $patient->name,
                    $patient->phone,
                    "insurance",
                    $this->settings_model->getSettings()->currency . $this->patient_model->getDueBalanceByPatientId($patient->id),
                    $options1 . ' ' . $options6 . ' ' . $options4. ' ' .$options8,
                        //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Laboratorist', 'Nurse', 'Doctor'))) {
                $info[] = array(
                    $patient->id,
                    $patient->name,
                    $patient->phone,
                    "insurance",
                    $options1 . ' ' . $options6 . ' ' . $options3. ' ' .$options8.' ' .$options9.' ' .$options10
                    .' ' .$options11,
                    //  $options2
                );
            }
        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient')->num_rows(),
                "recordsFiltered" => $this->db->get('patient')->num_rows(),
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

    function allergies(){
        if (!$this->ion_auth->in_group(array('Nurse','Doctor'))) {
            redirect('home/permission');
        }
        $patient_id=$this->input->get("id");
        $data['bedside'] = $this->patient_model->getPatientById($patient_id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('allergies', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function patientHistory(){
        if (!$this->ion_auth->in_group(array('Doctor','Record_Officer','Receptionist','admin'))) {
            redirect("home/permission");
        }
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('patient_history', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function mergeFolder(){
        if (!$this->ion_auth->in_group(array('Receptionist','admin'))) {
            redirect("home/permission");
        }
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('merge_folder', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function checkinPatient(){
        $id=$this->input->get("id");
        $data=array();
        if($this->patient_model->isPatientCheckedIn($id) ){
            $data["res"]="true";
            echo json_encode($data);
        }else{
            $Userid = $this->ion_auth->get_user_id(); //Receptionist
            if ($this->ion_auth->in_group(array('Receptionist'))) {
                $vitals_adder="R".$Userid;
            }else if($this->ion_auth->in_group(array('Nurse'))){
                $vitals_adder="N".$Userid;
            }else if($this->ion_auth->in_group(array('admin'))){
                $vitals_adder=$Userid;
            }else{
                redirect('home/permission');
            }
            $patient=$this->patient_model->getPatientById($id);
            $data = array(
                'checked_in_by'=>$vitals_adder,
                'patient_id' =>$id,
                'date'=>time()
            );
            $data2=array(
                "patient" =>$id,
                "name"=>$patient->name,
                "phone" =>$patient->phone,
                "date" =>time()
            );
            $this->patient_model->checkinPatient($data,$data2);
            $data["res"]="true";
            echo json_encode($data);
        }
    }

    function bedside(){
        if (!$this->ion_auth->in_group(array('Nurse','Doctor'))) {
            redirect('home/permission');
        }
        $patient_id=$this->input->get("id");
        $data['bedside'] = $this->patient_model->getPatientById($patient_id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('bedside', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function addNote(){
        if (!$this->ion_auth->in_group(array('Nurse','Doctor'))) {
            redirect('home/permission');
        }
        $patient_id=$this->input->post("p_id");
        $date=$this->input->post("date");
        $time=$this->input->post("time");
        $pulse=$this->input->post("pulse");
        $res=$this->input->post("respiration");
        $fhr=$this->input->post("fhr");
        $rbs=$this->input->post("rbs");
        $note=$this->input->post("note");
        $sCount=$this->input->post("medCount");
        $bp=$this->input->post("bp");
        $now=time();
        $Userid = $this->ion_auth->get_user_id(); //Receptionist
        if($this->ion_auth->in_group(array('Nurse'))){
            $taken_by="N".$Userid;
        }else if($this->ion_auth->in_group(array('Doctor'))){
            $taken_by="D".$Userid;
        }else{
            redirect('home/permission');
        }

        if (!empty($date)) {
            $date = strtotime($date);
        } else {
            $date = time();
        }
        

        $data=array();
        $data=array(
            'date'=>$date,
            'time'=>$time,
            'patient_id'=>$patient_id,
            'pulse'=>$pulse,
            'respiration'=>$res,
            'bp'=>$bp,
            'fhr'=>$fhr,
            'rbs'=>$rbs,
            'note'=>$note,
            'taken_by'=>$taken_by,
            'record_date'=>$now
        );

        $note_id=$this->patient_model->insertNote($data);

        //insert the medication
        for($i=0; $i<$sCount; $i++){
            $e=$i+1;
            $n="med_".$e;
            $c="dose_".$e;
            $med=$this->input->post($n);
            $dose=$this->input->post($c);
            $data=array();
            $data=array(
                'note_id'=>$note_id,
                'medicine'=>$med,
                'dosage'=>$dose
            );
            $this->patient_model->insertNoteMed($data);
        }
        $this->session->set_flashdata('feedback', lang('Added'));
        redirect('patient/bedside?id='.$patient_id);
    }

    public function getNurseInfo() {
        // Search term
        $searchTerm = $this->input->get('searchTerm');
        
        // Get users
        $response = $this->nurse_model->getNurseInfo($searchTerm);

        echo json_encode($response);
    }

    function checkOutPatient(){
        $id=$this->input->get("id");
        $data=array();
        if($this->patient_model->isPatientCheckedIn($id) ){
            $Userid = $this->ion_auth->get_user_id(); //Receptionist
            if ($this->ion_auth->in_group(array('Pharmacist'))) {
                $vitals_adder="P".$Userid;
            }else if($this->ion_auth->in_group(array('Nurse'))){
                $vitals_adder="N".$Userid;
            }else if($this->ion_auth->in_group(array('Accountant'))){
                $vitals_adder="A".$Userid;
            }else if($this->ion_auth->in_group(array('Receptionist'))){
                $vitals_adder="R".$Userid;
            }else if($this->ion_auth->in_group(array('admin'))){
                $vitals_adder=$Userid;
            }else{
                redirect('home/permission');
            }
            $data = array(
                'check_out_by'=>$vitals_adder,
                'check_in_id' =>$this->patient_model->getCheckInId($id),
                'date'=>time()
            );
            $this->patient_model->checkoutPatient($data, $id);
            $data["res"]="true";
            echo json_encode($data);
        }else{
            $data["res"]="true";
            echo json_encode($data);
        }
    }

    function getPatientPayments() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientBysearch($search);
            } else {
                $data['patients'] = $this->patient_model->getPatient();
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientByLimitBySearch($limit, $start, $search);
            } else {
                $data['patients'] = $this->patient_model->getPatientByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['patients'] as $patient) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="patient/patientDetails?id=' . $patient->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="patient/medicalHistory?id=' . $patient->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';

            $options4 = '<a class="btn btn-xs green" title="' . lang('payment') . ' ' . lang('history') . '" style="color: #fff;" href="finance/patientPaymentHistory?patient=' . $patient->id . '"><i class="fa fa-money-bill-alt"></i> ' . lang('payment') . ' ' . lang('history') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="patient/delete?id=' . $patient->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }

            $due = $this->settings_model->getSettings()->currency . $this->patient_model->getDueBalanceByPatientId($patient->id);

            $info[] = array(
                $patient->id,
                $patient->name,
                $patient->phone,
                $due,
                //  $options1 . ' ' . $options2 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5,
                $options4
            );
        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient')->num_rows(),
                "recordsFiltered" => $this->db->get('patient')->num_rows(),
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

    function getPatientByVitals() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientBysearch($search);
            } else {
                $data['patients'] = $this->patient_model->getPatient();
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientByLimitBySearch($limit, $start, $search);
            } else {
                $data['patients'] = $this->patient_model->getPatientByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['patients'] as $patient) {
            $p=$patient->id;
            $options1 = ' <a type="button" class="btn editbutton" title="Add new patient vitals" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-edit"> </i> Add</a>';
            
            

            $options2 = '<a class="btn inffo" title="View patient vitals" style="color: #fff; background-color:#112233" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-info"></i>  View </a>';



                $info[] = array(
                    $patient->id,
                    $patient->name,
                    $patient->phone,
                   $options1 . ' ' . $options2 ,
                        //  $options2
                );

        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient')->num_rows(),
                "recordsFiltered" => $this->db->get('patient')->num_rows(),
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


    function getPatientBedside() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $patient_id=$this->input->post('patient_id');
        

        if ($limit == -1) {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientNoteBySearch($patient_id,$search);
            } else {
                $data['patients'] = $this->patient_model->getPatientNote($patient_id);
            }
        } else {
            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getPatientNoteByLimitBySearch($patient_id,$limit, $start, $search);
            } else {
                $data['patients'] = $this->patient_model->getPatientNoteByLimit($patient_id,$limit, $start);
            }
        }
        
        $sn=1;
        foreach ($data['patients'] as $patient) {
            $p=$patient->id;
            $options1 = ' <a type="button" class="btn editbutton" title="Edit Note" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-edit"> </i> Edit</a>';
            
            

            $options2 = '<a class="btn inffo" title="View Note" style="color: #fff; background-color:#112233" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-info"></i>  View </a>';


                $info[] = array(
                    $sn,
                    date("d-M-Y",$patient->date),
                    $patient->time,
                    $this->patient_model->vitalsBy($patient->taken_by),
                   $options2 ,
                        //  $options2
                );
                $sn++;

        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient')->num_rows(),
                "recordsFiltered" => $this->db->get('patient')->num_rows(),
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




    function getConsultations() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $id=$this->ion_auth->get_user_id();
        $doctor=$this->doctor_model->getDoctorByIonUserId($id);
        $doctor_id=$doctor->id;

            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getConsultationBySearch($doctor_id,$search);
            } else {
                $data['patients'] = $this->patient_model->getConsultation($doctor_id);
            }

            
        
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['patients'] as $consult) {
            $p_id=$consult->patient_id;
            $patient=$this->patient_model->getPatientById($p_id);
            // echo $patient['name'];
            // print_r($patient);
            // die();
            $options1 = ' <a class="btn editbutton" title="Add Case" href="patient/caseManager?consult=' . $patient->id . '"><i class="fa fa-edit"> </i> Add Case</a>';
            
            

            $options2 = '<a class="btn inffo" title="View patient vitals" style="color: #fff; background-color:#112233" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-info"></i>  View </a>';



                $info[] = array(
                    date("d M Y",$consult->date),
                    $patient->name,
                    $patient->phone,
                    $this->patient_model->vitalsBy($consult->sent_by),
                    $options1
                //    $options1 . ' ' . $options2 ,
                        //  $options2
                );

        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
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




    function getVitalsAppointment() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $id=$this->ion_auth->get_user_id();
        $nurse=$this->nurse_model->getNurseByIonUserId($id);
        $nurse_id=$nurse->id;

            if (!empty($search)) {
                $data['patients'] = $this->patient_model->getVitalsAppointmentBySearch($nurse_id,$search);
            } else {
                $data['patients'] = $this->patient_model->getAppointment($nurse_id);
            }

            

        foreach ($data['patients'] as $consult) {
            $p_id=$consult->patient_id;
            $patient=$this->patient_model->getPatientById($p_id);
            // echo $patient['name'];
            // print_r($patient);
            // die();
            $options1 = ' <a class="btn editbutton" title="Add Vital" data-id="' . $patient->id . '"><i class="fa fa-heartbeat"> </i> Add Case</a>';
            
            

            $options2 = '<a class="btn inffo" title="View patient vitals" style="color: #fff; background-color:#112233" data-toggle = "modal" data-id="' . $patient->id . '"><i class="fa fa-info"></i>  View </a>';



                $info[] = array(
                    date("d M Y",$consult->date),
                    $patient->name,
                    $patient->phone,
                    $this->patient_model->vitalsBy($consult->sent_by),
                    $options1
                //    $options1 . ' ' . $options2 ,
                        //  $options2
                );

        }

        if (!empty($data['patients'])) {
            $output = array(
                "draw" => 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
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



    function getCaseList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['cases'] = $this->patient_model->getMedicalHistoryBySearch($search);
            } else {
                $data['cases'] = $this->patient_model->getMedicalHistory();
            }
        } else {
            if (!empty($search)) {
                $data['cases'] = $this->patient_model->getMedicalHistoryByLimitBySearch($limit, $start, $search);
            } else {
                $data['cases'] = $this->patient_model->getMedicalHistoryByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['cases'] as $case) {

            if ($this->ion_auth->in_group(array('admin'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options2 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="patient/deleteCaseHistory?id=' . $case->id . '&redirect=case" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i></a>';
                $options1 = ' <a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $case->id . '"><i class="fa fa-edit"> </i> </a>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options3 = ' <a type="button" class="btn btn-info btn-xs btn_width detailsbutton case" title="' . lang('case') . '" data-toggle = "modal" data-id="' . $case->id . '"><i class="fa fa-file"> </i> </a>';
            }

            if (!empty($case->patient_id)) {
                $patient_info = $this->patient_model->getPatientById($case->patient_id);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = $case->patient_name . '</br>' . $case->patient_address . '</br>' . $case->patient_phone . '</br>';
                }
            } else {
                $patient_details = '';
            }

            $info[] = array(
                date('d-m-Y', $case->date),
                $patient_details,
                $case->title,
                $options3 . ' ' . $options1 . ' ' . $options2
                    // $options4
            );
        }

        if (!empty($data['cases'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('medical_history')->num_rows(),
                "recordsFiltered" => $this->db->get('medical_history')->num_rows(),
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

    function getPatientCaseList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $p_id=$this->input->post('id');
        

        if ($limit == -1) {
            if (!empty($search)) {
                $data['cases'] = $this->patient_model->getPatientMedicalHistoryBySearch($p_id,$search);
            } else {
                $data['cases'] = $this->patient_model->getPatientMedicalHistory($p_id);
            }
        } else {
            if (!empty($search)) {
                $data['cases'] = $this->patient_model->getPatientMedicalHistoryByLimitBySearch($p_id,$limit, $start, $search);
            } else {
                $data['cases'] = $this->patient_model->getPatientMedicalHistoryByLimit($p_id,$limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['cases'] as $case) {

            if ($this->ion_auth->in_group(array('admin'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options2 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="patient/deleteCaseHistory?id=' . $case->id . '&redirect=case" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i></a>';
                $options1 = ' <a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $case->id . '"><i class="fa fa-edit"> </i> </a>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor','Record_Officer'))) {
                $options3 = ' <a type="button" class="btn btn-info btn-xs btn_width detailsbutton case" title="' . lang('case') . '" data-toggle = "modal" data-id="' . $case->id . '"><i class="fa fa-file"> </i> </a>';
            }

            if (!empty($case->patient_id)) {
                $patient_info = $this->patient_model->getPatientById($case->patient_id);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = $case->patient_name . '</br>' . $case->patient_address . '</br>' . $case->patient_phone . '</br>';
                }
            } else {
                $patient_details = '';
            }

            $info[] = array(
                // $p_id,
                date('d-m-Y', $case->date),
                $patient_details,
                $case->title,
                $options3 . ' ' . $options1 . ' ' . $options2
                    // $options4
            );
        }

        if (!empty($data['cases'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('medical_history')->num_rows(),
                "recordsFiltered" => $this->db->get('medical_history')->num_rows(),
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

    

    function inPatient() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['beds'] = $this->bed_model->getBed();
        $data['patients'] = $this->patient_model->getPatient();
        $data['alloted_beds'] = $this->bed_model->getAllotment();

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('inpatient', $data);
        $this->load->view('home/footer'); // just 
    }

    function getInPatient() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['beds'] = $this->patient_model->getBedAllotmentBysearch($search);
            } else {
                $data['beds'] = $this->patient_model->getAllotment();
            }
        } else {
            if (!empty($search)) {
                $data['beds'] = $this->patient_model->getBedAllotmentByLimitBySearch($limit, $start, $search);
            } else {
                $data['beds'] = $this->patient_model->getBedAllotmentByLimit($limit, $start);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        foreach ($data['beds'] as $bed) {
            $i = $i + 1;

            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $bed->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="bed/deleteAllotment?id=' . $bed->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';

            $patientdetails = $this->patient_model->getPatientById($bed->patient);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
            } else {
                $patientname = $bed->patientname;
            }

            $info[] = array(
                $bed->bed_id,
                $patientname,
                $bed->a_time,
                $bed->d_time,
                time()
            );
        }

        if (!empty($data['beds'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->patient_model->getAllotment()),
                "recordsFiltered" => count($this->patient_model->getAllotment()),
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

    function getDocuments() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['documents'] = $this->patient_model->getDocumentBySearch($search);
            } else {
                $data['documents'] = $this->patient_model->getPatientMaterial();
            }
        } else {
            if (!empty($search)) {
                $data['documents'] = $this->patient_model->getDocumentByLimitBySearch($limit, $start, $search);
            } else {
                $data['documents'] = $this->patient_model->getDocumentByLimit($limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['documents'] as $document) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = '<a class="btn btn-info btn-xs" href="' . $document->url . '" download> ' . lang('download') . ' </a>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Doctor'))) {
                $options2 = '<a class="btn btn-info btn-xs delete_button" href="patient/deletePatientMaterial?id=' . $document->id . '&redirect=documents"onclick="return confirm(\'You want to delete the item??\');"> X </a>';
            }

            if (!empty($document->patient)) {
                $patient_info = $this->patient_model->getPatientById($document->patient);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = $document->patient_name . '</br>' . $document->patient_address . '</br>' . $document->patient_phone . '</br>';
                }
            } else {
                $patient_details = '';
            }

            $info[] = array(
                date('d-m-y', $document->date),
                $patient_details,
                $document->title,
                '<a class="example-image-link" href="' . $document->url . '" data-lightbox="example-1" data-title="' . $document->title . '">' . '<img class="example-image" src="' . $document->url . '" width="100px" height="100px"alt="image-1">' . '</a>',
                $options1 . ' ' . $options2
                    // $options4
            );
        }

        if (!empty($data['documents'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient_material')->num_rows(),
                "recordsFiltered" => $this->db->get('patient_material')->num_rows(),
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

    

    function getPatientDocuments() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $id=$this->input->post("id");

        if ($limit == -1) {
            if (!empty($search)) {
                $data['documents'] = $this->patient_model->getOnePatientMaterialBySearch($id, $search);
            } else {
                $data['documents'] = $this->patient_model->getPagetOnePatientMaterialtientMaterial($id);
            }
        } else {
            if (!empty($search)) {
                $data['documents'] = $this->patient_model->getOnePatientMaterialByLimitBySearch($id,$limit, $start, $search);
            } else {
                $data['documents'] = $this->patient_model->getOnePatientMaterialByLimit($id, $limit, $start);
            }
        }
        //  $data['patients'] = $this->patient_model->getPatient();

        foreach ($data['documents'] as $document) {
            
            $options1="";
            $options2="";

            if (!empty($document->patient)) {
                $patient_info = $this->patient_model->getPatientById($document->patient);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = $document->patient_name . '</br>' . $document->patient_address . '</br>' . $document->patient_phone . '</br>';
                }
            } else {
                $patient_details = '';
            }
            $url=$document->url;
            if(substr($url,-3) =="pdf"){
                $opt="<span style='cursor:pointer; padding:5px 8px;color:white; background:#01acff' onclick='readpdf(\"$url\")'>View</span>";
            }else{
                $opt="<span style='cursor:pointer; padding:5px 8px;color:white; background:#01acff' onclick='readimg(\"$url\")'>View</span>";
            }

            $info[] = array(
                date('d-m-y', $document->date),
                $patient_details,
                $document->title,
                $opt,
                // '<a class="example-image-link" href="' . $document->url . '" data-lightbox="example-1" data-title="' . $document->title . '">' . '<img class="example-image" src="' . $document->url . '" width="100px" height="100px"alt="image-1">' . '</a>',
                $options1 . ' ' . $options2
                    // $options4
            );
        }

        if (!empty($data['documents'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('patient_material')->num_rows(),
                "recordsFiltered" => $this->db->get('patient_material')->num_rows(),
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

    function getMedicalHistoryByJason() {
        $data = array();

        $from_where = $this->input->get('from_where');
        $id = $this->input->get('id');

        if (!empty($from_where)) {
            $this->db->where('id', $id);
            $id = $this->db->get('appointment')->row()->patient;
        }


        if ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $id = $this->patient_model->getPatientByIonUserId($patient_ion_id)->id;
        }

        $patient = $this->patient_model->getPatientById($id);
        $appointments = $this->appointment_model->getAppointmentByPatient($patient->id);
        $patients = $this->patient_model->getPatient();
        $doctors = $this->doctor_model->getDoctor();
        $data['prescriptions'] = $this->prescription_model->getPrescriptionByPatientId($id);
        $beds = $this->bed_model->getBedAllotmentsByPatientId($id);
        //  $orders = $this->order_model->getOrderByPatientId($id);
        $labs = $this->lab_model->getLabByPatientId($id);
        $medical_histories = $this->patient_model->getMedicalHistoryByPatientId($id);
        $patient_materials = $this->patient_model->getPatientMaterialByPatientId($id);



        foreach ($appointments as $appointment) {

            $doctor_details = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctor_details)) {
                $doctor_name = $doctor_details->name;
            } else {
                $doctor_name = '';
            }

            $timeline[$appointment->date + 1] = '<div class="panel-body profile-activity" >
                <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('appointment') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $appointment->date) . '</h5>
                                            <div class="activity terques">
                                                <span>
                                                    <i class="fa fa-stethoscope"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $appointment->date) . '</h4>
                                                            <p></p>
                                                            <i class=" fa fa-user-md"></i>
                                                                <h4>' . $doctor_name . '</h4>
                                                                    <p></p>
                                                                    <i class=" fa fa-clock-o"></i>
                                                                <p>' . $appointment->s_time . ' - ' . $appointment->e_time . '</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }


        foreach ($data['prescriptions'] as $prescription) {
            $doctor_details = $this->doctor_model->getDoctorById($prescription->doctor);
            if (!empty($doctor_details)) {
                $doctor_name = $doctor_details->name;
            } else {
                $doctor_name = '';
            }
            $timeline[$prescription->date + 6] = '<div class="panel-body profile-activity" >
                                           <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('prescription') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $prescription->date) . '</h5>
                                            <div class="activity purple">
                                                <span>
                                                    <i class="fa fa-medkit"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $prescription->date) . '</h4>
                                                            <p></p>
                                                            <i class=" fa fa-user-md"></i>
                                                                <h4>' . $doctor_name . '</h4>
                                                                    <a class="btn btn-info btn-xs detailsbutton" title="View" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye"> View</i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
        }
        foreach ($labs as $lab) {

            $doctor_details = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_details)) {
                $lab_doctor = $doctor_details->name;
            } else {
                $lab_doctor = '';
            }

            $timeline[$lab->date + 3] = '<div class="panel-body profile-activity" >
                                            <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('lab') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $lab->date) . '</h5>
                                            <div class="activity blue">
                                                <span>
                                                    <i class="fa fa-flask"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $lab->date) . '</h4>
                                                            <p></p>
                                                             <i class=" fa fa-user-md"></i>
                                                                <h4>' . $lab_doctor . '</h4>
                                                                    <a class="btn btn-xs invoicebutton" title="Lab" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file-text"></i>' . lang('report') . '</a>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($medical_histories as $medical_history) {
            $timeline[$medical_history->date + 4] = '<div class="panel-body profile-activity" >
                                            <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('case_history') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $medical_history->date) . '</h5>
                                            <div class="activity greenn">
                                                <span>
                                                    <i class="fa fa-file"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $medical_history->date) . '</h4>
                                                            <p></p>
                                                             <i class=" fa fa-note"></i> 
                                                                <p>' . $medical_history->description . '</p>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }

        foreach ($patient_materials as $patient_material) {
            $timeline[$patient_material->date + 5] = '<div class="panel-body profile-activity" >
                                           <h5 class="pull-left"><span class="label pull-right r-activity">' . lang('documents') . '</span></h5>
                                            <h5 class="pull-right">' . date('d-m-Y', $patient_material->date) . '</h5>
                                            <div class="activity purplee">
                                                <span>
                                                    <i class="fa fa-file-o"></i>
                                                </span>
                                                <div class="activity-desk">
                                                    <div class="panel col-md-6">
                                                        <div class="panel-body">
                                                            <div class="arrow"></div>
                                                            <i class=" fa fa-calendar"></i>
                                                            <h4>' . date('d-m-Y', $patient_material->date) . ' <a class="pull-right" title="' . lang('download') . '"  href="' . $patient_material->url . '" download=""> <i class=" fa fa-download"></i> </a> </h4>
                                                                
                                                                 <h4>' . $patient_material->title . '</h4>
                                                            
                                                                
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>';
        }





        if (!empty($timeline)) {
            krsort($timeline);
            $timeline_value = '';
            foreach ($timeline as $key => $value) {
                $timeline_value .= $value;
            }
        }















        $all_appointments = '';
        foreach ($appointments as $appointment) {

            $doctor_details = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctor_details)) {
                $appointment_doctor = $doctor_details->name;
            } else {
                $appointment_doctor = "";
            }



            $patient_appointments = '<tr class = "">

        <td>' . date("d-m-Y", $appointment->date) . '
        </td>
        <td>' . $appointment->time_slot . '</td>
        <td>'
                    . $appointment_doctor . '
        </td>
        <td>' . $appointment->status . '</td>
        <td><a type="button" href="appointment/editAppointment?id=' . $appointment->id . '" class="btn btn-info btn-xs btn_width" title="Edit" data-id="' . $appointment->id . '">' . lang('edit') . '</a></td>

        </tr>';

            $all_appointments .= $patient_appointments;
        }




        if (empty($all_appointments)) {
            $all_appointments = '';
        }



        $all_case = '';

        foreach ($medical_histories as $medical_history) {
            $patient_case = ' <tr class="">
                                                    <td>' . date("d-m-Y", $medical_history->date) . '</td>
                                                    <td>' . $medical_history->title . '</td>
                                                    <td>' . $medical_history->description . '</td>
                                                </tr>';

            $all_case .= $patient_case;
        }


        if (empty($all_case)) {
            $all_case = '';
        }
        $all_prescription = '';

        foreach ($data['prescriptions'] as $prescription) {
            $doctor_details = $this->doctor_model->getDoctorById($prescription->doctor);
            if (!empty($doctor_details)) {
                $prescription_doctor = $doctor_details->name;
            } else {
                $prescription_doctor = '';
            }
            $medicinelist = '';
            if (!empty($prescription->medicine)) {
                $medicine = explode('###', $prescription->medicine);

                foreach ($medicine as $key => $value) {
                    $medicine_id = explode('***', $value);
                    $medicine_details = $this->medicine_model->getMedicineById($medicine_id[0]);
                    if (!empty($medicine_details)) {
                        $medicine_name_with_dosage = $medicine_details->name . ' -' . $medicine_id[1];
                        $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . '<br>';
                        rtrim($medicine_name_with_dosage, ',');
                        $medicinelist .= '<p>' . $medicine_name_with_dosage . '</p>';
                    }
                }
            } else {
                $medicinelist = '';
            }

            $option1 = '<a class="btn btn-info btn-xs btn_width" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye">' . lang('view') . '</i></a>';
            $prescription_case = ' <tr class="">
                                                    <td>' . date('m/d/Y', $prescription->date) . '</td>
                                                    <td>' . $prescription_doctor . '</td>
                                                    <td>' . $medicinelist . '</td>
                                                         <td>' . $option1 . '</td>
                                                </tr>';

            $all_prescription .= $prescription_case;
        }


        if (empty($all_prescription)) {
            $all_prescription = '';
        }


        $all_lab = '';

        foreach ($labs as $lab) {
            $doctor_details = $this->doctor_model->getDoctorById($lab->doctor);
            if (!empty($doctor_details)) {
                $lab_doctor = $doctor_details->name;
            } else {
                $lab_doctor = "";
            }
            $option1 = '<a class="btn btn-info btn-xs btn_width" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-eye">' . lang('report') . '</i></a>';
            $lab_class = ' <tr class="">
                                                    <td>' . $lab->id . '</td>
                                                    <td>' . date("m/d/Y", $lab->date) . '</td>
                                                    <td>' . $lab_doctor . '</td>
                                                         <td>' . $option1 . '</td>
                                                </tr>';

            $all_lab .= $lab_class;
        }


        if (empty($all_lab)) {
            $all_lab = '';
        }
        $all_bed = '';

        foreach ($beds as $bed) {


            $bed_case = ' <tr class="">
                                                    <td>' . $bed->bed_id . '</td>
                                                    <td>' . $bed->a_time . '</td>
                                                    <td>' . $bed->d_time . '</td>
                                                         
                                                </tr>';

            $all_bed .= $bed_case;
        }


        if (empty($all_bed)) {
            $all_bed = '';
        }


        $all_material = '';
        foreach ($patient_materials as $patient_material) {

            if (!empty($patient_material->title)) {
                $patient_documents = $patient_material->title;
            }


            $patient_material = '
            
                                            <div class="panel col-md-3"  style="height: 200px; margin-right: 10px; margin-bottom: 36px; background: #f1f1f1; padding: 34px;">

                                                <div class="post-info">
                                                    <img src="' . $patient_material->url . '" height="100" width="100">
                                                </div>
                                                <div class="post-info">
                                                    
                                                ' . $patient_documents . '

                                                </div>
                                                <p></p>
                                                <div class="post-info">
                                                    <a class="btn btn-info btn-xs btn_width" href="' . $patient_material->url . '" download> ' . lang("download") . ' </a>
                                                    <a class="btn btn-info btn-xs btn_width" title="' . lang("delete") . '" href="patient/deletePatientMaterial?id=' . $patient_material->id . '"onclick="return confirm("Are you sure you want to delete this item?");"> X </a>
                                                </div>

                                                <hr>

                                            </div>';
            $all_material .= $patient_material;
        }

        if (empty($all_material)) {
            $all_material = ' ';
        }


        if (!empty($patient->img_url)) {
            $profile_image = '<a href="#">
                            <img src="' . $patient->img_url . '" alt="">
                        </a>';
        } else {
            $profile_image = '';
        }



        $data['view'] = '
        <section class="col-md-3">
            <header class="panel-heading clearfix">
                <div class="">
                    ' . lang("patient") . ' ' . lang("info") . ' 
                </div>

            </header> 




            <aside class="profile-nav">
                <section class="">
                    <div class="user-heading round">
                        ' . $profile_image . '
                        <h1>' . $patient->name . '</h1>
                        <p> ' . $patient->email . ' </p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"> ' . lang("patient") . ' ' . lang("name") . '<span class="label pull-right r-activity">' . $patient->name . '</span></li>
                        <li>  ' . lang("patient_id") . ' <span class="label pull-right r-activity">' . $patient->id . '</span></li>
                        <li>  ' . lang("phone") . '<span class="label pull-right r-activity">' . $patient->phone . '</span></li>
                        <li>  ' . lang("email") . '<span class="label pull-right r-activity">' . $patient->email . '</span></li>
                        <li>  ' . lang("gender") . '<span class="label pull-right r-activity">' . $patient->sex . '</span></li>
                        <li>  ' . lang("birth_date") . '<span class="label pull-right r-activity">' . $patient->birthdate . '</span></li>
                        <li style="height: 200px;">  ' . lang("address") . '<span class="pull-right r-activity" style="height: 200px;">' . $patient->address . '</span></li>
                    </ul>

                </section>
            </aside>


        </section>





        <section class="col-md-9">
            <header class="panel-heading clearfix">
                <div class="col-md-7">
                    ' . lang("history") . ' | ' . $patient->name . '
                </div>

            </header>

            <section class="panel-body">   
                <header class="panel-heading tab-bg-dark-navy-blueee">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#appointments">' . lang("appointments") . '</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#home">' . lang("case_history") . '</a>
                        </li>
                         <li class="">
                            <a data-toggle="tab" href="#prescription">' . lang("prescription") . '</a>
                        </li>
                        
                        <li class="">
                            <a data-toggle="tab" href="#lab">' . lang("lab") . '</a>
                        </li>
                        
                        <li class="">
                            <a data-toggle="tab" href="#profile">' . lang("documents") . '</a>
                        </li>
                         <li class="">
                            <a data-toggle="tab" href="#bed">' . lang("bed") . '</a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#timeline">' . lang("timeline") . '</a> 
                        </li>
                    </ul>
                </header>
                <div class="panel">
                    <div class="tab-content">
                        <div id="appointments" class="tab-pane active">
                            <div class="">

                                <div class="adv-table editable-table ">
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th>' . lang("date") . '</th>
                                                <th>' . lang("time_slot") . '</th>
                                                <th>' . lang("doctor") . '</th>
                                                <th>' . lang("status") . '</th>
                                                <th>' . lang("option") . '</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            ' . $all_appointments . '
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="home" class="tab-pane">
                            <div class="">



                                <div class="adv-table editable-table ">


                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th>' . lang("date") . '</th>
                                                <th>' . lang("title") . '</th>
                                                <th>' . lang("description") . '</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            ' . $all_case . '
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
            
                                    <div id="prescription" class="tab-pane">
                                           <div class="">



                                       <div class="adv-table editable-table ">


                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th>' . lang("date") . '</th>
                                                <th>' . lang("doctor") . '</th>
                                                <th>' . lang("medicine") . '</th>
                                                <th>' . lang("options") . '</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            ' . $all_prescription . '
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                        <div id="lab" class="tab-pane"> <div class="">
                                <div class="adv-table editable-table ">
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th>' . lang("id") . '</th>
                                                <th>' . lang("date") . '</th>
                                                <th>' . lang("doctor") . '</th>
                                                <th>' . lang("options") . '</th>
                                            </tr>
                                        </thead>
                                        <tbody>'
                . $all_lab .
                '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                           <div id="bed" class="tab-pane"> <div class="">
                                <div class="adv-table editable-table ">
                                    <table class="table table-striped table-hover table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th>' . lang("bed_id") . '</th>
                                                <th>' . lang("alloted_time") . '</th>
                                                <th>' . lang("discharge_time") . '</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>'
                . $all_bed .
                '</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div id="profile" class="tab-pane"> <div class="">

                                <div class="adv-table editable-table ">
                                    <div class="">
                                        ' . $all_material . '
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="timeline" class="tab-pane"> 
                            <div class="">
                                <div class="">
                                    <section class="panel ">
                                        <header class="panel-heading">
                                            Timeline
                                        </header>


                                        ' . $timeline_value . '

                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>



</section>';


        echo json_encode($data);
    }

    public function getPatientinfo() {
// Search term
        $searchTerm = $this->input->post('searchTerm');

// Get users
        $response = $this->patient_model->getPatientInfo($searchTerm);

        echo json_encode($response);
    }

    public function getSymptominfo() {
        // Search term
        $searchTerm = $this->input->post('searchTerm');
        
        // Get users
        $response = $this->patient_model->getSymptomInfo($searchTerm);
        
        echo json_encode($response);
    }

    public function getAllOperation() {
        // Search term
                $searchTerm = $this->input->post('searchTerm');
        
        // Get users
                $response = $this->patient_model->getOperationInfo($searchTerm);
        
                echo json_encode($response);
    }

    public function getPatientinfoWithAddNewOption() {
// Search term
        $searchTerm = $this->input->post('searchTerm');

// Get users
        $response = $this->patient_model->getPatientinfoWithAddNewOption($searchTerm);

        echo json_encode($response);
    }

    function consultationReport() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Pharmacist','Nurse','Record_Officer','Receptionist'))) {
            redirect('home/permission');
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('consultation_record', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getConsultationReport(){
        $dateFrom=$this->input->get("dateFrom");
        $dateTo=$this->input->get("dateTo");
        $doctor=$this->input->get("doctor");
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
        if (empty($doctor)) {
            $doctor=-1;
        }else{
            $doctor=$this->doctor_model->getDoctorById($doctor)->ion_user_id;
        }
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['reports'] = $this->patient_model->getConsultationReportBysearch($st,$end,$doctor,$search);
            } else {
                $data['reports'] = $this->patient_model->getConsultationReport($st,$end,$doctor);
            }
        } else {
            if (!empty($search)) {
                $data['reports'] = $this->patient_model->getConsultationReportByLimitBySearch($st,$end,$doctor,$limit, $start, $search);
                
            } else {
                $data['reports'] = $this->patient_model->getConsultationReportByLimit($st,$end,$doctor,$limit, $start);
                
            }
        }

        // print_r($data['reports']);
        // die();


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        foreach ($data['reports'] as $report) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();
            $patientdetails = $this->patient_model->getPatientById($report->patient_id);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
                $birthDate = strtotime($patientdetails->birthdate);
                $birthDate = date('m/d/Y', $birthDate);
                $birthDate = explode("/", $birthDate);
                $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                $patientname.="<br/><b>Age: </b>$age Years(s)";
                if($patientdetails->insurance_sponsor != null){
                    $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_sponsor))->row();
                    $sponsor=$sp->name;
                    $hmo = $this->db->get_where('hmo', array('id' => $patientdetails->insurance_id))->row();
                    $insurance=$hmo->name;
                }else{
                    $insurance=$patientdetails->patient_type;
                    $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_id))->row();
                    $sponsor=$sp->name;
                }
            } else {
                $patientname = $report->patientname;
            }
            $doctordetails = $this->doctor_model->getDoctorByIonUserId($report->doctor_id);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = "";
            }

            $info[] = array(
                date('d-m-Y', $report->date),
                date("h:i A", $report->date),
                $doctorname,
                $patientname,
                $insurance,
                $sponsor,
            );
            $i = $i + 1;
        }
        

        if ($data['reports']) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->patient_model->getTotalConsultationReport($st,$end,$doctor),
                "recordsFiltered" => $this->patient_model->getTotalConsultationReport($st,$end,$doctor),
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

    

    function getBirthday(){
        $date=$this->input->get("date");
        
        if (empty($date)) {
            $d=date('d').'-'.date('m');
        }else{
            $boom=explode("-",$date);
            $d=$boom[0].'-'.$boom[1];
        }
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        // $limit=-1;
        // $start=0;

        if ($limit == -1) {
            $data['birthdays'] = $this->patient_model->getBirthday($d);
        } else {
            $data['birthdays'] = $this->patient_model->getBirthdayByLimit($d,$limit, $start);
        }

        $i = 1;
        foreach ($data['birthdays'] as $patientdetails) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();
            $patientname = $patientdetails->name;
            $birthDate = strtotime($patientdetails->birthdate);
            $birthDate = date('m/d/Y', $birthDate);
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
            $patientname.="<br/><b>Age: </b>$age Years(s)";
            if($patientdetails->insurance_sponsor != null){
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_sponsor))->row();
                $sponsor=$sp->name;
                $hmo = $this->db->get_where('hmo', array('id' => $patientdetails->insurance_id))->row();
                $insurance=$hmo->name;
            }else{
                $insurance=$patientdetails->patient_type;
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_id))->row();
                $sponsor=$sp->name;
            }
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = "";
            }

            $info[] = array(
                $i,
                $patientdetails->birthdate,
                $patientname,
                $patientdetails->phone
            );
            $i = $i + 1;
        }
        

        if ($data['birthdays']) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->patient_model->getPatient(),
                "recordsFiltered" => $data['birthdays'],
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


    function patientReport() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Pharmacist','Nurse','Record_Officer','Receptionist'))) {
            redirect('home/permission');
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('patient_record', $data);
        $this->load->view('home/footer'); // just the header file
    }


    

    function registrationReport() {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Pharmacist','Nurse'))) {
            // redirect('home/permission');
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('registration_record', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getRegistrationReport(){
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


        if(empty($this->input->get("insurance")) && empty($this->input->get("sponsor"))){
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['lists'] = $this->patient_model->getRegistrationReportBySearch($st,$end,$search);
                } else {
                    $data['lists'] = $this->patient_model->getRegistrationReport($st,$end);
                }
            } else {
                if (!empty($search)) {
                    $data['lists'] = $this->patient_model->getRegistrationReportByLimitBySearch($st,$end,$limit, $start, $search);
                    
                } else {
                    $data['lists'] = $this->patient_model->getRegistrationReportByLimit($st,$end,$limit, $start);
                    
                }
            }
            $recordFiltered=$this->patient_model->getTotalRegistrationReport($st,$end);
        }else{
            //get all the record for that date first
            $data['lists'] = $this->patient_model->getRegistrationReport($st,$end);
            $recordFiltered=0;
        }
        // print_r($data['lists']);
        // die();


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $total=0;
        foreach ($data['lists'] as $patientdetails) {
            $i = $i + 1;
            $patientname = $patientdetails->name;
            $birthDate = strtotime($patientdetails->birthdate);
            $birthDate = date('m/d/Y', $birthDate);
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
            $patientname.="<br/><b>Age: </b>$age Years(s)";
            if($patientdetails->insurance_sponsor != null){
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_sponsor))->row();
                $sponsor=$sp->name;
                $hmo = $this->db->get_where('hmo', array('id' => $patientdetails->insurance_id))->row();
                $insurance=$hmo->name;
            }else{
                $insurance=$patientdetails->patient_type;
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $patientdetails->insurance_id))->row();
                $sponsor=$sp->name;
            }
            
            
            $img="<img style='max-width:150px; max-height:150px' src='$patientdetails->img_url'/>";

            //work on insurance filter here
            if(!empty($this->input->get("insurance"))){
                if($this->input->get("insurance") =="private"){
                    if($insurance != "PRIVATE CLIENT" && $patientdetails->patient_type != "Private Patient"){
                        // $insurance="hellow world";
                        continue;
                    }
                    $recordFiltered++;
                }else{
                    $in=$this->db->get_where('hmo', array('id' => $this->input->get("insurance")))->row();
                    if($insurance != $in->name){
                        continue;
                    }else{
                        $recordFiltered++;
                    }
                }
                $total++;
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
                $total++;
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

            
            if(empty($this->input->get("sponsor")) && empty($this->input->get("insurance"))){
                $total++;
            }

            $info[] = array(
                date('d-m-Y', $patientdetails->registration_time),
                date("h:i A", $patientdetails->registration_time),
                $img,
                $patientname,
                $age,
                $insurance,
                $sponsor,
                $patientdetails->phone,
            );
            $i = $i + 1;
        }
        

        if ($recordFiltered >0) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $total,
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



/* End of file patient.php */
    /* Location: ./application/modules/patient/controllers/patient.php */
    