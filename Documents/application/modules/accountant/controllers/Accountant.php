<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accountant extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('accountant_model');
        $this->load->model('patient/patient_model');
        $this->load->model('department/department_model');
    }

    public function index() {
 
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }

        $data['accountants'] = $this->accountant_model->getAccountant();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('accountant', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
 
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
 
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("accountant/editAccountant?id=$id");
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
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
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            }

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Accountant
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('accountant/addNewView');
                } else {
                    $dfg = 3;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->accountant_model->insertAccountant($data);
                    $accountant_user_id = $this->db->get_where('accountant', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->accountant_model->updateAccountant($accountant_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else { // Updating Accountant
                $ion_user_id = $this->db->get_where('accountant', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->accountant_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->accountant_model->updateAccountant($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('accountant');
        }
    }

    function getAccountant() {
 
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
        $data['accountants'] = $this->accountant_model->getAccountant();
        $this->load->view('accountant', $data);
    }

    function editAccountant() {
 
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
        $data = array();
        $id = $this->input->get('id');
        $data['accountant'] = $this->accountant_model->getAccountantById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editAccountantByJason() {
        $id = $this->input->get('id');
        $data['accountant'] = $this->accountant_model->getAccountantById($id);
        echo json_encode($data);
    }

    function delete() {
 
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('accountant', array('id' => $id))->row();
        $path = $user_data->img_url;
        chmod($path, 0644);
        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->accountant_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('accountant');
    }


        ///////////////////////////////////sSTART OF RECORD CLASS


    public function record_office() {
 
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
        $data['officers'] = $this->accountant_model->getRecordOfficer();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('record_officer', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewOfficer(){
 
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("accountant/record_office?id=$id");
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('record_office', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
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
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            }

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Accountant
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('accountant/record_office');
                } else {
                    $dfg = 13;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->accountant_model->insertRecordOfficer($data);
                    $accountant_user_id = $this->db->get_where('record_officer', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->accountant_model->updateRecordOfficer($accountant_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else { // Updating Accountant
                $ion_user_id = $this->db->get_where('record_officer', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->accountant_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->accountant_model->updateRecordOfficer($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('accountant/record_office');
        }
    }
    

    function editRecordOfficerByJason() {
 
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
        $id = $this->input->get('id');
        $data['accountant'] = $this->accountant_model->getRecordOfficerById($id);
        echo json_encode($data);
    }


    function frontDeskRecord(){
        $dateFrom=$this->input->get("dateFrom");
        $dateTo=$this->input->get("dateTo");
        $_24=60*60*24;
        if (empty($dateFrom)) {
            $s=date("n/j/Y",time());
            $e=date("n/j/Y",(time()+$_24));
            $start=strtotime($s);
            $end=strtotime($e);
        }else{
            $start=strtotime($dateFrom);
            $e=strtotime($dateTo);
            $end=$e+$_24;
        }
        
        $data['officers'] = $this->accountant_model->getCheckinHistory($start,$end);
        $data['departments']=$this->department_model->getDepartment();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('front_desk_record', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getFrontDesk(){
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
        // $search = $this->input->post('search')['value'];

        if(empty($this->input->get("dept")) && empty($this->input->get("insurance")) && empty($this->input->get("sponsor"))){
            if ($limit == -1) {
                $data['checkins'] = $this->accountant_model->getCheckinHistory($st,$end);
            } else {
                $data['checkins'] = $this->accountant_model->getCheckinHistoryByLimit($st,$end,$limit, $start);
            }
            $recordFiltered=$this->accountant_model->getTotalCheckinHistory($st,$end);
        }else{
            //get all the record for that date first
            $data['checkins'] = $this->accountant_model->getCheckinHistory($st,$end);
            $recordFiltered=0;
        }
        //  $data['patients'] = $this->patient_model->getPatient();
        $data['patients']=array();
        foreach ($data['checkins'] as $checkin) {
            $date=date("n-j-Y",$checkin->date);
            $pInfo=$this->patient_model->getpatientById($checkin->patient_id);
            $birthDate = strtotime($pInfo->birthdate);
            $birthDate = date('m/d/Y', $birthDate);
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
            
            $tP=$pInfo->name."<br/><b>Age:</b> ".$age." (Years)<br/><b>Gender:</b> ".$pInfo->sex;
            
            if($pInfo->insurance_sponsor != null){
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $pInfo->insurance_sponsor))->row();
                $sponsor=$sp->name;
                $hmo = $this->db->get_where('hmo', array('id' => $pInfo->insurance_id))->row();
                $insurance=$hmo->name;
            }else{
                $insurance=$pInfo->patient_type;
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $pInfo->insurance_id))->row();
                $sponsor=$sp->name;
            }
            //work on insurance filter here
            if(!empty($this->input->get("insurance"))){
                if($this->input->get("insurance") =="private"){
                    $recordFiltered++;
                    if($insurance != "PRIVATE CLIENT" && $pInfo->patient_type != "Private Patient"){
                        // $insurance="hellow world";
                        continue;
                    }
                }else{
                    $in=$this->db->get_where('hmo', array('id' => $this->input->get("insurance")))->row();
                    $inName=$in->name;
                    $inName2=$inName;
                    if($insurance != $inName){
                        continue;
                    }else if($insurance != $inName2){
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
            $checkout=$this->db->get_where('check_out', array('check_in_id' => $checkin->id))->row();
            if(is_null($checkout)){
                $cO="still checked in";
                $cEnd=time();
            }else{
                $cO="Time: ".date("g:i a",$checkout->date)."<br/>By: ".$this->patient_model->vitalsBy($checkout->check_out_by);
                $cEnd=$checkout->date;
            }
            
            $consult=$this->accountant_model->getConsultationByCase($st,$cEnd,$checkin->patient_id);
            //clinic matter
            $doctor="";
            $consult=$this->db->get_where('consultation', array('checkin_id' => $checkin->id))->row();
            $doctor=$consult->doctor;
            if(is_null($consult)){
                //use the between time to get it
                $consult=$this->accountant_model->getConsultation($st,$cEnd,$checkin->patient_id);
                $doctor=$consult->doctor;
                if(is_null($consult)){
                    //we use case history to get it
                    $consult=$this->accountant_model->getConsultationByCase($st,$cEnd,$checkin->patient_id);
                    $doctor=$consult->doctor_id;
                }
            }
            if($doctor > 10000){
                $doc=$this->db->get_where('doctor', array('ion_user_id' => $doctor))->row();
                $dept=explode("|",$this->db->get_where('doctor', array('ion_user_id' => $doctor))->row()->department);
            }else{
                $doc=$this->db->get_where('doctor', array('id' => $doctor))->row();
                $dept=explode("|",$this->db->get_where('doctor', array('id' => $doctor))->row()->department);
                // $doc=$this->db->get_where('doctor', array('id' => $doctor))->row();
            }
            $dep=$this->db->get_where('department', array('id' => $dept[0]))->row();
            //dept check occurs here
            if(!empty($this->input->get("dept"))){
                if($dep->id !=$this->input->get("dept")){
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
                    $tP,
                    "Time: ".date("g:i a",$checkin->date).
                    "<br/>By: ".$this->patient_model->vitalsBy($checkin->checked_in_by),
                    $dep->name."<br/><b>Doctor:</b> ".$doc->name,
                    $insurance,
                    $sponsor,
                    $cO,
                        //  $options2
                );
            

            
            
        }
        

        if ($recordFiltered > 0) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('check_in')->num_rows(),
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

    function accountReport(){
        $dateFrom=$this->input->get("dateFrom");
        $dateTo=$this->input->get("dateTo");
        $_24=60*60*24;
        if (empty($dateFrom)) {
            $s=date("n/j/Y",time());
            $e=date("n/j/Y",(time()+$_24));
            $start=strtotime($s);
            $end=strtotime($e);
        }else{
            $start=strtotime($dateFrom);
            $e=strtotime($dateTo);
            $end=$e+$_24;
        }
        
        $data['officers'] = $this->accountant_model->getCheckinHistory($start,$end);
        $data['departments']=$this->department_model->getDepartment();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('account_record', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getAccountReport(){
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
                    $data['lists'] = $this->accountant_model->getAccountReportBySearch($st,$end,$search);
                } else {
                    $data['lists'] = $this->accountant_model->getAccountReport($st,$end);
                }
            } else {
                if (!empty($search)) {
                    $data['lists'] = $this->accountant_model->getAccountReportByLimitBySearch($st,$end,$limit, $start, $search);
                    
                } else {
                    $data['lists'] = $this->accountant_model->getAccountReportByLimit($st,$end,$limit, $start);
                    
                }
            }
            $recordFiltered=count($this->accountant_model->getAccountReport($st,$end));
        }else{
            $data['lists'] = $this->accountant_model->getAccountReport($st,$end);
            $recordFiltered=0;
        }
        print_r($data['lists']);
        foreach ($data['lists'] as $list) {
            $date=date("n-j-Y",$list->date);
            $pInfo=$this->patient_model->getpatientById($list->patient);
            $birthDate = strtotime($pInfo->birthdate);
            $birthDate = date('m/d/Y', $birthDate);
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
            
            $tP=$pInfo->name."<br/><b>Age:</b> ".$age." (Years)<br/><b>Gender:</b> ".$pInfo->sex;
            
            if($pInfo->insurance_sponsor != null){
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $pInfo->insurance_sponsor))->row();
                $sponsor=$sp->name;
                $hmo = $this->db->get_where('hmo', array('id' => $pInfo->insurance_id))->row();
                $insurance=$hmo->name;
            }else{
                $insurance=$pInfo->patient_type;
                $sp = $this->db->get_where('hmo_sponsor', array('id' => $pInfo->insurance_id))->row();
                $sponsor=$sp->name;
            }
            //work on insurance filter here
            if(!empty($this->input->get("insurance"))){
                if($this->input->get("insurance") =="private"){
                    $recordFiltered++;
                    if($insurance != "PRIVATE CLIENT" && $pInfo->patient_type != "Private Patient"){
                        // $insurance="hellow world";
                        continue;
                    }
                }else{
                    $in=$this->db->get_where('hmo', array('id' => $this->input->get("insurance")))->row();
                    $inName=$in->name;
                    $inName2=$inName;
                    if($insurance != $inName){
                        continue;
                    }else if($insurance != $inName2){
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
                $tP,
                $list->amount_received,
                $insurance,
                $sponsor
                    //  $options2
            );
            

            
            
        }
        

        if ($recordFiltered > 0) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('check_in')->num_rows(),
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

/* End of file accountant.php */
/* Location: ./application/modules/accountant/controllers/accountant.php */
